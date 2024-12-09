<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Profile</title>
        <?php
    if ($_SESSION['id_jabatan'] == '1' || $_SESSION['id_jabatan'] !== '3') {
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
        <div class="panel panel-default bg-secondary rounded-2 py-4">
            <div class="panel-body container-fluid">
                <div class="panel-heading">
                    <h4 class="panel-title text-light">Dashboard Profile</h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page"
                                class="text-decoration-none text-light">Beranda</a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=profile&id_user=<?= $_GET['id_user'] ?>" aria-current="page"
                                class="text-decoration-none active text-light">
                                Profile</a>
                        </li>
                    </div>
                </div>
                <div class="z-n1 py-2">
                    <section class="content">
                        <div class="content-wrapper">
                            <div class="container-fluid">
                                <div class="card bg-body-secondary">
                                    <?php $data = $konfigs->query("SELECT * FROM user inner join jabatan on user.id_jabatan = jabatan.id_jabatan WHERE user.id_user = '$_GET[id_user]'"); ?>
                                    <?php $dataUser = mysqli_fetch_assoc($data); ?>
                                    <div class="card-body my-2">
                                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                                            <div class="card shadow bg-secondary col-sm-7 col-md-7">
                                                <div class="card-header py-2">
                                                    <?php require_once("../profile/function.php"); ?>
                                                </div>
                                                <div class="card-body">
                                                    <?php if (isset($_GET['data'])): ?>
                                                    <?php foreach ($data as $isi): ?>
                                                    <?php echo "<div class='display-4 fs-4 text-center text-light my-2'>Data Profile : $isi[nama_lengkap]</div><br>" ?>
                                                    <div class="mb-3"></div>
                                                    <form action="?aksi=edit-data" method="post">
                                                        <input type="hidden" name="id_user"
                                                            value="<?= $isi['id_user'] ?>">
                                                        <div class="form-inline row justify-content-between 
                                                         align-items-start flex-wrap text-light">
                                                            <div class="form-label col-sm-5 col-md-5">
                                                                <label for="" class="label label-default fs-5">Nama
                                                                    Lengkap</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-5 col-md-5 fs-5">
                                                                <input type="text" class="form-control"
                                                                    name="nama_lengkap"
                                                                    value="<?= $isi['nama_lengkap'] ?>" id="">
                                                            </div>
                                                        </div>
                                                        <div class="my-2"></div>
                                                        <div class="form-inline row justify-content-between 
                                                         align-items-start flex-wrap text-light">
                                                            <div class="form-label col-sm-5 col-md-5">
                                                                <label for=""
                                                                    class="label label-default fs-5">Username</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-5 col-md-5 fs-5">
                                                                <input type="text" class="form-control" name="username"
                                                                    value="<?= $isi['username'] ?>" id="">
                                                            </div>
                                                        </div>
                                                        <div class="my-2"></div>
                                                        <div class="form-inline row justify-content-between 
                                                         align-items-start flex-wrap text-light">
                                                            <div class="form-label col-sm-5 col-md-5">
                                                                <label for=""
                                                                    class="label label-default fs-5">Jabatan</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-5 col-md-5 fs-5">
                                                                <input type="hidden" class="form-control"
                                                                    name="id_jabatan" value="<?= $isi['id_jabatan'] ?>"
                                                                    id="">
                                                                <input style="cursor: not-allowed;" disabled type="text"
                                                                    class="form-control" required
                                                                    value="<?= $isi['nama_jabatan']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="my-2"></div>
                                                        <?php if (isset($_GET['data'])): ?>
                                                        <div class="card-footer">
                                                            <div class="text-start">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fas fa-fw fa-save"></i>
                                                                    Update Data
                                                                </button>
                                                                <a href="?page=profile&id_user=<?= $dataUser['id_user'] ?>"
                                                                    aria-current="page" class="btn btn-danger">
                                                                    <i class="fas fa-fw fa-close"></i>
                                                                    Cancel
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                    </form>
                                                    <?php endforeach; ?>
                                                    <?php elseif (isset($_GET['change'])): ?>
                                                    <?php foreach ($data as $row): ?>
                                                    <?php echo "<div class='display-4 fs-4 text-center text-light my-2'>Data Profile : $row[nama_lengkap]</div><br>" ?>
                                                    <form action="?aksi=edit-password" method="post">
                                                        <input type="hidden" name="id_user"
                                                            value="<?= $_SESSION['id'] ?>">
                                                        <div class="mb-3"></div>
                                                        <div class="form-inline row justify-content-between 
                                                         align-items-start flex-wrap text-light">
                                                            <div class="form-label col-sm-5 col-md-5">
                                                                <label for="old_password"
                                                                    class="label label-default fs-5">Old
                                                                    Password</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6 fs-5">
                                                                <input type="password" class="form-control"
                                                                    name="old_password"
                                                                    placeholder="masukkan password lama ..."
                                                                    aria-required="TRUE" required id="old_password">
                                                            </div>
                                                        </div>
                                                        <div class="my-2"></div>
                                                        <div class="form-inline row justify-content-between 
                                                         align-items-start flex-wrap text-light">
                                                            <div class="form-label col-sm-5 col-md-5">
                                                                <label for="new_password"
                                                                    class="label label-default fs-5">Password</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6 fs-5">
                                                                <input type="password" class="form-control"
                                                                    placeholder="masukkan password baru ..."
                                                                    name="new_password" required aria-required="TRUE"
                                                                    minlength="6" id="new_password">
                                                            </div>
                                                        </div>
                                                        <div class="my-2"></div>
                                                        <div class="form-inline row justify-content-between 
                                                         align-items-start flex-wrap text-light">
                                                            <div class="form-label col-sm-5 col-md-5">
                                                                <label for="new_password_verify"
                                                                    class="label label-default fs-5">Password
                                                                    Verify</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6 fs-5">
                                                                <input type="password" class="form-control"
                                                                    name="new_password_verify"
                                                                    placeholder="ulangi password baru anda ..." required
                                                                    aria-required="TRUE" minlength="6"
                                                                    id="new_password_verify">
                                                            </div>
                                                        </div>
                                                        <div class="my-2"></div>
                                                        <?php if (isset($_GET['change'])): ?>
                                                        <div class="card-footer">
                                                            <div class="text-start">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fas fa-fw fa-save"></i>
                                                                    Update Password
                                                                </button>
                                                                <a href="?page=profile&id_user=<?= $dataUser['id_user'] ?>"
                                                                    aria-current="page" class="btn btn-danger">
                                                                    <i class="fas fa-fw fa-close"></i>
                                                                    Cancel
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                    </form>
                                                    <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <div class="mb-4"></div>
                                                    <div class="form-inline row justify-content-between 
                                                         align-items-start flex-wrap text-light">
                                                        <div class="form-label col-sm-5 col-md-5">
                                                            <label for="" class="label label-default fs-5">Nama
                                                                Lengkap</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-4 col-md-4 fs-5">
                                                            <?= $dataUser['nama_lengkap']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="my-2"></div>
                                                    <div class="form-inline row justify-content-between 
                                                         align-items-start flex-wrap text-light">
                                                        <div class="form-label col-sm-5 col-md-5">
                                                            <label for=""
                                                                class="label label-default fs-5">Username</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-4 col-md-4 fs-5">
                                                            <?= $dataUser['username']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="my-2"></div>
                                                    <div class="form-inline row justify-content-between 
                                                         align-items-start flex-wrap text-light">
                                                        <div class="form-label col-sm-5 col-md-5">
                                                            <label for=""
                                                                class="label label-default fs-5">Jabatan</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-4 col-md-4 fs-5">
                                                            <?= $dataUser['nama_jabatan']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="my-2"></div>
                                                    <div class="card-footer">
                                                        <div class="text-start">
                                                            <a href="?page=profile&id_user=<?= $dataUser['id_user'] ?>&data=<?= $dataUser['id_user'] ?>"
                                                                aria-current="page" class="btn btn-success">
                                                                <i class="fas fa-fw fa-edit"></i>
                                                                Edit
                                                            </a>
                                                            <a href="?page=profile&id_user=<?= $dataUser['id_user'] ?>&change=<?= $dataUser['id_user'] ?>"
                                                                aria-current="page" class="btn btn-danger">
                                                                <i class="fas fa-fw fa-lock"></i>
                                                                Change Password
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
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