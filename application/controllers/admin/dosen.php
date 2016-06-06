<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dosen extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_dosen');
		$this->load->model('m_jabatan');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_dosen->getAllDosen();
        $data['v_content'] = 'member/dosen/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_jabatan->getAllJabatan();      
        $data['v_content'] = 'member/dosen/add';
        $this->load->view('member/layout', $data);
        
    }
	
    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation'); 
		$this->form_validation->set_rules('txtKode', 'NIP', 'required|is_unique[dosen.nip]');
		$this->form_validation->set_rules('txtDeviceId', 'Device ID', 'required|is_unique[dosen.device_id]');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/dosen/add'); 
        }else{ 
			$dataToInsert = array("nip" => $post['txtKode'],
								  "nama_dosen" => $post['txtNamaDosen'],
								  "id_jabatan" => $post['txtJabatan'],
								  "tanggal_lahir" => $post['txtTglLahir'],
								  "email" => $post['txtEmail'],
								  "alamat_rumah" => $post['txtAlamatRumah'],
								  "alamat_tinggal" => $post['txtAlamatTinggal'],
								  "no_hp" => $post['txtNoHp'],
								  "device_id" => $post['txtDeviceId'],
								  "created_at" => date('Y-m-d H:i:s'),
								  "update_at" => date('Y-m-d H:i:s'));
			if($this->db->insert('dosen',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
				redirect('admin/dosen/daftar');
			}else{
				$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
				redirect('admin/dosen/add');    
			}
        }
    }

    public function doDelete($id){
        $hapus = $this->db->delete('dosen',array('nip' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus data","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus data","gagal");   
        }
        redirect('admin/dosen/daftar');
    }

    public function edit($id){
        $data= $this->m_dosen->getDosenByID($id);
         if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan data dengan ID tsb","gagal"); 
            redirect('admin/dosen/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
			$data['listData'] = $this->m_jabatan->getAllJabatan();      
            $data['v_content'] = 'member/dosen/edit';
            $this->load->view('member/layout', $data);
         }
    }

    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array("nama_dosen" => $post['txtNamaDosen'],
								  "id_jabatan" => $post['txtJabatan'],
								  "tanggal_lahir" => $post['txtTglLahir'],
								  "email" => $post['txtEmail'],
								  "alamat_rumah" => $post['txtAlamatRumah'],
								  "alamat_tinggal" => $post['txtAlamatTinggal'],
								  "no_hp" => $post['txtNoHp'],
								  "device_id" => $post['txtDeviceId'],
								  "update_at" => date('Y-m-d H:i:s'));
            if($this->db->update('dosen',$dataToInsert,array('nip' => $id))){
				$this->m_umum->generatePesan("Berhasil update data","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update data","gagal");
            }

            redirect('admin/dosen/daftar');
    
    }

}