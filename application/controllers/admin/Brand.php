<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Brand extends Admin_Controller {



	public function __construct()

	{

		parent::__construct();



		/* Load :: Common */

		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->load->model('admin/Brand_model');

		/* Breadcrumbs :: Common */

		$this->breadcrumbs->unshift(1, 'Brand', 'admin/brand');



		/* Load Menus */

		$this->data['menus'] = $this->Menus_model->get_all();
		$this->data['menus_prefs'] = $this->Menus_preferences_model->get_all()->result();
		



		$this->load->library('upload');

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

			$this->page_title->push('Brand');

			$this->data['pagetitle'] = $this->page_title->show();



			/* Breadcrumbs */

			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			$this->data['brand_list'] = $this->Brand_model->get_all();



			/* Load Template */

			$this->template->admin_render('admin/brand/index', $this->data);

		}

	}

	public function create()

	{

		/* Cek Menu Show */

			$this->show_menu_check();

		/* Breadcrumbs */

		$this->breadcrumbs->unshift(2, 'Create', 'admin/brand/create');

		$this->data['breadcrumb'] = $this->breadcrumbs->show();



		$this->page_title->push('Tambah Brand Baru');

		$this->data['pagetitle'] = $this->page_title->show();

		$this->data['brand_list'] = $this->Brand_model->get_all();



		/* Validate form input */

		$this->form_validation->set_rules('name', 'Nama Kategori', 'required');

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



			//setting konfigurasi upload gambar

			$config['upload_path'] = './upload/brand/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

			$config['max_size']	= '8000';

			$config['max_width']  = '2000';

			$config['max_height']  = '1024';



			$this->upload->initialize($config);

			if(!$this->upload->do_upload('file_brand')){

				$logo_filename="";

			}else{

				$logo_filename=$this->upload->file_name;

			}



			$data[1] = array(

							   'name' => $this->input->post('name'),

							   'description' => $this->input->post('description'),

								 'logo_filename' => $logo_filename,

							   'active' => $active,

							   'order' => $this->input->post('order'),

							   'user_id' => $this->ion_auth->user()->row()->id,

							   'date_created' => date('Y-m-d G:i:s')

							   );

		   	if($this->Brand_model->create($data)){

				redirect('admin/brand', 'refresh');

			}

		}

		else

		{

			/* Load Template */

			$this->template->admin_render('admin/brand/create', $this->data);

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



		$this->data['pagetitle'] = 'Form Edit Brand';

		$this->breadcrumbs->unshift(2, 'Edit', 'admin/brand/edit');

		$this->data['breadcrumb'] = $this->breadcrumbs->show();



			if (isset($_POST) && ! empty($_POST))

		{

			/* Validate form input */

			$this->form_validation->set_rules('name', 'Nama Brand', 'required');



			if ($this->form_validation->run() == TRUE)

			{



				if ( !$this->input->post('active') )

				{

					$active = '0';

				}else{

					$active = '1';

				}
				$id_decode	= strtr($id,array('.' => '+', '-' => '=', '~' => '/'));

				$id_decode	= $this->encrypt->decode($id_decode);

				//setting konfigurasi upload gambar

				$config['upload_path'] = './upload/brand/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
				$config['max_size']	= '8000';
				$config['max_width']  = '3000';
				$config['max_height']  = '3024';

				$this->upload->initialize($config);

				if(!$this->upload->do_upload('file_brand')){
					$logo_filename=$this->input->post('filename_old');
				}else{
					$filename_old = $this->input->post('filename_old');
					$logo_filename=$this->upload->file_name;
					$link = FCPATH."upload/brand/".$filename_old;
					//$link = site_url('upload/brand/'.$filename_old);
					//$link = "upload/brand/$filename_old";
					if (is_file($link)) {
						unlink($link);
					}
			/*	else
					{
					    ?>
					<script type="text/javascript">
						alert("Gagal Menghapus File <?php  echo $filename_old; ?>");
					</script>
				        <?php
					} */

				}
				$data[1] = array(

									'brand_id' => $id_decode,
									 'name' => $this->input->post('name'),

									 'description' => $this->input->post('description'),

									 'logo_filename' => $logo_filename,

									 'active' => $active,

									 'order' => $this->input->post('order'),

									 'user_id' => $this->ion_auth->user()->row()->id,

									 'date_created' => date('Y-m-d G:i:s')

									 );

					if($this->Brand_model->update($data)){

					redirect('admin/brand', 'refresh');
				}
			}
		}else{



		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));

		$id_decode	= $this->encrypt->decode($id_decode);

		$this->data['id_encode']	= $id;

		//Get One Data To Edit

		$this->data['one_brand']  = $this->Brand_model->get_by_brandid($id_decode)->row();
		/* Load Template */

		$this->template->admin_render('admin/brand/edit', $this->data);

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



		$this->data['pagetitle'] = 'Ubah Status Brand';

		$this->breadcrumbs->unshift(2, 'Deactivate', 'admin/brand/deactivate');

		$this->data['breadcrumb'] = $this->breadcrumbs->show();



		//if ($this->input->post('submit') =='update')

			if (isset($_POST) && ! empty($_POST))

		{

				if ( !$this->input->post('prompt') )

				{

					redirect('admin/brand', 'refresh');

				}else{

					if ( $this->input->post('active') == 0 )

					{

						$active = '1';

					}else{

						$active = '0';

					}

					$id_decode	= strtr($this->input->post('menu_id'),array('.' => '+', '-' => '=', '~' => '/'));

					$id_decode	= $this->encrypt->decode($id_decode);

						$this->data_update[1] = array(

								   'brand_id' => $id_decode,

								   'active' => $active,

								   'last_updated' => date('Y-m-d G:i:s')

						);



					if($this->Brand_model->update($this->data_update))

					{

						$this->session->set_flashdata('message', 'Status Berhasil Diedit');

						redirect('admin/brand', 'refresh');

					}

				}



		}else{



		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));

		$id_decode	= $this->encrypt->decode($id_decode);

		$this->data['id_encode']	= $id;

		//Get One Data To Edit

		$this->data['one_brand']     = $this->Brand_model->get_by_brandid($id_decode)->row();



		/* Load Template */

		$this->template->admin_render('admin/brand/deactivate', $this->data);

		}

	}
	public function ajax()
	{
	    //setting konfigurasi upload gambar

			$config['upload_path'] = './upload/brand/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

			$config['max_size']	= '8000';

			$config['max_width']  = '2000';

			$config['max_height']  = '1024';



			$this->upload->initialize($config);

			if(!$this->upload->do_upload('img_product')){

				$logo_filename="";

			}else{

				$logo_filename=$this->upload->file_name;

			}
			echo $logo_filename;
			exit;

	}



}
