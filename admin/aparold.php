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
  <title>Cek Apar - Data Apar</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="../assets/img/logokecil.png" type="image/x-icon" />

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
            <img src="../assets/img/logo.png" alt="navbar brand" class="navbar-brand" height="200px" width="200px" />
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
            <li class="nav-item">
              <a href="user.php">
                <i class="fas fa-address-card"></i>
                <p>Data Pengguna</p>

              </a>
            </li>
            <li class="nav-item">
              <a href="apar.php">
                <i class="fa-solid fa-fire-extinguisher"></i>
                <p>Data Apar</p>

              </a>
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
                      <span class="sub-item">Lokasi Apar</span>
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
              <a href="agenda.php">
                <i class="fa-solid fa-calendar-xmark"></i>
                <p>Agenda Inspeksi</p>

              </a>
            </li>
            <li class="nav-item">
              <a href="laporan.php">
                <i class="fa-solid fa-bullhorn"></i>
                <p>Laporan Inspeksi</p>

              </a>
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
              <img src="../assets/img/logo.png" alt="navbar brand" class="navbar-brand" height="200px" width="200px" />
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

                        ?>


                      </div>
                    </div>
                  </li>
                  <li>
                    <a class="see-all" href="../notif.php">See all notifications<i class="fa fa-angle-right"></i>
                    </a>
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
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" style="position: absolute;right: 90px;">
                        Tambah Data Apar
                      </button>
                      <div class="col-md-5">


                        <input type="text" id="searchInput" class="form-control" placeholder="Search..">
                        <br>
                      </div>



                      <thead style="background-color:yellow;">
                        <tr align="center">
                          <th style="background-color:yellow;"> No </th>
                          <th style="background-color:yellow;"> Code Apar </th>
                          <th style="background-color:yellow;"> Lokasi </th>
                          <th style="background-color:yellow;"> Departemen </th>
                          <th style="background-color:yellow;"> Jenis Apar </th>
                          <th style="background-color:yellow;"> Tanggal Refill </th>
                          <th style="background-color:yellow;"> Tanggal Expired </th>
                          <th style="background-color:yellow;">
                            <div class="header-container">
                              <span>Nozzle</span>
                              <div class="buttons-container">
                                <button class="filter-btn" onclick="filterTable('nozzle', 'Baik')">↑</button>
                                <button class="filter-btn" onclick="filterTable('nozzle', 'Tidak Baik')">↓</button>
                              </div>
                            </div>
                          </th>
                          <th style="background-color:yellow;">
                            <div class="header-container">
                              <span>Tabung</span>
                              <div class="buttons-container">
                                <button class="filter-btn" onclick="filterTable('tabung', 'Baik')">↑</button>
                                <button class="filter-btn" onclick="filterTable('tabung', 'Tidak Baik')">↓</button>
                              </div>
                            </div>
                          </th>
                          <th style="background-color:yellow;">
                            <div class="header-container">
                              <span>Pressure</span>
                              <div class="buttons-container">
                                <button class="filter-btn" onclick="filterTable('presure', 'Baik')">↑</button>
                                <button class="filter-btn" onclick="filterTable('presure', 'Tidak Baik')">↓</button>
                              </div>
                            </div>
                          </th>
                          <th style="background-color:yellow;">
                            <div class="header-container">
                              <span>Catridge</span>
                              <div class="buttons-container">
                                <button class="filter-btn" onclick="filterTable('catridge', 'Baik')">↑</button>
                                <button class="filter-btn" onclick="filterTable('catridge', 'Tidak Baik')">↓</button>
                              </div>
                            </div>
                          </th>
                          <th style="background-color:yellow;">
                            <div class="header-container">
                              <span>Pin</span>
                              <div class="buttons-container">
                                <button class="filter-btn" onclick="filterTable('pin', 'Baik')">↑</button>
                                <button class="filter-btn" onclick="filterTable('pin', 'Tidak Baik')">↓</button>
                              </div>
                            </div>
                          </th>
                          <th style="background-color:yellow;">
                            <div class="header-container">
                              <span>Handle</span>
                              <div class="buttons-container">
                                <button class="filter-btn" onclick="filterTable('handle', 'Baik')">↑</button>
                                <button class="filter-btn" onclick="filterTable('handle', 'Tidak Baik')">↓</button>
                              </div>
                            </div>
                          </th>
                          <th style="background-color:yellow;"> Berat </th>
                          <th style="background-color:yellow;"> Aksi </th>
                        </tr>
                      </thead>
                      <tbody style="background-color:white;">
                        <?php
                        include('../koneksi.php');

                        // Menentukan jumlah baris per halaman
                        $baris_per_halaman = 10;

                        // Hitung total baris data
                        $query_total = "SELECT COUNT(*) AS total FROM data_apar";
                        $result_total = mysqli_query($koneksi, $query_total);
                        $row_total = mysqli_fetch_assoc($result_total);
                        $total_data = $row_total['total'];

                        // Hitung jumlah halaman
                        $total_halaman = ceil($total_data / $baris_per_halaman);

                        // Tentukan halaman saat ini
                        $halaman_sekarang = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $mulai_data = ($halaman_sekarang - 1) * $baris_per_halaman;

                        // Query data dengan batasan offset
                        $query = "SELECT * FROM data_apar ORDER BY id ASC LIMIT $mulai_data, $baris_per_halaman";
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                          die("query error: " . mysqli_error($koneksi));
                        }

                        $no = $mulai_data + 1; // Nomor urut dimulai dari offset + 1

                        // Loop untuk menampilkan data
                        while ($row = mysqli_fetch_assoc($result)) {
                          $edit_modal_id = "editModal" . $row['id']; // ID modal yang unik
                        ?>
                          <tr>
                            <td style="text-align: center;"><?php echo $no; ?></td>
                            <td><?php echo $row['code_apar']; ?></td>
                            <td><?php echo $row['lokasi']; ?></td>
                            <td><?php echo $row['departemen']; ?></td>
                            <td><?php echo $row['jenis_apar']; ?></td>
                            <td><?php echo $row['tanggal_refill']; ?></td>
                            <td><?php echo $row['tanggal_expired']; ?></td>
                            <td><?php echo $row['nozzle']; ?></td>
                            <td><?php echo $row['tabung']; ?></td>
                            <td><?php echo $row['presure']; ?></td>
                            <td><?php echo $row['catridge']; ?></td>
                            <td><?php echo $row['pin']; ?></td>
                            <td><?php echo $row['handle']; ?></td>
                            <td><?php echo $row['berat']; ?></td>
                            <td style="text-align: center;">
                              <div class="btn-group">
                                <a title="scan" class="btn btn-primary" style="font-size: 20px;" href="generate.php?code=<?php echo $row['code_apar']; ?>"><i class="fa-solid fa-qrcode"></i></a>
                                <button type="button" class="btn btn-warning" data-toggle="modal" style="font-size: 20px;" data-target="#<?php echo $edit_modal_id; ?>"><i class=" fa-solid fa-pen-to-square"></i></button>
                                <a title="hapus" class="btn btn-danger" style="font-size: 20px;" href="proses/apar/proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')"><i class="fa-solid fa-trash-can"></i></a>
                              </div>
                            </td>
                          </tr>

                      </tbody>
                      <div class="modal fade" id="<?php echo $edit_modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="proses/apar/proses_edit-apar.php" method="post">
                                <div class="row">
                                  <div class="col-md-12 mb-3">
                                    <label for="codeApar">Code Apar</label>
                                    <input type="text" class="form-control" name="code_apar" id="codeApar" value="<?php echo $row['code_apar']; ?>" required="">
                                    <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>" />
                                    <div class="invalid-feedback">
                                      Valid Code Apar is required.
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi" id="lokasi" value="<?php echo $row['lokasi']; ?>" required="">
                                    <div class="invalid-feedback">
                                      Valid Lokasi is required.
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 mb-3">
                                    <label for="departemen">Departemen</label>
                                    <input type="text" class="form-control" name="departemen" id="departemen" value="<?php echo $row['departemen']; ?>" required="">
                                    <div class="invalid-feedback">
                                      Valid Departemen is required.
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <label for="jenisApar">Jenis Apar</label>
                                    <input type="text" class="form-control" name="jenis_apar" id="jenisApar" value="<?php echo $row['jenis_apar']; ?>" required="">
                                    <div class="invalid-feedback">
                                      Valid Jenis Apar is required.
                                    </div>
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="jenisApar">Tanggal Refill</label>
                                    <input type="date" class="form-control" name="tanggal_refill" id="jenisApar" value="<?php echo $row['tanggal_refill']; ?>" required="">
                                    <div class="invalid-feedback">
                                      Valid Tanggal Refill is required.
                                    </div>
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="jenisApar">Tanggal Expired</label>
                                    <input type="date" class="form-control" name="tanggal_expired" id="jenisApar" value="<?php echo $row['tanggal_expired']; ?>" required="">
                                    <div class="invalid-feedback">
                                      Valid Tanggal Expired is required.
                                    </div>
                                  </div>
                                </div>
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
                                        <input class="form-check-input" type="radio" name="nozzle" id="nozzle_baik" value="Baik" <?php echo ($row['nozzle'] == 'Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="nozzle_baik">Baik</label>
                                      </div>
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="nozzle" id="nozzle_tidak_baik" value="Tidak Baik" <?php echo ($row['nozzle'] == 'Tidak Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="nozzle_tidak_baik">Tidak Baik</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <label class="" for="">Tabung</label>
                                    <div class="form-inline">
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="tabung" id="tabung_baik" value="Baik" <?php echo ($row['tabung'] == 'Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="tabung_baik">Baik</label>
                                      </div>
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="tabung" id="tabung_tidak_baik" value="Tidak Baik" <?php echo ($row['tabung'] == 'Tidak Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="tabung_tidak_baik">Tidak Baik</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 mb-3">
                                    <label class="" for="">Presure</label>
                                    <div class="form-inline">
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="presure" id="presure_baik" value="Baik" <?php echo ($row['presure'] == 'Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="presure_baik">Baik</label>
                                      </div>
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="presure" id="presure_tidak_baik" value="Tidak Baik" <?php echo ($row['presure'] == 'Tidak Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="presure_tidak_baik">Tidak Baik</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <label class="" for="">Catridge</label>
                                    <div class="form-inline">
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="catridge" id="catridge_baik" value="Baik" <?php echo ($row['catridge'] == 'Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="catridge_baik">Baik</label>
                                      </div>
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="catridge" id="catridge_tidak_baik" value="Tidak Baik" <?php echo ($row['catridge'] == 'Tidak Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="catridge_tidak_baik">Tidak Baik</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 mb-3">
                                    <label class="" for="">Pin</label>
                                    <div class="form-inline">
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="pin" id="pin_baik" value="Baik" <?php echo ($row['pin'] == 'Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="pin_baik">Baik</label>
                                      </div>
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="pin" id="pin_tidak_baik" value="Tidak Baik" <?php echo ($row['pin'] == 'Tidak Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="pin_tidak_baik">Tidak Baik</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <label class="" for="">Handle</label>
                                    <div class="form-inline">
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="handle" id="handle_baik" value="Baik" <?php echo ($row['handle'] == 'Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="handle_baik">Baik</label>
                                      </div>
                                      <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="handle" id="handle_tidak_baik" value="Tidak Baik" <?php echo ($row['handle'] == 'Tidak Baik') ? 'checked' : ''; ?>>
                                        <label class="custom-label text-black" for="handle_tidak_baik">Tidak Baik</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 mb-3">
                                    <label for="berat">Berat</label>
                                    <input type="text" class="form-control" name="berat" id="berat" value="<?php echo $row['berat']; ?>" required="">
                                    <div class="invalid-feedback">
                                      Valid Berat is required.
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    <?php
                          $no++;
                        }
                    ?>
                    </table>
                    <nav aria-label="Page navigation example" class="mt-4">
                      <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
                          <li class="page-item <?php echo ($i == $halaman_sekarang) ? 'active' : ''; ?>">
                            <a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
                          </li>
                        <?php endfor; ?>
                      </ul>
                    </nav>
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
      <style>
        .filter-btn {
          background: none;
          border: none;
          cursor: pointer;
          font-size: 12px;
          margin: 0;
          padding: 0;
        }

        .filter-btn:hover {
          text-decoration: underline;
        }

        .header-container {
          display: flex;
          justify-content: space-between;
          align-items: center;
        }

        .buttons-container {
          display: flex;
          gap: 5px;
          /* Adjust the gap between buttons as needed */
        }

        .filter-btn {
          /* Optional: Additional styling for the filter buttons */
        }
      </style>
      <script>
        function filterTable(column, value) {
          const table = document.getElementById('table');
          const tr = table.getElementsByTagName('tr');
          for (let i = 1; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName('td')[getColumnIndex(column)];
            if (td) {
              const tdValue = td.textContent || td.innerText;
              if (tdValue.includes(value)) {
                tr[i].style.display = '';
              } else {
                tr[i].style.display = 'none';
              }
            }
          }
        }

        function getColumnIndex(columnName) {
          switch (columnName) {
            case 'nozzle':
              return 7;
            case 'tabung':
              return 8;
            case 'presure':
              return 9;
            case 'catridge':
              return 10;
            case 'pin':
              return 11;
            case 'handle':
              return 12;
            default:
              return -1;
          }
        }

        function resetTable() {
          const table = document.getElementById('table');
          const tr = table.getElementsByTagName('tr');
          for (let i = 1; i < tr.length; i++) {
            tr[i].style.display = '';
          }
        }
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
<?php
include('../koneksi.php');
// Ambil nomor pendaftaran tertinggi dari tabel data_siswa
$sql = "SELECT MAX(code_apar) AS max_registration_number FROM data_apar";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $last_registration_number = $row["max_registration_number"];

  // Jika tidak ada nomor pendaftaran sebelumnya, mulai dari BYR001
  if ($last_registration_number === null) {
    $new_registration_number = "AP001";
  } else {
    // Ubah nomor pendaftaran terakhir ke nomor pendaftaran baru
    $last_number = intval(substr($last_registration_number, 3));
    $next_number = $last_number + 1;
    $new_registration_number = "AP" . sprintf("%03d", $next_number);
  }
} else {
  // Penanganan kesalahan jika query tidak berhasil
  echo "Error: " . $koneksi->error;
}

// Gunakan $new_registration_number sesuai kebutuhan di sini



?>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Apar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" action="proses/apar/proses_tambah_apar.php" method="post">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="firstName">Code Apar</label>
              <input type="text" class="form-control" name="code_apar" id="firstName" placeholder="" value="<?php echo $new_registration_number; ?>" required="" readonly style="color: black;" required="">
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
            <?php

            $query = "SELECT * FROM tbl_lokasi ORDER BY id ASC";
            $result = mysqli_query($koneksi, $query);

            if (!$result) {
              die("query error: " . mysqli_error($koneksi));
            }
            ?>
            <div class="col-md-6 mb-3">
              <label for="lokasi">Lokasi</label>
              <select class="custom-select d-block w-100" name="lokasi" id="lokasi" required="">
                <option value="">Pilih...</option>
                <?php
                // Langkah 3: Iterasi hasil query
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['lokasi'] . '">' . $row['lokasi'] . '</option>';
                }
                ?>
              </select>


              <div class="invalid-feedback">
                Valid lokasi is required.
              </div>
            </div>
            <?php

            $query = "SELECT * FROM tbl_departemen ORDER BY id ASC";
            $result = mysqli_query($koneksi, $query);

            if (!$result) {
              die("query error: " . mysqli_error($koneksi));
            }
            ?>
            <div class="col-md-6 mb-3">
              <label for="lastName">Departemen</label>
              <select class="custom-select d-block w-100" name="departemen" id="departemen" required="">
                <option value="">Pilih...</option>
                <?php
                // Langkah 3: Iterasi hasil query
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['departemen'] . '">' . $row['departemen'] . '</option>';
                }
                ?>
              </select>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="firstName">Jenis Apar</label>

              <select class="custom-select d-block w-100" name="jenis_apar" id="jenis_apar" required="">
                <option value="">Pilih....</option>
                <option value="Air / Water"> Air / Water</option>
                <option value="Busa / Foam">Busa / Foam</option>
                <option value="Serbuk Kimia / Dry Chemical Powder">Serbuk Kimia / Dry Chemical Powder</option>
                <option value="Karbon Dioksida / Carbon Dioxide (CO2)">Karbon Dioksida / Carbon Dioxide (CO2)</option>
                <option value="inergen">INERGEN</option>

              </select>

              <input type="hidden" name="nozzle" />
              <input type="hidden" name="tabung" />
              <input type="hidden" name="presure" />
              <input type="hidden" name="catridge" />
              <input type="hidden" name="pin" />
              <input type="hidden" name="handle" />
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Tanggal Refill</label>
              <input type="date" class="form-control" name="tanggal_refill" id="lastName" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Tanggal Expired</label>
              <input type="date" class="form-control" name="tanggal_expired" id="lastName" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="lastName">Berat</label>
              <input type="text" class="form-control" name="berat" id="lastName" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

</html>