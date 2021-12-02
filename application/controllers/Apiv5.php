<?php


class Apiv5 extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi','m');
        $this->load->helpers('form');
        $this->load->helpers('url');

        $this->_cronJob();

    }

    function index()
    {
        $data = array();
        $data['message'] = 'Selamat datang di API v5';
        $data['response'] = 'Parameter Failed!';
        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }

    function update(){


        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        $version = $this->db->select('*')->from('version')->order_by('version_tanggal','desc')->limit(1)->get();
        foreach ($version->result() as $v){
            //$hits = $v->version_hits;

            //$this->db->where("version_nomor",$v->version_nomor);
            //$this->db->update("version",array("version_hits" => ($hits+1) ));



            $response["success"] = true;
            $response["response"] = array(
                "wajib" => $v->version_wajib,
                "ukuran" => $v->version_ukuran,
                "pesan" => "Ditemukan versi terbaru ".$v->version_nama.", silahkan luangkan waktu untuk memperbarui aplikasi!\n\n".$v->version_text,
                "name" => $v->version_nama,
                "code" => $v->version_nomor,
                //"link" => $this->config->item('base_url') . '/download/android'
                "link" => $this->config->item('base_url') . '/assets/update/cbt'.$v->version_nomor.'.apk'
                //"link" => $this->config->item('base_url_cbt') . '/uploads/cbt'.$v->version_nomor.'.apk'

            );
            //redirect('uploads/cbt'.$v->version_nomor.'.apk');
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response);

    }



    function signin(){
        $username = $this->input->get('u');
        $password = $this->input->get('p');

        $response = array();
        if(empty($username) || empty($password)){
            $response["success"] = false;
            $response["response"] = "Username atau Password kosong!";
        }else{

            $peserta = $this->db->get_where('peserta',array('peserta_username'=>$username,'peserta_password'=>$password))->row_array();
            if ( !empty($peserta) ) {

                $userdata = array();
                $userdata['uid']        = $peserta['peserta_id'];
                $userdata['nama']       = $peserta['peserta_nama'];

                $userdata['foto'] = $this->config->item('base_url') . '/assets/img/avatar.png';
                if( !empty($peserta['peserta_foto']) && file_exists(FCPATH . 'uploads/peserta/' .$peserta['peserta_foto']) ) {
                    $userdata['foto'] = $this->config->item('base_url') . '/thumb.php?size=200x300&src=./uploads/peserta/' . $peserta['peserta_foto'];
                }

                $userdata['level']      = "peserta";
                $userdata['jk']         = $peserta['peserta_jk'];
                $userdata['nis']  		= $peserta['peserta_nis'];
                $userdata['agama']  	= ucfirst($peserta['peserta_agama']);
                $userdata['kelas']  	= $peserta['peserta_kelas'];
                $userdata['jurusan']  	= $peserta['peserta_jurusan'];
                $userdata['jurusan_ke'] = $peserta['peserta_jurusan_ke'];


                $response["success"] = true;
                $response["response"] = $userdata;

                $ruangan = $this->input->get('r');
                $this->db->where( array("peserta_id" => $peserta['peserta_id']) );
                $this->db->update("peserta",array("peserta_ruangan" => $ruangan));

            }else{

                $users = $this->db->get_where('users',array('username'=>$username,'password'=>$password))->row_array();

                if ( !empty($users) && $users['level'] == 'pengawas' ) {

                    $userdata = array();
                    $userdata['uid']    = $users['user_id'];
                    $userdata['nama']       = $users['username'];
                    $userdata['foto']       = base_url('assets/images/avatar.png');
                    $userdata['level']      = "pengawas";

                    $response["success"] = true;
                    $response["response"] = $userdata;

                }else{
                    $response["success"] = false;
                    $response["response"] = "Username atau Password tidak sesuai!";

                }

            }




        }



        $response["ftp_server"] = "";
        $response["ftp_port"] = 0;
        $response["ftp_username"] = "";
        $response["ftp_password"] = "";
        $response["ftp_path"] = "";

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);

    }

    function dashboard(){

        $uid     = $this->input->get('uid');

        $response = array();
        $response["response"] = array();

        $peserta = $this->db->get_where('peserta',array("peserta_id" => $uid));


        if($peserta->num_rows() > 0) {

            foreach ($peserta->result_array() as $r2) {

                $peserta_id = $r2['peserta_id'];
                $peserta_nis = $r2['peserta_nis'];
                $peserta_nama = $r2['peserta_nama'];
                $peserta_jk = $r2['peserta_jk'];
                $peserta_foto = $r2['peserta_foto'];
                $peserta_agama = $r2['peserta_agama'];
                $kelas_sekarang = $r2['peserta_kelas'];
                $jurusan_id = $r2['peserta_jurusan'];
                $ruang = $r2['peserta_jurusan_ke'];


                $item = array();

                $item["jumlah_dikerjakan"] = $this->_jumlah_dikerjakan($peserta_id);
                $item["jumlah_pelajaran"] = $this->_jumlah_pelajaran($kelas_sekarang,$jurusan_id,$ruang);
                $item["jumlah_peserta"] = $this->_jumlah_peserta();
                $item["jumlah_jurusan"] = $this->_jumlah_jurusan();
                $item["jumlah_ujian_today"] = (int)$this->_jumlah_ujian_today($kelas_sekarang,$jurusan_id,$peserta_agama);
                $item["instansi"] = $this->m->getpengaturan("instansi");
                $item["sesi"] = $this->m->getpengaturan("Sesi");

                $response["response"] = $item;

            }

            $response["success"] = true;
        }else{
            $response["success"] = false;
            $response["response"] = "Tidak ditemukan data";
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }


    /**
     * @return mixed
     * Ujian
     */


    function ujianlist(){

        $tgl = date('Y-m-d');
        $uid = $this->input->get('uid');
        $by = $this->input->get('by');


        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        $users = $this->db->get_where('peserta',array("peserta_id" => $uid));


        if($users->num_rows() > 0){

            foreach ($users->result_array() as $r2){

                $peserta_id  		    = $r2['peserta_id'];
                $peserta_kelas  	    = $r2['peserta_kelas'];
                $peserta_jurusan  	    = $r2['peserta_jurusan'];
                $peserta_jurusan_ke  	= $r2['peserta_jurusan_ke'];
                $peserta_agama  		= ucfirst($r2['peserta_agama']);

                if( $by == "usai"){

                    $ujian = $this->db->select('soal_jawab.*,ujian.*')->from('soal_jawab');
                    $ujian = $ujian->join("ujian","ujian.ujian_id = soal_jawab.ujian_id");
                    $ujian = $ujian->where('soal_jawab.siswa_id='.$peserta_id);

                    $ujian = $ujian->where('(ujian.ujian_kelas=\'\' OR ujian.ujian_kelas=\''.$peserta_kelas.'\')');
                    //$ujian = $ujian->where('(soal_jawab.soal_jawab_kelas=\'\' OR soal_jawab.soal_jawab_kelas=\''.$peserta_kelas.'\')');
                    //$ujian = $ujian->where('(soal_jawab.soal_jawab_jurusan=\'\' OR soal_jawab.soal_jawab_jurusan=\''.$peserta_jurusan.'\')');
                    //$ujian = $ujian->where('(soal_jawab.soal_jawab_jurusan_ke=\'\' OR soal_jawab.soal_jawab_jurusan_ke=\''.$peserta_jurusan_ke.'\')');

                    $ujian = $ujian->order_by('soal_jawab.soal_jawab_tanggal' ,"DESC");
                    $ujian = $ujian->order_by('soal_jawab.soal_jawab_mulai' ,"DESC");

                    $ujian = $ujian->get();
                    foreach ($ujian->result_array() as $row1){

                        $ujian_tanggal = $row1['soal_jawab_tanggal'];


                        $data_ujian[ 'ujian_id' ] = $row1['ujian_id'];
                        $data_ujian[ 'ujian_tanggal' ] = $ujian_tanggal;
                        $data_ujian[ 'ujian_tanggal_indo' ] = $this->m->tanggalhari2( $row1['soal_jawab_tanggal'],true );
                        $data_ujian[ 'ujian_mulai' ] = date("H:i:s",strtotime($row1['soal_jawab_mulai']));
                        $data_ujian[ 'ujian_selesai' ] = date("H:i:s",strtotime($row1['soal_jawab_selesai']));

                        //$waktu = (int) $row1['ujian_waktu'];
                        //$data_ujian[ 'ujian_akhir' ] = date('Y-m-d H:i:s',strtotime('+'.$waktu.' minutes',strtotime($row1['ujian_mulai'])));

                        $data_ujian[ 'ujian_waktu' ] = $row1['soal_jawab_waktu'];
                        $data_ujian[ 'ujian_jenis' ] = $row1['ujian_jenis'];
                        $data_ujian[ 'ujian_tampil' ] = "";//$row1['ujian_tampil'];
                        $data_ujian[ 'ujian_jumlah_soal' ] = $row1['ujian_jumlah_soal'];

                        $data_ujian[ 'ujian_untuk' ] = $row1['ujian_untuk'];
                        $data_ujian[ 'ujian_guru' ] =  $row1['ujian_guru'];
                        $data_ujian[ 'ujian_pelajaran' ] = $row1['soal_jawab_pelajaran'];


                        $tanggal_sekarang = date('Y-m-d H:i:s');
                        $ujian_mulai = date("Y-m-d H:i:s", strtotime($row1['soal_jawab_mulai']) );
                        $ujian_terlambat = date("Y-m-d H:i:s", strtotime('+' . $row1['soal_jawab_waktu'] . ' minutes', strtotime($row1['soal_jawab_mulai'])));

                        $status = 2;
                        if($tanggal_sekarang < $ujian_mulai ){
                            $status = 0;
                        }elseif($tanggal_sekarang >= $ujian_mulai and $tanggal_sekarang <=  $ujian_terlambat){
                            $status = 1;
                        }


                        if ($row1['soal_jawab_status'] == "N") {
                            $status = "N";
                        }



                        $data_ujian[ 'ujian_status' ] = $status;

                        array_push($response["response"], $data_ujian);
                        $response["success"] = true;

                    }

                }else{

                    $ujian = $this->db->select('*')->from('ujian');

                    //$ujian = $ujian->like('(ujian.ujian_jurusan=\'\' OR ujian.ujian_jurusan=\''.$peserta_jurusan.'\')');
                    //$ujian = $ujian->where('(ujian.ujian_jurusan_ke=\'\' OR ujian.ujian_jurusan_ke=\''.$peserta_jurusan_ke.'\')');
                    //$ujian = $ujian->where('(ujian.ujian_agama=\'\' OR ujian.ujian_agama=\''.$peserta_agama.'\')');


                    if( $by == "besok"){
                        $tgl = date('Y-m-d', strtotime($tgl. ' + 1 days'));
                        $ujian = $ujian->where('ujian.ujian_tanggal' ,$tgl);
                    }else{
                        $ujian = $ujian->where('ujian.ujian_tanggal' ,$tgl);
                    }

                    $ujian = $ujian->where('(ujian.ujian_kelas=\'\' OR ujian.ujian_kelas=\''.$peserta_kelas.'\')');
                    //$ujian = $ujian->where('ujian.ujian_jurusan',"")->or_where('ujian.ujian_jurusan LIKE \'%'.$peserta_jurusan.'%\'');
                    //$ujian = $ujian->where('ujian.ujian_agama',"")->or_where('ujian.ujian_agama LIKE \'%'.$peserta_agama.'%\'');

                    $ujian = $ujian->order_by('ujian_mulai' ,"ASC");

                    $ujian = $ujian->get();
                    foreach ($ujian->result_array() as $row1){

                        $ujian_jurusan = explode(",",$row1['ujian_jurusan']);
                        $ujian_agama = explode(",",$row1['ujian_agama']);

                        $a = 0;
                        $b = 0;
                        if( empty($row1['ujian_jurusan']) || (count($ujian_jurusan) > 0 && in_array($peserta_jurusan,$ujian_jurusan) ) ) {
                            $a++;
                        }

                        if( empty($row1['ujian_agama']) || (count($ujian_agama) > 0 && in_array($peserta_agama,$ujian_agama) ) ) {
                            $b++;
                        }

                        if( $a == 1 && $b == 1 ) {
                            $ujian_tanggal = $row1['ujian_tanggal'];

                            $data_ujian['ujian_id'] = $row1['ujian_id'];
                            $data_ujian['ujian_tanggal'] = $ujian_tanggal;
                            $data_ujian['ujian_tanggal_indo'] = $this->m->tanggalhari2($row1['ujian_tanggal'], true);
                            $data_ujian['ujian_mulai'] = $row1['ujian_mulai'];
                            $data_ujian['ujian_selesai'] = date("H:i:s", strtotime('+' . $row1['ujian_waktu'] . ' minutes', strtotime($row1['ujian_mulai'])));

                            //$waktu = (int) $row1['ujian_waktu'];
                            //$data_ujian[ 'ujian_akhir' ] = date('Y-m-d H:i:s',strtotime('+'.$waktu.' minutes',strtotime($row1['ujian_mulai'])));

                            $data_ujian['ujian_waktu'] = $row1['ujian_waktu'];
                            $data_ujian['ujian_jenis'] = $row1['ujian_jenis'];
                            $data_ujian['ujian_tampil'] = "";//$row1['ujian_tampil'];
                            $data_ujian['ujian_jumlah_soal'] = $row1['ujian_jumlah_soal'];
                            $data_ujian['ujian_agama'] = $row1['ujian_agama'];

                            $data_ujian['ujian_untuk'] = $row1['ujian_untuk'];
                            $data_ujian['ujian_guru'] = $row1['ujian_guru'];
                            $data_ujian['ujian_pelajaran'] = $row1['ujian_pelajaran'];
                            //$data_ujian[ 'ujian_jurusan' ] = $row1['ujian_jurusan'];


                            //$soal_jawab = $this->db->get_where('soal_jawab',array('ujian_id'=>$row1['ujian_id'],'peserta_id'=>$peserta_id))->result();
                            //$data_ujian['status'] = empty($soal_jawab[0]->status) ? null : $soal_jawab[0]->status;

                            $soal_jawab = $this->db->get_where('soal_jawab', array('ujian_id' => $row1['ujian_id'], 'siswa_id' => $peserta_id))->result();

                            //$tanggal_sekarang = new DateTime();
                            //$tanggal_sekarang_ujian_mulai = new DateTime($ujian_tanggal . " " . $data_ujian['ujian_mulai']);
                            //$tanggal_sekarang_ujian_terlambat = new DateTime($ujian_tanggal . " " . $data_ujian['ujian_selesai']);


                            $tanggal_sekarang = date('Y-m-d H:i:s');
                            $ujian_mulai = date("Y-m-d H:i:s", strtotime($ujian_tanggal." ".$row1['ujian_mulai']) );
                            $ujian_terlambat = date("Y-m-d H:i:s", strtotime('+' . $row1['ujian_waktu'] . ' minutes', strtotime($ujian_tanggal." ".$row1['ujian_mulai'])));


                            $status = 2;
                            if ($tanggal_sekarang >= $ujian_mulai && $tanggal_sekarang <= $ujian_terlambat) {
                                $status = 1;
                            } elseif ($tanggal_sekarang < $ujian_mulai) {
                                $status = 0;
                            } else {
                                if ($tanggal_sekarang <= $ujian_terlambat) {
                                    foreach ($soal_jawab as $sj) {
                                        $status = !empty($sj->soal_jawab_status) ? $sj->soal_jawab_status : $status;
                                    }
                                }
                            }

                            foreach ($soal_jawab as $sj) {
                                if ($sj->soal_jawab_status == "N") {
                                    $status = "N";
                                }
                            }

                            //$data_ujian[ 'x' ] = $tanggal_sekarang_ujian_mulai;
                            //$data_ujian[ 'y' ] = $tanggal_sekarang_ujian_terlambat;

                            $data_ujian['ujian_status'] = $status;
                            //$data_ujian[ 'x' ] = $soal_jawab;

                            array_push($response["response"], $data_ujian);
                            $response["success"] = true;
                        }

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

        $uid     = $this->input->get('uid');
        $ujianid = $this->input->get('ujianid');
        $ruangan = $this->input->get('ruangan');

        $peserta = $this->db->get_where('peserta',array("peserta_id" => $uid));
        if($peserta->num_rows() > 0) {

            foreach ($peserta->result_array() as $r2) {

                $peserta_id  		= $r2['peserta_id'];
                $kelas_sekarang  	= $r2['peserta_kelas'];
                $jurusan_id  		= $r2['peserta_jurusan'];
                $ruang  			= $r2['peserta_jurusan_ke'];
                $peserta_agama  	= $r2['peserta_agama'];
                $bisamulai          = 0;


                //MULAI GET UJIAN
                $q1 = $this->db->get_where('ujian',array('ujian_id'=>$ujianid));

                if($q1->num_rows() > 0){
                    $ujian = $q1->result();

                    $this->session->set_userdata(array(
                        'ujian_id'=>$ujianid,
                        //'ujian_tampil'=>$ujian[0]->ujian_tampil,
                    ));

                    //cek soal_jawab jika ada get jika tidak insert

                    $ujian_ikut = $this->db->select('*')->from('soal_jawab');
                    $ujian_ikut = $ujian_ikut->where(array(
                        'ujian_id'=>$ujianid,
                        'siswa_id'=>$peserta_id,
                        'soal_jawab_pelajaran' => $ujian[0]->ujian_pelajaran
                    ));

                    $ujian_ikut = $ujian_ikut->get();


                    //$data['response_ada'] = $ujian_ikut->result();

                    $soaljawab_id = 0;
                    //cek ujian jika tidak ada insert
                    if($ujian_ikut->num_rows() < 1){

                        $soal = $this->db->select('*')->from('soal')->where(array(
                            'soal_kelas'=> $ujian[0]->ujian_kelas,
                            'soal_guru' => $ujian[0]->ujian_guru,
                            'soal_pelajaran' => $ujian[0]->ujian_pelajaran
                        ));




                        //$soal = $soal->where('(soal_kelas=\'\' OR soal_kelas=\''. $ujian[0]->ujian_kelas.'\')');
                        //$soal = $soal->where('(soal_jurusan=\'\' OR soal_jurusan=\''. $ujian[0]->ujian_jurusan.'\')');
                        //$soal = $soal->where('(soal_jurusan_ke=\'\' OR soal_jurusan_ke=\''. $ujian[0]->ujian_jurusan_ke.'\')');


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
                            array_push( $list_opsi_array, array($item['soal_id'],$item['soal_jenis'],'N','-') );
                            $bisamulai++;

                        }

                        $list_soal = substr($list_soal, 0, -1);
                        $list_opsi = substr($list_opsi, 0, -1);

                        //$lama_min = $ujian[0]->ujian_minimal;

                        $lama_max = $ujian[0]->ujian_waktu;
                        $d = array(
                            'soal_jawab_list' => json_encode($list_soal_array),
                            'soal_jawab_list_opsi' => json_encode($list_opsi_array),

                            'ujian_id'  => $ujianid,
                            'siswa_id'  => $peserta_id,
                            'user_id'   => $uid,
                            'soal_jawab_pelajaran' => $ujian[0]->ujian_pelajaran,
                            'soal_jawab_ruangan'  => $ruangan,

                            'soal_jawab_tanggal' => date('Y-m-d'),
                            'soal_jawab_mulai' => date('Y-m-d H:i:s'),
                            'soal_jawab_waktu' => $ujian[0]->ujian_waktu,
                            //'soal_jawab_waktu_minimal' => $ujian[0]->ujian_minimal,

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

                    $soal_jawab = $this->db->get_where('soal_jawab', array('soal_jawab_id'=> $soaljawab_id) )->result();

                    $waktu_maksimal = $soal_jawab[0]->soal_jawab_waktu;
                    $waktu_minimal  = $this->m->getpengaturan("Waktu Minimal");

                    $waktu_maksimal = date('Y-m-d H:i:s',strtotime("+$waktu_maksimal minutes",strtotime(date($soal_jawab[0]->soal_jawab_mulai))));
                    $waktu_minimal = date('Y-m-d H:i:s',strtotime("+$waktu_minimal minutes",strtotime(date($soal_jawab[0]->soal_jawab_mulai))));



                    $response["success"] = true;
                    $response["response"] = array(
                        "soal_jawab_id"=>$soaljawab_id,
                        "waktu_maksimal"=> $waktu_maksimal,
                        "waktu_minimal"=>$waktu_minimal,
                        "bisa"=>$bisamulai,
                        "ui"=>"nativ" //nativ/classic
                    );
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
        echo json_encode($response);
        //echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }

    function ujianmulai(){


        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        $id     = $this->input->get('id');
        $soal_jawab = $this->db->get_where('soal_jawab', array('soal_jawab_id'=> $id) )->result();
        $urut_soal = json_decode( $soal_jawab[0]->soal_jawab_list );


        $urutan = 1;
        foreach($urut_soal as $item_urut_soal){
            $ambil_soal = $this->db->get_where('soal',array( 'soal_id'=> $item_urut_soal) )->result_array();
            foreach ($ambil_soal as $row1){

                $ambil_soal_parent = $this->db->get_where('soal_parent',array( 'soal_parent_id'=> $row1["soal_parent_id"]) )->result_array();

                $soal_text_parent = "<div id='soal_parent'>";
                foreach ($ambil_soal_parent as $row2){
                    $soal_text_parent.= $row2["soal_parent_text"];
                }

                $soal_text_parent.= "</div>";

                $item = array();
                $item["soal_urutan"] = $urutan;
                $item["soal_id"] = $row1["soal_id"];
                $item["soal_jenis"] = $row1["soal_jenis"];
                //$item["soal_text"] = $this->_philsXMLClean( $row1["soal_text"] );
                $item["soal_text"] = $this->_philsXMLClean( $this->_strip($row1["soal_text"]) );
                $item["soal_text_parent"] = $this->_philsXMLClean( $this->_strip($soal_text_parent) );
                //$item["soal_text"] = mb_convert_encoding($row1["soal_text"], 'HTML-ENTITIES', 'UTF-8');
                //$item["soal_text_deskripsi"] =$this->_philsXMLClean( $row1["soal_text_deskripsi"] );
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
        }



        if(count($response["response"]) > 0){
            $response["success"] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response);
    }

    function ujianselesai(){

        $response = array();
        $response["success"] = false;
        $response["response"] = array();
        $id     = $this->input->get('id');
        $data   = $this->input->post('data');
        $data2  = explode(",",$data);

        $aa = array();
        $aa["a"] = array();
        $aa["b"] = array();
        $update_ = array();

        foreach ($data2 as $val) {
            $pc = explode(":", $val);

            $id_soal = $pc[0];
            $jenis = $pc[1];
            $ragu = $pc[2];
            $jawaban = $pc[3];


            array_push($update_, array($id_soal, $jenis, $ragu, $jawaban));


        }


        //simpan dulu data peserta

        $this->db->where(array(
            'soal_jawab_id'   => $id
        ));
        $this->db->update('soal_jawab', array(
            'soal_jawab_last_update'    => date('Y-m-d H:i:s'),
            'soal_jawab_list_opsi'      => json_encode($update_),
            'soal_jawab_status'         => 'N'
        ));


        //hitung jawaban peserta

        $soal_jawab = $this->db->get_where('soal_jawab',array('soal_jawab_id'=> $id))->result();
        foreach ($soal_jawab as $x) {

            $soal_jawab_list_opsi = json_decode($x->soal_jawab_list_opsi);
            $jumlah_soal = $x->soal_jawab_jumlah_soal;
            $jumlah_benar = 0;
            $jumlah_salah = 0;
            $jumlah_terjawab = 0;
            $jumlah_tidakterjawab = 0;
            $nilai = 0;

            foreach ($soal_jawab_list_opsi as $soal_jawab_list_opsi_item) {
                $id_soal = $soal_jawab_list_opsi_item[0];
                $jenis = $soal_jawab_list_opsi_item[1];
                $ragu = $soal_jawab_list_opsi_item[2];
                $jawaban    = $soal_jawab_list_opsi_item[3]; //0-4

                //jika jenis jawaban optional dan jawaban tidak kosong
                if ($jenis == 'optional') {

                    if( $jawaban != "-" ) {
                        $jawaban_data = array();
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array('soal_id' => $id_soal))->result();
                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = json_decode($soal->soal_text_jawab);

                            //samakan jawaban peserta dengan jawaban soal
                            $nomor_jawaban = 0;
                            foreach ($soal_text_jawab as $soal_text_jawab_item) {

                                if ( $soal_text_jawab_item[0] == 1 && $jawaban == $nomor_jawaban) {
                                    $jumlah_benar++;
                                }

                                $nomor_jawaban++;
                            }

                        }

                        $jumlah_terjawab++;
                    }

                    //}elseif ($jenis == 'checkbox' && $jawaban != "" && $jawaban != "-") {
                    //}elseif ($jenis == 'essay' && $jawaban != "" && $jawaban != "-") {
                }


            }

            $jumlah_tidakterjawab = $jumlah_soal - $jumlah_terjawab;
            $jumlah_salah = $jumlah_soal - $jumlah_benar;


            if ($jumlah_soal == 40) {
                $nilai = ($jumlah_benar * 25) / 10;
            } elseif ($jumlah_soal == 30) {
                $nilai = ($jumlah_benar / 3) * 10;
            } elseif ($jumlah_soal == 25) {
                $nilai = $jumlah_benar * 4;
            }


            $nilai = round($nilai, 2);
            $nilai_bulat = round($nilai);




            $this->db->where(array(
                'soal_jawab_id'   => $id
            ));
            $this->db->update('soal_jawab', array(
                'soal_jawab_last_update'    => date('Y-m-d H:i:s'),

                'soal_jawab_benar'  => $jumlah_benar,
                'soal_jawab_salah'  => $jumlah_salah,
                'soal_jawab_ok'     => $jumlah_terjawab,
                'soal_jawab_none'   => $jumlah_tidakterjawab,
                'soal_jawab_nilai'  => $nilai,
            ));



            $response["success"] = true;

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response);

    }

    function ujiansave(){

        $response = array();
        $response["success"] = false;
        $response["response"] = array();
        $id     = $this->input->get('id');
        $data   = $this->input->post('data');
        $data2  = explode(",",$data);

        $aa = array();
        $aa["a"] = array();
        $aa["b"] = array();
        $update_ = array();

        foreach ($data2 as $val) {
            $pc = explode(":", $val);

            $id_soal = $pc[0];
            $jenis = $pc[1];
            $ragu = $pc[2];
            $jawaban = $pc[3];


            array_push($update_, array($id_soal, $jenis, $ragu, $jawaban));


        }


        //simpan dulu data peserta

        $this->db->where(array(
            'soal_jawab_id'   => $id
        ));
        $this->db->update('soal_jawab', array(
            'soal_jawab_last_update'    => date('Y-m-d H:i:s'),
            'soal_jawab_list_opsi'      => json_encode($update_),
        ));


        //hitung jawaban peserta

        $soal_jawab = $this->db->get_where('soal_jawab',array('soal_jawab_id'=> $id))->result();
        foreach ($soal_jawab as $x) {

            $soal_jawab_list_opsi = json_decode($x->soal_jawab_list_opsi);
            $jumlah_soal = $x->soal_jawab_jumlah_soal;
            $jumlah_benar = 0;
            $jumlah_salah = 0;
            $jumlah_terjawab = 0;
            $jumlah_tidakterjawab = 0;
            $nilai = 0;

            foreach ($soal_jawab_list_opsi as $soal_jawab_list_opsi_item) {
                $id_soal = $soal_jawab_list_opsi_item[0];
                $jenis = $soal_jawab_list_opsi_item[1];
                $ragu = $soal_jawab_list_opsi_item[2];
                $jawaban    = $soal_jawab_list_opsi_item[3]; //0-4

                //jika jenis jawaban optional dan jawaban tidak kosong
                if ($jenis == 'optional') {

                    if( $jawaban != "-" ) {
                        $jawaban_data = array();
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array('soal_id' => $id_soal))->result();
                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = json_decode($soal->soal_text_jawab);

                            //samakan jawaban peserta dengan jawaban soal
                            $nomor_jawaban = 0;
                            foreach ($soal_text_jawab as $soal_text_jawab_item) {

                                if ( $soal_text_jawab_item[0] == 1 && $jawaban == $nomor_jawaban) {
                                    $jumlah_benar++;
                                }

                                $nomor_jawaban++;
                            }

                        }

                        $jumlah_terjawab++;
                    }

                    //}elseif ($jenis == 'checkbox' && $jawaban != "" && $jawaban != "-") {
                    //}elseif ($jenis == 'essay' && $jawaban != "" && $jawaban != "-") {
                }


            }

            $jumlah_tidakterjawab = $jumlah_soal - $jumlah_terjawab;
            $jumlah_salah = $jumlah_soal - $jumlah_benar;


            if ($jumlah_soal == 40) {
                $nilai = ($jumlah_benar * 25) / 10;
            } elseif ($jumlah_soal == 30) {
                $nilai = ($jumlah_benar / 3) * 10;
            } elseif ($jumlah_soal == 25) {
                $nilai = $jumlah_benar * 4;
            }


            $nilai = round($nilai, 2);
            $nilai_bulat = round($nilai);



            $this->db->where(array(
                'soal_jawab_id'   => $id
            ));
            $this->db->update('soal_jawab', array(
                'soal_jawab_last_update'    => date('Y-m-d H:i:s'),

                'soal_jawab_benar'  => $jumlah_benar,
                'soal_jawab_salah'  => $jumlah_salah,
                'soal_jawab_ok'     => $jumlah_terjawab,
                'soal_jawab_none'   => $jumlah_tidakterjawab,
                'soal_jawab_nilai'  => $nilai,
            ));



            $response["success"] = true;

        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response);

    }

    function ujiansimpanakhir(){

        $data = array();
        $data['status'] = 'no';
        $data['response'] = 'Gagal disimpan';

        $id = $this->input->get('id');

        $soal_jawab = $this->db->get_where('soal_jawab',array('soal_jawab_id'=> $id))->result();
        foreach ($soal_jawab as $x) {

            $soal_jawab_list_opsi = json_decode($x->soal_jawab_list_opsi);
            $jumlah_soal = $x->soal_jawab_jumlah_soal;
            $jumlah_benar = 0;
            $jumlah_salah = 0;
            $jumlah_terjawab = 0;
            $jumlah_tidakterjawab = 0;
            $nilai = 0;

            foreach ($soal_jawab_list_opsi as $soal_jawab_list_opsi_item) {
                $id_soal = $soal_jawab_list_opsi_item[0];
                $jenis = $soal_jawab_list_opsi_item[1];
                $ragu = $soal_jawab_list_opsi_item[2];
                $jawaban    = $soal_jawab_list_opsi_item[3]; //0-4

                //jika jenis jawaban optional dan jawaban tidak kosong
                if ($jenis == 'optional') {

                    if( $jawaban != "-" ) {
                        $jawaban_data = array();
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array('soal_id' => $id_soal))->result();
                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = json_decode($soal->soal_text_jawab);

                            //samakan jawaban peserta dengan jawaban soal
                            $nomor_jawaban = 0;
                            foreach ($soal_text_jawab as $soal_text_jawab_item) {

                                if ( $soal_text_jawab_item[0] == 1 && $jawaban == $nomor_jawaban) {
                                    $jumlah_benar++;
                                }

                                $nomor_jawaban++;
                            }

                        }

                        $jumlah_terjawab++;
                    }

                    //}elseif ($jenis == 'checkbox' && $jawaban != "" && $jawaban != "-") {
                    //}elseif ($jenis == 'essay' && $jawaban != "" && $jawaban != "-") {
                }


            }

            $jumlah_salah = $jumlah_soal - $jumlah_benar;


            $jumlah_tidakterjawab = $jumlah_soal - $jumlah_terjawab;


            if ($jumlah_soal == 40) {
                $nilai = ($jumlah_benar * 25) / 10;
            } elseif ($jumlah_soal == 30) {
                $nilai = ($jumlah_benar / 3) * 10;
            } elseif ($jumlah_soal == 25) {
                $nilai = $jumlah_benar * 4;
            }


            $nilai = round($nilai, 2);
            $nilai_bulat = round($nilai);



            $this->db->where(array(
                'soal_jawab_id'   => $id
            ));
            $this->db->update('soal_jawab', array(
                'soal_jawab_selesai' => date('Y-m-d H:i:s'),
                'soal_jawab_last_update'    => date('Y-m-d H:i:s'),
                'soal_jawab_status' => 'N',

                'soal_jawab_benar'  => $jumlah_benar,
                'soal_jawab_salah'  => $jumlah_salah,
                'soal_jawab_ok'     => $jumlah_terjawab,
                'soal_jawab_none'   => $jumlah_tidakterjawab,
                'soal_jawab_nilai'  => $nilai,
            ));

            $data['status'] = 'ok';
            $data['response'] = 'Data berhasil disimpan';
        }


        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    /**
     * @return mixed
     * Function _none()
     */


    function _jumlah_peserta(){
        $ikut = $this->db->select('*')->from('peserta');
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function _jumlah_jurusan(){
        $ikut = $this->db->select('*')->from('peserta');
        $ikut = $ikut->group_by('peserta_jurusan');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_pelajaran($kelas_sekarang,$jurusan_id,$ruang){
        $ikut = $this->db->select('*')->from('soal_pembuat');
        //$ikut = $ikut->group_by('soal_pembuat_pelajaran');
        $ikut = $ikut->where('(soal_pembuat_kelas=\'\' OR soal_pembuat_kelas=\''.$kelas_sekarang.'\')');
        $ikut = $ikut->where('(soal_pembuat_jurusan=\'\' OR soal_pembuat_jurusan=\''.$jurusan_id.'\')');
        //$ikut = $ikut->where('(soal_pembuat_jurusan_ke=\'\' OR soal_pembuat_jurusan_ke=\''.$ruang.'\')');

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

    function _jumlah_ujian_today($kelas,$jurusan,$agama){
        $jum = 0;
        $tgl = date('Y-m-d');

        $ikut = $this->db->select('*')->from('ujian');
        //$ikut = $ikut->group_by('soal_pembuat_pelajaran');
        $ikut = $ikut->where('(ujian_kelas=\'\' OR ujian_kelas=\''.$kelas.'\')');
        //$ikut = $ikut->where('(ujian_jurusan=\'\' OR ujian_jurusan=\''.$jurusan_id.'\')');
        //$ikut = $ikut->where('(soal_pembuat_jurusan_ke=\'\' OR soal_pembuat_jurusan_ke=\''.$ruang.'\')');

        $ikut = $ikut->where('ujian_tanggal',$tgl);
        $ikut = $ikut->get();
        foreach ($ikut->result_array() as $row1){

            $ujian_jurusan = explode(",",$row1['ujian_jurusan']);
            $ujian_agama = explode(",",$row1['ujian_agama']);

            $a = 0;
            $b = 0;
            if( empty($row1['ujian_jurusan']) || (count($ujian_jurusan) > 0 && in_array($jurusan,$ujian_jurusan) ) ) {
                $a++;
            }

            if( empty($row1['ujian_agama']) || (count($ujian_agama) > 0 && in_array($agama,$ujian_agama) ) ) {
                $b++;
            }

            if( $a == 1 && $b == 1 ) {
                $jum++;
            }
        }

        return $jum;
    }


    function _cronJob(){
        $pengaturanToken = json_decode($this->m->getpengaturan("pengaturanToken"), true);

        $tanggal_sekarang = date('Y-m-d');
        $tgl_buka   = date('Y-m-d H:i', strtotime($tanggal_sekarang . ' '.$pengaturanToken["buka"]));
        $tgl_tutup  = date('Y-m-d H:i', strtotime($tanggal_sekarang . ' '.$pengaturanToken["tutup"]));


        $lama = 15; //menit
        $tanggal_sekarang = date('Y-m-d H:i:s');
        $tanggal_sekarang_ditambah = date('Y-m-d H:i:s',strtotime("+$lama minutes",strtotime($tanggal_sekarang)));

        $token_baru = $this->_generateRandomString(3);

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
    function _generateRandomString($length = 3) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function _philsXMLClean($strin) {


        //$strin = mb_convert_encoding($strin, 'HTML-ENTITIES', 'UTF-8');

        //return $strin;


        /*
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
                }*/

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
    function _strip1($var) {
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

        $strout = str_replace(
            "https://cbt.smkn1candipuro.sch.id/uploads/",
            "https://cbtv4.smkn1candipuro.sch.id/assets/",
            $strout
        );

        $strout = str_replace(
            "&nbsp;&nbsp;",
            "&nbsp;",
            $strout
        );

        return $strout;
    }

}