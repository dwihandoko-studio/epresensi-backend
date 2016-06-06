<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('m_pelanggan');
    }

   
	
	

    public function daftar(){

        //$this->m_umum->generatePesan('<h4>Contact Our Stokist today!</h4> Below list of Our Stokist.','warning');
        
        $data['userLogin'] = $this->session->userdata('loginData'); 

        $data['listData'] = $this->m_pelanggan->getAllPelanggan();
        $data['v_content'] = 'member/pelanggan/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
        
        $data['v_content'] = 'member/pelanggan/add';
        $this->load->view('member/layout', $data);
        
    }

    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtNomorPelanggan', 'Nomor Pelanggan', 'required|is_unique[tblPelanggan.PelangganID]');
        if ($this->form_validation->run() == FALSE){
            $this->session-a>set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/pelanggan/add');
        }else{    
            $dataToInsert = array("PelangganID" => $post['txtNomorPelanggan'],
                                  "NamaPelanggan" => $post['txtNamaPelanggan'],
                                  "AlamatPelanggan" => $post['txtAlamat'],
                                  "KotaPelanggan" => $post['txtKota'],
                                  "ProvinsiPelanggan" => $post['txtProvinsi'],
                                  "NoHpPelanggan" => $post['txtNoHP'],
                                  "TanggalDaftar" => $post['TanggalDaftar'],
                                  "TanggalLahir" => $post['TanggalLahir'],
                                  "CreatedDate" => date('Y-m-d H:i:s'));

            if($this->db->insert('tblPelanggan',$dataToInsert)){

            $this->m_umum->generatePesan("Berhasil menambahkan pelanggan","berhasil");
            
            }else{
            
            $this->m_umum->generatePesan("Gagal menambahkan pelanggan","gagal");
                
            }
            redirect('admin/pelanggan/add');
        }
    }

    public function doDelete($id){
        $hapus = $this->db->delete('tblPelanggan',array('PelangganID' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus pelanggan","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus pelanggan","gagal");   
        }
        redirect('admin/pelanggan/daftar');
    }

    public function edit($id){
        $dataPelanggan = $this->m_pelanggan->getPelangganByID($id);
        if(count($dataPelanggan)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan pelanggan dengan ID tsb","gagal"); 
            redirect('admin/pelanggan/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $dataPelanggan;
            $data['v_content'] = 'member/pelanggan/edit';
            $this->load->view('member/layout', $data);
        }
    }

    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array(
                                  "NamaPelanggan" => $post['txtNamaPelanggan'],
                                  "AlamatPelanggan" => $post['txtAlamat'],
                                  "KotaPelanggan" => $post['txtKota'],
                                  "ProvinsiPelanggan" => $post['txtProvinsi'],
                                  "NoHpPelanggan" => $post['txtNoHP'],
                                  "TanggalDaftar" => $post['TanggalDaftar'],
                                  "TanggalLahir" => $post['TanggalLahir']);

            if($this->db->update('tblPelanggan',$dataToInsert,array('PelangganID' => $id))){

            $this->m_umum->generatePesan("Berhasil update pelanggan","berhasil");
            
            }else{
            
            $this->m_umum->generatePesan("Gagal update pelanggan","gagal");
                
            }

            redirect('admin/pelanggan/edit/'.$id);
    
    }

    

	
	

}