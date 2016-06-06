<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		  $this->load->model(array('m_karyawan','m_jabatan'));
    }

   
	
	

    public function daftar(){

        //$this->m_umum->generatePesan('<h4>Contact Our Stokist today!</h4> Below list of Our Stokist.','warning');
        
        $data['userLogin'] = $this->session->userdata('loginData'); 

        $data['listData'] = $this->m_karyawan->getAllKaryawan(); 
        $data['v_content'] = 'member/karyawan/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
        
        $data['v_content'] = 'member/karyawan/add';
        $this->load->view('member/layout', $data);
        
    }
	
	public function add_modal(){
        $data['userLogin'] = $this->session->userdata('loginData');
        
        $v_content = 'member/karyawan/add_modal';
        $this->load->view($v_content, $data);
        
    }

    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtNIK', 'NIK', 'required|is_unique[tb_karyawan.NIK]');
        if ($this->form_validation->run() == FALSE){
            $this->session-a>set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/karyawan/add');
        }else{    
            $dataToInsert = array("NIK" => $post['txtNIK'],
                                  "NamaKaryawan" => $post['txtNamaKaryawan'],
                                  "NoHp" => $post['txtNoHp'],
                                  "AlamatKaryawan" => $post['txtAlamat'],
                                  "NoRek" => $post['txtNoRek'],
								  "NamaBank" => $post['NamaBank'],
                                  "GajiUtama" => $post['txtGaji'],
                                  "JabatanID" => $post['spinJabatan'],
                                  "GolonganPajakID" => $post['spinGolongan']);

            if($this->db->insert('tb_karyawan',$dataToInsert)){

            $this->m_umum->generatePesan("Berhasil menambahkan karyawan","berhasil");
            redirect('admin/karyawan/daftar');
            }else{
            
            $this->m_umum->generatePesan("Gagal menambahkan karyawn","gagal");
			redirect('admin/karyawan/add');
                
            }
            
        }
    }

    public function doDelete($id){
        $hapus = $this->db->delete('tb_karyawan',array('KaryawanID' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus karyawan","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus karyawan","gagal");   
        }
        redirect('admin/karyawan/daftar');
    }

    public function edit($id){
        $dataPelanggan = $this->m_karyawan->getKaryawanID($id);
        if(count($dataPelanggan)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan pelanggan dengan ID tsb","gagal"); 
            redirect('admin/karyawan/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $dataPelanggan;
            $data['v_content'] = 'member/karyawan/edit';
            $this->load->view('member/layout', $data);
        }
    }

    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array(
                                  "NamaKaryawan" => $post['txtNamaKaryawan'],
                                  "NoHp" => $post['txtNoHp'],
                                  "AlamatKaryawan" => $post['txtAlamat'],
                                  "NoRek" => $post['txtNoRek'],
                                  "GajiUtama" => $post['txtGaji'],
								  "NamaBank" => $post['NamaBank'],
                                  "JabatanID" => $post['spinJabatan'],
                                  "GolonganPajakID" => $post['spinGolongan']);

            if($this->db->update('tb_karyawan',$dataToInsert,array('KaryawanID' => $id))){

            $this->m_umum->generatePesan("Berhasil update karyawan","berhasil");
            
            }else{
            
            $this->m_umum->generatePesan("Gagal update karyawan","gagal");
                
            }

            redirect('admin/karyawan/daftar/');
    
    }

    

	
	

}