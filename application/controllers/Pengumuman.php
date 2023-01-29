<?php
class Pengumuman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi','m');
        $this->load->helpers('form');
        $this->load->helpers('url');

    }

    function index(){
        $uid = $this->input->get("uid");

        $data = array();
        $data['title'] = "Pengumuman";
        $data['uid'] = !empty($uid) ? $uid : 0;


        $this->load->view('apiv6/pengumuman',$data);
    }

    function timeline($uid){

        $tgl = date('Y-m-d');

        $response = array();
        $response["response"] = array();


        if($uid > 0){

            $users = $this->db->get_where('peserta',array("peserta_id" => $uid));

            if($users->num_rows() > 0) {

                foreach ($users->result_array() as $r2) {

                    $peserta_id = $r2['peserta_id'];
                    $kelas_sekarang = $r2['peserta_kelas'];
                    $jurusan_id = $r2['peserta_jurusan'];
                    $ruang = $r2['peserta_jurusan_ke'];

                    $pesan = $this->db->select('*')->from('pesan');
                    $pesan = $pesan->where("(pesan_untuk='peserta' OR pesan_untuk='semua')");

                    //$pesan = $pesan->where("(kelas_sekarang='' OR kelas_sekarang='$kelas_sekarang')");
                    //$pesan = $pesan->where("(jurusan_id='' OR jurusan_id='$jurusan_id')");
                    //$pesan = $pesan->where("(ruang=0 OR ruang=$ruang)");



                    $pesan = $pesan->order_by('pesan_tanggal','desc');
                    $pesan = $pesan->get();

                    foreach ($pesan->result_array() as $row1){


                        $item[ 'pesan_id' ] = $row1['pesan_id'];
                        $item[ 'pesan_aksi' ] = $row1['pesan_aksi'];
                        $item[ 'pesan_text' ] = $row1['pesan_text'];
                        $item[ 'pesan_tanggal' ] = $this->m->tanggalhari( $row1['pesan_tanggal'],true );
                        $item[ 'pesan_untuk' ] = $row1['pesan_untuk'];

                        $item[ 'username' ] = '';
                        $user = $this->db->get_where('users',array(
                            'user_id'=>$row1['user_id']
                        ))->result();
                        $item['username'] =  $user[0]->username;

                        array_push($response["response"], $item);
                    }

                    /**
                    $item = array();
                    $item[ 'pesan_id' ] = 0;
                    $item[ 'pesan_aksi' ] = 'pesan';
                    $item[ 'pesan_untuk' ] = 'semua';
                    $item[ 'pesan_text' ] = '<p>Selamat Datang di USBKA - Aplikasi Ujian Berbasis Komputer Android</p>';
                    $item[ 'pesan_tanggal' ] = $this->m->tanggalhari2( "2021-01-01",true );
                    $item[ 'username' ] = 'system';

                    array_push($response["response"], $item);*/




                }

                $response["success"] = true;
            }else{
                $response["success"] = false;
                $response["response"] = "Tidak ditemukan data";
            }

        }else{

            $pesan = $this->db->select('*')->from('pesan');
            $pesan = $pesan->where("(pesan_untuk='guru' OR pesan_untuk='semua')");



            $pesan = $pesan->order_by('pesan_tanggal','desc');
            $pesan = $pesan->get();

            foreach ($pesan->result_array() as $row1){


                $item[ 'pesan_id' ] = $row1['pesan_id'];
                $item[ 'pesan_aksi' ] = $row1['pesan_aksi'];
                $item[ 'pesan_text' ] = $row1['pesan_text'];
                $item[ 'pesan_tanggal' ] = $this->m->tanggalhari( $row1['pesan_tanggal'],true );
                $item[ 'pesan_untuk' ] = $row1['pesan_untuk'];

                $item[ 'username' ] = '';
                $user = $this->db->get_where('users',array(
                    'user_id'=>$row1['user_id']
                ))->result();
                $item['username'] =  $user[0]->username;

                array_push($response["response"], $item);
            }
/**
            $item = array();
            $item[ 'pesan_id' ] = 0;
            $item[ 'pesan_aksi' ] = 'pesan';
            $item[ 'pesan_untuk' ] = 'semua';
            $item[ 'pesan_text' ] = '<p>Selamat Datang di USBKA - Aplikasi Ujian Berbasis Komputer Android</p>';
            $item[ 'pesan_tanggal' ] = $this->m->tanggalhari2( "2021-01-01",true );
            $item[ 'username' ] = 'system';*/

            $response["success"] = true;

        }



        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);

    }
}