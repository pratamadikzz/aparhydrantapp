<?php
include 'config.php';
session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke login.php
    header("Location: ../login.php");
    exit();
}

// Ambil level pengguna dari session
$user_level = $_SESSION['level'] ?? 'guest'; // Default ke 'guest' jika tidak ada level
$activity_user = $_SESSION['nama_pengguna'] ?? $_SESSION['username'];

// Tambahkan kode lainnya untuk index.php di bawah sini
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Cek Apar | Hydrant - Data Pengguna</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets/img/logokecilAH.png" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
                            <li class="nav-item active">
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
                            <li class="nav-item">
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
                            <a href="logout.php">
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
                <nav class="navbar navbar-header  navbar-header-transparent navbar-expand-lg border-bottom">
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
                                                        echo "    <span class='block'>" . $row["code_apar"] . ", sudah melewati batas waktu! " . "</span>";

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
                                            <span class="fw-bold"><?php echo $row['nama'] ?></span>
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

            <div class="container">
                <div class="page-inner">
                    <br>
                    <br>
                    <br>

                    <hr>
                    <div class="row">
                        <div class="col-lg-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <style>
                                        .btn-tambah-keren {
                                            position: absolute;
                                            right: 20px;
                                            top: 15px;
                                            padding: 10px 20px;
                                            font-size: 16px;
                                            font-weight: 600;
                                            border-radius: 25px;
                                            color: #fff;
                                            background: linear-gradient(135deg, #cb3311, #fc2525);
                                            border: none;
                                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                                            transition: all 0.25s ease;
                                            display: flex;
                                            align-items: center;
                                            gap: 8px;
                                        }

                                        .btn-tambah-keren i {
                                            font-size: 16px;
                                        }

                                        .btn-tambah-keren:hover {
                                            background: linear-gradient(135deg, #cb3311, #fc2525);
                                            transform: translateY(-2px);
                                            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
                                            cursor: pointer;
                                        }
                                    </style>

                                    <button type="button"
                                        class="btn-tambah-keren"
                                        data-toggle="modal"
                                        data-target="#exampleModalScrollable">
                                        <i class="fas fa-plus"></i> Tambah Admin/User
                                    </button>
                                    <div class="table-responsive">
                                        <style>
                                            /* Search Box */
                                            #searchInput {
                                                border-radius: 25px;
                                                padding: 8px 15px;
                                                border: 1px solid #ccc;
                                                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                                                transition: all 0.3s ease;
                                            }

                                            #searchInput:focus {
                                                border-color: #fc2525;
                                                box-shadow: 0 4px 12px rgba(37, 117, 252, 0.3);
                                                outline: none;
                                            }

                                            /* Table Styling */
                                            .table thead th {
                                                background: linear-gradient(135deg, #cb3311, #fc2525);
                                                color: white;
                                                font-weight: 600;
                                                text-align: center;
                                                vertical-align: middle;
                                            }

                                            .table tbody td {
                                                text-align: center;
                                                vertical-align: middle;
                                                padding: 12px 8px;
                                                transition: all 0.2s ease;
                                            }

                                            .table tbody tr {
                                                background-color: #ffffff;
                                                transition: all 0.2s ease;
                                            }

                                            .table tbody tr:hover {
                                                background-color: #f2f6ff;
                                                transform: scale(1.01);
                                            }

                                            /* Action Buttons */
                                            .btn-action {
                                                font-size: 16px;
                                                border-radius: 8px;
                                                padding: 6px 12px;
                                                transition: all 0.2s ease;
                                            }

                                            .btn-action:hover {
                                                transform: translateY(-2px);
                                                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                                            }
                                        </style>

                                        <!-- Search Input -->
                                        <div class="col-md-4 mb-3">
                                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                                        </div>

                                        <!-- Table -->


                                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>Sebagai</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!-- Data rows di sini -->

                                                <?php
                                                // Start the session
                                                include('../koneksi.php');

                                                // Retrieve the username from the session
                                                $user = isset($_SESSION['username']) ? $_SESSION['username'] : null;

                                                if ($user) {
                                                    // Query to get details of the logged-in user
                                                    $user_query = "SELECT * FROM user WHERE username='$user'";
                                                    $user_result = mysqli_query($koneksi, $user_query);

                                                    if (!$user_result) {
                                                        die("Query Error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
                                                    }

                                                    $user_details = mysqli_fetch_assoc($user_result);
                                                } else {
                                                    die("No user is logged in.");
                                                }

                                                // Query to get all users
                                                $query = "SELECT * FROM user ORDER BY id ASC";
                                                $result = mysqli_query($koneksi, $query);

                                                if (!$result) {
                                                    die("Query Error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
                                                }
                                                date_default_timezone_set('Asia/Jakarta');
                                                $days = array(
                                                    'Sunday' => 'Minggu',
                                                    'Monday' => 'Senin',
                                                    'Tuesday' => 'Selasa',
                                                    'Wednesday' => 'Rabu',
                                                    'Thursday' => 'Kamis',
                                                    'Friday' => 'Jumat',
                                                    'Saturday' => 'Sabtu'
                                                );

                                                $dayName = $days[date('l')];

                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $edit_modal_id = "editModal" . $row['id']; // ID modal yang unik
                                                    $hapus_modal_id = "hapusModal" . $row['id']; // ID modal yang unik
                                                ?>


                                            <tbody style="background-color:white;">
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $no++; ?></td>
                                                    <td><?php echo $row['nama']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo "Password Terenkripsi"; ?></td>
                                                    <td><?php echo ucfirst($row['level']); ?></td>
                                                    <td style="text-align: center;">
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" style="font-size: 20px;" data-target="#<?php echo $edit_modal_id; ?>">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" style="font-size: 20px;" data-target="#<?php echo $hapus_modal_id; ?>">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            <!-- Modal Ultra-Premium -->
                                            <div class="modal fade" id="<?php echo $edit_modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content modal-ultra">
                                                        <div class="modal-header header-ultra">
                                                            <h5 class="modal-title">Edit Admin/User</h5>
                                                            <button type="button" class="close close-ultra" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body body-ultra">
                                                            <form action="proses/user/proses_edit.php" method="post">
                                                                <div class="row g-3">
                                                                    <div class="col-md-12">
                                                                        <label>Nama</label>
                                                                        <input type="text" class="form-control input-ultra" name="nama" value="<?php echo $row['nama']; ?>" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Username</label>
                                                                        <input type="text" class="form-control input-ultra" name="username" value="<?php echo $row['username']; ?>" required>
                                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Password</label>
                                                                        <input type="text" class="form-control input-ultra" name="password">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Sebagai</label>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="sebagai" value="Admin" <?php echo ($row['level'] == 'admin') ? 'checked' : ''; ?>>
                                                                            <label class="form-check-label">Admin</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="sebagai" value="user" <?php echo ($row['level'] == 'user') ? 'checked' : ''; ?>>
                                                                            <label class="form-check-label">User</label>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="activity" value="<?php echo htmlspecialchars($activity_user, ENT_QUOTES, 'UTF-8'); ?> Telah Melakukan Pengeditan Admin/User">
                                                                    <input type="hidden" name="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer footer-ultra">
                                                            <button type="button" class="btn btn-outline-secondary btn-ultra" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-ultra btn-primary-ultra">Save Changes</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <style>
                                                /* MODAL ULTRA PREMIUM */
                                                .modal-ultra {
                                                    border-radius: 20px;
                                                    backdrop-filter: blur(18px);
                                                    background: rgba(255, 255, 255, 0.85);
                                                    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
                                                    transition: all 0.5s ease;
                                                }

                                                /* HEADER */
                                                .header-ultra {
                                                    background: linear-gradient(135deg, #ff6e6e, #f57373, #de4a4a);
                                                    color: #fff;
                                                    font-weight: 700;
                                                    letter-spacing: 0.5px;
                                                    border-bottom: none;
                                                    padding: 22px;
                                                    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
                                                    text-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                                                }

                                                /* CLOSE BUTTON */
                                                .close-ultra {
                                                    font-size: 28px;
                                                    color: #fff;
                                                    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
                                                    transition: all 0.3s ease;
                                                }

                                                .close-ultra:hover {
                                                    transform: rotate(90deg) scale(1.3);
                                                    color: #fffb7d;
                                                    text-shadow: 0 0 15px #fffb7d;
                                                }

                                                /* BODY */
                                                .body-ultra {
                                                    padding: 28px;
                                                    background: rgba(255, 255, 255, 0.92);
                                                    border-radius: 0 0 20px 20px;
                                                }

                                                /* INPUT */
                                                .input-ultra {
                                                    border-radius: 15px;
                                                    padding: 14px 20px;
                                                    border: 1px solid #ccc;
                                                    box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
                                                    transition: all 0.3s ease;
                                                }

                                                .input-ultra:focus {
                                                    border-color: #ff6ec4;
                                                    box-shadow: 0 0 25px rgba(255, 110, 196, 0.4);
                                                    outline: none;
                                                }

                                                /* FOOTER */
                                                .footer-ultra {
                                                    background: rgba(250, 250, 250, 0.95);
                                                    border-top: none;
                                                    padding: 20px 25px;
                                                    display: flex;
                                                    justify-content: flex-end;
                                                    gap: 12px;
                                                }

                                                /* BUTTONS */
                                                .btn-ultra {
                                                    border-radius: 12px;
                                                    padding: 12px 28px;
                                                    font-weight: 600;
                                                    transition: all 0.3s ease;
                                                    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
                                                }

                                                .btn-ultra:hover {
                                                    transform: translateY(-3px) scale(1.06);
                                                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
                                                }

                                                /* PRIMARY BUTTON */
                                                .btn-primary-ultra {
                                                    background: linear-gradient(135deg, #ff6e6e, #f57373, #de4a4a);
                                                    color: #fff;
                                                    border: none;
                                                    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                                                    animation: glowing 1.8s infinite alternate;
                                                }

                                                @keyframes glowing {
                                                    0% {
                                                        box-shadow: 0 0 5px #ff6e6e, 0 0 10px #f57373;
                                                    }

                                                    50% {
                                                        box-shadow: 0 0 15px #ff6e6e, 0 0 25px #de4a4a;
                                                    }

                                                    100% {
                                                        box-shadow: 0 0 5px #ff6e6e, 0 0 10px #f57373;
                                                    }
                                                }

                                                /* MODAL ANIMATION */
                                                .modal.fade .modal-dialog {
                                                    transform: translateY(-60px) scale(0.95);
                                                    transition: transform 0.6s ease-out;
                                                }

                                                .modal.show .modal-dialog {
                                                    transform: translateY(0) scale(1);
                                                }
                                            </style>

                                            <!-- Modal Hapus Ultra-Premium -->
                                            <div class="modal fade" id="<?php echo $hapus_modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                    <div class="modal-content modal-hapus">
                                                        <div class="modal-header header-hapus">
                                                            <h5 class="modal-title">Hapus Data Admin/User</h5>
                                                            <button type="button" class="close close-hapus" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body body-hapus text-center">
                                                            <i class="fa-solid fa-triangle-exclamation" style="font-size:48px; color:#ff4d4f; margin-bottom:15px;"></i>
                                                            <p style="font-weight:600; font-size:16px; color:#333;">Apakah Anda yakin ingin menghapus data ini?</p>
                                                            <form action="proses/user/proses_hapus.php" method="post">
                                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                <input type="hidden" name="activity" value="<?php echo htmlspecialchars($activity_user, ENT_QUOTES, 'UTF-8'); ?> Telah Melakukan Penghapusan Admin/User">
                                                                <input type="hidden" name="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">
                                                        </div>
                                                        <div class="modal-footer footer-hapus justify-content-center">
                                                            <button type="button" class="btn btn-outline-secondary btn-hapus" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-hapus btn-danger-hapus">Hapus</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <style>
                                                /* MODAL HAPUS PREMIUM */
                                                .modal-hapus {
                                                    border-radius: 20px;
                                                    backdrop-filter: blur(18px);
                                                    background: rgba(255, 255, 255, 0.9);
                                                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
                                                    transition: all 0.5s ease;
                                                }

                                                /* HEADER */
                                                .header-hapus {
                                                    background: linear-gradient(135deg, #ff4d4f, #ff7875);
                                                    color: #fff;
                                                    font-weight: 700;
                                                    letter-spacing: 0.5px;
                                                    border-bottom: none;
                                                    text-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                                                    padding: 20px;
                                                    border-radius: 20px 20px 0 0;
                                                }

                                                /* CLOSE BUTTON */
                                                .close-hapus {
                                                    font-size: 28px;
                                                    color: #fff;
                                                    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
                                                    transition: all 0.3s ease;
                                                }

                                                .close-hapus:hover {
                                                    transform: rotate(90deg) scale(1.3);
                                                    color: #fff8d1;
                                                    text-shadow: 0 0 15px #fff8d1;
                                                }

                                                /* BODY */
                                                .body-hapus {
                                                    padding: 30px 20px;
                                                    background: rgba(255, 255, 255, 0.95);
                                                    border-radius: 0 0 20px 20px;
                                                    transition: all 0.3s ease;
                                                }

                                                /* FOOTER */
                                                .footer-hapus {
                                                    background: rgba(250, 250, 250, 0.95);
                                                    border-top: none;
                                                    padding: 20px 25px;
                                                    display: flex;
                                                    gap: 12px;
                                                }

                                                /* BUTTONS */
                                                .btn-hapus {
                                                    border-radius: 12px;
                                                    padding: 10px 28px;
                                                    font-weight: 600;
                                                    transition: all 0.3s ease;
                                                    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
                                                }

                                                .btn-hapus:hover {
                                                    transform: translateY(-3px) scale(1.05);
                                                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
                                                }

                                                /* DANGER BUTTON */
                                                .btn-danger-hapus {
                                                    background: linear-gradient(135deg, #ff4d4f, #ff7875);
                                                    color: #fff;
                                                    border: none;
                                                    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                                                    animation: glowing-danger 1.5s infinite alternate;
                                                }

                                                @keyframes glowing-danger {
                                                    0% {
                                                        box-shadow: 0 0 5px #ff4d4f, 0 0 10px #ff7875;
                                                    }

                                                    50% {
                                                        box-shadow: 0 0 15px #ff4d4f, 0 0 25px #ff7875;
                                                    }

                                                    100% {
                                                        box-shadow: 0 0 5px #ff4d4f, 0 0 10px #ff7875;
                                                    }
                                                }

                                                /* MODAL ANIMATION */
                                                .modal.fade .modal-dialog {
                                                    transform: translateY(-60px) scale(0.95);
                                                    transition: transform 0.6s ease-out;
                                                }

                                                .modal.show .modal-dialog {
                                                    transform: translateY(0) scale(1);
                                                }
                                            </style>

                                        <?php
                                                    $no++;
                                                }
                                        ?>



                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>



            </div>

        </div>
    </div>
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
    <script>
        function resetTable() {
            const table = document.getElementById('table');
            const tr = table.getElementsByTagName('tr');
            for (let i = 1; i < tr.length; i++) {
                tr[i].style.display = '';
            }
        }

        document.getElementById('searchInput').addEventListener('keyup', function() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('table');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let show = false;
                const tds = tr[i].getElementsByTagName('td');
                for (let j = 0; j < tds.length; j++) {
                    const td = tds[j];
                    if (td) {
                        if (td.innerText.toLowerCase().includes(filter)) {
                            show = true;
                        }
                    }
                }
                if (show) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        });
    </script>


</body>
<!-- Modal Tambah Akun Premium Hidup -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content modal-tambah">
            <div class="modal-header header-tambah">
                <h5 class="modal-title" id="exampleModalScrollableTitle">
                    <i class="fa-solid fa-fire-extinguisher" style="margin-right:10px;"></i>Tambah Akun
                </h5>
                <button type="button" class="close close-tambah" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body body-tambah">
                <form class="needs-validation" action="proses/user/proses_tambah.php" method="post">
                    <div class="row">
                        <!-- Nama -->
                        <div class="col-md-12 mb-3">
                            <label for="firstName">Nama</label>
                            <input type="text" class="form-control input-tambah" name="nama" id="firstName" required>
                        </div>
                        <!-- Username -->
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Username</label>
                            <input type="text" class="form-control input-tambah" name="username" id="lastName" required>
                        </div>
                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Password</label>
                            <input type="text" class="form-control input-tambah" name="password" id="lastName" required>
                        </div>
                        <!-- Sebagai -->
                        <div class="col-md-6 mb-3">
                            <label>Sebagai</label>
                            <div class="form-inline">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sebagai" id="inlineRadio1" value="Admin">
                                    <label class="form-check-label" for="inlineRadio1">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sebagai" id="inlineRadio2" value="User">
                                    <label class="form-check-label" for="inlineRadio2">User</label>
                                </div>
                            </div>
                        </div>

                        <?php
                        include '../koneksi.php';
                        $user = $_SESSION['username'];
                        $query = "SELECT * FROM user where username='$user'";
                        $result = mysqli_query($koneksi, $query);
                        date_default_timezone_set('Asia/Jakarta');
                        $days = array(
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        );
                        $dayName = $days[date('l')];
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <input type="hidden" name="activity" value="<?php echo htmlspecialchars($activity_user, ENT_QUOTES, 'UTF-8'); ?> Telah Melakukan Penambahan Admin/User">
                            <input type="hidden" name="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">
                        <?php } ?>
                    </div>
            </div>
            <div class="modal-footer footer-tambah justify-content-center">
                <button type="button" class="btn btn-outline-secondary btn-tambah">Batal</button>
                <button type="submit" class="btn btn-submit-tambah">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>



<style>
    /* Modal premium hidup */
    .modal-tambah {
        border-radius: 20px;
        backdrop-filter: blur(15px);
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
        transition: all 0.5s ease;
    }

    /* Header dengan gradien dan shadow */
    .header-tambah {
        background: linear-gradient(135deg, #ff4d4f, #ffa940);
        color: #fff;
        font-weight: 700;
        border-bottom: none;
        padding: 25px 20px;
        border-radius: 20px 20px 0 0;
        text-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }

    /* Tombol close */
    .close-tambah {
        font-size: 28px;
        color: #fff;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .close-tambah:hover {
        transform: rotate(90deg) scale(1.2);
        color: #fffde7;
    }

    /* Body modal */
    .body-tambah {
        padding: 30px 25px;
        background: rgba(255, 255, 255, 0.98);
        border-radius: 0 0 20px 20px;
    }

    /* Input premium */
    .input-tambah {
        border-radius: 12px;
        border: 1px solid #ddd;
        padding: 10px 15px;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .input-tambah:focus {
        outline: none;
        border-color: #ff4d4f;
        box-shadow: 0 0 12px rgba(255, 77, 79, 0.5);
    }

    /* Footer */
    .footer-tambah {
        background: rgba(250, 250, 250, 0.95);
        border-top: none;
        padding: 20px 25px;
        display: flex;
        gap: 15px;
    }

    /* Tombol Batal */
    .btn-tambah {
        border-radius: 12px;
        padding: 10px 28px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
    }

    .btn-tambah:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
    }

    /* Tombol Simpan */
    .btn-submit-tambah {
        background: linear-gradient(135deg, #a51313, #ac0f0f);
        color: #fff;
        border: none;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        border-radius: 12px;
        padding: 10px 28px;
        font-weight: 600;
        animation: glowing-submit 1.5s infinite alternate;
        transition: all 0.3s ease;
    }

    .btn-submit-tambah:hover {
        transform: translateY(-2px) scale(1.05);
    }

    /* Animasi glowing */
    @keyframes glowing-submit {
        0% {
            box-shadow: 0 0 8px #ca1107, 0 0 12px #b20f0f;
        }

        50% {
            box-shadow: 0 0 18px #ca1107, 0 0 28px #b20f0f;
        }

        100% {
            box-shadow: 0 0 8px #ca1107, 0 0 12px #b20f0f;
        }
    }

    /* Modal animasi masuk */
    .modal.fade .modal-dialog {
        transform: translateY(-60px) scale(0.95);
        transition: transform 0.6s ease-out;
    }

    .modal.show .modal-dialog {
        transform: translateY(0) scale(1);
    }
</style>




</html>