<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class akademik extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_akademik');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_akademik->getAllAkademik();
        $data['v_content'] = 'member/akademik/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');       
        $data['v_content'] = 'member/akademik/add';
        $this->load->view('member/layout', $data);
        
    }
	
    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtKode', 'Kode', 'required|is_unique[akademik.kode]');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/akademik/add'); 
        }else{ 
			$dataToInsert = array("kode" => $post['txtKode'],
								  "akademik" => $post['txtAkademik'],
								  "created_at" => date('Y-m-d H:i:s'),
								  "update_at" => date('Y-m-d H:i:s'));

			if($this->db->insert('akademik',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
				redirect('admin/akademik/daftar');
			}else{
				$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
				redirect('admin/akademik/add');    
			} 
		}
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('akademik',array('kode' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus data","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus data","gagal");   
        }
        redirect('admin/akademik/daftar');
    }

    public function edit($id){
        $data= $this->m_akademik->getAkademikByID($id);
         if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan data dengan ID tsb","gagal"); 
            redirect('admin/akademik/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
            $data['v_content'] = 'member/akademik/edit';
            $this->load->view('member/layout', $data);
         }
    }

    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array("kode" => $post['txtKode'],
                                  "akademik" => $post['txtAkademik'],
								  "update_at" => date('Y-m-d H:i:s'));

            if($this->db->update('akademik',$dataToInsert,array('kode' => $id))){
				$this->m_umum->generatePesan("Berhasil update data","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update data","gagal");
            }
            redirect('admin/akademik/daftar');
    
    }
}
?>