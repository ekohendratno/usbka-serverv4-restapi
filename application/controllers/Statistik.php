<?php

class Statistik extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    function index(){
        $data = array();
        $data['sumberdaya'] = array(
            'memory' => $this->_get_server_memory_usage(),
            'cpu' => $this->_get_server_cpu_usage(),
            'disk' => $this->_get_directory_size(),
            'uptime' => $this->_get_uptime(),
            'number_processes' => $this->_get_number_processes(),
            'kernel_version' => $this->_get_kernel_version(),
            'http_connections' => $this->_get_http_connections(),
            'bandwidth' => $this->_bandwidth(),
        );
        $data['peserta'] = $this->peserta();
        $data['whoisonline'] = $this->whoisonline();


        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function peserta(){

        $data = array();
        $data['total'] = $this->_total();
        $data['ikut'] = $this->_ikut();
        $data['selesai'] = $this->_selesai();
        $data['pengawas'] = $this->_pengawas();

        return $data;

        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }



    function whoisonline(){
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');

        $online = $this->db->select('*')->from('peserta');
        $online = $online->where('DATE(peserta_last_active)',$curr_date);
        $online = $online->order_by('peserta_last_active','desc');
        $online = $online->limit(20);
        $online = $online->get()->result();

        $data = array();
        foreach ($online as $a){

            //$item['user_id'] = $a->user_id;

            $level = '';
            $item['nama'] = $a->peserta_username;
            $item['kelas'] = $a->peserta_kelas.'.'.$a->peserta_jurusan.'.'.$a->peserta_jurusan_ke;

            $status = "offline";
            if(strtotime($a->peserta_last_active) > strtotime("-3 second")) { //jika waktu user lebih dari 1menit
                $status = "online";
            }

            $item['status'] = $status;
            $item['level'] = $level;

            array_push($data,$item);
        }


        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }



    function online(){

        $is = $this->session->userdata('level');

        //update time
        $now = date('Y-m-d H:i:s');

        if( $is ){
            //$this->db->where('user_id',$this->user_id);
            //$this->db->update('users',array('last_active' => $now));
        }

    }

    function _ikut(){
        $ikut = $this->db->select('*')->from('soal_jawab');
        $ikut = $ikut->where('soal_jawab_tanggal',date('Y-m-d'));
        $ikut = $ikut->where('soal_jawab_status','Y');
        $ikut = $ikut->where('siswa_id !=0');
        $ikut = $ikut->group_by('siswa_id');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _selesai(){
        $ikut = $this->db->select('*')->from('soal_jawab');
        $ikut = $ikut->where('soal_jawab_tanggal',date('Y-m-d'));
        $ikut = $ikut->where('soal_jawab_status','N');
        $ikut = $ikut->where('siswa_id !=0');
        $ikut = $ikut->group_by('siswa_id');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _total(){
        $ikut = $this->db->select('*')->from('peserta');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _pengawas(){
        $ikut = $this->db->select('*')->from('users');
        $ikut = $ikut->where('level','pengawas');
        $ikut = $ikut->get();


        return $ikut->num_rows();
    }


    /**
     * Fungsi Statistik
     * @param $size
     * @return string
     */

    function _size_format($size){
        if($size<1024)
        {
            return $size." bytes";
        }
        else if($size<(1024*1024))
        {
            $size=round($size/1024,1);
            return $size." KB";
        }
        else if($size<(1024*1024*1024))
        {
            $size=round($size/(1024*1024),1);
            return $size." MB";
        }
        else
        {
            $size=round($size/(1024*1024*1024),1);
            return $size." GB";
        }

    }

    function _get_server_memory_usage($getPercentage = true)
    {
        $memoryTotal = null;
        $memoryFree = null;

        if (stristr(PHP_OS, "win")) {
            // Get total physical memory (this is in bytes)
            $cmd = "wmic ComputerSystem get TotalPhysicalMemory";
            @exec($cmd, $outputTotalPhysicalMemory);

            // Get free physical memory (this is in kibibytes!)
            $cmd = "wmic OS get FreePhysicalMemory";
            @exec($cmd, $outputFreePhysicalMemory);

            if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
                // Find total value
                foreach ($outputTotalPhysicalMemory as $line) {
                    if ($line && preg_match("/^[0-9]+\$/", $line)) {
                        $memoryTotal = $line;
                        break;
                    }
                }

                // Find free value
                foreach ($outputFreePhysicalMemory as $line) {
                    if ($line && preg_match("/^[0-9]+\$/", $line)) {
                        $memoryFree = $line;
                        $memoryFree *= 1024;  // convert from kibibytes to bytes
                        break;
                    }
                }
            }
        }
        else
        {
            if (is_readable("/proc/meminfo"))
            {
                $stats = @file_get_contents("/proc/meminfo");

                if ($stats !== false) {
                    // Separate lines
                    $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                    $stats = explode("\n", $stats);

                    // Separate values and find correct lines for total and free mem
                    foreach ($stats as $statLine) {
                        $statLineData = explode(":", trim($statLine));

                        //
                        // Extract size (TODO: It seems that (at least) the two values for total and free memory have the unit "kB" always. Is this correct?
                        //

                        // Total memory
                        if (count($statLineData) == 2 && trim($statLineData[0]) == "MemTotal") {
                            $memoryTotal = trim($statLineData[1]);
                            $memoryTotal = explode(" ", $memoryTotal);
                            $memoryTotal = $memoryTotal[0];
                            $memoryTotal *= 1024;  // convert from kibibytes to bytes
                        }

                        // Free memory
                        if (count($statLineData) == 2 && trim($statLineData[0]) == "MemFree") {
                            $memoryFree = trim($statLineData[1]);
                            $memoryFree = explode(" ", $memoryFree);
                            $memoryFree = $memoryFree[0];
                            $memoryFree *= 1024;  // convert from kibibytes to bytes
                        }
                    }
                }
            }
        }

        if (is_null($memoryTotal) || is_null($memoryFree)) {
            return null;
        } else {
            if ($getPercentage) {
                return (100 - ($memoryFree * 100 / $memoryTotal));
            } else {
                return array(
                    "total" => $memoryTotal,
                    "free" => $memoryFree,
                );
            }
        }
    }

    function _getServerLoadLinuxData()
    {
        if (is_readable("/proc/stat"))
        {
            $stats = @file_get_contents("/proc/stat");

            if ($stats !== false)
            {
                // Remove double spaces to make it easier to extract values with explode()
                $stats = preg_replace("/[[:blank:]]+/", " ", $stats);

                // Separate lines
                $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                $stats = explode("\n", $stats);

                // Separate values and find line for main CPU load
                foreach ($stats as $statLine)
                {
                    $statLineData = explode(" ", trim($statLine));

                    // Found!
                    if
                    (
                        (count($statLineData) >= 5) &&
                        ($statLineData[0] == "cpu")
                    )
                    {
                        return array(
                            $statLineData[1],
                            $statLineData[2],
                            $statLineData[3],
                            $statLineData[4],
                        );
                    }
                }
            }
        }

        return null;
    }

    function _get_server_cpu_usage(){
        $load = null;

        if (stristr(PHP_OS, "win"))
        {
            $cmd = "wmic cpu get loadpercentage /all";
            @exec($cmd, $outputCPU);

            if ($outputCPU){
                foreach ($outputCPU as $line)
                {
                    if ($line && preg_match("/^[0-9]+\$/", $line))
                    {
                        $load = $line;
                        break;
                    }
                }
            }
        }
        else
        {
            if (is_readable("/proc/stat"))
            {
                // Collect 2 samples - each with 1 second period
                // See: https://de.wikipedia.org/wiki/Load#Der_Load_Average_auf_Unix-Systemen
                $statData1 = $this->_getServerLoadLinuxData();
                sleep(1);
                $statData2 = $this->_getServerLoadLinuxData();

                if
                (
                    (!is_null($statData1)) &&
                    (!is_null($statData2))
                )
                {
                    // Get difference
                    $statData2[0] -= $statData1[0];
                    $statData2[1] -= $statData1[1];
                    $statData2[2] -= $statData1[2];
                    $statData2[3] -= $statData1[3];

                    // Sum up the 4 values for User, Nice, System and Idle and calculate
                    // the percentage of idle time (which is part of the 4 values!)
                    $cpuTime = $statData2[0] + $statData2[1] + $statData2[2] + $statData2[3];

                    // Invert percentage to get CPU time, not idle time
                    $load = 100 - ($statData2[3] * 100 / $cpuTime);
                }
            }
        }

        return $load;
    }

    function _get_directory_size(){
        $disktotal = disk_total_space ('/');
        $diskfree  = disk_free_space  ('/');
        $diskuse   = round (100 - (($diskfree / $disktotal) * 100));

        return $diskuse;
    }

    function _get_uptime(){


        return 0;
    }

    function _get_number_processes(){
        if(!file_exists('/proc') )
            return 0;

        $proc_count = 0;
        $dh = opendir('/proc');

        while ($dir = readdir($dh)) {
            if (is_dir('/proc/' . $dir)) {
                if (preg_match('/^[0-9]+$/', $dir)) {
                    $proc_count ++;
                }
            }
        }

        return $proc_count;
    }

    function _get_kernel_version(){
        if(!file_exists('/proc/version') )
            return 0;

        $kernel = explode(' ', file_get_contents('/proc/version'));
        $kernel = $kernel[2];

        return $kernel;
    }

    function _get_http_connections(){


        return 0;
    }

    function _bandwidth(){
        $int="eth0";

        $rx[] = @file_get_contents("/sys/class/net/$int/statistics/rx_bytes");
        $tx[] = @file_get_contents("/sys/class/net/$int/statistics/tx_bytes");
        sleep(1);
        $rx[] = @file_get_contents("/sys/class/net/$int/statistics/rx_bytes");
        $tx[] = @file_get_contents("/sys/class/net/$int/statistics/tx_bytes");

        $tbps = $tx[1] - $tx[0];
        $rbps = $rx[1] - $rx[0];

        $round_rx=round($rbps/1024, 2);
        $round_tx=round($tbps/1024, 2);

        $time=date("U")."000";

        /*
        $_SESSION['rx'][] = "[$time, $round_rx]";
        $_SESSION['tx'][] = "[$time, $round_tx]";
        $data['label'] = $int;
        $data['data'] = $_SESSION['rx'];
        # to make sure that the graph shows only the
        # last minute (saves some bandwitch to)
        if (count($_SESSION['rx'])>1)
        {
            $x = min(array_keys($_SESSION['rx']));
            unset($_SESSION['rx'][$x]);
        }

        # json_encode didnt work, if you found a workarround pls write me
        # echo json_encode($data, JSON_FORCE_OBJECT);

        echo '{"label":"'.$int.'","data":['.implode($_SESSION['rx'], ",").']}';*/

        $data = array();
        $data['int'] = $int;
        $data['time'] = $time;
        $data['rx'] = $round_rx;
        $data['tx'] = $round_tx;

        return $data;

    }

}
?>