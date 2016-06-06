<?php
class m_kehadiran extends CI_Model {
    function __construct() {
        parent::__construct();   
    }

    function getAllKehadiran(){
        $this->db->select('TK.*,TM.nama_mhs,TR.kelas,MK.mata_kuliah,TD.nama_dosen');
        $this->db->from('kehadiran TK');
        $this->db->join('mahasiswa TM','TK.nim = TM.nim');
        $this->db->join('jadwal TJ','TK.id_jadwal = TJ.kode');
        $this->db->join('kelas TR','TJ.id_kelas = TR.kode');
        $this->db->join('mata_kuliah MK','TJ.id_mk = MK.kode');
        $this->db->join('dosen TD','TJ.id_dosen = TD.nip');
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