<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/ujian.min.css') ?>" rel="stylesheet">

    <style type="text/css">
        body {
            background: #f2f2f2;
        }

        td {
            border: 1px solid #ddd;
            padding: 4px;
        }
    </style>
    <script>
        $('#loading_ajax').show();
    </script>
</head>

<body id="body" style="padding-top: 0px; margin-top: -3px;">
    <div class="wrapper" style="height: auto; min-height: 100%;">

        <div class="container container-medium">

            <div class="row">
                <!-- Blog Entries Column -->

                <div class="panel panel-default" style="margin-bottom: -10px;">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">

                                <?php
                                $html  = '';
                                $arr_jawab = array();

                                $no = 1;
                                foreach ($response as $item) {

                                    $html .= '<div class="step" id="widget_' . $no . '">';


                                    $html .= '<div style="border-bottom: 1px solid #ddd; text-align: center">';
                                    $html .= '<div class="btn btn-default btn-circle text-center" style="margin-bottom: -15px">' . $no . '</div>';
                                    $html .= '</div>';


                                    $html .= '<div class="soal">';

                                    if (!empty($item['soal_parent_text'])) {
                                        $html .= '<div class="soal_parent">' . html_entity_decode($item['soal_parent_text']) . '</div>';
                                    }

                                    $html .= '<div class="clearfix"></div>';
                                    $html .= html_entity_decode($item['soal_text']);
                                    $html .= '</div>';

                                    $jenis = $item['soal_jenis'];
                                    if ($jenis == "optional") {

                                        $soal_text_jawab = json_decode($item['soal_text_jawab']);




                                        $html .= '<div class="funkyradio">';

                                        $opsi = array("1", "2", "3", "4", "5");
                                        $opsi2 = array("A", "B", "C", "D", "E");
                                        for ($j = 0; $j <= count($soal_text_jawab)-1; $j++) {

                                           
                                            if(!empty($soal_text_jawab[$j][1])){

                                                $opsional = 'opsi_' . $opsi[$j] . '_' . $no;
                                                $checked = $soal_text_jawab[$j][0] == "1" ? "checked" : "";

                                                $html .= '<div class="funkyradio-success">';
                                                $html .= '<input disabled type="radio" id="' . $opsional . '" name="opsi_' . $no . '" value="' . strtoupper($opsi[$j]) . '" ' . $checked . '>';
                                                $html .= '<label for="' . $opsional . '"><div class="huruf_opsi">' . strtoupper($opsi2[$j]) . '</div><div class="huruf_opsi_jawaban"><p></p>' . html_entity_decode($soal_text_jawab[$j][1]) . '<p></p></div></label>';
                                                $html .= '</div>';
                                            }

                                        }
                                        $html .= '</div>';

                                    } elseif ($jenis == "checked") {

                                        $soal_text_jawab = json_decode($item['soal_text_jawab']);




                                        $html .= '<div class="funkyradio">';

                                        for ($j = 0; $j <= count($soal_text_jawab)-1; $j++) {

                                            if(!empty($soal_text_jawab[$j][1])){
                                            
                                                $opsional = 'opsi_' . $j . '_' . $no;
                                                $checked = $soal_text_jawab[$j][0] == "1" ? "checked" : "";
    
                                                $html .= '<div class="funkyradio-success">';
                                                $html .= '<input disabled type="checkbox" id="' . $opsional . '" name="opsi_' . $no . '" value="' . strtoupper($j) . '" ' . $checked . '>';
                                                $html .= '<label for="' . $opsional . '"><div class="huruf_opsi">' . strtoupper($j) . '</div><div class="huruf_opsi_jawaban"><p></p>' . html_entity_decode($soal_text_jawab[$j][1]) . '<p></p></div></label>';
                                                $html .= '</div>';

                                            }


                                        }
                                        $html .= '</div>';

                                    } elseif ($jenis == "essay") {
                                        $soal_text_jawab = $item['soal_text_jawab'];

                                        $opsional = 'opsi_' . $no;



                                        $html .= '<div class="funkyradio">';
                                        
                                        $html .= '<div class="funkyradio-success">';
                                        $html .= '<input disabled type="radio" id="' . $opsional . '" name="opsi_' . $no . '" value="' . $no . '">';
                                        $html .= '<label for="' . $opsional . '"><div class="huruf_opsi">...</div><div class="huruf_opsi_jawaban"><p></p>' . html_entity_decode($soal_text_jawab) . '<p></p></div></label>';
                                        $html .= '</div>';
                                        
                                        $html .= '</div>';
                                    } elseif ($jenis == "essayText") {
                                        $soal_text_jawab = $item['soal_text_jawab'];

                                        $opsional = 'opsi_' . $no;



                                        $html .= '<div class="funkyradio">';
                                        
                                        $html .= '<div class="funkyradio-success">';
                                        $html .= '<input disabled type="radio" id="' . $opsional . '" name="opsi_' . $no . '" value="' . $no . '">';
                                        $html .= '<label for="' . $opsional . '"><div class="huruf_opsi">...</div><div class="huruf_opsi_jawaban"><p></p>' . html_entity_decode($soal_text_jawab) . '<p></p></div></label>';
                                        $html .= '</div>';
                                        
                                        $html .= '</div>';

                                    } elseif ($jenis == "essayNumber") {
                                        $soal_text_jawab = $item['soal_text_jawab'];

                                        $opsional = 'opsi_' . $no;



                                        $html .= '<div class="funkyradio">';
                                        
                                        $html .= '<div class="funkyradio-success">';
                                        $html .= '<input disabled type="radio" id="' . $opsional . '" name="opsi_' . $no . '" value="' . $no . '">';
                                        $html .= '<label for="' . $opsional . '"><div class="huruf_opsi">...</div><div class="huruf_opsi_jawaban"><p></p>' . html_entity_decode($soal_text_jawab) . '<p></p></div></label>';
                                        $html .= '</div>';
                                        
                                        $html .= '</div>';
                                    } elseif ($jenis == "boolean") {
                                        
                                        $soal_text_jawab = $item['soal_text_jawab'];




                                        $html .= '<div class="funkyradio">';

                                        $opsi = array("Salah", "Benar");
                                        for ($j = 0; $j <= 1; $j++) {

                                            $opsional = 'opsi_' . $opsi[$j] . '_' . $no;
                                            $checked = $soal_text_jawab == $j ? "checked" : "";

                                            $html .= '<div class="funkyradio-success">';
                                            $html .= '<input disabled type="radio" id="' . $opsional . '" name="opsi_' . $no . '" value="' . strtoupper($opsi[$j]) . '" ' . $checked . '>';
                                            $html .= '<label for="' . $opsional . '"><div class="huruf_opsi">' . strtoupper($j) . '</div><div class="huruf_opsi_jawaban"><p></p>' . html_entity_decode($opsi[$j]) . '<p></p></div></label>';
                                            $html .= '</div>';

                                        }
                                        $html .= '</div>';

                                    } elseif ($jenis == "sort") {
                                        
                                        $soal_text_jawab = json_decode($item['soal_text_jawab']);




                                        $html .= '<div class="funkyradio">';

                                        for ($j = 0; $j <= count($soal_text_jawab)-1; $j++) {

                                            
                                            $opsional = 'opsi_' . $j . '_' . $no;
    
                                            $html .= '<div class="funkyradio-success">';
                                            $html .= '<input disabled type="radio" id="' . $opsional . '" name="opsi_' . $no . '" value="' . strtoupper($j) . '" >';
                                            $html .= '<label for="' . $opsional . '"><div class="huruf_opsi">' . strtoupper($j) . '</div><div class="huruf_opsi_jawaban"><p></p>' . html_entity_decode($soal_text_jawab[$j]) . '<p></p></div></label>';
                                            $html .= '</div>';

                                        }
                                        $html .= '</div>';


                                    } elseif ($jenis == "match") {
                                        
                                        $soal_text_jawab = json_decode($item['soal_text_jawab']);




                                        $html .= '<div class="funkyradio">';

                                        for ($j = 0; $j <= count($soal_text_jawab); $j++) {

                                            if( !empty($soal_text_jawab[$j]) ){

                                                $opsional = 'opsi_' . $j . '_' . $no;
    
                                                $html .= '<div class="funkyradio-success">';
                                                $html .= '<input disabled type="radio" id="' . $opsional . '" name="opsi_' . $no . '" value="' . strtoupper($j) . '" >';
                                                $html .= '<label for="' . $opsional . '"><div class="huruf_opsi">#</div><div class="huruf_opsi_jawaban"><p></p>' . html_entity_decode($soal_text_jawab[$j]) . '<p></p></div></label>';
                                                $html .= '</div>';

                                            }
                                        }
                                        $html .= '</div>';
                                    } else {
                                    }


                                    $html .= '</div>';

                                    $no++;
                                }

                                echo $html;
                                ?>


                            </div>
                        </div>


                    </div>

                </div>
            </div>






        </div>
    </div>
    <style type="text/css">
        .funkyradio input[type="radio"]:empty~label:before,
        .funkyradio input[type="checkbox"]:empty~label:before {
            position: absolute;
            display: block;
            top: 8px;
            /*0*/
            bottom: 0;
            left: 0;
            content: '';
            width: 3em;
            height: 3em;
            /*del*/
            border: 1px solid #D1D3D4;
            background: #D1D3D4;
            border-radius: 50%;
            /*3em*/
        }

        .funkyradio input[type="radio"]:checked~label:before,
        .funkyradio input[type="checkbox"]:checked~label:before {
            background: #000;
            border: 1px solid #000;
            color: #fff;
        }
    </style>

    <script>
        $('#loading_ajax').fadeOut("slow");
    </script>

</body>

</html>