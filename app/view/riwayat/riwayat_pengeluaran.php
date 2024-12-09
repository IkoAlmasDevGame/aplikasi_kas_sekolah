<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Riwayat Pengeluaran Uang Kas</title>
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
                <h4 class="panel-title">Dashboard Riwayat Pengeluaran Uang Kas</h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=riwayat_pengeluaran" aria-current="page"
                            class="text-decoration-none active">Riwayat Pengeluaran Uang Kas</a>
                    </li>
                </div>
            </div>
            <div class="z-n1 py-2">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h4 class="card-title text-start display-4 fw-normal">
                                    Riwayat Pengeluaran Uang Kas
                                </h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        <table class="table table-striped-columns table-bordered" id="datatable2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center fw-normal">No.</th>
                                                    <th class="text-center fw-normal">Username</th>
                                                    <th class="text-center fw-normal">Pesan</th>
                                                    <th class="text-center fw-normal">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $riwayat_pengeluaran = $kas->riwayat_pengeluaran(); ?>
                                                <?php foreach ($riwayat_pengeluaran as $dr) : ?>
                                                    <tr>
                                                        <td class="text-center fw-normal"><?= $no++; ?></td>
                                                        <td class="text-center fw-normal"><?= $dr['username']; ?></td>
                                                        <td class="text-center fw-normal"><?= $dr['aksi']; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?= date('d-m-Y, H:i:s', $dr['tanggal']); ?>
                                                        </td>
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