<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Topproduct extends Admin_Controller {



	public function __construct()

	{

		parent::__construct();



		/* Load :: Common */

		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->load->model('admin/Top_product_model');
		$this->load->model('admin/Product_model');





		/* Breadcrumbs :: Common */

		$this->breadcrumbs->unshift(1, 'Produk Teratas', 'admin/topproduct');



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



	public function index()

	{

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())

		{

			redirect('auth/login', 'refresh');

		}

		else

		{

			$this->show_menu_check();

			/* Title Page */

			$this->page_title->push('Produk Teratas');

			$this->data['pagetitle'] = $this->page_title->show();



			/* Breadcrumbs */

			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['top_product_list'] = $this->Top_product_model->get_active()->result();



			/* Load Template */

			$this->template->admin_render('admin/topproduct/index', $this->data);

		}

	}

	public function create()

	{

		// Cek Menu Show 

			$this->show_menu_check();

		// Breadcrumbs 

		$this->breadcrumbs->unshift(2, 'Create', 'admin/topproduct/create');

		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->page_title->push('Tambah Produk Teratas Baru');

		$this->data['pagetitle'] = $this->page_title->show();

		// Validate form input 

		$this->form_validation->set_rules('product_id', 'Nama Kategori', 'required');
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

							   'product_id' => $this->input->post('product_id'),
							   'active' => $active,
							   'order' => $this->input->post('order'),
							   );

		   	if($this->Top_product_model->create($data)){

				redirect('admin/topproduct', 'refresh');

			}

		}

		else

		{

			/* Load Template */
			$this->template->admin_render('admin/topproduct/create', $this->data);

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



		$this->data['pagetitle'] = 'Form Edit Produk Teratas';

		$this->breadcrumbs->unshift(2, 'Edit', 'admin/top_product/edit');

		$this->data['breadcrumb'] = $this->breadcrumbs->show();



			if (isset($_POST) && ! empty($_POST))

		{

			/* Validate form input */

			$this->form_validation->set_rules('name', 'Nama Produk Teratas', 'required');



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

				$config['upload_path'] = './upload/top_product/';

				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

				$config['max_size']	= '8000';

				$config['max_width']  = '3000';

				$config['max_height']  = '3024';



				$this->upload->initialize($config);

				if(!$this->upload->do_upload('file_top_product')){
					$logo_filenamme=$this->input->post('filename_old');
				}else{
					$filename_old = $this->input->post('filename_old');
					$logo_filename=$this->upload->file_name;
					$link = FCPATH."upload/top_product/".$filename_old;
					//$link = site_url('upload/top_product/'.$filename_old);
					//$link = "upload/top_product/$filename_old";
					if(!unlink($link))
					{
					    ?> 
					<script type="text/javascript">
						alert("Gagal Menghapus File <?php  echo $filename_old; ?>");			
					</script>
				        <?php
					}

				}
				$data[1] = array(

									'top_product_id' => $id_decode,
									 'name' => $this->input->post('name'),

									 'description' => $this->input->post('description'),

									 'logo_filename' => $logo_filename,

									 'active' => $active,

									 'order' => $this->input->post('order'),

									 'user_id' => $this->ion_auth->user()->row()->id,

									 'date_created' => date('Y-m-d G:i:s')

									 );

					if($this->Top_product_model->update($data)){

					redirect('admin/top_product', 'refresh');
				}
			}
		}else{



		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));

		$id_decode	= $this->encrypt->decode($id_decode);

		$this->data['id_encode']	= $id;

		//Get One Data To Edit

		$this->data['one_top_product']  = $this->Top_product_model->get_by_top_productid($id_decode)->row();
		/* Load Template */

		$this->template->admin_render('admin/top_product/edit', $this->data);

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



		$this->data['pagetitle'] = 'Ubah Status Produk Teratas';

		$this->breadcrumbs->unshift(2, 'Deactivate', 'admin/top_product/deactivate');

		$this->data['breadcrumb'] = $this->breadcrumbs->show();



		//if ($this->input->post('submit') =='update')

			if (isset($_POST) && ! empty($_POST))

		{

				if ( !$this->input->post('prompt') )

				{

					redirect('admin/top_product', 'refresh');

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

								   'top_product_id' => $id_decode,

								   'active' => $active,

								   'last_updated' => date('Y-m-d G:i:s')

						);



					if($this->Top_product_model->update($this->data_update))

					{

						$this->session->set_flashdata('message', 'Status Berhasil Diedit');

						redirect('admin/top_product', 'refresh');

					}

				}



		}else{



		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));

		$id_decode	= $this->encrypt->decode($id_decode);

		$this->data['id_encode']	= $id;

		//Get One Data To Edit

		$this->data['one_top_product']     = $this->Top_product_model->get_by_top_productid($id_decode)->row();



		/* Load Template */

		$this->template->admin_render('admin/top_product/deactivate', $this->data);

		}

	}
	
	public function ajaxSearchProduct()
	{
		$this->data['product_list'] = $this->Product_model->get_all_search()->result();
		$this->load->view("admin/topproduct/search_product",$this->data);
	}



}
