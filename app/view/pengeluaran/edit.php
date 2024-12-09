<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Edit Pengeluaran Uang Kas</title>
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
                <h4 class="panel-title">Dashboard Edit Pengeluaran Uang Kas</h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=pengeluaran" aria-current="page"
                            class="text-decoration-none text-primary">Pengeluaran Uang Kas</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=edit-pengeluaran&id_pengeluaran=<?= $_GET['id_pengeluaran'] ?>"
                            aria-current="page" class="text-decoration-none active">Edit
                            Pengeluaran Uang Kas</a>
                    </li>
                </div>
            </div>
            <div class="z-n1 py-2">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                                <h4 class="card-title text-center fw-normal">Edit Pengeluaran Uang Kas</h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="d-flex justify-content-center align-items-center flex-wrap">
                                    <div class="card col-sm-8 col-md-8">
                                        <div class="card-header py-1">
                                            <?php require_once("../pengeluaran/function.php") ?>
                                        </div>
                                        <div class="card-body my-2">
                                            <?php if (isset($_GET['id_pengeluaran'])): ?>
                                                <?php $Query = $konfigs->query("SELECT * FROM pengeluaran inner join riwayat_pengeluaran on pengeluaran.id_user = riwayat_pengeluaran.id_user 
                                                WHERE id_pengeluaran = '$_GET[id_pengeluaran]'"); ?>
                                                <?php foreach ($Query as $isi): ?>
                                                    <form action="?aksi=pengeluaran-edit" method="post">
                                                        <input type="hidden" name="id_pengeluaran"
                                                            value="<?= $isi['id_pengeluaran'] ?>">
                                                        <input type="hidden" name="id_riwayat_pengeluaran"
                                                            value="<?= $isi['id_riwayat_pengeluaran'] ?>">
                                                        <input type="hidden" name="id_user" value="<?= $_SESSION['id'] ?>">
                                                        <div class="form-group">
                                                            <div class="my-1"></div>
                                                            <div class="form-inline row justify-content-center
                                                         align-items-center flex-wrap">
                                                                <div class="cols-m-4 col-md-4">
                                                                    <div class="form-label fw-normal">
                                                                        <label
                                                                            for="jumlah_pengeluaran<?= $isi['id_pengeluaran'] ?>"
                                                                            class="label label-default">Jumlah
                                                                            Pengeluaran</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-md-6">
                                                                    <input type="number" aria-required="TRUE"
                                                                        class="form-control"
                                                                        value="<?= $isi['jumlah_pengeluaran'] ?>"
                                                                        placeholder="Rp." name="jumlah_pengeluaran"
                                                                        id="jumlah_pengeluaran<?= $isi['id_pengeluaran'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="my-1"></div>
                                                            <div class="form-inline row justify-content-center
                                                         align-items-start flex-wrap">
                                                                <div class="cols-m-4 col-md-4">
                                                                    <div class="form-label fw-normal">
                                                                        <label for="keterangan<?= $isi['id_pengeluaran'] ?>"
                                                                            class="label label-default">Keterangan</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-md-6">
                                                                    <textarea name="keterangan" class="form-control"
                                                                        aria-required="TRUE" cols="3" rows="3"
                                                                        maxlength="255"
                                                                        id="keterangan<?= $isi['id_pengeluaran'] ?>"
                                                                        placeholder="keterangan pengeluaran uang kas ..."><?= $isi['keterangan'] ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="my-1"></div>
                                                            <div class="card-footer">
                                                                <div class="text-center">
                                                                    <a type="button" class="btn btn-danger"
                                                                        href="?page=pengeluaran">
                                                                        <i class="fas fa-fw fa-times"></i> Close</a>
                                                                    <button type="submit" name="btnEditPengeluaran"
                                                                        class="btn btn-primary"><i
                                                                            class="fas fa-fw fa-save"></i> Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
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