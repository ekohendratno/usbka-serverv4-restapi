<?php
class Arsipsoal extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');

    }


    function index(){

        $t = $this->input->get('t');
        $k = $this->input->get('k');

        $this->db->select('*')->from('soal');
        $this->db->where('soal_tahunajaran',$t);
        $this->db->where('soal_kelas',$k);

        $this->db->group_by('soal_pelajaran');
        $this->db->group_by('soal_kelas');
        $this->db->group_by('soal_guru');
        $this->db->order_by('soal_pelajaran','asc');
        $this->db->group_by('soal_untuk');

        $response = array();
        $response["success"] = false;
        $response["response"] = array();


        $tt = explode("-", $t); // 2021/2022-Genap
        $tt1 = $tt[0]; // tahun
        $tt2 = $tt[1]; // semester


        foreach ($this->db->get()->result_array() as $row){

            $tampilkan = "";
            $this->db->select('*')->from('ta')->where("ta_aktif",1)->where("ta_tahun",$tt1)->where("ta_semester",$tt2);
            foreach ($this->db->get()->result() as $ta){
                $tampilkan = $ta->ta_arsip_kecuali;
            }

            $baris = array();
            $baris['soal_kelas']     = $row['soal_kelas'];
            $baris['soal_pelajaran']     = $row['soal_pelajaran'];
            $baris['soal_guru']     = $row['soal_guru'];
            $baris['soal_untuk']     = $row['soal_untuk'];
            $baris['soal_tahunajaran']     = $row['soal_tahunajaran'];

            if( $row['soal_untuk'] != $tampilkan ){


                $response["success"] = true;
                array_push($response["response"], $baris);
            }


        }

        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);

    }


    function arsip_ta_list(){

        $this->db->select('*')->from('ta')->where("ta_arsip",1)->order_by('ta_tahun','desc');

        $data = array();
        foreach ($this->db->get()->result() as $ta){
            $item = array();
            $item['tahun'] = $ta->ta_tahun;
            $item['semester'] = $ta->ta_semester;
            $item['label'] = $ta->ta_tahun.'-'.$ta->ta_semester;

            array_push($data, $item);
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $data );
    }


}