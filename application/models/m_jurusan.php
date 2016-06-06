<?php
class m_jurusan extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllJurusan(){
        $this->db->select('*');
        $this->db->from('jurusan TJ');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getJurusanByID($id){
        $this->db->select('*');
        $this->db->from('jurusan TJ');
        $this->db->where('TJ.kode',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}
?>