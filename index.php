<?php
session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
  // Jika belum login, arahkan ke login.php
  header("Location: login.php");
  exit();
}

// Tambahkan kode lainnya untuk index.php di bawah sini
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Cek Apar - Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets/img/logokecil.png" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
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
        urls: ["assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>


<body onload="checkExpiredAparCount(); checkWarningAparCount();checkUninspectedApar() ">
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.php" class="logo">
            <img src="assets/img/logo.png" alt="navbar brand" class="navbar-brand" height="200px" width="200px" />
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

            <li class="nav-item active">
              <a href="index.php">
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
              <a href="admin/scan.php">
                <i class="fa-solid fa-qrcode"></i>
                <p>Scan Code</p>

              </a>
            </li>
            <li class="nav-item">
              <a href="admin/user.php">
                <i class="fas fa-address-card"></i>
                <p>Data Pengguna</p>

              </a>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#apar">
              <i class="fa-solid fa-fire-extinguisher"></i>
                <p>Data Master Apar</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="apar">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="admin/apar.php">
                      <span class="sub-item">Data Apar</span>
                    </a>
                  </li>
                  <li>
                    <a href="admin/apar_mobil.php">
                      <span class="sub-item">Data Apar Mobil</span>
                    </a>
                  </li>
                  <li>
                    <a href="admin/jenis_apar.php">
                      <span class="sub-item">Jenis Apar</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>


            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#maps">
                <i class="fas fa-map-marker-alt"></i>
                <p>Area Apar</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="maps">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="admin/lokasi.php">
                      <span class="sub-item">Lokasi Apar</span>
                    </a>
                  </li>
                  <li>
                    <a href="admin/departemen.php">
                      <span class="sub-item">Departemen</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="admin/activity.php">
              <i class="fa-solid fa-clock-rotate-left"></i>
                <p>Aktivitas Pengguna</p>

              </a>
            </li>

            <li class="nav-item">
              <a href="admin/calender-exp.php">
              <i class="fa-regular fa-calendar"></i>
                <p>Kalender Apar</p>

              </a>
            </li>

            <li class="nav-item">
              <a href="admin/agenda.php">
                <i class="fa-solid fa-calendar-xmark"></i>
                <p>Agenda Inspeksi</p>

              </a>
            </li>
            <li class="nav-item">
              <a href="admin/laporan.php">
                <i class="fa-solid fa-bullhorn"></i>
                <p>Laporan Inspeksi</p>

              </a>
            </li>
            
            


            <li class="nav-item">
              <a href="admin/logout.php">
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
            <a href="index.php" class="logo">
              <img src="assets/img/logo.png" alt="navbar brand" class="navbar-brand" height="200px" width="200px" />
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
                        var thisDay = date.getDay(),r
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
            include 'koneksi.php';

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
                        include 'koneksi.php';

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
                        if ($expired_result->num_rows > 0) {
                          while ($row = $expired_result->fetch_assoc()) {
                            echo "  <a href='#'>";
                            echo "  <div class='notif-icon'>";
                            echo "  <img src='assets/img/danger.png' width='40px'>";
                            echo " </div>";
                            echo "  <div class='notif-content'>";
                            echo "    <span class='block'>" . $row["code_apar"] . ", Sudah Melewati Waktu Expired!! " . "</span>";

                            echo "  </div>";
                            echo "</a>";
                          }
                        }
                        if ($near_expiry_result->num_rows > 0) {
                          while ($row = $near_expiry_result->fetch_assoc()) {
                            echo "  <a href='#'>";
                            echo "  <div class='notif-icon '>";
                            echo "   <img src='assets/img/warning.png' width='40px'> ";
                            echo " </div>";
                            echo "  <div class='notif-content'>";
                            echo "    <span class='block'>" . $row["code_apar"] . ", Mendekati Waktu Expired " . "</span>";

                            echo "  </div>";
                            echo "</a>";
                          }
                        }

                        ?>


                      </div>
                    </div>
                  </li>
                  <li>
                    <a class="see-all" href="notif.php">See all notifications<i class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>
              <?php
              include 'koneksi.php';

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
                      <img src="assets/img/orang.png" alt="..." class="avatar-img rounded-circle" />
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

      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            
            <div>
              <h3 class="fw-bold mb-3">Dashboard</h3>

            </div>

          </div>  


          <div class="row justify-content-center">
            <div class="col-sm- col-md-3">
              <a href="admin/scan.php">
                <div class="card card-stats card-round">
                  <div class="card-body custom-card-body text-center">
                    <div class="col-icon">
                      <div class="icon-big bubble-shadow-small">
                   
                        <img src="assets/img/barcode.png" class="blue-barcode" width="70px">
                      </div>
                    </div>
                    <div class="col col-stats mt-2">
                      <div class="numbers">
                        <p class="card-category text-black">Scan QR Code</p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-sm-6 col-md-3">
              <a href="admin/apar.php">
                <div class="card card-stats card-round">
                  <div class="card-body custom-card-body text-center">
                    <div class="col-icon">
                      <div class="icon-big bubble-shadow-small">
                        <img src="assets/img/inv.png" class="blue-barcode" width="70px">
                      </div>
                    </div>
                    <div class="col col-stats mt-2">
                      <div class="numbers">
                        <p class="card-category text-black">Inventory</p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-sm-6 col-md-3">
              <a href="admin/agenda.php">
                <div class="card card-stats card-round">
                  <div class="card-body custom-card-body text-center">
                    <div class="col-icon">
                      <div class="icon-big bubble-shadow-small">
                        <img src="assets/img/agenda.png" class="blue-barcode" width="70px">
                      </div>
                    </div>
                    <div class="col col-stats mt-2">
                      <div class="numbers">
                        <p class="card-category text-black">Agenda Inspeksi</p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
<div class="row justify-content-center ">
            <div class="col-sm-6 col-md-3">
              <a href="admin/rusak_exp.php?filter=expired_damaged">
                <div class="card card-stats card-round">
                  <div class="card-body custom-card-body text-center">
                    <div class="col-icon">
                      <div class="icon-big bubble-shadow-small">
                        <img src="assets/img/aparnew.png" class="blue-barcode" width="150px">
                      </div>
                    </div>
                    <div class="col col-stats mt-2">
                      <div class="numbers">
                        <p class="card-category text-black">Rusak & Expired</p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-sm-6 col-md-3">
              <a href="admin/laporan.php">
                <div class="card card-stats card-round">
                  <div class="card-body custom-card-body text-center">
                    <div class="col-icon">
                      <div class="icon-big bubble-shadow-small">
                        <img src="assets/img/laporannew.png" class="blue-barcode" width="65px">
                      </div>
                    </div>
                    <div class="col col-stats mt-2">
                      <div class="numbers">
                        <p class="card-category text-black">Laporan Inspeksi</p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-sm-6 col-md-3">
              <a class="ab" href="admin/user.php">
                <div class="card card-stats card-round">
                  <div class="card-body custom-card-body text-center">
                    <div class="col-icon">
                      <div class="icon-big bubble-shadow-small">
                        <img src="assets/img/penggunanew.png" class="blue-barcode" width="100px">
                      </div>
                    </div>
                    <div class="col col-stats mt-2">
                      <div class="numbers">
                        <p class="card-category text-black">Pengguna</p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <style>
          .card:hover {
            background-color: rgba(0, 0, 0, 0.283);
            transform: scale(1.05);
            /* Contoh animasi scaling saat hover */
            transition: transform 0.3s ease;
            /* Efek transisi */
          }

          .custom-card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 150px;
            /* Adjust height as needed */
            border: 5px solid black;
            border-radius: 20px;
          }

          .icon-big {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            /* Adjust icon size as needed */
            height: 100px;
            /* Adjust icon size as needed */
          }

          .card-category {
            font-size: 14px;
          }

          .card-stats {
            margin-bottom: 20px;
          }
        </style>

        <center>
          <?php
          include 'koneksi.php';
          $query = "SELECT COUNT(*) AS total_user FROM user";
          $result = mysqli_query($koneksi, $query);

          if (!$result) {
            die("Query error: " . mysqli_error($koneksi));
          }

          $row = mysqli_fetch_assoc($result);
          $total_siswa = $row['total_user'];

          $koneksi->close();
          ?>

          <div class="row justify-content-center">
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Total Pengguna</p>
                        <h4 class="card-title"><?php echo $row['total_user']; ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php
            include 'koneksi.php';
            $query = "SELECT COUNT(*) AS total_apar FROM data_apar";
            $result = mysqli_query($koneksi, $query);

            if (!$result) {
              die("Query error: " . mysqli_error($koneksi));
            }

            $row = mysqli_fetch_assoc($result);
            $total_siswa = $row['total_apar'];

            $koneksi->close();
            ?>

            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-info bubble-shadow-small">
                        <i class="fa-solid fa-fire-extinguisher"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Total Apar</p>
                        <h4 class="card-title"><?php echo $row['total_apar']; ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            include 'koneksi.php';
            $query = "SELECT COUNT(*) AS total_ins FROM events";
            $result = mysqli_query($koneksi, $query);

            if (!$result) {
              die("Query error: " . mysqli_error($koneksi));
            }

            $row = mysqli_fetch_assoc($result);
            $total_siswa = $row['total_ins'];

            $koneksi->close();
            ?>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-success bubble-shadow-small" style="background-color: #059212;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Total Inspeksi</p>
                        <h4 class="card-title"><?php echo $row['total_ins']; ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </center>



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
  <link href="assets/css/bs4Toast.css" rel="stylesheet" >
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bs4-toast.js"></script>

<script>
  function dangerT(count) {
    console.log('danger');
    bs4Toast.error('Sudah Expired', 'Ada ' + count + ' APAR Yang Sudah Expired');
  }

  function warning(count) {
    console.log('warning');
    bs4Toast.warning('Peringatan', 'Ada ' + count + ' APAR yang mendekati tanggal kadaluarsa');
  }

  function toast(count, date) {
    bs4Toast.primary('Peringatan Inspeksi', 'Ada ' + count + ' Yang Belum Di Inspeksi Pada Tanggal ' + date);
  }




  function checkExpiredAparCount() {
    fetch('expired.php')
      .then(response => response.json())
      .then(data => {
        if (data.expired_count > 0) {
          dangerT(data.expired_count);
        }
      })
      .catch(error => console.error('Error fetching expired APAR count:', error));
  }

  function checkWarningAparCount() {
    fetch('mendekati_exp.php')
      .then(response => response.json())
      .then(data => {
        if (data.warning_count > 0) {
          warning(data.warning_count);
        }
      })
      .catch(error => console.error('Error fetching warning APAR count:', error));
  }

  

  function checkUninspectedApar() {
    fetch('inspeksi.php')
      .then(response => response.json())
      .then(data => {
        data.forEach(item => {
          toast(item.uninspected_count, item.start);
        });
      })
      .catch(error => console.error('Error fetching uninspected APAR data:', error));
  }
</script>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  < <script>
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
  </>
</body>

</html>