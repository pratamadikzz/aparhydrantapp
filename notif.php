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

<body>
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

            <li class="nav-item">
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
              <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
        <section>
            <div class="square_box box_three"></div>
            <div class="square_box box_four"></div>
            <div class="container mt-5">
                <div class="row">
                    <?php
                    // SQL query untuk item yang stoknya mendekati habis (quantity <= 5)
                    $low_stock_sql = "SELECT * FROM data_apar WHERE quantity <= 5";
                    $low_stock_result = $koneksi->query($low_stock_sql);

                    // SQL query untuk item yang mendekati kadaluarsa dalam 30 hari ke depan
                    $near_expiry_sql = "
                    SELECT da.*, l.lokasi, d.departemen
                    FROM data_apar da
                    JOIN tbl_lokasi l ON da.lokasi = l.id
                    JOIN tbl_departemen d ON da.departemen = d.id
                    WHERE da.tanggal_expired BETWEEN '$current_date' AND DATE_ADD('$current_date', INTERVAL 30 DAY)";
                    $near_expiry_result = $koneksi->query($near_expiry_sql);
                    if (!$near_expiry_result) {
                        die("Near Expiry Query failed: " . $koneksi->error);
                    }

                    // SQL query for expired items
                    $expired_sql = "
                    SELECT da.*, l.lokasi, d.departemen
                    FROM data_apar da
                    JOIN tbl_lokasi l ON da.lokasi = l.id
                    JOIN tbl_departemen d ON da.departemen = d.id
                    WHERE da.tanggal_expired < '$current_date'";
                    $expired_result = $koneksi->query($expired_sql);
                    if (!$expired_result) {
                        die("Expired Query failed: " . $koneksi->error);
                    }

                    // SQL query for items that are not suitable (layak = 'Tidak Layak')
                    $not_suitable_sql = "
                    SELECT da.*, l.lokasi, d.departemen
                    FROM data_apar da
                    JOIN tbl_lokasi l ON da.lokasi = l.id
                    JOIN tbl_departemen d ON da.departemen = d.id
                    WHERE da.kondisi = 'Tidak Layak'";
                    $not_suitable_result = $koneksi->query($not_suitable_sql);
                    if (!$not_suitable_result) {
                        die("Not Suitable Query failed: " . $koneksi->error);
                    }

                    
                    if ($not_suitable_result->num_rows > 0) {
                      while ($row = $not_suitable_result->fetch_assoc()) {
                          echo "<div class='col-sm-12'>";
                          echo "<div class='alert alert-danger' role='alert' data-brk-library='component__alert'>";
                          echo "<i class='start-icon fa fa-ban faa-flash animated'></i>";
                          echo "<strong class='font__weight-semibold'>{$row['code_apar']} Lokasi: {$row['lokasi']} | Departemen: {$row['departemen']} |</strong> Sudah Tidak Layak";
                          echo "</div>";
                          echo "</div>";
                      }
                  }
                    // Display near expiry items
                    if ($near_expiry_result->num_rows > 0) {
                        while ($row = $near_expiry_result->fetch_assoc()) {
                            echo "<div class='col-sm-12'>";
                            echo "<div class='alert alert-warning' role='alert' data-brk-library='component__alert'>";
                            echo "<i class='start-icon fa fa-exclamation-triangle faa-flash animated'></i>";
                            echo "<strong class='font__weight-semibold'>{$row['code_apar']} Lokasi: {$row['lokasi']} | Departemen: {$row['departemen']} | Tanggal Expired: {$row['tanggal_expired']} |</strong> Mendekati Waktu Expired";
                            echo "</div>";
                            echo "</div>";
                        }
                    }

                    // Display expired items
                    if ($expired_result->num_rows > 0) {
                        while ($row = $expired_result->fetch_assoc()) {
                            echo "<div class='col-sm-12'>";
                            echo "<div class='alert alert-danger' role='alert' data-brk-library='component__alert'>";
                            echo "<i class='start-icon far fa-times-circle faa-pulse animated'></i>";
                            echo "<strong class='font__weight-semibold'>{$row['code_apar']} Lokasi: {$row['lokasi']} | Departemen: {$row['departemen']} | Tanggal Expired: {$row['tanggal_expired']} |</strong> Sudah Melewati Waktu Expired!!";
                            echo "</div>";
                            echo "</div>";
                        }
                    }

                    // Display items that are not suitable
                   
                    ?>
                </div>
            </div>
        </section>
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