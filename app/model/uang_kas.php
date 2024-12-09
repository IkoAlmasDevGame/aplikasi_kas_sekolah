<?php

namespace model;

class bulan_pembayaran
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function uangkas($id_bulan_pembayaran)
    {
        $SQL = "SELECT sum(minggu_ke_1 + minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as total_uang_kas_bulan_ini FROM uang_kas WHERE id_bulan_pembayaran = '$id_bulan_pembayaran'";
        return $this->db->query($SQL);
    }

    public function bulanpembayaran($id_bulan_pembayaran)
    {
        $SQL = "SELECT * FROM bulan_pembayaran WHERE id_bulan_pembayaran = '$id_bulan_pembayaran'";
        return $this->db->query($SQL);
    }

    public function tambahbulan($nama_bulan, $tahun, $pembayaran_perminggu)
    {
        if (empty($_POST['nama_bulan']) || empty($_POST['pembayaran_perminggu'])):
            echo "<script>document.location.href = '../ui/header.php?aksi=tambah-uang_kas';</script>";
            die;
        else:
            $nama_bulan = htmlspecialchars($_POST['nama_bulan']);
            $tahun = htmlspecialchars($_POST['tahun']);
            $pembayaran_perminggu = htmlspecialchars($_POST['pembayaran_perminggu']);
            # code tambah data pemabayaran perminggu
            $table = "bulan_pembayaran";
            $insertSQL = "INSERT INTO $table SET nama_bulan = '$nama_bulan', tahun = '$tahun', pembayaran_perminggu = '$pembayaran_perminggu'";
            $data = $this->db->query($insertSQL);
            if ($data != "") {
                if ($data) {
                    echo "<script>document.location.href = '../ui/header.php?aksi=tambah-uang_kas&dialog=success';</script>";
                    die;
                }
            } else {
                echo "<script>document.location.href = '../ui/header.php?page=uang_kas';</script>";
                die;
            }
        endif;
    }

    public function ubahbulan($nama_bulan, $tahun, $pembayaran_perminggu, $id_bulan_pembayaran)
    {
        $id_bulan_pembayaran = htmlspecialchars($_POST['id_bulan_pembayaran']);
        $nama_bulan = htmlspecialchars($_POST['nama_bulan']);
        $tahun = htmlspecialchars($_POST['tahun']);
        $pembayaran_perminggu = htmlspecialchars($_POST['pembayaran_perminggu']);
        # code tambah data pemabayaran perminggu
        $table = "bulan_pembayaran";
        $updateSQL = "UPDATE $table SET nama_bulan = '$nama_bulan', tahun = '$tahun', pembayaran_perminggu = '$pembayaran_perminggu' WHERE id_bulan_pembayaran='$id_bulan_pembayaran'";
        $data = $this->db->query($updateSQL);
        if ($data != "") {
            if ($data) {
                echo "<script>document.location.href = '../ui/header.php?aksi=edit-uang_kas&id_bulan_pembayaran=$id_bulan_pembayaran&dialog=change';</script>";
                die;
            }
        } else {
            echo "<script>document.location.href = '../ui/header.php?page=uang_kas';</script>";
            die;
        }
    }

    public function hapusbulan($id_bulan_pembayaran)
    {
        $id_bulan_pembayaran = htmlspecialchars($_GET['id_bulan_pembayaran']);
        # code tambah data pemabayaran perminggu
        $table = "bulan_pembayaran";
        $hapusSQL = "DELETE FROM $table WHERE id_bulan_pembayaran='$id_bulan_pembayaran'";
        $data = $this->db->query($hapusSQL);
        if ($data != "") {
            $SQL1 = "DELETE FROM uang_kas";
            $SQL2 = "DELETE FROM riwayat";
            if ($data) {
                $this->db->query($SQL1);
                $this->db->query($SQL2);
                echo "<script>document.location.href = '../ui/header.php?page=uang_kas&dialog=delete';</script>";
                die;
            }
        } else {
            echo "<script>document.location.href = '../ui/header.php?page=uang_kas';</script>";
            die;
        }
    }
}

class uang_kas
{
    protected $dbnm;
    public function __construct($dbnm)
    {
        $this->dbnm = $dbnm;
    }

    public function uangpelajar($id_bulan_pembayaran)
    {
        $SQL = "SELECT * FROM uang_kas INNER JOIN siswa ON uang_kas.id_siswa = siswa.id_siswa INNER JOIN bulan_pembayaran ON uang_kas.id_bulan_pembayaran = bulan_pembayaran.id_bulan_pembayaran WHERE uang_kas.id_bulan_pembayaran = '$id_bulan_pembayaran' ORDER BY nama_siswa ASC";
        return $this->dbnm->query($SQL);
    }

    public function riwayat()
    {
        $SQL = "SELECT * FROM riwayat INNER JOIN user ON riwayat.id_user = user.id_user INNER JOIN uang_kas ON riwayat.id_uang_kas = uang_kas.id_uang_kas INNER JOIN siswa ON uang_kas.id_siswa = siswa.id_siswa INNER JOIN bulan_pembayaran ON uang_kas.id_bulan_pembayaran = bulan_pembayaran.id_bulan_pembayaran ORDER BY tanggal ASC";
        return $this->dbnm->query($SQL);
    }

    public function riwayat_pengeluaran()
    {
        $SQL = "SELECT * FROM riwayat_pengeluaran INNER JOIN user ON riwayat_pengeluaran.id_user = user.id_user ORDER BY tanggal DESC";
        return $this->dbnm->query($SQL);
    }

    public function tambahuangkasSiswa($id_siswa, $id_bulan_pembayaran)
    {
        $id_bulan_pembayaran = htmlspecialchars($_POST['id_bulan_pembayaran']);
        $id_siswa = htmlspecialchars($_POST['id_siswa']);
        $table = "uang_kas";
        $this->dbnm->query("INSERT INTO $table SET id_siswa = '$id_siswa', id_bulan_pembayaran = '$id_bulan_pembayaran'");
        echo "<script>
        document.location.href = '../ui/header.php?page=detail_bulan_pembayaran&id_bulan_pembayaran=$id_bulan_pembayaran';
        </script>";
        die;
    }

    public function bayarbulanan()
    {
        if (isset($_POST['btnEditPembayaranUangKas']) > 0) {
            $id_uang_kas = htmlspecialchars($_POST['id_uang_kas']);
            $id_user = htmlspecialchars($_POST['id_user']);
            $tanggal = time();
            if (isset($_POST['minggu_ke_1'])) {
                $uang_sebelum = (int)$_POST['uang_sebelum'];
                $minggu_ke_1 = (int)$_POST['minggu_ke_1'];
                $aksi1 = "telah mengubah pembayaran minggu ke-1 dari Rp. " . number_format($uang_sebelum) . " menjadi Rp. " . number_format($minggu_ke_1) . "";
                $this->dbnm->query("UPDATE uang_kas SET minggu_ke_1 = '$minggu_ke_1' WHERE id_uang_kas = '$id_uang_kas'");
                $this->dbnm->query("INSERT INTO riwayat SET id_user = '$id_user', id_uang_kas = '$id_uang_kas', aksi = '$aksi1', tanggal='$tanggal'");
                echo "<script>
                document.location.href = '../ui/header.php?page=uang_kas';
                </script>";
                die;
            } else if (isset($_POST['minggu_ke_2'])) {
                $uang_sebelum = (int)$_POST['uang_sebelum'];
                $minggu_ke_2 = (int)$_POST['minggu_ke_2'];
                $aksi2 = "telah mengubah pembayaran minggu ke-2 dari Rp. " . number_format($uang_sebelum) . " menjadi Rp. " . number_format($minggu_ke_2) . "";
                $this->dbnm->query("UPDATE uang_kas SET minggu_ke_2 = '$minggu_ke_2' WHERE id_uang_kas = '$id_uang_kas'");
                $this->dbnm->query("INSERT INTO riwayat SET id_user = '$id_user', id_uang_kas = '$id_uang_kas', aksi = '$aksi2', tanggal='$tanggal'");
                echo "<script>
                document.location.href = '../ui/header.php?page=uang_kas';
                </script>";
                die;
            } else if (isset($_POST['minggu_ke_3'])) {
                $uang_sebelum = (int)$_POST['uang_sebelum'];
                $minggu_ke_3 = (int)$_POST['minggu_ke_3'];
                $aksi3 = "telah mengubah pembayaran minggu ke-3 dari Rp. " . number_format($uang_sebelum) . " menjadi Rp. " . number_format($minggu_ke_3) . "";
                $this->dbnm->query("UPDATE uang_kas SET minggu_ke_3 = '$minggu_ke_3' WHERE id_uang_kas = '$id_uang_kas'");
                $this->dbnm->query("INSERT INTO riwayat SET id_user = '$id_user', id_uang_kas = '$id_uang_kas', aksi = '$aksi3', tanggal='$tanggal'");
                echo "<script>
                document.location.href = '../ui/header.php?page=uang_kas';
                </script>";
                die;
            } else if (isset($_POST['minggu_ke_4'])) {
                $uang_sebelum = (int)$_POST['uang_sebelum'];
                $minggu_ke_4 = (int)$_POST['minggu_ke_4'];
                $aksi4 = "telah mengubah pembayaran minggu ke-4 dari Rp. " . number_format($uang_sebelum) . " menjadi Rp. " . number_format($minggu_ke_4) . "";
                $pembayaran_perminggu = htmlspecialchars($_POST['pembayaran_perminggu']);
                if ($minggu_ke_4 == $pembayaran_perminggu) {
                    $this->dbnm->query("UPDATE uang_kas SET minggu_ke_4 = '$minggu_ke_4', status_lunas = '1' WHERE id_uang_kas = '$id_uang_kas'");
                } else {
                    $this->dbnm->query("UPDATE uang_kas SET minggu_ke_4 = '$minggu_ke_4' WHERE id_uang_kas = '$id_uang_kas'");
                }
                $this->dbnm->query("INSERT INTO riwayat SET id_user = '$id_user', id_uang_kas = '$id_uang_kas', aksi = '$aksi4', tanggal='$tanggal'");
                echo "<script>
                document.location.href = '../ui/header.php?page=uang_kas';
                </script>";
                die;
            }
        }
    }
}
