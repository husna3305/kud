<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kud_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $query = $this->db->get('data_kud');
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('condition',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('condition', $data, 'condition_id');
        return TRUE;
    }

}
