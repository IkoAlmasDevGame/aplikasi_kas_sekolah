<?php
if ($_SESSION['id_jabatan'] == "") {
    echo "<script>
    document.location.href = '../index.php';
    alert('mohon maaf jabatan anda tidak ada di database kami.');
    </script>";
    die;
}
?>

<?php
$data = $konfigs->query("SELECT user.*, jabatan.id_jabatan, jabatan.nama_jabatan FROM user join jabatan on jabatan.id_jabatan = user.id_jabatan WHERE user.id_user = '$_SESSION[id]'");
$baseFile = mysqli_fetch_array($data);
# database keuangan kas
$jml_pengeluaran = mysqli_fetch_assoc(mysqli_query($konfigs, "SELECT sum(jumlah_pengeluaran) as jml_pengeluaran FROM pengeluaran"));
$jml_pengeluaran = $jml_pengeluaran['jml_pengeluaran'];
$jml_uang_kas = mysqli_fetch_assoc(mysqli_query($konfigs, "SELECT sum(minggu_ke_1 + minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as jml_uang_kas FROM uang_kas"));
$jml_uang_kas = $jml_uang_kas['jml_uang_kas'];
?>

<?php
if ($_SESSION['id_jabatan'] == "1") {
?>
    <?php $setting = $konfigs->query("SELECT * FROM setting WHERE id_setting='1'"); ?>
    <?php $ds = mysqli_fetch_array($setting); ?>
    <?php if ($ds['status_website'] == '1'): ?>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
            <div class="d-flex align-items-center justify-content-between">
                <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
                    <?php echo "Dashboard $ds[nama_website]"; ?>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
                <?php
                // setting tanggal
                $haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
                $bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                $bulans_count = count($bulans);
                // tanggal bulan dan tahun hari ini
                $hari_ini = $haries[date("l")];
                $bulan_ini = $bulans[date("n")];
                $tanggal = date("d");
                $bulan = date("m");
                $tahun = date("Y");
                ?>
                &nbsp;<?php echo $hari_ini . ", " . $tanggal . " " . $bulan_ini . " " . $tahun ?>
            </div><!-- End Logo -->

            <nav class="header-nav ms-auto mx-3">
                <ul>
                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                            data-bs-toggle="dropdown" aria-controls="dropdown">
                            <i class="fa fa-2x fa-user-circle"></i>
                            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h4 class="fs-5 fw-normal text-start text-dark">
                                    <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                        <div class="col-sm-5 col-md-5">
                                            <label for="">nama profile</label>
                                        </div>
                                        <div class="col-sm-1 col-md-1">:</div>
                                        <div class="col-sm-5 col-md-5">
                                            <?php echo $baseFile['nama_lengkap'] ?>
                                        </div>
                                    </div>
                                </h4>
                                <hr class="dropdown-divider">
                                <h4 class="fs-5 fw-normal text-start text-dark">
                                    <div class="form-inline row justify-content-center align-items-start flex-wrap">
                                        <div class="col-sm-5 col-md-5">
                                            <label for="">username</label>
                                        </div>
                                        <div class="col-sm-1 col-md-1">:</div>
                                        <div class="col-sm-5 col-md-5">
                                            <?php echo $baseFile['username'] ?>
                                        </div>
                                    </div>
                                </h4>
                                <hr class="dropdown-divider">
                                <h4 class="fs-5 fw-normal text-start text-dark">
                                    <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                        <div class="col-sm-5 col-md-5">
                                            <label for="">Jabatan</label>
                                        </div>
                                        <div class="col-sm-1 col-md-1">:</div>
                                        <div class="col-sm-5 col-md-5">
                                            <?php echo $baseFile['nama_jabatan'] ?>
                                        </div>
                                    </div>
                                </h4>
                                <hr class="dropdown-divider">
                            </li>
                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header>
        <!-- ======= Header ======= -->
    <?php endif; ?>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <?php if ($ds['status_website'] == '1'): ?>
                    <div class="bg-success nav-link text-white">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <div class="fs-6">Sisa Uang : Rp. <?= number_format($jml_uang_kas - $jml_pengeluaran); ?> ,-</div>
                    </div>
                <?php endif; ?>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=beranda" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-tachometer-alt fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Dashboard</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=user-profile" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-user fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">User kas sekolah</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=jabatan" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-cog fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Jabatan</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=siswa" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-user-tie fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Siswa</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=uang_kas" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-dollar-sign fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Uang Kas</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=pengeluaran" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-sign-out-alt fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Pengeluaran</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=laporan" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-file fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Laporan</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=riwayat" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-stopwatch fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Riwayat Uang Kas</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=riwayat_pengeluaran" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-stopwatch fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Riwayat Pengeluaran</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-2"></div>
            <hr class="dropdown-divider border border-top border-1">
            <li class="nav-item">
                <a href="?page=setting&id_setting=1" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-building fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Profile Website</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-1"></div>
            <li class="nav-item">
                <a href="?page=profile&id_user=<?= $_SESSION['id'] ?>" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-user-edit fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Profile</div>
                </a>
            </li>
            <hr class="dropdown-divider border border-top border-1">
            <div class="my-2"></div>
            <hr class="dropdown-divider border border-top border-1">
            <li class="nav-item">
                <a href="?page=logout" aria-current="page" class="nav-link collapsed">
                    <i class="fas fa-sign-out nav-icon text-danger fa-1x"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Log out</div>
                </a>
            </li>
        </ul>
    </aside>
    <!-- ======= Sidebar ======= -->
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                    </div>

                </div><!-- End Right side columns -->

            </div>
        </section>
    <?php
} else if ($_SESSION['id_jabatan'] == "2") {
    ?>
        <?php $setting = $konfigs->query("SELECT * FROM setting WHERE id_setting='1'"); ?>
        <?php $ds = mysqli_fetch_array($setting); ?>
        <?php if ($ds['status_website'] == '1'): ?>
            <!-- ======= Header ======= -->
            <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
                        <?php echo "Dashboard $ds[nama_website]"; ?>
                    </a>
                    <i class="bi bi-list toggle-sidebar-btn"></i>
                    <?php
                    // setting tanggal
                    $haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
                    $bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                    $bulans_count = count($bulans);
                    // tanggal bulan dan tahun hari ini
                    $hari_ini = $haries[date("l")];
                    $bulan_ini = $bulans[date("n")];
                    $tanggal = date("d");
                    $bulan = date("m");
                    $tahun = date("Y");
                    ?>
                    &nbsp;<?php echo $hari_ini . ", " . $tanggal . " " . $bulan_ini . " " . $tahun ?>
                </div><!-- End Logo -->

                <nav class="header-nav ms-auto mx-3">
                    <ul>
                        <li class="nav-item dropdown pe-3">

                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                                data-bs-toggle="dropdown" aria-controls="dropdown">
                                <i class="fa fa-2x fa-user-circle"></i>
                                <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                            </a><!-- End Profile Iamge Icon -->

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header">
                                    <h4 class="fs-5 fw-normal text-start text-dark">
                                        <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                            <div class="col-sm-5 col-md-5">
                                                <label for="">nama profile</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-5 col-md-5">
                                                <?php echo $baseFile['nama_lengkap'] ?>
                                            </div>
                                        </div>
                                    </h4>
                                    <hr class="dropdown-divider">
                                    <h4 class="fs-5 fw-normal text-start text-dark">
                                        <div class="form-inline row justify-content-center align-items-start flex-wrap">
                                            <div class="col-sm-5 col-md-5">
                                                <label for="">username</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-5 col-md-5">
                                                <?php echo $baseFile['username'] ?>
                                            </div>
                                        </div>
                                    </h4>
                                    <hr class="dropdown-divider">
                                    <h4 class="fs-5 fw-normal text-start text-dark">
                                        <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                            <div class="col-sm-5 col-md-5">
                                                <label for="">Jabatan</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-5 col-md-5">
                                                <?php echo $baseFile['nama_jabatan'] ?>
                                            </div>
                                        </div>
                                    </h4>
                                    <hr class="dropdown-divider">
                                </li>
                            </ul><!-- End Profile Dropdown Items -->
                        </li><!-- End Profile Nav -->

                    </ul>
                </nav><!-- End Icons Navigation -->

            </header>
            <!-- ======= Header ======= -->
        <?php endif; ?>

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <?php if ($ds['status_website'] == '1'): ?>
                        <div class="bg-success nav-link text-white">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <div class="fs-6">Sisa Uang : Rp. <?= number_format($jml_uang_kas - $jml_pengeluaran); ?> ,-</div>
                        </div>
                    <?php endif; ?>
                </li>
                <hr class="dropdown-divider border border-top border-1">
                <div class="my-1"></div>
                <li class="nav-item">
                    <a href="?page=beranda" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-tachometer-alt fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Dashboard</div>
                    </a>
                </li>
                <hr class="dropdown-divider border border-top border-1">
                <div class="my-1"></div>
                <li class="nav-item">
                    <a href="?page=siswa" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-user-tie fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Siswa</div>
                    </a>
                </li>
                <hr class="dropdown-divider border border-top border-1">
                <div class="my-1"></div>
                <li class="nav-item">
                    <a href="?page=uang_kas" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-dollar-sign fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Uang Kas</div>
                    </a>
                </li>
                <hr class="dropdown-divider border border-top border-1">
                <div class="my-1"></div>
                <li class="nav-item">
                    <a href="?page=pengeluaran" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-sign-out-alt fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Pengeluaran</div>
                    </a>
                </li>
                <hr class="dropdown-divider border border-top border-1">
                <div class="my-1"></div>
                <li class="nav-item">
                    <a href="?page=laporan" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-file fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Laporan</div>
                    </a>
                </li>
                <hr class="dropdown-divider border border-top border-1">
                <div class="my-1"></div>
                <li class="nav-item">
                    <a href="?page=riwayat" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-stopwatch fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Riwayat Uang Kas</div>
                    </a>
                </li>
                <hr class="dropdown-divider border border-top border-1">
                <div class="my-1"></div>
                <li class="nav-item">
                    <a href="?page=riwayat_pengeluaran" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-stopwatch fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Riwayat Pengeluaran</div>
                    </a>
                </li>
                <hr class="dropdown-divider border border-top border-1">
                <div class="my-2"></div>
                <hr class="dropdown-divider border border-top border-1">
                <li class="nav-item">
                    <a href="?page=profile&id_user=<?= $_SESSION['id'] ?>" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-user-edit fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Profile</div>
                    </a>
                </li>
                <hr class="dropdown-divider border border-top border-1">
                <div class="my-2"></div>
                <hr class="dropdown-divider border border-top border-1">
                <li class="nav-item">
                    <a href="?page=logout" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-sign-out nav-icon text-danger fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Log out</div>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- ======= Sidebar ======= -->
        <main id="main" class="main">
            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-8">
                        <div class="row">

                        </div>

                    </div><!-- End Right side columns -->

                </div>
            </section>
        <?php
    } else if ($_SESSION['id_jabatan'] == "3") {
        ?>
            <?php $setting = $konfigs->query("SELECT * FROM setting WHERE id_setting='1'"); ?>
            <?php $ds = mysqli_fetch_array($setting); ?>
            <?php if ($ds['status_website'] == '1'): ?>
                <!-- ======= Header ======= -->
                <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
                            <?php echo "Dashboard $ds[nama_website]"; ?>
                        </a>
                        <i class="bi bi-list toggle-sidebar-btn"></i>
                        <?php
                        // setting tanggal
                        $haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
                        $bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                        $bulans_count = count($bulans);
                        // tanggal bulan dan tahun hari ini
                        $hari_ini = $haries[date("l")];
                        $bulan_ini = $bulans[date("n")];
                        $tanggal = date("d");
                        $bulan = date("m");
                        $tahun = date("Y");
                        ?>
                        &nbsp;<?php echo $hari_ini . ", " . $tanggal . " " . $bulan_ini . " " . $tahun ?>
                    </div><!-- End Logo -->

                    <nav class="header-nav ms-auto mx-3">
                        <ul>
                            <li class="nav-item dropdown pe-3">

                                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-controls="dropdown">
                                    <i class="fa fa-2x fa-user-circle"></i>
                                    <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                                </a><!-- End Profile Iamge Icon -->

                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                    <li class="dropdown-header">
                                        <h4 class="fs-5 fw-normal text-start text-dark">
                                            <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                                <div class="col-sm-5 col-md-5">
                                                    <label for="">nama profile</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-5 col-md-5">
                                                    <?php echo $baseFile['nama_lengkap'] ?>
                                                </div>
                                            </div>
                                        </h4>
                                        <hr class="dropdown-divider">
                                        <h4 class="fs-5 fw-normal text-start text-dark">
                                            <div class="form-inline row justify-content-center align-items-start flex-wrap">
                                                <div class="col-sm-5 col-md-5">
                                                    <label for="">username</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-5 col-md-5">
                                                    <?php echo $baseFile['username'] ?>
                                                </div>
                                            </div>
                                        </h4>
                                        <hr class="dropdown-divider">
                                        <h4 class="fs-5 fw-normal text-start text-dark">
                                            <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                                <div class="col-sm-5 col-md-5">
                                                    <label for="">Jabatan</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-5 col-md-5">
                                                    <?php echo $baseFile['nama_jabatan'] ?>
                                                </div>
                                            </div>
                                        </h4>
                                        <hr class="dropdown-divider">
                                    </li>
                                </ul><!-- End Profile Dropdown Items -->
                            </li><!-- End Profile Nav -->

                        </ul>
                    </nav><!-- End Icons Navigation -->

                </header>
                <!-- ======= Header ======= -->
            <?php endif; ?>

            <!-- ======= Sidebar ======= -->
            <aside id="sidebar" class="sidebar">
                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <?php if ($ds['status_website'] == '1'): ?>
                            <div class="bg-success nav-link text-white">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <div class="fs-6">Sisa Uang : Rp. <?= number_format($jml_uang_kas - $jml_pengeluaran); ?> ,-
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                    <hr class="dropdown-divider border border-top border-1">
                    <div class="my-1"></div>
                    <li class="nav-item">
                        <a href="?page=beranda" aria-current="page" class="nav-link collapsed">
                            <i class="fas fa-tachometer-alt fa-1x"></i>
                            <div class="fs-6 display-4 text-dark fw-normal">Dashboard</div>
                        </a>
                    </li>
                    <hr class="dropdown-divider border border-top border-1">
                    <div class="my-1"></div>
                    <li class="nav-item">
                        <a href="?page=siswa" aria-current="page" class="nav-link collapsed">
                            <i class="fas fa-user-tie fa-1x"></i>
                            <div class="fs-6 display-4 text-dark fw-normal">Siswa</div>
                        </a>
                    </li>
                    <hr class="dropdown-divider border border-top border-1">
                    <div class="my-1"></div>
                    <li class="nav-item">
                        <a href="?page=uang_kas" aria-current="page" class="nav-link collapsed">
                            <i class="fas fa-dollar-sign fa-1x"></i>
                            <div class="fs-6 display-4 text-dark fw-normal">Uang Kas</div>
                        </a>
                    </li>
                    <hr class="dropdown-divider border border-top border-1">
                    <div class="my-1"></div>
                    <li class="nav-item">
                        <a href="?page=pengeluaran" aria-current="page" class="nav-link collapsed">
                            <i class="fas fa-sign-out-alt fa-1x"></i>
                            <div class="fs-6 display-4 text-dark fw-normal">Pengeluaran</div>
                        </a>
                    </li>
                    <hr class="dropdown-divider border border-top border-1">
                    <div class="my-1"></div>
                    <li class="nav-item">
                        <a href="?page=laporan" aria-current="page" class="nav-link collapsed">
                            <i class="fas fa-file fa-1x"></i>
                            <div class="fs-6 display-4 text-dark fw-normal">Laporan</div>
                        </a>
                    </li>
                    <hr class="dropdown-divider border border-top border-1">
                    <div class="my-1"></div>
                    <li class="nav-item">
                        <a href="?page=riwayat" aria-current="page" class="nav-link collapsed">
                            <i class="fas fa-stopwatch fa-1x"></i>
                            <div class="fs-6 display-4 text-dark fw-normal">Riwayat Uang Kas</div>
                        </a>
                    </li>
                    <hr class="dropdown-divider border border-top border-1">
                    <div class="my-1"></div>
                    <li class="nav-item">
                        <a href="?page=riwayat_pengeluaran" aria-current="page" class="nav-link collapsed">
                            <i class="fas fa-stopwatch fa-1x"></i>
                            <div class="fs-6 display-4 text-dark fw-normal">Riwayat Pengeluaran</div>
                        </a>
                    </li>
                    <hr class="dropdown-divider border border-top border-1">
                    <div class="my-2"></div>
                    <hr class="dropdown-divider border border-top border-1">
                    <li class="nav-item">
                        <a href="?page=profile&id_user=<?= $_SESSION['id'] ?>" aria-current="page"
                            class="nav-link collapsed">
                            <i class="fas fa-user-edit fa-1x"></i>
                            <div class="fs-6 display-4 text-dark fw-normal">Profile</div>
                        </a>
                    </li>
                    <hr class="dropdown-divider border border-top border-1">
                    <div class="my-2"></div>
                    <hr class="dropdown-divider border border-top border-1">
                    <li class="nav-item">
                        <a href="?page=logout" aria-current="page" class="nav-link collapsed">
                            <i class="fas fa-sign-out nav-icon text-danger fa-1x"></i>
                            <div class="fs-6 display-4 text-dark fw-normal">Log out</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- ======= Sidebar ======= -->
            <main id="main" class="main">
                <section class="section dashboard">
                    <div class="row">

                        <!-- Left side columns -->
                        <div class="col-lg-8">
                            <div class="row">

                            </div>

                        </div><!-- End Right side columns -->

                    </div>
                </section>
            <?php
        } else {
            echo "<script>
    document.location.href = '../index.php';
    </script>";
            die;
            exit(0);
        }
            ?>