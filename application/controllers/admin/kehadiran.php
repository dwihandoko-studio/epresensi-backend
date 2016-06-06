<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kehadiran extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_kehadiran');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_kehadiran->getAllKehadiran();
        $data['v_content'] = 'member/kehadiran/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');       
        $data['v_content'] = 'member/jurusan/add';
        $this->load->view('member/layout', $data);
        
    }
	
    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtKode', 'Kode', 'required|is_unique[jurusan.kode]');
		if($this->form_validation->run() == FALSE){
            //$this->session>set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/jurusan/add'); 
        }else{ 
			$dataToInsert = array("kode" => $post['txtKode'],
								  "jurusan" => $post['txtJurusan'],
								  "created_at" => date('Y-m-d H:i:s'),
								  "update_at" => date('Y-m-d H:i:s'));

			if($this->db->insert('jurusan',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
				redirect('admin/jurusan/daftar');
			}else{
				$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
				redirect('admin/jurusan/add');    
			} 
		}
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('jurusan',array('kode' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus data","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus data","gagal");   
        }
        redirect('admin/jurusan/daftar');
    }

    public function edit($id){
        $data= $this->m_jurusan->getJurusanByID($id);
         if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan data dengan ID tsb","gagal"); 
            redirect('admin/jurusan/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
            $data['v_content'] = 'member/jurusan/edit';
            $this->load->view('member/layout', $data);
         }
    }

    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array("kode" => $post['txtKode'],
                                  "jurusan" => $post['txtJurusan'],
								  "update_at" => date('Y-m-d H:i:s'));

            if($this->db->update('jurusan',$dataToInsert,array('kode' => $id))){
				$this->m_umum->generatePesan("Berhasil update data","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update data","gagal");
            }
            redirect('admin/jurusan/daftar');
    
    }

    

	
	

}