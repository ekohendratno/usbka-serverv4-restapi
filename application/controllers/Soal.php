<?php
class Soal extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');

    }
    function index(){
        $soal = $this->db
            ->select('*')
            ->from('soal')
            ->where(array(
                //"soal_id" => "1147"
                //"soal_guru" => "EKO HENDRATNO, S.KOM",
                //"soal_pelajaran" => "C2 AKP",
                "soal_kelas" => "10"

               //"soal_guru" => "Abdul Karim, S.Pd.I",
                //"soal_pelajaran" => "Matematika"
                //"soal_pelajaran" => "Bahasa Indonesia"
            ));


        $response = array();
        $response["success"] = false;
        $response["response"] = array();



        $urutan = 1;
        foreach ($soal->limit(30)->get()->result_array() as $row1){



            $item = array();
            $item["soal_urutan"] = $urutan;
            $item["soal_id"] = $row1["soal_id"];
            $item["soal_jenis"] = $row1["soal_jenis"];
            $item["soal_text"] = $this->philsXMLClean( $this->strip($row1["soal_text"]) );
            $item["soal_text_deskripsi"] =$this->philsXMLClean( $row1["soal_text_deskripsi"] );
            $item["soal_text_jawab"] = array();
            $item["soal_date"] = $row1["soal_date"];
            $item["soal_date_update"] = $row1["soal_date_update"];



            $soal_text_jawab = json_decode( $row1["soal_text_jawab"] );

            for($i=0; $i<count((array)$soal_text_jawab); $i++){

                array_push($item["soal_text_jawab"], array(
                    "jawab" => (int) $soal_text_jawab[$i][0],
                    "jawab_text" => $this->philsXMLClean( $this->strip2($soal_text_jawab[$i][1]) )
                ) );
            }

            //htmlentities( $bb[1] , ENT_QUOTES | ENT_IGNORE, "UTF-8")



            array_push($response["response"],$item);

            $urutan++;
        }

        if(count($response["response"]) > 0){
            $response["success"] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response);
    }






    function philsXMLClean($strin) {
        $strout = null;

        for ($i = 0; $i < strlen($strin); $i++) {
            $ord = ord($strin[$i]);

            if (($ord > 0 && $ord < 32) || ($ord >= 127)) {
                $strout .= "&amp;#{$ord};";
            }
            else {
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
        }



        return $this->strip3($strout);
    }


    function strip($var) {
        $allowed = '<p><br>
            <ul><ol><li><dl><dt><dd><strong><em><b><i><u>
            <img><audio><video>
            <table><tbody><td><tfoot><th><thead><tr>
            <iframe>';

        return strip_tags($var, $allowed);
    }

    function strip1($var) {
        $allowed = '<p><br>
            <ul><ol><li><dl><dt><dd><strong><em><b><i><u>
            <img><audio><video>
            <table><tbody><td><tfoot><th><thead><tr>
            <iframe>';

        return strip_tags($var, $allowed);
    }
    function strip2($var) {
        $allowed = '<br>
            <ul><ol><li><dl><dt><dd><strong><em><b><i><u>
            <img><audio><video>
            <table><tbody><td><tfoot><th><thead><tr>
            <iframe>';

        return strip_tags($var, $allowed);
    }

    function strip3($strout){
        return str_replace("&nbsp;&nbsp;","&nbsp;",$strout);
    }


}