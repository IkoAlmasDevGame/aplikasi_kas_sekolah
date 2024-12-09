<?php

namespace model;

class profile
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function userProfile()
    {
        $SQL = "SELECT * FROM user inner join jabatan on user.id_jabatan = jabatan.id_jabatan order by user.id_user asc";
        return $this->db->query($SQL);
    }

    public function profile($nama, $username, $id_jabatan, $id)
    {
        $id = htmlspecialchars($_POST['id_user']);
        $nama = htmlspecialchars($_POST['nama_lengkap']);
        $username = htmlspecialchars($_POST['username']);
        $id_jabatan = htmlspecialchars($_POST['id_jabatan']);
        # code user editing profile ...
        $table = "user";
        $updateProfile = "UPDATE $table SET nama_lengkap = '$nama', username = '$username', id_jabatan = '$id_jabatan' WHERE id_user = '$id'";
        $data = $this->db->query($updateProfile);
        if ($data != "") {
            if ($data) {
                echo "<script>document.location.href = '../ui/header.php?page=profile&id_user=$id&data=$id&dialog=change_data';</script>";
                die;
            }
        } else {
            echo "<script>document.location.href = '../ui/header.php?page=profile&id_user=$id&data=$id';</script>";
            die;
        }
    }

    public function changepassword($new_password, $id)
    {
        $new_password = md5(htmlspecialchars($_POST['new_password']), false);
        $old_password = md5(htmlspecialchars($_POST['old_password']), false);
        $new_password_verify = md5(htmlspecialchars($_POST['new_password_verify']), false);
        $id = htmlspecialchars($_POST['id_user']);
        # table cek password
        $table = "user";
        $data = $this->db->query("SELECT * FROM $table WHERE id_user = '$id'");
        $cekpassword = mysqli_fetch_array($data);
        # data update password

        if (password_verify($old_password, PASSWORD_DEFAULT) == md5($cekpassword['password'], false)) {
            echo "<script>document.location.href = '../ui/header.php?page=profile&id_user=$id&change=$id';</script>";
            die;
        }

        if ($new_password == $new_password_verify) {
            $SQL = "UPDATE $table SET password = '$new_password' WHERE id_user = '$id'";
            $queryz = $this->db->query($SQL);
            if ($queryz != "") {
                if ($queryz) {
                    echo "<script>document.location.href = '../ui/header.php?page=profile&id_user=$id&change=$id&dialog=change_password';</script>";
                    die;
                }
            } else {
                echo "<script>document.location.href = '../ui/header.php?page=profile&id_user=$id&change=$id';</script>";
                die;
            }
        }
    }
}