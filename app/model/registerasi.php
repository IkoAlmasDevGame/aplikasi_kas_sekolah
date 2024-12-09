<?php

namespace model;

class registerasi
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function register($nama, $username, $password, $jabatan)
    {
        if (empty($_POST['nama_lengkap']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['id_jabatan'])) {
            echo "<script>
            document.location.href = '../view/register.php';
            alert('maaf anda belum isi formulir register uang kas sekolah.');
            </script>";
            die;
        } else {
            $nama = htmlspecialchars($_POST['nama_lengkap']) ? htmlentities($_POST['nama_lengkap']) : strip_tags($_POST['nama_lengkap']);
            $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
            $password = htmlspecialchars(md5($_POST['password'], false));
            $jabatan = htmlspecialchars($_POST['id_jabatan']) ? htmlentities($_POST['id_jabatan']) : strip_tags($_POST['id_jabatan']);
            # table database ...
            $table = "user";
            $SQL = "SELECT * FROM $table WHERE username = '$username' order by username desc";
            $Query = $this->db->query($SQL);
            $cek = mysqli_num_rows($Query);

            if ($cek) {
                echo "<script>
                document.location.href = '../view/register.php';
                alert('username : $username ini sudah ada, coba anda membuat username baru lagi ...');
                </script>";
                die;
            } else {
                $InsertSQL = "INSERT INTO $table SET nama_lengkap='$nama', username='$username', password='$password', id_jabatan='$jabatan'";
                $data = $this->db->query($InsertSQL);
                if ($data != "") {
                    if ($data) {
                        echo "<script>
                        document.location.href = '../view/index.php';
                        alert('selamat anda berhasil membuat akun uang kas sekolah baru.');
                        </script>";
                        die;
                    }
                } else {
                    echo "<script>
                    document.location.href = '../view/register.php';
                    alert('anda telah gagal membuat akun uang kas sekolah.');
                    </script>";
                    die;
                }
            }
        }
    }
}
