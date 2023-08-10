<?php
 if ( ! defined('BASEPATH')) exit(header('Location:../'));
class Admin extends CI_controller
{
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

  public function index()
  {
      $x = array('judul' =>' Halaman Utama ');
      /*$table_to_count = ['pegawai','']
      for ($i=0; $i <=count($table_to_count) ; $i++) { 
        $count_data[i]=$this->m_admin->count_data($table);
      }*/
      tpl('admin/home',$x);
  }

  public function jabatan()
  {
   $x = array('judul' =>':: Data Jabatan ::', 
              'data'=>$this->db->get('jabatan')->result_array()); 
   tpl('admin/jabatan',$x);
  }

  public function jabatan_tambah()
  {
  $x = array('judul'        => 'Tambah Data Jabatan' ,
              'aksi'        => 'tambah',
              'nama_jabatan'=> "",
              'golongan'    => "",
              'tunjangan'   => ""); 
    if(isset($_POST['kirim'])){
      $inputData=array(
        'nama_jabatan'=>$this->input->post('nama_jabatan'),
        'golongan'    =>$this->input->post('golongan'),
        'tunjangan'         =>$this->input->post('tunjangan'));
      $cek=$this->db->insert('jabatan',$inputData);
      if($cek){
        $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Ditambahkan.
              </div>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/jabatan'));
      }else{
       echo "ERROR input Data";
      }
    }else{
     tpl('admin/jabatan_form',$x);
    }
  }
    
  public function jabatan_edit($id='')
  {
  $sql=$this->db->get_where('jabatan',array('id_jabatan'=>$id))->row_array(); 
  $x = array('judul'        =>'Tambah Data Jabatan' ,
              'aksi'        =>'tambah',
        'nama_jabatan'=>$sql['nama_jabatan'],
        'golongan'    =>$sql['golongan'],
        'tunjangan'         =>$sql['tunjangan']); 
    if(isset($_POST['kirim'])){
      $inputData=array(
        'nama_jabatan'=>$this->input->post('nama_jabatan'),
        'golongan'    =>$this->input->post('golongan'),
        'tunjangan'         =>$this->input->post('tunjangan'));
      $cek=$this->db->update('jabatan',$inputData,array('id_jabatan'=>$id));
      if($cek){
        $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Diedit.
              </div>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/jabatan'));
      }else{
       echo "ERROR input Data";
      }
    }else{
     tpl('admin/jabatan_form',$x);
    }
  }

  public function penugasan($id){
    $x = array('judul' =>':: Kelola Tugas ::',
            'data'  => $this->m_admin->pesanan(),
            'pesanan' => $this->m_admin->getById($id));
   tpl('admin/penugasan',$x);
  }
  public function tim_tambah($value=''){
    $x = array('judul' =>':: Tambah Tim ::');
   tpl('admin/tim_tambah',$x);
  }
  public function proses_tambah_tim()
  {
    $nama_tim = $this->input->post('nama_tim');
    $nama_co = $this->input->post('nama_co');
    $nama_anggota_1 = $this->input->post('anggota_1');
    $nama_anggota_2 = $this->input->post('anggota_2');
    $nama_anggota_3 = $this->input->post('anggota_3');
    $nama_anggota_4 = $this->input->post('anggota_4');
    $id = $this->db->query("SELECT MAX(id_tim) as id FROM tim")->row();
    $id_tim = $id->id + 1;
    $this->db->query("INSERT INTO tim (id_tim,nama_tim) VALUES('$id_tim','$nama_tim')");
    $this->db->query("INSERT INTO anggota_tim (id_tim,id_ketua,id_anggota_1,id_anggota_2,id_anggota_3,id_anggota_4) VALUES('$id_tim','$nama_co','$nama_anggota_1','$nama_anggota_2','$nama_anggota_3','$nama_anggota_4')");
    redirect('Admin/tim');
  }

  public function edit_tim($id_tim) {
    // Memuat model 'Tim_model'
    $this->load->model('m_admin');

    // Mendapatkan data tim berdasarkan ID
    $tim = $this->m_admin->getTimById($id_tim);

    // Mengonversi objek $tim menjadi array
    $timArray = get_object_vars($tim);
    $edit = $this->db->query("SELECT * FROM anggota_tim WHERE id_tim = '$id_tim'")->row();

    // Mengirim data tim dalam bentuk array ke view
    $data['tim'] = $timArray;
    $data['judul'] = 'Edit Tim';
    $data['edit'] = $edit;

    // Memuat library form_validation
    $this->load->library('form_validation');

    // Mengatur aturan validasi
    $this->form_validation->set_rules('nama_tim', 'Nama Tim', 'required');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, tampilkan kembali halaman edit
        // $x = array('judul' =>':: Tambah Tim ::','tim'=>'$timArray');
        tpl('admin/tim_edit',$data);
    } else {
        // Jika validasi berhasil, lakukan update data tim
        $nama_tim = $this->input->post('nama_tim');
        $this->m_admin->updateTimData($id_tim, $nama_tim);

        // Redirect ke halaman daftar tim setelah update berhasil
        redirect('admin/tim');
    }
}
  public function detail_tim($id_tim) {
    // Memuat model 'Tim_model'
    $this->load->model('m_admin');

    // Mendapatkan data tim berdasarkan ID
    $tim = $this->m_admin->getTimById($id_tim);

    // Mengonversi objek $tim menjadi array
    $timArray = get_object_vars($tim);
    $edit = $this->db->query("SELECT * FROM anggota_tim WHERE id_tim = '$id_tim'")->row();

    // Mengirim data tim dalam bentuk array ke view
    $data['tim'] = $timArray;
    $data['judul'] = 'Detail Tim';
    $data['edit'] = $edit;

    // Memuat library form_validation
    $this->load->library('form_validation');

    // Mengatur aturan validasi
    $this->form_validation->set_rules('nama_tim', 'Nama Tim', 'required');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, tampilkan kembali halaman edit
        // $x = array('judul' =>':: Tambah Tim ::','tim'=>'$timArray');
        tpl('admin/tim_detail',$data);
    } else {
        // Jika validasi berhasil, lakukan update data tim
        $nama_tim = $this->input->post('nama_tim');
        $this->m_admin->updateTimData($id_tim, $nama_tim);

        // Redirect ke halaman daftar tim setelah update berhasil
        redirect('admin/tim');
    }
}
public function proses_edit_tim()
  {
    $nama_tim = $this->input->post('nama_tim');
    $id_tim = $this->input->post('id');
    $nama_co = $this->input->post('nama_co');
    $nama_anggota_1 = $this->input->post('anggota_1');
    $nama_anggota_2 = $this->input->post('anggota_2');
    $nama_anggota_3 = $this->input->post('anggota_3');
    $nama_anggota_4 = $this->input->post('anggota_4');
    // $id = $this->db->query("SELECT MAX(id_tim) as id FROM tim")->row();
    // $id_tim = $id->id + 1;
    $this->db->query("UPDATE tim SET nama_tim = '$nama_tim' WHERE id_tim = '$id_tim' ");
    $this->db->query("UPDATE anggota_tim SET 
        id_tim = '$id_tim',
        id_ketua = '$nama_co',
        id_anggota_1= '$nama_anggota_1',
        id_anggota_2= '$nama_anggota_2',
        id_anggota_3= '$nama_anggota_3',
        id_anggota_4= '$nama_anggota_4'
        WHERE id_tim = '$id_tim'
    ");
    redirect('Admin/tim');
  }
  public function hapus_tim($id_tim)
  {
    $this->db->query("DELETE FROM tim WHERE id_tim = '$id_tim' ");
    $this->db->query("DELETE FROM anggota_tim WHERE id_tim = '$id_tim' ");
    redirect('Admin/tim');
  }

  public function jabatan_hapus($id='')
  {
   $cek=$this->db->delete('jabatan',array('id_jabatan'=>$id));
   if ($cek) {
    $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/jabatan'));
   }
  }

  public function pegawai($value='')
  {
   $x = array('judul' =>':: Data Staff ::',
              'data'  =>$this->m_admin->pegawai(),);
     tpl('admin/pegawai',$x);
  }
  public function tim($value='')
  {
   $x = array('judul' =>':: Data Tim ::',
              'data'  =>$this->m_admin->tim(),);
     tpl('admin/tim',$x);
  }

  


  public function ls_pegawai($value='')
  {
   $data=$this->m_admin->pegawai()->row_array();
   echo json_encode($data);
  }

  public function pegawai_tambah($value='')
  {
   $x = array(
    'judul' =>'Tambah Data Staff' , 
    'aksi'  =>'Tambah',
    'jabatan'=>$this->db->get('jabatan')->result_array(),
    'id_jabatan'=>'',
    'nama'=>'',
    'jk'=>'',
    'foto'=>'',
    'agama'=>'',
    'pendidikan'=>'',
    'alamat'=>''
    

  );
    
   if (isset($_POST['kirim'])) {
      
      $config['upload_path'] = './template/data/'; 
      $config['allowed_types'] = 'bmp|jpg|png';  
      $config['file_name'] = 'foto_'.time();  
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('gambar')){
        $SQLinsert=array(
        'id_jabatan'=>$this->input->post('id_jabatan'),
        'nama'=>$this->input->post('nama'),
        'jk'=>$this->input->post('jk'),
        'foto'=>$this->upload->file_name,
        'agama'=>$this->input->post('agama'),
        'pendidikan'=>$this->input->post('pendidikan'),
        'alamat'=>$this->input->post('alamat'),
        'username'=>$this->input->post('username')
        
        );

        $cek=$this->db->insert('pegawai',$SQLinsert);
        if($cek){
            $pesan='<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                       Data Berhasil Di Tambahkan.
                      </div>';
            $this->session->set_flashdata('pesan',$pesan);
            redirect(base_url('admin/pegawai'));
        }else{
         echo "QUERY SQL ERROR";
        }
      }else{
        echo $this->upload->display_errors();
      }
    }else{
      tpl('admin/pegawai_form',$x);
    } 
 
  }

  public function pegawai_edit($id='')
  {

  $data=$this->db->get_where('pegawai',array('id_pegawai'=>$id))->row_array();  
  $x = array(
    'aksi'=>'edit',
    'judul' =>'Tambah Data Pegawai' ,
    'jabatan'=>$this->db->get('jabatan')->result_array(),
    'id_jabatan'=>$data['id_jabatan'],
    'nama'=>$data['nama'],
    'jk'=>$data['jk'],
    'foto'=>$data['foto'],
    'agama'=>$data['agama'],
    'pendidikan'=>$data['pendidikan'],
    'alamat'=>$data['alamat']
    
  );
    
  if (isset($_POST['kirim'])) {     
    if(empty($_FILES['gambar']['name'])){
      $SQLinsert=array(
      'id_jabatan'=>$this->input->post('id_jabatan'),
      'nama'=>$this->input->post('nama'),
      'jk'=>$this->input->post('jk'),
      //'foto'=>$this->upload->file_name,
      'agama'=>$this->input->post('agama'),
      'pendidikan'=>$this->input->post('pendidikan'),
      'alamat'=>$this->input->post('alamat')
      //'password'=>md5($this->input->post('password'))
      );

      $this->db->update('pegawai',$SQLinsert,array('id_pegawai'=>$id));
      $pesan='<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success!</h4>
                     Data Berhasil Di Edit.
                    </div>';
      $this->session->set_flashdata('pesan',$pesan);
      redirect(base_url('admin/pegawai'));
    }else{
        $config['upload_path'] = './template/data/'; 
        $config['allowed_types'] = 'bmp|jpg|png';  
        $config['file_name'] = 'foto_'.time();  
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('gambar')){
          $SQLinsert=array(
          'id_jabatan'=>$this->input->post('id_jabatan'),
          'nama'=>$this->input->post('nama'),
          'jk'=>$this->input->post('jk'),
          'foto'=>$this->upload->file_name,
          'agama'=>$this->input->post('agama'),
          'pendidikan'=>$this->input->post('pendidikan'),
          'alamat'=>$this->input->post('alamat')
          //'password'=>md5($this->input->post('password'))
          );
          $cek=$this->db->update('pegawai',$SQLinsert,array('id_pegawai'=>$id));
          if($cek){
              $pesan='<div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-check"></i> Success!</h4>
                         Data Berhasil Di Edit.
                        </div>';
              $this->session->set_flashdata('pesan',$pesan);
              redirect(base_url('admin/pegawai'));
          }else{
           echo "QUERY SQL ERROR";
          }
        }else{
          echo $this->upload->display_errors();
        }
     }
    }else{
      tpl('admin/pegawai_form',$x);
    }
  }
   

  public function pegawai_hapus($id='')
  {
    $foto=$this->db->get_where('pegawai',array('id_pegawai'=>$id))->row_array();
    if($foto['foto'] != ""){ @unlink('template/data/'.$foto['foto']); }else{ }

    $cek=$this->db->delete('pegawai',array('id_pegawai'=>$id));
   if ($cek) {
    $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/pegawai'));
   }
  } 


//bagian absensi  

  public function cari_pegawai()
  {
  if($this->session->userdata('level') == "pegawai"){  

     $id = $this->session->userdata('id_pegawai');  
     $x['pegawai']=$this->db->get_where('pegawai',array('id_pegawai'=>$id));
     $this->load->view('admin/data_pegawai',$x);

  }elseif($this->session->userdata('level') == "admin"){

     $id=$this->input->post('cari_p');  
     $x['pegawai']=$this->db->get_where('pegawai',array('id_pegawai'=>$id));
     $this->load->view('admin/data_pegawai',$x);

  }elseif($this->session->userdata('level') == "user"){
     $id=$this->input->post('cari_p');  
     $x['pegawai']=$this->db->get_where('pegawai',array('id_pegawai'=>$id));
     $this->load->view('admin/data_pegawai',$x);
  }
}

  public function cari_tpp()
  {
  $id=$this->input->post('cari_p');  
  $x['data']=$this->m_admin->tpp_id($id);
  $this->load->view('admin/tpp',$x);
  }

  public function absensi()
  {
    $id   = ($this->session->userdata('level') == "pegawai") ? $this->session->userdata('id_pegawai') : $this->session->userdata('id_admin');
    $data = ($this->session->userdata('level') == "pegawai") ? $this->m_admin->cari_pegawai($id) : $this->m_admin->pegawai();
    $x = array('judul' =>':: Absensi Staff ::',
              'data'  =>$data); 
    tpl('admin/absensi',$x);
  }


public function aksi_abs( )
{
 
  $id_pegawai= $this->input->post('id_pegawai');
  $bulan     = $this->input->post('bulan');
  
  $tanggal= date('Y-m-d');
  $hadir  = $this->input->post('hadir');
  $izin   = $this->input->post('izin');
  $tidak_hadir=$this->input->post('tidak_hadir'); 
  
  $hitung=$hadir+$izin+$tidak_hadir;
if ($hitung > 31) {
   buat_alert('Data Hadir Izin Dan Tidak Hadir Yang Anda Entrikan Lebih Dari 30');
}else{
  $cek=$this->db->query("SELECT * from absen where id_pegawai='$id_pegawai'
                          AND bulan='$bulan'");
  if ($cek->num_rows() > 0) {
    buat_alert('Data Absensi Sudah Ada .. Silahkan Pilih Abasensi Dengan Bulan Yang Lain');
  }else{
    
    if($hadir >= 10 ){
      $kehadiran='30%';
    }else if($hadir >= 20){
      $kehadiran='10%';
      if($hadir > 25){
        $kehadiran='5%';
      }
    }else if($hadir < 10) {
      $kehadiran='50%';
    }else{
      $kehadiran='0%';
    }
  
    $hasil=$this->m_admin->cari_jabatan($id_pegawai)->row_array();
    $tunjangan=$hasil['tunjangan']-$kehadiran;
    $sql = array(
        'id_pegawai'=>$id_pegawai,
        'jumlah_tpp'=>$tunjangan,
        'jumlah_potongan'=>$kehadiran,
        'bulan_t'=>$bulan,
        'tahun'=>date("Y"),
        'tgl'=>date("Y-m-d"));
    $this->db->insert('tpp',$sql);
    $data = array(
                   'id_pegawai' =>$id_pegawai, 
                   'hadir'      =>$hadir,
                   'izin'       =>$izin,
                   'tidak_hadir'=>$tidak_hadir,
                   'bulan'=>$this->input->post('bulan'),
                   'tanggal'    =>date('Y-m-d'));
     $this->db->insert('absen',$data);
    buat_alert('Data Absensi Berhasil Di Tambahkan ..');
 }
}


}

//bagian gaji

public function cari_gaji_p()
{

$id=$this->input->post('cari_p');  
$x['pegawai']=$this->m_admin->cari_pegawai($id);
$this->load->view('admin/gaji_form',$x);

}

public function gaji_pegawai()
{
 $x['judul'] ="Data Gaji Pegawai";
 $x['data']  =$this->m_admin->gaji_pegawai(); 
 tpl('admin/gaji',$x);
}


public function gaji_tambah()
{
 if (isset($_POST['kirim'])) {
    $id_pegawai=$this->input->post('id_pegawai');
    $cek=$this->db->get_where('gaji',array('id_pegawai'=>$id_pegawai));
    if($cek->num_rows() > 0){
     buat_alert('Maaf Data Gaji Pada Pegawai Ini Telah Ada');
    }else{
    $Sql=array(
    'id_pegawai'=>$this->input->post('id_pegawai'),
    'jumlah'    =>$this->input->post('jumlah'));
    $this->db->insert('gaji',$Sql);
        $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Penggajian Berhasil Di Tambahkan.
              </div>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/gaji_pegawai'));
  }
}else{
   $x['judul'] ="Data Gaji Pegawai";
   $x['data']  =$this->m_admin->gaji_set(); 
   tpl('admin/set_gaji',$x);
  } 
 
}


public function gaji_hapus($id='')
{
   $cek=$this->db->delete('gaji',array('id_gaji'=>$id));
   if ($cek) {
    $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/gaji_pegawai'));
   }
}

public function tpp()
{
 $x = array('judul' =>'Pembagian Insentif Staff',
            'data'=>$this->m_admin->pegawai_data()); 
  tpl('admin/tpp_set',$x);
}

public function tpp_hapus($id)
{
   $cek=$this->db->delete('tpp',array('id_pegawai'=>$id));
   $cek=$this->db->delete('absen',array('id_pegawai'=>$id));
   if ($cek) {
    $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/tpp'));

}
}

public function tpp_print($id='')
{
 $x = array('judul' =>'Print Data Pendapatan',
             'data'=>$this->m_admin->tpp_print($id)->result_array()); 
 $this->load->view('laporan/print_tpp',$x);
}



//bagian Login Administrais User..


public function user_admin($value='')
{
$x = array('judul' =>'Data Hak Akses',
            'data' =>$this->db->get('admin')); 
 tpl('admin/user_admin',$x);
}

public function user_admin_tambah()
{
if(isset($_POST['kirim'])){
 $data = array(
                'username' =>$this->input->post('username'),
                'password' =>md5($this->input->post('password')),
                'nama' =>$this->input->post('nama'),
                'level' =>$this->input->post('level'), );
 $cek =$this->db->insert('admin',$data);
 if($cek){
      $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Edit.
              </div>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/user_admin'));
 }else{
  buat_alert('SYSTEM ERROR');
 }
 
}else{
$x = array('judul' =>'Data Hak Akses',
           'username' =>'',
           'nama'     =>'',
           'data' =>$this->db->get('admin')); 
 tpl('admin/user_admin_form',$x);
}
}

public function user_admin_edit($id='')
{
$sql=$this->db->get_where('admin',array('id_admin'=>$id))->row_array();  
if(isset($_POST['kirim'])){
 $data = array(
                'username' =>$this->input->post('username'),
                'password' =>md5($this->input->post('password')),
                'nama' =>$this->input->post('nama'),
                'level' =>$this->input->post('level'),);
 $cek =$this->db->update('admin',$data,array('id_admin' =>$id));
 if($cek){
      $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Edit.
              </div>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/user_admin'));
 }else{
  buat_alert('SYSTEM ERROR');
 }
}else{
$x = array('judul' =>'Edit Data Hak Akses',
            'username' =>$sql['username'],
            'nama'     =>$sql['nama'],
            'data' =>$this->db->get('admin')); 
 tpl('admin/user_admin_form',$x);
}
}
public function user_admin_hapus($id='')
{
 if($this->session->userdata('id_admin') == $id){
  $pesan='<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
              Anda Tidak Bisa Menghapus Anda Sendiri.
              </div>';
 $this->session->set_flashdata('pesan',$pesan);
 redirect(base_url('admin/user_admin'));

 }else{ 
 $this->db->delete('admin',array('id_admin' =>$id));
  $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
 $this->session->set_flashdata('pesan',$pesan);
 redirect(base_url('admin/user_admin'));
}
}

public function profil()
{
 if (isset($_POST['kirim'])) {
     $data = array('password' => md5($this->input->post('password')),
                    'nama'    => $this->input->post('nama'), );
      $this->db->update('admin',$data,array('id_admin'=>$this->session->userdata('id_admin')));
      $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Edit Password Anda Adalah '.$this->input->post('password').' .
              </div>';
   $this->session->set_flashdata('pesan',$pesan);
   redirect(base_url('admin/profil'));   
  }else{
   $x = array('judul' =>'Ubah Password', 
               'data' =>$this->db->get_where('admin',array('id_admin'=>$this->session->userdata('id_admin')))->row_array(),
             );
   tpl('admin/ubah_password',$x);            
  } 

}

public function profil_top_manajemen()
{
 if (isset($_POST['kirim'])) {
     $data = array('password' => md5($this->input->post('password')),
                    'nama'    => $this->input->post('nama'), );
      $this->db->update('admin',$data,array('id_admin'=>$this->session->userdata('id_admin')));
      $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Edit Password Anda Adalah '.$this->input->post('password').' .
              </div>';
   $this->session->set_flashdata('pesan',$pesan);
   redirect(base_url('admin/profil_top_menajemen'));   
  }else{
   $x = array('judul' =>'Ubah Password', 
               'data' =>$this->db->get_where('admin',array('id_admin'=>$this->session->userdata('id_admin')))->row_array(),
             );
   tpl('admin/ubah_password',$x);            
  } 

}


public function profil_pegawai($value='')
{
  if(isset($_POST['kirim'])){
    $vaPassword = array('password'=>$this->input->post('password'));
    $vaWhere    = array('id_pegawai'=>$this->session->userdata('id_pegawai'));
    if(isset($_FILES['gambar']['name'])){
      $config['upload_path'] = './template/data/'; 
      $config['allowed_types'] = 'bmp|jpg|png';  
      $config['file_name'] = 'foto_'.time();  
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('gambar')){
        $vaFoto     = array('foto'=>$this->upload->file_name);
        $this->db->update('pegawai',$vaFoto,$vaWhere);  
      }else{
        echo $this->upload->display_errors();
      }
    }
    
    if($this->input->post('password') !== ""){
      $this->db->update('pegawai',$vaPassword,$vaWhere);  
    }
    
    $sql=array(
      'nip'=>$this->input->post('nip'),
      'nama'=>$this->input->post('nama'),
      'jk'=>$this->input->post('jk'),
      'agama'=>$this->input->post('agama'),
      'pendidikan'=>$this->input->post('pendidikan'),
      'alamat'=>$this->input->post('alamat'),
      'username'=>$this->input->post('username'),
    );
    
    
    $cek=$this->db->update('pegawai',$sql,$vaWhere);
    if($cek){
       $pesan='<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                 Data Berhasil Di Edit.
                </div>';
      $this->session->set_flashdata('pesan',$pesan);
      redirect(base_url('admin/profil_pegawai'));
    }else{
      buat_alert('ERROR');
    }
  }else{
    $data=$this->db->get_where('pegawai',array('id_pegawai' =>$this->session->userdata('id_pegawai')))->row_array();
    $x = array(
       'judul' =>'.:: Edit Profil Anda ::.',
       'aksi'=>'edit',
       'foto'=>$data['foto'],
       'nama'=>$data['nama'],
       'jk'=>$data['jk'],
       'alamat'=>$data['alamat'],
       'nip'=>$data['nip'],
       'agama'=>$data['agama'],
       'pendidikan'=>$data['pendidikan'],
       'username'=>$data['username']);
      tpl('admin/profil_pegawai',$x);
  }
}

public function pesanan($value='')
{
 $x = array('judul' =>':: Data Pesanan ::',
            'data'  =>$this->m_admin->pesanan());
   tpl('admin/pesanan',$x);
}

public function pesanan_top_manajemen($value='')
{
 $x = array('judul' =>':: Data Pesanan ::',
            'data'  =>$this->m_admin->pesanan(),);
   tpl('admin/pesanan_top_manajemen',$x);
}

public function penilaian_kinerja($value='')
	{
	 $x = array('judul' =>'Laporan Data Penilaian Kinerja',
	             'data'=>$this->m_penilaian_kinerja->get_all_penilaian(),);	
	 tpl('admin/penilaian_kinerja',$x);	
	}

  public function tambah_kinerja() {
        $this->load->model('PenilaianKinerja_model');
        $this->load->model('Pegawai_model');

        if ($this->input->post()) {
            $data = array(
                'nama_staff' => $this->input->post('nama_staff'),
                'tim' => $this->input->post('tim'),
                'tanggal_kerja' => $this->input->post('tanggal_kerja'),
                'nilai' => $this->input->post('nilai')
            );

            $insertId = $this->PenilaianKinerja_model->insertData($data);

            if ($insertId) {
                $pesan = '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            Data Berhasil Ditambahkan.
                        </div>';
                $this->session->set_flashdata('pesan', $pesan);
                redirect(base_url('admin/penilaian_kinerja'));
            } else {
                $pesan = '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-times"></i> Error!</h4>
                            Gagal Menambahkan Data.
                        </div>';
                $this->session->set_flashdata('pesan', $pesan);
            }
        }

        $data['pegawai'] = $this->Pegawai_model->getAllPegawai();
        $this->load->view('admin/tambah_penilaian_kinerja', $data);
    }

    public function hapus_kinerja($id)
    {
        $hapus = $this->m_admin->hapus_kinerja($id);
        if ($hapus) {
            $pesan = '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        Data Penilaian Kinerja Berhasil Dihapus.
                     </div>';
            $this->session->set_flashdata('pesan', $pesan);
        } else {
            $pesan = '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-times"></i> Error!</h4>
                        Gagal Menghapus Data Penilaian Kinerja.
                     </div>';
            $this->session->set_flashdata('pesan', $pesan);
        }
        redirect(base_url('admin/penilaian_kinerja'));
    }


	 public function laporan_pegawai_print($value='')
	{
	 $x = array('judul' =>'Laporan Data Pegawai Terdaftar',
	             'data'=>$this->m_laporan->pegawai(),
	             'print'=>TRUE,);	
	 $this->load->view('laporan/pegawai',$x);	
	}

	public function laporan_absensi($value='')
	{
    if (isset($_POST['cari'])) {
     //cek data apabila berhasi Di kirim maka postdata akan melakukan cek .... dan sebaliknya
     $dari=$this->input->post('dari');
     $sampai=$this->input->post('sampai');
      $x=array(
      	     'judul'=>'Data Laporan Kehadiran Pegawai',
             'data'=>$this->m_laporan->absensi($dari,$sampai),
             'depan'=>FALSE,
             'cetak'=>TRUE);
     $pesan='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hasil Laporan!</h4>
               Data Laporan Absensi Terhitung Dari.'.tgl_indonesia($this->input->post('dari')).' Sampai Dengan '.tgl_indonesia($this->input->post('sampai')).'
              </div>';
     $this->session->set_flashdata('pesan',$pesan); 
     tpl('laporan/absensi',$x);
    }else{

	$x = array('judul' =>'Laporan Data Absensi Kinerja Pegawai',
               'depan'=>TRUE,
               'cetak'=>FALSE);	
	tpl('laporan/absensi',$x);
	}
}


	public function cetak_laporan_absensi($dari='',$sampai='')
	{
	$x = array(
               'cetak'=>FALSE,
               'depan'=>FALSE,
              
		       'data' => $this->m_laporan->absensi($dari,$sampai),
               'judul'=> 'Data Absensi Pegawai');
    $this->load->view('laporan/absensi',$x);           	
	}

	public function laporan_tpp()
	{
	if(isset($_POST['cari'])){
	$dari=$this->input->post('dari');
	$sampai=$this->input->post('sampai');

	$x = array('judul' =>'Laporan Data Tunjangan Pendapatan Pegawai',
	            'data' => $this->m_laporan->tpp($dari,$sampai),
	            'cetak'=>TRUE,
	            'depan'=>FALSE,);
	tpl('laporan/tpp',$x); 	

	
    }else{
	$x = array('judul' =>'Laporan Data Tunjangan Pendapatan Pegawai',
	            'cetak'=>TRUE,
	            'depan'=>TRUE,);
	tpl('laporan/tpp',$x); 
	}
 }
	public function laporan_tpp_cetak($dari='',$sampai='')
	{
	$x = array('judul' =>'Laporan Data Tunjangan Pendapatan Pegawai',
	            'data' => $this->m_laporan->tpp($dari,$sampai),
	            'cetak'=> FALSE,
	            'depan'=>FALSE,);	
	$this->load->view('laporan/tpp',$x); 
	}

public function tambah()
    {
        // Validasi input jika diperlukan
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('tanggal_pesanan', 'Tanggal Pesanan', 'required');
        //$this->form_validation->set_rules('status', 'Status', 'required');
        $x = array('judul' =>':: Data Pesanan ::',
            'data'  =>$this->m_admin->pesanan(),);
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

            $tambah = $this->m_admin->tambah_pesanan($data);
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
    public function tabel_penugasan(){
      $x = array('judul' =>':: Data Penugasan ::',
      'data'  =>$this->m_admin->penugasan());
      tpl('admin/penugasan',$x);
      //$this->load->view('admin/penugasan_pegawai');
    }

    public function tabel_penugasan_pegawai(){
      $id_tim = $this->session->userdata('id_tim');
      $query = $this->db->query("SELECT * FROM anggota_tim WHERE 
              id_ketua LIKE'%$id_tim%' AND 
              id_anggota_1 LIKE'%$id_tim%' AND 
              id_anggota_2 LIKE'%$id_tim%' AND 
              id_anggota_3 LIKE'%$id_tim%' AND 
              id_anggota_4 LIKE'%$id_tim%' 
              ")->row();
      // var_dump($id_tim);
      // die();
      $x = array('judul' =>':: Data Penugasan ::',
      // 'data'  =>$this->m_admin->penugasanByTim($id_tim),
      'data'  =>$query,
      'tes'  =>"SELECT * FROM anggota_tim WHERE 
      id_ketua LIKE'%$id_tim%' AND 
      id_anggota_1 LIKE'%$id_tim%' AND 
      id_anggota_2 LIKE'%$id_tim%' AND 
      id_anggota_3 LIKE'%$id_tim%' AND 
      id_anggota_4 LIKE'%$id_tim%' 
      ",
    );
      tpl('admin/penugasan_pegawai',$x);
      //$this->load->view('admin/penugasan_pegawai');

    }

    public function tabel_penugasan_selesai(){
      $x = array('judul' =>':: Data Penugasan ::',
      'data'  =>$this->m_admin->penugasan(),);
      tpl('admin/penugasan_selesai',$x);
      //$this->load->view('admin/penugasan_selesai');

    }

    public function tambah_penugasan($idPesanan) {
      $query = $this->db->query("SELECT * FROM pesanan WHERE id_pesanan = '$idPesanan'")->row();
      $x = array(
        'judul'     => ':: Tambah Penugasan ::',
        // 'pesanan'   => $this->m_admin->getPesananById($idPesanan),
        'pesanan'   => $query
      );
      tpl('admin/penugasan_form', $x);
    }

    public function tambah_penugasan_detail($idPesanan) {
      $x = array(
        'judul'     => ':: Detail Penugasan ::',
        'pesanan'   => $this->m_admin->getPesananById($idPesanan),
      );
      tpl('admin/penugasan_detail', $x);
    }

    public function tambah_penugasan_selesai($idPesanan) {
      $x = array(
        'judul'     => ':: Detail Penugasan ::',
        'pesanan'   => $this->m_admin->getPesananById($idPesanan),
      );
      tpl('admin/penugasan_selesai', $x);
    }

    public function tambah_penugasan_satu($idPesanan) 
    {
      $cari = $this->db->query("SELECT * FROM penugasan WHERE id_pesanan = '$idPesanan'")->row();
      if($cari)
      {
        // Jika validasi berhasil, tambahkan data pesanan ke database
        $data = array(
          // 'nama_pelanggan' => $this->input->post('nama_pelanggan'),
          'catatan_kerja' => $this->input->post('catatan_tugas'),
          'tim' => $this->input->post('select_tim'),
          'id_pesanan' => $idPesanan,
          // 'tanggal_pesanan' => $this->input->post('tanggal_pesanan'),
      );
      $catatan_kerja = $this->input->post('catatan_tugas');
      $tim = $this->input->post('select_tim');
      $tanggal = $this->input->post('tanggal_pesanan');
      $nama = $this->input->post('nama_pelanggan');

      $tambah = $this->db->query("UPDATE penugasan SET 
        id_pesanan = '$idPesanan',
        nama_pelanggan = '$nama',
        id_tim = '$tim',
        tanggal_pesanan = '$tanggal',
        catatan_kerja = '$catatan_kerja'
        WHERE id_pesanan = '$id_pesanan'
      ");


      // $tambah = $this->m_admin->tambahPenugasan($data);
      if ($tambah) {
          $pesan = '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success!</h4>
                      Data Penugasan Berhasil Ditambahkan.
                  </div>';
          $this->session->set_flashdata('pesan', $pesan);
          redirect('admin/tabel_penugasan');
      } else {
          $pesan = '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-times"></i> Error!</h4>
                      Gagal Menambahkan Data Pesanan.
                  </div>';
          $this->session->set_flashdata('pesan', $pesan);
          redirect('admin/tabel_penugasan');
      
      }
      }else
      {
          // Jika validasi berhasil, tambahkan data pesanan ke database
        $data = array(
          // 'nama_pelanggan' => $this->input->post('nama_pelanggan'),
          'catatan_kerja' => $this->input->post('catatan_tugas'),
          'tim' => $this->input->post('select_tim'),
          'id_pesanan' => $idPesanan,
          // 'tanggal_pesanan' => $this->input->post('tanggal_pesanan'),
      );
      $catatan_kerja = $this->input->post('catatan_tugas');
      $tim = $this->input->post('select_tim');
      $tanggal = $this->input->post('tanggal_pesanan');
      $nama = $this->input->post('nama_pelanggan');

      $tambah = $this->db->query("INSERT INTO penugasan (id_pesanan,nama_pelanggan,id_tim,tanggal_pesanan,catatan_kerja)
        VALUES(
          '$idPesanan',
          '$nama',
          '$tim',
          '$tanggal',
          '$catatan_kerja'
        )
      ");


      // $tambah = $this->m_admin->tambahPenugasan($data);
      if ($tambah) {
          $pesan = '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success!</h4>
                      Data Penugasan Berhasil Ditambahkan.
                  </div>';
          $this->session->set_flashdata('pesan', $pesan);
          redirect('admin/tabel_penugasan');
      } else {
          $pesan = '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-times"></i> Error!</h4>
                      Gagal Menambahkan Data Pesanan.
                  </div>';
          $this->session->set_flashdata('pesan', $pesan);
          redirect('admin/tabel_penugasan');
      }
      }
    }
    
    public function detail_pesanan($id_pesanan) {
      // Mengambil data pesanan berdasarkan id_pesanan
      $data['pesanan'] = $this->m_admin->get_pesanan_by_id($id_pesanan);

      // Memuat view edit_pesanan
      $this->load->view('admin/pesanan_edit', $data);
    }
    public function validasi_pesanan($id_pesanan)
    {
      $this->db->query("UPDATE pesanan SET status = 'Validasi' WHERE id_pesanan = '$id_pesanan'");
      redirect('admin/pesanan_top_manajemen');
    }

    public function update_pesanan($id_pesanan) {
      // Validasi input jika diperlukan
      $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
      $this->form_validation->set_rules('tanggal_pesanan', 'Tanggal Pesanan', 'required');
      $this->form_validation->set_rules('status', 'Status', 'required');

      if ($this->form_validation->run() == false) {
          // Jika validasi gagal, tampilkan form edit pesanan
          $data['pesanan'] = $this->m_admin->get_pesanan_by_id($id_pesanan);
          $this->load->view('admin/pesanan_edit', $data);
      } else {
          // Jika validasi berhasil, update data pesanan ke database
          $data = array(
              'nama_pelanggan' => $this->input->post('nama_pelanggan'),
              'tanggal_pesanan' => $this->input->post('tanggal_pesanan'),
              'status' => $this->input->post('status')
          );

          $update = $this->m_admin->update_pesanan($id_pesanan, $data);
          if ($update) {
              $pesan = '<div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-check"></i> Success!</h4>
                          Data Pesanan Berhasil Divalidasi.
                       </div>';
              $this->session->set_flashdata('pesan', $pesan);
              redirect(base_url('admin/pesanan_top_manajemen'));
          } else {
              $pesan = '<div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-times"></i> Error!</h4>
                          Gagal Mengupdate Data Pesanan.
                       </div>';
              $this->session->set_flashdata('pesan', $pesan);
              redirect(base_url('admin/pesanan_edit/'.$id_pesanan));
          }
      }
  }


public function hapus($id)
    {
        $hapus = $this->m_admin->hapus_pesanan($id);
        if ($hapus) {
            $pesan = '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        Data Pesanan Berhasil Dihapus.
                     </div>';
            $this->session->set_flashdata('pesan', $pesan);
        } else {
            $pesan = '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-times"></i> Error!</h4>
                        Gagal Menghapus Data Pesanan.
                     </div>';
            $this->session->set_flashdata('pesan', $pesan);
        }
        redirect(base_url('admin/pesanan'));
    }


public function keluar($value='')
{

$this->session->sess_destroy();
echo "<scrip>alert('Anda Telah Keluar Dari Halaman Administrator')</script>";;
redirect(base_url(''));
}
  
}