<?php

class m_ruangan extends CI_Model {
    function __construct() {
        parent::__construct();   
        date_default_timezone_set('Asia/Jakarta');
    }

    function getAllRuangan(){
        $this->db->select('*');
        $this->db->from('ruangan TR');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
    function getRuanganByID($id){
        $this->db->select('*');
        $this->db->from('ruangan TR');
        $this->db->where('TR.kode',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

}

/*
	function getAllRoomByStatus(){
		//if($get_param['TipeRuangan'] == '1'){
			$this->db->select('*');
			$this->db->from('room TR');
			$que = $this->db->get()->result_array();
			return $que;
		// }elseif($get_param['TipeRuangan'] == '2'){
			// $this->db->select('TR.room_id,max(TR.room_name) room_name,max(room_latlng1) room_latlng1,max(room_latlng2) room_latlng2');
			// $this->db->from('room TR');
			// $this->db->join('jadwal TJ','TJ.room_id = TR.room_id', 'left');
			// $this->db->where('TJ.jadwal_day !=',date('Y-m-d'));
			// // $this->db->where('TJ.jadwal_start <',date('h:i:s'));
			// // $this->db->where('TJ.jadwal_finish >',date('h:i:s'));
			// $this->db->group_by('TR.room_id');
			// $que = $this->db->get()->result_array();
			// return $que;
		// }elseif($get_param['TipeRuangan'] == '3'){
			// $this->db->select('TR.room_id,max(TR.room_name) room_name,max(room_latlng1) room_latlng1,max(room_latlng2) room_latlng2');
			// $this->db->from('room TR');
			// $this->db->join('jadwal TJ','TJ.room_id = TR.room_id', 'left');
			// $this->db->where('TJ.jadwal_day ',date('Y-m-d'));
			// // $this->db->where('TJ.jadwal_start >=',date('h:i:s'));
			// // $this->db->where('TJ.jadwal_finish <=',date('h:i:s'));
			// $this->db->group_by('TR.room_id');
			// $que = $this->db->get()->result_array();
			// return $que;
		// }
    }
*/