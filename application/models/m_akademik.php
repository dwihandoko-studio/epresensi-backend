<?php
class m_akademik extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllAkademik(){
        $this->db->select('*');
        $this->db->from('akademik TA');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getAkademikByID($id){
        $this->db->select('*');
        $this->db->from('akademik TA');
        $this->db->where('TA.kode',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}
?>