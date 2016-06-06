<?php

class m_kelas extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllKelas(){
        $this->db->select('TK.*,TP.prodi');
        $this->db->from('kelas TK');
		$this->db->join('prodi TP','TK.id_prodi = TP.kode');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getKelasByID($id){
        $this->db->select('TK.*,TP.prodi');
        $this->db->from('kelas TK');
		$this->db->join('prodi TP','TK.id_prodi = TP.kode');
        $this->db->where('TK.kode',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}
