<?php
class Laporkan extends CI_Controller
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

        $response = array();
        $response["success"] = false;
        $response["response"] = array();
        $id = $this->input->get('id');


        $laporkan = $this->db->get_where('laporkan',array(
            'soal_jawab_id'=> $id
        ));

        if( $laporkan->num_rows() > 0){

            foreach ($laporkan->result() as $l){

                $this->db->where(array(
                    'soal_jawab_id'   => $id
                ));
                $this->db->update('laporkan', array(
                    'laporkan_hits'    => ($l->laporkan_hits +1)
                ));
            }

        }else{

            $this->db->insert('laporkan',array(
                'laporkan_hits'  => 1,
                'soal_jawab_id' => $id
            ));

        }

        $response["success"] = true;

        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }

}
?>