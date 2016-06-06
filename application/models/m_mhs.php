<?php

class m_mhs extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllMhs(){
        $this->db->select('TM.*,TK.kelas,TS.semester,TA.akademik');
        $this->db->from('mahasiswa TM');
        $this->db->join('kelas TK','TM.id_kelas = TK.kode');
        $this->db->join('semester TS','TM.id_semester = TS.kode');
        $this->db->join('akademik TA','TM.id_akademik = TA.kode');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getMhsByID($id){
        $this->db->select('TM.*,TK.kelas,TS.semester,TA.akademik');
        $this->db->from('mahasiswa TM');
        $this->db->join('kelas TK','TM.id_kelas = TK.kode');
        $this->db->join('semester TS','TM.id_semester = TS.kode');
        $this->db->join('akademik TA','TM.id_akademik = TA.kode');
        $this->db->where('TM.nim',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}
