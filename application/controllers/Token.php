<?php
class Token extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');

    }

    function index(){
        $kode = $this->input->get("kode");
        $pengaturanToken = json_decode($this->m->getpengaturan("pengaturanToken"), true);

        $tanggal_sekarang = date('Y-m-d');
        $tanggal_sekarang_pembanding = date('Y-m-d H:i:s');
        $tgl_buka   = date('Y-m-d H:i:s', strtotime($tanggal_sekarang. " " .$pengaturanToken["buka"]));
        $tgl_tutup  = date('Y-m-d H:i:s', strtotime($tanggal_sekarang. " " .$pengaturanToken["tutup"]));
        $data = array();
        $data["success"] = false;
        $data['ujian_token_text'] = '';


        $xtanggal_sekarang = strtotime($tanggal_sekarang_pembanding) * 1000;
        $xtgl_buka = strtotime($tgl_buka) * 1000;
        $xtgl_tutup = strtotime($tgl_tutup) * 1000;

        //jika jam sekarang lebih dari jam x &&
        //jika jam sekarang kurang dari jam y
        if( $xtanggal_sekarang >= $xtgl_buka && $xtanggal_sekarang <= $xtgl_tutup  ){

            $ujian_token = $this->db->get_where('ujian_token',array(),1)->result();
            foreach ($ujian_token as $item){
                if(!empty($kode) && ($item->ujian_token_text == $kode || $kode == 1) ){
                    $data['ujian_token_text'] = $item->ujian_token_text;
                    $data['ujian_token_tanggal'] = $ujian_token[0]->ujian_token_tanggal;
                    $data["success"] = true;
                }
            }
        }

        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

}
?>