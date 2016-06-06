<?php

class m_matkul extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllMatkul(){
        $this->db->select('*');
        $this->db->from('mata_kuliah MK');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getMatkulByID($id){
        $this->db->select('*');
        $this->db->from('mata_kuliah MK');
        $this->db->where('MK.kode',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}
