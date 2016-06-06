<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_jabatan');
    }


    public function daftar(){
        //$this->m_umum->generatePesan('<h4>Contact Our Stokist today!</h4> Below list of Our Stokist.','warning');
        
        $data['userLogin'] = $this->session->userdata('loginData'); 

        $data['listData'] = $this->m_jabatan->getAllJabatan();
        $data['v_content'] = 'member/jabatan/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
        
        $data['v_content'] = 'member/jabatan/add';
        $this->load->view('member/layout', $data);
        
    }

    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtKode', 'Kode', 'required|is_unique[jabatan.kode]');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/jurusan/add'); 
        }else{ 
            $dataToInsert = array(
                                  "kode" => $post['txtKode'],
                                  "jabatan" => $post['txtJabatan'],
								  "created_at" => date('Y-m-d H:i:s'),
								  "update_at" => date('Y-m-d H:i:s'));

            if($this->db->insert('jabatan',$dataToInsert)){

            $this->m_umum->generatePesan("Berhasil menambahkan jabatan","berhasil");
            redirect('admin/jabatan/daftar');
            }else{
            
            $this->m_umum->generatePesan("Gagal menambahkan jabatan","gagal");
            redirect('admin/jabatan/add');    
            }
        }   
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('jabatan',array('kode' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus jabatan","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus jabatan","gagal");   
        }
        redirect('admin/jabatan/daftar');
    }

    public function edit($id){
        $dataJabatan = $this->m_jabatan->getJabatanByID($id);
        if(count($dataJabatan)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan jabatan dengan ID tsb","gagal"); 
            redirect('admin/jabatan/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $dataJabatan;
            $data['v_content'] = 'member/jabatan/edit';
            $this->load->view('member/layout', $data);
        }
    }

    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array(
                                  "jabatan" => $post['txtJabatan'],
								  "update_at" => date('Y-m-d H:i:s'));

            if($this->db->update('jabatan',$dataToInsert,array('kode' => $id))){
				$this->m_umum->generatePesan("Berhasil update jabatan","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update jabatan","gagal");
            }

            redirect('admin/jabatan/daftar');
    
    }
}