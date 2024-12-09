<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Edit Bulan</title>
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
                            <a href="?aksi=edit-uang_kas&id_bulan_pembayaran=<?= $_GET['id_bulan_pembayaran'] ?>"
                                aria-current="page" class="text-decoration-none active">Edit Bulan</a>
                        </li>
                    </div>
                </div>
                <div class="z-n1 py-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="card-title text-center">Edit Bulan</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="card col-sm-6 col-md-6">
                                    <div class="card-header py-2">
                                        <?php require_once("../pembayaran/function.php") ?>
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['id_bulan_pembayaran'])): ?>
                                        <?php $SQL = "SELECT * FROM bulan_pembayaran WHERE id_bulan_pembayaran = '$_GET[id_bulan_pembayaran]'"; ?>
                                        <?php $Query = $konfigs->query($SQL); ?>
                                        <?php foreach ($Query as $isi): ?>
                                        <form action="?aksi=uang_kas-edit" method="post">
                                            <input type="hidden" name="id_bulan_pembayaran"
                                                value="<?= $isi['id_bulan_pembayaran'] ?>">
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
                                                        <option <?php if ($isi['nama_bulan'] == "januari") { ?> selected
                                                            <?php } ?> value="januari">Januari</option>
                                                        <option <?php if ($isi['nama_bulan'] == "februari") { ?>
                                                            selected <?php } ?> value="februari">Februari</option>
                                                        <option <?php if ($isi['nama_bulan'] == "maret") { ?> selected
                                                            <?php } ?> value="maret">Maret</option>
                                                        <option <?php if ($isi['nama_bulan'] == "april") { ?> selected
                                                            <?php } ?> value="april">April</option>
                                                        <option <?php if ($isi['nama_bulan'] == "mei") { ?> selected
                                                            <?php } ?> value="mei">Mei</option>
                                                        <option <?php if ($isi['nama_bulan'] == "juni") { ?> selected
                                                            <?php } ?> value="juni">Juni</option>
                                                        <option <?php if ($isi['nama_bulan'] == "juli") { ?> selected
                                                            <?php } ?> value="juli">Juli</option>
                                                        <option <?php if ($isi['nama_bulan'] == "agustus") { ?> selected
                                                            <?php } ?> value="agustus">Agustus</option>
                                                        <option <?php if ($isi['nama_bulan'] == "september") { ?>
                                                            selected <?php } ?> value="september">September</option>
                                                        <option <?php if ($isi['nama_bulan'] == "november") { ?>
                                                            selected <?php } ?> value="november">November</option>
                                                        <option <?php if ($isi['nama_bulan'] == "desember") { ?>
                                                            selected <?php } ?> value="desember">Desember</option>
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
                                                        name="tahun" value="<?= $isi['tahun'] ?>" class="form-control">
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
                                                        name="pembayaran_perminggu"
                                                        value="<?= $isi['pembayaran_perminggu'] ?>" placeholder="Rp."
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="my-2"></div>
                                            <div class="card-footer text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-fw fa-save"></i>
                                                    Update
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
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>