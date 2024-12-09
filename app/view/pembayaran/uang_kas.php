<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Uang Kas</title>
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
                <h4 class="panel-title">Dashboard Uang Kas</h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=uang_kas" aria-current="page" class="text-decoration-none active">Uang
                            Kas</a>
                    </li>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg text-start">
                            <h5>Pilih Bulan Pembayaran</h5>
                            <a href="?aksi=tambah-uang_kas" aria-current="page"
                                class="btn btn-primary btn-outline-light">
                                <i class="fas fa-fw fa-plus"></i>
                                <span>Tambah Bulan</span>
                            </a>
                        </div>
                    </div>
                    <div class="my-1"></div>
                    <div class="row">
                        <?php $bulan_pembayaran = mysqli_query($konfigs, "SELECT * FROM bulan_pembayaran ORDER BY tahun ASC"); ?>
                        <?php foreach ($bulan_pembayaran as $dbp): ?>
                            <?php
                            $id_bulan_pembayaran = $dbp['id_bulan_pembayaran'];
                            $total_uang_kas_bulan_ini = mysqli_fetch_assoc($pembayaran->uangkas($id_bulan_pembayaran));
                            $total_uang_kas_bulan_ini = $total_uang_kas_bulan_ini['total_uang_kas_bulan_ini'];
                            ?>
                            <div class="col-lg-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="?page=detail_bulan_pembayaran&id_bulan_pembayaran=<?= $dbp['id_bulan_pembayaran']; ?>"
                                                class="text-dark"><?= ucwords($dbp['nama_bulan']); ?></a>
                                        </h5>
                                        <h6 class="text-muted"><?= $dbp['tahun']; ?></h6>
                                        <h6>Rp. <?= number_format($dbp['pembayaran_perminggu']); ?> / minggu</h6>
                                        <h6>Total Uang Kas Bulan Ini: <span class="my-2 btn btn-success">Rp.
                                                <?= number_format($total_uang_kas_bulan_ini); ?></span>
                                        </h6>
                                        <div class="d-flex justify-content-around align-items-center flex-wrap">
                                            <?php if ($_SESSION['id_jabatan'] !== '3') : ?>
                                                <a href="?aksi=edit-uang_kas&id_bulan_pembayaran=<?= $dbp['id_bulan_pembayaran']; ?>"
                                                    class="btn btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="?page=detail_bulan_pembayaran&id_bulan_pembayaran=<?= $dbp['id_bulan_pembayaran']; ?>"
                                                    class="btn btn-info"><i class="fas fa-fw fa-align-justify"></i>
                                                </a>
                                            <?php endif ?>
                                            <?php if ($_SESSION['id_jabatan'] == '1') : ?>
                                                <a href="?aksi=uang_kas-hapus&id_bulan_pembayaran=<?= $dbp['id_bulan_pembayaran']; ?>"
                                                    class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>