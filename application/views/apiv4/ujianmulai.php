<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no" />

    <title><?php echo $title?></title>
    <script type="text/javascript">var base_url = "<?php echo base_url(); ?>";</script>



    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>

    <link href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/adminlte.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/sweetalert/sweetalert.min.js"></script>

    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom.min.css') ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/ujian.min.css') ?>" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/countdown/jquery.countdownTimer.js"></script>

    <style type="text/css">
        body{
            background: #fff;
            overflow-x: hidden; /* Hide horizontal scrollbar */
        }
        .navbar-inverse{background-color:  #fff;}

        .funkyradio input[type="radio"]:empty ~ label, .funkyradio input[type="checkbox"]:empty ~ label {
            line-height: 2.5em;
        }
        .soal-box-jawab {
            width: auto;
        }

        .control-sidebar-bg, .control-sidebar {
            width: 280px;
        }

        .panel {
            /* margin-bottom: 20px; */
            /* background-color: #fff; */
            border: 0px solid transparent;
            border-radius: 0px;
            -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 0%);
            box-shadow: 0 1px 1px rgb(0 0 0 / 0%);
        }

        .panel-footer2, .panel-heading2 {
            padding: 10px 0px;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #fff;
            color: white;
            text-align: center;
        }
        aside.control-sidebar {
            box-shadow: none;
            z-index: 1031;
            height: 100%;
        }
        .control-sidebar-light, .control-sidebar-light+.control-sidebar-bg {
            background: #f9fafc;
            border-left: 1px solid #d2d6de;
        }
        .toggler {
            border-radius: 50% 0 0 50%;
            border: 0px solid #ccc;
            border: 0px solid rgba(0,0,0,.05);
        }
        .soal {
            margin-top: 0px;
        }

        .navbar-inverse {
            background-color: #f2f2f2;
        }
</style>


    <script type="text/javascript">$('#loading_ajax').show();</script>
</head>
<body>
<div id="loading_ajax"><center style="padding:20px;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></div></center></div>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container container-medium">

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        </div><!-- /.navbar-collapse -->
    </div>
</nav>



<div class="wrapper" style="height: auto; min-height: 100%;">

    <div class="container container-medium">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="">
                <form role="form" name="_form" method="post" id="_form">
                    <input type="hidden" name="_soal_jawab_id" id="_soal_jawab_id" value="<?php echo $soal_jawab_id;?>">
                    <input type="hidden" name="_user_id" id="_user_id" value="<?php echo $user_id;?>">
                    <input type="hidden" name="_siswa_id" id="_siswa_id" value="<?php echo $siswa_id;?>">

                    <input type="hidden" name="_waktu_minimal" id="_waktu_minimal" value="<?php echo $waktu_minimal;?>">
                    <input type="hidden" name="_waktu_maksimal" id="_waktu_maksimal" value="<?php echo $waktu_maksimal;?>">

                    <div class="panel">
                        <div class="panel-heading2">

                            <div class="panel-title-button pull-left">
                                <div class="btn-group" role="group">
                                    <div class="btn btn-default ujian-no-text">SOAL NO</div>
                                    <div class="btn btn-default"><span id="soalke">0</span></div>
                                </div>

                                <div class="btn-group" role="group">
                                    <a class="btn btn-default" href="#" onClick="textZoomOut()" style="text-decoration:none"><span class="
glyphicon glyphicon-zoom-out"></span></a>
                                    <a class="btn btn-default" href="#" onClick="textZoomNormal()" style="text-decoration:none; display: none;"><span class="
fas fa-font"></span></a>
                                    <a class="btn btn-default" href="#" onClick="textZoomIn()" style="text-decoration:none"><span class="
glyphicon glyphicon-zoom-in"></span></a>
                                </div>
                            </div>
                            <div class="panel-title-button pull-right">
                                <div class="btn-group" role="group">
                                    <div id="clock" class="btn btn-default">0</div>
                                    <div class="btn btn-default ujian-icon-time"><span class="
glyphicon glyphicon-time"></span></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <?php
                                    $html  = '';
                                    $arr_jawab = array();

                                    foreach ($list_jawaban as $v) {
                                        $idx = $v[0];
                                        $arr_jawab[$idx] = array("j"=>$v[3],"r"=>$v[2]);
                                    }

                                    $no = 1;
                                    foreach($soal as $item){

                                        $ragu = $arr_jawab[$item['soal_id']]["r"] == "" ? "N" : $arr_jawab[$item['soal_id']]["r"];

                                        $html .= '<input type="hidden" name="no" value="'.$no.'">';
                                        $html .= '<input type="hidden" name="id_soal_'.$no.'" value="'.$item['soal_id'].'">';
                                        $html .= '<input type="hidden" name="rg_'.$no.'" id="rg_'.$no.'" value="'.$ragu.'">';
                                        $html .= '<input type="hidden" name="jenis_'.$no.'" id="jenis_'.$no.'" value="'.$item['soal_jenis'].'">';
                                        $html .= '<div class="step" id="widget_'.$no.'">';

                                        if(!empty($item['soal_file']) ){
                                            //$html .= $this->m->html_media_player( $item['soal_file'] );
                                        }

                                        $html .= '<div class="soal">'.html_entity_decode( $item['soal_text'] ).'</div>';



                                        if( $item['soal_jenis'] == 'essay' ){
                                            $html .= '<textarea type="text" class="form-control" id="essay_'.$no.'"  name="essay_'.$no.'">'.$item['jawaban'].'</textarea>';
                                        }else{


                                            $soal_text_jawab = json_decode($item['soal_text_jawab']);
                                            $html .= '<div class="funkyradio">';

                                            $opsi = array("1","2","3","4","5");
                                            $opsi2 = array("A","B","C","D","E");
                                            for($j = 0; $j<=4; $j++) {


                                                //$opsox = $j + 1;
                                                $opsional = 'opsi_' . $opsi[$j] . '_' . $no;
                                                $checked = $arr_jawab[$item['soal_id']]["j"] == strtoupper($opsi[$j]) ? "checked" : "";
                                                //$jawaban1 = empty($jawaban[0][$j]) ? '-' : $jawaban[$j];

                                                $html .= '<div class="funkyradio-success" onclick="return simpan_sementara();">';
                                                $html .= '<input type="radio" id="'.$opsional.'" name="opsi_'.$no.'" value="'.strtoupper($opsi[$j]).'" '.$checked.'>';
                                                $html .= '<label for="'.$opsional.'"><div class="huruf_opsi">'.strtoupper($opsi2[$j]).'</div><div class="huruf_opsi_jawaban"><p></p>'.html_entity_decode( !empty($soal_text_jawab[$j][1]) ? $soal_text_jawab[$j][1] : "" ).'<p></p></div></label>';

                                                $html .= '<div class="clearfix"></div><br/><br/>';
                                                $html .= '</div>';

                                            }
                                            $html .= '</div>';


                                        }

                                        $html .= '</div>';

                                        $no++;

                                    }

                                    echo $html;
                                    ?>


                                </div>
                            </div>


                        </div>
                        <div class="panel-footer2 text-center">
                            <div class="container container-medium">

                                <a style="float: left;" class="action back btn btn-success btn-md" rel="0" onclick="return back();">Sebelumnya</a>

                                <a class="ragu_ragu btn btn-default" rel="1" onclick="return tidak_jawab();" style="display: none;">Ragu-ragu</a>

                                <a style="float: right;" class="action next btn btn-success btn-md" rel="2" onclick="return next();">Selanjutnya</a>

                                <a style="float: right;" class="selesai action submit btn btn-danger btn-md" onclick="return simpan_akhir_cek(1);">Selesai</a>

                                <input type="hidden" name="jml_soal" id="jml_soal" value="<?php echo $no;?>">
                                <div class="clear"></div>

                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>




        <div class="side">

            <a href="#" id="silit" class="left-btn" data-toggle="control-sidebar">
                <div class="toggler trans-80" style="right:0px;">
                    <span class="glyphicon glyphicon-chevron-left" style="color:#fff">&nbsp;</span>
                </div>
            </a>

            <aside class="control-sidebar control-sidebar-light control-sidebar-close">
                <div class="text-center" style="padding-top:20px; font-size:14px; "><h3>Daftar Soal</h3></div>
                <div class="contente"><div id="tampil_jawaban" class="row text-center"></div></div>
            </aside>

        </div>

    </div>
</div>

<script type="text/javascript">

    var id = $("#_soal_jawab_id").val();
    var besarfont = 14;


    textZoomNormal();

    $(document).ready(function() {
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
            //alert("Maaf ujian sedang berlangsung harap selesaikan dahulu");
        };
    });


    $('#bs-example-navbar-collapse-1').empty();
    $('.navbar.navbar-ujian').attr("style", "background-color: rgb(60, 75, 89,0.95);");
    $('.panel-heading2').hide();



    $(':checkbox').each(function () {
        $(this).removeAttr('checked');
        $('input[type="radio"]').prop('checked', false);
    })


    $(".step").hide();
    $(".back").hide();
    $("#widget_1").show();


    hitung();
    simpan_sementara();
    buka(1);

    widget      = $(".step");
    btnnext     = $(".next");
    btnback     = $(".back");
    btnsubmit   = $(".submit");

    widget = $(".step");
    total_widget = widget.length;

    function buka(id_widget) {
        $(".next").attr('rel', (id_widget+1));
        $(".back").attr('rel', (id_widget-1));
        $(".ragu_ragu").attr('rel', (id_widget));
        cek_status_ragu(id_widget);
        cek_terakhir(id_widget);

        $("#soalke").html(id_widget);

        $(".step").hide();
        $("#widget_"+id_widget).show();

    }

    $('.btn_soal_close').click(function() {
        var side = $('#silit').attr('class');
        if (side == "right-btn") {
            $('.toggler .glyphicon').removeClass('.glyphicon glyphicon-chevron-right');
            $('.toggler .glyphicon').addClass('.glyphicon glyphicon-chevron-left');
            $('#silit').removeClass('right-btn');
            $('#silit').addClass('left-btn');
            $('.toggler').css('right', '0px');
            $('.control-sidebar').removeClass('control-sidebar-open');
            $('.control-sidebar').css('display', 'none');
        }

    });

    function cek_status_ragu(id_soal) {
        var status_ragu = $("#rg_"+id_soal).val();

        if (status_ragu == "N") {
            $(".ragu_ragu").html('<span class="fas fa-toggle-off"></span> Ragu');
        } else {
            $(".ragu_ragu").html('<span class="fas fa-toggle-on"></span> Tdk Ragu');
        }
    }

    function cek_terakhir(id_soal) {
        var jml_soal = $("#jml_soal").val();
        jml_soal = (parseInt(jml_soal) - 1);


        if (jml_soal == id_soal) {
            $(".back").show();
            $(".next").hide();
            $(".selesai").show();
        }else {
            $(".next").show();
            $(".selesai").hide();
        }

        //console.log(id_soal);


        if( id_soal == 1 ){
            $(".back").show();
            $(".back").addClass('disabled');
            $(".back").bind('click');
        }else{
            $(".back").removeClass('disabled');
            $(".back").unbind('click');
        }

    }

    function next() {
        var berikutnya  = $(".next").attr('rel');
        berikutnya = parseInt(berikutnya);
        berikutnya = berikutnya > total_widget ? total_widget : berikutnya;

        $("#soalke").html(berikutnya);

        $(".next").attr('rel', (berikutnya+1));
        $(".back").attr('rel', (berikutnya-1));
        $(".ragu_ragu").attr('rel', (berikutnya));
        cek_status_ragu(berikutnya);
        cek_terakhir(berikutnya);

        var sudah_akhir = berikutnya == total_widget ? 1 : 0;

        $(".step").hide();
        $("#widget_"+berikutnya).show();

        if (sudah_akhir == 1) {
            $(".back").show();
            $(".next").hide();
        } else if (sudah_akhir == 0) {
            $(".next").show();
            $(".back").show();
        }

        simpan_sementara();
        simpan();
    }

    function back() {
        var back  = $(".back").attr('rel');
        back = parseInt(back);
        back = back < 1 ? 1 : back;

        $("#soalke").html(back);

        $(".back").attr('rel', (back-1));
        $(".next").attr('rel', (back+1));
        $(".ragu_ragu").attr('rel', (back));
        cek_status_ragu(back);
        cek_terakhir(back);

        $(".step").hide();
        $("#widget_"+back).show();

        var sudah_awal = back == 1 ? 1 : 0;

        $(".step").hide();
        $("#widget_"+back).show();

        if (sudah_awal == 1) {
            //$(".back").hide();
            $(".next").show();
        } else if (sudah_awal == 0) {
            $(".next").show();
            $(".back").show();
        }

        simpan_sementara();
        simpan();
    }

    function tidak_jawab() {
        var id_step = $(".ragu_ragu").attr('rel');
        var status_ragu = $("#rg_"+id_step).val();

        if (status_ragu == "N") {
            $("#rg_"+id_step).val('Y');
            $("#btn_soal_"+id_step).removeClass('btn-success');
            $("#btn_soal_"+id_step).addClass('btn-warning');

        } else {
            $("#rg_"+id_step).val('N');
            $("#btn_soal_"+id_step).removeClass('btn-warning');
            $("#btn_soal_"+id_step).addClass('btn-success');
        }


        cek_status_ragu(id_step);

        simpan_sementara();
        simpan();
    }

    function cek_tidak_jawab() {

        var f_asal  = $("#_form");
        var form  = getFormData(f_asal);

        var jml_soal = form.jml_soal;
        jml_soal = parseInt(jml_soal);

        var hasil_jawaban = "";

        var jml_ragu = 0;

        for (var i = 1; i < jml_soal; i++) {
            var idx = 'opsi_'+i;

            var idx2 = 'rg_'+i;
            var jawab = form[idx];
            var ragu = form[idx2];

            var warna = ' default';
            if (jawab != undefined) {
                if (ragu == "Y") {
                    jml_ragu++;
                }

            }

        }

        return jml_ragu;
    }



    function simpan_akhir_cek(distance) {
        if( cek_tidak_jawab() > 0 ){
            swal({
                title: "Perhatian!",
                text: "Masih ada soal tes yang ragu ragu, tetap ingin mengakhiri tes?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete || distance < 1) {
                    simpan_akhir(distance);
                }
            });
        }else{
            simpan_akhir(distance);
        }
    }

    function simpan_akhir(distance) {
        simpan();

        swal({
            title: "Ujian selesai.",
            text: "Anda yakin akan mengakhiri tes ini..?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            allowOutsideClick: false,
            closeOnClickOutside: false,
        }).then((willDelete) => {
            if (willDelete || distance < 1) {
                simpan_akhir_done();

            }
        });
    }

    function simpan_akhir_done() {

        simpan();
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>apiv4/ujiansimpanakhir?id="+id,
            dataType: 'json',
            beforeSend: function() {
                $('.ajax-loading').show();
            },
            success: function(r) {

                if(r.status == "ok") {

                    AndroidInterface.showToast("Ujian Telah Usai!");

                    //window.location.assign("<?php echo base_url(); ?>restapi/ujianselesai?id="+ujian_id);
                }
            }
        });
    }

    function simpan_sementara() {

        var f_asal  = $("#_form");
        var form  = getFormData(f_asal);
        //form = JSON.stringify(form);
        var jml_soal = form.jml_soal;
        jml_soal = parseInt(jml_soal);

        var hasil_jawaban = "";

        for (var i = 1; i < jml_soal; i++) {
            var idx = 'opsi_'+i;

            var idx2 = 'rg_'+i;
            var jawab = form[idx];
            var ragu = form[idx2];

            var warna = ' default';
            if (jawab != undefined) {
                if (ragu == "Y") {
                    if (jawab == "-") {
                        warna = ' default';
                    } else {
                        warna = ' warning';
                    }
                } else {
                    if (jawab == "-") {
                        warna = ' default';
                    } else {
                        warna = ' success';
                    }
                }

            }else{
                jawab = '-';
            }

            hasil_jawaban += '<a href="#" id="btn_soal_'+(i)+'" onclick="return buka('+(i)+');"><div class="soal-box-jawab btn_soal_close"><div class="text-center soal-box'+warna+'"><span class="text-center soal-notification'+warna+'">'+jawab+'</span><span class="text-center soal-nomor">'+(i)+'</span></div></div></a>';
        }

        $("#tampil_jawaban").html('<div id="yes"></div>'+hasil_jawaban);
    }

    function simpan() {
        var f_asal  = $("#_form");
        var form  = getFormData(f_asal);

        console.log(form);



        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>apiv4/ujiansimpansatu?id="+id,
            data: JSON.stringify(form),
            dataType: 'json',
            contentType: 'application/json; charset=utf-8',
            beforeSend: function() {
                $('.ajax-loading').show();
            }
        }).done(function(response) {
            $('.ajax-loading').hide();

            //console.log(response);

            //$("#tampil_jawaban").empty();

            var hasil_jawaban = "";
            var panjang       = response.data.length;

            //console.log(panjang);


            for (var i = 0; i < panjang; i++) {
                var jawab = '-';
                var warna = ' default';
                if( response.data[i][1] == 'essay'){

                    if( response.data[i][3] != "" ){
                        jawab = '&#10004;';
                    }

                }else{

                    jawab = response.data[i][3];

                }


                if ( response.data[i][2] == "Y") {
                    if ( response.data[i][3] == "") {
                        warna = ' default';
                    } else {
                        warna = ' warning';
                    }
                } else {
                    if ( response.data[i][3] == "") {
                        warna = ' default';
                    } else {
                        warna = ' success';
                    }
                }

                hasil_jawaban += '<a href="#" id="btn_soal_'+(i+1)+'" onclick="return buka('+(i+1)+');"><div class="soal-box-jawab btn_soal_close"><div class="text-center soal-box'+warna+'"><span class="text-center soal-notification'+warna+'">'+jawab+'</span><span class="text-center soal-nomor">'+(i+1)+'</span></div></div></a>';
            }

            $("#tampil_jawaban").html('<div id="yes"></div>'+hasil_jawaban);

        });
        return false;
    }




    function hitung() {
        var _waktu_maksimal = $("#_waktu_maksimal").val(); //tambahan waktu

        var t = new Date(_waktu_maksimal);
        var batas = t.getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = batas - now; //untuk di konvert ke jam, menit dan detik

            //var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            $("div#clock").empty();
            $("div#clock").html("Waktu habis");
            if(hours > 0){
                $("div#clock").html(hours + " jam, " + minutes + " menit, " + seconds +" detik");
            }else if(minutes > 0) {
                $("div#clock").html(minutes + " menit, " + seconds + " detik");
            }else if(seconds > 0) {
                $("div#clock").html("Sisa " + seconds + " detik lagi");
            }

            if (distance < 1) {

                clearInterval(x);
                selesai(distance);
            }
        }, 1000);

    }

    hitung_minimal();
    function hitung_minimal() {
        var _waktu_minimal = $("#_waktu_minimal").val(); //waktu minimal
        var selesai = $(".selesai");

        var t = new Date(_waktu_minimal);
        var batas = t.getTime();


        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = batas - now; //untuk di konvert ke jam, menit dan detik


            //var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            var clock = 0;
            if(hours > 0){
                clock = hours + ":" + minutes + ":" + seconds;
            }else if(minutes > 0) {
                clock = minutes + ":" + seconds;
            }else if(seconds > 0) {
                clock = seconds;
            }


            if (distance < 1) {
                selesai.removeClass('disabled');
                $("a.selesai").unbind('click');

                selesai.html("Selesai");
                clearInterval(x);
            }else{
                selesai.addClass('disabled');
                selesai.html("Selesai["+clock+"]");

                $("a.selesai").bind('click');
            }
            console.log(clock);

        }, 1000);
    }


    function selesai(distance) {
        var f_asal  = $("#_form");
        var form  = getFormData(f_asal);
        //simpan_akhir_cek(ujian_id,distance);



        if( distance < 1 ){
            swal ({
                title: "Ujian berakhir!",
                text: "Ujian telah di akhiri dikarenakan waktu habis !",
                icon: "error",
                buttons: false,
                dangerMode: true,
                allowOutsideClick: false,
                closeOnClickOutside: false,
            });

            setTimeout(function () {
                simpan_akhir_done();
            },300);

        }

        return false;
    }


    function getFormData($form){
        //tinyMCE.triggerSave();
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){

            indexed_array[n['name']] = n['value'];
        });
        return indexed_array;
    }

    function textZoomIn(){
        besarfont=besarfont+2;
        if( besarfont < 64 ){
            $('div.soal').css('font-size',besarfont+'px');
            $('div.huruf_opsi_jawaban').css('font-size',besarfont+'px');
        }
    }

    function textZoomOut(){
        besarfont=besarfont-2;
        if( besarfont > 9 ){
            $('div.soal').css('font-size',besarfont+'px');
            $('div.huruf_opsi_jawaban').css('font-size',besarfont+'px');
        }
    }

    function textZoomNormal(){
        besarfont=16;
        $('div.soal').css('font-size',besarfont+'px');
        $('div.huruf_opsi_jawaban').css('font-size',besarfont+'px');
    }

    $('#loading_ajax').fadeOut("slow");
</script>


<script type="text/javascript">


    $('.navbar-right').attr("style", "display:none;");
    $('.panel-title-button').detach().prependTo( $('#bs-example-navbar-collapse-1') );
    $('.panel-title-button').attr("style", "display:block; margin-top:8px;");

    $('#silit').click(function() {
        var side = $(this).attr('class');
        if(side=="left-btn"){
            $('.toggler .glyphicon').removeClass('.glyphicon glyphicon-chevron-left');
            $('.toggler .glyphicon').addClass('.glyphicon glyphicon-chevron-right');
            $(this).removeClass('left-btn');
            $(this).addClass('right-btn');
            $('.toggler').css('right','280px');
            $('.toggler').css('background-color','rgb(221,221,221)');
        }else{
            $('.toggler .glyphicon').removeClass('.glyphicon glyphicon-chevron-right');
            $('.toggler .glyphicon').addClass('.glyphicon glyphicon-chevron-left');
            $(this).removeClass('right-btn');
            $(this).addClass('left-btn');
            $('.toggler').css('right','0px');
            $('.toggler').css('background-color','rgb(221,221,221)');
        }
    });

    var didScroll = false;
    // on scroll, let the interval function know the user has scrolled
    $(window).scroll(function(event){
        didScroll = true;
    });
    // run hasScrolled() and reset didScroll status
    setInterval(function() {
        if (didScroll) {
            $('nav.navbar').css('box-shadow','2px 2px 2px 2px rgba(0,0,0,.11)');
            didScroll = false;
        }else{
            $('nav.navbar').css('box-shadow','none');
        }
    }, 250);

    $( '.navbar' ).append( '<span class="nav-bg"></span>' );


</script>
</body>
</html>