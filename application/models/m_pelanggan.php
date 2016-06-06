<?php

class m_pelanggan extends CI_Model {
    function __construct() {
        parent::__construct();
		
        
    }

    function getAllPelanggan(){
        $this->db->select('*');
        $this->db->from('tblPelanggan TP');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getPelangganByID($id){
        $this->db->select('*');
        $this->db->from('tblPelanggan TP');
        $this->db->where('TP.PelangganID',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
	
	
	
	
    

    
}
