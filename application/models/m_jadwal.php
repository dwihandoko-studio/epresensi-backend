<?php

class m_jadwal extends CI_Model {
    function __construct() {
        parent::__construct();   
    } 
	
	function getAllHari(){
        $this->db->select('*');
        $this->db->from('hari');
        $que = $this->db->get()->result_array();
        return $que;
	}
	
    function getAllJadwal(){
        $this->db->select('TJ.*,TK.kelas,TR.ruangan,TM.mata_kuliah,TD.nama_dosen,TH.nama_hari');
        $this->db->from('jadwal TJ');
        $this->db->join('kelas TK','TJ.id_kelas = TK.kode');
        $this->db->join('ruangan TR','TJ.id_ruangan = TR.kode');
        $this->db->join('mata_kuliah TM','TJ.id_mk = TM.kode');
        $this->db->join('dosen TD','TJ.id_dosen = TD.nip');
        $this->db->join('hari TH','TJ.hari = TH.kode');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	function getAllJadwalByKelas($get_param){
        $this->db->select('TJ.*,TK.kelas,TR.ruangan,TM.mata_kuliah,TD.nama_dosen,TR.latlong_a,TR.latlong_b');
        $this->db->from('jadwal TJ');
        $this->db->join('kelas TK','TJ.id_kelas = TK.kode');
        $this->db->join('ruangan TR','TJ.id_ruangan = TR.kode');
        $this->db->join('mata_kuliah TM','TJ.id_mk = TM.kode');
        $this->db->join('dosen TD','TJ.id_dosen = TD.nip');
        $this->db->where('TJ.id_kelas',$get_param['kelas_id']);
        $this->db->where('TJ.jadwal_day >=',$get_param['tglawal']);
        $this->db->where('TJ.jadwal_day <=',$get_param['tglakhir']);
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	function getAllJadwalByToday($get_param){
        $this->db->select('*,TK.kelas,TR.ruangan,TM.mata_kuliah,TD.nama_dosen');
        $this->db->from('jadwal TJ');
        $this->db->join('kelas TK','TJ.id_kelas = TK.kode');
        $this->db->join('ruangan TR','TJ.id_ruangan = TR.kode');
        $this->db->join('mata_kuliah TM','TJ.id_mk = TM.kode');
        $this->db->join('dosen TD','TJ.id_dosen = TD.nip');
        $this->db->where('TJ.id_ruangan',$get_param['kelas_id']);
        $this->db->where('TJ.jadwal_day',date('Y-m-d'));
        $this->db->where('TJ.jadwal_start <=',date('h:i:s'));
        $this->db->where('TJ.jadwal_finish >=',date('h:i:s'));
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getJadwalByID($id){
        $this->db->select('TJ.*,TK.kelas,TR.ruangan,TM.mata_kuliah,TD.nama_dosen,TS.semester,TA.akademik,TH.nama_hari');
        $this->db->from('jadwal TJ');
        $this->db->join('kelas TK','TJ.id_kelas = TK.kode');
        $this->db->join('ruangan TR','TJ.id_ruangan = TR.kode');
        $this->db->join('mata_kuliah TM','TJ.id_mk = TM.kode');
        $this->db->join('dosen TD','TJ.id_dosen = TD.nip');
        $this->db->join('semester TS','TJ.id_semester = TS.kode');
        $this->db->join('akademik TA','TJ.id_akademik = TA.kode');
        $this->db->join('hari TH','TJ.hari = TH.kode');
        $this->db->where('TJ.kode',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
	
	 function getLocation($get_param){
        $this->db->select('*,TK.kelas,TR.ruangan,TM.mata_kuliah,TD.nama_dosen');
        $this->db->from('jadwal TJ');
        $this->db->join('kelas TK','TJ.id_kelas = TK.kode');
        $this->db->join('mhs TS','TS.kelas_id = TK.kode');
        $this->db->join('ruangan TR','TR.kode = TJ.id_ruangan');
        $this->db->join('mata_kuliah TM','TJ.id_mk = TM.kode');
        $this->db->join('dosen TD','TJ.id_dosen = TD.nip');
        $this->db->where('TJ.jadwal_id',$get_param['jadwal_id']);
        $this->db->where('TJ.id_kelas',$get_param['kelas_id']);
        $this->db->where('TS.mhs_id',$get_param['mhs_id']);
        $this->db->where('TR.ruangan_latlng1',$get_param['latitude']);
        $this->db->where('TR.ruangan_latlng2',$get_param['longitude']);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}
