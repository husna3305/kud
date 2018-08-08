<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variation extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Load :: Common */
		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->load->model('admin/Variation_model');

		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, 'Variation', 'admin/variation');

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
			$this->page_title->push('Variasi');
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['variation_list'] = $this->Variation_model->get_all();

			/* Load Template */
			$this->template->admin_render('admin/variation/index', $this->data);
		}
	}
	public function create()
	{
		/* Cek Menu Show */
			$this->show_menu_check();
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Create', 'admin/variation/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		$this->page_title->push('Tambah Variation Baru');
		$this->data['pagetitle'] = $this->page_title->show();
		$this->data['variation_list'] = $this->Variation_model->get_all();

		/* Validate form input */
		$this->form_validation->set_rules('name', 'Nama Variasi', 'required');
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
							   'active' => $active,
							   'order' => $this->input->post('order'),
							   'user_id' => $this->ion_auth->user()->row()->id,
							   'date_created' => date('Y-m-d G:i:s')
							   );
		   	if($this->Variation_model->create($data)){
				redirect('admin/variation', 'refresh');
			}
		}
		else
		{
			/* Load Template */
			$this->template->admin_render('admin/variation/create', $this->data);
		}
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

		$this->data['pagetitle'] = 'Form Edit Variasi';
		$this->breadcrumbs->unshift(2, 'Edit', 'admin/variation/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

			if (isset($_POST) && ! empty($_POST))
		{
			/* Validate form input */
			$this->form_validation->set_rules('name', 'Nama Variasi', 'required');
			$this->form_validation->set_rules('order', 'Posisi', 'required');

			if ($this->form_validation->run() == TRUE)
			{
				if ( !$this->input->post('active') )
				{
					$active = '0';
				}else{
					$active = '1';
				}
				
				$id_decode	= strtr($this->input->post('variation_id'),array('.' => '+', '-' => '=', '~' => '/'));
				$id_decode	= $this->encrypt->decode($id_decode);
					$this->data_update[1] = array(
							   'variation_id' => $id_decode,
							   'name' => $this->input->post('name'),
							   'description' => $this->input->post('description'),
							   'active' => $active,
							   'order' => $this->input->post('order'),
							   'user_id' => $this->ion_auth->user()->row()->id,
							   'last_updated' => date('Y-m-d G:i:s')
					);

				if($this->Variation_model->update($this->data_update))
				{
					$this->session->set_flashdata('message', 'Data Berhasil Diedit');
					redirect('admin/variation', 'refresh');
				}
			}
		}else{

		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);
		$this->data['id_encode']	= $id;
		//Get One Data To Edit
		$this->data['one_variation']  = $this->Variation_model->get_by_variationid($id_decode)->row();
		$this->data['variation_list'] = $this->Variation_model->get_all();
		/* Load Template */
		$this->template->admin_render('admin/variation/edit', $this->data);
		}
	}

	public function deactivate($id)
	{
		/* Cek Menu Show */
			$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id))
		{
			redirect('auth', 'refresh');
		}
		/* Breadcrumbs */

		$this->data['pagetitle'] = 'Ubah Status Variation';
		$this->breadcrumbs->unshift(2, 'Deactivate', 'admin/variation/deactivate');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		//if ($this->input->post('submit') =='update')
			if (isset($_POST) && ! empty($_POST))
		{
				if ( !$this->input->post('prompt') )
				{
					redirect('admin/variation', 'refresh');
				}else{
					if ( $this->input->post('active') == 0 )
					{
						$active = '1';
					}else{
						$active = '0';
					}
					$id_decode	= strtr($this->input->post('variation_id'),array('.' => '+', '-' => '=', '~' => '/'));
					$id_decode	= $this->encrypt->decode($id_decode);
						$this->data_update[1] = array(
								   'variation_id' => $id_decode,
								   'active' => $active,
								   'last_updated' => date('Y-m-d G:i:s')
						);

					if($this->Variation_model->update($this->data_update))
					{
						$this->session->set_flashdata('message', 'Status Berhasil Diedit');
						redirect('admin/variation', 'refresh');
					}
				}

		}else{

		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);
		$this->data['id_encode']	= $id;
		//Get One Data To Edit
		$this->data['one_variation']     = $this->Variation_model->get_by_variationid($id_decode)->row();

		/* Load Template */
		$this->template->admin_render('admin/variation/deactivate', $this->data);
		}
	}

}
