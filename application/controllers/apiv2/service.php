<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Service extends CI_Controller {
	private $signature; 
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'url',
				'form',
				'language' 
		) );
		$this->load->model ( 'm_umum' );
		$this->load->model ( 'm_api' ); 
		$this->load->model ( 'm_login' );
		$this->load->model ( 'm_jadwal' );
	}
	function index() {
		header ( "location: " . base_url () );
		die ();
	}
	
	
	function loginMhs() {
		$dataArray = array (
				'pic' => 'E-Presensi System' 
		);
		$param ['ImeiNumber'] = $this->input->post ( 'ImeiNumber' ); // 1. all 2. tersedia 3. terisi
		$param ['nim'] = $this->input->post ( 'nim' );
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			
			$checkLogin = false;
			
			$checkLogin = $this->m_login->login_mhs_apps($param ['ImeiNumber'],$param ['nim']);
			if ($checkLogin) {
				$dataArray ['results'] = array (
						'success' => 'OK',
						'mahasiswa_profile' => $checkLogin
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			} else {
				$dataArray ['results'] = array (
						'success' => 'fail' 
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
	function loginDosen() {
		$dataArray = array (
				'pic' => 'E-Presensi System' 
		);
		$param ['ImeiNumber'] = $this->input->post('ImeiNumber'); // 1. all 2. tersedia 3. terisi
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			
			$checkLogin = false;
			
			$checkLogin = $this->m_login->login_dosen_apps($param ['ImeiNumber']);
			if ($checkLogin) {
				$dataArray ['results'] = array (
						'success' => 'OK',
						'dosen_profile' => $checkLogin
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			} else {
				$dataArray ['results'] = array (
						'success' => 'fail' 
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
	function ListRuangan() {
		$dataArray = array (
				'pic' => 'E-Presensi System' 
		);
		$param ['TipeRuangan'] = $this->input->post ( 'TipeRuangan' ); // 1. all 2. tersedia 3. terisi
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			$get_param = array (
					'TipeRuangan' => $param ['TipeRuangan'] 
			);
			$get_quote = $this->m_room->getAllRoomByStatus(); //ambil dari db
			$row_data = array ();
			foreach ( $get_quote as $value ) {
				$get_jadwal = $this->m_jadwal->getAllJadwalByToday($value ['room_id']);
				if($param ['TipeRuangan'] == '3'){
					if(count($get_jadwal) > 0) {
						$row_data [] = array (
								"room_id" => $value ['room_id'],
								"room_name" => $value ['room_name'],
								"room_latlng1" => $value ['room_latlng1'],
								"room_latlng2" => $value ['room_latlng2']
						);
					}
				}elseif($param ['TipeRuangan'] == '2'){
					if(count($get_jadwal) < 1) {
						$row_data [] = array (
								"room_id" => $value ['room_id'],
								"room_name" => $value ['room_name'],
								"room_latlng1" => $value ['room_latlng1'],
								"room_latlng2" => $value ['room_latlng2']
						);
					}
				}else{
					$row_data [] = array (
							"room_id" => $value ['room_id'],
							"room_name" => $value ['room_name'],
							"room_latlng1" => $value ['room_latlng1'],
							"room_latlng2" => $value ['room_latlng2']
					);
				}
			}
			$dataArray ['results'] = array (
					"listdata" => $row_data 
			);
			
			$this->m_api->sendOutput ( $dataArray, 200 );
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
	
	function ListRuanganDosen() {
		$dataArray = array (
				'pic' => 'E-Presensi System' 
		);
		$param ['TipeRuangan'] = $this->input->post ( 'TipeRuangan' ); // 1. all 2. tersedia 3. terisi
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			$get_param = array (
					'TipeRuangan' => $param ['TipeRuangan'] 
			);
			$get_quote = $this->m_room->getAllRoomByStatus(); //ambil dari db
			$row_data = array ();
			foreach ( $get_quote as $value ) {
				$get_jadwal = $this->m_jadwal->getAllJadwalByToday($value ['room_id']);
				if($param ['TipeRuangan'] == '3'){
					if(count($get_jadwal) > 0) {
						$row_data [] = array (
								"room_id" => $value ['room_id'],
								"room_name" => $value ['room_name'],
								"room_latlng1" => $value ['room_latlng1'],
								"room_latlng2" => $value ['room_latlng2']
						);
					}
				}elseif($param ['TipeRuangan'] == '2'){
					if(count($get_jadwal) < 1) {
						$row_data [] = array (
								"room_id" => $value ['room_id'],
								"room_name" => $value ['room_name'],
								"room_latlng1" => $value ['room_latlng1'],
								"room_latlng2" => $value ['room_latlng2']
						);
					}
				}else{
					$row_data [] = array (
							"room_id" => $value ['room_id'],
							"room_name" => $value ['room_name'],
							"room_latlng1" => $value ['room_latlng1'],
							"room_latlng2" => $value ['room_latlng2']
					);
				}
			}
			$dataArray ['results'] = array (
					"listdata" => $row_data 
			);
			
			$this->m_api->sendOutput ( $dataArray, 200 );
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
	function ListJadwalToday(){
		$dataArray = array (
				'pic' => 'E-Presensi System' 
		);
		
		$param ['id_kelas'] = $this->input->post ( 'id_kelas' );
		$param ['id_semester'] = $this->input->post ( 'id_semester' );
		$param ['id_akademik'] = $this->input->post ( 'id_akademik' );
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			$request_param = array();
			if($this->input->post('hari')=="today"){
				$request_param['hari'] = $this->m_api->get_hari_id();
			}else{
				$request_param['hari'] = $this->input->post('hari');
			}
			$request_param ['id_kelas'] = $param ['id_kelas'];
			$request_param ['id_semester'] = $param ['id_semester'];
			$request_param ['id_akademik'] = $param ['id_akademik'];
			$get_quote = $this->m_api->listJadwal($request_param); //ambil dari db
			$row_data = array ();
			foreach ( $get_quote as $value ) {
				$row_data [] = array("general" => array(	"id" => $value['id'],
															"kode_jadwal" => $value['kode'],
															"hari" => $value['hari'],
															"jam_mulai" => $value['jam_mulai'],
															"jam_selesai" => $value['jam_selesai']),
									"info_matkul" => array(
															"id_mk" => $value['id_mk'],
															"nama_mk" => $value['mata_kuliah']),
									"info_ruangan" => array(
															"id_ruangan" => $value['id_mk'],
															"nama_ruangan" => $value['ruangan'],
															"lantai" => $value['lantai'],
															"latlong_a" => $value['latlong_a'],
															"latlong_b" => $value['latlong_b'],
															"latlong_c" => $value['latlong_c'],
															"latlong_d" => $value['latlong_d']
															), 
									"info_kelas" => array(
															"id_kelas" => $value['id_kelas'],
															"nama_kelas" => $value['kelas'],
															"nama_prodi" => $value['prodi'],
															"nama_jurusan" => $value['jurusan']
															), 
									"info_dosen" => array(
															"nip" => $value['id_dosen'],
															"nama_dosen" => $value['nama_dosen'],
															"no_hp" => $value['no_hp'],
															"jabatan" => $value['jabatan']
															), 
									);
				
			}
			$dataArray ['results'] = array (
					"listjadwal" => $row_data 
			);
			
			$this->m_api->sendOutput ( $dataArray, 200 );
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
	function ListJadwalAll(){
		$dataArray = array (
				'pic' => 'E-Presensi System' 
		);
		
		$param ['id_kelas'] = $this->input->post ( 'id_kelas' );
		$param ['id_semester'] = $this->input->post ( 'id_semester' );
		$param ['id_akademik'] = $this->input->post ( 'id_akademik' );
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			
			$jadwal_harian = array();
			$listhari = $this->m_api->get_all_hari();
			foreach($listhari as $myhari){
				$request_param = array();
				$request_param['hari'] = $myhari['kode'];
				$request_param ['id_kelas'] = $param ['id_kelas'];
				$request_param ['id_semester'] = $param ['id_semester'];
				$request_param ['id_akademik'] = $param ['id_akademik'];
				$get_quote = $this->m_api->listJadwal($request_param); //ambil dari db
				$row_data = array ();
				
				foreach ( $get_quote as $value ) {
					$row_data [] = array("general" => array(	"id" => $value['id'],
																"kode_jadwal" => $value['kode'],
																"hari" => $value['hari'],
																"jam_mulai" => $value['jam_mulai'],
																"jam_selesai" => $value['jam_selesai']),
										"info_matkul" => array(
																"id_mk" => $value['id_mk'],
																"nama_mk" => $value['mata_kuliah']),
										"info_ruangan" => array(
																"id_ruangan" => $value['id_mk'],
																"nama_ruangan" => $value['ruangan'],
																"lantai" => $value['lantai'],
																"latlong_a" => $value['latlong_a'],
																"latlong_b" => $value['latlong_b'],
																"latlong_c" => $value['latlong_c'],
																"latlong_d" => $value['latlong_d']
																), 
										"info_kelas" => array(
																"id_kelas" => $value['id_kelas'],
																"nama_kelas" => $value['kelas'],
																"nama_prodi" => $value['prodi'],
																"nama_jurusan" => $value['jurusan']
																), 
										"info_dosen" => array(
																"nip" => $value['id_dosen'],
																"nama_dosen" => $value['nama_dosen'],
																"no_hp" => $value['no_hp'],
																"jabatan" => $value['jabatan']
																), 
										);
				
				}
				$jadwal_harian[] = array("hari"=>$myhari['kode'],"nama_hari"=>$myhari['nama_hari'],"list_jadwal"=>$row_data);

			}
			
			$dataArray ['results'] = $jadwal_harian;
			
			$this->m_api->sendOutput ( $dataArray, 200 );
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
	function pushAbsensi(){
		$dataArray = array (
				'pic' => 'E-Presensi System' 
		);
		
		$param ['nim'] = $this->input->post ( 'nim' );
		$param ['id_jadwal'] = $this->input->post ( 'id_jadwal' );
		$param ['lat'] = $this->input->post ( 'lat' );
		$param ['lon'] = $this->input->post ( 'lon' );
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			$request_param = array();
			$waktu_absen = date('Y-m-d H:i:s');
			$insert_to_log = array("id_jadwal" => $param ['id_jadwal'],
								   "nim" => $param ['nim'],
								   "lat" => $param ['lat'],
								   "lon" => $param ['lon']);
			$exe_insert = $this->db->insert("log_presensi",$insert_to_log);
			$id_insert = $this->db->insert_id();
			$check_valid = $this->m_api->check_validation_absen($param ['id_jadwal'],$id_insert);
			$the_results = array();
			if($check_valid){
				$this->m_api->insert_kehadiran($param ['id_jadwal'],$param ['nim'],$waktu_absen);
				$the_results = array("id_jadwal" => $param ['id_jadwal'],"status_absen" => "ok");
			}else{
				$the_results = array("id_jadwal" => $param ['id_jadwal'],"status_absen" => "not_ok");
			}
			$dataArray ['results'] = $the_results;
			
			$this->m_api->sendOutput ( $dataArray, 200 );
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
	function ListJadwal() {
		$dataArray = array (
				'pic' => 'E-Presensi System' 
		);
		$param ['kelas_id'] = $this->input->post ( 'kelas_id' );
		$param ['tglawal'] = $this->input->post ( 'tglawal' );
		$param ['tglakhir'] = $this->input->post ( 'tglakhir' );
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			$get_param = array (
					'kelas_id' => $param ['kelas_id'],
					'tglawal' => $param['tglawal'],
					'tglakhir' => $param['tglakhir']
			);
			$get_quote = $this->m_jadwal->getAllJadwalByKelas($get_param); //ambil dari db
			$row_data = array ();
			foreach ( $get_quote as $value ) {
				$row_data [] = array (
						"jadwal_id" => $value ['jadwal_id'],
						"room_name" => $value ['room_name'],
						"matkul_name" => $value ['matkul_name'],
						"dosen_name" => $value ['dosen_name'],
						"jadwal_start" => $value ['jadwal_start'],
						"jadwal_finish" => $value ['jadwal_finish'],
						"latLong1" => $value ['room_latlng1'],
						"latLong2" => $value ['room_latlng2'],
						"jadwal_day" => $value ['jadwal_day']
				);
			}
			$dataArray ['results'] = array (
					"listdata" => $row_data 
			);
			
			$this->m_api->sendOutput ( $dataArray, 200 );
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
}