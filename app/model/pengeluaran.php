<?php

namespace model;

class pengeluaran
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function pengeluaran()
    {
        $SQL = "SELECT * FROM pengeluaran INNER JOIN user ON pengeluaran.id_user = user.id_user";
        return $this->db->query($SQL);
    }

    public function tambahpengeluaran($jumlah_pengeluaran, $keterangan)
    {
        if (empty($_POST['jumlah_pengeluaran']) || empty($_POST['keterangan'])):
            echo "<script>document.location.href = '../ui/header.php?aksi=tambah-pengeluaran';</script>";
            die;
        else:
            if (isset($_POST['btnAddPengeluaran']) > 0) {
                $id_user = htmlspecialchars($_POST['id_user']);
                $jumlah_pengeluaran = (int)$_POST['jumlah_pengeluaran'];
                $keterangan = htmlspecialchars($_POST['keterangan']);
                $tanggal_pengeluaran = time();
                $aksi = "telah menambahkan pengeluaran " . $keterangan . " dengan biaya Rp. " . number_format($jumlah_pengeluaran) . "";
                # code database pengeluaran
                $table = "pengeluaran";
                $insert = "INSERT INTO $table SET jumlah_pengeluaran = '$jumlah_pengeluaran', keterangan = '$keterangan', tanggal_pengeluaran = '$tanggal_pengeluaran', id_user = '$id_user'";
                $data = $this->db->query($insert);
                if ($data != "") {
                    $SQL = "INSERT INTO riwayat_pengeluaran SET id_user = '$id_user', aksi = '$aksi', tanggal = '$tanggal_pengeluaran'";
                    if ($data) {
                        $this->db->query($SQL);
                        echo "<script>document.location.href = '../ui/header.php?aksi=tambah-pengeluaran&dialog=success';</script>";
                        die;
                    }
                } else {
                    echo "<script>document.location.href = '../ui/header.php?aksi=tambah-pengeluaran';</script>";
                    die;
                }
            }
        endif;
    }

    public function ubahpengeluaran($jumlah_pengeluaran, $keterangan, $id_pengeluaran)
    {
        if (isset($_POST['btnEditPengeluaran']) > 0) {
            $id_user = htmlspecialchars($_POST['id_user']);
            $fetch = mysqli_fetch_assoc($this->db->query("SELECT * FROM riwayat_pengeluaran inner join user on riwayat_pengeluaran.id_user = user.id_user 
            WHERE riwayat_pengeluaran.id_riwayat_pengeluaran = '$_POST[id_riwayat_pengeluaran]'"));
            $id_pengeluaran = htmlspecialchars($_POST['id_pengeluaran']);
            $fetch_sql = mysqli_fetch_assoc($this->db->query("SELECT * FROM pengeluaran WHERE id_pengeluaran = '$id_pengeluaran'"));
            $jumlah_pengeluaran = (int)$_POST['jumlah_pengeluaran'];
            $keterangan = htmlspecialchars($_POST['keterangan']);
            $tanggal_pengeluaran = time();
            $aksi = "telah mengubah pengeluaran  " . $keterangan . " dari biaya Rp. " . number_format($fetch_sql['jumlah_pengeluaran']) . "";
            $update = "UPDATE pengeluaran SET jumlah_pengeluaran = '$jumlah_pengeluaran', keterangan = '$keterangan', tanggal_pengeluaran = '$tanggal_pengeluaran', id_user = '$id_user'
             WHERE id_pengeluaran = '$id_pengeluaran'";
            $data = $this->db->query($update);
            if ($data != "") {
                $SQL = "UPDATE riwayat_pengeluaran SET id_user = '$id_user', aksi = '$aksi', tanggal = '$tanggal_pengeluaran' WHERE id_riwayat_pengeluaran = '$fetch[id_riwayat_pengeluaran]'";
                if ($data) {
                    $this->db->query($SQL);
                    echo "<script>document.location.href = '../ui/header.php?aksi=tambah-pengeluaran&id_pengeluaran=$id_pengeluaran&dialog=change';</script>";
                    die;
                }
            } else {
                echo "<script>document.location.href = '../ui/header.php?aksi=tambah-pengeluaran';</script>";
                die;
            }
        }
    }

    public function hapuspengeluaran($id_pengeluaran)
    {
        $id_pengeluaran = htmlspecialchars($_GET['id_pengeluaran']);
        $this->db->query("DELETE FROM riwayat_pengeluaran inner join pengeluaran on riwayat_pengeluaran.tanggal = pengeluaran.tanggal_pengeluaran WHERE riwayat_pengeluaran.tanggal = '$_GET[tanggal]'");
        return $this->db->query("DELETE FROM pengeluaran WHERE id_pengeluaran = '$id_pengeluaran'");
        echo "<script>document.location.href = '../ui/header.php?page=pengeluaran&dialog=delete';</script>";
        die;
    }
}
