<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prodi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_prodi');
		$this->load->model('m_jurusan');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_prodi->getAllProdi();
        $data['v_content'] = 'member/prodi/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
        $data['listData'] = $this->m_jurusan->getAllJurusan();       
        $data['v_content'] = 'member/prodi/add';
        $this->load->view('member/layout', $data);
        
    }
	
    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtKode', 'Kode', 'required|is_unique[prodi.kode]');
		if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/prodi/add'); 
        }else{ 
			$dataToInsert = array("kode" => $post['txtKode'],
								  "prodi" => $post['txtProdi'],
                                  "id_jurusan" => $post['txtJurusan'],
								  "created_at" => date('Y-m-d H:i:s'),
								  "update_at" => date('Y-m-d H:i:s'));

			if($this->db->insert('prodi',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
				redirect('admin/prodi/daftar');
			}else{
				$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
				redirect('admin/prodi/add');    
			} 
		}
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('prodi',array('kode' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus data","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus data","gagal");   
        }
        redirect('admin/prodi/daftar');
    }

    public function edit($id){
        $data= $this->m_prodi->getProdiByID($id);
         if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan data dengan ID tsb","gagal"); 
            redirect('admin/prodi/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
			$data['listData'] = $this->m_jurusan->getAllJurusan();  
            $data['v_content'] = 'member/prodi/edit';
            $this->load->view('member/layout', $data);
         }
    }

    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array("kode" => $post['txtKode'],
                                  "prodi" => $post['txtProdi'],
                                  "id_jurusan" => $post['txtJurusan'],
								  "update_at" => date('Y-m-d H:i:s'));

            if($this->db->update('prodi',$dataToInsert,array('kode' => $id))){
				$this->m_umum->generatePesan("Berhasil update data","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update data","gagal");
            }
            redirect('admin/prodi/daftar');
    
    }

}