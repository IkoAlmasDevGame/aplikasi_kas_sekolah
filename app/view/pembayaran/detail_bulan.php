<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $id_bulan_pembayaran = strip_tags($_GET['id_bulan_pembayaran']);
    $detail_bulan_pembayaran = mysqli_fetch_assoc($pembayaran->bulanpembayaran($id_bulan_pembayaran));
    $siswa = $daftar->siswa();
    $siswa_baru = $daftar->siswabaru();
    $uang_kas = $kas->uangpelajar($id_bulan_pembayaran);

    $bulan_pembayaran_pertama = mysqli_fetch_assoc(mysqli_query($konfigs, "SELECT * FROM bulan_pembayaran ORDER BY id_bulan_pembayaran ASC LIMIT 1"));
    $id_bulan_pembayaran_pertama = $bulan_pembayaran_pertama['id_bulan_pembayaran'];

    $id_bulan_pembayaran_sebelum = $id_bulan_pembayaran - 1;
    if ($id_bulan_pembayaran_sebelum <= 0) {
        $id_bulan_pembayaran_sebelum = 1;
    }

    if ($id_bulan_pembayaran != $id_bulan_pembayaran_pertama) {
        $uang_kas_bulan_sebelum = $kas->uangpelajar($id_bulan_pembayaran);
    }
    ?>
    <title>Detail Bulan Pembayaran : <?= ucwords($detail_bulan_pembayaran['nama_bulan']); ?>
        <?= $detail_bulan_pembayaran['tahun']; ?></title>
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
                <h4 class="panel-title">Detail Bulan Pembayaran :
                    <?= ucwords($detail_bulan_pembayaran['nama_bulan']); ?>
                    <?= $detail_bulan_pembayaran['tahun']; ?></h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=uang_kas" aria-current="page" class="text-decoration-none text-primary">Uang
                            Kas</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=detail_bulan_pembayaran&id_bulan_pembayaran=<?= $detail_bulan_pembayaran['id_bulan_pembayaran']; ?>"
                            aria-current="page" class="text-decoration-none active">Detail Bulan
                            Pembayaran</a>
                    </li>
                </div>
            </div>
            <div class="zn-1 py-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h4 class="card-title">Detail Bulan Pembayaran :
                            <?= ucwords($detail_bulan_pembayaran['nama_bulan']); ?>
                            <?= $detail_bulan_pembayaran['tahun']; ?></h4>
                        <h4 class="card-title text-muted">
                            Rp. <?= number_format($detail_bulan_pembayaran['pembayaran_perminggu']); ?> / minggu
                        </h4>
                        <div class="col-sm text-end">
                            <?php if ($_SESSION['id_jabatan'] == '1' || $_SESSION['id_jabatan'] == '3' || $_SESSION['id_jabatan'] == '2'): ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#tambahSiswaModal">
                                    <i class="fas fa-fw fa-plus"></i>
                                    Tambah Siswa
                                </button>
                                <?php if ($_SESSION['id_jabatan'] !== '3') : ?>
                                    <div class="modal fade" id="tambahSiswaModal" tabindex="-1" role="dialog"
                                        aria-labelledby="tambahSiswaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="?aksi=tambah-kasSiswa" method="post">
                                                <input type="hidden" name="id_bulan_pembayaran"
                                                    value="<?= $id_bulan_pembayaran; ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="tambahSiswaModalLabel">Tambah Siswa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="form-inline row 
                                                            justify-content-end align-items-end flex-wrap">
                                                                <div class="col-sm-4 col-md-4">
                                                                    <div class="form-label">
                                                                        <label for="id_siswa"
                                                                            class="label label-default">Nama
                                                                            Siswa</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-md-6">
                                                                    <select name="id_siswa" id="id_siswa"
                                                                        class="form-control form-select">
                                                                        <?php foreach ($siswa_baru as $dsb) : ?>
                                                                            <option value="<?= $dsb['id_siswa']; ?>">
                                                                                <?= $dsb['nama_siswa']; ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="my-2"></div>
                                                            <a href="?aksi=tambah-siswa">Tidak ada nama
                                                                siswa diatas? Tambahkan siswa disini!</a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="tambahSiswaModal"><i
                                                                class="fas fa-fw fa-times"></i>
                                                            Close</button>
                                                        <button type="submit" name="btnTambahSiswa"
                                                            class="btn btn-primary"><i class="fas fa-fw fa-save"></i>
                                                            Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif ?>

                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body my-2">
                        <section class="content content-wrapper">
                            <div class="container-fluid bg-white p-3 rounded">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered" id="datatable2">
                                        <thead>
                                            <tr>
                                                <th class="text-center fw-normal">No.</th>
                                                <th class="text-center fw-normal">Nama Siswa</th>
                                                <th class="text-center fw-normal">Minggu ke 1</th>
                                                <th class="text-center fw-normal">Minggu ke 2</th>
                                                <th class="text-center fw-normal">Minggu ke 3</th>
                                                <th class="text-center fw-normal">Minggu ke 4</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($uang_kas as $duk) : ?>
                                                <?php
                                                $pembayaran_perminggu = $duk['pembayaran_perminggu'];
                                                if ($id_bulan_pembayaran != $id_bulan_pembayaran_pertama) {
                                                    $data_bulan_sebelum = mysqli_fetch_assoc($uang_kas_bulan_sebelum);
                                                    if ($data_bulan_sebelum['minggu_ke_4']) {
                                                        mysqli_query($konfigs, "UPDATE uang_kas SET status_lunas = '1' WHERE minggu_ke_4 = '$pembayaran_perminggu'");
                                                    }
                                                }
                                                ?>
                                                <?php if ($_SESSION['id_jabatan'] == '3'): ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i++; ?></td>
                                                        <td class="text-center">
                                                            <?= ucwords(htmlspecialchars_decode($duk['nama_siswa'])); ?>
                                                        </td>
                                                        <?php if ($duk['minggu_ke_1'] == $duk['pembayaran_perminggu']) : ?>
                                                            <td class="text-success"><?= number_format($duk['minggu_ke_1']); ?>
                                                            </td>
                                                        <?php else : ?>
                                                            <td class="text-danger"><?= number_format($duk['minggu_ke_1']); ?>
                                                            </td>
                                                        <?php endif ?>

                                                        <?php if ($duk['minggu_ke_2'] == $duk['pembayaran_perminggu']) : ?>
                                                            <td class="text-success"><?= number_format($duk['minggu_ke_2']); ?>
                                                            </td>
                                                        <?php else : ?>
                                                            <td class="text-danger"><?= number_format($duk['minggu_ke_2']); ?>
                                                            </td>
                                                        <?php endif ?>

                                                        <?php if ($duk['minggu_ke_3'] == $duk['pembayaran_perminggu']) : ?>
                                                            <td class="text-success"><?= number_format($duk['minggu_ke_3']); ?>
                                                            </td>
                                                        <?php else : ?>
                                                            <td class="text-danger"><?= number_format($duk['minggu_ke_3']); ?>
                                                            </td>
                                                        <?php endif ?>

                                                        <?php if ($duk['minggu_ke_4'] == $duk['pembayaran_perminggu']) : ?>
                                                            <td class="text-success"><?= number_format($duk['minggu_ke_4']); ?>
                                                            </td>
                                                        <?php else : ?>
                                                            <td class="text-danger"><?= number_format($duk['minggu_ke_4']); ?>
                                                            </td>
                                                        <?php endif ?>
                                                    </tr>

                                                <?php else : ?>
                                                    <?php if ($id_bulan_pembayaran != $id_bulan_pembayaran_pertama and $data_bulan_sebelum['status_lunas'] == '0') : ?>
                                                        <tr class="bg-danger">
                                                        <?php else : ?>
                                                        <tr>
                                                        <?php endif ?>
                                                        <td class="text-center"><?= $i++; ?></td>
                                                        <td class="text-start"><?= $duk['nama_siswa']; ?></td>
                                                        <?php if ($duk['minggu_ke_1'] == $duk['pembayaran_perminggu']) : ?>
                                                            <?php if ($duk['minggu_ke_2'] !== "0") : ?>
                                                                <td>
                                                                    <button type="button" class="btn btn-success"
                                                                        data-container="body" data-toggle="popover"
                                                                        data-placement="top"
                                                                        data-content="Tidak bisa mengubah minggu ke 1, kalau minggu ke 2 dan seterusnya sudah lunas, jika ingin mengubah, ubahlah minggu ke 2 atau ke 3 atau ke 4 terlebih dahulu menjadi 0.">
                                                                        <i class="fas fa-fw fa-check"></i> Sudah bayar
                                                                    </button>
                                                                </td>
                                                            <?php else : ?>
                                                                <td><a href="" data-bs-toggle="modal"
                                                                        data-bs-target="#editMingguKe1<?= $duk['id_uang_kas']; ?>"
                                                                        class="btn btn-success"><i class="fas fa-fw fa-check"></i>
                                                                        Sudah bayar</a></td>
                                                            <?php endif ?>
                                                        <?php else : ?>
                                                            <td>
                                                                <?php if ($id_bulan_pembayaran != $id_bulan_pembayaran_pertama and $data_bulan_sebelum['status_lunas'] == '0') : ?>
                                                                    <button type="button" class="btn btn-success"
                                                                        data-container="body" data-toggle="popover"
                                                                        data-placement="top"
                                                                        data-content="Tidak bisa melakukan pembayaran, jika bulan pembayaran sebelumnya belum lunas.">
                                                                        <i class="fas fa-fw fa-times"></i>
                                                                    </button>
                                                                <?php else : ?>
                                                                    <a href="" data-bs-toggle="modal"
                                                                        data-bs-target="#editMingguKe1<?= $duk['id_uang_kas']; ?>"
                                                                        class="btn btn-danger"><?= number_format($duk['minggu_ke_1']); ?></a>
                                                                <?php endif ?>
                                                            </td>
                                                        <?php endif ?>
                                                        <?php if ($duk['minggu_ke_1'] !== $duk['pembayaran_perminggu']) : ?>
                                                            <td>
                                                                <--- </td>
                                                            <td>
                                                                <--- </td>
                                                            <td>
                                                                <--- </td>
                                                                <?php else : ?>
                                                                    <?php if ($duk['minggu_ke_2'] == $duk['pembayaran_perminggu']) : ?>
                                                                        <?php if ($duk['minggu_ke_3'] !== "0") : ?>
                                                            <td><button type="button" class="btn btn-success"
                                                                    data-container="body" data-toggle="popover"
                                                                    data-placement="top"
                                                                    data-content="Tidak bisa mengubah minggu ke 2, jika minggu ke 3 dan seterusnya sudah lunas, jika ingin mengubah, ubahlah minggu ke 3 atau ke 4 terlebih dahulu menjadi 0."><i
                                                                        class="fas fa-fw fa-check"></i> Sudah bayar</button>
                                                            </td>
                                                        <?php else : ?>
                                                            <td><a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#editMingguKe2<?= $duk['id_uang_kas']; ?>"
                                                                    class="btn btn-success"><i class="fas fa-fw fa-check"></i>
                                                                    Sudah bayar</a></td>
                                                        <?php endif ?>
                                                    <?php else : ?>
                                                        <td><a href="" data-bs-toggle="modal"
                                                                data-bs-target="#editMingguKe2<?= $duk['id_uang_kas']; ?>"
                                                                class="btn btn-danger"><?= number_format($duk['minggu_ke_2']); ?></a>
                                                        </td>
                                                    <?php endif ?>
                                                    <?php if ($duk['minggu_ke_2'] !== $duk['pembayaran_perminggu']) : ?>
                                                        <td>
                                                            <--- </td>
                                                        <td>
                                                            <--- </td>
                                                            <?php else : ?>
                                                                <?php if ($duk['minggu_ke_3'] == $duk['pembayaran_perminggu']) : ?>
                                                                    <?php if ($duk['minggu_ke_4'] !== "0") : ?>
                                                        <td><button type="button" class="btn btn-success"
                                                                data-container="body" data-toggle="popover"
                                                                data-placement="top"
                                                                data-content="Tidak bisa mengubah minggu ke 3, jika minggu ke 4 sudah lunas, jika ingin mengubah, ubahlah minggu ke 4 terlebih dahulu menjadi 0."><i
                                                                    class="fas fa-fw fa-check"></i> Sudah bayar</button>
                                                        </td>
                                                    <?php else : ?>
                                                        <td>
                                                            <a href="" data-toggle="modal"
                                                                data-target="#editMingguKe3<?= $duk['id_uang_kas']; ?>"
                                                                class="btn btn-success"><i class="fas fa-fw fa-check"></i>
                                                                Sudah bayar</a>
                                                        </td>
                                                    <?php endif ?>
                                                <?php else : ?>
                                                    <td><a href="" data-bs-toggle="modal"
                                                            data-bs-target="#editMingguKe3<?= $duk['id_uang_kas']; ?>"
                                                            class="btn btn-danger"><?= number_format($duk['minggu_ke_3']); ?></a>
                                                    </td>
                                                <?php endif ?>
                                                <?php if ($duk['minggu_ke_3'] !== $duk['pembayaran_perminggu']) : ?>
                                                    <td>
                                                        <--- </td>
                                                        <?php else : ?>
                                                            <?php if ($duk['minggu_ke_4'] == $duk['pembayaran_perminggu']) : ?>
                                                    <td><a href="" data-bs-toggle="modal"
                                                            data-bs-target="#editMingguKe4<?= $duk['id_uang_kas']; ?>"
                                                            class="btn btn-success"><i class="fas fa-fw fa-check"></i>
                                                            Sudah bayar</a></td>
                                                <?php else : ?>
                                                    <td><a href="" data-bs-toggle="modal"
                                                            data-bs-target="#editMingguKe4<?= $duk['id_uang_kas']; ?>"
                                                            class="btn btn-danger"><?= number_format($duk['minggu_ke_4']); ?></a>
                                                    </td>
                                                <?php endif ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                    <?php endif ?>
                                                        </tr>
                                                        <div class="modal fade" id="editMingguKe1<?= $duk['id_uang_kas']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editMingguKe1Label<?= $duk['id_uang_kas']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form action="?aksi=bayar-uangkas" method="post">
                                                                    <input type="text" name="id_uang_kas"
                                                                        value="<?= $duk['id_uang_kas']; ?>">
                                                                    <input type="text" name="id_user"
                                                                        value="<?= $_SESSION['id']; ?>">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editMingguKe1Label<?= $dbp['id_bulan_pembayaran']; ?>">
                                                                                Ubah Minggu Ke-1 :
                                                                                <?= $duk['nama_siswa']; ?></h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true"></span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="minggu_ke_1">Minggu Ke-1</label>
                                                                                <input type="hidden" name="uang_sebelum"
                                                                                    value="<?= $duk['minggu_ke_1']; ?>">
                                                                                <input
                                                                                    max="<?= $duk['pembayaran_perminggu']; ?>"
                                                                                    type="number" name="minggu_ke_1"
                                                                                    class="form-control"
                                                                                    value="<?= $duk['minggu_ke_1']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-dismiss="modal"><i
                                                                                    class="fas fa-fw fa-times"></i>
                                                                                Close</button>
                                                                            <button type="submit"
                                                                                name="btnEditPembayaranUangKas"
                                                                                class="btn btn-primary"><i
                                                                                    class="fas fa-fw fa-save"></i>
                                                                                Save</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="editMingguKe2<?= $duk['id_uang_kas']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editMingguKe2Label<?= $duk['id_uang_kas']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form action="?aksi=bayar-uangkas" method="post">
                                                                    <input type="hidden" name="id_uang_kas"
                                                                        value="<?= $duk['id_uang_kas']; ?>">
                                                                    <input type="hidden" name="id_user"
                                                                        value="<?= $_SESSION['id']; ?>">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editMingguKe2Label<?= $dbp['id_bulan_pembayaran']; ?>">
                                                                                Ubah Minggu Ke-2 :
                                                                                <?= $duk['nama_siswa']; ?></h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true"></span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="minggu_ke_2">Minggu Ke-2</label>
                                                                                <input type="hidden" name="uang_sebelum"
                                                                                    value="<?= $duk['minggu_ke_2']; ?>">
                                                                                <input
                                                                                    max="<?= $duk['pembayaran_perminggu']; ?>"
                                                                                    type="number" name="minggu_ke_2"
                                                                                    class="form-control"
                                                                                    value="<?= $duk['minggu_ke_2']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-dismiss="modal"><i
                                                                                    class="fas fa-fw fa-times"></i>
                                                                                Close</button>
                                                                            <button type="submit"
                                                                                name="btnEditPembayaranUangKas"
                                                                                class="btn btn-primary"><i
                                                                                    class="fas fa-fw fa-save"></i>
                                                                                Save</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="editMingguKe3<?= $duk['id_uang_kas']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editMingguKe3Label<?= $duk['id_uang_kas']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form action="?aksi=bayar-uangkas" method="post">
                                                                    <input type="hidden" name="id_uang_kas"
                                                                        value="<?= $duk['id_uang_kas']; ?>">
                                                                    <input type="hidden" name="id_user"
                                                                        value="<?= $_SESSION['id']; ?>">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editMingguKe3Label<?= $dbp['id_bulan_pembayaran']; ?>">
                                                                                Ubah Minggu Ke-3 :
                                                                                <?= $duk['nama_siswa']; ?></h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true"></span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="minggu_ke_3">Minggu Ke-3</label>
                                                                                <input type="hidden" name="uang_sebelum"
                                                                                    value="<?= $duk['minggu_ke_3']; ?>">
                                                                                <input
                                                                                    max="<?= $duk['pembayaran_perminggu']; ?>"
                                                                                    type="number" name="minggu_ke_3"
                                                                                    class="form-control"
                                                                                    value="<?= $duk['minggu_ke_3']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-dismiss="modal"><i
                                                                                    class="fas fa-fw fa-times"></i>
                                                                                Close</button>
                                                                            <button type="submit"
                                                                                name="btnEditPembayaranUangKas"
                                                                                class="btn btn-primary"><i
                                                                                    class="fas fa-fw fa-save"></i>
                                                                                Save</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="editMingguKe4<?= $duk['id_uang_kas']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editMingguKe4Label<?= $duk['id_uang_kas']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form action="?aksi=bayar-uangkas" method="post">
                                                                    <input type="hidden" name="id_uang_kas"
                                                                        value="<?= $duk['id_uang_kas']; ?>">
                                                                    <input type="hidden" name="id_user"
                                                                        value="<?= $_SESSION['id']; ?>">
                                                                    <input type="hidden" name="pembayaran_perminggu"
                                                                        value="<?= $duk['pembayaran_perminggu']; ?>">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editMingguKe4Label<?= $dbp['id_bulan_pembayaran']; ?>">
                                                                                Ubah Minggu Ke-4 :
                                                                                <?= $duk['nama_siswa']; ?></h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true"></span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="minggu_ke_4">Minggu Ke-4</label>
                                                                                <input type="hidden" name="uang_sebelum"
                                                                                    value="<?= $duk['minggu_ke_4']; ?>">
                                                                                <input
                                                                                    max="<?= $duk['pembayaran_perminggu']; ?>"
                                                                                    type="number" name="minggu_ke_4"
                                                                                    class="form-control"
                                                                                    value="<?= $duk['minggu_ke_4']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-dismiss="modal"><i
                                                                                    class="fas fa-fw fa-times"></i>
                                                                                Close</button>
                                                                            <button type="submit"
                                                                                name="btnEditPembayaranUangKas"
                                                                                class="btn btn-primary"><i
                                                                                    class="fas fa-fw fa-save"></i>
                                                                                Save</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>
    <?php require_once("../ui/footer.php") ?>