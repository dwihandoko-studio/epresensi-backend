<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cetak extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_jabatan');
        $this->load->model('m_karyawan');
    }

   
	public function wizard(){
        $data['userLogin'] = $this->session->userdata('loginData'); 

        
        $data['v_content'] = 'member/cetak/wizard';
        $this->load->view('member/layout', $data);   
    }

    public function nextWizard(){
        
        $data['userLogin'] = $this->session->userdata('loginData'); 

        $data['listData'] = $this->m_karyawan->getGajihan($this->input->post('spinJabatan'),$this->input->post('spinPeriodeBulan'),$this->input->post('spinPeriodeTahun'));
        $data['spinBulan'] = $this->input->post('spinPeriodeBulan');
        $data['spinTahun'] = $this->input->post('spinPeriodeTahun');
        $data['v_content'] = 'member/cetak/listingStep2';
        $this->load->view('member/layout', $data);
    }
	
    public function slip($id){
        
        $data['detail'] = $this->m_karyawan->getDetailGajihan($id);
        $this->load->view('member/cetak/slip',$data);
    }

    public function hitung($karyawanID,$bulan,$tahun){
        $data['karyawanID'] = $karyawanID;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['dataKaryawan'] = $this->m_karyawan->getKaryawanID($karyawanID);
        $this->load->view('member/gajihan/formHitung', $data);
    }

    public function prosesGaji(){
        $post = $this->input->post();

        $dataKaryawan = $this->m_karyawan->getKaryawanID($post['karyawanID']);

        $dataInsert = array("KaryawanID" => $post['karyawanID'],
                              "JamLembur" => $post['txtLemburKaryawan'],
                              "TarifLembur" => $post['txtTarifLemburJam'],
                              "TotalUangLembur" => $post['txtTotalTarifLembur'],
                              "GajiPokok" => $post['txtGajiPokokKaryawan'],
                              "GajiBruto" => $post['txtTotalGajiBruto'],
                              "PKPTahunan" => $dataKaryawan['NominalPKP'],
                              "PotonganPajak" => $post['txtPotonganPajak'],
                              "GajiNetto" => $post['txtGajiNetto'],
                              "TanggalTransfer" => date('Y-m-d H:i:s'),
                              "PeriodeBulan" => $post['bulan'],
                              "PeriodeTahun" => $post['tahun']
                              );

        $this->db->insert('tb_gaji',$dataInsert);

        die('ok');

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
          
            $dataToInsert = array(
                                  "NamaJabatan" => $post['txtNamaJabatan']);

            if($this->db->insert('tb_jabatan',$dataToInsert)){

            $this->m_umum->generatePesan("Berhasil menambahkan jabatan","berhasil");
            
            }else{
            
            $this->m_umum->generatePesan("Gagal menambahkan jabatan","gagal");
                
            }
            redirect('admin/jabatan/add');
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('tb_jabatan',array('JabatanID' => $id));
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
                                  "NamaJabatan" => $post['txtNamaJabatan']);

            if($this->db->update('tb_jabatan',$dataToInsert,array('JabatanID' => $id))){

            $this->m_umum->generatePesan("Berhasil update jabatan","berhasil");
            
            }else{
            
            $this->m_umum->generatePesan("Gagal update jabatan","gagal");
                
            }

            redirect('admin/jabatan/edit/'.$id);
    
    }

    

	
	

}