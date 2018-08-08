<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Load :: Common */
		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->load->model('admin/Kategori_model');
		$this->load->model('admin/Kud_model');

		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, 'Kategori', 'admin/kategori');

		/* Load Menus */
		$this->data['menus'] = $this->Menus_model->get_all();
		$this->data['menus_prefs'] = $this->Menus_preferences_model->get_all()->result();
		$this->data['kud'] = $this->Kud_model->get_all();
		
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
			$this->page_title->push('Kategori Barang');
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['root_kategori'] = $this->Kategori_model->get_root_kategori();

			/* Load Template */
			$this->template->admin_render('admin/kategori/index', $this->data);
		}
	}

	public function subkategori($id=null)
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->show_menu_check();
			$this->access_menu();
			/* Breadcrumbs */
			$this->data['get_parent_kategori'] = $this->Kategori_model->get_one_by_id($id)->row();
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['kategori']  = $this->Kategori_model->get_subkategori_by_parentid($id);
			/* Title Page */
			$this->page_title->push($this->data['get_parent_kategori']->nama_kategori);
			$this->data['pagetitle'] = $this->page_title->show();

			/* Load Template */
			$this->template->admin_render('admin/kategori/subkategori', $this->data);
		}
	}

	public function deleted()
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
			$this->page_title->push('Kategori Barang Yang Dihapus');
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['kategori_dihapus'] = $this->Kategori_model->get_kategori_dihapus();

			/* Load Template */
			$this->template->admin_render('admin/kategori/deleted', $this->data);
		}
	}

	public function aksi_masal()
	{
		$length = $this->input->post('data_table_length');
		$id = $this->input->post('id');
		$status_aksi = $this->input->post('status_aksi');
		if (!!$id) {
			foreach ($id as $key => $value) {
				$id_multi[$key] = $value;
				if ($status_aksi=='nonaktif_all') {
					$aktif=0;
				}elseif ($status_aksi=='aktif_all') {
					$aktif=1;
				}

				if ($status_aksi=='nonaktif_all' or $status_aksi=='aktif_all') {
					$data[$key] = array(
							   'id_kategori' => $value,
							   'aktif' => $aktif,
							   'user_id-upd' => $this->ion_auth->user()->row()->id,
							   'last_updated' => date('Y-m-d G:i:s')
					);
				}elseif ($status_aksi=='hapus') {
					$data_delete[$key] = array(
							   'id_kategori' => $value,
							   'delete_status' => 1,
							   'user_id-del' => $this->ion_auth->user()->row()->id,
							   'last_deleted' => date('Y-m-d G:i:s')
					);
				}elseif ($status_aksi=='batal_hapus') {
					$data_delete[$key] = array(
							   'id_kategori' => $value,
							   'delete_status' => 0,
							   'user_id-del' => $this->ion_auth->user()->row()->id,
							   'last_deleted' => date('Y-m-d G:i:s')
					);
				}
			}

			if ($status_aksi=='nonaktif_all' or $status_aksi=='aktif_all') {
				if($this->Kategori_model->update($data))
				{
				  $this->session->set_flashdata('true', 'Status Berhasil Di Ubah');
				  redirect('admin/kategori', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Status Gagal Di Ubah");
				}
			}
			elseif ($status_aksi=='hapus') {
				if($this->Kategori_model->update($data_delete))
				{
				  $this->session->set_flashdata('true', 'Data Berhasil Di Hapus');
				  redirect('admin/kategori', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Data Gagal Di Hapus");
				}
			}

			elseif ($status_aksi=='hapus_permanen') {

				if($this->Kategori_model->delete($id_multi))
				{
				  $this->session->set_flashdata('true', 'Data Berhasil Di Hapus');
				  redirect('admin/kategori', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Data Gagal Di Hapus");
				}
			}
			elseif ($status_aksi=='batal_hapus') {
				if($this->Kategori_model->update($data_delete))
				{
				  $this->session->set_flashdata('true', 'Data Berhasil Di Hapus');
				  redirect('admin/kategori', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Data Gagal Di Hapus");
				}
			}
		}else{

			$this->session->set_flashdata('err', 'Silahkan pilih minimal satu baris data yang akan diproses.');
			redirect('admin/kategori', 'refresh');
		}
	}
	
	public function search_root_kategori()
	{
		$data['root_kategori'] = $this->Kategori_model->get_root_kategori_aktif();
		$data['kategori'] = $this->Kategori_model->get_kategori_aktif();
		$this->load->view('admin/kategori/content_search_kategori',$data);
	}

	public function create()
	{
		/* Cek Menu Show */
			$this->show_menu_check();
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Create', 'admin/kategori/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		$this->page_title->push('&nbsp;');
		$this->data['pagetitle'] = $this->page_title->show();
		$this->data['root_kategori'] = $this->Kategori_model->get_root_kategori_aktif();

		if ($this->input->post('nama_kategori_baru')) {
			if ( !$this->input->post('aktif') )
			{
				$aktif = '0';
			}else{
				$aktif = '1';
			}
			$data[1] = array(
							   'nama_kategori' => $this->input->post('nama_kategori_baru'),
							   'parent_id' => $this->input->post('parent_id'),
							   'aktif' => $aktif,
							   'user_id-add' => $this->ion_auth->user()->row()->id,
							   'date_created' => date('Y-m-d G:i:s')
							   );
		
		   	if($this->Kategori_model->create($data))
			{
			  $this->session->set_flashdata('true', 'Data Berhasil Ditambah');
			  redirect('admin/kategori', 'refresh');
			}
			else
			{
			  $this->session->set_flashdata('err', "Data Gagal Ditambah");
			}
		}

		else
		{
			/* Load Template */
			$this->template->admin_render('admin/kategori/create', $this->data);
		}
	}




	public function update($id)
	{
		/* Cek Menu Show */
			$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id))
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();
		/* Breadcrumbs */

		$this->data['pagetitle'] = 'Form Edit Kategori';
		$this->breadcrumbs->unshift(2, 'Edit', 'admin/menus/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		if (isset($_POST) && ! empty($_POST))
		{
			
			if ($this->input->post('nama_kategori_baru') == TRUE)
			{
				if ( !$this->input->post('parent_id') )
				{

					$parent_id=0;
				}else
				{
					$parent_id = $this->input->post('parent_id');
				}

				if ( !$this->input->post('aktif') )
				{
					$aktif = '0';
				}else{
					$aktif = '1';
				}
				$data[1] = array(
							   'id_kategori' => $this->input->post('id_kategori'),
							   'nama_kategori' => $this->input->post('nama_kategori_baru'),
							   'parent_id' => $parent_id,
							   'aktif' => $aktif,
							   'user_id-upd' => $this->ion_auth->user()->row()->id,
							   'last_updated' => date('Y-m-d G:i:s')
							   );
			   	if($this->Kategori_model->update($data))
				{
				  $this->session->set_flashdata('true', 'Data Berhasil Di Ubah');
				  redirect('admin/kategori', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Data Gagal Di Ubah");
				}
			} 
		}else{
		//Get One Data To Edit
		$this->data['kategori']  = $this->Kategori_model->get_by_id($id)->row();
		/* Load Template */
		$this->template->admin_render('admin/kategori/update', $this->data);
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
			if ( $this->input->post('aktif') == 0 )
			{
				$aktif = 1;
			}else{
				$aktif = 0;
			}
			$this->data_update[1] = array(
					   'id_kategori' => $this->input->post('id_kategori'),
					   'aktif' => $aktif,
					   'user_id-upd' => $this->ion_auth->user()->row()->id,
					   'last_updated' => date('Y-m-d G:i:s')
			);

			if($this->Kategori_model->update($this->data_update))
			{
				echo $this->session->set_flashdata('true', 'Status Berhasil Diedit');
				//redirect('admin/product', 'refresh');
			}
	}

	public function setDelete()
	{
		/* Cek Menu Show */
		$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();
		if ( $this->input->post('delete_status') == 0 )
		{
			$delete_status = 1;
		}else{
			$delete_status = 0;
		}
		$this->data_del[1] = array(
				   'id_kategori' => $this->input->post('id_kategori'),
				   'delete_status' => $delete_status,
				   'user_id-del' => $this->ion_auth->user()->row()->id,
				   'last_deleted' => date('Y-m-d G:i:s')
		);

		if($this->Kategori_model->update($this->data_del))
		{
			echo $this->session->set_flashdata('true', 'Proses Berhasil');
			redirect('admin/kategori', 'refresh');
		}
	}

	public function delete_permanen()
	{
		/* Cek Menu Show */
		$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();
		
		$id_kategori['id_kategori']=$this->input->post('id_kategori');
		if($this->Kategori_model->delete($id_kategori))
		{
			echo $this->session->set_flashdata('true', 'Data Berhasil Dihapus Permanen');
			redirect('admin/kategori', 'refresh');
		} 
	}

}
