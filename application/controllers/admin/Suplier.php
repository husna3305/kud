<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suplier extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Load :: Common */
		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->load->model('admin/Suplier_model');
		$this->load->model('admin/Kud_model');


		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, 'Suplier', 'admin/suplier');

		/* Load Menus */
		$this->data['menus'] = $this->Menus_model->get_all();
		$this->data['kud'] = $this->Kud_model->get_all();
		
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
			$this->page_title->push('Data Suplier');
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['suplier'] = $this->Suplier_model->get_all();

			/* Load Template */
			$this->template->admin_render('admin/suplier/index', $this->data);
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
			$this->page_title->push('Data Suplier Yang Dihapus');
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['suplier_dihapus'] = $this->Suplier_model->get_suplier_dihapus();

			/* Load Template */
			$this->template->admin_render('admin/suplier/deleted', $this->data);
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
							   'id_suplier' => $value,
							   'aktif' => $aktif,
							   'user_id-upd' => $this->ion_auth->user()->row()->id,
							   'last_updated' => date('Y-m-d G:i:s')
					);
				}elseif ($status_aksi=='hapus') {
					$data_delete[$key] = array(
							   'id_suplier' => $value,
							   'deleted_status' => 1,
							   'user_id-del' => $this->ion_auth->user()->row()->id,
							   'last_deleted' => date('Y-m-d G:i:s')
					);
				}
				elseif ($status_aksi=='batal_hapus') {
					$data_canceldelete[$key] = array(
							   'id_suplier' => $value,
							   'deleted_status' => 0,
							   'user_id-del' => $this->ion_auth->user()->row()->id,
							   'last_deleted' => date('Y-m-d G:i:s')
					);
				}
			}

			if ($status_aksi=='nonaktif_all' or $status_aksi=='aktif_all') {
				if($this->Suplier_model->update($data))
				{
				  $this->session->set_flashdata('true', 'Status Berhasil Di Ubah');
				  redirect('admin/suplier', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Status Gagal Di Ubah");
				}
			}
			elseif ($status_aksi=='hapus') {
				if($this->Suplier_model->update($data_delete))
				{
				  $this->session->set_flashdata('true', 'Data Berhasil Di Hapus');
				  redirect('admin/suplier', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Data Gagal Di Hapus");
				}
			}

			elseif ($status_aksi=='batal_hapus') {
				if($this->Suplier_model->update($data_canceldelete))
				{
				  $this->session->set_flashdata('true', 'Data Berhasil Dikembalikan');
				  redirect('admin/suplier', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Data Gagal Di Hapus");
				}
			}

			elseif ($status_aksi=='hapus_permanen') {

				if($this->Suplier_model->delete($id_multi))
				{
				  $this->session->set_flashdata('true', 'Data Berhasil Di Hapus');
				  redirect('admin/suplier', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Data Gagal Di Hapus");
				}
			}
		}else{

			$this->session->set_flashdata('err', 'Silahkan pilih minimal satu baris data yang akan diproses.');
			redirect('admin/suplier', 'refresh');
		}
	}

	public function create()
	{
		/* Cek Menu Show */
		$this->show_menu_check();
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Create', 'admin/suplier/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		$this->page_title->push('&nbsp;');
		$this->data['pagetitle'] = $this->page_title->show();

		if ($this->input->post('nama_suplier')) {
			if ( !$this->input->post('aktif') )
			{
				$aktif = '0';
			}else{
				$aktif = '1';
			}
			$data[1] = array(
							   'nama_suplier' => $this->input->post('nama_suplier'),
							   'alamat' => $this->input->post('alamat'),
							   'no_telp' => $this->input->post('no_telp'),
							   'aktif' => $aktif,
							   'user_id-add' => $this->ion_auth->user()->row()->id,
							   'date_created' => date('Y-m-d G:i:s')
							   );
		
		   	if($this->Suplier_model->create($data))
			{
			  $this->session->set_flashdata('true', 'Data Berhasil Ditambah');
			  redirect('admin/suplier', 'refresh');
			}
			else
			{
			  $this->session->set_flashdata('err', "Data Gagal Ditambah");
			}
		}

		else
		{
			/* Load Template */
			$this->template->admin_render('admin/suplier/create', $this->data);
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

		$this->data['pagetitle'] = 'Form Update Data Suplier';
		$this->breadcrumbs->unshift(2, 'Update', 'admin/suplier/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		if (isset($_POST) && ! empty($_POST))
		{
			
			if ($this->input->post('nama_suplier') == TRUE)
			{
				if ( !$this->input->post('aktif') )
				{
					$aktif = '0';
				}else{
					$aktif = '1';
				}
				$data[1] = array(
							   'id_suplier' => $this->input->post('id_suplier'),
							   'nama_suplier' => $this->input->post('nama_suplier'),
							   'alamat' => $this->input->post('alamat'),
							   'no_telp' => $this->input->post('no_telp'),
							   'aktif' => $aktif,
							   'user_id-upd' => $this->ion_auth->user()->row()->id,
							   'last_updated' => date('Y-m-d G:i:s')
							   );
			   	if($this->Suplier_model->update($data))
				{
				  $this->session->set_flashdata('true', 'Data Berhasil Di Ubah');
				  redirect('admin/suplier', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Data Gagal Di Ubah");
				}
			} 
		}else{
		//Get One Data To Edit
		$this->data['suplier']  = $this->Suplier_model->get_by_id($id)->row();
		/* Load Template */
		$this->template->admin_render('admin/suplier/update', $this->data);
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
					   'id_suplier' => $this->input->post('id_suplier'),
					   'aktif' => $aktif,
					   'user_id-upd' => $this->ion_auth->user()->row()->id,
					   'last_updated' => date('Y-m-d G:i:s')
			);

			if($this->Suplier_model->update($this->data_update))
			{
				$this->session->set_flashdata('true', 'Status Berhasil Diedit');
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
		if ( $this->input->post('deleted_status') == 0 )
		{
			$deleted_status = 1;
		}else{
			$deleted_status = 0;
		}
		$this->data_del[1] = array(
				   'id_suplier' => $this->input->post('id_suplier'),
				   'deleted_status' => $deleted_status,
				   'user_id-del' => $this->ion_auth->user()->row()->id,
				   'last_deleted' => date('Y-m-d G:i:s')
		);

		if($this->Suplier_model->update($this->data_del))
		{
			$this->session->set_flashdata('true', 'Proses Berhasil');
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
		
		$id_suplier['id_suplier']=$this->input->post('id_suplier');
		if($this->Suplier_model->delete($id_suplier))
		{
			$this->session->set_flashdata('true', 'Data Berhasil Dihapus Permanen');
		} 
	}

}
