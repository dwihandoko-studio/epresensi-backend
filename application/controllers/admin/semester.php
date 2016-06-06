<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Semester extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_semester');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_semester->getAllSemester();
        $data['v_content'] = 'member/semester/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');       
        $data['v_content'] = 'member/semester/add';
        $this->load->view('member/layout', $data);
        
    }
	
    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtKode', 'Kode', 'required|is_unique[semester.kode]');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/semester/add'); 
        }else{ 
			$dataToInsert = array("kode" => $post['txtKode'],
								  "semester" => $post['txtSemester']);

			if($this->db->insert('semester',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
				redirect('admin/semester/daftar');
			}else{
				$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
				redirect('admin/semester/add');    
			} 
		}
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('semester',array('kode' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus data","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus data","gagal");   
        }
        redirect('admin/semester/daftar');
    }

    public function edit($id){
        $data= $this->m_semester->getSemesterByID($id);
         if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan data dengan ID tsb","gagal"); 
            redirect('admin/semester/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
            $data['v_content'] = 'member/semester/edit';
            $this->load->view('member/layout', $data);
         }
    }

    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array("kode" => $post['txtKode'],
                                  "semester" => $post['txtSemester']);

            if($this->db->update('semester',$dataToInsert,array('kode' => $id))){
				$this->m_umum->generatePesan("Berhasil update data","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update data","gagal");
            }
            redirect('admin/semester/daftar');
    
    }
}
?>