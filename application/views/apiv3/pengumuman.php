<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no" />

    <title><?php echo $title?></title>


    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <link href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/adminlte.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

    <meta property="og:image" content="<?php echo base_url('assets/img/logocbt.ico') ?>" />
    <link rel="icon" type="image/ico" href="<?php echo base_url('assets/img/logocbt.ico') ?>">
    <link rel='dns-prefetch' href='<?php echo base_url();?>' />

    <link href="<?php echo base_url('assets/css/timeline.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/quotes.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style type="text/css">
        body{
            background: #fff;
            padding-top: 20px;
            padding-bottom: 20px;
		}
    </style>
</head>

<body data-spy="scroll" data-offset="20" data-target="#navbar">
<div id="loading_ajax"><center style="padding:20px;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></div></center></div>

<div class="wrapper" style="height: auto; min-height: 100%;">

    <div class="container container-medium">
        <div class="row">

            <div class="col-md-12">

                <ul class="timeline">
                </ul>

            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    searchFilter(0);
    function searchFilter() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>apiv3/gettimeline/<?php echo $nis;?>',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {

                if(responseData.success){
                    paginationData(responseData.response);

                }else{

                    $('ul.timeline').empty();
                    $('ul.timeline').append('<li class="time-label"><span class="label label-success lg"><i class="glyphicon glyphicon-info-sign"></i> Pengumuman Terakhir</span></li>');
                    var empRow = '<li><i class="glyphicon glyphicon-envelope"></i>'+
                        '<div class="timeline-item">'+
                        '<div class="timeline-body">'+responseData.response+'</div>'+
                        '<div class="timeline-footer"></div>'+
                        '</div>'+
                        '</li>';
                    $('ul.timeline').append(empRow);
                    $('ul.timeline').append('<li><i class="glyphicon glyphicon-time"></i></li>');
                }

                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function paginationData(data) {
        $('ul.timeline').empty();
        $('ul.timeline').append('<li class="time-label"><span class="label label-success lg"><i class="glyphicon glyphicon-info-sign"></i> Pengumuman Terakhir</span></li>');
        for(emp in data){
            var empRow = '<li><i class="glyphicon glyphicon-envelope"></i>'+
                '<div class="timeline-item">'+
                '<h3 class="timeline-header"><i class="glyphicon glyphicon-calendar"></i>'+data[emp].pesan_tanggal+' dari '+data[emp].username+'</h3>'+
                '<div class="timeline-body">'+data[emp].pesan_text+'</div>'+
                '<div class="timeline-footer"></div>'+
                '</div>'+
                '</li>';
            $('ul.timeline').append(empRow);
        }
        $('ul.timeline').append('<li><i class="glyphicon glyphicon-time"></i></li>');
    }
</script>


</body>
</html>