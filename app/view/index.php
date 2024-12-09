<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("../config/config.php"); ?>
    <?php $data = mysqli_query($konfigs, "SELECT * FROM setting WHERE status_website = '1'")->fetch_array(); ?>
    <title>Login - <?php echo $data['nama_website'] ?> - </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        media="all">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman';
            font-weight: 300;
            font-size: 16px;
            font-style: normal;
        }

        body {
            background: rgba(125, 144, 133, 0.722);
        }

        .card {
            width: 550px;
        }

        @media (max-width:720px) {
            .card {
                max-width: 100%;
            }
        }
    </style>
</head>

<body onload="startTime()">
    <!-- === Layout Awal Dashboard -->
    <div class="navbar navbar-expand-lg bg-body-secondary position-sticky sticky-sm-bottom">
        <div class="container-fluid">
            <a href="../view/index.php" class="navbar-brand fs-6 text-start text-dark">Login
                <?php echo ucwords(ucfirst($data['nama_website'])) ?> </a>
            <button class='navbar-toggler' data-bs-toggle='collapse' data-bs-target='#navbarSupportNavigation'>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    <!-- === Layout Akhir Dashboard -->
    <!-- === Body Awal Layout -->
    <div class="container-fluid mt-4 pt-5">
        <div class="d-flex justify-content-center align-items-center flex-wrap mt-1 pt-1">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title text-center">
                        Login <?php echo ucwords(ucfirst($data['nama_website'])) ?>
                    </h4>
                </div>
                <div class="card-body mt-1">
                    <!-- Layout Form -->
                    <?php require_once("../model/authentication.php"); ?>
                    <?php require_once("../controller/controller.php"); ?>
                    <?php require_once("../function/function.php"); ?>
                    <?php
                    $login = new controller\AuthLogin($konfigs);
                    if (!isset($_GET['aksi'])):
                    else:
                        switch ($_GET['aksi']) {
                            case 'Sign-In':
                                $login->signin();
                                break;

                            default:
                                # code...
                                break;
                        }
                    endif;
                    ?>
                    <form action="?aksi=Sign-In" method="post">
                        <div class="form-group">
                            <div class="form-inline row justify-content-center
                                     align-items-center flex-wrap mb-1 mt-1">
                                <div class="form-label col-sm-2 col-md-3">
                                    <label for="user" class="label label-default">User Input</label>
                                </div>
                                <div class="col-sm-8 col-md-9">
                                    <input type="text" name="userInput" aria-required="TRUE" class="form-control"
                                        placeholder="masukkan username atau email anda ..." id="user">
                                </div>
                            </div>
                            <div class="form-inline row justify-content-center
                                 align-items-center flex-wrap mb-1 mt-1">
                                <div class="form-label col-sm-2 col-md-3">
                                    <label for="pass" class="label label-default">Kata Sandi</label>
                                </div>
                                <div class="col-sm-8 col-md-9">
                                    <input type="password" name="password" aria-required="TRUE" class="form-control"
                                        placeholder="masukkan kata sandi anda ..." id="pass">
                                </div>
                            </div>
                            <div class="form-inline row justify-content-start
                                 align-items-start flex-wrap mb-1 mt-1">
                                <div class="form-label col-sm-3 col-md-3">
                                    <input type="hidden" name="angka1" value="<?= $angka1 ?>">
                                    <input type="hidden" name="angka2" value="<?= $angka2 ?>">
                                    <label for="" class="label label-default">
                                        <?php echo $angka1 . " + " . $angka2; ?> = ?</label>
                                </div>
                                <div class="col-sm-5 col-md-5">
                                    <input type="number" class="form-control" aria-required="TRUE" name="hasil"
                                        placeholder="Capthca">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer m-1">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-outline-light">
                                    <i class="fa fa-sign-in-alt fa-1x"></i>
                                    <span>Sign In</span>
                                </button>
                                <button type="reset" class="btn btn-danger btn-outline-light">
                                    <i class="fa fa-eraser fa-1x"></i>
                                    <span>Hapus</span>
                                </button>
                                <p class="text-dark fs-6 fw-normal">Apakah anda belum mempunyai akun,
                                    <a href="../view/register.php" aria-current="page"
                                        class="text-decoration-underline text-primary">Register</a>
                                </p>
                            </div>
                            <div class="container-fluid mt-4 p-1">
                                <footer class="footer">
                                    <p id="year" class="text-center"></p>
                                </footer>
                            </div>
                        </div>
                    </form>
                    <!-- Layout Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- === Body Akhir Layout -->
    <!-- === Layout Akhir Dashboard -->
    <!-- === Layout Awal Script -->
    <script crossorigin="anonymous" lang="javascript"
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
    <script crossorigin="anonymous" lang="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    </script>
    <script crossorigin="anonymous" lang="javascript"
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
    </script>
    <script type="text/javascript">
        function startTime() {
            var day = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];
            var today = new Date();
            var h = today.getHours();
            var tahun = today.getFullYear();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('year').innerHTML =
                "&copy <?= $data['nama_pemilik'] ?>, " + tahun + "<br>" + day[today.getDay()] + ", " + h +
                " : " +
                m +
                " : " + s;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
    </script>
    <!-- === Layout Akhir Script -->
</body>

</html>