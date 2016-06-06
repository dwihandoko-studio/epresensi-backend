<?php

class m_prodi extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllProdi(){
        $this->db->select('TP.*,TJ.jurusan');
        $this->db->from('prodi TP');
		$this->db->join('jurusan TJ', 'TP.id_jurusan = TJ.kode');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getProdiByID($id){
        $this->db->select('TP.*,TJ.jurusan');
        $this->db->from('prodi TP');
		$this->db->join('jurusan TJ', 'TP.id_jurusan = TJ.kode');
        $this->db->where('TP.kode',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}
