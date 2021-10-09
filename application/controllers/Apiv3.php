<?php

class Apiv3 extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi','m');
        $this->load->helpers('form');
        $this->load->helpers('url');


        $this->new_version_code = 400;
        $this->new_version_name = "CBT Versi 4.00";

        $this->cronjob();
    }

    function index(){
        $data = array();
        $data['response'] = 'Parameter Failed!';
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }




    function cronjob(){
        $pengaturanToken = json_decode($this->m->getpengaturan("pengaturanToken"), true);

        $tanggal_sekarang = date('Y-m-d');
        $tgl_buka   = date('Y-m-d H:i', strtotime($tanggal_sekarang . ' '.$pengaturanToken["buka"]));
        $tgl_tutup  = date('Y-m-d H:i', strtotime($tanggal_sekarang . ' '.$pengaturanToken["tutup"]));


        $lama = 15; //menit
        $tanggal_sekarang = date('Y-m-d H:i:s');
        $tanggal_sekarang_ditambah = date('Y-m-d H:i:s',strtotime("+$lama minutes",strtotime($tanggal_sekarang)));

        $token_baru = $this->_generateRandomString();

        $xtanggal_sekarang = strtotime($tanggal_sekarang) * 1000;
        $xtgl_buka = strtotime($tgl_buka) * 1000;
        $xtgl_tutup = strtotime($tgl_tutup) * 1000;

        //jika jam sekarang lebih dari jam x &&
        //jika jam sekarang kurang dari jam y
        if( $xtanggal_sekarang >= $xtgl_buka && $xtanggal_sekarang <= $xtgl_tutup  ){

            $ujian_token = $this->db->get_where('ujian_token',null)->result();

            if( sizeof($ujian_token) > 0 ){
                if( $tanggal_sekarang > $ujian_token[0]->ujian_token_tanggal ){
                    $this->db->update('ujian_token',array(
                        'ujian_token_tanggal'=>$tanggal_sekarang_ditambah,
                        'ujian_token_text'=>$token_baru,
                    ));
                }

            }else{
                $this->db->insert('ujian_token',array(
                    'ujian_token_tanggal'=>$tanggal_sekarang_ditambah,
                    'ujian_token_text'=>$token_baru
                ));

            }

        }

    }



    function _generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    function getversion($current_version_code){


        $response = array();
        $response["response"] = array();
        if($this->new_version_code > $current_version_code){
            $response["success"] = true;
            $response["response"] = array(
                "code" => $this->new_version_code,
                "name" => $this->new_version_name,
                "link" => base_url() . "apiv3/autoupdate"
            );
        }else{
            $response["success"] = false;
            $response["response"] = "Aplikasi yang digunakan versi terbaru!";
        }


        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }


    function getversion2(){

        $response = array();
        $response["success"] = true;
        $response["response"] = array(
            "code" => $this->new_version_code,
            "name" => $this->new_version_name,
            "link" => $this->config->item('base_url_cbt') . "/update"

        );



        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }

    function download(){
        $filepath = "./uploads/autoupdate/cbt".$this->new_version_code.".apk";
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$this->new_version_name.'.apk"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
            die();
        }
    }

    function autoupdate(){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, user-scalable=no" />

        </head>
        <body>
        <center>
            <h3>CBT Sedang di download</h3>
            <p>Proses download <?php echo $this->new_version_name;?> akan berlangsung secara otomatis, jika tidak download <a href="<?php echo base_url("uploads/autoupdate/cbt".$this->new_version_code.".apk");?>">manual</a>.</p>
        </center>
        <script type="text/javascript">
            location.href = '<?php echo base_url("uploads/autoupdate/cbt".$this->new_version_code.".apk");?>'
        </script>

        </body>
        </html>

        <?php
    }

    function autoupdate2($new_version_code){
        $filepath = "./uploads/autoupdate/cbt" . $new_version_code . ".apk";
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
            die();
        }
    }

    function signin(){
        $username = $this->input->get('u');
        $password = $this->input->get('p');

        $response = array();
        $response["response"] = array();


        $this->db->select('*')->from('users');
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        $users = $this->db->get();
        if($users->num_rows() > 0){

            foreach ($users->result_array() as $r){

                $array_push['user_id']  			= $r['user_id'];
                $array_push['username']  			= $r['username'];
                $array_push['level']  				= $r['level'];
                $array_push['last_active']  		= $r['last_active'];
                $array_push['instansi']  		    = $this->m->getpengaturan("instansi");

                if($r['level'] == "siswa"){
                    $siswa = $this->db->get_where("siswa",array("siswa_id" => $r['siswa_id']))->result_array();
                    $siswa = $siswa[0];

                    $array_push['siswa_id']  		= $r['siswa_id'];


                    $array_push['siswa_nis']  		= $siswa['siswa_nis'];
                    $array_push['siswa_nama']  		= $siswa['siswa_nama'];
                    $array_push['siswa_jk']  		= $siswa['siswa_jk'];

                    $array_push['siswa_foto'] = $this->config->item('base_url_cbt') . '/assets/img/avatar.png';
                    if( !empty($siswa['siswa_foto']) && file_exists(FCPATH . 'uploads/siswa/' .$siswa['siswa_foto']) ) {
                        $array_push['siswa_foto'] = $this->config->item('base_url_cbt') . '/thumb.php?size=200x300&src=./uploads/siswa/' . $siswa['siswa_foto'];
                    }


                    $array_push['siswa_agama']  	= ucfirst($siswa['siswa_agama']);
                    $array_push['siswa_kelas']  	= $siswa['siswa_kelas'];
                    $array_push['siswa_jurusan']  	= $siswa['siswa_jurusan'];
                    $array_push['siswa_jurusan_ke'] = $siswa['siswa_jurusan_ke'];

                }

                array_push($response["response"], $array_push);
            }

            $response["success"] = true;
        }else{
            $response["success"] = false;
            $response["response"] = "Tidak ditemukan data";
        }

        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }

    function signincek(){
        $username = $this->input->get('u');
        $password = $this->input->get('p');

        $response = array();
        $response["response"] = array();


        $this->db->select('*')->from('users');
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        $users = $this->db->get();
        if ($users->num_rows() > 0) {
            $response["success"] = true;

        }else{
            $response["success"] = false;
        }

        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }


    

    function cari(){
        $tgl = date('Y-m-d');
        $by = $this->input->get('by');
        $nomor = $this->input->get('nomor');

        $response = array();
        $response["response"] = array();

        $this->db->select("*")->from('soal_jawab');
        $this->db->join('siswa', 'siswa.siswa_id = soal_jawab.siswa_id');



        if(!empty($by) && $by != null){
            $this->db->like('siswa.siswa_nama',$by);
        }

        if(!empty($nomor) && empty($by)){

            $this->db->where('soal_jawab.soal_jawab_ruangan',$nomor);
            //jika waktu selesai lebih dari 600 detik atau 30 menit
            $this->db->where('soal_jawab.soal_jawab_last_update >= ', date('Y-m-d H:i', strtotime("-1800 second"))); //30menit = 1800 detik
        }



        $this->db->order_by('soal_jawab.soal_jawab_last_update','desc');

        $this->db->limit(30);


        $users = $this->db->get();
        if ($users->num_rows() > 0) {

            foreach ($users->result_array() as $r2) {

                $item = array();
                $item['ruangan'] = $nomor;
                $item['siswa_id'] = $r2['siswa_id'];
                $item['siswa_nis'] = $r2['siswa_nis'];
                $item['siswa_nama'] = $r2['siswa_nama'];
                $siswa_foto = $r2['siswa_foto'];

                $item['siswa_foto'] = $this->config->item('base_url_cbt') . '/assets/img/avatar.png';
                if( !empty($siswa_foto) && file_exists(FCPATH . 'uploads/siswa/' .$siswa_foto) ) {
                    $item['siswa_foto'] = $this->config->item('base_url_cbt') . '/thumb.php?size=200x300&src=./uploads/siswa/' . $siswa_foto;
                }


                $item['soal_jawab_id'] = $r2['soal_jawab_id'];
                $item['soal_jawab_mulai'] = $r2['soal_jawab_mulai'];
                $item['soal_jawab_selesai'] = $r2['soal_jawab_selesai'];
                $item['soal_jawab_tanggal'] = $r2['soal_jawab_tanggal'];
                $item['soal_jawab_tanggal_indo' ] = $this->m->tanggalhari2( $r2['soal_jawab_tanggal'],true );

                $item['soal_jawab_ok'] = $r2['soal_jawab_ok'];
                $item['soal_jawab_none'] = $r2['soal_jawab_none'];

                $terjawab = 0;
                $tidakterjawab = 0;
                $soal_jawab_list_opsi = json_decode( $r2['soal_jawab_list_opsi'] );
                foreach($soal_jawab_list_opsi as $opsi){
                    if(!empty($opsi[3])){
                        $terjawab++;
                    }else{
                        $tidakterjawab++;
                    }

                }
                $item['soal_jawab_terjawab'] = $terjawab;
                $item['soal_jawab_tidakterjawab'] = $tidakterjawab;


                $item['soal_jawab_ruangan'] = $r2['soal_jawab_ruangan'];

                $item['soal_jawab_pelajaran'] = $r2['soal_jawab_pelajaran'];
                $item['soal_jawab_jurusan'] = $r2['soal_jawab_jurusan'];
                $item['soal_jawab_ruangan'] = $r2['soal_jawab_ruangan'];


                $sembunyikan = 0;
                if( $r2['soal_jawab_status'] == "N" && $r2['soal_jawab_selesai'] != "0000-00-00 00:00:00" && strtotime($r2['soal_jawab_selesai']) < strtotime("-900 second")) {
                    $sembunyikan = 1;
                }
                $item['soal_jawab_status'] = $r2['soal_jawab_status'];

                array_push($response["response"], $item);

            }

            $response["success"] = true;
        } else {
            $response["success"] = false;
            $response["response"] = "Tidak ditemukan data";
        }







        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);


    }

    function ujianlist(){

        $tgl = date('Y-m-d');
        $nis = $this->input->get('nis');
        $by = $this->input->get('by');


        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        $users = $this->db->get_where('siswa',array("siswa_nis" => $nis));


        if($users->num_rows() > 0){

            foreach ($users->result_array() as $r2){

                $siswa_id  		    = $r2['siswa_id'];
                $siswa_kelas  	    = $r2['siswa_kelas'];
                $siswa_jurusan  	= $r2['siswa_jurusan'];
                $siswa_jurusan_ke  	= $r2['siswa_jurusan_ke'];
                $siswa_agama  		= ucfirst($r2['siswa_agama']);

                if( $by == "usai"){

                    $ujian = $this->db->select('soal_jawab.*,ujian.*')->from('soal_jawab');
                    $ujian = $ujian->join("ujian","ujian.ujian_id = soal_jawab.ujian_id");
                    $ujian = $ujian->where('soal_jawab.siswa_id='.$siswa_id);

                    $ujian = $ujian->where('(soal_jawab.soal_jawab_kelas=\'\' OR soal_jawab.soal_jawab_kelas=\''.$siswa_kelas.'\')');
                    $ujian = $ujian->where('(soal_jawab.soal_jawab_jurusan=\'\' OR soal_jawab.soal_jawab_jurusan=\''.$siswa_jurusan.'\')');
                    $ujian = $ujian->where('(soal_jawab.soal_jawab_jurusan_ke=\'\' OR soal_jawab.soal_jawab_jurusan_ke=\''.$siswa_jurusan_ke.'\')');

                    $ujian = $ujian->get();
                    foreach ($ujian->result_array() as $row1){
                        $data_ujian[ 'ujian_id' ] = $row1['ujian_id'];
                        $data_ujian[ 'ujian_tanggal' ] = $row1['ujian_tanggal'];
                        $data_ujian[ 'ujian_tanggal_indo' ] = $this->m->tanggalhari2( $row1['ujian_tanggal'],true );
                        $data_ujian[ 'ujian_mulai' ] = $row1['ujian_mulai'];
                        $data_ujian[ 'ujian_terlambat' ] = $row1['ujian_terlambat'];

                        //$waktu = (int) $row1['ujian_waktu'];
                        //$data_ujian[ 'ujian_akhir' ] = date('Y-m-d H:i:s',strtotime('+'.$waktu.' minutes',strtotime($row1['ujian_mulai'])));

                        $data_ujian[ 'ujian_waktu' ] = $row1['ujian_waktu'];
                        $data_ujian[ 'ujian_jenis' ] = $row1['ujian_jenis'];
                        $data_ujian[ 'ujian_tampil' ] = $row1['ujian_tampil'];
                        $data_ujian[ 'ujian_jumlah_soal' ] = $row1['ujian_jumlah_soal'];

                        $data_ujian[ 'ujian_untuk' ] = $row1['ujian_untuk'];
                        $data_ujian[ 'ujian_guru' ] =  $row1['ujian_guru'];
                        $data_ujian[ 'ujian_pelajaran' ] = $row1['ujian_pelajaran'];


                        $tanggal_sekarang = date('Y-m-d H:i:s');

                        $status = 2;
                        if($tanggal_sekarang < $row1['ujian_mulai'] ){
                            $status = 0;
                        }elseif($tanggal_sekarang >= $row1['ujian_mulai'] and $tanggal_sekarang <=  $row1['ujian_terlambat']){
                            $status = 1;
                        }

                        $data_ujian[ 'ujian_status' ] = !empty($row1['soal_jawab_status']) ? $row1['soal_jawab_status'] : $status;

                        array_push($response["response"], $data_ujian);
                        $response["success"] = true;

                    }

                }else{

                    $ujian = $this->db->select('*')->from('ujian');

                    if( $by == "besok"){
                        $tgl = date('Y-m-d', strtotime($tgl. ' + 1 days'));
                        $ujian = $ujian->where('ujian_tanggal' ,$tgl);
                    }else{
                        $ujian = $ujian->where('ujian_tanggal' ,$tgl);
                    }

                    $ujian = $ujian->where('(ujian.ujian_kelas=\'\' OR ujian.ujian_kelas=\''.$siswa_kelas.'\')');
                    $ujian = $ujian->where('(ujian.ujian_jurusan=\'\' OR ujian.ujian_jurusan=\''.$siswa_jurusan.'\')');
                    $ujian = $ujian->where('(ujian.ujian_jurusan_ke=\'\' OR ujian.ujian_jurusan_ke=\''.$siswa_jurusan_ke.'\')');
                    $ujian = $ujian->where('(ujian.ujian_agama=\'\' OR ujian.ujian_agama=\''.$siswa_agama.'\')');


                    $ujian = $ujian->order_by('ujian_mulai' ,"ASC");

                    $ujian = $ujian->get();
                    foreach ($ujian->result_array() as $row1){
                        $data_ujian[ 'ujian_id' ] = $row1['ujian_id'];
                        $data_ujian[ 'ujian_tanggal' ] = $row1['ujian_tanggal'];
                        $data_ujian[ 'ujian_tanggal_indo' ] = $this->m->tanggalhari2( $row1['ujian_tanggal'],true );
                        $data_ujian[ 'ujian_mulai' ] = $row1['ujian_mulai'];
                        $data_ujian[ 'ujian_terlambat' ] = $row1['ujian_terlambat'];

                        //$waktu = (int) $row1['ujian_waktu'];
                        //$data_ujian[ 'ujian_akhir' ] = date('Y-m-d H:i:s',strtotime('+'.$waktu.' minutes',strtotime($row1['ujian_mulai'])));

                        $data_ujian[ 'ujian_waktu' ] = $row1['ujian_waktu'];
                        $data_ujian[ 'ujian_jenis' ] = $row1['ujian_jenis'];
                        $data_ujian[ 'ujian_tampil' ] = $row1['ujian_tampil'];
                        $data_ujian[ 'ujian_jumlah_soal' ] = $row1['ujian_jumlah_soal'];
                        $data_ujian[ 'ujian_agama' ] = $row1['ujian_agama'];

                        $data_ujian[ 'ujian_untuk' ] = $row1['ujian_untuk'];
                        $data_ujian[ 'ujian_guru' ] =  $row1['ujian_guru'];
                        $data_ujian[ 'ujian_pelajaran' ] = $row1['ujian_pelajaran'];


                        //$soal_jawab = $this->db->get_where('soal_jawab',array('ujian_id'=>$row1['ujian_id'],'siswa_id'=>$siswa_id))->result();
                        //$data_ujian['status'] = empty($soal_jawab[0]->status) ? null : $soal_jawab[0]->status;

                        $soal_jawab = $this->db->get_where('soal_jawab',array('ujian_id'=>$row1['ujian_id'],'siswa_id'=>$siswa_id))->result();

                        $tanggal_sekarang = new DateTime();
                        $tanggal_sekarang_ujian_mulai = new DateTime($row1['ujian_mulai']);
                        $tanggal_sekarang_ujian_terlambat = new DateTime($row1['ujian_terlambat']);

                        $status = 2;

                        if($tanggal_sekarang >= $tanggal_sekarang_ujian_mulai && $tanggal_sekarang <=  $tanggal_sekarang_ujian_terlambat){
                            $status = 1;
                        }elseif($tanggal_sekarang < $tanggal_sekarang_ujian_mulai ){
                            $status = 0;
                        }else{
                            if($tanggal_sekarang <=  $tanggal_sekarang_ujian_terlambat){
                                foreach ($soal_jawab as $sj){
                                    $status = !empty($sj->soal_jawab_status) ? $sj->soal_jawab_status : $status;
                                }
                            }
                        }

                        foreach ($soal_jawab as $sj){
                            if($sj->soal_jawab_status == "N"){
                                $status = "N";
                            }
                        }

                        //$data_ujian[ 'x' ] = $tanggal_sekarang_ujian_mulai;
                        //$data_ujian[ 'y' ] = $tanggal_sekarang_ujian_terlambat;

                        $data_ujian[ 'ujian_status' ] = $status;
                        //$data_ujian[ 'x' ] = $soal_jawab;

                        array_push($response["response"], $data_ujian);
                        $response["success"] = true;

                    }

                }

            }
        }else{
            $response["response"] = "Tidak ditemukan data";
        }

        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }

    function ujianget(){
        $response = array();
        $response["response"] = array();

        $nis     = $this->input->get('nis');
        $uid     = $this->input->get('uid');
        $ujianid = $this->input->get('ujianid');
        $ruangan = $this->input->get('ruangan');

        $siswa = $this->db->get_where('siswa',array("siswa_nis" => $nis));
        if($siswa->num_rows() > 0) {

            foreach ($siswa->result_array() as $r2) {

                $siswa_id  		    = $r2['siswa_id'];
                $kelas_sekarang  	= $r2['siswa_kelas'];
                $jurusan_id  		= $r2['siswa_jurusan'];
                $ruang  			= $r2['siswa_jurusan_ke'];
                $siswa_agama  		= $r2['siswa_agama'];
                $bisamulai          = 0;


                //MULAI GET UJIAN
                $q1 = $this->db->get_where('ujian',array('ujian_id'=>$ujianid));

                if($q1->num_rows() > 0){
                    $ujian = $q1->result();

                    $this->session->set_userdata(array(
                        'ujian_id'=>$ujianid,
                        'ujian_tampil'=>$ujian[0]->ujian_tampil,
                    ));

                    //cek soal_jawab jika ada get jika tidak insert

                    $ujian_ikut = $this->db->select('*')->from('soal_jawab');
                    $ujian_ikut = $ujian_ikut->where(array(
                        'ujian_id'=>$ujianid,
                        'siswa_id'=>$siswa_id,
                        'soal_jawab_pelajaran' => $ujian[0]->ujian_pelajaran
                    ));

                    $ujian_ikut = $ujian_ikut->get();


                    //$data['response_ada'] = $ujian_ikut->result();

                    $soaljawab_id = 0;
                    //cek ujian jika tidak ada insert
                    if($ujian_ikut->num_rows() < 1){

                        $soal = $this->db->select('*')->from('soal')->where(array(
                            'soal_pelajaran' => $ujian[0]->ujian_pelajaran,
                            //'soal_guru' => $ujian[0]->ujian_guru,
                            //'soal_untuk'=> $ujian[0]->ujian_untuk
                        ));




                        $soal = $soal->where('(soal_kelas=\'\' OR soal_kelas=\''. $ujian[0]->ujian_kelas.'\')');
                        $soal = $soal->where('(soal_jurusan=\'\' OR soal_jurusan=\''. $ujian[0]->ujian_jurusan.'\')');
                        $soal = $soal->where('(soal_jurusan_ke=\'\' OR soal_jurusan_ke=\''. $ujian[0]->ujian_jurusan_ke.'\')');


                        if( $ujian[0]->ujian_jenis == "Acak" ){
                            $soal = $soal->order_by('soal_id','RANDOM');
                        }else{
                            $soal = $soal->order_by('soal_id','ASC');
                        }

                        if(  $ujian[0]->ujian_jumlah_soal > 0 ){
                            $soal = $soal->limit($ujian[0]->ujian_jumlah_soal);
                        }

                        $soal = $soal->get();


                        //$data['response_soal'] = $soal->result();

                        $list_soal = '';
                        $list_opsi = '';


                        $list_soal_array = array();
                        $list_opsi_array = array();

                        foreach($soal->result_array() as $item){
                            $list_soal .= $item['soal_id'].",";
                            $list_opsi .= $item['soal_id'].":".$item['soal_jenis'].":N:,";


                            array_push( $list_soal_array, $item['soal_id'] );
                            array_push( $list_opsi_array, array($item['soal_id'],$item['soal_jenis'],'N','') );
                            $bisamulai++;

                        }

                        $list_soal = substr($list_soal, 0, -1);
                        $list_opsi = substr($list_opsi, 0, -1);

                        $lama_min = $ujian[0]->ujian_minimal;
                        $lama_max = $ujian[0]->ujian_waktu;
                        $d = array(
                            'soal_jawab_list' => json_encode($list_soal_array),
                            'soal_jawab_list_opsi' => json_encode($list_opsi_array),

                            'ujian_id'  => $ujianid,
                            'siswa_id'  => $siswa_id,
                            'user_id'   => $uid,
                            'soal_jawab_pelajaran' => $ujian[0]->ujian_pelajaran,
                            'soal_jawab_ruangan'  => $ruangan,

                            'soal_jawab_tanggal' => date('Y-m-d'),
                            'soal_jawab_mulai' => date('Y-m-d H:i:s'),
                            'soal_jawab_waktu' => $ujian[0]->ujian_waktu,
                            'soal_jawab_waktu_minimal' => $ujian[0]->ujian_minimal,

                            'soal_jawab_jumlah_soal ' => $ujian[0]->ujian_jumlah_soal,

                            'soal_jawab_kelas'=>$kelas_sekarang,
                            'soal_jawab_jurusan'=>$jurusan_id,
                            'soal_jawab_jurusan_ke'=>$ruang,
                            'soal_jawab_status' => 'Y'
                        );
                        //$data['response_soal_insert'] = $d;


                        //$soaljawab_id = $d;
                        if($bisamulai > 0){

                            $this->db->insert('soal_jawab',$d);
                            $soaljawab_id = $this->db->insert_id();

                        }

                        //jika ada tampil
                    }else{
                        $soaljawab = $ujian_ikut->result();

                        $bisamulai++;
                        $soaljawab_id = $soaljawab[0]->soal_jawab_id;
                    }



                    //ini respon tampil data soal

                    $response["success"] = true;
                    $response["response"] = array("soaljawab_id"=>$soaljawab_id,"bisa"=>$bisamulai);
                }else{
                    $response["success"] = false;
                    $response["response"] = "Tidak ditemukan data";
                }


            }
        }else{
            $response["success"] = false;
            $response["response"] = "Tidak ditemukan data";
        }

        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }

    function ujianmulai(){

        $data2['title'] = "Mulai Ujian";

        $id     = $this->input->get('id');
        $soal_jawab = $this->db->get_where('soal_jawab', array('soal_jawab_id'=> $id) )->result();

        foreach ($soal_jawab as $x){


            $data2['ujian_id'] = $x->ujian_id;
            $data2['ujian_tampil'] = "Tidak";


            $urut_soal = json_decode( $x->soal_jawab_list_opsi );

            $data2['soal']	= array();


            foreach($urut_soal as $item){
                $pc_urut_soal1 = json_encode( empty($item[3]) ? "" : $item[3] );
                $ambil_soal = $this->db->select("
                soal_id,
                soal_sesi,
                soal_jenis,
                soal_text_judul,
                soal_text_opsi1,
                soal_text_opsi2,
                soal_text_opsi3,
                soal_text_opsi4,
                soal_text_opsi5,
                soal_text_jawab,
                $pc_urut_soal1 AS jawaban")->from('soal')->where(array(
                    'soal_id'=>$item[0]
                ))->get()->result_array();


                array_push($data2['soal'],$ambil_soal[0]);
            }



            $tanggal_sekarang = date('Y-m-d H:i:s');

            $status = 2;
            if($tanggal_sekarang < $x->soal_jawab_mulai ){
                $status = 0;
            }elseif($tanggal_sekarang >= $x->soal_jawab_mulai and $tanggal_sekarang <=  $x->soal_jawab_selesai){
                $status = 1;
            }


            $ujian = $this->db->get_where("ujian",array("ujian_id" => $x->ujian_id))->result();

            $data2['list_jawaban'] = $urut_soal;

            //$data2['ujian'] = $ujian[0];
            //$data2['soal_jawab_status'] = $status;
            //$data2['soal_jawab_tanggal'] = $x->soal_jawab_tanggal;
            //$data2['soal_jawab_mulai'] = $x->soal_jawab_mulai;
            //$data2['soal_jawab_selesai'] = $x->soal_jawab_selesai;

            $waktu_maksimal = $x->soal_jawab_waktu;
            $waktu_minimal  = $this->m->getpengaturan("Waktu Minimal");//$x->soal_jawab_waktu_minimal;

            $data2['waktu_maksimal'] = date('Y-m-d H:i:s',strtotime("+$waktu_maksimal minutes",strtotime(date($x->soal_jawab_mulai))));
            $data2['waktu_minimal'] = date('Y-m-d H:i:s',strtotime("+$waktu_minimal minutes",strtotime(date($x->soal_jawab_mulai))));

            $data2['user_id'] = $x->user_id;
            $data2['siswa_id'] = $x->siswa_id;
            $data2['id'] = $id;


            //$this->output->set_header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($data2,JSON_UNESCAPED_UNICODE);
            $this->load->view('apiv3/ujianmulai',$data2);

        }
    }

    function ujiansimpansatu(){
        $id = $this->input->get('id');
        $soal_jawab = $this->db->get_where('soal_jawab', array('soal_jawab_id'=> $id) )->result();

        foreach ($soal_jawab as $x) {

            $p = json_decode(file_get_contents('php://input'));


            $update_ = array();

            for ($i = 1; $i < $p->jml_soal; $i++) {
                $_tidsoal = "id_soal_" . $i;
                $_tjenis = "jenis_" . $i;
                $_ragu = "rg_" . $i;

                $jawaban_ = '';
                if ($p->$_tjenis == 'essay') {
                    $_tessay = "essay_" . $i;

                    $jawaban_ = empty($p->$_tessay) ? "" : $p->$_tessay;

                    //$update_ .= "".$p->$_tidsoal.":".$p->$_tjenis.":".$p->$_ragu.":".$jawaban_.",";

                } else {
                    $_tjawab = "opsi_" . $i;

                    $jawaban_ = empty($p->$_tjawab) ? "" : $p->$_tjawab;
                    //$update_ .= "".$p->$_tidsoal.":".$p->$_tjenis.":".$p->$_ragu.":".$jawaban_.",";
                    //0,1,2,3
                }

                //untuk memfilter karakter jawaban yang tidak terformat
                $jawaban_ = stripcslashes(trim($jawaban_));

                array_push($update_, array($p->$_tidsoal, $p->$_tjenis, $p->$_ragu, $jawaban_));
            }

            //$update_ = substr($update_, 0, -1);
            $update_ = json_encode($update_);

            $where = array(
                'ujian_id'  => $soal_jawab[0]->ujian_id,
                'user_id'   => $soal_jawab[0]->user_id,
                'siswa_id'  => $soal_jawab[0]->siswa_id
            );

            $this->db->where($where);
            $this->db->update('soal_jawab', array(
                'soal_jawab_last_update' => date('Y-m-d H:i:s'),
                'soal_jawab_list_opsi' => $update_
            ));


            //$ret_urn = explode(",", $soal_jawab[0]['soal_jawab_list_opsi']);
            $ret_urn = json_decode($soal_jawab[0]->soal_jawab_list_opsi);

            $hasil = array();
            foreach ($ret_urn as $val) {
                //$pc_ret_urn = explode(":", $value);
                $idx = $val[0];
                $val = array($val[0], $val[1], $val[2], $val[3]);
                $hasil[] = $val;
            }

            $d['data'] = $hasil;
            $d['status'] = "ok";

            $this->output->set_header('Access-Control-Allow-Origin: *');
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            echo json_encode($d);
        }
    }

    function ujiansimpanakhir(){
        $id = $this->input->get('id');

        $soal_jawab = $this->db->get_where('soal_jawab',array('soal_jawab_id'=> $id))->result();

        foreach ($soal_jawab as $x) {

            $pc_jawaban = json_decode($x->soal_jawab_list_opsi);

            $jumlah_benar = 0;
            $jumlah_salah = 0;
            $jumlah_ragu = 0;
            $nilai_bobot = 0;
            $total_bobot = 0;
            //$jumlah_soal	= 0;
            $jumlah_soal = $x->soal_jawab_jumlah_soal;
            $total_soal = 0;
            $jumlah_none = 0;

            foreach ($pc_jawaban as $val) {
                //$pc_ret_urn = explode(":", $value);

                $id_soal = $val[0];
                $jenis = $val[1];
                $ragu = $val[2];
                $jawaban = $val[3];

                if ($jenis == 'ganda') {

                    $ambil_soal = $this->db->get_where('soal', array('soal_id' => $id_soal))->result();
                    if ($ambil_soal[0]->soal_text_jawab == $jawaban) {
                        $jumlah_benar++;
                    } else {
                        $jumlah_salah++;
                    }
                    //$jumlah_soal++;
                    $total_soal++;

                }

            }


            $jumlah_nilai = ($jumlah_benar / $jumlah_soal) * 100;

            $jumlah_none = $jumlah_soal - $total_soal;


            $this->db->where(array('soal_jawab_id' => $id));
            $this->db->update('soal_jawab', array(
                'soal_jawab_benar' => $jumlah_benar,
                'soal_jawab_salah' => $jumlah_salah,
                'soal_jawab_nilai' => $jumlah_nilai,
                'soal_jawab_ok' => $total_soal,
                'soal_jawab_none' => $jumlah_none,
                'soal_jawab_selesai' => date('Y-m-d H:i:s'),
                'soal_jawab_last_update' => date('Y-m-d H:i:s'),
                'soal_jawab_status' => 'N'
            ));

            $data['status'] = 'ok';
            $this->output->set_header('Access-Control-Allow-Origin: *');
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        }
    }












    function pengumuman($nis){
        $data2['title'] = "Pengumuman";
        $data2['nis'] = $nis;

        $this->load->view('apiv3/pengumuman',$data2);
    }

    function gettimeline($nis){

        $tgl = date('Y-m-d');

        $response = array();
        $response["response"] = array();


        if($nis > 0){

            $users = $this->db->get_where('siswa',array("siswa_nis" => $nis));

            if($users->num_rows() > 0) {

                foreach ($users->result_array() as $r2) {

                    $siswa_id = $r2['siswa_id'];
                    $kelas_sekarang = $r2['siswa_kelas'];
                    $jurusan_id = $r2['siswa_jurusan'];
                    $ruang = $r2['siswa_jurusan_ke'];

                    $pesan = $this->db->select('*')->from('pesan');
                    $pesan = $pesan->where("(pesan_untuk='siswa' OR pesan_untuk='semua')");

                    //$pesan = $pesan->where("(kelas_sekarang='' OR kelas_sekarang='$kelas_sekarang')");
                    //$pesan = $pesan->where("(jurusan_id='' OR jurusan_id='$jurusan_id')");
                    //$pesan = $pesan->where("(ruang=0 OR ruang=$ruang)");



                    $pesan = $pesan->order_by('pesan_tanggal','desc');
                    $pesan = $pesan->get();

                    foreach ($pesan->result_array() as $row1){


                        $item[ 'pesan_id' ] = $row1['pesan_id'];
                        $item[ 'pesan_aksi' ] = $row1['pesan_aksi'];
                        $item[ 'pesan_text' ] = $row1['pesan_text'];
                        $item[ 'pesan_tanggal' ] = $this->m->tanggalhari( $row1['pesan_tanggal'],true );
                        $item[ 'pesan_untuk' ] = $row1['pesan_untuk'];

                        $item[ 'username' ] = '';
                        $user = $this->db->get_where('users',array(
                            'user_id'=>$row1['user_id']
                        ))->result();
                        $item['username'] =  $user[0]->username;

                        array_push($response["response"], $item);
                    }

                    $item = array();
                    $item[ 'pesan_id' ] = 0;
                    $item[ 'pesan_aksi' ] = 'pesan';
                    $item[ 'pesan_untuk' ] = 'semua';
                    $item[ 'pesan_text' ] = '<p>Selamat Datang di USBKA - Aplikasi Ujian Berbasis Komputer Android</p>';
                    $item[ 'pesan_tanggal' ] = $this->m->tanggalhari2( "2021-01-01",true );
                    $item[ 'username' ] = 'system';

                    array_push($response["response"], $item);




                }

                $response["success"] = true;
            }else{
                $response["success"] = false;
                $response["response"] = "Tidak ditemukan data";
            }

        }else{

            $pesan = $this->db->select('*')->from('pesan');
            $pesan = $pesan->where("(pesan_untuk='guru' OR pesan_untuk='semua')");



            $pesan = $pesan->order_by('pesan_tanggal','desc');
            $pesan = $pesan->get();

            foreach ($pesan->result_array() as $row1){


                $item[ 'pesan_id' ] = $row1['pesan_id'];
                $item[ 'pesan_aksi' ] = $row1['pesan_aksi'];
                $item[ 'pesan_text' ] = $row1['pesan_text'];
                $item[ 'pesan_tanggal' ] = $this->m->tanggalhari( $row1['pesan_tanggal'],true );
                $item[ 'pesan_untuk' ] = $row1['pesan_untuk'];

                $item[ 'username' ] = '';
                $user = $this->db->get_where('users',array(
                    'user_id'=>$row1['user_id']
                ))->result();
                $item['username'] =  $user[0]->username;

                array_push($response["response"], $item);
            }

            $item = array();
            $item[ 'pesan_id' ] = 0;
            $item[ 'pesan_aksi' ] = 'pesan';
            $item[ 'pesan_untuk' ] = 'semua';
            $item[ 'pesan_text' ] = '<p>Selamat Datang di USBKA - Aplikasi Ujian Berbasis Komputer Android</p>';
            $item[ 'pesan_tanggal' ] = $this->m->tanggalhari2( "2021-01-01",true );
            $item[ 'username' ] = 'system';

            $response["success"] = true;
            array_push($response["response"], $item);

        }



        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);

    }


    function getinfo(){

        $nis     = $this->input->get('nis');

        $response = array();
        $response["response"] = array();

        $users = $this->db->get_where('siswa',array("siswa_nis" => $nis));


        if($users->num_rows() > 0) {

            foreach ($users->result_array() as $r2) {

                $siswa_id = $r2['siswa_id'];
                $siswa_nis = $r2['siswa_nis'];
                $siswa_nama = $r2['siswa_nama'];
                $siswa_jk = $r2['siswa_jk'];
                $siswa_foto = $r2['siswa_foto'];
                $siswa_agama = $r2['siswa_agama'];
                $kelas_sekarang = $r2['siswa_kelas'];
                $jurusan_id = $r2['siswa_jurusan'];
                $ruang = $r2['siswa_jurusan_ke'];


                $item = array();

                $item["jumlah_dikerjakan"] = $this->_jumlah_dikerjakan($siswa_id);
                $item["jumlah_pelajaran"] = $this->_jumlah_pelajaran($kelas_sekarang,$jurusan_id,$ruang);
                $item["jumlah_siswa"] = $this->_jumlah_siswa();
                $item["jumlah_jurusan"] = $this->_jumlah_jurusan();
                $item["instansi"] = $this->m->getpengaturan("instansi");





                array_push($response["response"], $item);

            }

            $response["success"] = true;
        }else{
            $response["success"] = false;
            $response["response"] = "Tidak ditemukan data";
        }

        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }







    function _jumlah_siswa(){
        $ikut = $this->db->select('*')->from('siswa');
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function _jumlah_jurusan(){
        $ikut = $this->db->select('*')->from('siswa');
        $ikut = $ikut->group_by('siswa_jurusan');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_pelajaran($kelas_sekarang,$jurusan_id,$ruang){
        $ikut = $this->db->select('*')->from('soal');
        $ikut = $ikut->group_by('soal_pelajaran');
        $ikut = $ikut->where('(soal_kelas=\'\' OR soal_kelas=\''.$kelas_sekarang.'\')');
        $ikut = $ikut->where('(soal_jurusan=\'\' OR soal_jurusan=\''.$jurusan_id.'\')');
        $ikut = $ikut->where('(soal_jurusan_ke=\'\' OR soal_jurusan_ke=\''.$ruang.'\')');

        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_dikerjakan($id){
        $ikut = $this->db->select('*')->from('soal_jawab');
        $ikut = $ikut->where('soal_jawab_status','N');
        $ikut = $ikut->where("siswa_id = $id");
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function token($code){
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

            $ujian_token = $this->db->get_where('ujian_token',null)->result();
            foreach ($ujian_token as $item){
                if(!empty($code) && ($item->ujian_token_text == $code || $code == 1) ){
                    $data['ujian_token_text'] = $item->ujian_token_text;
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
