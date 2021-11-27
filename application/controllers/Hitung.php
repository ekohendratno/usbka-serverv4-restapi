<?php
class Hitung extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');

    }


    function index(){
        $id = $this->input->get('id');
        $soal_jawab = $this->db->get_where('soal_jawab',array('soal_jawab_id'=> $id))->result();


        $data = array();
        $data['success'] = false;
        $data['response'] = array();
        foreach ($soal_jawab as $x) {

            $soal_jawab_list_opsi   = json_decode($x->soal_jawab_list_opsi);
            $jumlah_soal            = $x->soal_jawab_jumlah_soal;
            $jumlah_benar           = 0;
            $jumlah_salah           = 0;
            $jumlah_terjawab        = 0;
            $jumlah_tidakterjawab   = 0;
            $nilai                  = 0;

            foreach ($soal_jawab_list_opsi as $soal_jawab_list_opsi_item) {
                $id_soal    = $soal_jawab_list_opsi_item[0];
                $jenis      = $soal_jawab_list_opsi_item[1];
                $ragu       = $soal_jawab_list_opsi_item[2];
                $jawaban    = $soal_jawab_list_opsi_item[3]; //0-4

                array_push($data['response'],$jawaban);
                /**
                //jika jenis jawaban optional dan jawaban tidak kosong
                if ($jenis == 'optional') {

                    if( $jawaban != "-" ) {
                        $jawaban_data = array();
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array('soal_id' => $id_soal))->result();
                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = json_decode($soal->soal_text_jawab);

                            //samakan jawaban peserta dengan jawaban soal
                            $nomor_jawaban = 0;
                            foreach ($soal_text_jawab as $soal_text_jawab_item) {

                                if ( $soal_text_jawab_item[0] == 1 && $jawaban == $nomor_jawaban) {
                                    $jumlah_benar++;
                                }

                                $nomor_jawaban++;
                            }

                        }

                        $jumlah_terjawab++;
                    }

                    //}elseif ($jenis == 'checkbox' && $jawaban != "" && $jawaban != "-") {
                    //}elseif ($jenis == 'essay' && $jawaban != "" && $jawaban != "-") {
                }else{
                    $jumlah_tidakterjawab++;
                }*/



            }

            $jumlah_salah = $jumlah_soal-$jumlah_benar;



            if($jumlah_soal == 40){
                $nilai = ($jumlah_benar*25)/10;
            }elseif($jumlah_soal == 30){
                $nilai = ($jumlah_benar/3)*10;
            }elseif($jumlah_soal == 25){
                $nilai = $jumlah_benar*4;
            }


            $nilai = round($nilai,2);
            $nilai_bulat = round($nilai);


            /**
            array_push($data['response'], array(
                'jumlah_benar' => $jumlah_benar,
                'jumlah_salah' => $jumlah_salah,
                'jumlah_terjawab' => $jumlah_terjawab,
                'jumlah_tidakterjawab' => $jumlah_tidakterjawab,
                'nilai' => $nilai,
                'nilai_bulat' => $nilai_bulat,
            ));*/
        }


        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}