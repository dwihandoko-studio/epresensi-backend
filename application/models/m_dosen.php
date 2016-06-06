<?php

class m_dosen extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllDosen(){
        $this->db->select('TD.*,TJ.jabatan');
        $this->db->from('dosen TD');
		$this->db->join('jabatan TJ','TD.id_jabatan = TJ.kode');
        $que = $this->db->get()->result_array();
        return $que; 
    }

    function getDosenByID($id){
        $this->db->select('TD.*,TJ.jabatan');
        $this->db->from('dosen TD');
		$this->db->join('jabatan TJ','TD.id_jabatan = TJ.kode');
        $this->db->where('TD.nip',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}
