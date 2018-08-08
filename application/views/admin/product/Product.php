<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Public_Controller {

    public function __construct()
    {
        parent::__construct();

        //Load Model
        $this->load->model('admin/Product_model');
        $this->load->model('admin/Variation_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Condition_model');
        $this->load->model('admin/Brand_model');
        $this->load->model('admin/Product_model');
        $this->load->model('admin/Top_product_model');
        $this->load->model('admin/Ion_auth_model');
        $this->load->model('admin/Variation_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Wholesale_model');
        $this->load->model('admin/Address_model');
        $this->load->model('admin/Courier_model');
        $this->load->model('admin/Shop_model');
        $this->data['user_login']= $this->ion_auth->user()->row();
         $this->data['category_parent'] = $this->Category_model->get_is_root_category_active()->result();
        $this->data['brand_list'] = $this->Brand_model->get_all();
        $this->load->library('cart');
    }

    public function category($id=null)
    {
        if ($id=='all') {
            echo"ss";
            exit;
        }else{
            $this->data['category']     = $this->Category_model->get_all();
        $this->template->public_render('public/product/category', $this->data);
        }
    }


	public function single($username_seller, $product_id)
	{
    $this->data['category_parent'] = $this->Category_model->get_is_root_category_active()->result();
    $user_SuperAdmin = $this->ion_auth->get_all_user_SuperAdmin()->result();
            foreach ($user_SuperAdmin as $user_sa) {
                $user_id[]=$user_sa->user_id;
            }

    $user_id_imp = implode(',', $user_id);
    $this->data['brand_list'] = $this->Brand_model->get_all_active_SuperAdmin($user_id_imp);
    $this->data['seller_fulldata'] = $this->Shop_model->get_by_username($username_seller)->row();
    $seller_address= $this->Address_model->get_by_public_userid_forshipment($this->data['seller_fulldata']->id)->row();
    $kabupaten_json = $this->get_city($seller_address->province_id,$seller_address->city_id);
    $kabupaten_dec = json_decode($kabupaten_json,true); 

    $provinsi = $kabupaten_dec['rajaongkir']['results']['province'];
    $kabupaten = $kabupaten_dec['rajaongkir']['results']['city_name'];
    
    $this->data['seller_address'] = array('address' => $seller_address->address,
                                        'provinsi' => $provinsi,
                                        'kabupaten' => $kabupaten,

        );
    
    //Get Single Product
     //Get Seller By Username
     $seller = $this->Ion_auth_model->get_user_by_username($username_seller);
     $seller_num_rows= $seller->num_rows();
     if ($seller_num_rows<1) {
         show_404();
     }
    $product= $this->Product_model->get_by_public_useridseller_productid($seller->row()->id,$product_id);
    if ($product->num_rows()==0) {
        show_404();
    }
    else{
        $this->data['product']=$product->row();
        $this->data['variation_group']=$this->Variation_model->get_by_public_productid_group($product_id)->result();
        $this->data['variation']=$this->Variation_model->get_by_public_productid($product_id)->result();
        $this->data['category_product']= $this->Category_model->get_by_public_productid($product_id)->result();
        $this->data['product_attachment'] = $this->Product_model->get_by_public_productattachment_productid($product_id)->result();
        $this->data['wholesale_product']  = $this->Wholesale_model->get_by_public_productid($product_id)->result();
        $this->data['condition_product']  = $this->Condition_model->get_by_public_productid($product_id)->row();
    }
		$this->template->public_render('public/product/single', $this->data);
	}

    public function ajaxChangePriceByWholesale()
    {   
         $product_id = $this->input->post('product_id');
         $input_jml_beli = $this->input->post('input_jml_beli');
         if (!$input_jml_beli) {
             $input_jml_beli=1;
         }
         $wholesale_product= $this->Wholesale_model->get_by_public_productid($product_id)->result();
         $product = $this->Product_model->get_by_public_productid($product_id)->row();
         $price= $product->price;
         foreach ($wholesale_product as $w_p) {
             if ($input_jml_beli >= $w_p->min_qty) {
                 $price= $w_p->price;
             }
         }
         echo $price;
         exit;
    }

    public function get_province($province_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=$province_id",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 12639bc6800b894f91fe48cbcb7c1727"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return $err;
        } else {
          return $response;
        }
    }

    public function get_city($province_id, $city_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=$city_id&province=$province_id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 12639bc6800b894f91fe48cbcb7c1727"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return $err;
        } else {
          return $response;
        }
        exit;
    }

    public function get_cost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 12639bc6800b894f91fe48cbcb7c1727"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }

    public function ajaxModalBeli_content()
    {   
         $user_id = $this->ion_auth->user()->row()->id;
         $product_id = $this->input->post('product_id');
         $variation_pilih_array = $this->input->post('variation_pilih_array');
         $this->data['price'] = $this->input->post('price');
         $this->data['input_jml_beli'] = $this->input->post('input_jml_beli');
         $this->data['product'] = $this->Product_model->get_by_public_productid($product_id)->row();
         $this->data['address_buyer'] = $this->Address_model->get_by_public_userid($user_id)->result();
         $this->data['seller_courier_shipment'] = $this->Courier_model->get_by_public_userid($this->data['product']->user_id)->result();
         $this->data['address_seller'] = $this->Address_model->get_by_public_userid_forshipment($this->data['product']->user_id)->row();
         /*$count=0;
         foreach ($address_buyer as $address_byr) {
            $json_decode_address = json_decode($this->get_city($address_byr->province_id, $address_byr->city_id), TRUE);
             $this->data['address_buyer'][$count] = $json_decode_address;
            $count++;
         }
         */
         $this->data['variation_group']=$this->Variation_model->get_by_public_variation_productid_group($variation_pilih_array)->result();
         $this->data['variation']=$this->Variation_model->get_by_public_variation_productid($variation_pilih_array)->result();
         $this->data['weight'] = $this->data['product']->weight*$this->data['input_jml_beli'];
         $this->load->view('public/product/modal/ModalBeli_content', $this->data);
    }

    public function get_address()
    {
        $address_id = $this->input->post('address_id');
        $address    = $this->Address_model->get_by_address_id($address_id)->row();
        $get_city   = $this->get_city($address->province_id, $address->city_id);
        $address_city = json_decode($get_city,true);
        echo $address->address.', '.$address_city['rajaongkir']['results']['type'].' '.$address_city['rajaongkir']['results']['city_name'].', Provinsi '.$address_city['rajaongkir']['results']['province'].'||'.$address_city['rajaongkir']['results']['city_id'];
        exit;
    }

    public function get_courier_service()
    {
        $input_city_id = $this->input->post('input_city_id');
        $select_kurir = $this->input->post('select_kurir');
        $seller_city_id = $this->input->post('seller_city_id');
        $weight = $this->input->post('weight');
        echo $get_ongkir = $this->get_cost($seller_city_id, $input_city_id, $weight, $select_kurir);
/*        $ongkir = json_decode($get_ongkir,true);
        $count =count($ongkir['rajaongkir']['results'][0]['costs']);
            for ($i=0; $i < $count; $i++) { 
                echo '<option>'.$ongkir['rajaongkir']['results'][0]['costs'][$i]['service'].'</option>';
            }     */    
        exit;
    }

    public function add_product_to_chart()
    {
      if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
         $variation_pilih_array = $this->input->post('variation_pilih_array');
         $product_id = $this->input->post('product_id');
         $input_jml_beli= $this->input->post('input_jml_beli');
         $weight_measurement= $this->input->post('weight_measurement');
         $ongkir= $this->input->post('ongkir_dipilih');
         $address_id_buyer= $this->input->post('address_buyer');
         $weight= $this->input->post('weight');
         $product= $this->Product_model->get_by_public_productid($product_id)->row();
         $variation_exp = explode(',', $variation_pilih_array);
         $variation_imp = implode("-", $variation_exp);
         
        $data = array(
            'id'        => $product_id.'_'.$variation_imp.'n'.$address_id_buyer,
            'qty'       => $input_jml_beli,
            'price'     => $product->price,
            'name'      => $product->name,
            'variation' => $variation_pilih_array,
            'address_id_buyer' => $address_id_buyer,
            'user_id_seller' => $product->user_id,
            'weight'    => $weight,
            'weight_measurement'    => $weight_measurement
        );
        var_dump($data);
        $this->cart->insert($data);
        exit;
      }
    }
}
