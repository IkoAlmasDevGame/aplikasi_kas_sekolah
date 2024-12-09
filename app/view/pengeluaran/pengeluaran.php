<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengeluaran Uang Kas</title>
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
                <h4 class="panel-title">Dashboard Pengeluaran Uang Kas</h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=pengeluaran" aria-current="page"
                            class="text-decoration-none active">Pengeluaran Uang Kas</a>
                    </li>
                </div>
            </div>
            <div class="z-n1 py-1">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                                <h4 class="card-title text-start display-4 fw-normal">
                                    Pengeluaran Uang Kas
                                </h4>
                                <div class="card-tools">
                                    <div class="text-start">
                                        <?php if ($_SESSION['id_jabatan'] !== '3'): ?>
                                            <a href="?aksi=tambah-pengeluaran" aria-current="page"
                                                class="btn btn-danger">
                                                <i class="fa fa-fw fa-plus fa-1x"></i>
                                                <span>Tambah pengeluaran</span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php require_once("../pengeluaran/function.php"); ?>
                            </div>
                            <div class="card-body my-2">
                                <div class="table-responsive">
                                    <div class="container-fluid">
                                        <table class="table table-striped-columns table-bordered" id="datatable2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center fw-normal">No.</th>
                                                    <th class="text-center fw-normal">Username</th>
                                                    <th class="text-center fw-normal">Keterangan</th>
                                                    <th class="text-center fw-normal">Tanggal Pengeluaran</th>
                                                    <th class="text-center fw-normal">Jumlah Pengeluaran</th>
                                                    <?php if ($_SESSION['id_jabatan'] !== '3') : ?>
                                                        <th class="text-center fw-normal">Aksi</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $pengeluaran = $pengeluaran->pengeluaran(); ?>
                                                <?php foreach ($pengeluaran as $dp): ?>
                                                    <tr>
                                                        <td class="text-center fw-normal"><?= $no++; ?></td>
                                                        <td class="text-center fw-normal"><?= $dp['username']; ?></td>
                                                        <td class="text-center fw-normal"><?= $dp['keterangan']; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?= date("d-m-Y, H:i:s", $dp['tanggal_pengeluaran']); ?>
                                                        </td>
                                                        <td class="text-center fw-normal">Rp.
                                                            <?= number_format($dp['jumlah_pengeluaran']); ?>
                                                        </td>
                                                        <?php if ($_SESSION['id_jabatan'] !== '3'): ?>
                                                            <td class="text-center">
                                                                <a href="?aksi=edit-pengeluaran&id_pengeluaran=<?= $dp['id_pengeluaran'] ?>"
                                                                    aria-current="page" class="btn btn-warning">
                                                                    <i class="fas fa-fw fa-edit"></i>
                                                                </a>
                                                                <?php if ($_SESSION['id_jabatan'] == '1'): ?>
                                                                    <a href="?aksi=pengeluaran-hapus&id_pengeluaran=<?= $dp['id_pengeluaran'] ?>&tanggal=<?= $dp['tanggal'] ?>"
                                                                        aria-current="page"
                                                                        onclick="return confirm('Apakah anda ingin menghapus data pengeluaran ini.')"
                                                                        class="btn btn-danger">
                                                                        <i class="fas fa-fw fa-trash"></i>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>