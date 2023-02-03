<?php


class Apiv7 extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');

        $this->_cronJob();


        $this->tahunajaran = $this->m->tahunajaran();


        $this->output->set_header("Access-Control-Allow-Origin:*");
        $this->output->set_header("Access-Control-Allow-Methods:GET,POST");
        $this->output->set_header("Access-Control-Allow-Headers:Origin, X-Requested-With, Content-Type, Accept");

    }

    function index()
    {
        $data = array();
        $data['message'] = 'Selamat datang di CBT API v7';
        $data['response'] = 'Parameter Failed!';

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function termofuse()
    {

        echo '<meta name="viewport" content="width=device-width, initial-scale=1"><div class="container">
        <div class="row content" style="display: flex;">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <p class="mb-5">
                    Perjanjian hukum (terms of service) yang ditetapkan di bawah ini mengatur hak dan kewajiban kopas.id (“provider”) dan pengguna layanan (“pelanggan”). Pengguna layanan dianggap telah memahami dan
                    menyetujui semua isi dari perjanjian dan mengikat secara hukum.
                </p>
                <h5 id="pendahuluan"><a href="#pendahuluan">Pendahuluan</a></h5>
                <p>
                    Terima kasih telah menggunakan layanan kami. kopas.id merupakan situs penyedia layanan hosting, reseller hosting, VPS, dedicated server, email server, G-suite, domain, serta konten website. Para pihak
                    dinyatakan tunduk pada perjanjian serta segala aturannya.
                </p>
                <p>Perjanjian (terms of service) ini adalah perjanjian baku yang ditetapkan oleh pihak provider (“kopas.id”) untuk menjamin keamanan dan kenyamanan penggunaan.</p>
                <p>Apabila ada pertentangan mengenai syarat dan ketentuan dalam dokumen terms of service ini, silahkan hubungi kami untuk penjelasan lebih lanjut.</p>
                <h5 id="penggunaanlayanan" class="mt-5"><a href="#penggunaanlayanan">Penggunaan Layanan Kopas Hosting</a></h5>
                <ol>
                    <li><b>Akses layanan.</b> Untuk dapat menggunakan layanan yang disediakan oleh provider, pelanggan mungkin memerlukan perangkat dan sistem yang kompatibel.</li>
                    <li>
                        <b>Batasan usia.</b> Segala bentuk produk dan layanan dari provider tunduk terhadap aturan hukum pidana dan perdata serta aturan turunannya, termasuk batasan usia pihak yang bersepakat. <br>
                        Apabila Anda belum berusia 21 tahun atau belum cukup dewasa menurut undang-undang, maka segala bentuk kesepakatan akan dianggap batal demi hukum.
                    </li>
                    <li>
                        <b>Pihak ketiga.</b> Segala bentuk kesepakatan yang pelanggan lakukan dengan pihak ketiga, baik berpengaruh secara langsung maupun tidak langsung adalah sepenuhnya menjadi tanggung jawab pelanggan,
                        termasuk akses, konten, serta biaya yang ditagihkan.
                    </li>
                    <li>
                        <b>Akses tidak sah.</b> Anda wajib menjaga kerahasiaan akses yang pihak provider berikan dan tidak boleh membagikannya pada orang lain. <br>
                        Segala bentuk akses tanpa izin, pengambilan data secara tidak sah, serta hacking merupakan pelanggaran keras. Upaya tersebut dapat berakibat pada gugatan, pencabutan hak, pembatalan perjanjian, serta
                        pelaporan kepada pihak berwajib. <br>
                        Provider tidak bertanggung jawab atas <b>akses tidak sah</b> yang disebabkan oleh kelalaian pelanggan, atau karena “serangan” dari pihak ketiga.
                    </li>
                    <li>
                        <b>Hak akses provider.</b> Provider (“kopas.id”) memiliki hak untuk akses halaman client dan control panel milik pelanggan untuk kebutuhan bantuan teknis serta hal lain terkait pengawasan dan
                        peningkatan layanan.
                    </li>
                    <li>
                        <b>Pembaruan Layanan.</b> Provider berupaya untuk memberikan layanan dan produk berkualitas kepada pelanggan. Oleh karena itu, segala bentuk pembaruan sistem (update &amp; maintenance) dapat dilakukan
                        secara otomatis tanpa pemberitahuan sebelumnya.
                    </li>
                </ol>
                <h5 id="datapelanggan" class="mt-5"><a href="#datapelanggan">Data Pelanggan</a></h5>
                <p>Provider menjamin keamanan data pribadi Anda di bawah undang-undang dan moral kebijakan privasi.</p>
                <p>Segala bentuk akses terhadap produk, layanan, serta pembayaran wajib memakai data dan informasi asli dari pelanggan.</p>
                <p>Berikut syarat dan ketentuan kebijakan privasi yang harus Anda penuhi:</p>
                <ol>
                    <li>
                        Anda wajib memberikan data berupa nama lengkap (pribadi/perusahaan) nomor identitas, nomor telepon, email aktif, dan informasi pribadi lain yang mungkin dibutuhkan untuk memakai layanan dari provider.
                    </li>
                    <li>
                        Segala bentuk pengubahan, penggantian, dan penambahan informasi serta data pelanggan baik karena kesalahan pengisian maupun perubahan hak kelola harus dilakukan dengan mengirimkan pernyataan resmi
                        pelanggan ke provider.
                    </li>
                    <li>Segala bentuk pemberitahuan dari provider akan dikirimkan melalui email yang pelanggan berikan. Kegagalan penerimaan dan pembacaan email adalah sepenuhnya tanggung jawab pelanggan.</li>
                    <li>
                        Provider berhak mengirimkan email baik berupa pemberitahuan, sales letter, newsletter, product campaign, dan penawaran kepada Anda serta semua jenis notifikasi yang diatur di dalam
                        <a target="_blank" class="text-pink" href="privacy.php"><b>privacy policy</b></a>.
                    </li>
                    <li>Perjanjian ini mengikat bagi para pihak yang bersepakat. Segala bentuk alih kelola akses dan layanan tidak diperbolehkan, kecuali Anda telah mengirimkan pemberitahuan alih kelola kepada provider.</li>
                    <li>Apabila pembelian paket layanan adalah untuk kebutuhan pihak ketiga, maka harus dilampirkan informasi yang jelas terkait hak kelola dan hak milik dari website tersebut.</li>
                    <li>Segala bentuk klaim terkait hak pengelolaan dan hak kepemilikan website harus dibuktikan dengan pernyataan atau dokumen tertulis kepada provider.</li>
                    <li>Provider dapat menangguhkan segala bentuk paket layanan yang telah dibeli hingga proses sengketa selesai.</li>
                    <li>Apabila ada klaim dari pihak kedua dan pihak ketiga, maka sengketa harus diselesaikan di pengadilan dan wajib mendapatkan putusan berkekuatan hukum tetap dari hakim.</li>
                    <li>Perubahan data, dan pengelolaan yang disebabkan oleh kematian pihak kedua harus dibuktikan dengan surat keterangan resmi dari pihak berwenang.</li>
                    <li>Provider memiliki hak terhadap akses client area dan control panel untuk memeriksa apakah pihak kedua telah menggunakan layanan sesuai dengan syarat dan ketentuan berlaku.</li>
                </ol>
                <h5 id="kepemilikan" class="mt-5"><a href="#kepemilikan">Kepemilikan &amp; Hak Akses</a></h5>
                <ul>
                    <li>Bukti kepemilikan dan hak akses layanan adalah kontrak yang pelanggan sepakati dan tanda tangani.</li>
                    <li>Apabila pelanggan adalah “developer” yang menggunakan layanan provider (“kopas.id”) untuk pihak ketiga, maka pelanggan wajib melampirkan data dan informasi pihak yang bersepakat.</li>
                    <li>Apabila terjadi sengketa kepemilikan dan hak akses terhadap layanan, provider akan melakukan suspend terhadap akun selama 5x24 jam sejak verifikasi laporan klaim.</li>
                    <li>Provider akan mengirimkan pemberitahuan ke alamat dan kontak pihak yang menandatangani kontrak penggunaan layanan.</li>
                    <li>
                        Apabila pelanggan tidak merespons pemberitahuan dari provider hingga waktu yang ditetapkan, maka provider akan segera memproses semua klaim yang diajukan dengan protokol penyelesaian sengketa dan klaim
                        kopas.id.
                    </li>
                    <li>Segala klaim kepemilikan dan hak akses harus disertai dengan bukti-bukti kuat berupa kontrak, kuitansi, rekam jejak komunikasi, atau putusan resmi dari pengadilan yang berkekuatan hukum tetap.</li>
                </ul>
                <h5 id="kekayaanintelektual" class="mt-5"><a href="#kekayaanintelektual">Hak Atas Kekayaan Intelektual</a></h5>
                <p>
                    Kepemilikan atas konten, fitur, fungsi (termasuk dan tidak terbatas untuk semua informasi, data, teks, tampilan, gambar, video, audio, design, struktur, dan lain sebagainya), sepenuhnya adalah hak milik pihak
                    kedua, penyedia lisensi, ataupun provider lain.
                </p>
                <p>
                    Seluruh konten, informasi dan data dari website Anda akan dilindungi oleh peraturan perundang-undangan, copyrights, trademarks, aturan rahasia dagang, serta aturan lain yang mengatur tentang properti
                    intelektual.
                </p>
                <h5 id="kebijakankonten" class="mt-5"><a href="#kebijakankonten">Kebijakan Konten</a></h5>
                <p>
                    Setiap layanan hosting dari provider sangat menjunjung aturan hukum dan moral publik di Indonesia. Mengunggah konten yang tidak pantas atau melawan hukum artinya melanggar kebijakan layanan dan dapat
                    dikenakan sanksi berupa penghentian layanan secara permanen.
                </p>
                <p>Berikut beberapa jenis konten yang tidak diterima oleh kebijakan layanan dari provider:</p>
                <ol>
                    <li>Pornografi, kekerasan, penghinaan, Hoax, dan SARA.</li>
                    <li>Semua konten yang mengakibatkan timbulnya keresahan di masyarakat.</li>
                    <li>Melanggar hak kekayaan intelektual dan hak cipta pemilik asli.</li>
                    <li>Konten yang dapat menyebarkan kebencian di masyarakat.</li>
                    <li>Konten penipuan, Ponzi, dan/atau pyramid scheme.</li>
                    <li>Phising atau konten/fungsi lain berupa tindakan tidak sah.</li>
                    <li>Segala materi ilegal yang diatur oleh undang-undang dan aturan turunan lainnya.</li>
                </ol>
                <h5 id="pembatasancbthosting" class="mt-5"><a href="#pembatasancbthosting">Pembatasan E-learning/CBT Hosting</a></h5>
                <ol>
                    <li>
                        Provider menyediakan layanan ini hanya dikhususkan penggunaan untuk kegiatan terkait, termasuk penyimpanan file pada server kami hanya untuk file yang berhubungan dengan kegiatan tersebut. Aktifitas
                        diluar kegiatan tersebut dilarang menggunakan layanan ini.
                    </li>
                    <li>
                        Penggunaan atau kegaitan ini merupakan kegiatan yang sangat berat dan sangat memberatkan server, untuk itu provider hanya dapat mengupayakan server tetap stabil dalam penggunaan, namun dengan adanya
                        kegiatan yang diluar kendali provider maka layanan ini bisa tidak bergfungsi akibat beban penggunaan tersebut.
                    </li>
                    <li>Provider dapat meghentikan layanan ini jika memang dalam kondisi tertentu mengharuskan kami untuk menghentikkan dengan kompensasi pengembalian pembayaran setelah dikurangi biaya pemakaian berjalan.</li>
                    <li>
                        Dalam menjaga kestabilan, provider melakukan pembatasan dalam hal tehnis contoh : melakukan pemblokiran terhadap aplikasi pihak ke 3 atau hal lain dan mungkin saja akan mengganggu atau mengurangi fungsi
                        dari aplikasi yang pelanggan gunakan.
                    </li>
                </ol>
                <h5 id="pembatasansharehosting" class="mt-5"><a href="#pembatasansharehosting">Pembatasan Shared, Semi Dedicated Hosting &amp; Reseller Hosting Unlimited</a></h5>
                <p>Provider merupakan penyedia layanan shared hosting. Artinya, layanan ini akan digunakan oleh lebih dari satu pelanggan.</p>
                <p>Oleh karena itu, demi menjamin kualitas layanan, provider memberlakukan pembatasan sumber daya untuk menjaga kestabilan server.</p>
                <p>Pembatasan sumber daya ini meliputi penggunaan CPU, RAM, INODE. I/O dan koneksi Database.</p>
                <p>
                    Provider menyediakan paket unlimited untuk penggunaan website secara wajar dan kami tidak mencatat penggunaan. Untuk itu, kami harap pelanggan dapat menggunakan layanan secara maksimal dalam penggunaan wajar.
                </p>
                <p>Untuk menjaga kestabilan server, kami tidak memberikan izin untuk penggunaan CPU atau RAM dengan penggunaan 100% lebih dari satu Menit secara terus menerus.</p>
                <p>
                    Provider merupakan layanan website hosting dan semua file yang pelanggan upload hanya untuk keperluan pembuatan website. Disk space pada akun hosting tidak dapat digunakan untuk penyimpanan file backup
                    termasuk file backup pada layanan hosting Anda sendiri.
                </p>
                <p>Layanan hosting kopas.id memiliki batasan dalam penggunaan file ( inode ) dengan jumlah berbeda-beda sesuai informasi yang kami cantumkan pada paket.</p>
                <p>Batasan penggunaan layanan hosting kopas.id lain adalah untuk jenis situs sebagai berikut:</p>
                <ol>
                    <li>CBT/UJIAN ONLINE atau kegiatan serupa</li>
                    <li>Penyimpanan online, file-sharing, penyimpanan Film, penyimpanan Photo, penyimpanan Software</li>
                    <li>Plugin juce code/ Google drive proxy Player Script ( JUICYCODES )</li>
                    <li>Penggunaan crondjob interval kurang dari 10 menit</li>
                    <li>Live Streaming termasuk video streaming ataupun audio streaming walaupun file tidak tersimpan di server kami</li>
                    <li>Broadcast atau streaming Kegiatan Live (UFC, NASCAR, FIFA, NFL, MLB, NBA, WWE, WWF, dll)</li>
                    <li>Situs Manga/komik online</li>
                    <li>Situs AGC</li>
                    <li>Scripts wrapper download</li>
                    <li>Topsites</li>
                    <li>HYIP Website</li>
                    <li>IRC Script / Bot</li>
                    <li>Proxy Script / Anonymisers</li>
                    <li>Perangkat Lunak bajakan / Warez</li>
                    <li>Image Hosting Script (mirip dengan Photobucket atau TinyPic)</li>
                    <li>Situs AutoSurf/PTC/PTS/PPC</li>
                    <li>IP Scanner</li>
                    <li>Program/Skrip/Aplikasi Brute Force</li>
                    <li>Bom mail / Script Spam</li>
                    <li>Situs pasang iklan (kecuali skripnya bisa dipastikan bebas dari BOT Iklan)</li>
                    <li>Dump file / Mirror Script (mirip dengan rapidshare)</li>
                    <li>Penjualan substansi dikendalikan tanpa bukti sebelum izin yang tepat</li>
                    <li>Situs Lottery / Perjudian / Iklan perjudian / Mereferalkan banner atau link ke web perjudian lain (MUDs/RPGs/PBBGs)</li>
                    <li>Situs / arsip / program yang berfokuskan pada Hacker</li>
                    <li>Forum dan / atau situs web yang mendistribusikan atau link ke warez / bajakan / konten ilegal</li>
                    <li>Situs penipuan (Termasuk, tetapi tidak terbatas pada situs yang terdaftar di aa419.org &amp; escrow-fraud.com)</li>
                    <li>Situs penjualan obat yang ilegal, Obat aborsi, beberapa obat terutama obat impor mengharuskan adanya izin penjualan dari pembuat obat.</li>
                    <li>VPN</li>
                    <li>Situs pornografi</li>
                    <li>Situs dengan tujuan dan konten yang terindikasi menyebarkan kebencian, pelecehan, dan berita bohong (hoax).</li>
                    <li>File dan dokumen ilegal.</li>
                    <li>Situs penyedia konten tanpa lisensi resmi (film, musik, gambar, dll)</li>
                </ol>
                <p>Shared Hosting hanya kami peruntukkan untuk website, sehingga penggunaan email dan kendala penggunaannya tidak menjadi jaminan atas layanan kami.</p>
                <p>Penggunaan email pada Shared Hosting atau Shared Hosting Unlimited kami batasi maksimal 50 Pengiriman per jam dan 600 email/24 jam dan maksimal total penggunaan penyimpanan email 10GB.</p>
                <p>Provider juga menerapkan batasan ukuran konten sebesar 100 megabyte per file untuk menjamin kualitas penyimpanan dan layanan lanjutan lainnya.</p>
                <p>Pembatasan layanan ini dapat bertambah ataupun berkurang, dan disesuaikan dengan kebijakan yang dibuat oleh provider.</p>
                <h5 id="pembatasandedicatedhosting" class="mt-5"><a href="#pembatasandedicatedhosting">Pembatasan Dedicated Hosting</a></h5>
                <ol>
                    <li>Layanan ini adalah layanan VPS yang kami kelola dan pelanggan dapat menggunakan ini dengan kemudahan sama seperti share hosting.</li>
                    <li>Provider membatasi 1 VPS untuk 1 pelanggan.</li>
                    <li>Pelanggan wajib melakukan pelunasan biaya sebelum menggunakan layanan dedicated hosting.</li>
                    <li>Prodiver dapat melakukan suspend terhadap Dedicated Hosting apabila pelanggan terlambat melakukan pelunasan biaya hingga jatuh tempo.</li>
                    <li>Provider dapat mengembalikan pembayaran 7 hari setelah layanan ini aktif dan untuk setiap pelanggan hanya dapat menggunakan pengembalian pembayaran 1 kali untuk semua layananan yang telah dipesan.</li>
                    <li>
                        Dedicated Hosting tidak diperbolehkan dipakai untuk segala tindakan ilegal dan tidak terbatas pada : DDOS, Hacking Tools, Pornografi ( konten seksual ), Perjudian online, human trafficking, penipuan, dan
                        lain sebagainya.
                    </li>
                    <li>Dedicated Hosting yang telah dihapus secara permanen ( terminated) tidak dapat di pulihkan.</li>
                </ol>
                <h5 id="pembatasanserver" class="mt-5"><a href="#pembatasanserver">Pembatasan VPS, Cloud Server Dan Dedicated Server</a></h5>
                <p>
                    Setiap pelanggan wajib menaati segala aturan pembatasan layanan VPS, Cloud Server, dan Dedicated Server. Apabila provider menemukan kejanggalan pada pemakaian layanan yang tidak sesuai terms of service ini,
                    pelanggan dapat dikenakan sanksi dari provider.
                </p>
                <ul>
                    <li>
                        <b>Virtual Private Server (VPS)</b>
                        <ol>
                            <li>Virtual private server (VPS) adalah bersifat UNMANAGEMENT.</li>
                            <li>Pelanggan wajib melakukan pelunasan biaya sebelum menggunakan layanan Virtual private server (VPS).</li>
                            <li>Provider dapat melakukan suspend terhadap VPS apabila pelanggan terlambat melakukan pelunasan biaya hingga jatuh tempo.</li>
                            <li>Provider tidak dapat mengembalikan segala pembayaran yang telah dilakukan oleh pelanggan terkait layanan Virtual private server (VPS).</li>
                            <li>
                                VPS tidak diperbolehkan dipakai untuk segala tindakan ilegal dan tidak terbatas pada : DDOS, hacking tools, pornografi (konten seksual), perjudian online, human trafficking, penipuan, dan lain
                                sebagainya.
                            </li>
                            <li>Permintaan upgrade dan downgrade layanan Virtual private server (VPS) provider hanya dapat dilakukan dengan pembelian paket baru.</li>
                            <li>Penggunaan layanan yang berpotensi menghabiskan bandwith server serta melanggar etika pemakaian layanan unlimited hosting server.</li>
                            <li>VPS yang telah dihapus secara permanen (terminated) tidak bisa dipulihkan.</li>
                        </ol>
                    </li>
                    <li class="mt-4">
                        <b>Cloud Server/Computer</b>
                        <ol>
                            <li>Cloud Server/Computer adalah bersifat UNMANAGEMENT.</li>
                            <li>Pelanggan wajib melakukan pelunasan biaya sebelum menggunakan layanan Cloud Server/Computer.</li>
                            <li>Provider dapat melakukan suspend terhadap Cloud Server/Computer apabila pelanggan terlambat melakukan pelunasan biaya hingga jatuh tempo.</li>
                            <li>Provider tidak dapat mengembalikan segala pembayaran yang telah dilakukan oleh pelanggan terkait layanan Cloud Server/Computer.</li>
                            <li>
                                Cloud Server/Computer tidak diperbolehkan dipakai untuk segala tindakan ilegal dan tidak terbatas pada : DDOS, hacking tools, pornografi (konten seksual), perjudian online, human trafficking,
                                penipuan, dan lain sebagainya.
                            </li>
                            <li>Permintaan upgrade dan downgrade layanan Cloud Server/Computer provider hanya dapat dilakukan dengan pembelian paket baru.</li>
                            <li>Penggunaan layanan yang berpotensi menghabiskan bandwith server serta melanggar etika pemakaian layanan unlimited hosting server.</li>
                            <li>Cloud Server/Computer yang telah dihapus secara permanen (terminated) tidak bisa dipulihkan.</li>
                        </ol>
                    </li>
                    <li class="mt-4">
                        <b>Dedicated Server</b>
                        <ol>
                            <li>Dedicated Server adalah bersifat UNMANAGEMENT.</li>
                            <li>Pelanggan wajib melakukan pelunasan biaya sebelum menggunakan layanan Dedicated Server.</li>
                            <li>Provider dapat melakukan suspend terhadap Dedicated Server apabila pelanggan terlambat melakukan pelunasan biaya hingga jatuh tempo.</li>
                            <li>Provider tidak dapat mengembalikan segala pembayaran yang telah dilakukan oleh pelanggan terkait layanan Dedicated Server.</li>
                            <li>
                                Dedicated Server tidak diperbolehkan dipakai untuk segala tindakan ilegal dan tidak terbatas pada : DDOS, hacking tools, pornografi (konten seksual), perjudian online, human trafficking, penipuan,
                                dan lain sebagainya.
                            </li>
                            <li>Permintaan upgrade dan downgrade layanan Dedicated Server provider hanya dapat dilakukan dengan pembelian paket baru.</li>
                            <li>Penggunaan layanan yang berpotensi menghabiskan bandwith server serta melanggar etika pemakaian layanan unlimited hosting server.</li>
                            <li>Dedicated Server yang telah dihapus secara permanen (terminated) tidak bisa dipulihkan.</li>
                        </ol>
                    </li>
                </ul>
                <h5 id="pembatasanemail" class="mt-5"><a href="#pembatasanemail">Pembatasan Email Hosting</a></h5>
                <p>Provider melarang keras segala upaya dan penggunaan layanan email hosting untuk kegiatan yang dapat dikategorikan sebagai SPAM dan hal lain yang diatur sebagaimana berikut:</p>
                <ol>
                    <li>Pengiriman email melebihi batasan paket yang disepakati dalam kontrak pembelian layanan. Segala pelanggaran dalam aturan ini dapat provider indikasikan sebagai upaya SPAM atau pelanggaran kontrak.</li>
                    <li>Jumlah maksimal pengiriman email melalui layanan (POP3/IMAP) standar adalah 50 email per jam dalam satu alamat IP.</li>
                    <li>
                        Provider berhak menonaktifkan layanan email karena disebabkan blacklist oleh SPAM Monitor pada IP server. Menonaktifkan server email adalah tindakan yang diperlukan untuk menyelamatkan sistem dari
                        kegagalan atau error.
                    </li>
                    <li>Provider meniadakan fitur PHP mail untuk mengurangi risiko spamming.</li>
                    <li>Email Server hanya untuk penggunaan wajar, misalnya mengirim dan menerima email melalui webmail atau email client.</li>
                </ol>
                <h5 id="gsuite" class="mt-5"><a href="#gsuite">G-Suite</a></h5>
                <p>Provider menyediakan layanan G-Suite dan tunduk pada semua ketentuan yang diterapkan oleh Google sebagai pemilik layanan.</p>
                <p>Untuk informasi selanjutnya mengenai syarat dan ketentuan G-Suite, pelanggan bisa mengunjungi bagian “privasi &amp; persyaratan” di Google (G-Suite).</p>
                <h5 id="domain" class="mt-5"><a href="#domain">Kepemilikan Domain</a></h5>
                <p>Provider bukanlah pemilik atau pengelola domain, provider hanya membantu pelanggan untuk melakukan registrasi domain (reseller).</p>
                <p>Pelanggan juga akan tunduk pada seluruh syarat dan ketentuan, serta kebijakan yang dibuat oleh penyedia domain pusat.</p>
                <p>Domain yang didaftarkan melalui provider (“kopas.id”) adalah dalam bentuk pinjaman. Pembelian (hak milik) yang dimaksud adalah masa pemakaian dan fitur pada layanan, atau hak akses terhadap domain.</p>
                <p>Apabila dikemudian hari domain tersebut tidak bisa digunakan atau dicabut aktivasinya oleh penyedia atau registrant domain, maka hal tersebut diluar tanggung jawab dari provider (“kopas.id”).</p>
                <p>
                    Provider juga tidak bertanggung jawab atas nama domain yang telah didaftarkan lebih dahulu oleh pihak lain karena keterlambatan proses pelunasan pembayaran yang disebabkan oleh kesalahan sistem, disebabkan
                    oleh jam operasional provider atau gangguan lain pada sistem dan registrant.
                </p>
                <p>
                    Seluruh aktivitas dan kebijakan yang dibuat oleh provider untuk registrasi domain Indonesia tunduk pada aturan Pengelola Nama Domain Internet Indonesia (PANDI) dan/atau peraturan lain yang terkait dengan
                    perlindungan konsumen di Indonesia.
                </p>
                <h5 id="pembayaran" class="mt-5"><a href="#pembayaran">Pemesanan &amp; Pembayaran</a></h5>
                <ol>
                    <li>
                        <b>Biaya layanan.</b> Provider merupakan penyedia produk dan layanan hosting berbayar. Anda bisa mendapatkan layanan berdasarkan paket yang telah dibeli sebelumnya. <br>
                        Segala bentuk penambahan fitur dan layanan dapat dikenakan biaya tambahan serta syarat ketentuan berlaku.
                    </li>
                    <li>
                        <b>Pemesanan Produk &amp; Layanan.</b> Saat pelanggan membeli layanan dari provider, pelanggan mungkin akan mendapatkan kontrak lain di luar terms of service untuk beberapa kondisi khusus, seperti
                        permintaan penambahan layanan atau permintaan fitur lain di luar paket. <br>
                        Kontrak pembelian terpisah memiliki klausul yang berbeda dengan isi terms of service, dan keberlakuan ketentuan di dalam dokumen ini dapat berubah sesuai kesepakatan para pihak. <br>
                        Perjanjian dan klausul dalam dokumen kontrak akan berlaku saat Anda mendapat konfirmasi pembelian dari kopas.id. Sedangkan masa berlaku kontrak akan ditentukan berdasarkan paket atau dapat diatur
                        kemudian berdasarkan persetujuan para pihak.
                    </li>
                    <li>
                        <b>Konfirmasi sistem.</b> Setiap pembelian dan pembayaran harus terkonfirmasi oleh sistem. Kegagalan terhadap aktivasi paket bukan tanggung jawab dari pihak kopas.id. Oleh karena itu, harap melakukan
                        konfirmasi secara langsung setelah pembayaran.
                    </li>
                    <li>
                        <b>Keterlambatan.</b> Provider memberikan jangka waktu 2 (dua) hari suspend terhadap akun yang telah masuk masa jatuh tempo pembayaran (perpanjangan) serta 7 (tujuh) hari sebelum akun dihapus secara
                        permanen (terminate) dari sistem. <br>
                        Layanan backup dan restore tidak dapat dilakukan saat akun pelanggan di suspend akibat keterlambatan pembayaran. Pelanggan wajib melanjutkan aktivasi akun sebelum mengajukan permintaan tersebut. <br>
                        Keterlambatan pembayaran yang melebihi batas waktu jatuh tempo dapat mengakibatkan akun dihapus secara permanen (terminate).<br>
                        Pelanggan wajib melakukan registrasi ulang (renewal) untuk menggunakan layanan dari provider.<br>
                        Provider juga tidak bertanggung jawab atas domain yang tidak bisa dipakai karena telah digunakan oleh orang lain setelah terminate.<br>
                        Untuk itu, pelanggan wajib melakukan registrasi dengan domain baru.
                    </li>
                    <li>
                        <b>Penghapusan akun.</b> Akun pelanggan yang tidak terkonfirmasi pembayarannya tidak akan aktif dan akan dihapus secara otomatis oleh sistem dalam jangka waktu yang telah ditentukan.<br>
                        Segala bentuk pembayaran yang dilakukan terhadap akun terminate atau dihapus secara permanen tidak bisa diajukan klaim pengembalian.<br>
                        Pelanggan wajib membeli paket layanan dan instalasi untuk aktivasi akun yang telah terminate (dihapus).
                    </li>
                    <li><b>Klaim kerugian.</b> kopas.id tidak menerima klaim pengembalian uang atas kegagalan aktivasi. Namun, kami akan menggantinya dengan layanan re-aktivasi layanan sesuai dengan paket yang dibeli.</li>
                    <li>
                        <b>Kelebihan pembayaran.</b> Provider tidak dapat mengembalikan kelebihan pembayaran yang disebabkan oleh kelalaian pelanggan. Namun, provider akan memasukkan sisa dari kelebihan pembayaran ke saldo
                        kredit milik pelanggan. <br>
                        Saldo kredit pelanggan hanya bisa digunakan selama akun aktif dan akan dihapus apabila pelanggan memutuskan untuk mengakhiri langganan di kopas.id. Penghapusan akun juga dapat disebabkan karena
                        alasan tertentu, seperti tidak membayar biaya layanan hingga melewati tanggal jatuh tempo.
                    </li>
                </ol>
                <h5 id="pelanggaran" class="mt-5"><a href="#pelanggaran">Pelanggaran &amp; Tindakan</a></h5>
                <ol>
                    <li><b>Etika pemakaian.</b> Pihak kedua wajib memahami etika pemakaian layanan hosting dari kopas.id. Pemakaian batas pemakaian wajar merupakan pelanggaran terhadap etika pemakaian layanan.</li>
                    <li><b>Spam.</b> Setiap kegiatan yang bertujuan untuk spam tidak akan ditolerir oleh kebijakan kopas.id.</li>
                    <li><b>Hacking dan Akses tidak sah.</b> Setiap kegiatan yang berpotensi merusak dan/atau mengambil informasi dari server kopas.id adalah tindakan ilegal dan tidak sah.</li>
                </ol>
                <p>Setiap pelanggaran akan dikenakan tindakan berupa sanksi, mulai dari suspend untuk pelanggaran ringan (etika) dan pembatalan layanan untuk pelanggaran berat (hacking dan pengulangan).</p>
                <p>Setiap pembatalan layanan yang disebabkan oleh pelanggaran tidak mendapat pengembalian (refund) paket yang telah dibeli.</p>
                <h5 id="perubahanlayanan" class="mt-5"><a href="#perubahanlayanan">Perubahan Layanan &amp; Harga</a></h5>
                <p>Setiap produk, jenis, dan spesifikasi layanan dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya dari provider.</p>
                <p>Pelanggan akan mendapatkan pemberitahuan perubahan harga dan layanan apabila akan melakukan perpanjangan layanan pada hari durasi paket habis.</p>
                <p>Segala kerugian baik materiil maupun immateriil pihak kedua bukanlah menjadi tanggung jawab kopas.id.</p>
                <h5 id="pembatalan" class="mt-5"><a href="#pembatalan">Pembatalan Layanan dan Pengembalian</a></h5>
                <p>kopas.id tidak memberikan jaminan pengembalian. Jika Anda meminta membatalkan, layanan kami hentikan namun kami tidak mengembalikan pembayaran Anda.</p>
                <p>Kami sangat menyarankan Anda menggunakan layanan gratis yang kami berikan untuk memastikan layanan kami sesuai kebutuhan Anda.</p>
                <h5 id="backupdata" class="mt-5"><a href="#backupdata">Backup Data</a></h5>
                <p>Provider menyediakan fasilitas bantuan teknis berupa perlindungan data (Backup) yang ada di server hosting kopas.id.</p>
                <p>Fasilitas backup data hanya dapat digunakan untuk layanan dan paket Share Hosting, Email Hosting, dan Reseller Hosting.</p>
                <p>Durasi backup adalah satu minggu satu kali dengan jumlah data tidak lebih dari 10 Gigabyte atau 250.000 inode.</p>
                <p>Setiap data yang pihak kedua mohonkan untuk backup akan menimpa data hasil backup sebelumnya. kopas.id tidak bertanggung jawab atas tingkat akurasi dan keberhasilan backup data.</p>
                <p>Seluruh fasilitas backup data ini dapat digunakan secara gratis dengan ketentuan di atas.</p>
                <p>Kopas Hosting juga menyediakan fasilitas restore data gratis satu kali sebulan. Apabila pihak kedua memohon penambahan fasilitas restore data, maka provider akan mengenakan biaya Rp 100.000/GB.</p>
                <h5 id="garansi" class="mt-5"><a href="#garansi">Garansi &amp; Ganti Rugi</a></h5>
                <p>Kami satu-satunya hosting yang tidak menerima klaim garansi dan ganti rugi. Uptime jaringan dan server serta pelayanan baik hanya dapat kami usahakan tidak dapat kami jaminkan.</p>
                <p>Jika Anda tipe orang yang suka merepotkan, suka komplain, dan suka menyalahkan, sebaiknya tidak mempertimbangkan kami sebagai plihan hosting Anda.</p>
                <h5 id="forcemajeure" class="mt-5"><a href="#forcemajeure">Force Majeure</a></h5>
                <p>
                    Force majeure merupakan sebuah keadaan memaksa dan berada di luar kendali serta kemampuan manusia. Force majeure meliputi bencana alam, kebakaran, keadaan darurat, serta kondisi lain yang diatur oleh
                    undang-undang dan/atau aturan turunannya.
                </p>
                <p>Segala kesalahan yang terjadi karena koneksi internet dan gangguan lain yang disebabkan oleh pihak ketiga adalah termasuk force majeure.</p>
                <p>Kebijakan force majeure ini juga meliputi segala jenis serangan dan gangguan dari pihak luar (DDOS, dan lain sebagainya) dengan tujuan perusakan, akses tidak sah, hingga penghancuran data.</p>
                <p>
                    Kesalahan sistem yang mengakibatkan kerugian atau terhambatnya layanan dari kopas.id tidak bisa dituntut ganti rugi atau gugatan hingga pihak kedua bisa membuktikan hal tersebut bukanlah force majeure di
                    persidangan.
                </p>
                <h5 id="regulasi" class="mt-5"><a href="#regulasi">Regulasi dan Penyelesaian Sengketa</a></h5>
                <p>Semua layanan dan produk dari kopas.id akan dilaksanakan berdasarkan UU ITE, UU Perlindungan konsumen, serta peraturan perundang-undangan lain yang terkait.</p>
                <p>Para pihak akan menempuh penyelesaian sengketa berupa musyawarah mufakat sebelum membawa sengketa tersebut ke pengadilan.</p>
                <p>
                    Sengketa yang timbul dari kesepakatan, perjanjian, dan kontrak, baik secara lisan maupun tertulis yang dilakukan oleh “pelanggan” dengan “developer” atau pihak lain yang ditunjuk oleh “pelanggan” untuk
                    mengembangkan situsnya bukanlah tanggung jawab dari provider.
                </p>
                <p>Provider hanya akan memproses klaim dari pihak yang bisa memberikan bukti terkuat (kontrak, putusan pengadilan, dll).</p>
                <h5 id="keterbukaan" class="mt-5"><a href="#keterbukaan">Kebijakan Keterbukaan Hukum</a></h5>
                <p>
                    Provider sangat mendukung keterbukaan hukum di Indonesia. Oleh karena itu, segala bentuk akses yang dilakukan oleh instansi berwenang untuk kebutuhan proses penyelidikan ke akun milik pelanggan tidak dapat
                    digugat dalam bentuk apapun.
                </p>
                <h5 id="syaratdanketentuan" class="mt-5"><a href="#syaratdanketentuan">Perubahan Syarat dan Ketentuan</a></h5>
                <p>Provider berhak mengubah, menambah, mengurangi, dan menghapus ketentuan dalam terms of service ini dengan atau tanpa pemberitahuan kepada pelanggan.</p>
                <p>Segala bentuk perubahan syarat dan ketentuan bisa diketahui dari pernyataan “diperbarui sejak” pada bagian atas dan/atau bawah ketentuan ini.</p>
                <h5 id="penutup" class="mt-5"><a href="#penutup">Penutup</a></h5>
                <p>
                    Dengan membaca seluruh pasal, syarat dan ketentuan yang termuat dalam terms of service ini, para pihak dianggap mengerti dan memahami setiap akibat hukum yang terjadi bilamana terjadi pelanggaran atau kondisi
                    di luar kesepakatan.
                </p>
                <p>Pelanggan wajib menyetujui seluruh isi dari dokumen terms of service ini untuk bisa menggunakan layanan dari provider.</p>
                <p class="c-orange mt-5">Terakhir di perbarui 26 Maret 2021</p>
            </div>
        </div>
        <!-- FAQ Tab End -->
        <div class="row">
            <div class="col-md-12 mt-5">
                <!-- FAQ Item Start -->
                <div class="panelX panel-default faq--panel-simple text-center pt-5" data-revealfrombottom="" data-sr-id="1" style="visibility: visible; -webkit-transform: translateY(20px) scale(0.9); opacity: 0; transform: translateY(20px) scale(0.9); opacity: 0;">
                    <h4 class="panel-title">Sudah paham dan siap order?</h4>
                    <div class="panel-body">
                        <p>Jika Anda sudah membaca dan paham <a class="text-pink" href="/sla.php" target="_blank">SLA</a> silahkan untuk di lanjutkan. Tetapi jika anda keberatan silahkan tinggalkan kopas.id Segera</p>
                        <div class="pricing--footer"><a href="/" class="btn--default hover">ORDER SEKARANG</a></div>
                    </div>
                </div>
                <!-- FAQ Item End -->
            </div>
        </div>
    </div>';
    }

    function privacypolice()
    {

        echo '<meta name="viewport" content="width=device-width, initial-scale=1"><div class="container">
        <div class="row content" style="display: flex;">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <p>Harap dibaca dan dipahami dengan seksama!</p>
                <p>
                    Pelanggan dianggap telah mengerti dan memahami semua syarat dan ketentuan penggunaan layanan dari kopas.id (“provider”), serta setuju dengan semua syarat, ketentuan, dan kondisi yang tertuang di dalam
                    kebijakan (“privacy policy”) ini.
                </p>
                <p>
                    Kebijakan privasi (“privacy policy”) ini tidak terbatas pada perangkat aplikasi web dan seluler. Semua perangkat yang dimungkinkan untuk mengakses layanan atau halaman provider akan menaati kebijakan
                    (“privacy policy”) ini.
                </p>
                <h5 id="privasi" class="mt-5"><a href="#privasi">Privacy Policy</a></h5>
                <p>Kebijakan privasi (“privacy policy”) : Kami (“provider/kopas.id”) memberi perhatian dan kepedulian khusus terhadap privasi atas data serta informasi Anda (“pelanggan”).</p>
                <p>Atas dasar alasan tersebut, kami akan mengumpulkan dan menggunakan data pribadi/perusahaan Anda hanya untuk kebutuhan pengiriman pemberitahuan mengenai produk dan layanan ke perangkat Anda.</p>
                <p>Data pribadi yang kami maksudkan adalah meliputi:</p>
                <ul>
                    <li>Nama</li>
                    <li>Alamat</li>
                    <li>Tagihan dan pengiriman informasi</li>
                    <li>Nomor telepon (selular/kantor)</li>
                    <li>Email</li>
                    <li>Rekening koran</li>
                    <li>Alamat Internet Protocol (IP)</li>
                    <li>Serta data lain berhubungan langsung dan tidak langsung dapat dipakai untuk mengidentifikasi Anda.</li>
                </ul>
                <p>
                    Kebijakan (“privacy policy”) ini menjelaskan apa dan bagaimana data pribadi Anda dikumpulkan dan digunakan oleh provider (“kopas.id”). Kebijakan ini juga mengakomodasi Anda untuk mengubah dan memperbarui,
                    atau mengambil kendali atas data yang diproses oleh provider.
                </p>
                <p>
                    Anda dapat menghubungi provider apabila memiliki pertanyaan terkait data di <a target="_blank" class="text-pink" href="https://member.kopas.id/submitticket.php"><b>TIKET</b></a>. Kotak masuk tiket ini
                    selalu dipantau dan diperiksa setiap saat, sehingga provider dapat menanggapi segala pertanyaan dan pesan Anda secepat dan sesegera mungkin.
                </p>
                <h5 id="perubahanprivasi" class="mt-5"><a href="#perubahanprivasi">Perubahan Privacy Policy</a></h5>
                <p>Kebijakan privasi (“privacy policy”) ini dapat diubah dan diganti sewaktu-waktu oleh provider untuk pengembangan dan peningkatan kualitas layanan.</p>
                <p>Tanggal “pembaharuan/revisi” akan ditampilkan dengan “terakhir diperbarui” yang terletak diawal dan/atau diakhir kebijakan ini.</p>
                <p>Apabila Anda tidak setuju dengan isi kebijakan atau perubahan pada dokumen ini, maka “jangan gunakan” atau “terus gunakan” bila setuju.</p>
                <h5 id="informasi" class="mt-5"><a href="#informasi">Informasi yang Dibutuhkan</a></h5>
                <ul>
                    <li>
                        <b>Informasi Pribadi</b>
                        <p>
                            Provider dapat mengumpulkan data dan informasi pribadi Anda melalui internet/online, telepon, serta dokumen lain yang Anda sertakan ketika berhubungan dengan provider, baik melalui situs web atau
                            media sosial.
                        </p>
                        <p>
                            Jenis data dan informasi pribadi Anda dapat mencakup dan tidak terbatas pada alamat IP, nama, alamat, nomor telepon, tanggal lahir, pendirian (perusahaan), informasi penagihan dan pengiriman,
                            email, informasi tentang perusahaan, kartu kredit, dan informasi akun rekening koran.
                        </p>
                    </li>
                    <li>
                        <b>Non-Data Pribadi</b>
                        <p>
                            Selain data pribadi/perusahaan, provider juga bisa melihat dan mengakses data lain yang berupa dan tidak terbatas pada riwayat penelusuran, tag, cookies, IP, beacon serta data lain yang diakses
                            dari berbagai perangkat.
                        </p>
                    </li>
                </ul>
                <h5 id="datapelanggan" class="mt-5"><a href="#datapelanggan">Penggunaan dan Pembagian Data Pelanggan</a></h5>
                <p>Untuk menjamin kenyaman pelanggan atas informasi dan data pribadi, provider (“kopas.id”) menerapkan kebijakan pembatasan dalam hal pemanfaatan data pribadi pelanggan, sebagai berikut:</p>
                <ul>
                    <li>
                        <b>Penggunaan Informasi Pelanggan</b>
                        <p>Setelah pelanggan menyetujui syarat dan ketentuan penggunaan layanan, provider mengelola data dan informasi pribadi pelanggan dengan cara, namun tidak terbatas pada:</p>
                        <ol>
                            <li>Pengiriman notifikasi terkait tagihan, konfirmasi pemesanan, pesan layanan pelanggan, dan lain sebagainya.</li>
                            <li>Merespons permintaan pelanggan untuk informasi produk, layanan, dan lain sebagainya.</li>
                            <li>Mengirim dan memproses aplikasi survey.</li>
                            <li>Proses pemberian layanan.</li>
                            <li>Mengirim konten dan iklan marketing kepada pelanggan.</li>
                            <li>Menganalisis masalah dengan cara mengidentifikasi kesalahan, risiko keamanan, serta peningkatan layanan.</li>
                            <li>Mendeteksi dan mencegah penyalahgunaan layanan.</li>
                            <li>Mengumpulkan informasi untuk diolah menjadi data statistik.</li>
                            <li>Menganalisis kebiasaan pelanggan dalam menggunakan layanan dan menentukan produk yang paling relevan.</li>
                            <li>Berkomunikasi dengan pelanggan.</li>
                        </ol>
                    </li>
                    <li>
                        <b>Transfer Data Pelanggan</b>
                        <p>
                            Apabila pelanggan pengguna layanan berasal dan menetap dari negara atau wilayah yurisdiksi yang berbeda dari provider, maka kegiatan Anda akan menimbulkan transfer data pribadi melewati batas
                            internasional.
                        </p>
                        <p>Ketika pelanggan menghubungi provider untuk kebutuhan bantuan teknis atau hal lainnya, maka pelanggan yang berada di luar wilayah yurisdiksi negara provider akan ditangani dengan kebijakan ini.</p>
                    </li>
                    <li>
                        <b>Pembagian Data Pelanggan</b>
                        <p>
                            Untuk kebutuhan pengembangan bisnis dan layanan, provider berhak membagikan data pelanggan kepada pihak ketiga dengan batas tertentu dan dibawah perjanjian keamanan data baru dengan materi yang
                            lebih spesifik.
                        </p>
                        <p>Berikut tiga tujuan pembagian data pelanggan kepada pihak ketiga yang bisa dilakukan oleh provider:</p>
                        <ol>
                            <li>Memakai data dan informasi pribadi pelanggan oleh provider untuk berbagai proyek pengembangan bisnis yang mungkin melibatkan pihak ketiga (partner/sub kontraktor).</li>
                            <li>
                                Membagikan data pribadi pelanggan kepada pihak ketiga dengan tujuan penawaran dan tender. Beberapa data seperti alamat, email, telepon, dan data yang tidak memiliki hubungan dengan penawaran
                                akan tetap dijaga privasinya.
                            </li>
                            <li>Membagikan data pelanggan kepada penegak hukum dan institusi yang berwenang untuk mendukung proses penyelidikan.</li>
                        </ol>
                    </li>
                    <li>
                        <b>Penggunaan dan Pembagian Email Pelanggan</b>
                        <p>Penggunaan dan pemanfaatan alamat email dan kontak pelanggan tidak akan melibatkan pihak ketiga kecuali institusi hukum yang berwenang.</p>
                    </li>
                </ul>
                <h5 id="loginotomatis" class="mt-5"><a href="#loginotomatis">Login otomatis menggunakan Facebook dan Google</a></h5>
                <ol>
                    <li>Dalam memudahkan User untuk login, Provider menyediakan fasilitas login otomatis melalui Facebook dan Google dari sisi Pelanggan.</li>
                    <li>
                        Apabila User login menggunakan fasilitas login otomatis melalui Facebook dan Google, maka Pelanggan dianggap menyetui memberikan data email dan nama yang tertera pada akun facebook maupun Google
                        kepada Provider.
                    </li>
                    <li>Data email maupun nama yang digunakan pada akun facebook maupun Google akan digunakan oleh Provider dalam proses pendaftaran .</li>
                    <li>Perubahan data email dan nama akun Facebook atau Google dapat dilakukan dengan cara mengirimkan notifikasi permintaan secara resmi kepada Provider.</li>
                    <li>
                        Pelanggan juga dapat melakukan penghapusan data integrasi login Facebook atau Google yang terdaftar di Provider dengan cara login ke member area kemudian pada menu profil pelanggan masuk dan pelanggan
                        pilih menu "Security Settings" dan klik tombol "Unlink".
                    </li>
                </ol>
                <h5 id="antispam" class="mt-5"><a href="#antispam">Kebijakan Anti-Spam</a></h5>
                <p>Provider berkomitmen untuk menjaga alamat email dan kontak pelanggan, baik pribadi maupun perusahaan dari pihak-pihak yang tidak berkepentingan untuk mencegah penyalahgunaan dan spam.</p>
                <h5 id="penyimpanandata" class="mt-5"><a href="#penyimpanandata">Penyimpanan Data Pelanggan</a></h5>
                <p>Provider dapat menyimpan data dan informasi pribadi pelanggan bahkan ketika Anda memutuskan untuk berhenti berlangganan layanan.</p>
                <p>Provider berkomitmen untuk menjaga dan menggunakan data pribadi pelanggan secara wajar serta tetap mematuhi etika, norma, serta aturan hukum Indonesia walaupun akun pelanggan telah dinonaktifkan.</p>
                <p>Namun, pelanggan juga dapat mengirim permohonan penghapusan seluruh data dan informasi pribadi di sistem yang dikelola oleh provider (“kopas.id”).</p>
                <h5 id="batasanusia" class="mt-5"><a href="#batasanusia">Batasan Usia Pelanggan</a></h5>
                <p>Tidak ada seorangpun pelanggan dibawah usia 18 tahun yang boleh memberikan data dan informasi pribadi mereka kepada provider.</p>
                <p>Privacy policy adalah bagian dari perjanjian yang mengikat dan menimbulkan akibat hukum.</p>
                <p>Namun, apabila ditemukan data atau informasi pribadi dari anak-anak dibawah 18 tahun dikemudian hari, maka hal tersebut adalah tidak disengaja.</p>
                <h5 id="jaminankeamanan" class="mt-5"><a href="#jaminankeamanan">Jaminan Keamanan Informasi</a></h5>
                <p>
                    Provider menerapkan langkah-langkah dan standard operational procedure (SOP) wajar secara komersial untuk membantu melindungi pelanggan dan sistem yang dikelola provider dari tindakan akses tidak sah,
                    baik dalam bentuk pengubahan, pengungkapan, hingga penghancuran data.
                </p>
                <p>Namun, tidak ada jaminan 100% terkait keamanan internet dan digital dari hal yang mungkin akan mengancam.</p>
                <p>Oleh karena itu, provider hanya bisa membuat standar dan kesepakatan ketat terkait pengolahan data dan informasi pelanggan dari pihak ketiga, khususnya untuk mitra.</p>
                <p>Segala bentuk akses tidak terhadap data dan informasi pelanggan akan dikenai sanksi disipliner, dan sangat mungkin akan berujung pada gugatan perdata atau pelaporan ke pihak yang berwenang.</p>
                <h5 id="userid" class="mt-5"><a href="#userid">User ID &amp; Password</a></h5>
                <p>Setiap ID dan password yang diberikan oleh provider adalah tanggung jawab pribadi dari pelanggan.</p>
                <p>Akses tidak sah yang dilakukan melalui ID dan password resmi bukan tanggung jawab dari provider, kecuali apabila akses tersebut berasal dari luar (hacking).</p>
                <p>Hak akses ke halaman client milik pelanggan akan dilindungi sebisa mungkin, namun apabila tetap terjadi kebocoran data, hal tersebut sudah diluar kuasa dan wewenang provider.</p>
                <h5 id="perubahandata" class="mt-5"><a href="#perubahandata">Perubahan Data Pelanggan</a></h5>
                <p>Perubahan data dan informasi dapat dilakukan dengan cara mengirim notifikasi permintaan secara resmi kepada provider (“kopas.id”).</p>
                <h5 class="mt-5">Kontak Kami</h5>
                <p>
                    <a class="text-pink" href="https://member.kopas.id/submitticket.php"><b>Tiket</b></a>
                </p>
                <p class="mt-5">Terakhir di perbarui 2 November 2021</p>
            </div>
        </div>
        <!-- FAQ Tab End -->
        <div class="row">
            <div class="col-md-12 mt-5">
                <!-- FAQ Item Start -->
                <div class="panelX panel-default faq--panel-simple text-center pt-5" data-revealfrombottom="" data-sr-id="1" style="visibility: visible; -webkit-transform: translateY(20px) scale(0.9); opacity: 0; transform: translateY(20px) scale(0.9); opacity: 0;">
                    <h4 class="panel-title">Sudah paham dan siap order?</h4>
                    <div class="panel-body">
                        <p>Jika Anda sudah membaca dan paham <a class="text-pink" href="/sla.php" target="_blank">SLA</a> silahkan untuk di lanjutkan. Tetapi jika anda keberatan silahkan tinggalkan kopas.id Segera</p>
                        <div class="pricing--footer"><a href="/" class="btn--default hover">ORDER SEKARANG</a></div>
                    </div>
                </div>
                <!-- FAQ Item End -->
            </div>
        </div>
    </div>';
    }



    function update()
    {
        $versi     = $this->input->get('v');


        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        $version = $this->db->select('*')->from('version')->order_by('version_nomor', 'desc')->limit(1)->get();
        foreach ($version->result() as $v) {

            if ($v->version_nomor >= $versi) {

                $response["success"] = true;

                $response["response"] = array(
                    "wajib" => $v->version_wajib,
                    "ukuran" => $v->version_ukuran,
                    "pesan" => "Ditemukan versi terbaru " . $v->version_nama . ", silahkan luangkan waktu untuk memperbarui aplikasi!\n\n" . $v->version_text,
                    "name" => $v->version_nama,
                    "code" => (int) $v->version_nomor,
                    "code_minimal" => (int) $v->version_nomor_minimal,
                    "link" => $this->config->item('base_url') . '/assets/update/cbt' . $v->version_nomor . '.apk'

                );
            }
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    function sendupdate()
    {
        $code = $this->input->get('code');

        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        $version = $this->db->select('*')->from('version')->where('version_nomor', $code)->get();

        foreach ($version->result() as $v) {
            $hits = $v->version_hits;

            $this->db->where("version_nomor", $v->version_nomor);
            $this->db->update("version", array("version_hits" => ($hits + 1)));
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }



    function signin()
    {
        $username = $this->input->post('u');
        $password = $this->input->post('p');

        $response = array();
        $response["ftp_server"] = "";
        $response["ftp_port"] = 0;
        $response["ftp_username"] = "";
        $response["ftp_password"] = "";
        $response["ftp_path"] = "";
        $response["uploadVideosAll"] = "0";
        $response["success"] = false;
        $response["response"] = "";
        $response["tahunajaran"] = $this->tahunajaran;



        $tanggal_sekarang = date('Y-m-d H:i:s');

        if (empty($username) || empty($password)) {
            $response["success"] = false;
            $response["response"] = "Username atau Password kosong!";
        } else {

            $peserta1 = $this->db->get_where('peserta', array(
                'peserta_username' => $username,
                'peserta_password' => $password
            ));


            if ($peserta1->num_rows() > 0) {

                foreach ($peserta1->result_array() as $peserta) {

                    $userdata = array();
                    $userdata['uid'] = $peserta['peserta_id'];
                    $userdata['nama'] = $peserta['peserta_nama'];

                    $userdata['foto'] = "";
                    if (!empty($peserta['peserta_foto']) && file_exists(FCPATH . 'assets/profile/' . $peserta['peserta_foto'])) {
                        $userdata['foto'] = $this->config->item('base_url') . '/assets/profile/' . $peserta['peserta_foto'];
                    }

                    $userdata['level'] = "peserta";
                    $userdata['jk'] = $peserta['peserta_jk'];
                    $userdata['nis'] = $peserta['peserta_nis'];
                    $userdata['nomor'] = $peserta['peserta_nomor'];
                    $userdata['agama'] = ucfirst($peserta['peserta_agama']);
                    $userdata['kelas'] = $peserta['peserta_kelas'];
                    $userdata['jurusan'] = $peserta['peserta_jurusan'];
                    $userdata['jurusan_ke'] = $peserta['peserta_jurusan_ke'];

                    $response["success"] = true;
                    $response["response"] = $userdata;

                    $ruangan = $this->input->post('r');
                    if (!empty($ruangan) && $ruangan > 0) {


                        $peserta_last_sesi_update = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($tanggal_sekarang)));


                        $this->db->where(array("peserta_id" => $peserta['peserta_id']));
                        $this->db->update("peserta", array(
                            "peserta_ruangan" => $ruangan,
                            "peserta_last_sesi" => $peserta_last_sesi_update
                        ));
                    }
                }
            } else {

                $users = $this->db->get_where('users', array(
                    'username' => $username,
                    'password' => $password
                ))->row_array();

                if (!empty($users) && $users['level'] == 'pengawas') {

                    $userdata = array();
                    $userdata['uid']    = $users['user_id'];
                    $userdata['nama']       = $users['username'];
                    $userdata['nomor']      = "";
                    $userdata['foto']       = "";
                    $userdata['level']      = "pengawas";

                    $response["success"] = true;
                    $response["response"] = $userdata;
                } else {
                    $response["success"] = false;
                    $response["response"] = "Username atau Password tidak sesuai!";
                }
            }
        }



        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }


    function signin_cek()
    {
        $username = $this->input->get('u');
        $password = $this->input->get('p');

        $response = array();
        $response["ftp_server"] = "";
        $response["ftp_port"] = 0;
        $response["ftp_username"] = "";
        $response["ftp_password"] = "";
        $response["ftp_path"] = "";
        $response["uploadVideosAll"] = "0";
        $response["success"] = false;
        $response["response"] = "";



        $tanggal_sekarang = date('Y-m-d H:i:s');

        if (empty($username) || empty($password)) {
            $response["success"] = false;
            $response["response"] = "Username atau Password kosong!";
        } else {

            $peserta1 = $this->db->get_where('peserta', array(
                'peserta_username' => $username,
                'peserta_password' => $password
            ));


            if ($peserta1->num_rows() > 0) {

                foreach ($peserta1->result_array() as $peserta) {

                    $userdata = array();
                    $userdata['uid'] = $peserta['peserta_id'];

                    $userdata['foto'] = "";
                    if (!empty($peserta['peserta_foto']) && file_exists(FCPATH . 'assets/profile/' . $peserta['peserta_foto'])) {
                        $userdata['foto'] = $this->config->item('base_url') . '/assets/profile/' . $peserta['peserta_foto'];
                    }

                    $peserta_last_sesi = $peserta['peserta_last_sesi'];

                    $userdata['peserta_last_sesi'] = $peserta_last_sesi;


                    $peserta_last_sesi_tmp = date("Y-m-d H:i:s", strtotime($peserta_last_sesi));
                    $peserta_last_sesi_update = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($tanggal_sekarang)));

                    $ruangan = $this->input->get('r');
                    $du = array(
                        "peserta_ruangan" => $ruangan,
                        "peserta_last_sesi" => $peserta_last_sesi_update
                    );

                    if ($tanggal_sekarang > $peserta_last_sesi_tmp) {


                        $du = array(
                            "peserta_last_sesi" => $peserta_last_sesi_update
                        );

                        $response["success"] = false;
                        $response["response"] = "Sesi login berakhir pada " . $peserta_last_sesi . " , silahkan login kembali";
                    } else {

                        $response["success"] = true;
                        $response["response"] = $userdata;
                    }

                    if (!empty($ruangan) && $ruangan > 0) {
                        $this->db->where(array("peserta_id" => $peserta['peserta_id']));
                        $this->db->update("peserta", $du);
                    }
                }
            } else {

                $users = $this->db->get_where('users', array(
                    'username' => $username,
                    'password' => $password
                ))->row_array();

                if (!empty($users) && $users['level'] == 'pengawas') {

                    $userdata = array();
                    $userdata['uid']    = $users['user_id'];
                    $userdata['nama']       = $users['username'];
                    $userdata['nomor']      = "";
                    $userdata['foto']       = "";
                    $userdata['level']      = "pengawas";

                    $response["success"] = true;
                    $response["response"] = $userdata;
                } else {
                    $response["success"] = false;
                    $response["response"] = "Username atau Password tidak sesuai!";
                }
            }
        }



        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }


    function dashboard_peserta()
    {

        $uid     = $this->input->get('uid');
        $ruangan    = $this->input->get('ruangan');
        $tgl = date('Y-m-d');

        $datetime = new DateTime($tgl);
        $datetime->modify('-1 day');
        $tgl_kemarin = $datetime->format('Y-m-d');

        $response = array();
        $response["response"] = array();

        $peserta = $this->db->get_where('peserta', array("peserta_id" => $uid));


        if ($peserta->num_rows() > 0) {

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
                $item["jumlah_pelajaran"] = $this->_jumlah_pelajaran($kelas_sekarang, $jurusan_id, $ruang);
                $item["jumlah_peserta"] = $this->_jumlah_peserta();
                $item["jumlah_jurusan"] = $this->_jumlah_jurusan();
                $item["jumlah_ujian_today"] = (int)$this->_jumlah_ujian_today($kelas_sekarang, $jurusan_id, $peserta_agama);
                $item["jumlah_pesan"] = $this->_jumlah_pesan("peserta");
                $item["jumlah_peserta_ruangan"] = $this->_jumlah_peserta_ruangan($tgl, $ruangan);

                $item["instansi"] = $this->m->getpengaturan("instansi");
                $item["sesi"] = $this->m->getpengaturan("Sesi");
                $item["tahunajaran"] = $this->tahunajaran;


                $_jumlah_jawab_by_today = $this->_jumlah_jawab_by($uid, $tgl, $ruangan, $kelas_sekarang, $jurusan_id);
                $_jumlah_ujian_by_today = $this->_jumlah_ujian_by($uid, $tgl, $kelas_sekarang, $jurusan_id);

                $overview_today = $_jumlah_jawab_by_today . "/" . $_jumlah_ujian_by_today;

                $overview_today_precent = 0;
                $overview_today_precent_double = 0;
                if ($_jumlah_jawab_by_today > 0 && $_jumlah_ujian_by_today > 0) {
                    $overview_today_precent = round(($_jumlah_jawab_by_today / $_jumlah_ujian_by_today) * 100);
                    $overview_today_precent_double = round($_jumlah_jawab_by_today / $_jumlah_ujian_by_today, 2);
                }

                $item["overview_today"] = array(
                    "persentase" => $overview_today_precent,
                    "persentase_double" => (float) $overview_today_precent_double,
                    "text" => $overview_today
                );


                $_jumlah_jawab_by_tommorrow = $this->_jumlah_jawab_by($uid, $tgl_kemarin, $ruangan, $kelas_sekarang, $jurusan_id);
                $_jumlah_ujian_by_tommorrow = $this->_jumlah_ujian_by($uid, $tgl_kemarin, $kelas_sekarang, $jurusan_id);

                $overview_tommorrow = $_jumlah_jawab_by_tommorrow . "/" . $_jumlah_ujian_by_tommorrow;

                $overview_tommorrow_precent = 0;
                $overview_tommorrow_precent_double = 0;
                if ($_jumlah_jawab_by_tommorrow > 0 && $_jumlah_ujian_by_tommorrow > 0) {
                    $overview_tommorrow_precent =  round(($_jumlah_jawab_by_tommorrow / $_jumlah_ujian_by_tommorrow) * 100);
                    $overview_tommorrow_precent_double = round($_jumlah_jawab_by_tommorrow / $_jumlah_ujian_by_tommorrow, 2);
                }

                $item["overview_tommorrow"] = array(
                    "persentase" => $overview_tommorrow_precent,
                    "persentase_double" => (float) $overview_tommorrow_precent_double,
                    "text" => $overview_tommorrow
                );




                $_jumlah_jawab_by_all = $this->_jumlah_jawab_by($uid, "", $ruangan, $kelas_sekarang, $jurusan_id);
                $_jumlah_ujian_by_all = $this->_jumlah_ujian_by($uid, "", $kelas_sekarang, $jurusan_id);

                $overview_all = $_jumlah_jawab_by_all . "/" . $_jumlah_ujian_by_all;

                $overview_all_precent = 0;
                $overview_all_precent_double = 0;
                if ($_jumlah_jawab_by_all > 0 && $_jumlah_ujian_by_all > 0) {
                    $overview_all_precent =  round(($_jumlah_jawab_by_all / $_jumlah_ujian_by_all) * 100);
                    $overview_all_precent_double = round($_jumlah_jawab_by_all / $_jumlah_ujian_by_all, 2);
                }

                $item["overview_all"] = array(
                    "persentase" => $overview_all_precent,
                    "persentase_double" => (float) $overview_all_precent_double,
                    "text" => $overview_all
                );

                array_push($response["response"], $item);
            }

            $response["success"] = true;
        } else {
            $response["success"] = false;
            $response["response"] = "Tidak ditemukan data";
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }


    function dashboard_pengawas()
    {

        $ruangan    = $this->input->get('ruangan');

        $response = array();
        $response["success"] = true;
        $response["response"] = array();

        $tgl = date('Y-m-d');

        //date('Y-m-d', strtotime($tgl. ' + 1 days'));

        $soal_jawab1 = $this->db->group_by('siswa_id')->get_where('soal_jawab', array(
            "soal_jawab_tahunajaran" => $this->tahunajaran,
            "soal_jawab_tanggal" => $tgl
        ));
        $soal_jawab2 = $this->db->group_by('siswa_id')->get_where('soal_jawab', array(
            "soal_jawab_tahunajaran" => $this->tahunajaran,
            "soal_jawab_tanggal" => $tgl,
            "soal_jawab_ruangan" => $ruangan
        ));
        $ujian = $this->db->group_by("ujian_pelajaran")->get_where('ujian', array(
            "ujian_tahunajaran" => $this->tahunajaran,
            "ujian_tanggal" => $tgl
        ));



        array_push($response["response"], array(
            "peserta_total" => $soal_jawab1->num_rows(),
            "peserta_ruangan" => $soal_jawab2->num_rows(),
            "pelajaran_hariini" => $ujian->num_rows(),
            "jumlah_pesan" => $this->_jumlah_pesan("pengawas"),
            "instansi" => $this->m->getpengaturan("instansi"),
            "sesi" => $this->m->getpengaturan("Sesi"),
            "tahunajaran" => $this->tahunajaran,

        ));

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }


    function cari_peserta()
    {
        $tgl = date('Y-m-d');
        $by = $this->input->get('by');
        $ruangan = $this->input->get('ruangan');

        $response = array();

        $response["success"] = false;
        $response["response"] = array();

        $this->db->select("*")->from('soal_jawab');
        $this->db->join('peserta', 'peserta.peserta_id = soal_jawab.siswa_id');


        $this->db->where('soal_jawab.soal_jawab_last_update >= ', date('Y-m-d H:i:s', strtotime("-2600 second")));

        $this->db->where('soal_jawab.soal_jawab_tahunajaran', $this->tahunajaran);
        $this->db->where('soal_jawab.soal_jawab_ruangan', $ruangan);
        $this->db->where('soal_jawab.soal_jawab_tanggal', $tgl);

        if (!empty($by) && $by != null && $by != "") {
            $this->db->like('peserta.peserta_nama', $by);
        }

        $this->db->order_by('soal_jawab.soal_jawab_last_update', 'desc');
        $this->db->order_by('peserta.peserta_nama', 'asc');
        $this->db->limit(40);


        $users = $this->db->get();
        if ($users->num_rows() > 0) {

            foreach ($users->result_array() as $r2) {

                //$tt2 = date('Y-m-d H:i:s', strtotime($r2['soal_jawab_last_update']));


                $item = array();
                $item['ruangan'] = $ruangan;
                $item['peserta_id'] = $r2['peserta_id'];
                $item['peserta_nis'] = $r2['peserta_nis'];
                $item['peserta_nama'] = $r2['peserta_nama'];
                $peserta_foto = $r2['peserta_foto'];

                $item['peserta_foto'] = $this->config->item('base_url') . '/assets/img/avatar.png';
                if (!empty($peserta_foto) && file_exists(FCPATH . 'assets/profile/' . $peserta_foto)) {
                    $item['peserta_foto'] = $this->config->item('base_url') . '/assets/profile/' . $peserta_foto;
                }

                $item['soal_jawab_id'] = $r2['soal_jawab_id'];
                $item['soal_jawab_mulai'] = $r2['soal_jawab_mulai'];
                $item['soal_jawab_selesai'] = $r2['soal_jawab_selesai'];
                $item['soal_jawab_tanggal'] = $r2['soal_jawab_tanggal'];
                $item['soal_jawab_tanggal_indo'] = $this->m->tanggalhari2($r2['soal_jawab_tanggal'], true);

                $item['soal_jawab_ok'] = $r2['soal_jawab_ok'];
                $item['soal_jawab_none'] = $r2['soal_jawab_none'];

                $item['soal_jawab_terjawab'] = $r2['soal_jawab_ok'];
                $item['soal_jawab_tidakterjawab'] = $r2['soal_jawab_none'];


                $item['soal_jawab_ruangan'] = $r2['soal_jawab_ruangan'];

                $item['soal_jawab_pelajaran'] = $r2['soal_jawab_pelajaran'];
                $item['soal_jawab_kelas'] = $r2['soal_jawab_kelas'];
                $item['soal_jawab_jurusan'] = $r2['soal_jawab_jurusan'];
                $item['soal_jawab_jurusan_ke'] = $r2['soal_jawab_jurusan_ke'];
                $item['soal_jawab_ruangan'] = $r2['soal_jawab_ruangan'];
                $item['soal_jawab_perhatian'] = (int) $r2['soal_jawab_perhatian'];


                $sembunyikan = 0;
                if ($r2['soal_jawab_status'] == "N" && $r2['soal_jawab_selesai'] != "0000-00-00 00:00:00" && strtotime($r2['soal_jawab_selesai']) < strtotime("-900 second")) {
                    $sembunyikan = 1;
                }
                $item['soal_jawab_status'] = $r2['soal_jawab_status'];
                $item['soal_jawab_last_update'] = $r2['soal_jawab_last_update'];



                $sekarang = date('Y-m-d H:i:s');
                $update_terakhir = date('Y-m-d H:i:s', strtotime($r2['soal_jawab_last_update'] . " +1800 second"));
                $update_terakhir_jauh = date('Y-m-d H:i:s', strtotime($r2['soal_jawab_last_update'] . " +3600 second"));


                $item['waktu'] = $this->_time_since($r2['soal_jawab_last_update']);

                $tampil = true;
                if ($sekarang > $update_terakhir) {
                    $tampil = false;
                }

                if ($r2['soal_jawab_status'] == "Y") {
                    $tampil = true;

                    if ($sekarang > $update_terakhir_jauh) {
                        $tampil = false;
                    }
                }

                //if($tampil){
                array_push($response["response"], $item);

                //}


            }


            $response["success"] = true;
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }


    function token()
    {
        $kode = $this->input->get("kode");
        $pengaturanToken = json_decode($this->m->getpengaturan("pengaturanToken"), true);

        $tanggal_sekarang = date('Y-m-d');
        $tanggal_sekarang_pembanding = date('Y-m-d H:i:s');
        $tgl_buka   = date('Y-m-d H:i:s', strtotime($tanggal_sekarang . " " . $pengaturanToken["buka"]));
        $tgl_tutup  = date('Y-m-d H:i:s', strtotime($tanggal_sekarang . " " . $pengaturanToken["tutup"]));
        $data = array();
        $data["success"] = false;
        $data['response'] = '';


        $xtanggal_sekarang = strtotime($tanggal_sekarang_pembanding) * 1000;
        $xtgl_buka = strtotime($tgl_buka) * 1000;
        $xtgl_tutup = strtotime($tgl_tutup) * 1000;

        //jika jam sekarang lebih dari jam x &&
        //jika jam sekarang kurang dari jam y
        if ($xtanggal_sekarang >= $xtgl_buka && $xtanggal_sekarang <= $xtgl_tutup) {

            $ujian_token = $this->db->get_where('ujian_token', array(), 1)->result();
            foreach ($ujian_token as $item) {
                if (!empty($kode) && ($item->ujian_token_text == $kode || $kode == 1)) {
                    $data['response'] = $item->ujian_token_text;
                    $data["success"] = true;
                }
            }
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function versilist()
    {

        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        $this->db->select('*');
        $this->db->from('version');
        $this->db->order_by('version_nomor', 'desc');
        $this->db->limit(5);
        $guru = $this->db->get();

        foreach ($guru->result_array() as $row) {
            $baris['version_id'] = $row['version_id'];
            $baris['version_jenis'] = $row['version_jenis'];
            $baris['version_nama'] = $row['version_nama'];
            $baris['version_nomor']      = $row['version_nomor'];
            $baris['version_nomor_minimal'] = $row['version_nomor_minimal'];
            $baris['version_text'] = $this->_strip($row["version_text"]);
            $baris['version_ukuran'] = $row['version_ukuran'];
            $baris['version_wajib'] = $row['version_wajib'];
            $baris['version_tanggal'] = $row['version_tanggal'];
            $baris['version_hits'] = $row['version_hits'];

            array_push($response["response"], $baris);
        }


        if (count($response["response"]) > 0) {

            $response["success"] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }

    /**
     * @return mixed
     * Ujian
     */


    function ujianlist()
    {
        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        /**
         * Jika isset waktu maka
         */

        if (isset($_GET['waktu'])) {


            $time_server = (int)date('dmYHi');
            $time_client = 0;

            $time_client = (int)$this->input->get('waktu');


            $response["time_client"] = $time_client;
            $response["time_server"] = $time_server;

            //jika time client lebih atau kurang dari 1 menit
            $time_client_lebih = $time_server + 2;
            $time_client_kurang = $time_server - 2;

            if ($time_client == $time_server || $time_client == $time_client_lebih || $time_client == $time_client_kurang) {

                $response = $this->_ujianlist($response);
            } else {
                $response["response"] = "Tanggal server tidak sama\nsilahkan sesuaikan tanggal dan jam\ndi perangkatmu dengan jam server cbt\n" . date('d-m-Y H:i');
            }
        } else {

            $response = $this->_ujianlist($response);
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    function _ujianlist($response)
    {
        $tgl = date('Y-m-d');
        $uid = $this->input->get('uid');
        $by = $this->input->get('by');



        $users = $this->db->get_where('peserta', array("peserta_id" => $uid));


        if ($users->num_rows() > 0) {

            foreach ($users->result_array() as $r2) {

                $peserta_id = $r2['peserta_id'];
                $peserta_kelas = $r2['peserta_kelas'];
                $peserta_jurusan = $r2['peserta_jurusan'];
                $peserta_jurusan_ke = $r2['peserta_jurusan_ke'];
                $peserta_agama = ucfirst($r2['peserta_agama']);

                if ($by == "usai") {

                    $ujian = $this->db->select('soal_jawab.*,ujian.*')->from('soal_jawab');
                    $ujian = $ujian->join("ujian", "ujian.ujian_id = soal_jawab.ujian_id");
                    $ujian = $ujian->where('soal_jawab.siswa_id=' . $peserta_id);

                    $ujian = $ujian->where('soal_jawab.soal_jawab_tahunajaran=', $this->tahunajaran);
                    $ujian = $ujian->where('ujian.ujian_tahunajaran=', $this->tahunajaran);


                    $ujian = $ujian->where('(ujian.ujian_kelas=\'\' OR ujian.ujian_kelas=\'' . $peserta_kelas . '\')');
                    //$ujian = $ujian->where('(soal_jawab.soal_jawab_kelas=\'\' OR soal_jawab.soal_jawab_kelas=\''.$peserta_kelas.'\')');
                    //$ujian = $ujian->where('(soal_jawab.soal_jawab_jurusan=\'\' OR soal_jawab.soal_jawab_jurusan=\''.$peserta_jurusan.'\')');
                    //$ujian = $ujian->where('(soal_jawab.soal_jawab_jurusan_ke=\'\' OR soal_jawab.soal_jawab_jurusan_ke=\''.$peserta_jurusan_ke.'\')');

                    $ujian = $ujian->order_by('soal_jawab.soal_jawab_tanggal', "DESC");
                    $ujian = $ujian->order_by('soal_jawab.soal_jawab_mulai', "DESC");

                    $ujian = $ujian->get();
                    foreach ($ujian->result_array() as $row1) {

                        $ujian_tanggal = $row1['soal_jawab_tanggal'];


                        $data_ujian['ujian_id'] = $row1['ujian_id'];
                        $data_ujian['ujian_tanggal'] = $ujian_tanggal;
                        $data_ujian['ujian_tanggal_indo'] = $this->m->tanggalhari2($row1['soal_jawab_tanggal'], true);
                        $data_ujian['ujian_mulai'] = date("H:i:s", strtotime($row1['soal_jawab_mulai']));
                        $data_ujian['ujian_selesai'] = date("H:i:s", strtotime($row1['soal_jawab_selesai']));

                        //$waktu = (int) $row1['ujian_waktu'];
                        //$data_ujian[ 'ujian_akhir' ] = date('Y-m-d H:i:s',strtotime('+'.$waktu.' minutes',strtotime($row1['ujian_mulai'])));

                        $data_ujian['ujian_waktu'] = $row1['soal_jawab_waktu'];
                        $data_ujian['ujian_jenis'] = $row1['ujian_jenis'];
                        $data_ujian['ujian_tampil'] = ""; //$row1['ujian_tampil'];
                        $data_ujian['ujian_jumlah_soal'] = $row1['ujian_jumlah_soal'];

                        $data_ujian['ujian_untuk'] = $row1['ujian_untuk'];
                        $data_ujian['ujian_guru'] = $row1['ujian_guru'];
                        $data_ujian['ujian_pelajaran'] = $row1['soal_jawab_pelajaran'];


                        $tanggal_sekarang = date('Y-m-d H:i:s');
                        $ujian_mulai = date("Y-m-d H:i:s", strtotime($row1['soal_jawab_mulai']));
                        $ujian_terlambat = date("Y-m-d H:i:s", strtotime('+' . $row1['soal_jawab_waktu'] . ' minutes', strtotime($row1['soal_jawab_mulai'])));

                        $status = 2;
                        if ($tanggal_sekarang < $ujian_mulai) {
                            $status = 0;
                        } elseif ($tanggal_sekarang >= $ujian_mulai and $tanggal_sekarang <= $ujian_terlambat) {
                            $status = 1;
                        }


                        if ($row1['soal_jawab_status'] == "N") {
                            $status = "N";
                        }


                        $data_ujian['ujian_status'] = $status;

                        array_push($response["response"], $data_ujian);
                        $response["success"] = true;
                    }
                } else {

                    $ujian = $this->db->select('*')->from('ujian');

                    //$ujian = $ujian->like('(ujian.ujian_jurusan=\'\' OR ujian.ujian_jurusan=\''.$peserta_jurusan.'\')');
                    //$ujian = $ujian->where('(ujian.ujian_jurusan_ke=\'\' OR ujian.ujian_jurusan_ke=\''.$peserta_jurusan_ke.'\')');
                    //$ujian = $ujian->where('(ujian.ujian_agama=\'\' OR ujian.ujian_agama=\''.$peserta_agama.'\')');


                    if ($by == "besok") {
                        $tgl = date('Y-m-d', strtotime($tgl . ' + 1 days'));
                        $ujian = $ujian->where('ujian.ujian_tanggal', $tgl);
                    } else {
                        $ujian = $ujian->where('ujian.ujian_tanggal', $tgl);
                    }

                    $ujian = $ujian->where('ujian_tahunajaran', $this->tahunajaran);

                    $ujian = $ujian->where('(ujian.ujian_kelas=\'\' OR ujian.ujian_kelas=\'' . $peserta_kelas . '\')');
                    //$ujian = $ujian->where('ujian.ujian_jurusan',"")->or_where('ujian.ujian_jurusan LIKE \'%'.$peserta_jurusan.'%\'');
                    //$ujian = $ujian->where('ujian.ujian_agama',"")->or_where('ujian.ujian_agama LIKE \'%'.$peserta_agama.'%\'');

                    $ujian = $ujian->order_by('ujian_tanggal_update', 'DESC');
                    $ujian = $ujian->order_by('ujian_mulai', "ASC");

                    $ujian = $ujian->get();
                    foreach ($ujian->result_array() as $row1) {

                        $ujian_jurusan = explode(",", $row1['ujian_jurusan']);
                        $ujian_agama = explode(",", $row1['ujian_agama']);

                        $a = 0;
                        $b = 0;
                        if (empty($row1['ujian_jurusan']) || (count($ujian_jurusan) > 0 && in_array($peserta_jurusan, $ujian_jurusan))) {
                            $a++;
                        }

                        if (empty($row1['ujian_agama']) || (count($ujian_agama) > 0 && in_array($peserta_agama, $ujian_agama))) {
                            $b++;
                        }

                        if ($a == 1 && $b == 1) {
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
                            $data_ujian['ujian_tampil'] = ""; //$row1['ujian_tampil'];
                            $data_ujian['ujian_jumlah_soal'] = $row1['ujian_jumlah_soal'];
                            $data_ujian['ujian_agama'] = $row1['ujian_agama'];

                            $data_ujian['ujian_untuk'] = $row1['ujian_untuk'];
                            $data_ujian['ujian_guru'] = $row1['ujian_guru'];
                            $data_ujian['ujian_pelajaran'] = $row1['ujian_pelajaran'];
                            //$data_ujian[ 'ujian_jurusan' ] = $row1['ujian_jurusan'];


                            //$soal_jawab = $this->db->get_where('soal_jawab',array('ujian_id'=>$row1['ujian_id'],'peserta_id'=>$peserta_id))->result();
                            //$data_ujian['status'] = empty($soal_jawab[0]->status) ? null : $soal_jawab[0]->status;

                            $soal_jawab = $this->db->get_where('soal_jawab', array(
                                'soal_jawab_tahunajaran' => $this->tahunajaran,
                                'ujian_id' => $row1['ujian_id'],
                                'siswa_id' => $peserta_id
                            ))->result();


                            //$tanggal_sekarang = new DateTime();
                            //$tanggal_sekarang_ujian_mulai = new DateTime($ujian_tanggal . " " . $data_ujian['ujian_mulai']);
                            //$tanggal_sekarang_ujian_terlambat = new DateTime($ujian_tanggal . " " . $data_ujian['ujian_selesai']);


                            $tanggal_sekarang = date('Y-m-d H:i:s');
                            $ujian_mulai = date("Y-m-d H:i:s", strtotime($ujian_tanggal . " " . $row1['ujian_mulai']));
                            $ujian_terlambat = date("Y-m-d H:i:s", strtotime('+' . $row1['ujian_waktu'] . ' minutes', strtotime($ujian_tanggal . " " . $row1['ujian_mulai'])));


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
        } else {
            $response["response"] = "Tidak ditemukan data, data ujian tidak tersedia";
        }


        return $response;
    }


    function ujianget()
    {
        $response = array();
        $response["response"] = array();

        $uid     = $this->input->get('uid');
        $ujianid = $this->input->get('ujianid');
        $ruangan = $this->input->get('ruangan');


        $date = date('Y-m-d H:i:s');
        $waktu_minimal  = $this->m->getpengaturan("Waktu Minimal");

        $peserta = $this->db->get_where('peserta', array("peserta_id" => $uid));
        if ($peserta->num_rows() > 0) {

            try {


                foreach ($peserta->result_array() as $r2) {

                    $peserta_id          = $r2['peserta_id'];
                    $kelas_sekarang      = $r2['peserta_kelas'];
                    $jurusan_id          = $r2['peserta_jurusan'];
                    $ruang              = $r2['peserta_jurusan_ke'];
                    $peserta_agama      = $r2['peserta_agama'];
                    $bisamulai          = 0;


                    //MULAI GET UJIAN
                    $q1 = $this->db->get_where('ujian', array(
                        'ujian_id' => $ujianid,
                        'ujian_tahunajaran' => $this->tahunajaran
                    ));

                    if ($q1->num_rows() > 0) {
                        $ujian = $q1->result();

                        $this->session->set_userdata(array(
                            'ujian_id' => $ujianid,
                            //'ujian_tampil'=>$ujian[0]->ujian_tampil,
                        ));

                        //cek soal_jawab jika ada get jika tidak insert

                        $ujian_ikut = $this->db->select('*')->from('soal_jawab');
                        $ujian_ikut = $ujian_ikut->where(array(
                            'ujian_id' => $ujianid,
                            'siswa_id' => $peserta_id,
                            'soal_jawab_tahunajaran' => $this->tahunajaran,
                            'soal_jawab_pelajaran' => $ujian[0]->ujian_pelajaran
                        ));

                        $ujian_ikut = $ujian_ikut->get();


                        $soaljawab_id = 0;
                        //cek ujian jika tidak ada insert
                        if ($ujian_ikut->num_rows() < 1) {

                            $soal = $this->db->select('*')->from('soal')->where(array(
                                'soal_tahunajaran' => $this->tahunajaran,
                                'soal_kelas' => $ujian[0]->ujian_kelas,
                                'soal_guru' => $ujian[0]->ujian_guru,
                                'soal_pelajaran' => $ujian[0]->ujian_pelajaran,
                                'soal_untuk' => $ujian[0]->ujian_untuk
                            ));

                            if ($ujian[0]->ujian_jenis == "Acak") {
                                $soal = $soal->order_by('soal_id', 'RANDOM');
                            } else {
                                $soal = $soal->order_by('soal_id', 'ASC');
                            }

                            if ($ujian[0]->ujian_jumlah_soal > 0) {
                                $soal = $soal->limit($ujian[0]->ujian_jumlah_soal);
                            }

                            $soal = $soal->get();


                            $list_soal_array = array();
                            $list_opsi_array = array();

                            foreach ($soal->result_array() as $item) {
                                $_id = $item['soal_id'];
                                $_jenis = $item['soal_jenis'];

                                $option = array();
                                if ($_jenis == "optional") {
                                    $option = array();
                                } elseif ($_jenis == "checked") {
                                    $option = array();
                                } elseif ($_jenis == "essay") {
                                    $option = array();
                                } elseif ($_jenis == "essayText") {
                                    $option = array();
                                } elseif ($_jenis == "essayNumber") {
                                    $option = array();
                                } elseif ($_jenis == "sort") {
                                    $option = array();
                                } elseif ($_jenis == "match") {
                                    $option = array();
                                } elseif ($_jenis == "boolean") {
                                    $option = array();
                                }


                                array_push($list_soal_array, $_id);
                                array_push($list_opsi_array, array($_id, $_jenis, 'N', $option));

                                /*
                                array_push( $list_opsi_array, array(
                                    'nomor' => $_id, 
                                    'jenis' => $_jenis,
                                    'ragu' => 'N', 
                                    'jawaban' => $option
                                ));*/

                                $bisamulai++;
                            }

                            $waktu = $ujian[0]->ujian_waktu;
                            $lama_min = date('Y-m-d H:i:s', strtotime("+$waktu_minimal minutes", strtotime(date($date))));
                            $lama_selesai = date('Y-m-d H:i:s', strtotime("+$waktu minutes", strtotime(date($date))));
                            $d = array(

                                'soal_jawab_tahunajaran' => $this->tahunajaran,

                                'soal_jawab_list' => json_encode($list_soal_array),
                                'soal_jawab_list_opsi' => json_encode($list_opsi_array),

                                'ujian_id'  => $ujianid,
                                'siswa_id'  => $peserta_id,
                                'user_id'   => $uid,
                                'soal_jawab_pelajaran' => $ujian[0]->ujian_pelajaran,
                                'soal_jawab_ruangan'  => $ruangan,

                                'soal_jawab_tanggal' => $date,
                                'soal_jawab_mulai' => $date,
                                'soal_jawab_selesai' => $lama_selesai,
                                'soal_jawab_waktu' => $waktu,
                                'soal_jawab_waktu_minimal' => $lama_min,

                                'soal_jawab_jumlah_soal ' => $ujian[0]->ujian_jumlah_soal,

                                'soal_jawab_kelas' => $kelas_sekarang,
                                'soal_jawab_jurusan' => $jurusan_id,
                                'soal_jawab_jurusan_ke' => $ruang,
                                'soal_jawab_status' => 'Y'
                            );


                            //$soaljawab_id = $d;
                            if ($bisamulai > 0) {

                                $this->db->insert('soal_jawab', $d);
                                $soaljawab_id = $this->db->insert_id();
                            }

                            //jika ada tampil
                        } else {
                            $soaljawab = $ujian_ikut->result();

                            $bisamulai++;
                            $soaljawab_id = $soaljawab[0]->soal_jawab_id;
                        }



                        //ini respon tampil data soal

                        $soal_jawab = $this->db->get_where('soal_jawab', array(
                            'soal_jawab_tahunajaran' => $this->tahunajaran,
                            'soal_jawab_id' => $soaljawab_id
                        ))->result();


                        $response["success"] = true;
                        $response["response"] = array(
                            "jawabid" => $soaljawab_id,
                            "waktu_mulai" => $soal_jawab[0]->soal_jawab_mulai,
                            "waktu_selesai" => $soal_jawab[0]->soal_jawab_selesai,
                            "waktu_minimal" => $soal_jawab[0]->soal_jawab_waktu_minimal,
                        );
                    } else {
                        $response["success"] = false;
                        $response["response"] = "Tidak ditemukan data";
                    }
                }
            } catch (Exception $exception) {

                $response["success"] = false;
                $response["response"] = "Gagal memproses data, error: " . $exception;
            }
        } else {
            $response["success"] = false;
            $response["response"] = "Tidak ditemukan data";
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }

    function ujianmulai()
    {


        $response = array();
        $response["success"] = false;
        $response["response"] = array();
        $response["response_list_opsi"] = array();

        $id     = $this->input->get('id');

        $soal_jawab = $this->db->get_where('soal_jawab', array(
            'soal_jawab_tahunajaran' => $this->tahunajaran,
            'soal_jawab_id' => $id
        ))->result();

        if (count($soal_jawab) > 0) {

            $soal_jawab_list_opsi = json_decode($soal_jawab[0]->soal_jawab_list_opsi);
            $urut_soal = json_decode($soal_jawab[0]->soal_jawab_list);


            $urutan = 1;
            foreach ($urut_soal as $item_urut_soal) {
                $ambil_soal = $this->db->get_where('soal', array(
                    'soal_tahunajaran' => $this->tahunajaran,
                    'soal_id' => $item_urut_soal
                ))->result_array();
                foreach ($ambil_soal as $row1) {

                    $ambil_soal_parent = $this->db->get_where('soal_parent', array(
                        'soal_parent_tahunajaran' => $this->tahunajaran,
                        'soal_parent_id' => $row1["soal_parent_id"]
                    ))->result_array();

                    $soal_text_parent = "<div id='soal_parent'>";
                    foreach ($ambil_soal_parent as $row2) {
                        $soal_text_parent .= $row2["soal_parent_text"];
                    }

                    $soal_text_parent .= "</div>";

                    $jenis = $row1["soal_jenis"];

                    $item = array();
                    $item["soal_urutan"] = $urutan;
                    $item["soal_id"] = $row1["soal_id"];
                    $item["soal_jenis"] = $jenis;
                    //$item["soal_text"] = $this->_philsXMLClean( $this->_strip($row1["soal_text"]) );
                    $item["soal_text"] = $this->_strip($row1["soal_text"]);

                    //$item["soal_text"] = $this->_philsXMLClean( $row1["soal_text"] );
                    //$item["soal_text"] = mb_convert_encoding($row1["soal_text"], 'HTML-ENTITIES', 'UTF-8');
                    //$item["soal_text_deskripsi"] =$this->_philsXMLClean( $row1["soal_text_deskripsi"] );

                    $item["soal_text_parent"] = $this->_philsXMLClean($this->_strip($soal_text_parent));
                    $item["soal_text_deskripsi"] = $this->_philsXMLClean($this->_strip($row1["soal_text_deskripsi"]));
                    $item["soal_text_jawab"] = array();
                    $item["soal_date"] = $row1["soal_date"];
                    $item["soal_date_update"] = $row1["soal_date_update"];

                    $soal_text_jawab = $row1["soal_text_jawab"];



                    if ($jenis == "optional") {
                        $soal_text_jawab = json_decode($soal_text_jawab);


                        for ($i = 0; $i < count((array)$soal_text_jawab); $i++) {
                            $text1 = $soal_text_jawab[$i][0];
                            $text2 = $soal_text_jawab[$i][1];

                            if (!empty($text2)) {

                                array_push($item["soal_text_jawab"], array(
                                    "jawab" => (int) $text1,
                                    "jawab_text" => $text2
                                ));
                            }
                        }
                    } elseif ($jenis == "checked") {
                        $soal_text_jawab = json_decode($soal_text_jawab);


                        for ($i = 0; $i < count((array)$soal_text_jawab); $i++) {
                            $text1 = $soal_text_jawab[$i][0];
                            $text2 = $soal_text_jawab[$i][1];

                            if (!empty($text2)) {

                                array_push($item["soal_text_jawab"], array(
                                    "jawab" => (int) $text1,
                                    "jawab_text" => $text2
                                ));
                            }
                        }
                    } elseif ($jenis == "essay") {

                        array_push($item["soal_text_jawab"], $soal_text_jawab);
                    } elseif ($jenis == "essayText") {

                        array_push($item["soal_text_jawab"], $soal_text_jawab);
                    } elseif ($jenis == "essayNumber") {

                        array_push($item["soal_text_jawab"], $soal_text_jawab);
                    } elseif ($jenis == "boolean") {

                        array_push($item["soal_text_jawab"], $soal_text_jawab);
                    } elseif ($jenis == "sort") {

                        $soal_text_jawab = json_decode($soal_text_jawab);

                        for ($i = 0; $i < count((array)$soal_text_jawab); $i++) {
                            $text1 = $soal_text_jawab[$i];


                            array_push($item["soal_text_jawab"], $text1);
                        }

                        shuffle($item["soal_text_jawab"]);
                    } elseif ($jenis == "match") {


                        $soal_text_jawab = json_decode( $soal_text_jawab);

                        $text1 = array();
                        $text2 = array();
                        for ($i = 0; $i < count((array)$soal_text_jawab); $i++) {
                            $text = explode("#", $soal_text_jawab[$i]);

                            array_push($text1, $text[0] ?? "");

                            array_push($text2, $text[1] ?? "");
                        }

                        
                        shuffle($text2);
                        for ($i = 0; $i < count((array)$text1); $i++) {
                            
                            array_push($item["soal_text_jawab"], array(
                                $text1[$i],
                                $text2[$i]
                            ));

                        }



                    } else {
                        //
                    }
                    array_push($response["response"], $item);
                    $urutan++;
                }
            }



            $response["success"] = true;
            $response["response_list_opsi"] = $soal_jawab_list_opsi;
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }


    function ujianselesai()
    {
        $this->ujiansave("N");
    }

    function ujiansave($status = "Y")
    {

        $response = array();
        $response["success"] = false;
        $response["response"] = array();
        $id     = $this->input->get('id');
        $data   = $this->input->post('data');
        $data2  = json_decode($data);



        $this->db->where(array(
            'soal_jawab_tahunajaran' => $this->tahunajaran,
            'soal_jawab_id'   => $id
        ));

        $this->db->update('soal_jawab', array(
            'soal_jawab_list_opsi' => $data
        ));


        $update_ = array();

        $jumlah_soal = 0;
        $jumlah_benar = 0;
        $jumlah_salah = 0;
        $jumlah_terjawab = 0;
        $jumlah_tidakterjawab = 0;
        $nilai = 0;


        $response["response1"] = array();
        foreach ((array)$data2 as $soal_jawab_list_opsi_item) {
            array_push($response["response1"], $soal_jawab_list_opsi_item);


            $id_soal = $soal_jawab_list_opsi_item[0];
            $jenis = $soal_jawab_list_opsi_item[1];
            $ragu = $soal_jawab_list_opsi_item[2];
            $jawaban    = $soal_jawab_list_opsi_item[3];


            array_push($update_, array($id_soal, $jenis, $ragu, $jawaban));

            if ($jenis == "optional") {

                /*
                Samakan jawaban pengguna dengan jawaban soal server yang bernilai 1|benar
                */

                if (is_array($jawaban) && $jawaban != null) {
                    //cari jawaban pada soal dengan $id_soal
                    $ambil_soal = $this->db->get_where('soal', array(
                        'soal_tahunajaran' => $this->tahunajaran,
                        'soal_id' => $id_soal
                    ))->result();

                    foreach ($ambil_soal as $soal) {
                        $soal_text_jawab = json_decode($soal->soal_text_jawab);


                        //samakan jawaban peserta dengan jawaban soal

                        if ($soal_text_jawab[$jawaban[0]][0] == 1) {
                            $jumlah_benar++;
                        }

                        /*
                        $nomor_jawaban = 0;
                        foreach ($soal_text_jawab as $soal_text_jawab_item) {

                            if ($soal_text_jawab_item[0] == 1 && $jawaban[0] == $nomor_jawaban) {
                                $jumlah_benar++;
                            }

                            $nomor_jawaban++;
                        }*/
                    }

                    $jumlah_terjawab++;
                }
            } elseif ($jenis == "checked") {


                /*
                Samakan beberapa jawaban pengguna dengan jawaban soal server yang bernilai sama 1=1, 2=2
                Lalu jumlah berdasarkan nilai yang di dapat misal
                jawab multi opsi 0 dan 3 yang mana masing masing memiliki nilai 1,4 = 5

                yang berarti 1 soal bisa bernilai total 1,2,3,4 = 10 tidak menjawab 0
                */

                if (is_array($jawaban) && $jawaban != null) {
                    //cari jawaban pada soal dengan $id_soal
                    $ambil_soal = $this->db->get_where('soal', array(
                        'soal_tahunajaran' => $this->tahunajaran,
                        'soal_id' => $id_soal
                    ))->result();

                    foreach ($ambil_soal as $soal) {
                        $soal_text_jawab = json_decode($soal->soal_text_jawab);

                        foreach ($jawaban as $key1) {
                            if ($soal_text_jawab[$key1][0] == 1) {
                                $jumlah_benar++;
                            }
                        }
                    }

                    $jumlah_terjawab++;
                }
            } elseif ($jenis == "essay") {

                /*
                Samakan jawaban pengguna dengan jawaban soal server 
                */

                if (is_array($jawaban) && $jawaban != null) {
                    //hitung semua yang terjawab
                    $jumlah_terjawab++;
                }
            } elseif ($jenis == "essayText") {

                /*
                Samakan jawaban pengguna dengan jawaban soal server text short
                */

                if (is_array($jawaban) && $jawaban != null) {
                    //cari jawaban pada soal dengan $id_soal
                    $ambil_soal = $this->db->get_where('soal', array(
                        'soal_tahunajaran' => $this->tahunajaran,
                        'soal_id' => $id_soal
                    ))->result();

                    foreach ($ambil_soal as $soal) {
                        $soal_text_jawabs = explode(" ", $soal->soal_text_jawab);
                        $jawaban = explode(" ", $jawaban[0]);

                        foreach ($soal_text_jawabs as $soal_text_jawab) {

                            if (in_array($soal_text_jawab, $jawaban)) {
                                $jumlah_benar++;
                            }
                        }
                    }

                    $jumlah_terjawab++;
                }
            } elseif ($jenis == "essayNumber") {

                /*
                Samakan jawaban pengguna dengan jawaban soal server number
                */

                if (is_array($jawaban) && $jawaban != null) {
                    //cari jawaban pada soal dengan $id_soal
                    $ambil_soal = $this->db->get_where('soal', array(
                        'soal_tahunajaran' => $this->tahunajaran,
                        'soal_id' => $id_soal
                    ))->result();

                    foreach ($ambil_soal as $soal) {
                        $soal_text_jawab = $soal->soal_text_jawab;

                        if ($soal_text_jawab == $jawaban[0]) {
                            $jumlah_benar++;
                        }
                    }

                    $jumlah_terjawab++;
                }
            } elseif ($jenis == "boolean") {

                /*
                Samakan jawaban 0/1 pengguna dengan jawaban soal server
                */

                if (is_array($jawaban) && $jawaban != null) {
                    //cari jawaban pada soal dengan $id_soal
                    $ambil_soal = $this->db->get_where('soal', array(
                        'soal_tahunajaran' => $this->tahunajaran,
                        'soal_id' => $id_soal
                    ))->result();

                    foreach ($ambil_soal as $soal) {
                        $soal_text_jawab = $soal->soal_text_jawab;

                        if ($soal_text_jawab == $jawaban[0]) {
                            $jumlah_benar++;
                        }
                    }

                    $jumlah_terjawab++;
                }
            } elseif ($jenis == "sort") {

                /*
                Samakan urutan jawaban pengguna dengan jawaban soal
                */

                if (is_array($jawaban) && $jawaban != null) {
                    //cari jawaban pada soal dengan $id_soal
                    $ambil_soal = $this->db->get_where('soal', array(
                        'soal_tahunajaran' => $this->tahunajaran,
                        'soal_id' => $id_soal
                    ))->result();

                    foreach ($ambil_soal as $soal) {
                        $soal_text_jawab = json_decode($soal->soal_text_jawab);

                        foreach ($soal_text_jawab as $key1 => $value1) {

                            if ($jawaban[$key1] == $value1) {
                                $jumlah_benar++;
                            }
                        }
                    }

                    $jumlah_terjawab++;
                }
            } elseif ($jenis == "match") {

                if (is_array($jawaban) && $jawaban != null) {


                    $ambil_soal = $this->db->get_where('soal', array(
                        'soal_tahunajaran' => $this->tahunajaran,
                        'soal_id' => $id_soal
                    ))->result();

                    foreach ($ambil_soal as $soal) {
                        //["Katak#Amfibi","Buaya#Reptil","Burung#Herbivora","Kera#Mamalia"]
                        $soal_text_jawab = json_decode($soal->soal_text_jawab);

                        foreach ($soal_text_jawab as $key1 => $value1) {

                            //["Herbivora","","","Reptil"]
                            $exp = explode('#', $value1);
                            if ($jawaban[$key1] == $exp[1]) {
                                $jumlah_benar++;
                            }
                        }
                    }

                    $jumlah_terjawab++;
                }
            }

            $jumlah_soal++;
        }

        $jumlah_tidakterjawab = $jumlah_soal - $jumlah_terjawab;
        $jumlah_salah = $jumlah_soal - $jumlah_benar;


        if ($jumlah_soal == 50) {
            $nilai = $jumlah_benar * 2;
        } elseif ($jumlah_soal == 40) {
            $nilai = ($jumlah_benar * 25) / 10;
        }


        $nilai = round($nilai, 2);
        $nilai_bulat = round($nilai);


        //simpan dulu data peserta


        $dd = array();
        $dd['soal_jawab_last_update']    = date('Y-m-d H:i:s');
        $dd['soal_jawab_benar']  = $jumlah_benar;
        $dd['soal_jawab_salah']  = $jumlah_salah;
        $dd['soal_jawab_ok']     = $jumlah_terjawab;
        $dd['soal_jawab_none']   = $jumlah_tidakterjawab;
        $dd['soal_jawab_nilai']  = $nilai;

        if ($status  == "N") {

            $dd['soal_jawab_status']    = 'N';
        } //else{
        //$dd['soal_jawab_list_opsi'] = json_encode($update_);  
        //}


        $this->db->where(array(
            'soal_jawab_tahunajaran' => $this->tahunajaran,
            'soal_jawab_id'   => $id
        ));

        $this->db->update('soal_jawab', $dd);

        $response["success"] = true;


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }


    function ujianperhatian()
    {
        $perhatian = 0;

        $response = array();
        $response["success"] = false;
        $response["response"] = array();
        $id     = $this->input->get('id');



        $ss = $this->db->get_where('soal_jawab', array("soal_jawab_id" => $id));
        foreach ($ss->result_array() as $r2) {
            $perhatian = (int) $r2['soal_jawab_perhatian'];
            $perhatian++;
        }


        $dd = array();
        $dd['soal_jawab_last_update'] = date('Y-m-d H:i:s');
        $dd['soal_jawab_perhatian'] = $perhatian;


        $this->db->where(array(
            'soal_jawab_tahunajaran' => $this->tahunajaran,
            'soal_jawab_id'   => $id
        ));

        $this->db->update('soal_jawab', $dd);

        $response["success"] = true;


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    function ujiankoreksi()
    {

        $response = array();
        $response["success"] = false;
        $response["response"] = array();
        $id     = $this->input->get('id');



        $data1 = $this->db->get_where('soal_jawab', array('soal_jawab_id' => $id))->result();


        $update_ = array();

        $jumlah_soal = 0;
        $jumlah_benar = 0;
        $jumlah_salah = 0;
        $jumlah_terjawab = 0;
        $jumlah_tidakterjawab = 0;
        $nilai = 0;


        $response["response1"] = array();

        foreach ($data1 as $rr) {
            $data2 = json_decode($rr->soal_jawab_list_opsi);

            foreach ($data2 as $soal_jawab_list_opsi_item) {
                array_push($response["response1"], $soal_jawab_list_opsi_item);


                $id_soal = $soal_jawab_list_opsi_item[0];
                $jenis = $soal_jawab_list_opsi_item[1];
                $ragu = $soal_jawab_list_opsi_item[2];
                $jawaban    = $soal_jawab_list_opsi_item[3];


                array_push($update_, array($id_soal, $jenis, $ragu, $jawaban));

                if ($jenis == "optional") {

                    /*
                    Samakan jawaban pengguna dengan jawaban soal server yang bernilai 1|benar
                    */

                    if (is_array($jawaban) && $jawaban != null) {
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array(
                            'soal_tahunajaran' => $this->tahunajaran,
                            'soal_id' => $id_soal
                        ))->result();

                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = json_decode($soal->soal_text_jawab);


                            //samakan jawaban peserta dengan jawaban soal

                            if ($soal_text_jawab[$jawaban[0]][0] == 1) {
                                $jumlah_benar++;
                            }

                            /*
                            $nomor_jawaban = 0;
                            foreach ($soal_text_jawab as $soal_text_jawab_item) {
    
                                if ($soal_text_jawab_item[0] == 1 && $jawaban[0] == $nomor_jawaban) {
                                    $jumlah_benar++;
                                }
    
                                $nomor_jawaban++;
                            }*/
                        }

                        $jumlah_terjawab++;
                    }
                } elseif ($jenis == "checked") {


                    /*
                    Samakan beberapa jawaban pengguna dengan jawaban soal server yang bernilai sama 1=1, 2=2
                    Lalu jumlah berdasarkan nilai yang di dapat misal
                    jawab multi opsi 0 dan 3 yang mana masing masing memiliki nilai 1,4 = 5
    
                    yang berarti 1 soal bisa bernilai total 1,2,3,4 = 10 tidak menjawab 0
                    */

                    if (is_array($jawaban) && $jawaban != null) {
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array(
                            'soal_tahunajaran' => $this->tahunajaran,
                            'soal_id' => $id_soal
                        ))->result();

                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = json_decode($soal->soal_text_jawab);

                            foreach ($jawaban as $key1) {
                                if ($soal_text_jawab[$key1][0] == 1) {
                                    $jumlah_benar++;
                                }
                            }
                        }

                        $jumlah_terjawab++;
                    }
                } elseif ($jenis == "essay") {

                    /*
                    Samakan jawaban pengguna dengan jawaban soal server 
                    */

                    if (is_array($jawaban) && $jawaban != null) {
                        //hitung semua yang terjawab
                        $jumlah_terjawab++;
                    }
                } elseif ($jenis == "essayText") {

                    /*
                    Samakan jawaban pengguna dengan jawaban soal server text short
                    */

                    if (is_array($jawaban) && $jawaban != null) {
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array(
                            'soal_tahunajaran' => $this->tahunajaran,
                            'soal_id' => $id_soal
                        ))->result();

                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawabs = explode(" ", $soal->soal_text_jawab);
                            $jawaban = explode(" ", $jawaban[0]);

                            foreach ($soal_text_jawabs as $soal_text_jawab) {

                                if (in_array($soal_text_jawab, $jawaban)) {
                                    $jumlah_benar++;
                                }
                            }
                        }

                        $jumlah_terjawab++;
                    }
                } elseif ($jenis == "essayNumber") {

                    /*
                    Samakan jawaban pengguna dengan jawaban soal server number
                    */

                    if (is_array($jawaban) && $jawaban != null) {
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array(
                            'soal_tahunajaran' => $this->tahunajaran,
                            'soal_id' => $id_soal
                        ))->result();

                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = $soal->soal_text_jawab;

                            if ($soal_text_jawab == $jawaban[0]) {
                                $jumlah_benar++;
                            }
                        }

                        $jumlah_terjawab++;
                    }
                } elseif ($jenis == "boolean") {

                    /*
                    Samakan jawaban 0/1 pengguna dengan jawaban soal server
                    */

                    if (is_array($jawaban) && $jawaban != null) {
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array(
                            'soal_tahunajaran' => $this->tahunajaran,
                            'soal_id' => $id_soal
                        ))->result();

                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = $soal->soal_text_jawab;

                            if ($soal_text_jawab == $jawaban[0]) {
                                $jumlah_benar++;
                            }
                        }

                        $jumlah_terjawab++;
                    }
                } elseif ($jenis == "sort") {

                    /*
                    Samakan urutan jawaban pengguna dengan jawaban soal
                    */

                    if (is_array($jawaban) && $jawaban != null) {
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array(
                            'soal_tahunajaran' => $this->tahunajaran,
                            'soal_id' => $id_soal
                        ))->result();

                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = json_decode($soal->soal_text_jawab);

                            foreach ($soal_text_jawab as $key1 => $value1) {

                                if ($jawaban[$key1] == $value1) {
                                    $jumlah_benar++;
                                }
                            }
                        }

                        $jumlah_terjawab++;
                    }
                } elseif ($jenis == "match") {

                    if (is_array($jawaban) && $jawaban != null) {

                        $ambil_soal = $this->db->get_where('soal', array(
                            'soal_tahunajaran' => $this->tahunajaran,
                            'soal_id' => $id_soal
                        ))->result();

                        foreach ($ambil_soal as $soal) {
                            //["Katak#Amfibi","Buaya#Reptil","Burung#Herbivora","Kera#Mamalia"]
                            $soal_text_jawab = json_decode($soal->soal_text_jawab);

                            foreach ($soal_text_jawab as $key1 => $value1) {

                                //["Herbivora","","","Reptil"]
                                $exp = explode('#', $value1);
                                if ($jawaban[$key1] == $exp[1]) {
                                    $jumlah_benar++;
                                }
                            }
                        }

                        $jumlah_terjawab++;
                    }
                }

                $jumlah_soal++;
            }
        }

        $jumlah_tidakterjawab = $jumlah_soal - $jumlah_terjawab;
        $jumlah_salah = $jumlah_soal - $jumlah_benar;


        if ($jumlah_soal == 50) {
            $nilai = $jumlah_benar * 2;
        } elseif ($jumlah_soal == 40) {
            $nilai = ($jumlah_benar * 25) / 10;
        }


        $nilai = round($nilai, 2);
        $nilai_bulat = round($nilai);


        //simpan dulu data peserta


        $dd = array();
        $dd['soal_jawab_last_update']    = date('Y-m-d H:i:s');
        $dd['soal_jawab_benar']  = $jumlah_benar;
        $dd['soal_jawab_salah']  = $jumlah_salah;
        $dd['soal_jawab_ok']     = $jumlah_terjawab;
        $dd['soal_jawab_none']   = $jumlah_tidakterjawab;
        $dd['soal_jawab_nilai']  = $nilai;


        $response["success"] = true;
        $response["data"] = $dd;


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }







    /**
     * @return mixed
     * Arsip
     */


    function arsip_listby()
    {
        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        $tahun = $this->input->get('tahun');
        $kelas = $this->input->get('kelas');
        $untuk = $this->input->get('untuk');

        $this->db->select('*')->from('soal');

        if (!empty($untuk) && !empty($kelas) && !empty($tahun)) {

            $this->db->where('soal_tahunajaran', $tahun);
            $this->db->where('soal_kelas', $kelas);
            $this->db->where('soal_untuk', $untuk);
            //$this->db->where('soal_jurusan !=', "");
            $this->db->group_by('soal_jurusan');
            $this->db->order_by('soal_jurusan', 'asc');
        } elseif (!empty($kelas) && !empty($tahun)) {

            $this->db->where('soal_tahunajaran', $tahun);
            $this->db->where('soal_kelas', $kelas);
            $this->db->where('soal_untuk !=', "");
            $this->db->group_by('soal_untuk');
            $this->db->order_by('soal_untuk', 'asc');
        } elseif (!empty($tahun)) {

            $this->db->where('soal_tahunajaran', $tahun);
            $this->db->where('soal_kelas !=', "");
            $this->db->group_by('soal_kelas');
            $this->db->order_by('soal_kelas', 'asc');
        } else {

            $this->db->group_by('soal_tahunajaran');
        }


        $this->db->order_by('soal_id', 'desc');




        foreach ($this->db->get()->result() as $ta) {
            $item = array();

            if (!empty($untuk) && !empty($kelas) && !empty($tahun)) {

                array_push($response["response"], !empty($ta->soal_jurusan) ? $ta->soal_jurusan : "Semua Jurusan");
            } elseif (!empty($kelas) && !empty($tahun)) {

                array_push($response["response"], $ta->soal_untuk);
            } elseif (!empty($tahun)) {

                array_push($response["response"], $ta->soal_kelas);
            } else {
                array_push($response["response"], $ta->soal_tahunajaran);
            }
        }
        $response["success"] = true;

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }


    function arsip()
    {
        $response = array();
        $response["success"] = false;
        $response["response"] = array();

        $tahun = $this->input->get('tahun');
        $kelas = $this->input->get('kelas');
        $untuk = $this->input->get('untuk');
        $jurusan = $this->input->get('jurusan');

        $this->db->select('*')->from('soal');

        $this->db->where('soal_tahunajaran', $tahun);
        $this->db->where('soal_kelas', $kelas);
        $this->db->where('soal_untuk', $untuk);

        if (!empty($jurusan)) {
            $this->db->where('soal_jurusan', "");
            $this->db->or_where('soal_jurusan', $jurusan);
        }

        $this->db->group_by('soal_pelajaran');
        $this->db->group_by('soal_guru');

        //sort data by ascending or desceding order
        if (!empty($params['search']['sortBy'])) {
            $this->db->order_by('soal_date', $params['search']['sortBy']);
        } else {
            $this->db->order_by('soal_date', 'desc');
        }

        $nomor = 0;
        foreach ($this->db->get()->result_array() as $row) {
            $baris = array();

            $nomor++;

            $soal_tahunajaran     = $row['soal_tahunajaran'];
            $soal_pelajaran     = $row['soal_pelajaran'];
            $soal_guru     = $row['soal_guru'];
            $soal_untuk     = $row['soal_untuk'];
            $soal_kelas     = $row['soal_kelas'];

            $baris['soal_tahunajaran']     = $soal_tahunajaran;
            $baris['soal_kelas']     = $soal_kelas;
            $baris['soal_pelajaran']     = $soal_pelajaran;
            $baris['soal_guru']     = $soal_guru;
            $baris['soal_untuk']     = $soal_untuk;


            $data_soal = $this->db->get_where("soal", array(
                'soal_tahunajaran' => $tahun,
                'soal_pelajaran' => $soal_pelajaran,
                'soal_guru' => $soal_guru,
                'soal_kelas' => $soal_kelas,
                'soal_untuk' => $soal_untuk
            ));

            $baris['soal_jumlah_terkumpul']     = $data_soal->num_rows();
            $baris['soal_jumlah_terkumpul_total']     = 0;


            array_push($response["response"], $baris);
        }

        $response["success"] = true;

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }


    function arsip_view()
    {
        $response = array();
        $response["success"] = false;
        $response["response"] = array();


        $tahun = $this->input->get('tahun');
        $kelas = $this->input->get('kelas');
        $untuk = $this->input->get('untuk');
        $jurusan = $this->input->get('jurusan');

        $pelajaran = $this->input->get("pelajaran");
        $guru = $this->input->get("guru");



        $this->db->select('*')->from('soal');

        $this->db->where('soal_tahunajaran', $tahun);
        $this->db->where('soal_kelas', $kelas);
        $this->db->where('soal_untuk', $untuk);

        $this->db->where('soal_jurusan', $jurusan);

        $this->db->where('soal_pelajaran', $pelajaran);
        $this->db->where('soal_guru', $guru);


        $this->db->order_by("soal_id", "asc");

        $this->db->limit(60);

        foreach ($this->db->get()->result_array() as $soal) {


            $soal_parent_id = $soal["soal_parent_id"];

            $soal["soal_parent_id"] = $soal_parent_id;
            $soal["soal_parent_text"] = "";

            $this->db->select('*')->from('soal_parent');
            $this->db->where('soal_parent_id', $soal_parent_id);
            foreach ($this->db->get()->result_array() as $soal_parent) {
                $soal["soal_parent_text"] = $soal_parent["soal_parent_text"];
            }

            array_push($response['response'], $soal);
        }

        //$this->output->set_header('Access-Control-Allow-Origin: *');
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($response, JSON_UNESCAPED_UNICODE);

        $this->load->view('arsip_view', $response);
    }



    /**
     * Other function
     */

    function uploadprofile()
    {
        $this->load->library('upload');
        $fileUID = $this->input->post('uploaded_uid');

        $time = time();


        $config['upload_path'] = './assets/profile/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

        $config['file_name'] = $fileUID;
        $config['overwrite'] = true;
        $config['max_size'] = 10240;

        $this->upload->initialize($config);

        $response = array();
        $response["success"] = false;
        $response["response"] = "";

        $uploaded_file = $_FILES['uploaded_file']['name'];
        if (!empty($uploaded_file)) {

            if (file_exists('./assets/profile/' . $uploaded_file))
                unlink('./assets/profile/' . $uploaded_file);

            if ($this->upload->do_upload('uploaded_file')) {



                $gbr = $this->upload->data();
                $file = $gbr['file_name'];

                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/profile/' . $file;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '70%';
                //$config['width']= 200;
                //$config['height']= 200;

                $config['new_image'] = './assets/profile/' . $file;
                $this->load->library('image_lib', $config);
                $this->image_lib->crop();


                $this->db->query("UPDATE cbt_peserta SET peserta_foto = '$file' WHERE peserta_id = '$fileUID'");

                $response["success"] = true;
                $response["response"] = array("foto" => $this->config->item('base_url') . '/assets/profile/' . $file);
            }
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }

    /**
     * @return mixed
     * Function _none()
     */

    function _jumlah_pesan($untuk)
    {

        $ikut = $this->db->select('*')->from('pesan');

        if ($untuk == "peserta") {
            $ikut = $ikut->where("pesan_untuk='siswa'");
            $ikut = $ikut->or_where("pesan_untuk='semua'");
        } elseif ($untuk == "pengawas") {
            $ikut = $ikut->or_where("pesan_untuk='semua'");
        }

        return $ikut->get()->num_rows();
    }


    function _jumlah_jawab_by($uid, $tgl, $ruangan, $kelas, $jurusan)
    {
        $this->db->select("*");
        $this->db->from("soal_jawab");

        $this->db->where("soal_jawab_tahunajaran", $this->tahunajaran);

        if (!empty($uid)) {
            $this->db->where("siswa_id", $uid);
        }

        if (!empty($tgl)) {
            $this->db->where("soal_jawab_tanggal", $tgl);
        }

        $this->db->where("soal_jawab_ruangan", $ruangan);
        $this->db->where("soal_jawab_kelas", $kelas);
        $this->db->where("soal_jawab_jurusan", $jurusan);

        return $this->db->get()->num_rows();
    }


    function _jumlah_ujian_by($uid, $tgl, $kelas, $jurusan)
    {
        $this->db->select("*");
        $this->db->from("ujian");

        $this->db->where("ujian_tahunajaran", $this->tahunajaran);


        $this->db->where("ujian_kelas", $kelas);

        if (!empty($tgl)) {
            $this->db->where("ujian_tanggal", $tgl);
        }

        if (!empty($jurusan)) {
            $this->db->where("ujian_jurusan='' OR ujian_jurusan='$jurusan'");
        }

        return $this->db->get()->num_rows();
    }

    function _jumlah_peserta_ruangan($tgl, $ruangan)
    {
        return $this->db->select('*')->from('soal_jawab')->where(
            array(
                "soal_jawab_tahunajaran" => $this->tahunajaran,
                "soal_jawab_tanggal" => $tgl,
                "soal_jawab_ruangan" => $ruangan
            )
        )->get()->num_rows();
    }

    function _jumlah_peserta()
    {
        return $this->db->select('*')->from('peserta')->get()->num_rows();
    }

    function _jumlah_jurusan()
    {
        return $this->db->select('*')->from('peserta')->group_by('peserta_jurusan')->get()->num_rows();
    }

    function _jumlah_pelajaran($kelas_sekarang, $jurusan_id, $ruang)
    {
        $this->db->select('*')->from('soal_pembuat');
        $this->db->where("soal_pembuat_tahunajaran", $this->tahunajaran);
        $this->db->where('(soal_pembuat_kelas=\'\' OR soal_pembuat_kelas=\'' . $kelas_sekarang . '\')');
        $this->db->where('(soal_pembuat_jurusan=\'\' OR soal_pembuat_jurusan=\'' . $jurusan_id . '\')');
        return $this->db->get()->num_rows();
    }

    function _jumlah_dikerjakan($id)
    {

        $this->db->select('*')->from('soal_jawab');
        $this->db->where("soal_jawab_tahunajaran", $this->tahunajaran);
        $this->db->where('soal_jawab_status', 'N');
        $this->db->where("siswa_id = $id");

        return $this->db->get()->num_rows();
    }

    function _jumlah_ujian_today($kelas, $jurusan, $agama)
    {
        $jum = 0;
        $tgl = date('Y-m-d');

        $this->db->select('*')->from('ujian');
        $this->db->where("ujian_tahunajaran", $this->tahunajaran);

        //$ikut = $ikut->group_by('soal_pembuat_pelajaran');
        $this->db->where('(ujian_kelas=\'\' OR ujian_kelas=\'' . $kelas . '\')');
        //$ikut = $ikut->where('(ujian_jurusan=\'\' OR ujian_jurusan=\''.$jurusan_id.'\')');
        //$ikut = $ikut->where('(soal_pembuat_jurusan_ke=\'\' OR soal_pembuat_jurusan_ke=\''.$ruang.'\')');

        $this->db->where('ujian_tanggal', $tgl);
        foreach ($this->db->get()->result_array() as $row1) {

            $ujian_jurusan = explode(",", $row1['ujian_jurusan']);
            $ujian_agama = explode(",", $row1['ujian_agama']);

            $a = 0;
            $b = 0;
            if (empty($row1['ujian_jurusan']) || (count($ujian_jurusan) > 0 && in_array($jurusan, $ujian_jurusan))) {
                $a++;
            }

            if (empty($row1['ujian_agama']) || (count($ujian_agama) > 0 && in_array($agama, $ujian_agama))) {
                $b++;
            }

            if ($a == 1 && $b == 1) {
                $jum++;
            }
        }

        return $jum;
    }


    function _cronJob()
    {
        $pengaturanToken = json_decode($this->m->getpengaturan("pengaturanToken"), true);

        $tanggal_sekarang = date('Y-m-d');
        $tgl_buka   = date('Y-m-d H:i', strtotime($tanggal_sekarang . ' ' . $pengaturanToken["buka"]));
        $tgl_tutup  = date('Y-m-d H:i', strtotime($tanggal_sekarang . ' ' . $pengaturanToken["tutup"]));


        $lama = 15; //menit
        $tanggal_sekarang = date('Y-m-d H:i:s');
        $tanggal_sekarang_ditambah = date('Y-m-d H:i:s', strtotime("+$lama minutes", strtotime($tanggal_sekarang)));

        $token_baru = $this->_generateRandomString(4);

        $xtanggal_sekarang = strtotime($tanggal_sekarang) * 1000;
        $xtgl_buka = strtotime($tgl_buka) * 1000;
        $xtgl_tutup = strtotime($tgl_tutup) * 1000;

        //jika jam sekarang lebih dari jam x &&
        //jika jam sekarang kurang dari jam y
        if ($xtanggal_sekarang >= $xtgl_buka && $xtanggal_sekarang <= $xtgl_tutup) {

            $ujian_token = $this->db->get_where('ujian_token', null)->result();

            if (sizeof($ujian_token) > 0) {
                if ($tanggal_sekarang > $ujian_token[0]->ujian_token_tanggal) {
                    $this->db->update('ujian_token', array(
                        'ujian_token_tanggal' => $tanggal_sekarang_ditambah,
                        'ujian_token_text' => $token_baru,
                    ));
                }
            } else {
                $this->db->insert('ujian_token', array(
                    'ujian_token_tanggal' => $tanggal_sekarang_ditambah,
                    'ujian_token_text' => $token_baru
                ));
            }
        }
    }
    function _generateRandomString($length = 4)
    {
        //$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function _philsXMLClean($strin)
    {


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
    function _strip($var)
    {

        $allowed = '<sup><sub><p><br>
            <ul><ol><li><dl><dt><dd><strong><em><b><i><u>
            <img><audio><video>
            <table><tbody><td><tfoot><th><thead><tr>
            <iframe>';

        return strip_tags($var, $allowed);
    }
    function _strip1($var)
    {
        $allowed = '<sup><sub><p><br>
            <ul><ol><li><dl><dt><dd><strong><em><b><i><u>
            <img><audio><video>
            <table><tbody><td><tfoot><th><thead><tr>
            <iframe>';

        return strip_tags($var, $allowed);
    }
    function _strip2($var)
    {
        $allowed = '<sup><sub><br>
            <ul><ol><li><dl><dt><dd><strong><em><b><i><u>
            <img><audio><video>
            <table><tbody><td><tfoot><th><thead><tr>
            <iframe>';

        return strip_tags($var, $allowed);
    }
    function _strip3($strout)
    {

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

    function _time_since($original)
    {
        $original = strtotime($original);
        $chunks = array(
            array(60 * 60 * 24 * 365, 'tahun'),
            array(60 * 60 * 24 * 30, 'bulan'),
            array(60 * 60 * 24 * 7, 'minggu'),
            array(60 * 60 * 24, 'hari'),
            array(60 * 60, 'jam'),
            array(60, 'menit'),
        );

        $today = time();
        $since = $today - $original;

        if ($since > 604800) {
            $print = date("M jS", $original);
            if ($since > 31536000) {
                $print .= ", " . date("Y", $original);
            }
            return $print;
        }

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            if (($count = floor($since / $seconds)) != 0)
                break;
        }

        $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
        return $print . ' yang lalu';
    }
}
