<?php
class Tryout extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');

    }
    function index(){


        $pelajaran = $this->input->get("pelajaran");
        $guru = $this->input->get("guru");
        $kelas = $this->input->get("kelas");
        $untuk = $this->input->get("untuk");
        $tahunajaran = $this->input->get("tahunajaran");


        $response = array();
        $response["success"] = false;
        $response["response"] = array();



        $this->db->select('*')->from('soal');

        $this->db->where('soal_pelajaran',$pelajaran);
        $this->db->where('soal_guru',$guru);
        $this->db->where('soal_kelas',$kelas);
        $this->db->where('soal_untuk',$untuk);
        $this->db->where("soal_tahunajaran", $tahunajaran);

        $this->db->order_by('soal_id','RANDOM');
        $this->db->limit(40);

        $urutan = 1;
        foreach ($this->db->get()->result_array() as $row1){

            $ambil_soal_parent = $this->db->get_where('soal_parent',array(
                'soal_parent_tahunajaran'=>$tahunajaran,
                'soal_parent_id'=> $row1["soal_parent_id"]
            ) )->result_array();

            $soal_text_parent = "<div id='soal_parent'>";
            foreach ($ambil_soal_parent as $row2){
                $soal_text_parent.= $row2["soal_parent_text"];
            }

            $soal_text_parent.= "</div>";

            $item = array();
            $item["soal_urutan"] = $urutan;
            $item["soal_id"] = $row1["soal_id"];
            $item["soal_jenis"] = $row1["soal_jenis"];
            $item["soal_text"] = $this->_philsXMLClean( $this->_strip($row1["soal_text"]) );

            $item["soal_text_parent"] = $this->_philsXMLClean( $this->_strip($soal_text_parent) );
            $item["soal_text_deskripsi"] = $this->_philsXMLClean( $this->_strip($row1["soal_text_deskripsi"]) );
            $item["soal_text_jawab"] = array();
            $item["soal_date"] = $row1["soal_date"];
            $item["soal_date_update"] = $row1["soal_date_update"];
            $soal_text_jawab = json_decode( $row1["soal_text_jawab"] );

            for($i=0; $i<count((array)$soal_text_jawab); $i++){

                array_push($item["soal_text_jawab"], array(
                    "jawab" => (int) $soal_text_jawab[$i][0],
                    "jawab_text" => $this->_philsXMLClean( $this->_strip2($soal_text_jawab[$i][1]) )
                ) );
            }

            array_push($response["response"],$item);
            $urutan++;
        }



        if(count($response["response"]) > 0){
            $response["success"] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response);

    }



    function _philsXMLClean($strin) {
        $strout = null;

        for ($i = 0; $i < strlen($strin); $i++) {
            switch ($strin[$i]) {
                case '<':
                    $strout .= '&lt;';
                    break;
                case '>':
                    $strout .= '&gt;';
                    break;
                case '&':
                    $strout .= '&amp;';
                    break;
                case '"':
                    $strout .= '&quot;';
                    break;
                default:
                    $strout .= $strin[$i];
            }
        }


        $strout = mb_convert_encoding($strout, 'HTML-ENTITIES', 'UTF-8');

        return $this->_strip3($strout);
    }

    function _strip($var) {




        $allowed = '<p><br>
            <ul><ol><li><dl><dt><dd><strong><em><b><i><u>
            <img><audio><video>
            <table><tbody><td><tfoot><th><thead><tr>
            <iframe>';

        return strip_tags($var, $allowed);
    }

    function _strip2($var) {
        $allowed = '<br>
            <ul><ol><li><dl><dt><dd><strong><em><b><i><u>
            <img><audio><video>
            <table><tbody><td><tfoot><th><thead><tr>
            <iframe>';

        return strip_tags($var, $allowed);
    }

    function _strip3($strout){

        /**
        $strout = str_replace(
        "https://cbt.smkn1candipuro.sch.id/uploads/",
        "https://cbtv4.smkn1candipuro.sch.id/assets/",
        $strout
        );*/

        $strout = str_replace(
            "&nbsp;&nbsp;",
            "&nbsp;",
            $strout
        );

        return $strout;
    }


}