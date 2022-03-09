<?php
class Cari extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');

        $this->tahunajaran = $this->m->tahunajaran();

    }

    function index(){
        $tgl = date('Y-m-d');
        $by = $this->input->get('by');
        $nomor = $this->input->get('nomor');

        $response = array();
        $response["response"] = array();

        $this->db->select("*")->from('soal_jawab');
        $this->db->join('peserta', 'peserta.peserta_id = soal_jawab.siswa_id');


        $this->db->where('soal_jawab.soal_jawab_last_update >= ', date('Y-m-d H:i:s', strtotime("-1800 second")));

        $this->db->where('soal_jawab.soal_jawab_tahunajaran', $this->tahunajaran);
        $this->db->where('soal_jawab.soal_jawab_ruangan', $nomor);
        $this->db->where('soal_jawab.soal_jawab_tanggal', $tgl);

        if(!empty($by) && $by != null && $by != ""){
            $this->db->like('peserta.peserta_nama',$by);
        }

        $this->db->order_by('soal_jawab.soal_jawab_last_update','desc');
        $this->db->order_by('peserta.peserta_nama','asc');
        $this->db->limit(40);


        $users = $this->db->get();
        if ($users->num_rows() > 0) {

            foreach ($users->result_array() as $r2) {

                //$tt2 = date('Y-m-d H:i:s', strtotime($r2['soal_jawab_last_update']));


                $item = array();
                $item['ruangan'] = $nomor;
                $item['peserta_id'] = $r2['peserta_id'];
                $item['peserta_nis'] = $r2['peserta_nis'];
                $item['peserta_nama'] = $r2['peserta_nama'];
                $peserta_foto = $r2['peserta_foto'];

                $item['peserta_foto'] = $this->config->item('base_url') . '/assets/img/avatar.png';
                if( !empty($peserta_foto) && file_exists(FCPATH . 'assets/profile/' .$peserta_foto) ) {
                    $item['peserta_foto'] = $this->config->item('base_url') . '/assets/profile/' . $peserta_foto;
                }

                $item['soal_jawab_id'] = $r2['soal_jawab_id'];
                $item['soal_jawab_mulai'] = $r2['soal_jawab_mulai'];
                $item['soal_jawab_selesai'] = $r2['soal_jawab_selesai'];
                $item['soal_jawab_tanggal'] = $r2['soal_jawab_tanggal'];
                $item['soal_jawab_tanggal_indo' ] = $this->m->tanggalhari2( $r2['soal_jawab_tanggal'],true );

                $item['soal_jawab_ok'] = $r2['soal_jawab_ok'];
                $item['soal_jawab_none'] = $r2['soal_jawab_none'];

                $item['soal_jawab_terjawab'] = $r2['soal_jawab_ok'];
                $item['soal_jawab_tidakterjawab'] = $r2['soal_jawab_none'];


                $item['soal_jawab_ruangan'] = $r2['soal_jawab_ruangan'];

                $item['soal_jawab_pelajaran'] = $r2['soal_jawab_pelajaran'];
                $item['soal_jawab_jurusan'] = $r2['soal_jawab_jurusan'];
                $item['soal_jawab_ruangan'] = $r2['soal_jawab_ruangan'];


                $sembunyikan = 0;
                if( $r2['soal_jawab_status'] == "N" && $r2['soal_jawab_selesai'] != "0000-00-00 00:00:00" && strtotime($r2['soal_jawab_selesai']) < strtotime("-900 second")) {
                    $sembunyikan = 1;
                }
                $item['soal_jawab_status'] = $r2['soal_jawab_status'];
                $item['soal_jawab_last_update'] = $r2['soal_jawab_last_update'];



                $sekarang = date('Y-m-d H:i:s');
                $update_terakhir = date('Y-m-d H:i:s', strtotime($r2['soal_jawab_last_update'] ." +1800 second"));
                $update_terakhir_jauh = date('Y-m-d H:i:s', strtotime($r2['soal_jawab_last_update'] ." +3600 second"));



                $tampil = true;
                if( $sekarang > $update_terakhir ){
                    $tampil = false;
                }

                if( $r2['soal_jawab_status'] == "Y" ){
                    $tampil = true;

                    if( $sekarang > $update_terakhir_jauh ){
                        $tampil = false;
                    }
                }

                //if($tampil){
                array_push($response["response"], $item);

                //}


            }

            $response["success"] = true;
        } else {
            $response["success"] = false;
            $response["response"] = "Tidak ditemukan data";
        }







        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }

}
?>