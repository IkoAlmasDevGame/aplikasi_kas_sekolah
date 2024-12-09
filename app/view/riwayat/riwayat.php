<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Riwayat Uang Kas</title>
    <?php
    if ($_SESSION['id_jabatan'] == '1' || $_SESSION['id_jabatan'] == '3' || $_SESSION['id_jabatan'] == '2') {
        require_once("../ui/header.php");
        $riwayat = $kas->riwayat();
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
                <h4 class="panel-title">Dashboard Riwayat Uang Kas</h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=riwayat" aria-current="page" class="text-decoration-none active">Riwayat Uang
                            Kas</a>
                    </li>
                </div>
            </div>
            <div class="z-n1 py-2">
                <div class="content">
                    <section class="content-wrapper">
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                                <h4 class="card-title fs-5 text-dark display-5 fw-semibold">Riwayat Uang Kas</h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="datatable2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center fw-normal">No.</th>
                                                    <th class="text-center fw-normal">Nama Siswa</th>
                                                    <th class="text-center fw-normal">Nama Bulan & Tahun</th>
                                                    <th class="text-center fw-normal">Username</th>
                                                    <th class="text-center fw-normal">Pesan</th>
                                                    <th class="text-center fw-normal">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($riwayat as $dr): ?>
                                                    <tr>
                                                        <td class="text-center fw-normal"><?php echo $no++; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?= ucwords($dr['nama_siswa']); ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?= ucwords($dr['nama_bulan']); ?> | <?= $dr['tahun']; ?>
                                                        </td>
                                                        <td class="text-center fw-normal"><?= $dr['username']; ?></td>
                                                        <td class="text-start fw-normal"><?= $dr['aksi']; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?= date('d-m-Y, H:i:s', $dr['tanggal']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>