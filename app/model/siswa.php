<?php

namespace model;

class DaftarSiswa
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function siswa()
    {
        $SQL = "SELECT * FROM siswa ORDER BY nama_siswa ASC";
        return $this->db->query($SQL);
    }

    public function siswabaru()
    {
        $SQL = "SELECT * FROM siswa WHERE id_siswa NOT IN (SELECT id_siswa FROM uang_kas) ORDER BY nama_siswa ASC";
        return $this->db->query($SQL);
    }

    public function tambah($nama, $jenis, $telepon, $email)
    {
        if (empty($_POST['nama_siswa']) || empty($_POST['jenis_kelamin']) || empty($_POST['no_telepon']) || empty($_POST['email'])):
            echo "<script>document.location.href = '../ui/header.php?aksi=tambah-siswa';</script>";
            die;
        else:
            $nama = htmlspecialchars($_POST['nama_siswa']) ? htmlentities($_POST['nama_siswa']) : strip_tags($_POST['nama_siswa']);
            $jenis = htmlspecialchars($_POST['jenis_kelamin']) ? htmlentities($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
            $telepon = htmlspecialchars($_POST['no_telepon']) ? htmlentities($_POST['no_telepon']) : strip_tags($_POST['no_telepon']);
            $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
            # code table database
            $table = "siswa";
            $SQL = "SELECT * FROM $table WHERE nama_siswa = '$nama' and email = '$email' order by email desc";
            $Query = $this->db->query($SQL);
            # cek nama_siswa dan email yang sama ...
            $cek = mysqli_num_rows($Query);
            if ($cek) {
                echo "<script>document.location.href = '../ui/header.php?aksi=tambah-siswa';</script>";
                die;
            } else {
                $SQLInsert = "INSERT INTO $table SET nama_siswa = '$nama', jenis_kelamin = '$jenis', no_telepon = '$telepon', email = '$email'";
                $data = $this->db->query($SQLInsert);
                if ($data != "") {
                    if ($data) {
                        echo "<script>document.location.href = '../ui/header.php?aksi=tambah-siswa&dialog=success';</script>";
                        die;
                    }
                } else {
                    echo "<script>document.location.href = '../ui/header.php?aksi=tambah-siswa';</script>";
                    die;
                }
            }
        endif;
    }
    public function ubah($nama, $jenis, $telepon, $email, $id)
    {
        $nama = htmlspecialchars($_POST['nama_siswa']) ? htmlentities($_POST['nama_siswa']) : strip_tags($_POST['nama_siswa']);
        $jenis = htmlspecialchars($_POST['jenis_kelamin']) ? htmlentities($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
        $telepon = htmlspecialchars($_POST['no_telepon']) ? htmlentities($_POST['no_telepon']) : strip_tags($_POST['no_telepon']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $id = htmlspecialchars($_POST['id_siswa']) ? htmlentities($_POST['id_siswa']) : strip_tags($_POST['id_siswa']);
        # code table database
        $table = "siswa";
        $SQLUpdate = "UPDATE $table SET nama_siswa = '$nama', jenis_kelamin = '$jenis', no_telepon = '$telepon', email = '$email' where id_siswa = '$id'";
        $data = $this->db->query($SQLUpdate);
        if ($data != "") {
            if ($data) {
                echo "<script>document.location.href = '../ui/header.php?aksi=edit-siswa&id=$id&dialog=change';</script>";
                die;
            }
        } else {
            echo "<script>document.location.href = '../ui/header.php?aksi=edit-siswa&id=$id';</script>";
            die;
        }
    }

    public function hapus($id)
    {
        $id = htmlspecialchars($_GET['id']) ? htmlentities($_GET['id']) : strip_tags($_GET['id']);
        # code table database
        $table = "siswa";
        $SQLHapus = "DELETE FROM $table WHERE id_siswa = '$id'";
        $data = $this->db->query($SQLHapus);
        if ($data != "") {
            if ($data) {
                echo "<script>document.location.href = '../ui/header.php?page=siswa&dialog=delete';</script>";
                die;
            }
        } else {
            echo "<script>document.location.href = '../ui/header.php?page=siswa';</script>";
            die;
        }
    }
}
