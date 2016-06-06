<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ruangan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_ruangan');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_ruangan->getAllRuangan();
        $data['v_content'] = 'member/ruangan/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');       
        $data['v_content'] = 'member/ruangan/add';
        $this->load->view('member/layout', $data);
        
    }
	
    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
		$this->form_validation->set_rules('txtKode', 'Kode', 'required|is_unique[ruangan.kode]');
        $longlat1 = str_replace('(', '', $post['txtKoor1']);
        $longlat2 = str_replace('(', '', $post['txtKoor2']);
        $longlat3 = str_replace('(', '', $post['txtKoor3']);
        $longlat4 = str_replace('(', '', $post['txtKoor4']);
        $longlat1 = str_replace(')', '', $longlat1); 
        $longlat2 = str_replace(')', '', $longlat2); 
        $longlat3 = str_replace(')', '', $longlat3); 
        $longlat4 = str_replace(')', '', $longlat4); 
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/ruangan/add'); 
        }else{
            $dataToInsert = array("kode" => $post['txtKode'],
								  "ruangan" => $post['txtRuangan'],
								  "lantai" => $post['txtLantai'],
								  "latlong_a" => $longlat1,
								  "latlong_b" => $longlat2,
								  "latlong_c" => $longlat3,
								  "latlong_d" => $longlat4,
								  "status" => '1',
								  "created_at" => date('Y-m-d H:i:s'),
								  "update_at" => date('Y-m-d H:i:s'));
            if($this->db->insert('ruangan',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
				redirect('admin/ruangan/daftar');
            }else{
				$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
				redirect('admin/ruangan/add');    
            }
        } 
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('ruangan',array('kode' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus data","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus data","gagal");   
        }
        redirect('admin/ruangan/daftar');
    }

    public function edit($id){
        $data= $this->m_ruangan->getRuanganByID($id);
         if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan data dengan ID tsb","gagal"); 
            redirect('admin/ruangan/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData'); 
            $data['dataDetail'] = $data;
            $data['v_content'] = 'member/ruangan/edit';
            $this->load->view('member/layout', $data);
         }
    }

    public function doEdit($id){
         $post = $this->input->post();
         $longlat1 = str_replace('(', '', $post['txtKoor1']);
         $longlat2 = str_replace('(', '', $post['txtKoor2']);
         $longlat3 = str_replace('(', '', $post['txtKoor3']);
         $longlat4 = str_replace('(', '', $post['txtKoor4']);
         $longlat1 = str_replace(')', '', $longlat1); 
         $longlat2 = str_replace(')', '', $longlat2); 
         $longlat3 = str_replace(')', '', $longlat3); 
         $longlat4 = str_replace(')', '', $longlat4); 
         $dataToInsert = array("ruangan" => $post['txtRuangan'],
								"lantai" => $post['txtLantai'],
								"latlong_a" => $longlat1,
								"latlong_b" => $longlat2,
								"latlong_c" => $longlat3,
								"latlong_d" => $longlat4,
								"status" => '1',
								"update_at" => date('Y-m-d H:i:s'));
         if($this->db->update('ruangan',$dataToInsert,array('kode' => $id))){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
         }else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
         }
         redirect('admin/ruangan/daftar');
    }

}