<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Profile Website</title>
    <?php
    if ($_SESSION['id_jabatan'] == '1') {
        require_once("../ui/header.php");
        if (isset($_POST['btnEditSetting'])) {
            $nama_pemilik = htmlspecialchars($_POST['nama_pemilik']);
            $nama_website = htmlspecialchars($_POST['nama_website']);
            $status_website = htmlspecialchars($_POST['status_website']);
            $update = "UPDATE setting SET nama_pemilik='$nama_pemilik', nama_website='$nama_website', status_website='$status_website' WHERE id_setting = '$_POST[id_setting]'";
            $data = $konfigs->query($update);
            if ($data) {
                echo "<script>document.location.href = '../ui/header.php?page=setting&id_setting=1';</script>";
                die;
            }
        }
    } else {
        echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
        die;
        exit(0);
    }
    ?>
</head>

<body>
    <?php require_once("../ui/sidebar.php") ?>
    <div class="panel panel-default bg-secondary rounded-2 py-4">
        <div class="panel-body container-fluid">
            <div class="panel-heading">
                <h4 class="panel-title text-light">Dashboard Profile Website</h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-light">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=setting&id_setting=<?= $_GET['id_setting'] ?>" aria-current="page"
                            class="text-decoration-none active text-light">
                            Profile Website</a>
                    </li>
                </div>
            </div>
            <div class="z-n1 py-2">
                <section class="content">
                    <div class="content-wrapper">
                        <?php if (isset($_GET['id_setting'])): ?>
                            <?php $data = $konfigs->query("SELECT * FROM setting WHERE id_setting = '$_GET[id_setting]'"); ?>
                            <?php foreach ($data as $isi): ?>
                                <div class="d-flex justify-content-center align-items-center flex-wrap">
                                    <div class="card col-sm-7 col-md-7">
                                        <div class="card-header text-center py-2">
                                            <h4 class="card-title fw-normal display-4">
                                                <?php echo $isi['nama_website'] ?>
                                            </h4>
                                        </div>
                                        <div class="card-body my-2">
                                            <form action="?page=setting&id_setting=<?= $isi['id_setting'] ?>" method="post">
                                                <input type="hidden" name="id_setting" value="<?= $isi['id_setting'] ?>">
                                                <div class="form-group">
                                                    <div class="my-1"></div>
                                                    <div class="form-inline row justify-content-center
                                                     align-items-center flex-wrap">
                                                        <div class="form-label col-sm-5 col-md-5">
                                                            <label for="nama_pemilik" class="label label-default fs-5">Nama
                                                                Pemilik</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <input type="text" value="<?= $isi['nama_pemilik'] ?>"
                                                                name="nama_pemilik" id="nama_pemilik" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="my-1"></div>
                                                    <div class="form-inline row justify-content-center
                                                     align-items-center flex-wrap">
                                                        <div class="form-label col-sm-5 col-md-5">
                                                            <label for="nama_website" class="label label-default fs-5">Nama
                                                                Website</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <input type="text" value="<?= $isi['nama_website'] ?>"
                                                                name="nama_website" id="nama_website" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="my-1"></div>
                                                    <div class="form-inline row justify-content-center
                                                     align-items-center flex-wrap">
                                                        <div class="form-label col-sm-5 col-md-5">
                                                            <label for="" class="label label-default fs-5">Status
                                                                Website</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <select name="status_website" id="" class="form-select">
                                                                <option value="" disabled>Pilih Status Website</option>
                                                                <option value="1"
                                                                    <?php if ($isi['status_website'] == '1') { ?> selected
                                                                    <?php } ?>>Status Active</option>
                                                                <option value="0"
                                                                    <?php if ($isi['status_website'] == '0') { ?> selected
                                                                    <?php } ?>>Status Non-Active</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="my-1"></div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="text-center">
                                                        <button type="submit" name="btnEditSetting" class="btn btn-primary">
                                                            <i class="fas fa-fw fa-save fa-1x"></i>
                                                            Update Data
                                                        </button>
                                                        <a href="?page=beranda" aria-current="page" class="btn btn-default">
                                                            <i class="fas fa-fw fa-close fa-1x"></i>
                                                            Kembali
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>