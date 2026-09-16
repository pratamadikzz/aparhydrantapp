<?php
session_start();

/* =========================
   CEK LOGIN
========================= */
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

/* =========================
   AMBIL LEVEL USER
========================= */
$user_level = $_SESSION['level'] ?? 'guest';

// Tambahkan kode lainnya untuk index.php di bawah sini
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Cek Apar | Hydrant - Aktivitas Pengguna</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets/img/logokecilAH.png" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["../assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/css/admin-shell.css" />
    <script src="../assets/js/admin-shell.js"></script>
    <style>
        .activity-page {
            min-height: calc(100vh - 150px);
            background: #f5f7fb;
        }

        .activity-hero {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            min-height: 190px;
            overflow: hidden;
            padding: 30px 34px;
            border-radius: 22px;
            background: linear-gradient(118deg, #111827, #1e293b 58%, #b91c1c);
            box-shadow: 0 18px 38px rgba(15, 23, 42, .14);
        }

        .activity-hero::after {
            position: absolute;
            right: -72px;
            bottom: -130px;
            width: 280px;
            height: 280px;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 50%;
            content: "";
        }

        .activity-hero__content,
        .activity-hero__stat {
            position: relative;
            z-index: 1;
        }

        .activity-eyebrow {
            color: #fca5a5;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .activity-hero h1 {
            margin: 9px 0 7px;
            color: #fff;
            font-size: clamp(1.5rem, 3vw, 2.1rem);
            font-weight: 700;
        }

        .activity-hero p {
            margin: 0;
            color: #cbd5e1;
            font-size: .88rem;
        }

        .activity-hero__stat {
            min-width: 150px;
            padding: 16px 18px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 16px;
            background: rgba(255, 255, 255, .1);
            color: #fff;
            text-align: center;
            backdrop-filter: blur(8px);
        }

        .activity-hero__stat i {
            display: block;
            margin-bottom: 7px;
            color: #fca5a5;
            font-size: 20px;
        }

        .activity-hero__stat strong,
        .activity-hero__stat span {
            display: block;
        }

        .activity-hero__stat strong {
            font-size: 1.35rem;
        }

        .activity-hero__stat span {
            margin-top: 2px;
            color: #cbd5e1;
            font-size: .7rem;
        }

        .activity-table-card {
            margin-top: 24px;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 10px 26px rgba(15, 23, 42, .06);
        }

        .activity-table-card .card-body {
            padding: 24px;
        }

        .activity-table-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .activity-table-heading h2 {
            margin: 0;
            color: #172033;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .activity-table-heading p {
            margin: 4px 0 0;
            color: #94a3b8;
            font-size: .75rem;
        }

        #example {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
        }

        #example thead th {
            border: 0;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc !important;
            color: #64748b;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        #example tbody td {
            border: 0;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: .82rem;
            vertical-align: middle;
        }

        #example tbody tr:hover td {
            background: #fff7f7;
        }

        #example tbody td:first-child {
            color: #94a3b8;
            font-weight: 700;
            text-align: center;
        }

        .activity-user {
            display: block;
            margin-bottom: 3px;
            color: #1e293b;
            font-weight: 700;
        }

        .activity-code {
            display: inline-flex;
            align-items: center;
            margin-left: 5px;
            padding: 3px 8px;
            border-radius: 999px;
            background: #fff1f2;
            color: #be123c;
            font-size: .68rem;
            font-weight: 700;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #334155;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #ef4444;
            outline: 0;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, .12);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            border: 0;
            border-radius: 8px;
            background: #dc2626 !important;
            color: #fff !important;
        }

        @media (max-width: 767px) {
            .activity-hero {
                align-items: flex-start;
                flex-direction: column;
                padding: 25px 22px;
            }

            .activity-hero__stat {
                width: 100%;
            }

            .activity-table-card .card-body {
                padding: 16px;
            }

            .activity-table-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="../index.php" class="logo">
                        <img src="../assets/img/logoAH.png" alt="navbar brand" class="navbar-brand" height="200px" width="200px" />

                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item active">

                        <li class="nav-item">
                            <a href="../index.php">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>

                            </a>
                        </li>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Menu</h4>
                        </li>
                        <li class="nav-item">
                            <a href="scan.php">
                                <i class="fa-solid fa-qrcode"></i>
                                <p>Scan Code</p>

                            </a>
                        </li>
                        <?php if ($user_level === 'admin'): ?>
                            <li class="nav-item">
                                <a href="user.php">
                                    <i class="fas fa-address-card"></i>
                                    <p>Data Pengguna</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#apar" aria-expanded="false" aria-controls="apar">
                                    <i class="fa-solid fa-database"></i>
                                    <p>Data Master</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="apar">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="hydrant.php">
                                                <span class="sub-item">Data Hydrant</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="apar.php">
                                                <span class="sub-item">Data Apar</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="apar_mobil.php">
                                                <span class="sub-item">Data Apar Mobil</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="jenis_apar.php">
                                                <span class="sub-item">Jenis Apar</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>




                            <li class="nav-item">
                                <a data-toggle="collapse" href="#area" aria-expanded="false" aria-controls="area">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p>Area Apar</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="area">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="lokasi.php">
                                                <span class="sub-item">Lokasi</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="departemen.php">
                                                <span class="sub-item">Departemen</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a href="activity.php">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <p>Aktivitas Pengguna</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="calender-exp.php">
                                    <i class="fa-regular fa-calendar"></i>
                                    <p>Kalender Apar</p>

                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="agenda.php">
                                    <i class="fa-solid fa-calendar-xmark"></i>
                                    <p>Agenda Inspeksi</p>

                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#laporan">
                                <i class="fa-solid fa-bullhorn"></i>
                                <p>Laporan Inspeksi</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="laporan">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="laporan.php">
                                            <span class="sub-item">Laporan Inspeksi Apar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="laporanhydrant.php">
                                            <span class="sub-item">Laporan Inspeksi Hydrant</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a href="logout.php" data-admin-logout>
                                <i class="fas fa-door-open"></i>
                                <p>Log out</p>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="../index.php" class="logo">
                            <img src="../assets/img/logoAH.png" alt="navbar brand" class="navbar-brand" height="200px" width="200px" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <div class="col-md-0 col-sm-0 clearfix">
                            <ul class="navbar-nav pull-left">
                                <li>
                                    <h4>
                                        <div class="date">
                                            <script type='text/javascript'>
                                                // <!-
                                                var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                                var date = new Date();
                                                var day = date.getDate();
                                                var month = date.getMonth();
                                                var thisDay = date.getDay(),
                                                    thisDay = myDays[thisDay];
                                                var yy = date.getYear();
                                                var year = (yy < 1000) ? yy + 1900 : yy;
                                                document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                                //-->
                                            </script></b>
                                        </div>
                                    </h4>

                                </li>
                            </ul>
                        </div>
                        <?php
                        include '../koneksi.php';

                        // Tanggal saat ini
                        $current_date = date('Y-m-d');

                        // SQL query untuk item yang stoknya mendekati habis (quantity <= 5)

                        $near_expiry_sql = "SELECT code_apar, tanggal_expired FROM data_apar WHERE tanggal_expired BETWEEN '$current_date' AND DATE_ADD('$current_date', INTERVAL 30 DAY)";
                        $near_expiry_result = $koneksi->query($near_expiry_sql);



                        // SQL query untuk item yang sudah kadaluarsa
                        $expired_sql = "SELECT code_apar, tanggal_expired FROM data_apar WHERE tanggal_expired < '$current_date'";
                        $expired_result = $koneksi->query($expired_sql);

                        // SQL query untuk item yang mendekati kadaluarsa dalam 30 hari ke depan

                        $near_expiry_items = array();
                        $expired_items = array();

                        // Ekstrak data dari hasil query ke dalam array
                        if ($near_expiry_result->num_rows > 0) {
                            while ($row = $near_expiry_result->fetch_assoc()) {
                                $near_expiry_items[] = $row;
                            }
                        }

                        if ($expired_result->num_rows > 0) {
                            while ($row = $expired_result->fetch_assoc()) {
                                $expired_items[] = $row;
                            }
                        }

                        // Gabungkan kedua array hasil query
                        $res = array_merge($near_expiry_items, $expired_items);

                        // Hitung total item
                        $total_items = count($res);

                        $koneksi->close();
                        ?>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification" style="background-color: red;"><?php echo $total_items; ?></span>
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            You have new notification
                                        </div>
                                    </li>
                                    <li>
                                        <div class='notif-scroll scrollbar-outer'>
                                            <div class='notif-center'>
                                                <?php
                                                include '../koneksi.php';

                                                // Tanggal saat ini
                                                $current_date = date('Y-m-d');

                                                // SQL query untuk item yang stoknya mendekati habis (quantity <= 5)



                                                // SQL query untuk item yang mendekati kadaluarsa dalam 30 hari ke depan
                                                $near_expiry_sql = "SELECT code_apar, tanggal_expired FROM data_apar WHERE tanggal_expired BETWEEN '$current_date' AND DATE_ADD('$current_date', INTERVAL 30 DAY)";
                                                $near_expiry_result = $koneksi->query($near_expiry_sql);



                                                // SQL query untuk item yang sudah kadaluarsa
                                                $expired_sql = "SELECT code_apar,tanggal_expired FROM data_apar WHERE tanggal_expired < '$current_date'";
                                                $expired_result = $koneksi->query($expired_sql);

                                                // Menampilkan alert untuk item yang sudah kadaluarsa
                                                if ($near_expiry_result->num_rows > 0) {
                                                    while ($row = $near_expiry_result->fetch_assoc()) {
                                                        echo "  <a href='#'>";
                                                        echo "  <div class='notif-icon '>";
                                                        echo "   <img src='../assets/img/warning.png' width='40px'> ";
                                                        echo " </div>";
                                                        echo "  <div class='notif-content'>";
                                                        echo "    <span class='block'>" . $row["code_apar"] . ", Mendekati Waktu Expired " . "</span>";

                                                        echo "  </div>";
                                                        echo "</a>";
                                                    }
                                                }
                                                if ($expired_result->num_rows > 0) {
                                                    while ($row = $expired_result->fetch_assoc()) {
                                                        echo "  <a href='#'>";
                                                        echo "  <div class='notif-icon'>";
                                                        echo "  <img src='../assets/img/danger.png' width='40px'>";
                                                        echo " </div>";
                                                        echo "  <div class='notif-content'>";
                                                        echo "    <span class='block'>" . $row["code_apar"] . ", Sudah Melewati Waktu Expired!! " . "</span>";

                                                        echo "  </div>";
                                                        echo "</a>";
                                                    }
                                                }

                                                ?>


                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </li>
                            <?php
                            include '../koneksi.php';

                            $user = $_SESSION['username'];

                            $query = "SELECT * FROM user where username='$user'";
                            $result = mysqli_query($koneksi, $query);

                            if (!$result) {
                                die("query Error :" . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
                            }
                            $no = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <li class="nav-item topbar-user dropdown hidden-caret">
                                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                        <div class="avatar-sm">
                                            <img src="../assets/img/orang.png" alt="..." class="avatar-img rounded-circle" />
                                        </div>
                                        <span class="profile-username">
                                            <span class="op-7">Hi,</span>

                                            <span class="fw-bold"><?php echo htmlspecialchars($_SESSION['nama_pengguna'] ?? $_SESSION['scan_name'] ?? $_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></span>

                                        </span>
                                    </a>
                                <?php
                            }
                                ?>
                                </li>








                    </div>
                </nav>

                <!-- End Navbar -->
            </div>

            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="../assets/js/html5-qrcode.min.js"></script>
            <script src="../assets/js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
            <style>
                .center-button {
                    display: flex;
                    justify-content: flex-start;
                    margin-bottom: 20px;
                }
            </style>
            <div class="container activity-page">
                <div class="page-inner">
                    <section class="activity-hero">
                        <div class="activity-hero__content">
                            <span class="activity-eyebrow"><i class="fa-solid fa-shield-halved mr-1"></i> Audit trail sistem</span>
                            <h1>Aktivitas Pengguna</h1>
                            <p>Pantau setiap perubahan dan pemeriksaan aset yang tercatat di dalam sistem.</p>
                        </div>
                        <div class="activity-hero__stat">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <strong>Live</strong>
                            <span>Riwayat terbaru</span>
                        </div>
                    </section>

                    <section class="activity-table-card">
                        <div class="card-body">
                            <div class="activity-table-heading">
                                <div>
                                    <h2>Riwayat aktivitas</h2>
                                    <p>Urutan aktivitas terbaru ditampilkan paling atas.</p>
                                </div>
                                <i class="fa-solid fa-list-check text-danger"></i>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="display activity-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Aktivitas</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:white;">
                                        <?php
                                        include('../koneksi.php');
                                        $query = "SELECT * FROM aktivitas ORDER BY id DESC";
                                        $result = mysqli_query($koneksi, $query);
                                        if (!$result) {
                                            die("query error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
                                        }

                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $edit_modal_id = "editModal" . $row['id']; // ID modal yang unik
                                        ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $no; ?></td>
                                                <td>
                                                    <span class="activity-user"><?php echo htmlspecialchars($row['nama_pengguna'] ?? 'Pengguna', ENT_QUOTES, 'UTF-8'); ?></span>
                                                    <?php echo htmlspecialchars($row['keterangan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                                    <span class="activity-code"><?php echo htmlspecialchars($row['code_apar'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></span>
                                                    <span class="text-muted ml-1">&middot; <?php echo htmlspecialchars($row['tanggal'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                                                </td>

                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                </section>


            </div>
            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">

                    <div class="copyright">
                        PT Corinthian Industries Indonesia
                    </div>

                </div>
            </footer>

        </div>


        <!-- Custom template | don't include it in your project! -->

        <!-- End Custom template -->
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "paging": true,
                "lengthMenu": [10, 25, 50, 75, 100], // Atur panjang halaman sesuai kebutuhan Anda
                "pageLength": 10 // Set jumlah baris default per halaman
            });
        });
    </script>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>


    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->

    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>


</html>