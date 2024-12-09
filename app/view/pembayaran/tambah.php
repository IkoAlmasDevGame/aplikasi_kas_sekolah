<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tambah Bulan</title>
    <?php
    if ($_SESSION['id_jabatan'] == '1' || $_SESSION['id_jabatan'] == '3' || $_SESSION['id_jabatan'] == '2') {
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
                <h4 class="panel-title">Dashboard Tambah Bulan</h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=uang_kas" aria-current="page" class="text-decoration-none text-primary">Uang
                            Kas</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=tambah-uang_kas" aria-current="page"
                            class="text-decoration-none active">Tambah Bulan</a>
                    </li>
                </div>
            </div>
            <div class="z-n1 py-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="card-title text-center">Tambah Bulan</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-6 col-md-6">
                                <div class="card-header py-2">
                                    <?php require_once("../pembayaran/function.php") ?>
                                </div>
                                <div class="card-body">
                                    <form action="?aksi=uang_kas-tambah" method="post">
                                        <div class="my-2"></div>
                                        <div class="form-inline row justify-content-start 
                                                align-items-center flex-wrap">
                                            <div class="col-sm-5 col-md-5 fs-5 fw-normal">
                                                <div class="form-label form-check-label">
                                                    <label for="bulan" class="label label-default">Nama
                                                        Bulan</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <select name="nama_bulan" id="bulan" class="form-select">
                                                    <option value="januari">Januari</option>
                                                    <option value="februari">Februari</option>
                                                    <option value="maret">Maret</option>
                                                    <option value="april">April</option>
                                                    <option value="mei">Mei</option>
                                                    <option value="juni">Juni</option>
                                                    <option value="juli">Juli</option>
                                                    <option value="agustus">Agustus</option>
                                                    <option value="september">September</option>
                                                    <option value="november">November</option>
                                                    <option value="desember">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <div class="form-inline row justify-content-start 
                                                align-items-center flex-wrap">
                                            <div class="col-sm-5 col-md-5 fs-5 fw-normal">
                                                <div class="form-label form-check-label">
                                                    <label for="tahun" class="label label-default">Tahun</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <input type="number" readonly id="tahun" aria-required="TRUE"
                                                    name="tahun" value="<?= date('Y'); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <div class="form-inline row justify-content-start 
                                                align-items-center flex-wrap">
                                            <div class="col-sm-5 col-md-5 fs-5 fw-normal">
                                                <div class="form-label form-check-label">
                                                    <label for="pembayaran_perminggu"
                                                        class="label label-default">Pembayaran
                                                        Perminggu</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <input type="number" id="pembayaran_perminggu" aria-required="TRUE"
                                                    name="pembayaran_perminggu" placeholder="Rp."
                                                    class="form-control">
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