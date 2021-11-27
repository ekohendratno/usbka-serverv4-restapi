<?php
class Promosi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');

    }
    function index(){
        $response = array();
        $response["success"] = true;
        $response["response"] = array();

        $nomor = rand(1,4);

        $response["response"] = array(
            "title" => "",
            "title_desc" => "",
            "link" => "",
            "image" => base_url() . "assets/img/promosi/promo".$nomor.".png"
        );

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response);
    }

}