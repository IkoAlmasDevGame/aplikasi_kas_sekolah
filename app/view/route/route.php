<?php
require_once("../../config/config.php");
# Files Model Awal
require_once("../../model/authentication.php");
$auth = new model\authentication($konfigs);
require_once("../../model/registerasi.php");
$register = new model\registerasi($konfigs);
require_once("../../model/siswa.php");
$daftar = new model\DaftarSiswa($konfigs);
require_once("../../model/uang_kas.php");
$pembayaran = new model\bulan_pembayaran($konfigs);
$kas = new model\uang_kas($konfigs);
require_once("../../model/pengeluaran.php");
$pengeluaran = new model\pengeluaran($konfigs);
require_once("../../model/jabatan.php");
$jabatan = new model\jabatan($konfigs);
require_once("../../model/profile.php");
$profiling = new model\profile($konfigs);
# Files Model Akhir
# <--- ==== ==== --->
# Files Controller Awal
require_once("../../controller/controller.php");
$authentication = new controller\AuthLogin($konfigs);
$registeration = new controller\registeration($konfigs);
$siswa = new controller\Siswa($konfigs);
$bulan = new controller\bulan($konfigs);
$uangkas = new controller\uang($konfigs);
$kaspengeluaran = new controller\pengeluaran_kas($konfigs);
$jbtan = new controller\Jabatant($konfigs);
$profile = new controller\dataUser($konfigs);

# Files Controller Akhir

if (!isset($_GET['page'])) {
} else {
    switch ($_GET['page']) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

            # Jabatan Administrator, Guru, Bendahara Awal
        case 'siswa':
            require_once("../siswa/siswa.php");
            break;
        case 'jabatan':
            require_once("../jabatan/jabatan.php");
            break;
        case 'uang_kas':
            require_once("../pembayaran/uang_kas.php");
            break;
        case 'detail_bulan_pembayaran':
            require_once("../pembayaran/detail_bulan.php");
            break;
        case 'pengeluaran':
            require_once("../pengeluaran/pengeluaran.php");
            break;
        case 'laporan':
            require_once("../laporan/laporan.php");
            break;
        case 'riwayat':
            require_once("../riwayat/riwayat.php");
            break;
        case 'riwayat_pengeluaran':
            require_once("../riwayat/riwayat_pengeluaran.php");
            break;
            # Jabatan Administrator Awal
        case 'setting':
            require_once("../setting/setting.php");
            break;
        case 'user-profile':
            require_once("../user/user.php");
            break;
            # Jabatan Administrator Akhir
        case 'profile':
            require_once("../profile/profile.php");
            break;
            # Jabatan Administrator, Guru, Bendahara Akhir
        case 'logout':
            if (isset($_SESSION['status'])) {
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            echo "<script>document.location.href = '../index.php';</script>";
            exit(0);
            break;

        default:
            require_once("../dashboard/index.php");
            break;
    }
}

if (!isset($_GET['aksi'])) {
} else {
    switch ($_GET['aksi']) {
            # Halaman Siswa
        case 'tambah-siswa':
            require_once("../siswa/tambah.php");
            break;
        case 'edit-siswa':
            require_once("../siswa/edit.php");
            break;
        case 'siswa-tambah':
            $siswa->tambahsiswa();
            break;
        case 'siswa-edit':
            $siswa->ubahsiswa();
            break;
        case 'siswa-hapus':
            $siswa->hapussiswa();
            break;
            # Halaman Siswa

            # Halaman uang kas
        case 'tambah-uang_kas':
            require_once("../pembayaran/tambah.php");
            break;
        case 'edit-uang_kas':
            require_once("../pembayaran/edit.php");
            break;
        case 'uang_kas-tambah':
            $bulan->tambahmonth();
            break;
        case 'uang_kas-edit':
            $bulan->ubahmonth();
            break;
        case 'uang_kas-hapus':
            $bulan->hapusmonth();
            break;
        case 'tambah-kasSiswa':
            $uangkas->tambahkas();
            break;
        case 'bayar-uangkas':
            $kas->bayarbulanan();
            break;
            # Halaman uang kas

            # Halaman pengeluaran kas
        case 'tambah-pengeluaran':
            require_once("../pengeluaran/tambah.php");
            break;
        case 'edit-pengeluaran':
            require_once("../pengeluaran/edit.php");
            break;
        case 'pengeluaran-tambah':
            $kaspengeluaran->tambah_pengeluaran();
            break;
        case 'pengeluaran-edit':
            $kaspengeluaran->ubah_pengeluaran();
            break;
        case 'pengeluaran-hapus':
            $kaspengeluaran->hapus_pengeluaran();
            break;
            # Halaman pengeluaran kas

            # Halaman Jabatan Uang Kas Sekolah
        case 'jabatan-tambah':
            $jbtan->tambah_jabatan();
            break;
        case 'jabatan-ubah':
            $jbtan->ubah_jabatan();
            break;
        case 'jabatan-hapus':
            $jbtan->hapus_jabatan();
            break;
            # Halaman Jabatan Uang Kas Sekolah

            # Halama Edit Profile
        case 'edit-data':
            $profile->editdata();
            break;
        case 'edit-password':
            $profile->editpassword();
            break;
            # Halama Edit Profile



        default:
            # code
            break;
    }
}
