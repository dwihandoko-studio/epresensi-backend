<?php
class m_semester extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllSemester(){
        $this->db->select('*');
        $this->db->from('semester TS');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getSemesterByID($id){
        $this->db->select('*');
        $this->db->from('semester TS');
        $this->db->where('TS.kode',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}
?>