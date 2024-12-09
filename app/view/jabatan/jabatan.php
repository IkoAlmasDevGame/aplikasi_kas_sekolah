<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Jabatan</title>
        <?php
    if ($_SESSION['id_jabatan'] == '1') {
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
                    <h4 class="panel-title">Dashboard Jabatan</h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page"
                                class="text-decoration-none text-primary">Beranda</a>
                        </li>
                        <?php if (isset($_GET['id_jabatan'])): ?>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=jabatan" aria-current="page"
                                class="text-decoration-none text-primary">Jabatan</a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=jabatan&id_jabatan=<?= $_GET['id_jabatan'] ?>" aria-current="page"
                                class="text-decoration-none active">Jabatan [Edit]</a>
                        </li>
                        <?php else: ?>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=jabatan" aria-current="page" class="text-decoration-none active">Jabatan</a>
                        </li>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="z-n1 py-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-1">
                            <h4 class="card-title display-4 fw-normal">Dashboard Jabatan</h4>
                            <div class="card-tools">
                                <?php require_once("../jabatan/function.php"); ?>
                                <?php if (isset($_GET['id_jabatan'])): ?>
                                <?php $data = $konfigs->query("SELECT * FROM jabatan WHERE id_jabatan = '$_GET[id_jabatan]'"); ?>
                                <?php foreach ($data as $isi): ?>
                                <form action="?aksi=jabatan-ubah" method="post">
                                    <input type="hidden" name="id_jabatan" value="<?= $isi['id_jabatan'] ?>">
                                    <div class="form-group">
                                        <div class="form-inline row justify-content-start 
                                        align-items-start flex-wrap">
                                            <div class="col-sm-2 col-md-2">
                                                <label for="nama_jabatan" class="form-label label label-default">Nama
                                                    Jabatan</label>
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <input type="text" name="nama_jabatan"
                                                    value="<?= $isi['nama_jabatan'] ?>" id="nama_jabatan"
                                                    class="form-control" aria-required="TRUE">
                                                <div class="my-1"></div>
                                                <div class="text-start">
                                                    <button type="submit" name="btnEditJabatan" class="btn btn-primary">
                                                        <i class="fas fa-save fa-fw fw-1x"></i>
                                                        Update Data
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <form action="?aksi=jabatan-tambah" method="post">
                                    <div class="form-group">
                                        <div class="form-inline row justify-content-start 
                                        align-items-start flex-wrap">
                                            <div class="col-sm-2 col-md-2">
                                                <label for="nama_jabatan" class="form-label label label-default">Nama
                                                    Jabatan</label>
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <input type="text" name="nama_jabatan"
                                                    placeholder="masukkan jabatan baru disini ..." id="nama_jabatan"
                                                    class="form-control" aria-required="TRUE">
                                                <div class="my-1"></div>
                                                <div class="text-start">
                                                    <button type="submit" name="btnTambahJabatan"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-save fa-fw fw-1x"></i>
                                                        Simpan Data
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body my-2">
                            <div class="container-fluid">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped-columns" id="datatable2">
                                        <thead>
                                            <tr>
                                                <th class="text-center fw-normal">No</th>
                                                <th class="text-center fw-normal">Nama Jabatan</th>
                                                <th class="text-center fw-normal">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php $jabatan = $jabatan->jabatan(); ?>
                                            <?php foreach ($jabatan as $data): ?>
                                            <tr>
                                                <td class="text-center fw-normal"><?php echo $no; ?></td>
                                                <td class="text-center fw-normal">
                                                    <?php echo $data['nama_jabatan']; ?>
                                                </td>
                                                <td class="text-center fw-normal">
                                                    <a href="?page=jabatan&id_jabatan=<?= $data['id_jabatan'] ?>"
                                                        aria-current="page" class="btn btn-danger">
                                                        <i class="fas fa-edit fa-fw fa-1x"></i>
                                                    </a>
                                                    <a href="?aksi=jabatan-hapus&id_jabatan=<?=$data['id_jabatan']?>"
                                                        aria-current="page"
                                                        onclick="return confirm('Apakah anda ingin menghapus data jabatan ini.')"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-trash fa-fw fa-1x"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
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
        <?php require_once("../ui/footer.php") ?>