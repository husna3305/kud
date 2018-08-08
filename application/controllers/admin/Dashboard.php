<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->helper('number');
        $this->load->model('admin/dashboard_model');
        $this->load->model('admin/Menus_model');
        $this->load->model('admin/Menus_preferences_model');
        $this->load->model('admin/Kud_model');
        
        
        /* Load Menus */
        $this->data['menus'] = $this->Menus_model->get_all();
        $this->data['kud'] = $this->Kud_model->get_all();
        
        $this->data['menus_prefs'] = $this->Menus_preferences_model->get_all()->result();
        
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Title Page */
            $this->page_title->push(lang('menu_dashboard'));
            $this->data['pagetitle'] = $this->page_title->show();

            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['active_menu']      = 'dashboard';
            $this->data['count_users']       = $this->dashboard_model->get_count_record('users');
            $this->data['count_groups']      = $this->dashboard_model->get_count_record('groups');
           

            /* TEST */
            $this->data['url_exist']    = is_url_exist('http://www.domprojects.com');


            /* Load Template */
            $this->template->admin_render('admin/dashboard/index', $this->data);
        }
	}
}
