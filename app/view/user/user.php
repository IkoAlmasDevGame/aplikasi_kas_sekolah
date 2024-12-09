<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard user</title>
    <?php
    if ($_SESSION['id_jabatan'] == '1') {
        require_once("../ui/header.php");
        if (isset($_GET['hapus'])) {
            $id = htmlspecialchars($_GET['id']);
            $data = $konfigs->query("DELETE FROM user WHERE id_user = '$id'");
            echo "<script>document.location.href = '../ui/header.php?page=user-profile';</script>";
            die;
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
    <div class="panel panel-default bg-body-secondary rounded-2 py-4">
        <div class="panel-body container-fluid">
            <div class="panel-heading">
                <h4 class="panel-title">Dashboard User</h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=user-profile" aria-current="page" class="text-decoration-none active">User
                            Profile</a>
                    </li>
                </div>
            </div>
            <div class="z-n1 py-2">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                                <h4 class="card-title fw-normal display-4">DATA USER KAS SEKOLAH</h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped-columns" id="datatable2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center fw-normal">No.</th>
                                                    <th class="text-center fw-normal">Nama Lengkap</th>
                                                    <th class="text-center fw-normal">Username</th>
                                                    <th class="text-center fw-normal">Jabatan</th>
                                                    <th class="text-center fw-normal">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $data = $profiling->userProfile(); ?>
                                                <?php $jabatan = mysqli_fetch_array($konfigs->query("SELECT * FROM jabatan")); ?>
                                                <?php foreach ($data as $isi): ?>
                                                    <tr>
                                                        <td class="text-center fw-normal"><?php echo $no++; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $isi['nama_lengkap']; ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $isi['username']; ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $isi['nama_jabatan']; ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php if ($isi['id_jabatan'] == '1') { ?>
                                                                <div class="fs-6 fw-normal">tidak bisa ...</div>
                                                            <?php } elseif ($isi['id_jabatan'] !== $jabatan['id_jabatan']) { ?>
                                                                <a href="?page=profile&hapus=yes&id=<?= $isi['id_user'] ?>"
                                                                    aria-current="page"
                                                                    onclick="return confirm('Apakah anda ingin menghapus orang ini di database.')"
                                                                    class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-fw fa-trash fa-1x"></i>
                                                                </a>
                                                            <?php } ?>
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