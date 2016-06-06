<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_kelas');
		$this->load->model('m_ruangan');
		$this->load->model('m_matkul');
		$this->load->model('m_dosen');
		$this->load->model('m_jadwal');
		$this->load->model('m_semester');
		$this->load->model('m_akademik');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_jadwal->getAllJadwal();
        $data['v_content'] = 'member/jadwal/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
		$data['listKelas'] = $this->m_kelas->getAllKelas();       
		$data['listRuangan'] = $this->m_ruangan->getAllRuangan();      
		$data['listSemester'] = $this->m_semester->getAllSemester();        
		$data['listAkademik'] = $this->m_akademik->getAllAkademik();         
		$data['listMatkul'] = $this->m_matkul->getAllMatkul();       
		$data['listDosen'] = $this->m_dosen->getAllDosen();       
		$data['listHari'] = $this->m_jadwal->getAllHari();     
        $data['v_content'] = 'member/jadwal/add';
        $this->load->view('member/layout', $data);
        
    }
	
    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtKode', 'Kode', 'required|is_unique[jadwal.kode]');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/jadwal/add'); 
        }else{ 
			$dataToInsert = array("kode" => $post['txtKode'],
								  "id_kelas" => $post['txtKelas'],
								  "id_ruangan" => $post['txtRuangan'],
								  "id_mk" => $post['txtMatkul'],
								  "id_dosen" => $post['txtDosen'],
								  "id_semester" => $post['txtSemester'],
								  "id_akademik" => $post['txtAkademik'],
								  "hari" => $post['txtHari'],
								  "jam_mulai" => $post['txtStart'],
								  "jam_selesai" => $post['txtFinish'],
								  "created_at" => date('Y-m-d H:i:s'),
								  "update_at" => date('Y-m-d H:i:s'));
		
			if($this->db->insert('jadwal',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
				redirect('admin/jadwal/daftar');
			}else{
				$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
				redirect('admin/jadwal/add');    
			}
		}
		/*$cektanggal = explode(",",$post['txtTgl']);
		if(count($cektanggal)==1){
			$dataToInsert = array("Ruangan_id" => $post['spinRuanganID'],
							  "kelas_id" => $post['spinKelasID'],
							  "matkul_id" => $post['spinMatkulID'],
							  "dosen_id" => $post['spinDosenID'],
							  "jadwal_day" => $post['txtTgl'],
							  "jadwal_start" => $post['txtStart'],
							  "jadwal_finish" => $post['txtFinish']);
			$this->db->insert('jadwal',$dataToInsert);
		}else{
			foreach($cektanggal as $val){
				$dataToInsert = array("Ruangan_id" => $post['spinRuanganID'],
							  "kelas_id" => $post['spinKelasID'],
							  "matkul_id" => $post['spinMatkulID'],
							  "dosen_id" => $post['spinDosenID'],
							  "jadwal_day" => $val,
							  "jadwal_start" => $post['txtStart'],
							  "jadwal_finish" => $post['txtFinish']);
				$this->db->insert('jadwal',$dataToInsert);
			}
		}
		*/
    }

    public function doDelete($id){
        $hapus = $this->db->delete('jadwal',array('kode' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus data","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus data","gagal");   
        }
        redirect('admin/jadwal/daftar');
    }

    public function edit($id){
        $data= $this->m_jadwal->getJadwalByID($id);
         if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan data dengan ID tsb","gagal"); 
            redirect('admin/jadwal/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
			$data['listKelas'] = $this->m_kelas->getAllKelas();       
			$data['listRuangan'] = $this->m_ruangan->getAllRuangan();      
			$data['listSemester'] = $this->m_semester->getAllSemester();        
			$data['listAkademik'] = $this->m_akademik->getAllAkademik();         
			$data['listMatkul'] = $this->m_matkul->getAllMatkul();       
			$data['listDosen'] = $this->m_dosen->getAllDosen();       
			$data['listHari'] = $this->m_jadwal->getAllHari(); 
            $data['v_content'] = 'member/jadwal/edit';
            $this->load->view('member/layout', $data);
         }
    }

    public function doEdit($id){
        $data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		$dataToInsert = array("kode" => $post['txtKode'],
							  "id_kelas" => $post['txtKelas'],
							  "id_ruangan" => $post['txtRuangan'],
							  "id_mk" => $post['txtMatkul'],
							  "id_dosen" => $post['txtDosen'],
							  "id_semester" => $post['txtSemester'],
							  "id_akademik" => $post['txtAkademik'],
							  "hari" => $post['txtHari'],
							  "jam_mulai" => $post['txtStart'],
							  "jam_selesai" => $post['txtFinish'],
							  "update_at" => date('Y-m-d H:i:s'));
		if($this->db->update('jadwal',$dataToInsert,array('kode' => $id))){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
		}
		redirect('admin/jadwal/daftar');

    }

}