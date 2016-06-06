<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		  $this->load->model(array('m_karyawan','m_jabatan'));
    }

   
    
    
    public function lembur(){

        $data['userLogin'] = $this->session->userdata('loginData'); 

        $data['listData'] = $this->m_jabatan->getAllJabatan();
        $data['v_content'] = 'member/setting/listLembur';
        $this->load->view('member/layout', $data);
    }

    public function lemburedit($id){
        $dataPKP = $this->m_jabatan->getJabatanByID($id);
        if(count($dataPKP)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan jabatan dengan ID tsb","gagal"); 
            redirect('admin/setting/lembur');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $dataPKP;
            $data['v_content'] = 'member/setting/editLembur';
            $this->load->view('member/layout', $data);
        }
    }

    function doLemburEdit($id){
        $post = $this->input->post();
        $dataToInsert = array(
                             
                              "TarifLembur" => $post['txtUangLembur']);

        if($this->db->update('tb_jabatan',$dataToInsert,array('JabatanID' => $id))){

        $this->m_umum->generatePesan("Berhasil update lembur","berhasil");
        redirect('admin/setting/lembur');
        }else{
        
        $this->m_umum->generatePesan("Gagal update pkp","gagal");
        redirect('admin/setting/lemburedit/'.$id);    
        }

        
    }

    public function pkp(){

        //$this->m_umum->generatePesan('<h4>Contact Our Stokist today!</h4> Below list of Our Stokist.','warning');
        
        $data['userLogin'] = $this->session->userdata('loginData'); 

        $data['listData'] = $this->m_jabatan->getAllGolonganPajak();
        $data['v_content'] = 'member/setting/listPKP';
        $this->load->view('member/layout', $data);

    }

    public function pkpedit($id){
        $dataPKP = $this->m_jabatan->getGolonganPajakByID($id);
        if(count($dataPKP)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan pkp dengan ID tsb","gagal"); 
            redirect('admin/setting/pkp');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $dataPKP;
            $data['v_content'] = 'member/setting/editPKP';
            $this->load->view('member/layout', $data);
        }
    }


    function doPkpEdit($id){
        $post = $this->input->post();
        $dataToInsert = array(
                              "NamaGolongan" => $post['txtNamaGolongan'],
                              "NominalPKP" => $post['txtNominalPKP']);

        if($this->db->update('tb_golongan_pkp',$dataToInsert,array('GolonganPajakID' => $id))){

        $this->m_umum->generatePesan("Berhasil update pkp","berhasil");
        redirect('admin/setting/pkp');
        }else{
        
        $this->m_umum->generatePesan("Gagal update pkp","gagal");
        redirect('admin/setting/pkpedit/'.$id);     
        }

        
    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
        
        $data['v_content'] = 'member/karyawan/add';
        $this->load->view('member/layout', $data);
        
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
                                  "GajiUtama" => $post['txtGaji'],
                                  "JabatanID" => $post['spinJabatan'],
                                  "GolonganPajakID" => $post['spinGolongan']);

            if($this->db->insert('tb_karyawan',$dataToInsert)){

            $this->m_umum->generatePesan("Berhasil menambahkan karyawan","berhasil");
            
            }else{
            
            $this->m_umum->generatePesan("Gagal menambahkan karyawn","gagal");
                
            }
            redirect('admin/karyawan/add');
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
                                  "JabatanID" => $post['spinJabatan'],
                                  "GolonganPajakID" => $post['spinGolongan']);

            if($this->db->update('tb_karyawan',$dataToInsert,array('KaryawanID' => $id))){

            $this->m_umum->generatePesan("Berhasil update karyawan","berhasil");
            
            }else{
            
            $this->m_umum->generatePesan("Gagal update karyawan","gagal");
                
            }

            redirect('admin/karyawan/edit/'.$id);
    
    }
	
	function reset_password(){
		
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['dataDetail'] = $dataPKP;
		$data['v_content'] = 'member/setting/resetPassword';
		$this->load->view('member/layout', $data);
	}
	
	function doResetPassword(){
		$post = $this->input->post();
		$data['userLogin'] = $this->session->userdata('loginData');
		$sql_check = "SELECT * FROM tb_staff where UserID = '".$data['userLogin']['UserID']."' and Password = '".md5($post['txtPasswordLama'])."'";
		$run_check = $this->db->query($sql_check)->result_array();
		if(count($run_check)>0){
			
			if($post['txtPasswordBaru'] == $post['txtKonfirmasi']){
				$dataArray = array("Password" => md5($post['txtPasswordBaru']));
				$this->db->update('tb_staff',$dataArray,array('UserID' => $data['userLogin']['UserID']));
				$this->m_umum->generatePesan("Reset password berhasil","berhasil");
				redirect('admin/setting/reset_password/');
			}else{
				$this->m_umum->generatePesan("Konfirmasi password harus sama","gagal");
				redirect('admin/setting/reset_password/');
			}
		}else{
			 $this->m_umum->generatePesan("Password lama anda salah","gagal");
			 redirect('admin/setting/reset_password/');
		}
	}	
	
	public function add_pkp_modal(){
        $data['userLogin'] = $this->session->userdata('loginData');
        
        $v_content = 'member/setting/addPKP';
        $this->load->view($v_content, $data);
        
    }
	
	public function doAddPKP(){
		$post = $this->input->post();
       
            $dataToInsert = array("NamaGolongan" => $post['txtGolonganPKP'],
                                  "NominalPKP" => $post['txtNominalPKP']);

            if($this->db->insert('tb_golongan_pkp',$dataToInsert)){

            $this->m_umum->generatePesan("Berhasil menambahkan golongan baru pkp","berhasil");
            redirect('admin/setting/pkp');
            }else{
            
            $this->m_umum->generatePesan("Berhasil menambahkan tarif baru pkp","gagal");
			redirect('admin/setting/pkp');
                
            }
            
        
	}
	
	public function pkpdelete($id){
        $hapus = $this->db->delete('tb_golongan_pkp',array('GolonganPajakID' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus golongan pkp","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus golongan pkp","gagal");   
        }
        redirect('admin/setting/pkp');
    }
    

	
	

}