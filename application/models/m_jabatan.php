<?php

class m_jabatan extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllJabatan(){
        $this->db->select('*');
        $this->db->from('jabatan TJ');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getJabatanByID($id){
        $this->db->select('*');
        $this->db->from('jabatan TJ');
        $this->db->where('TJ.kode',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
}
