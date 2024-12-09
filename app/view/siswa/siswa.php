<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
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
                <h4 class="panel-title">Dashboard Siswa</h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=siswa" aria-current="page" class="text-decoration-none active">Siswa</a>
                    </li>
                </div>
            </div>
            <div class="z-n1 py-3">
                <div class="card mb-4 shadow">
                    <div class="card-header py-4">
                        <h4 class="card-title">Dashboard Siswa</h4>
                        <div class="card-tools">
                            <?php if ($_SESSION['id_jabatan'] == '3' || $_SESSION['id_jabatan'] == '1'): ?>
                                <a href="?aksi=tambah-siswa" aria-current="page" class="btn btn-danger">
                                    <i class="fa fa-fw fa-plus fa-1x"></i>
                                    <span>Tambah Siswa</span>
                                </a>
                            <?php endif; ?>
                            <?php require_once("../siswa/function.php"); ?>
                        </div>
                    </div>
                    <div class="card-body my-2">
                        <div class="container-fluid">
                            <div class="table-responsive-lg">
                                <div class="d-table w-100">
                                    <table class="table table-striped-columns table-bordered table-hover"
                                        id="datatable2">
                                        <thead>
                                            <tr>
                                                <th class="text-center fw-normal">No</th>
                                                <th class="text-center fw-normal">Nama Siswa</th>
                                                <th class="text-center fw-normal">Jenis Kelamin</th>
                                                <th class="text-center fw-normal">No. Telepon</th>
                                                <th class="text-center fw-normal">Email</th>
                                                <?php if ($_SESSION['id_jabatan'] !== '3') : ?>
                                                    <th class="text-center fw-normal">Aksi</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $siswa = $daftar->siswa(); ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($siswa as $isi): ?>
                                                <tr>
                                                    <td class="fs-6 text-center fw-normal"><?php echo $i; ?></td>
                                                    <td class="fs-6 text-start fw-normal">
                                                        <?php echo ucwords(htmlspecialchars_decode($isi['nama_siswa'])) ?>
                                                    </td>
                                                    <td class="fs-6 text-center fw-normal">
                                                        <?php echo ucwords($isi['jenis_kelamin']) ?>
                                                    </td>
                                                    <td class="fs-6 text-center fw-normal">
                                                        <?php echo $isi['no_telepon'] ?>
                                                    </td>
                                                    <td class="fs-6 text-start fw-normal">
                                                        <?php echo $isi['email'] ?>
                                                    </td>
                                                    <td class="text-center fw-normal">
                                                        <?php if ($_SESSION['id_jabatan'] !== '3'): ?>
                                                            <a href="?aksi=edit-siswa&id=<?= $isi['id_siswa'] ?>"
                                                                aria-current="page" class="btn btn-success">
                                                                <i class="fas fa-fw fa-edit"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if ($_SESSION['id_jabatan'] == '1'): ?>
                                                            <a href="?aksi=siswa-hapus&id=<?= $isi['id_siswa'] ?>"
                                                                aria-current="page"
                                                                onclick="return confirm('Apakah anda ingin menghapus data siswa ini ?')"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-fw fa-trash-alt"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>