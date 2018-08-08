<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Load :: Common */
		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->load->model('admin/Product_model');
		$this->load->model('admin/Variation_model');
		$this->load->model('admin/Category_model');
		$this->load->model('admin/Condition_model');
		$this->load->model('admin/Brand_model');
		$this->load->model('admin/Brand_model');
		$this->load->model('admin/Wholesale_model');
		$this->load->model('admin/Currency_model');
		$this->load->model('admin/Discount_model');
		$this->load->helper('tgl_indo');
		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, 'Produk', 'admin/product');

		/* Load Menus */
		$this->data['menus'] = $this->Menus_model->get_all();
		$this->data['menus_prefs'] = $this->Menus_preferences_model->get_all()->result();
		$this->load->library('upload');
		//$this->load->library('UploadHandler');
	}

	private function show_menu_check()
	{
		//Cek Show Menu
			$link = $this->router->fetch_class();
			$menu_id =  $this->ion_auth->menu_preferences($link);
			if ( $menu_id == 0 )
			{
				redirect('admin/dashboard', 'refresh');
			}
	}

	private function access_menu()
	{
		//Cek Menu
			$link = $this->router->fetch_class();
			$this->data['menu_id'] =  $this->ion_auth->check_access_menu($link);
	}

	public function index()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->show_menu_check();
			$this->access_menu();
			
			/* Title Page */
			$this->page_title->push('Produk');
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Data */
			$this->data['product_list'] = $this->Product_model->get_by_userid_undeleted()->result();
			$this->data['product_img']  = $this->Product_model->get_all_by_attachment()->result();
			$this->data['product_category'] = $this->Product_model->get_all_by_category()->result();
			$this->data['product_wholesale'] = $this->Wholesale_model->get_all();
			$this->data['product_combine'] = $this->Product_model->get_all_combineproduct();
			//$this->data['product_num_rows'] = $this->Product_model->nu

			/* Load Template */
			$this->template->admin_render('admin/product/index', $this->data);
		}
	}

	public function coba()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->load->view('admin/product/img_product');

		}
	}
	public function upload_product_img()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			$options = [
				'script_url' => site_url('admin/product/upload_product_img'),
				'upload_dir' => APPPATH . '../upload/product/',
				'upload_url' => site_url('upload/product/')
			];
			$this->load->library('UploadHandler', $options);
			exit;
		}
	}

	public function create()
	{
		/* Cek Menu Show */
			$this->show_menu_check();
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Create', 'admin/product/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		$this->page_title->push('Tambah Produk Baru');
		$this->data['pagetitle'] = $this->page_title->show();

		/* Validate form input */
		$this->form_validation->set_rules('name', 'Nama Produk', 'required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'required');
		$this->form_validation->set_rules('order', 'Order', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			if ( !$this->input->post('active') )
			{
				$active = '0';
			}else{
				$active = '1';
			}

			$data[1] = array(
							   'name' => $this->input->post('name'),
							   'description' => $this->input->post('description'),
							   'parent_id' => $parent_id,
							   'depth' => "$depth",
							   'is_root_product' => "$is_root_product",
							   'active' => $active,
							   'order' => $this->input->post('order'),
							   'user_id' => $this->ion_auth->user()->row()->id,
							   'date_created' => date('Y-m-d G:i:s')
							   );
		   	if($this->Product_model->create($data)){
				redirect('admin/product', 'refresh');
			}
		}
		else
		{
			$user_SuperAdmin = $this->ion_auth->get_all_user_SuperAdmin()->result();
			foreach ($user_SuperAdmin as $user_sa) {
				$user_id[]=$user_sa->user_id;
			}

			$user_id_imp = implode(',', $user_id);

			$this->data['variation_list'] = $this->Variation_model->get_all_active_SuperAdmin($user_id_imp);
			$this->data['category_list'] = $this->Category_model->get_is_root_category_active()->result();
			$this->data['condition_list'] = $this->Condition_model->get_all_active_SuperAdmin($user_id_imp);
			$this->data['brand_list'] = $this->Brand_model->get_all_active_SuperAdmin($user_id_imp);
			$this->data['curr_list'] = $this->Currency_model->get_active()->result();
			/* Load Template */
			$this->template->admin_render('admin/product/create', $this->data);
		}
	}

	public function show($id)
	{
		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);
		$this->data['id_encode']	= $id;
		$this->breadcrumbs->unshift(2, 'Create', 'admin/product/show');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		$this->page_title->push('Detail Produk');
		$this->data['pagetitle'] = $this->page_title->show();
		//Get One Data To Show
		$this->data['one_product']  					 = $this->Product_model->get_by_productid($id_decode)->row();
		$this->data['product_attachment']			 = $this->Product_model->get_by_productattachment_productid($id_decode)->result();
		$this->data['group_variation_product'] = $this->Variation_model->get_by_group_variationproductid($id_decode)->result();
		$this->data['variation_product'] 			 = $this->Variation_model->get_by_productid($id_decode)->result();
		$this->data['category_product'] 			 = $this->Category_model->get_by_productid($id_decode)->result();
		$this->data['wholesale_product'] 			 = $this->Wholesale_model->get_by_productid($id_decode)->result();
		$this->data['combine_product'] 			 	 = $this->Product_model->get_by_combineproductid($id_decode)->result();
		/* Load Template */
		$this->template->admin_render('admin/product/show', $this->data);
	}

	public function edit($id)
	{
		/* Cek Menu Show */
			$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id))
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();
		/* Breadcrumbs */

		$this->data['pagetitle'] = 'Form Edit Produk';
		$this->breadcrumbs->unshift(2, 'Edit', 'admin/menus/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

			if (isset($_POST) && ! empty($_POST))
		{
			/* Validate form input */
			$this->form_validation->set_rules('name', 'Nama Menu', 'required');
			$this->form_validation->set_rules('link', 'Link Menu', '');
			$this->form_validation->set_rules('order', 'Order', 'required');
			$this->form_validation->set_rules('fa_icon', 'Ikon', '');

			if ($this->form_validation->run() == TRUE)
			{
				if ( !$this->input->post('is_root_product') )
				{

					$pecah = explode("-",$this->input->post('parent_id'));
					$parent_id	= $pecah[0];
					$depth		= $pecah[1]+1;
					$is_root_product = 0;
				}else
				{
					$depth = 0;
					$parent_id = 0;
					$is_root_product = 1;
				}

				if ( !$this->input->post('active') )
				{
					$active = '0';
				}else{
					$active = '1';
				}

				$id_decode	= strtr($this->input->post('product_id'),array('.' => '+', '-' => '=', '~' => '/'));
				$id_decode	= $this->encrypt->decode($id_decode);
					$this->data_update[1] = array(
							   'product_id' => $id_decode,
							   'name' => $this->input->post('name'),
							   'description' => $this->input->post('description'),
							   'parent_id' => $parent_id,
							   'depth' => "$depth",
							   'is_root_product' => "$is_root_product",
							   'active' => $active,
							   'order' => $this->input->post('order'),
							   'user_id' => $this->ion_auth->user()->row()->id,
							   'last_updated' => date('Y-m-d G:i:s')
					);

				if($this->Product_model->update($this->data_update))
				{
					$this->session->set_flashdata('message', 'Data Berhasil Diedit');
					redirect('admin/product', 'refresh');
				}
			}
		}else{

		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);
		$this->data['id_encode']	= $id;
		//Get One Data To Edit
		$this->data['one_product']  = $this->Product_model->get_by_productid($id_decode)->row();
		$this->data['product_list'] = $this->Product_model->get_all();
		/* Load Template */
		$this->template->admin_render('admin/product/edit', $this->data);
		}
	}

	public function setStatus()
	{
		/* Cek Menu Show */
			$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();

					if ( $this->input->post('active') == 0 )
					{
						$active = '1';
					}else{
						$active = '0';
					}
					$id_decode	= strtr($this->input->post('product_id'),array('.' => '+', '-' => '=', '~' => '/'));
					$id_decode	= $this->encrypt->decode($id_decode);
						$this->data_update[1] = array(
								   'product_id' => $id_decode,
								   'active' => $active,
								   'last_updated' => date('Y-m-d G:i:s')
						);

					if($this->Product_model->update($this->data_update))
					{
						echo $this->session->set_flashdata('message', 'Status Berhasil Diedit');
						//redirect('admin/product', 'refresh');
					}
	}

	public function hapusProduk()
	{
		/* Cek Menu Show */
			$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();

					if ( $this->input->post('deleted') == 0 )
					{
						$deleted = '1';
					}else{
						$deleted = '0';
					}
					$id_decode	= strtr($this->input->post('product_id'),array('.' => '+', '-' => '=', '~' => '/'));
					$id_decode	= $this->encrypt->decode($id_decode);
						$this->data_update[1] = array(
								   'product_id' => $id_decode,
								   'deleted' => $deleted,
								   'last_deleted' => date('Y-m-d G:i:s')
						);

					if($this->Product_model->update($this->data_update))
					{
						echo $this->session->set_flashdata('message', 'Status Berhasil Diedit');
						//redirect('admin/product', 'refresh');
					}
	}

	public function ajaxSearchProduct()
	{
		$this->data['count_search'] = $this->input->post('count_search');
		$this->data['product_list'] = $this->Product_model->get_by_userid_undeleted()->result();
		$this->load->view("admin/product/search_product",$this->data);
	}

	public function ajaxCreateProduct()
	{

		$data[1] = array(
							 'name' => $this->input->post('name'),
							 'description' => $this->input->post('description'),
							 'condition_id' => $this->input->post('condition_id'),
							 'brand_id' => $this->input->post('brand_id'),
							 'sku' => $this->input->post('sku'),
							 'quantity' => $this->input->post('quantity'),
							 'low_stock_alert' => $this->input->post('low_stock_alert'),
							 'price' => $this->input->post('price'),
							 'min_quantity_order' => $this->input->post('min_quantity_order'),
							 'weight' => $this->input->post('weight'),
							 'weight_measurement' => $this->input->post('weight_measurement'),
							 'length' => $this->input->post('length'),
							 'width_measurement' => $this->input->post('width_measurement'),
							 'height' => $this->input->post('height'),
							 'height_measurement' => $this->input->post('height_measurement'),
							 'length_measurement' => $this->input->post('length_measurement'),
							 'width' => $this->input->post('width'),
							 'insurance' => $this->input->post('insurance'),
							 /*'min_qty_discount' => $this->input->post('min_qty_discount'),
							 'discount_type' => $this->input->post('discount_type'),
							 'discount_value' => $this->input->post('discount_value'), */
							 'currency_id' => $this->input->post('currency_id'),
							 'video_product' => $this->input->post('video_product'),
							 'active' => 1,
							 'user_id' => $this->ion_auth->user()->row()->id,
							 'date_created' => date('Y-m-d G:i:s')
							 );
			$this->Product_model->create($data);
			echo $max_product_id = $this->Product_model->get_by_maxid_userid()->row()->product_id;
			exit;
	}

	public function ajaxCreateCategoryProduct()
	{
	$cek_category_product = $this->Category_model->get_by_productid($this->input->post('max_product_id'))->num_rows();
	if($cek_category_product < 1 ){
		if ($this->input->post('category_id_1') >0) {
			$data[1] = array(
 							 'category_id' => $this->input->post('category_id_1'),
 							 'product_id' => $this->input->post('max_product_id'),
 							 'user_id' => $this->ion_auth->user()->row()->id
 							 );
		}
		if ($this->input->post('dropdown_subcategory') >0) {
		 $data[2] = array(
		 					 'category_id' => $this->input->post('dropdown_subcategory'),
		 					 'product_id' => $this->input->post('max_product_id'),
		 					 'user_id' => $this->ion_auth->user()->row()->id
		 					 );
		}
		if ($this->input->post('dropdown_subscategory') >0) {
		 $data[3] = array(
							 'category_id' => $this->input->post('dropdown_subscategory'),
							 'product_id' => $this->input->post('max_product_id'),
							 'user_id' => $this->ion_auth->user()->row()->id
							 );
		}
		 $this->Category_model->create_categoryproduct($data);
	 }
	}

	public function ajaxCreateVariationProduct()
	{
			$json_data =  json_decode($this->input->post('data'),true);
		//	$max_product_id = $this->Product_model->get_by_maxid_userid()->row()->product_id;
			$cek_variationproduct = $this->Variation_model->get_by_productid($json_data[0]["max_product_id"])->num_rows();
			if ($cek_variationproduct < 1) {
				for($i=0; $i<count($json_data); $i++)
					{
							if( $json_data[$i]["variation_id"] !== null and $json_data[$i]["value"] !== null)
							$this->data_variation_product[$i]=array(
									'variation_id' => $json_data[$i]["variation_id"],
									'value' => $json_data[$i]["value"],
									'product_id' => $json_data[$i]["max_product_id"],
									'user_id' => $this->ion_auth->user()->row()->id
									);
					}
				$this->Variation_model->create_variation_product($this->data_variation_product);
			}
	}


	public function ajaxCreateWholesaleProduct()
	{
			$max_product_id = $this->Product_model->get_by_maxid_userid()->row()->product_id;
			$json_data =  json_decode($this->input->post('data'),true);
			$cek_wholesaleproduct = $this->Wholesale_model->get_by_productid($max_product_id)->num_rows();
			if ($cek_wholesaleproduct < 1) {
				for($i=0; $i<count($json_data); $i++)
					{
							if( $json_data[$i]["min_qty"] !== null and $json_data[$i]["max_qty"] !== null and $json_data[$i]["price_wholesale"] !== null)
							{
									$this->data_wholesaleproduct[$i]=array(
										'min_qty' => $json_data[$i]["min_qty"],
										'max_qty' => $json_data[$i]["max_qty"],
										'price' => $json_data[$i]["price_wholesale"],
										'product_id' => $max_product_id,
										'user_id' => $this->ion_auth->user()->row()->id
										);
										//echo $json_data[$i]["min_qty"];
							}
					}
					$this->Wholesale_model->create_wholesaleproduct($this->data_wholesaleproduct);
				}
	}

	public function ajaxUpdWholesaleProduct()
	{
			$json_data =  json_decode($this->input->post('data'),true);
			var_dump($json_data);
				for($i=0; $i<count($json_data); $i++)
					{
						if (!$json_data[$i]["min_qty"] and !$json_data[$i]["max_qty"] and !$json_data[$i]["price"]) {
								$this->Wholesale_model->delete_wholesaleproduct($json_data[$i]["wholesale_id"]);
								echo $json_data[$i]["wholesale_id"];
						}else{
								$this->data_UpdWholesaleProduct[$i]=array(
									'min_qty' => $json_data[$i]["min_qty"],
									'max_qty' => $json_data[$i]["max_qty"],
									'price' => $json_data[$i]["price"],
									'product_id' => $json_data[$i]["product_id"],
									'wholesale_id' => $json_data[$i]["wholesale_id"],
									'user_id' => $this->ion_auth->user()->row()->id
									);

						}
					}
					if (count($this->data_UpdWholesaleProduct)>0) {
						$this->Wholesale_model->update_wholesaleproduct($this->data_UpdWholesaleProduct);
					}
					echo"Sukses";
					exit;

}

	public function ajaxAddWholesaleProduct()
	{
			$json_data =  json_decode($this->input->post('data'),true);
			var_dump($json_data);
				for($i=0; $i<count($json_data); $i++)
					{
								$this->data_wholesaleproduct[$i]=array(
									'min_qty' => $json_data[$i]["min_qty"],
									'max_qty' => $json_data[$i]["max_qty"],
									'price' => $json_data[$i]["price"],
									'product_id' => $json_data[$i]["product_id"],
									'user_id' => $this->ion_auth->user()->row()->id
									);
						}
					$this->Wholesale_model->create_wholesaleproduct($this->data_wholesaleproduct);
					echo"Sukses";
					exit;
	}

	/*public function ajaxCreateCombineProduct()
	{
		//Pending
			$max_product_id = $this->Product_model->get_by_maxid_userid()->row()->product_id;
			$json_data =  json_decode($this->input->post('data'),true);
			$cek_combineproduct = $this->Product_model->get_by_combineproductid($max_product_id)->num_rows();
			if ($cek_combineproduct < 1) {
				for($i=0; $i<count($json_data); $i++)
					{
							if( $json_data[$i]["product_id"] !== null and $json_data[$i]["price_combine"] !== null)
							$this->data_combineproduct[$i]=array(
									'product_id' => $max_product_id,
									'combine_product' => $json_data[$i]["product_id"],
									'price_combine' => $json_data[$i]["price_combine"],
									'user_id' => $this->ion_auth->user()->row()->id
									);
					}
				$this->Product_model->create_combineproduct($this->data_combineproduct);
			}
	}
*/
public function ajaxSelectSubCategory()
	{
		$id = $this->input->post('category_id');
		//$id = 1;
		$subcategory = $this->Category_model->get_by_subcategory_categoryid_active($id);
				if ($subcategory->num_rows()>0) {
					$count = 1;
						foreach ($subcategory->result() as $sc) {
							$data[]= array("category_id"=>$sc->category_id, "name"=>$sc->name,"count"=>$count);
							$count++;
						}
			 			echo json_encode($data);
				}else{

				}
		 exit;
	}

	public function ajaxSelectSubsCategory()
	{
		$id = $this->input->post('category_id');
		$subcategory = $this->Category_model->get_by_subscategory_categoryid_active($id);
				if ($subcategory->num_rows()>0) {
					$count = 1;
						foreach ($subcategory->result() as $sc) {
							$data[]= array("category_id"=>$sc->category_id, "name"=>$sc->name,"count"=>$count);
							$count++;
						}
			 			echo json_encode($data);
				}else{

				}
		 exit;
	}
	public function ajaxImgUpload()
	{
	    $cek_productattachment = $this->Product_model->get_by_productattachment_productid($this->input->post('max_product_id'))->num_rows();
	    if($cek_productattachment == 0)
	   {
	    //setting konfigurasi upload gambar

			$config['upload_path'] = './upload/product/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

			$config['max_size']	= '8000';

			$config['max_width']  = '4000';

			$config['max_height']  = '4024';

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('img_product')){

				$img_filename="none";

			}else{

				$img_filename=$this->upload->file_name;

			}
	   }
	        $this->data_product_attachment[1]=array(

									'filename' => $img_filename,
									'product_id' => $this->input->post('max_product_id'),
									'user_id' => $this->ion_auth->user()->row()->id
								);
			$this->Product_model->create_product_attachment($this->data_product_attachment);
	   			echo $img_filename;
			 echo $cek_productattachment;
			 echo "</br>";
			 echo $this->input->post('max_product_id');
			exit;

	}

	public function ajaxSearchDiscount()
	{
		//Decode ID
		$id_decode	= strtr($this->input->post('product_id'),array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);

		$this->data['product_id'] = $id_decode;
		$this->data['product'] = $this->Product_model->get_by_productid_mainattachment($id_decode)->row();
		$this->data['discount_list'] = $this->Discount_model->get_by_productid($id_decode)->result();
		$this->data['count_discount'] = $this->Discount_model->get_by_productid($id_decode)->num_rows();
		$this->load->view("admin/product/modal/search_discount",$this->data);

	}

	public function ajaxCreateProductDiscount()
	{
		$id_decode	= strtr($this->input->post('product_id'),array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);
		$data[1] = array(
							 'min_qty_discount' => $this->input->post('min_qty_discount'),
							 'discount_type' => $this->input->post('discount_type'),
							 'discount_value' => $this->input->post('discount_value'),
							 'price_afterdiscount' => $this->input->post('price_afterdiscount'),
							 'date_expired' => $this->input->post('date_expired'),
							 'currency_id' => $this->input->post('currency_id'),
							 'product_id' => $id_decode,
							 'user_id' => $this->ion_auth->user()->row()->id,
							  'date_created_discount' => date('Y-m-d')
							 );
			$this->Discount_model->create($data);
			exit;
	}

	public function ajaxSearchWholesale()
	{
		//Decode ID
		$id_decode	= strtr($this->input->post('product_id'),array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);

		$this->data['product_id'] = $id_decode;
		$this->data['product'] = $this->Product_model->get_by_productid_mainattachment($id_decode)->row();
		$this->data['wholesale_list'] = $this->Wholesale_model->get_by_productid($id_decode)->result();
		$this->data['count_wholesale'] = $this->Wholesale_model->get_by_productid($id_decode)->num_rows();
		$this->load->view("admin/product/modal/search_wholesale",$this->data);
	}

	public function ajaxSearchCombine()
	{
		//Decode ID
		$id_decode	= strtr($this->input->post('product_id'),array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);

		$this->data['product_id'] = $id_decode;
		$this->data['product'] = $this->Product_model->get_by_productid_mainattachment($id_decode)->row();
		$this->data['combine_list'] = $this->Product_model->get_by_combineproductid($id_decode)->result();
		$this->data['count_combine'] = $this->Product_model->get_by_combineproductid($id_decode)->num_rows();
	
		$this->load->view("admin/product/modal/search_combine",$this->data);

	}
	public function ajaxSearchProductCombine()
	{
		$this->data['product_list'] = $this->Product_model->get_by_userid_undeleted()->result();
		$this->load->view("admin/product/search_productcombine",$this->data);
	}
	
	public function ajaxDeleteCombineProduct()
	{
		$json_data =  json_decode($this->input->post('data'),true);
		$this->Product_model->delete_combineproduct($json_data[0]["combine_id"]);
	}

	public function ajaxCreateCombineProduct()
	{
		$json_data =  json_decode($this->input->post('data'),true);

		$json_delete =  json_decode($this->input->post('datadelete'),true);
		for($i=0; $i<count($json_data); $i++)
		{
			$this->Product_model->delete_combineproduct($json_delete[$i]["combine_id"]);
		}

		for($i=0; $i<count($json_data); $i++)
		{
			//Jika Array Tidak Kosong
			if( $json_data[$i]["combine_product"] !== null and $json_data[$i]["price_combine"] !== null)
			{
				//Decode ID
				$id_decode	= strtr($json_data[$i]["main_product_id"],array('.' => '+', '-' => '=', '~' => '/'));
				$main_product_id	= $this->encrypt->decode($id_decode);
				$cek_combineproduct_on_db = $this->Product_model->get_combineproduct_by_mainproduct_combineproduct($main_product_id, $json_data[$i]["combine_product"])->num_rows();

				if ($cek_combineproduct_on_db ==0) {
					$this->data_combine_add[$i]=array(
						'main_product_id' => $main_product_id,
						'combine_product' => $json_data[$i]["combine_product"],
						'price_cut' => $json_data[$i]["price_cut"],
						'price_combine' => $json_data[$i]["price_combine"],
						'user_id' => $this->ion_auth->user()->row()->id
						);
				}elseif($cek_combineproduct_on_db>0){
					$combineproduct_on_db = $this->Product_model->get_combineproduct_by_mainproduct_combineproduct($main_product_id, $json_data[$i]["combine_product"])->row();
					$this->data_combine_upd[$i]=array(
						'combine_id' => $combineproduct_on_db->combine_id,
						'main_product_id' => $main_product_id,
						'combine_product' => $json_data[$i]["combine_product"],
						'price_cut' => $json_data[$i]["price_cut"],
						'price_combine' => $json_data[$i]["price_combine"],
						'user_id' => $this->ion_auth->user()->row()->id
						);
				}
			}
		}
		if (isset($this->data_combine_add)) {
			$this->Product_model->create_combineproduct($this->data_combine_add);
			echo"ok_add";
		}
		if (isset($this->data_combine_upd)) {
			$this->Product_model->update_combineproduct($this->data_combine_upd);
			echo "ok_upd";
		}
		exit;
	}
}
