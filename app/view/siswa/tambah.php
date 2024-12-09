<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Tambah Siswa</title>
        <?php
    if ($_SESSION['id_jabatan'] == '1' || $_SESSION['id_jabatan'] == '3') {
        require_once("../ui/header.php");
    } else {
        echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
        die;
        exit(0);
    }
    ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="panel panel-default bg-body-secondary rounded-2 py-4">
            <div class="panel-body container-fluid">
                <div class="panel-heading">
                    <h4 class="panel-title">Dashboard Siswa</h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page"
                                class="text-decoration-none text-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=siswa" aria-current="page"
                                class="text-decoration-none text-primary">Siswa</a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=tambah-siswa" aria-current="page" class="text-decoration-none active">Tambah
                                Siswa</a>
                        </li>
                    </div>
                </div>
                <div class="container">
                    <div class="card shadow">
                        <div class="card-header py-2">
                            <h4 class="card-title text-center">Dashboard Tambah Siswa</h4>
                        </div>
                        <div class="card-body my-2">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="card col-sm-8 col-md-8">
                                    <div class="card-header py-2">
                                        <?php require_once("../siswa/function.php"); ?>
                                    </div>
                                    <div class="card-body">
                                        <form action="?aksi=siswa-tambah" method="post">
                                            <div class="form-inline row justify-content-start 
                                                align-items-center flex-wrap">
                                                <div class="col-sm-5 col-md-5 fs-5 fw-normal">
                                                    <div class="form-label form-check-label">
                                                        <label for="namasiswa" class="label label-default">Nama
                                                            Siswa</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="nama_siswa" aria-required="TRUE"
                                                        class="form-control" maxlength="100" id="namasiswa">
                                                </div>
                                            </div>
                                            <div class="my-2"></div>
                                            <div class="form-inline row justify-content-start 
                                                align-items-center flex-wrap">
                                                <div class="col-sm-5 col-md-5 fs-5 fw-normal">
                                                    <div class="form-label form-check-label">
                                                        <label for="jeniskelamin" class="label label-default">Jenis
                                                            Kelamin</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 ">
                                                    <select name="jenis_kelamin" class="form-select form-control" id=""
                                                        aria-required="TRUE">
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="Pria">Pria</option>
                                                        <option value="Wanita">Wanita</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="my-2"></div>
                                            <div class="form-inline row justify-content-start 
                                                align-items-center flex-wrap">
                                                <div class="col-sm-5 col-md-5 fs-5 fw-normal">
                                                    <div class="form-label form-check-label">
                                                        <label for="telepon" class="label label-default">Nomor
                                                            Telepon</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="no_telepon" aria-required="TRUE"
                                                        class="form-control" maxlength="25" id="telepon">
                                                </div>
                                            </div>
                                            <div class="my-2"></div>
                                            <div class="form-inline row justify-content-start 
                                                align-items-center flex-wrap">
                                                <div class="col-sm-5 col-md-5 fs-5 fw-normal">
                                                    <div class="form-label form-check-label">
                                                        <label for="email" class="label label-default">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="email" name="email" aria-required="TRUE"
                                                        class="form-control" maxlength="255" id="email">
                                                </div>
                                            </div>
                                            <div class="my-2"></div>
                                            <div class="card-footer text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-fw fa-save"></i>
                                                    Save
                                                </button>
                                                <button type="reset" class="btn btn-danger">
                                                    <i class="fas fa-fw fa-eraser"></i>
                                                    Hapus Semua
                                                </button>
                                                <br>
                                                <p class="text-center fs-5">
                                                    <?php $pemilik = $konfigs->query("SELECT * FROM setting WHERE status_website = '1'")->fetch_array(); ?>
                                                    <br>
                                                    <?php echo "&copy; " . ucwords(htmlspecialchars_decode($pemilik['nama_pemilik'])) ?>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>