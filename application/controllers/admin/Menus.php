<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Load :: Common */
		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->lang->load('admin/menus');
        $this->load->model('admin/Kud_model');

		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, lang('menu_title'), 'admin/menus');
		
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
			$this->page_title->push(lang('menu_title'));
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['menus_list'] = $this->Menus_model->get_all();

			/* Load Template */
			$this->template->admin_render('admin/menus/index', $this->data);
		}
	}
	
	public function access()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->show_menu_check();
			/* Title Page */
			$this->page_title->push(lang('menu_title'));
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['menus_list'] = $this->Menus_model->get_all();
			$this->data['menus_prefs'] = $this->Menus_preferences_model->get_all()->result();
			$this->data['menus_prefs_num_rows'] = $this->Menus_preferences_model->get_all()->num_rows();
			$this->data['groups']     = $this->ion_auth->groups()->result();
			
			foreach( $this->data['groups'] as $groups_val )
			{
				foreach( $this->data['menus_list'] as $menus_list_val )
				{
					if ( $this->Menus_preferences_model->get_by_menuid_groupid($menus_list_val->menu_id, $groups_val->id)->num_rows() > 0 )
					{
						$this->data['menus_selection'] = $this->Menus_preferences_model->get_by_menuid_groupid($menus_list_val->menu_id, $groups_val->id)->result();
					}
					
				}
			}
			/* Load Template */
			$this->template->admin_render('admin/menus/access', $this->data);
		}
	}
	public function ajaxShowContentAccess()
	{
		$group_id= $this->input->post('group_id');
		$this->data['menus_list'] = $this->Menus_model->get_all();
		$this->data['menus_prefs'] = $this->Menus_preferences_model->get_all()->result();
		$this->data['menus_prefs_num_rows'] = $this->Menus_preferences_model->get_all()->num_rows();
		$this->data['group_id']     = $group_id;
		$this->data['group_name']     = $this->input->post('group_name');
		$this->load->view("admin/menus/content_acccess",$this->data);

	}

	public function ajaxChangeAccess ()
	{
		$menu_id= $this->input->post('menu_id');
		$group_id= $this->input->post('group_id');
		$status_change= $this->input->post('status_change');
		
		$rows =  $this->Menus_preferences_model->get_by_menuid_groupid($menu_id, $group_id)->num_rows();
	   	// Ubah Status Show Menu Akses
		if ($status_change=='show') {
			if ( $rows == 0 )
			{
					$data[1] = array(
								   'menu_id' => $menu_id, 
								   'group_id' => $group_id,
								   'show' => '1',
								   );   			
				$this->Menus_preferences_model->create($data);
			}
			else
			{
				$row_menus =  $this->Menus_preferences_model->get_by_menuid_groupid($menu_id, $group_id)->row();
				if ( $row_menus->show == '1' )
				{
					$show = '0';
				}
				elseif ( $row_menus->show == '0' )
				{
					$show = '1';
				}
				elseif ( $row_menus->show == null )
				{
					$show = '1';
				}
					$data[1] = array(
								   'id' => $row_menus->id, 
								   'menu_id' => $row_menus->menu_id, 
								   'group_id' => $row_menus->group_id,
								   'show' => $show,
								   );   			
					$this->Menus_preferences_model->edit($data);
			}
		}
		// Ubah Status Insert Menu Akses
		if ($status_change=='inserted') {
			if ( $rows == 0 )
			{
					$data[1] = array(
								   'menu_id' => $menu_id, 
								   'group_id' => $group_id,
								   'inserted' => '1',
								   );   			
				$this->Menus_preferences_model->create($data);
			}
			else
			{
				$row_menus =  $this->Menus_preferences_model->get_by_menuid_groupid($menu_id, $group_id)->row();
				if ( $row_menus->inserted == '1' )
				{
					$inserted = '0';
				}
				elseif ( $row_menus->inserted == '0' )
				{
					$inserted = '1';
				}
				elseif ( $row_menus->inserted == null )
				{
					$inserted = '1';
				}
					$data[1] = array(
								   'id' => $row_menus->id, 
								   'menu_id' => $row_menus->menu_id, 
								   'group_id' => $row_menus->group_id,
								   'inserted' => $inserted,
								   );   			
					$this->Menus_preferences_model->edit($data);
			}
		}
		// Ubah Status Edit Menu Akses
		if ($status_change=='edited') {
			if ( $rows == 0 )
			{
					$data[1] = array(
								   'menu_id' => $menu_id, 
								   'group_id' => $group_id,
								   'edited' => '1',
								   );   			
				$this->Menus_preferences_model->create($data);
			}
			else
			{
				$row_menus =  $this->Menus_preferences_model->get_by_menuid_groupid($menu_id, $group_id)->row();
				if ( $row_menus->edited == '1' )
				{
					$edited = '0';
				}
				elseif ( $row_menus->edited == '0' )
				{
					$edited = '1';
				}
				elseif ( $row_menus->edited == null )
				{
					$edited = '1';
				}
					$data[1] = array(
								   'id' => $row_menus->id, 
								   'menu_id' => $row_menus->menu_id, 
								   'group_id' => $row_menus->group_id,
								   'edited' => $edited,
								   );   			
					$this->Menus_preferences_model->edit($data);
			}
		}
		// Ubah Status Insert Menu Akses
		if ($status_change=='deleted') {
			if ( $rows == 0 )
			{
					$data[1] = array(
								   'menu_id' => $menu_id, 
								   'group_id' => $group_id,
								   'deleted' => '1',
								   );   			
				$this->Menus_preferences_model->create($data);
			}
			else
			{
				$row_menus =  $this->Menus_preferences_model->get_by_menuid_groupid($menu_id, $group_id)->row();
				if ( $row_menus->deleted == '1' )
				{
					$deleted = '0';
				}
				elseif ( $row_menus->deleted == '0' )
				{
					$deleted = '1';
				}
				elseif ( $row_menus->deleted == null )
				{
					$deleted = '1';
				}
					$data[1] = array(
								   'id' => $row_menus->id, 
								   'menu_id' => $row_menus->menu_id, 
								   'group_id' => $row_menus->group_id,
								   'deleted' => $deleted,
								   );   			
					$this->Menus_preferences_model->edit($data);
			}
		}
		 //echo $this->input->post('menu_id')."|".$this->input->post('group_id')."|".$show;
		  $reponse = array(
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash()
				);
		   echo json_encode($reponse);
			  exit;
	}
	
	public function create()
	{
		/* Cek Menu Show */
			$this->show_menu_check();
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Create', 'admin/menu/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		
		$this->page_title->push('Menu Baru');
		$this->data['pagetitle'] = $this->page_title->show();
		$this->data['menus_parent'] = $this->Menus_model->get_is_parent()->result();
		$this->data['menus_header'] = $this->Menus_model->get_is_header()->result();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('name', 'Nama Menu', 'required');
		$this->form_validation->set_rules('link', 'Link Menu', '');
		$this->form_validation->set_rules('order', 'Order', 'required');
		$this->form_validation->set_rules('fa_icon', 'Ikon', '');
	   /* $this->form_validation->set_rules('last_name', 'lang:users_lastname', 'required');
		$this->form_validation->set_rules('email', 'lang:users_email', 'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('phone', 'lang:users_phone', 'required');
		$this->form_validation->set_rules('company', 'lang:users_company', 'required');
		$this->form_validation->set_rules('password', 'lang:users_password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'lang:users_password_confirm', 'required');
*/
		if ($this->form_validation->run() == TRUE)
		{
		   
			if ( !$this->input->post('is_parent') )
			{
				$is_parent = '0';
				$parent_id = $this->input->post('parent_id');
				
			}else{
				
				$is_parent = '1';
				$parent_id = 0;
			}
		 
			if ( !$this->input->post('is_dropdown') )
			{
				$is_dropdown = '0';
			}else{
				$is_dropdown = '1';
			}
		   
			if ( !$this->input->post('is_menu_header') )
			{
				if ( $parent_id > 0 )
				{
					$is_menu_header = '0';
					$menu_header_id = 0;
				}else{
				$is_menu_header = '0';
				$menu_header_id = $this->input->post('menu_header_id');
				}
				
				
			}else{
				$is_menu_header = '1';
				$menu_header_id = $this->input->post('menu_header_id');
			}
			
			if ( !$this->input->post('active') )
			{
				$active = '0';
			}else{
				$active = '1';
			}
			$data[1] = array(
							   'name' => $this->input->post('name'), 
							   'link' => $this->input->post('link'),
							   'is_parent' => "$is_parent",
							   'parent_id' => $parent_id,
							   'is_dropdown' => "$is_dropdown",
							   'is_menu_header' => "$is_menu_header",
							   'menu_header_id' => $menu_header_id,
							   'fa_icon' => $this->input->post('fa_icon'),
							   'order' => $this->input->post('order'),
							   'active' => $active,
							   'date_created' => date('Y-m-d G:i:s')
							   );   			
		   $this->Menus_model->create($data);
			redirect('admin/menus', 'refresh');
			exit;
		}
		else
		{
			/* Load Template */
			$this->template->admin_render('admin/menus/create', $this->data);
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
		
		$this->data['pagetitle'] = 'Form Edit Menu';
		$this->breadcrumbs->unshift(2, 'Edit', 'admin/menus/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		
		//if ($this->input->post('submit') =='update')
			if (isset($_POST) && ! empty($_POST))
		{
			/* Validate form input */
			$this->form_validation->set_rules('name', 'Nama Menu', 'required');
			$this->form_validation->set_rules('link', 'Link Menu', '');
			$this->form_validation->set_rules('order', 'Order', 'required');
			$this->form_validation->set_rules('fa_icon', 'Ikon', '');
			if ($this->form_validation->run() == TRUE)
			{
				if ( !$this->input->post('is_parent') )
				{
					$is_parent = '0';
					$parent_id = $this->input->post('parent_id');
					
				}else{
					
					$is_parent = '1';
					$parent_id = 0;
				}
			 
				if ( !$this->input->post('is_dropdown') )
				{
					$is_dropdown = '0';
				}else{
					$is_dropdown = '1';
				}
			   
				if ( !$this->input->post('is_menu_header') )
				{
					if ( $parent_id > 0 )
					{
						$is_menu_header = '0';
						$menu_header_id = 0;
					}else{
					$is_menu_header = '0';
					$menu_header_id = $this->input->post('menu_header_id');
					}
					
					
				}else{
					$is_menu_header = '1';
					$menu_header_id = $this->input->post('menu_header_id');
				}
				
				if ( !$this->input->post('active') )
				{
					$active = '0';
				}else{
					$active = '1';
				}
				$id_decode	= strtr($this->input->post('menu_id'),array('.' => '+', '-' => '=', '~' => '/'));
				$id_decode	= $this->encrypt->decode($id_decode);
					$this->data_update[1] = array(
							'menu_id' => $id_decode,
							'name'  => $this->input->post('name'),
							   'link' => $this->input->post('link'),
							   'is_parent' => "$is_parent",
							   'parent_id' => $parent_id,
							   'is_dropdown' => "$is_dropdown",
							   'is_menu_header' => "$is_menu_header",
							   'menu_header_id' => $menu_header_id,
							   'fa_icon' => $this->input->post('fa_icon'),
							   'order' => $this->input->post('order'),
							   'active' => $active,
							   'last_updated' => date('Y-m-d G:i:s')
					);
								
				if($this->Menus_model->update($this->data_update))
				{
					$this->session->set_flashdata('message', 'Data Berhasil Diedit');
					redirect('admin/menus', 'refresh');
				}
			}
		}else{
		
		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);
		$this->data['id_encode']	= $id;
		//Get One Data To Edit
		$this->data['one_menu']     = $this->Menus_model->get_by_menuid($id_decode)->row();
		
		$this->data['menus_parent'] = $this->Menus_model->get_is_parent()->result();
		$this->data['menus_header'] = $this->Menus_model->get_is_header()->result();
		/* Load Template */
		$this->template->admin_render('admin/menus/edit', $this->data);
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
		$this->show_menu_check();
		/* Breadcrumbs */
		
		$this->data['pagetitle'] = 'Ubah Status Menu';
		$this->breadcrumbs->unshift(2, 'Deactivate', 'admin/menus/deactivate');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		
		//if ($this->input->post('submit') =='update')
			if (isset($_POST) && ! empty($_POST))
		{
				if ( !$this->input->post('prompt') )
				{
					redirect('admin/menus', 'refresh');
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
								'menu_id' => $id_decode,
								   'active' => $active,
								   'last_updated' => date('Y-m-d G:i:s')
						);
									
					if($this->Menus_model->update($this->data_update))
					{
						$this->session->set_flashdata('message', 'Status Berhasil Diedit');
						redirect('admin/menus', 'refresh');
					}
				}
				
		}else{
		
		$id_decode = strtr($id,array('.' => '+', '-' => '=', '~' => '/'));
		$id_decode	= $this->encrypt->decode($id_decode);
		$this->data['id_encode']	= $id;
		//Get One Data To Edit
		$this->data['one_menu']     = $this->Menus_model->get_by_menuid($id_decode)->row();
		
		/* Load Template */
		$this->template->admin_render('admin/menus/deactivate', $this->data);
		}
	}
	
}
