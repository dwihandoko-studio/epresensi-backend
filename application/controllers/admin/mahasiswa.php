<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mahasiswa extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->model('m_umum');
		$this->load->model('m_mhs');
		$this->load->model('m_kelas');
		$this->load->model('m_semester');
		$this->load->model('m_akademik');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_mhs->getAllMhs();
        $data['v_content'] = 'member/mahasiswa/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listKelas'] = $this->m_kelas->getAllKelas();       
        $data['listSemester'] = $this->m_semester->getAllSemester();       
        $data['listAkademik'] = $this->m_akademik->getAllAkademik();       
        $data['v_content'] = 'member/mahasiswa/add';
        $this->load->view('member/layout', $data);
        
    }
	
    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtKode', 'Kode', 'required|is_unique[mahasiswa.nim]');
        $this->form_validation->set_rules('txtDeviceId', 'Device ID', 'required|is_unique[mahasiswa.device_id]');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/mahasiswa/add');
        }else{
			$dataToInsert = array("nim" => $post['txtKode'],
								  "nama_mhs" => $post['txtNama'],
								  "id_kelas" => $post['txtKelas'],
								  "id_semester" => $post['txtSemester'],
								  "id_akademik" => $post['txtAkademik'],
								  "tahun_masuk" => $post['txtTahun'],
								  "tanggal_lahir" => $post['txtTglLahir'],
								  "email" => $post['txtEmail'],
								  "alamat_rumah" => $post['txtAlamatRumah'],
								  "alamat_tinggal" => $post['txtAlamatTinggal'],
								  "no_hp" => $post['txtNoHp'],
								  "device_id" => $post['txtDeviceId'],
								  "kompensasi" => $post['txtKompensasi'],
								  "created_at" => date('Y-m-d H:i:s'),
								  "update_at" => date('Y-m-d H:i:s'));
			if($this->db->insert('mahasiswa',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
				redirect('admin/mahasiswa/daftar');
			}else{
				$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
				redirect('admin/mahasiswa/add');    
			}
		}
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('mahasiswa',array('nim' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus data","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus data","gagal");   
        }
        redirect('admin/mahasiswa/daftar');
    }

    public function edit($id){
        $data= $this->m_mhs->getMhsByID($id);
         if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan data dengan ID tsb","gagal"); 
            redirect('admin/mahasiswa/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
			$data['listKelas'] = $this->m_kelas->getAllKelas();       
			$data['listSemester'] = $this->m_semester->getAllSemester();       
			$data['listAkademik'] = $this->m_akademik->getAllAkademik();  
            $data['v_content'] = 'member/mahasiswa/edit';
            $this->load->view('member/layout', $data);
         }
    }

    public function doEdit($id){
        $post = $this->input->post();
			$dataToInsert = array("nama_mhs" => $post['txtNama'],
								  "id_kelas" => $post['txtKelas'],
								  "id_semester" => $post['txtSemester'],
								  "id_akademik" => $post['txtAkademik'],
								  "tahun_masuk" => $post['txtTahun'],
								  "tanggal_lahir" => $post['txtTglLahir'],
								  "email" => $post['txtEmail'],
								  "alamat_rumah" => $post['txtAlamatRumah'],
								  "alamat_tinggal" => $post['txtAlamatTinggal'],
								  "no_hp" => $post['txtNoHp'],
								  "device_id" => $post['txtDeviceId'],
								  "kompensasi" => $post['txtKompensasi'],
								  "update_at" => date('Y-m-d H:i:s'));
            if($this->db->update('mahasiswa',$dataToInsert,array('nim' => $id))){
				$this->m_umum->generatePesan("Berhasil update data","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update data","gagal");
            }

            redirect('admin/mahasiswa/daftar'); 
    
    }

}