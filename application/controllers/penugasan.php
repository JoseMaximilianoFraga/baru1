<?php
 if ( ! defined('BASEPATH')) exit(header('Location:../'));
class Penugasan extends CI_controller
{

    public function index()
  {
    $x = array('judul' =>':: Kelola Tugas ::',
    'data'  => $this->m_admin->pesanan());
    tpl('admin/penugasan',$x);
  }

  function __construct()
  {
   parent:: __construct();
   // error_reporting(0);
    // if($this->session->userdata('admin') != TRUE){
    //   redirect(base_url(''));
    //   exit;
    // };
   $this->load->library('form_validation'); 
   $this->load->model('m_admin');
   $this->load->model('m_penilaian_kinerja');
  }
  public function tambah()
    {
        // Validasi input jika diperlukan
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('tanggal_pesanan', 'Tanggal Pesanan', 'required');
        //$this->form_validation->set_rules('status', 'Status', 'required');
        $x = array('judul' =>':: Data Penugasan ::',
            'data'  =>$this->m_admin->penugasan(),);
   //tpl('admin/pesanan',$x);

        if ($this->form_validation->run() == false) {
            // Jika validasi gagal, tampilkan form tambah pesanan
            //$this->load->view('admin/pesanan_form');
            tpl('admin/pesanan_form',$x);
        } else {
            // Jika validasi berhasil, tambahkan data pesanan ke database
            $data = array(
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'tanggal_pesanan' => $this->input->post('tanggal_pesanan'),
                'status' => null
            );

            $tambah = $this->m_admin->tambah_penugasan($data);
            if ($tambah) {
                $pesan = '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            Data Pesanan Berhasil Ditambahkan.
                         </div>';
                $this->session->set_flashdata('pesan', $pesan);
                redirect(base_url('admin/pesanan'));
            } else {
                $pesan = '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-times"></i> Error!</h4>
                            Gagal Menambahkan Data Pesanan.
                         </div>';
                $this->session->set_flashdata('pesan', $pesan);
                //redirect(base_url('admin/pesanan'));
            }
        }
    }
}
?>