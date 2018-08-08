<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Load :: Common */
		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->load->model('admin/Shop_model');
		$this->load->model('admin/Shipment_model');

		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, 'Pengaturan Toko', 'admin/shop');

		/* Load Menus */
		$this->data['menus'] = $this->Menus_model->get_all();
		$this->data['menus_prefs'] = $this->Menus_preferences_model->get_all()->result();
		
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
			$this->page_title->push('Pengaturan Toko');
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$cek_shop_profile = $this->Shop_model->get_by_userid()->num_rows();
			$this->data['active_navs']=$this->uri->segment(3);
			if ($cek_shop_profile >=1) {
				$this->data['shop_profile'] = $this->Shop_model->get_by_userid()->row();
				/* Load Template */
				$this->data['active_navs']=$this->uri->segment(3);
				$this->template->admin_render('admin/shop/edit_shop_profile', $this->data);
			}else{
				$this->template->admin_render('admin/shop/create_shop_profile', $this->data);
			}
		}
	}

	public function create()
	{
		/* Cek Menu Show */
		$this->show_menu_check();
		$user_id_decode = strtr($this->input->post('user_id'),array('.' => '+', '-' => '=', '~' => '/'));
		$user_id_decode	= $this->encrypt->decode($user_id_decode);
		if ( !$this->input->post('openshop_status') )
				{
					$openshop_status = '0';
				}else{
					$openshop_status = '1';
				}
		$data[1] = array(
						   'name' => $this->input->post('name'),
						   'user_id' => $user_id_decode,
						   'openshop_status' => $openshop_status,
						   'slogan' => $this->input->post('slogan'),
						   'date_created' => date('Y-m-d H:i:s')
						   );
	   	if($this->Shop_model->create($data)){
			redirect('admin/shop', 'refresh');
		}
	}

	public function edit()
	{
		/* Cek Menu Show */
			$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();
		/* Breadcrumbs */
				if ( !$this->input->post('openshop_status') )
				{
					$openshop_status = '0';
				}else{
					$openshop_status = '1';
				}

				$id_decode	= strtr($this->input->post('shop_id'),array('.' => '+', '-' => '=', '~' => '/'));
				$id_decode	= $this->encrypt->decode($id_decode);
				$user_id_decode	= strtr($this->input->post('user_id'),array('.' => '+', '-' => '=', '~' => '/'));
				$user_id_decode	= $this->encrypt->decode($user_id_decode);
					$this->data_update[1] = array(
							   'shop_id' => $id_decode,
							   'name' => $this->input->post('name'),
							   'slogan' => $this->input->post('slogan'),
							   'openshop_status' => $openshop_status,
							   'user_id' => $user_id_decode,
							   'last_updated' => date('Y-m-d G:i:s')
					);

				if($this->Shop_model->update($this->data_update))
				{
					$this->session->set_flashdata('message', 'Data Berhasil Diedit');
					redirect('admin/shop', 'refresh');
				}
	}

	public function get_all_city(){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
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

	public function shipment()
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
			$this->page_title->push('Pengaturan Toko');
			$this->data['pagetitle'] = $this->page_title->show();
			$this->data['active_navs']=$this->uri->segment(3);

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$cek_shop_profile = $this->Shop_model->get_by_userid()->num_rows();
			if ($cek_shop_profile >=1) {
				$this->data['shop_profile'] = $this->Shipment_model->get_by_userid()->row();
				/* Load Template */
		
				$this->data['city']=$this->get_all_city();
				$this->template->admin_render('admin/shop/edit_shop_shipment', $this->data);
			}else{
				$this->template->admin_render('admin/shop/create_shop_shipment', $this->data);
			}
		}
	}

}
