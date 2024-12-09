<?php

namespace model;

class authentication
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function LoginAuth($userInput, $passInput)
    {
        session_start();
        if (empty($_POST['userInput']) || empty($_POST['password'])):
            echo "<script>document.location.href = 'error/error-msg.php?HttpStatus=401'</script>";
            die;
        else:
            $userInput = htmlspecialchars($_POST['userInput']) ? htmlentities($_POST['userInput']) : $_POST['userInput'];
            $passInput = htmlspecialchars(md5($_POST['password'], false));
            password_verify($passInput, PASSWORD_DEFAULT);
            # table database
            $table = "user";
            $SQL = "SELECT * FROM $table WHERE username = '$userInput' and password = '$passInput'";
            $Query = $this->db->query($SQL);
            # Capthca
            $hasil = $_POST['angka1'] + $_POST['angka2'];
            $cek = mysqli_num_rows($Query);
            if ($cek > 0) {
                $response = array($userInput, $passInput);
                $response[$table] = array($userInput, $passInput);
                if ($row = $Query->fetch_assoc()) {
                    if ($row['id_jabatan'] == "1") {
                        $_SESSION['status'] = true;
                        $_SESSION['id'] = $row['id_user'];
                        $_SESSION['nama'] = $row['nama_lengkap'];
                        $_SESSION['username'] = $row['username'];
                        if ($hasil == $_POST['hasil']) {
                            $_SESSION['id_jabatan'] = "1";
                            echo "<script>document.location.href = 'error/error-msg.php?HttpStatus=200';</script>";
                            die;
                        } else {
                            unset($_POST['hasil']);
                            $_SESSION['status'] = false;
                            echo "<script>document.location.href = '../view/index.php';</script>";
                            die;
                        }
                    } elseif ($row['id_jabatan'] == "2") {
                        $_SESSION['status'] = true;
                        $_SESSION['id'] = $row['id_user'];
                        $_SESSION['nama'] = $row['nama_lengkap'];
                        $_SESSION['username'] = $row['username'];
                        if ($hasil == $_POST['hasil']) {
                            $_SESSION['id_jabatan'] = "2";
                            echo "<script>document.location.href = 'error/error-msg.php?HttpStatus=200';</script>";
                            die;
                        } else {
                            unset($_POST['hasil']);
                            $_SESSION['status'] = false;
                            echo "<script>document.location.href = '../view/index.php';</script>";
                            die;
                        }
                    } elseif ($row['id_jabatan'] == "3") {
                        $_SESSION['status'] = true;
                        $_SESSION['id'] = $row['id_user'];
                        $_SESSION['nama'] = $row['nama_lengkap'];
                        $_SESSION['username'] = $row['username'];
                        if ($hasil == $_POST['hasil']) {
                            $_SESSION['id_jabatan'] = "3";
                            echo "<script>document.location.href = 'error/error-msg.php?HttpStatus=200';</script>";
                            die;
                        } else {
                            unset($_POST['hasil']);
                            $_SESSION['status'] = false;
                            echo "<script>document.location.href = '../view/index.php';</script>";
                            die;
                        }
                    }
                    $_COOKIE['cookies'] = $userInput;
                    $_SERVER['HTTPS'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        echo "<script>document.location.href = 'error/error-msg.php?HttpStatus=400';</script>";
                        die;
                    }
                    if ($HttpStatus == 403) {
                        echo "<script>document.location.href = 'error/error-msg.php?HttpStatus=403';</script>";
                        die;
                    }
                    if ($HttpStatus == 500) {
                        echo "<script>document.location.href = 'error/error-msg.php?HttpStatus=500';</script>";
                        die;
                    }
                    setcookie($response[$table], $row, time() + (86400 * 30), "/");
                    array_push($response[$table], $row);
                    die;
                    exit;
                }
            } else {
                unset($_POST['hasil']);
                $_SESSION['status'] = false;
                $_SERVER['HTTPS'] = "off";
                echo "<script>document.location.href = '../view/index.php';</script>";
                die;
            }
        endif;
    }
}
