<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_kelas');
		$this->load->model('m_prodi');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_kelas->getAllKelas();
        $data['v_content'] = 'member/kelas/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
		$data['listData'] = $this->m_prodi->getAllProdi();       
        $data['v_content'] = 'member/kelas/add';
        $this->load->view('member/layout', $data);
        
    }
	
    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
         $this->form_validation->set_rules('txtKode', 'Kode', 'required|is_unique[kelas.kode]');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/kelas/add'); 
        }else{   
            $dataToInsert = array("kode" => $post['txtKode'],
								  "kelas" => $post['txtKelas'],
                                  "id_prodi" => $post['txtProdi'],
								  "created_at" => date('Y-m-d H:i:s'),
								  "update_at" => date('Y-m-d H:i:s'));

            if($this->db->insert('kelas',$dataToInsert)){

            $this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
            redirect('admin/kelas/daftar');
            }else{
            
            $this->m_umum->generatePesan("Gagal menambahkan data","gagal");
            redirect('admin/kelas/add');    
            }
        }
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('kelas',array('kode' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus data","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus data","gagal");   
        }
        redirect('admin/kelas/daftar');
    }

    public function edit($id){
        $data= $this->m_kelas->getKelasByID($id);
         if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan data dengan ID tsb","gagal"); 
            redirect('admin/kelas/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
			$data['listData'] = $this->m_prodi->getAllProdi();
            $data['v_content'] = 'member/kelas/edit';
            $this->load->view('member/layout', $data);
         }
    }

    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array(
                                  "kelas" => $post['txtKelas'],
                                  "id_prodi" => $post['txtProdi'],
								  "update_at" => date('Y-m-d H:i:s')); 

            if($this->db->update('kelas',$dataToInsert,array('kode' => $id))){
				$this->m_umum->generatePesan("Berhasil update data","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update data","gagal");
            }

            redirect('admin/kelas/daftar');
    
    }

    

	
	

}