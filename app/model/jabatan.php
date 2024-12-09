<?php

namespace model;

class jabatan
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function jabatan()
    {
        $SQL = "SELECT * FROM jabatan order by id_jabatan asc";
        return $this->db->query($SQL);
    }

    public function tambahjabatan($nama_jabatan)
    {
        if (empty($_POST['nama_jabatan'])):
            echo "<script>document.location.href = '../ui/header.php?page=jabatan'</script>";
            die;
        else:
            if (isset($_POST['btnTambahJabatan']) > 0) {
                $nama_jabatan = htmlspecialchars($_POST['nama_jabatan']) ? htmlentities($_POST['nama_jabatan']) : strip_tags($_POST['nama_jabatan']);
                # code jabatan table database
                $table = "jabatan";
                $query = $this->db->query("SELECT * FROM $table WHERE nama_jabatan = '$nama_jabatan'");
                $cek = mysqli_num_rows($query);
                if ($cek) {
                    echo "<script>document.location.href = '../ui/header.php?page=jabatan';</script>";
                    die;
                } else {
                    $insert = "INSERT INTO $table SET nama_jabatan = '$nama_jabatan'";
                    $data = $this->db->query($insert);
                    if ($data != "") {
                        if ($data) {
                            echo "<script>document.location.href = '../ui/header.php?page=jabatan&dialog=success';</script>";
                            die;
                        }
                    } else {
                        echo "<script>document.location.href = '../ui/header.php?page=jabatan';</script>";
                        die;
                    }
                }
            }
        endif;
    }

    public function ubahjabatan($nama_jabatan, $id_jabatan)
    {
        if (isset($_POST['btnEditJabatan']) > 0) {
            $id_jabatan = htmlspecialchars($_POST['id_jabatan']) ? htmlentities($_POST['id_jabatan']) : strip_tags($_POST['id_jabatan']);
            $nama_jabatan = htmlspecialchars($_POST['nama_jabatan']) ? htmlentities($_POST['nama_jabatan']) : strip_tags($_POST['nama_jabatan']);
            # code jabatan table database
            $table = "jabatan";
            $insert = "UPDATE $table SET nama_jabatan = '$nama_jabatan' WHERE id_jabatan = '$id_jabatan'";
            $data = $this->db->query($insert);
            if ($data != "") {
                if ($data) {
                    echo "<script>document.location.href = '../ui/header.php?page=jabatan&dialog=change';</script>";
                    die;
                }
            } else {
                echo "<script>document.location.href = '../ui/header.php?page=jabatan';</script>";
                die;
            }
        }
    }

    public function hapusjabatan($id_jabatan)
    {
        $id_jabatan = htmlspecialchars($_GET['id_jabatan']) ? htmlentities($_GET['id_jabatan']) : strip_tags($_GET['id_jabatan']);
        $table = "jabatan";
        $DELETE = "DELETE FROM $table WHERE id_jabatan = '$id_jabatan'";
        $data = $this->db->query($DELETE);
        if ($data != "") {
            if ($data) {
                echo "<script>document.location.href = '../ui/header.php?page=jabatan&dialog=delete';</script>";
                die;
            }
        } else {
            echo "<script>document.location.href = '../ui/header.php?page=jabatan';</script>";
            die;
        }
    }
}
