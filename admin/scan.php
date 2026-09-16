<?php
session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
  // Jika belum login, arahkan ke login.php
  header("Location: ../login.php");
  exit();
}

// Ambil level pengguna dari session
$user_level = $_SESSION['level'] ?? 'guest'; // Default ke 'guest' jika tidak ada level

$scanErrorMessage = '';
if (isset($_GET['scan_error'])) {
  $scanErrorMessage = trim($_GET['scan_error']);
}

// Tambahkan kode lainnya untuk index.php di bawah sini
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Cek Apar | Hydrant - Scan Barcode</title>
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
  <?php if ($scanErrorMessage): ?>
    <script>
      window.scanErrorMessage = <?php echo json_encode($scanErrorMessage); ?>;
    </script>
  <?php endif; ?>
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
            <li class="nav-item active">
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
      <style>
        .admin-scan-page {
          min-height: calc(100vh - 170px);
          padding: 42px 20px 54px;
          background: #08111f;
          color: #f8fafc;
        }

        .admin-scan-shell {
          width: min(100%, 720px);
          margin: 0 auto;
        }

        .admin-scan-heading {
          margin-bottom: 24px;
          text-align: center;
        }

        .admin-scan-icon {
          width: 58px;
          height: 58px;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          margin-bottom: 14px;
          border-radius: 18px;
          background: #dc2626;
          color: #fff;
          font-size: 25px;
          box-shadow: 0 12px 28px rgba(220, 38, 38, .28);
        }

        .admin-scan-heading h1 {
          margin: 0;
          color: #fff;
          font-size: clamp(1.65rem, 3vw, 2.15rem);
          font-weight: 700;
        }

        .admin-scan-heading p {
          max-width: 430px;
          margin: 8px auto 0;
          color: #94a3b8;
          font-size: .95rem;
        }

        .admin-scan-card {
          overflow: hidden;
          border: 1px solid #263449;
          border-radius: 24px;
          background: #101b2c;
          box-shadow: 0 24px 50px rgba(0, 0, 0, .28);
        }

        .admin-reader-wrap {
          position: relative;
          padding: 18px;
          background: #050b14;
        }

        #reader {
          width: 100% !important;
          max-width: 620px;
          min-height: 310px;
          margin: 0 auto;
          overflow: hidden;
          border: 1px solid #334155 !important;
          border-radius: 16px;
          background: #0b1220;
        }

        #reader video {
          display: block;
          width: 100% !important;
          min-height: 310px;
          border-radius: 15px;
          object-fit: cover;
        }

        #reader img {
          max-width: 100%;
        }

        #reader__dashboard_section_csr button,
        #reader__dashboard_section_swaplink {
          color: #f8fafc !important;
        }

        #reader__dashboard_section_csr button {
          border: 0;
          border-radius: 10px;
          background: #dc2626;
          padding: 9px 16px;
          font-weight: 600;
        }

        #reader__scan_region {
          min-height: 260px;
        }

        .admin-scan-card-footer {
          display: flex;
          align-items: center;
          gap: 12px;
          padding: 18px 22px 20px;
        }

        .admin-scan-card-footer i {
          color: #f87171;
          font-size: 20px;
        }

        .admin-scan-card-footer strong {
          display: block;
          color: #f8fafc;
          font-size: .95rem;
        }

        .admin-scan-card-footer span {
          display: block;
          margin-top: 2px;
          color: #94a3b8;
          font-size: .8rem;
        }

        .admin-scan-back {
          display: inline-block;
          margin-top: 20px;
          color: #94a3b8;
          font-size: .875rem;
          text-decoration: none;
        }

        .admin-scan-back:hover {
          color: #fff;
        }

        @media (max-width: 575px) {
          .admin-scan-page {
            padding: 26px 12px 38px;
          }

          .admin-reader-wrap {
            padding: 10px;
          }

          #reader,
          #reader video {
            min-height: 270px;
          }

          .admin-scan-card-footer {
            padding: 16px;
          }
        }
      </style>
      <main class="admin-scan-page">
        <div class="admin-scan-shell">
          <header class="admin-scan-heading">
            <div class="admin-scan-icon" aria-hidden="true"><i class="fa-solid fa-qrcode"></i></div>
            <h1>Scan QR Code</h1>
            <p>Arahkan kamera ke QR Code APAR atau Hydrant untuk membuka data inspeksi.</p>
          </header>

          <section class="admin-scan-card" aria-label="Pemindai QR Code">
            <div class="admin-reader-wrap">
              <div id="reader"></div>
            </div>
            <div class="admin-scan-card-footer">
              <i class="fa-solid fa-camera" aria-hidden="true"></i>
              <div>
                <strong>Siap melakukan pemindaian</strong>
                <span>Izinkan akses kamera, lalu posisikan kode di dalam area pemindai.</span>
              </div>
            </div>
          </section>

          <div class="text-center">
            <a class="admin-scan-back" href="../index.php"><i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Dashboard</a>
          </div>

          <div class="row">

            <!-- Modal Template -->
            <div class="modal fade" id="scanResultAparModal" tabindex="-1" aria-labelledby="scanResultAparModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="scanResultAparModalLabel">Data Apar</h5>

                  </div>
                  <div class="modal-body">
                    <form action="proses/apar/proses_scan.php" method="post">
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <label for="codeApar">Code Apar</label>
                          <input type="text" class="form-control" name="code_apar" id="codeApar" required>
                          <input type="hidden" name="id" id="id" value="" />
                          <div class="invalid-feedback">
                            Valid Code Apar is required.
                          </div>
                        </div>
                        <?php

                        $query = "SELECT * FROM tbl_lokasi ORDER BY id ASC";
                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                          die("query error: " . mysqli_error($koneksi));
                        }
                        ?>
                        <div id="inputPlatNomor" style="display: none;">
                          <label for="platNomor">Plat Nomor</label>
                          <input type="text" id="platNomor" name="platNomor" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3" id="inputLokasi">
                          <label for="lokasi">Lokasi</label>
                          <select class="custom-select d-block w-100" name="lokasi" id="lokasi">
                            <option value="">Pilih....</option>

                            <?php
                            // Langkah 3: Iterasi hasil query
                            while ($row = mysqli_fetch_assoc($result)) {
                              echo '<option value="' . $row['id'] . '">' . $row['lokasi'] . '</option>';
                            }
                            ?>

                          </select>
                          <div class="invalid-feedback">
                            Valid Lokasi is required.
                          </div>
                        </div>
                        <?php

                        $query = "SELECT * FROM tbl_departemen ORDER BY id ASC";
                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                          die("query error: " . mysqli_error($koneksi));
                        }
                        ?>
                        <div class="col-md-6 mb-3" id="inputDepartemen">
                          <label for="departemen">Departemen</label>

                          <select class="custom-select d-block w-100" name="departemen" id="departemen">
                            <option value="">Pilih....</option>

                            <?php
                            // Langkah 3: Iterasi hasil query
                            while ($row = mysqli_fetch_assoc($result)) {
                              echo '<option value="' . $row['id'] . '">' . $row['departemen'] . '</option>';
                            }
                            ?>

                          </select>
                          <div class="invalid-feedback">
                            Valid Departemen is required.
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="lokasi">Vendor</label>
                          <input type="text" class="form-control" name="vendor" id="vendor" required>
                          <div class="invalid-feedback">
                            Valid vendor is required.
                          </div>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label for="tanggal_penggantian">Tanggal Penggantian</label>
                          <input type="date" class="form-control" name="tanggal_penggantian" id="tanggalPenggantian">
                          <div class="invalid-feedback">
                            Valid tanggal_penggantian is required.
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="tanggal_refill">Tanggal Refill</label>
                          <input type="date" class="form-control" name="tanggal_refill" id="tanggalRefill" required>
                          <div class="invalid-feedback">
                            Valid tanggal_refill is required.
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="tanggal_expired">Tanggal Expired</label>
                          <input type="date" class="form-control" name="tanggal_expired" id="tanggalExpired" required>
                          <div class="invalid-feedback">
                            Valid tanggal_expired is required.
                          </div>
                        </div>
                        <div class="col-md-12 mb-3">
                          <label class="" for="">Masa Pemakaian</label>
                          <div class="form-inline">
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="masa_pemakaian" id="masa_pemakaian" value="1 Tahun">
                              <label class="custom-label text-black" for="masa_pemakaian">1 Tahun</label>
                            </div>

                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="masa_pemakaian" id="masa_pemakaian" value="2 Tahun">
                              <label class="custom-label text-black" for="masa_pemakaian">2 Tahun</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 mb-3">
                          <label class="" for="">Kondisi</label>
                          <div class="form-inline">
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="kondisi" id="kondisi" value="Layak">
                              <label class="custom-label text-black" for="kondisi">Layak</label>
                            </div>

                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="kondisi" id="kondisi" value="Tidak Layak">
                              <label class="custom-label text-black" for="kondisi">Tidak Layak</label>
                            </div>
                          </div>
                        </div>

                        <?php

                        $query = "SELECT * FROM jenis_apar ORDER BY id ASC";
                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                          die("query error: " . mysqli_error($koneksi));
                        }
                        ?>
                        <div class="col-md-12 mb-3">
                          <label for="jenisApar">Jenis Apar</label>
                          <select class="custom-select d-block w-100" name="jenis_apar" id="jenisApar" required="">
                            <option value="">Pilih....</option>

                            <?php
                            // Langkah 3: Iterasi hasil query
                            while ($row = mysqli_fetch_assoc($result)) {
                              echo '<option value="' . $row['id'] . '">' . $row['jenis_apar'] . '</option>';
                            }
                            ?>

                          </select>
                          <div class="invalid-feedback">
                            Valid Jenis Apar is required.
                          </div>
                        </div>
                      </div>
                      <!-- Add other fields similarly -->
                      <style>
                        .form-check-inline {
                          width: 100px;
                        }
                      </style>
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <label class="" for="">Nozzle</label>
                          <div class="form-inline">
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="nozzle" id="nozzle" value="Baik">
                              <label class="custom-label text-black" for="nozzle">Baik</label>
                            </div>

                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="nozzle" id="nozzle" value="Tidak Baik">
                              <label class="custom-label text-black" for="nozzle">Tidak Baik</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 mb-3">
                          <label class="" for="">Tabung</label>
                          <div class="form-inline">
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="tabung" id="tabung" value="Baik">
                              <label class="custom-label text-black" for="tabung">Baik</label>
                            </div>
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="tabung" id="tabung" value="Tidak Baik">
                              <label class="custom-label text-black" for="tabung">Tidak Baik</label>

                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <label class="" for="">Presure</label>
                          <div class="form-inline">
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="presure" id="presure" value="Baik">
                              <label class="custom-label text-black" for="presure">Baik</label>
                            </div>
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="presure" id="presure" value="Tidak Baik">
                              <label class="custom-label text-black" for="presure">Tidak Baik</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 mb-3">
                          <label class="" for="">Catridge</label>
                          <div class="form-inline">
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="catridge" id="catridge" value="Baik">
                              <label class="custom-label text-black" for="catridge">Baik</label>
                            </div>
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="catridge" id="catridge" value="Tidak Baik">
                              <label class="custom-label text-black" for="catridge">Tidak Baik</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <label class="" for="">Pin</label>
                          <div class="form-inline">
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="pin" id="pin" value="Baik">
                              <label class="custom-label text-black" for="pin">Baik</label>
                            </div>
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="pin" id="pin" value="Tidak Baik">
                              <label class="custom-label text-black" for="pin">Tidak Baik</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 mb-3">
                          <label class="" for="">Handle</label>
                          <div class="form-inline">
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="handle" id="handle" value="Baik">
                              <label class="custom-label text-black" for="handle">Baik</label>
                            </div>
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" name="handle" id="handle" value="Tidak Baik">
                              <label class="custom-label text-black" for="handle">Tidak Baik</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <label for="berat">Berat</label>
                          <select class="form-control" name="berat" id="berat" required>
                            <option>Pilih...</option>
                            <option value="0,5 Kg">0,5 Kg</option>
                            <option value="1 Kg">1 Kg</option>
                            <option value="2 Kg">2 Kg</option>
                            <option value="2,3 Kg">2,3 Kg</option>
                            <option value="3 Kg">3 Kg</option>
                            <option value="4,5 Kg">4,5 Kg</option>
                            <option value="4,6 Kg">4,6 Kg</option>
                            <option value="5 Kg">5 Kg</option>
                            <option value="6 Kg">6 Kg</option>
                            <option value="6,8 Kg">6,8 Kg</option>
                            <option value="7 Kg">7 Kg</option>
                            <option value="9 Kg">9 Kg</option>
                            <option value="25 Kg">25 Kg</option>
                            <option value="50 Kg">50 Kg</option>
                            <option value="60 Kg">60 Kg</option>
                          </select>
                          <div class="invalid-feedback">
                            Valid Berat is required.
                          </div>
                        </div>
                        <?php
                        include '../koneksi.php';

                        $operatorName = trim($_SESSION['scan_name'] ?? '');
                        if ($operatorName === '') {
                          $user = $_SESSION['username'];
                          $query = "SELECT nama FROM user WHERE username='$user'";
                          $result = mysqli_query($koneksi, $query);
                          if ($result && $row = mysqli_fetch_assoc($result)) {
                            $operatorName = $row['nama'];
                          } else {
                            $operatorName = $user;
                          }
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
                        ?>

                        <input type="hidden" class="form-control" name="nama" id="namaApar" value="<?php echo htmlspecialchars($operatorName); ?>">

                        <input type="hidden" name="activity" id="activityApar" value="<?php echo htmlspecialchars($operatorName . ' Telah Melakukan Scan Pada Apar'); ?>">
                        <input type="hidden" name="tanggal" id="tanggalApar" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">



                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('scanResultAparModal')">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="scanResultHydrantModal" tabindex="-1" aria-labelledby="scanResultHydrantModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="scanResultHydrantModalLabel">Data Hydrant</h5>
                </div>
                <div class="modal-body">
                  <form action="proses/hydrant/proses_scan.php" method="post">
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label for="codeHydrant">Code Hydrant</label>
                        <input type="text" class="form-control" name="code_hydrant" id="codeHydrant" required>
                        <input type="hidden" name="idhydrant" id="idhydrant" value="" />
                        <input type="hidden" name="jenis_lokasi" id="jenis_lokasi" value="" />
                        <div class="invalid-feedback">
                          Valid Code Hydrant is required.
                        </div>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="NomerUrut">Nomer Urut</label>
                        <input type="text" name="NomerUrut" id="NomerUrut" class="form-control" required>

                        <div class="invalid-feedback">
                          Valid Lokasi is required.
                        </div>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="lokasiHydrant">Lokasi</label>
                        <input type="text" name="lokasiHydrant" id="lokasiHydrant" class="form-control" required>

                        <div class="invalid-feedback">
                          Valid Lokasi is required.
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="hose">Hose</label>
                        <div>
                          <input type="radio" name="hose" id="hoseBaik" value="Baik" required> Baik
                          <input type="radio" name="hose" id="hoseTidakBaik" value="Tidak Baik"> Tidak Baik
                        </div>
                        <div class="invalid-feedback">
                          Pilih kondisi Hose.
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="nozzleHydrant">Nozzle</label>
                        <div>
                          <input type="radio" name="nozzleHydrant" id="nozzleBaik" value="Baik" required> Baik
                          <input type="radio" name="nozzleHydrant" id="nozzleTidakBaik" value="Tidak Baik"> Tidak Baik
                        </div>
                        <div class="invalid-feedback">
                          Pilih kondisi Nozzle.
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="valve">Valve</label>
                        <div>
                          <input type="radio" name="valve" id="valveBaik" value="Baik" required> Baik
                          <input type="radio" name="valve" id="valveTidakBaik" value="Tidak Baik"> Tidak Baik
                        </div>
                        <div class="invalid-feedback">
                          Pilih kondisi Valve.
                        </div>
                      </div>

                      <div class="col-md-6 mb-3" id="kunciFieldWrapper">
                        <label for="kunci">Kunci</label>
                        <div>
                          <input type="radio" name="kunci" id="kunciBaik" value="Baik"> Baik
                          <input type="radio" name="kunci" id="kunciTidakBaik" value="Tidak Baik"> Tidak Baik
                        </div>
                        <div class="invalid-feedback">
                          Pilih kondisi Kunci.
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="sealKaretHose">Seal Karet Hose</label>
                        <div>
                          <input type="radio" name="seal_karet_hose" id="sealKaretHoseBaik" value="Baik" required> Baik
                          <input type="radio" name="seal_karet_hose" id="sealKaretHoseTidakBaik" value="Tidak Baik"> Tidak Baik
                        </div>
                        <div class="invalid-feedback">
                          Pilih kondisi Seal Karet Hose.
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="sealKaretNozzle">Seal Karet Nozzle</label>
                        <div>
                          <input type="radio" name="seal_karet_nozzle" id="sealKaretNozzleBaik" value="Baik" required> Baik
                          <input type="radio" name="seal_karet_nozzle" id="sealKaretNozzleTidakBaik" value="Tidak Baik"> Tidak Baik
                        </div>
                        <div class="invalid-feedback">
                          Pilih kondisi Seal Karet Nozzle.
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="boxHydrant">Box Hydrant</label>
                        <div>
                          <input type="radio" name="box_hydrant" id="boxHydrantBaik" value="Ada" required> Ada
                          <input type="radio" name="box_hydrant" id="boxHydrantTidakBaik" value="Tidak Ada"> Tidak Ada
                        </div>
                        <div class="invalid-feedback">
                          Pilih kondisi Box Hydrant.
                        </div>
                      </div>


                      <div class="col-md-6 mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keteranganHydrant" id="keteranganHydrant" rows="3"></textarea>
                        <div class="invalid-feedback">
                          Valid Keterangan is required.
                        </div>
                      </div>
                      <?php
                      include '../koneksi.php';

                      $operatorName = trim($_SESSION['scan_name'] ?? '');
                      if ($operatorName === '') {
                        $user = $_SESSION['username'];
                        $query = "SELECT nama FROM user WHERE username='$user'";
                        $result = mysqli_query($koneksi, $query);
                        if ($result && $row = mysqli_fetch_assoc($result)) {
                          $operatorName = $row['nama'];
                        } else {
                          $operatorName = $user;
                        }
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
                      ?>

                      <input type="hidden" class="form-control" name="nama" id="namaHydrant" value="<?php echo htmlspecialchars($operatorName); ?>">

                      <input type="hidden" name="activity" id="activityHydrant" value="<?php echo htmlspecialchars($operatorName . ' Telah Melakukan Scan Pada Hydrant'); ?>">
                      <input type="hidden" name="tanggal" id="tanggalHydrant" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" onclick="closeModal('scanResultHydrantModal')">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>


            <script>
              function onScanSuccess(decodedText) {
                // Ambil hasil scan dan buang spasi di awal/akhir
                const trimmedText = decodedText.trim();
                const normalizedText = trimmedText.toUpperCase();

                // Cek apakah kode yang discan adalah untuk APAR atau Hydrant
                const isApar = normalizedText.startsWith('AP');
                const isHydrant = normalizedText.startsWith('HDR');

                // Pilih URL endpoint berdasarkan tipe kode
                const url = isApar ?
                  `proses/get_data/get_apar_data.php?code_apar=${encodeURIComponent(trimmedText)}` :
                  isHydrant ?
                  `proses/get_data/get_hydrant_data.php?code_hydrant=${encodeURIComponent(trimmedText)}` :
                  null;

                // Jika URL valid, lanjutkan dengan permintaan data
                if (url) {
                  fetch(url)
                    .then(response => response.json())
                    .then(data => {
                      if (!data || data.error) {
                        const message = data && data.error ? data.error : 'Data tidak ditemukan';
                        showSweetAlert('error', 'Scan Gagal', message);
                        return;
                      }

                      if (data.already_scanned_by) {
                        showSweetAlert('warning', 'Scan Sudah Pernah Dilakukan', `Kode ini sudah di-scan bulan ini oleh ${data.already_scanned_by}`);
                        return;
                      }

                      const safe = value => value ?? '';
                      const setText = (elementId, value) => {
                        const target = document.getElementById(elementId);
                        if (target) {
                          target.value = safe(value);
                        }
                      };

                      if (isApar) {
                        // Periksa apakah ada plat nomor
                        const platNomorText = safe(data.plat_nomer).trim();
                        const hasPlatNomor = platNomorText !== '';

                        if (hasPlatNomor) {
                          document.getElementById('inputPlatNomor').style.display = 'block';
                          setText('platNomor', platNomorText);
                          document.getElementById('inputLokasi').style.display = 'none';
                          document.getElementById('inputDepartemen').style.display = 'none';
                        } else {
                          document.getElementById('inputPlatNomor').style.display = 'none';
                          setText('platNomor', '');
                          document.getElementById('inputLokasi').style.display = 'block';
                          document.getElementById('inputDepartemen').style.display = 'block';
                        }

                        // Isi data untuk APAR
                        setText('id', data.id);
                        setText('lokasi', data.lokasi);
                        setText('departemen', data.departemen);
                        setText('codeApar', data.code_apar);
                        setText('jenisApar', data.jenis_apar);
                        setText('berat', data.berat);
                        setText('vendor', data.vendor);
                        setText('tanggalPenggantian', data.tanggal_penggantian);
                        setText('tanggalRefill', data.tanggal_refill);
                        setText('tanggalExpired', data.tanggal_expired);

                        // Set radio buttons for APAR conditions
                        setRadioButton('kondisi', safe(data.kondisi));
                        setRadioButton('masa_pemakaian', safe(data.masa_pemakaian));
                        setRadioButton('nozzle', safe(data.nozzle));
                        setRadioButton('tabung', safe(data.tabung));
                        setRadioButton('presure', safe(data.presure));
                        setRadioButton('catridge', safe(data.catridge));
                        setRadioButton('pin', safe(data.pin));
                        setRadioButton('handle', safe(data.handle));

                        // Show APAR modal
                        $('#scanResultAparModal').modal('show');
                      } else if (isHydrant) {
                        setText('idhydrant', data.id);
                        setText('lokasiHydrant', data.lokasi);
                        setText('NomerUrut', data.nomer_urut);
                        setText('codeHydrant', data.code_hydrant);
                        setRadioButton('hose', safe(data.hose));
                        setRadioButton('nozzleHydrant', safe(data.nozzle));
                        setRadioButton('valve', safe(data.valve));
                        setRadioButton('seal_karet_hose', safe(data.seal_karet_hose));
                        setRadioButton('seal_karet_nozzle', safe(data.seal_karet_nozzle));
                        setRadioButton('box_hydrant', safe(data.box_hydrant));
                        setText('jenis_lokasi', data.jenis_lokasi);
                        setText('keteranganHydrant', data.keterangan);

                        // Kunci cuma berlaku untuk hydrant Outdoor. Untuk Indoor,
                        // field-nya disembunyikan & tidak wajib diisi.
                        var kunciWrapper = document.getElementById('kunciFieldWrapper');
                        var kunciRadios = document.getElementsByName('kunci');
                        if (data.jenis_lokasi === 'Outdoor') {
                          kunciWrapper.style.display = '';
                          kunciRadios.forEach(function (r) { r.required = true; });
                          setRadioButton('kunci', safe(data.kunci));
                        } else {
                          kunciWrapper.style.display = 'none';
                          kunciRadios.forEach(function (r) { r.required = false; r.checked = false; });
                        }

                        $('#scanResultHydrantModal').modal('show');
                      }
                    })
                    .catch(error => {
                      console.error('Error fetching data:', error);
                      showSweetAlert('error', 'Terjadi Kesalahan', 'Gagal mengambil data scan. Silakan coba lagi.');
                    });
                } else {
                  showSweetAlert('warning', 'Kode Tidak Valid', 'Scan tidak dikenali sebagai APAR atau Hydrant.');
                }
              }

              // Helper function to show modern alerts
              function showSweetAlert(type, title, text) {
                swal({
                  title: title,
                  text: text,
                  icon: type,
                  button: {
                    text: 'OK',
                    className: 'btn btn-primary'
                  },
                  closeOnClickOutside: false,
                  closeOnEsc: true
                });
              }

              // Helper function to set the radio button
              function setRadioButton(name, value) {
                const radioButtons = document.getElementsByName(name);
                radioButtons.forEach(radio => {
                  if (radio.value === value) {
                    radio.checked = true;
                  }
                });
              }

              // Buat instance baru untuk scanner
              let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                  fps: 10,
                  qrbox: 250
                }
              );

              // Mulai scanning
              html5QrcodeScanner.render(onScanSuccess);

              document.addEventListener('DOMContentLoaded', function() {
                if (window.scanErrorMessage) {
                  showSweetAlert('warning', 'Scan Ditolak', window.scanErrorMessage);
                }
              });

              function closeModal(modalId) {
                $(`#${modalId}`).modal('hide'); // Menutup modal menggunakan Bootstrap
              }

              // Event Listener untuk tombol close
              document.querySelectorAll('.btn-close').forEach(button => {
                button.addEventListener('click', function() {
                  const modal = this.closest('.modal'); // Cari modal terdekat
                  if (modal) {
                    $(modal).modal('hide');
                  }
                });
              });
            </script>



          </div>

        </div>
      </main>
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


</body>

</html>