<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once("../config/config.php"); ?>
        <?php $data = mysqli_query($konfigs, "SELECT * FROM setting WHERE status_website = '1'")->fetch_array(); ?>
        <title>register - <?php echo $data['nama_website'] ?> - </title>
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

    <body onload="startTimes()">
        <!-- === Layout Awal Dashboard -->
        <div class="navbar navbar-expand-lg bg-body-secondary position-sticky sticky-sm-bottom">
            <div class="container-fluid">
                <a href="../view/register.php" class="navbar-brand fs-6 text-start text-dark">Register
                    <?php echo ucwords(ucfirst($data['nama_website'])) ?> </a>
                <button class='navbar-toggler' data-bs-toggle='collapse' data-bs-target='#navbarSupportNavigation'>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <!-- === Body Awal Layout -->
        <div class="container-fluid mt-4 pt-5">
            <div class="d-flex justify-content-center align-items-center flex-wrap mt-1 pt-1">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h4 class="card-title text-center">Register
                            <?php echo ucwords(ucfirst($data['nama_website'])) ?>
                        </h4>
                    </div>
                    <div class="card-body mt-1">
                        <?php require_once("../controller/controller.php"); ?>
                        <?php require_once("../model/registerasi.php"); ?>
                        <?php
                    $signup = new controller\registeration($konfigs);
                    if (!isset($_GET['aksi'])) {
                    } else {
                        switch ($_GET['aksi']) {
                            case 'Sign-Up':
                                $signup->signup();
                                break;

                            default:
                                require_once("../controller/controller.php");
                                break;
                        }
                    }
                    ?>
                        <form action="?aksi=Sign-Up" method="post">
                            <div class="form-group">
                                <div class="form-inline row justify-content-center
                                 align-items-start flex-wrap">
                                    <div class="col-sm-4 col-md-4 fw-normal text-dark">
                                        <label for="" class="form-label label label-default">
                                            <?php echo ucwords(ucfirst("nama lengkap")); ?></label>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <input type="text" name="nama_lengkap" maxlength="100" class="form-control"
                                            id="" aria-required="TRUE" placeholder="masukkan nama lengkap anda ...">
                                    </div>
                                </div>
                                <div class="my-1"></div>
                                <div class="form-inline row justify-content-center
                                 align-items-start flex-wrap">
                                    <div class="col-sm-4 col-md-4 fw-normal text-dark">
                                        <label for="" class="form-label label label-default">
                                            <?php echo ucwords(ucfirst("username")); ?></label>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <input type="text" name="username" maxlength="100" class="form-control" id=""
                                            aria-required="TRUE" placeholder="masukkan username baru ...">
                                    </div>
                                </div>
                                <div class="my-1"></div>
                                <div class="form-inline row justify-content-center
                                 align-items-start flex-wrap">
                                    <div class="col-sm-4 col-md-4 fw-normal text-dark">
                                        <label for="" class="form-label label label-default">
                                            <?php echo ucwords(ucfirst("password")); ?></label>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <input type="password" name="password" maxlength="255" class="form-control"
                                            id="" aria-required="TRUE" placeholder="masukkan password baru ...">
                                    </div>
                                </div>
                                <div class="my-1"></div>
                                <div class="form-inline row justify-content-center
                                 align-items-start flex-wrap">
                                    <div class="col-sm-4 col-md-4 fw-normal text-dark">
                                        <label for="" class="form-label label label-default">
                                            <?php echo ucwords(ucfirst("Jabatan")); ?></label>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <select name="id_jabatan" class="form-select" id="">
                                            <option value="">Pilih Jabatan</option>
                                            <?php
                                        $id = mysqli_query($konfigs, "SELECT * FROM jabatan");
                                        while ($d_jabatan = $id->fetch_array()) {
                                            extract($d_jabatan);
                                        ?>
                                            <option value="<?= $id_jabatan ?>"><?php echo $nama_jabatan ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="my-1"></div>
                            </div>
                            <div class="card-footer m-1">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-outline-light">
                                        <i class="fa fa-save fa-1x"></i>
                                        <span>Simpan</span>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-outline-light">
                                        <i class="fa fa-eraser fa-1x"></i>
                                        <span>Hapus</span>
                                    </button>
                                    <p class="text-dark fs-6 fw-normal">Apakah anda sudah mempunyai akun,
                                        <a href="../view/index.php" aria-current="page"
                                            class="text-decoration-underline text-primary">Login</a>
                                    </p>
                                </div>
                                <div class="container-fluid mt-4 p-1">
                                    <footer class="footer">
                                        <p id="year" class="text-center"></p>
                                    </footer>
                                </div>
                            </div>
                        </form>
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
        function startTimes() {
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
            var t = setTimeout(startTimes, 500);
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