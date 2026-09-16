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

// Tambahkan kode lainnya untuk index.php di bawah sini
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Cek Apar | Hydrant  - Data Hydrant</title>
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
                <li class="active">
                    <a href="hydrant.php">
                      <span class="sub-item">Data Hydrant</span>
                    </a>
                  </li>
                  <li >
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
            <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="../assets/js/html5-qrcode.min.js"></script>
            <script src="../assets/js/jquery.dataTables.min.js"></script>

            <style>
                .center-button {
                    display: flex;
                    justify-content: flex-start;
                    margin-bottom: 20px;
                }
            </style>
            <div class="container">
                <div class="page-inner">
                    <br>
                    <br>
                    <br>
                    <hr>
                    <!-- Button to trigger SweetAlert -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                                Tambah Hydrant
                            </button>
                            <a href="proses/export/export.php" target="_blank" class="btn btn-info btn-icon-split" style="margin-left: 20px;">
                  <span class="icon text-white-55">
                    <i class="fas fa-print"></i>
                  </span>
                  <span class="text">Export Data Hydrant</span>
                </a>
                
                            <hr>
<!-- Modal for OUTDOOR -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                
                                <div class="card-header">
                                    <h4 class="card-title">Data Hydrant Dalam</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="height-400">
                                            <div class="table-responsive">
                                                <table id="example" class="display table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr style="background-color: #B22222; color: white;">
                                                            <th rowspan="2">No</th>
                                                            <th rowspan="2">Code Hydrant</th>
                                                            <th rowspan="2">Nomer Urut</th>
                                                            <th rowspan="2">Lokasi</th>
                                                      
                                                            <th colspan="2">Hose</th>
                                                            <th colspan="2">Nozzle</th>
                                                            <th colspan="2">Valve</th>
                                                            <th colspan="2">Seal Karet Hose Coupling</th>
                                                            <th colspan="2">Seal Karet Nozzle</th>
                                                            <th colspan="2">Box Hydrant</th>
                                                            <th rowspan="2">Keterangan</th>
                                                            <th rowspan="2">Aksi</th>
                                                        </tr>
                                                        <tr style="background-color: #B22222; color: white;">
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Ada</th>
                                                            <th>Tidak Ada</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="background-color:white;">
                                                        <?php
                                                        include('../koneksi.php');
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


                                                        // Query to fetch only records where jenis_lokasi is 'Outdoor'
                                                         $query = "SELECT * FROM data_hydrant WHERE jenis_lokasi = 'Indoor' ORDER BY CAST(nomer_urut AS UNSIGNED) ASC";
                                                        $result = mysqli_query($koneksi, $query);
                                                        if (!$result) {
                                                            die("query error: " . mysqli_error($koneksi));
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
                                                            $selected_location = $row['lokasi'];


                                                        ?>
                                                            <tr align="center">
                                                                <td style="text-align: center;"><?php echo $no; ?></td>
                                                                <td><?php echo $row['code_hydrant']; ?></td>
                                                                <td><?php echo $row['nomer_urut']; ?></td>
                                                                <td><?php echo $row['lokasi']; ?></td>
                                                          
                                                                <td>
                                                                    <?php if ($row['hose'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['hose'] != 'Baik' && !empty($row['hose'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['nozzle'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['nozzle'] != 'Baik' && !empty($row['nozzle'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['valve'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['valve'] != 'Baik' && !empty($row['valve'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['seal_karet_hose'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['seal_karet_hose'] != 'Baik' && !empty($row['seal_karet_hose'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['seal_karet_nozzle'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['seal_karet_nozzle'] != 'Baik' && !empty($row['seal_karet_nozzle'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['box_hydrant'] == 'Ada') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['box_hydrant'] != 'Ada' && !empty($row['box_hydrant'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php echo $row['keterangan']; ?></td>
                                                                <td style="text-align: center;">
                              <div class="btn-group">
                                <a title="scan" class="btn btn-primary" style="font-size: 20px;" href="proses/generate/generatehydrant.php?code=<?php echo $row['code_hydrant']; ?>"><i class="fa-solid fa-qrcode"></i></a>
                                <button type="button" class="btn btn-warning" data-toggle="modal" style="font-size: 20px;" data-target="#<?php echo $edit_modal_id; ?>"><i class=" fa-solid fa-pen-to-square"></i></button>
                                <button type="button" class="btn btn-danger " data-toggle="modal" style="font-size: 20px;" data-target="#<?php echo $hapus_modal_id; ?>"> <i class="fa-solid fa-trash-can"></i></i></button>
                              </div>
                            </td>

                                                            </tr>
                                                           
                                                        <?php
                                                            $no++;
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <?php
$result = mysqli_query($koneksi, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $edit_modal_id = "editModal" . $row['id'];
        $hapus_modal_id = "hapusModal" . $row['id']; // ID modal yang unik
?>
<div class="modal fade" id="<?php echo $edit_modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Hydrant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses/hydrant/proses_edit.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="form-group">
                        <label for="code_hydrant">Code Hydrant</label>
                        <input type="text" class="form-control" id="code_hydrant" name="code_hydrant" value="<?php echo $row['code_hydrant']; ?>" readonly>
                    </div>    
                    <div class="form-group">
                        <label for="nomer_urut">Nomer Urut</label>
                        <input type="text" class="form-control" id="nomer_urut" name="nomer_urut" value="<?php echo $row['nomer_urut']; ?>">
                    </div>
                   
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $row['lokasi']; ?>">
                    </div>

                    <?php
                    // Array untuk label input radio
                    $fields = [
                        'hose' => 'Hose',
                        'nozzle' => 'Nozzle',
                        'valve' => 'Valve',
                        'seal_karet_hose' => 'Seal Karet Hose',
                        'seal_karet_nozzle' => 'Seal Karet Nozzle',
                        'box_hydrant' => 'Box Hydrant'
                    ];

                    foreach ($fields as $field => $label) {
                    ?>
                        <div class="form-group">
                            <label><?php echo $label; ?></label><br>
                            <?php if ($field === 'box_hydrant') { ?>
                                <label>
                                    <input type="radio" name="<?php echo $field; ?>" value="Ada" <?php echo ($row[$field] == 'Ada') ? 'checked' : ''; ?>>
                                    Ada
                                </label>
                                <label style="margin-left: 20px;">
                                    <input type="radio" name="<?php echo $field; ?>" value="Tidak Ada" <?php echo ($row[$field] != 'Ada' && !empty($row[$field])) ? 'checked' : ''; ?>>
                                    Tidak Ada
                                </label>
                            <?php } else { ?>
                                <label>
                                    <input type="radio" name="<?php echo $field; ?>" value="Baik" <?php echo ($row[$field] == 'Baik') ? 'checked' : ''; ?>>
                                    Baik
                                </label>
                                <label style="margin-left: 20px;">
                                    <input type="radio" name="<?php echo $field; ?>" value="Tidak Baik" <?php echo ($row[$field] != 'Baik' && !empty($row[$field])) ? 'checked' : ''; ?>>
                                    Tidak Baik
                                </label>
                            <?php } ?>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $row['keterangan']; ?></textarea>
                    </div>
                    <input type="hidden" name="code_hydrant" id="code_hydrant" value="<?php echo $row['code_hydrant']; ?>">
                    <input type="hidden" name="activity" id="activity" value="<?php echo $user_details['nama'] ?> Telah Melakukan Pengeditan Hydrant  ">
                    <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="<?php echo $hapus_modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Hapus Data</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="needs-validation" action="proses/hydrant/proses_hapus.php" method="post">
                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="firstName">APAKAH ANDA YAKIN HAPUS?</label>
                                                                                <input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $row['id']; ?>" required="">
                                                                                <div class="invalid-feedback">
                                                                                    Valid first name is required.
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name="code_hydrant" id="code_hydrant" value="<?php echo $row['code_hydrant']; ?>">
                                                                            <input type="hidden" name="activity" id="activity" value="<?php echo $user_details['nama'] ?> Telah Melakukan Penghapusan Hydrant ">
                                                                            <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">
                                                                 

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
    }
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


                  
 <!-- ======================================================================================================================== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Hydrant Luar</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="height-400">
                                            <div class="table-responsive">
                                                <table id="dalam" class="display table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr style="background-color: #B22222; color: white;">
                                                            <th rowspan="2">No</th>
                                                            <th rowspan="2">Code Hydrant</th>
                                                            <th rowspan="2">Nomer Urut</th>
                                                            <th rowspan="2">Lokasi</th>
                                                            <th colspan="2">Hose</th>
                                                            <th colspan="2">Nozzle</th>
                                                            <th colspan="2">Valve</th>
                                                            <th colspan="2">Kunci</th>
                                                            <th colspan="2">Seal Karet Hose Coupling</th>
                                                            <th colspan="2">Seal Karet Nozzle</th>
                                                            <th colspan="2">Box Hydrant</th>
                                                            <th rowspan="2">Keterangan</th>
                                                            <th rowspan="2">Aksi</th>
                                                        </tr>
                                                        <tr style="background-color: #B22222; color: white;">
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Baik</th>
                                                            <th>Tidak</th>
                                                            <th>Ada</th>
                                                            <th>Tidak Ada</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="background-color:white;">
                                                        <?php
                                                        include('../koneksi.php');
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

                                                        // Query to fetch only records where jenis_lokasi is 'Indoor'
                                                        // FIX (Urutan Data Master Outdoor): urutkan berdasarkan
                                                        // angka pada Nomer Urut (A1, A2, ... A9, A10, A11...)
                                                        // supaya A9 tidak muncul setelah A10/A11. Pakai SUBSTRING
                                                        // (bukan REGEXP_REPLACE) supaya kompatibel di MySQL versi lama.
                                                        $query = "SELECT * FROM data_hydrant WHERE jenis_lokasi = 'Outdoor' ORDER BY CAST(SUBSTRING(nomer_urut, 2) AS UNSIGNED) ASC";

                                                        $result = mysqli_query($koneksi, $query);
                                                        if (!$result) {
                                                            die("query error: " . mysqli_error($koneksi));
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
                                                            $selected_location = $row['lokasi'];


                                                        ?>
                                                            <tr align="center">
                                                                <td style="text-align: center;"><?php echo $no; ?></td>
                                                                <td><?php echo $row['code_hydrant']; ?></td>
                                                                <td><?php echo $row['nomer_urut']; ?></td>
                                                                <td><?php echo $row['lokasi']; ?></td>
                                                       
                                                                <td>
                                                                    <?php if ($row['hose'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['hose'] != 'Baik' && !empty($row['hose'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['nozzle'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['nozzle'] != 'Baik' && !empty($row['nozzle'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['valve'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['valve'] != 'Baik' && !empty($row['valve'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['kunci'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['kunci'] != 'Baik' && !empty($row['kunci'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['seal_karet_hose'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['seal_karet_hose'] != 'Baik' && !empty($row['seal_karet_hose'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['seal_karet_nozzle'] == 'Baik') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['seal_karet_nozzle'] != 'Baik' && !empty($row['seal_karet_nozzle'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['box_hydrant'] == 'Ada') { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['box_hydrant'] != 'Ada' && !empty($row['box_hydrant'])) { ?>
                                                                        ✔️
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php echo $row['keterangan']; ?></td>
                                                                <td style="text-align: center;">
                              <div class="btn-group">
                                <a title="scan" class="btn btn-primary" style="font-size: 20px;" href="proses/generate/generatehydrant.php?code=<?php echo $row['code_hydrant']; ?>"><i class="fa-solid fa-qrcode"></i></a>
                                <button type="button" class="btn btn-warning" data-toggle="modal" style="font-size: 20px;" data-target="#<?php echo $edit_modal_id; ?>"><i class=" fa-solid fa-pen-to-square"></i></button>
                                <button type="button" class="btn btn-danger " data-toggle="modal" style="font-size: 20px;" data-target="#<?php echo $hapus_modal_id; ?>"> <i class="fa-solid fa-trash-can"></i></i></button>
                              </div>
                            </td>
                                                            </tr>
                                                           
                                                        <?php
                                                            $no++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                    <?php
$result = mysqli_query($koneksi, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $edit_modal_id = "editModal" . $row['id'];
        $hapus_modal_id = "hapusModal" . $row['id']; // ID modal yang unik
?>
<div class="modal fade" id="<?php echo $edit_modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Hydrant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses/hydrant/proses_edit.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="form-group">
                        <label for="code_hydrant">Code Hydrant</label>
                        <input type="text" class="form-control" id="code_hydrant" name="code_hydrant" value="<?php echo $row['code_hydrant']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nomer_urut">Nomer Urut</label>
                        <input type="text" class="form-control" id="nomer_urut" name="nomer_urut" value="<?php echo $row['nomer_urut']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $row['lokasi']; ?>">
                    </div>

                    <?php
                    // Array untuk label input radio
                    $fields = [
                        'hose' => 'Hose',
                        'nozzle' => 'Nozzle',
                        'valve' => 'Valve',
                        'kunci' => 'Kunci',
                        'seal_karet_hose' => 'Seal Karet Hose',
                        'seal_karet_nozzle' => 'Seal Karet Nozzle',
                        'box_hydrant' => 'Box Hydrant'
                    ];

                    foreach ($fields as $field => $label) {
                    ?>
                        <div class="form-group">
                            <label><?php echo $label; ?></label><br>
                            <?php if ($field === 'box_hydrant') { ?>
                                <label>
                                    <input type="radio" name="<?php echo $field; ?>" value="Ada" <?php echo ($row[$field] == 'Ada') ? 'checked' : ''; ?>>
                                    Ada
                                </label>
                                <label style="margin-left: 20px;">
                                    <input type="radio" name="<?php echo $field; ?>" value="Tidak Ada" <?php echo ($row[$field] != 'Ada' && !empty($row[$field])) ? 'checked' : ''; ?>>
                                    Tidak Ada
                                </label>
                            <?php } else { ?>
                                <label>
                                    <input type="radio" name="<?php echo $field; ?>" value="Baik" <?php echo ($row[$field] == 'Baik') ? 'checked' : ''; ?>>
                                    Baik
                                </label>
                                <label style="margin-left: 20px;">
                                    <input type="radio" name="<?php echo $field; ?>" value="Tidak Baik" <?php echo ($row[$field] != 'Baik' && !empty($row[$field])) ? 'checked' : ''; ?>>
                                    Tidak Baik
                                </label>
                            <?php } ?>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $row['keterangan']; ?></textarea>
                    </div>
                    <input type="hidden" name="code_hydrant" id="code_hydrant" value="<?php echo $row['code_hydrant']; ?>">
                    <input type="hidden" name="activity" id="activity" value="<?php echo $user_details['nama'] ?> Telah Melakukan Pengeditan Hydrant  ">
                    <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="<?php echo $hapus_modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Hapus Data</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="needs-validation" action="proses/hydrant/proses_hapus.php" method="post">
                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="firstName">APAKAH ANDA YAKIN HAPUS?</label>
                                                                                <input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $row['id']; ?>" required="">
                                                                                <div class="invalid-feedback">
                                                                                    Valid first name is required.
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name="code_hydrant" id="code_hydrant" value="<?php echo $row['code_hydrant']; ?>">
                                                                            <input type="hidden" name="activity" id="activity" value="<?php echo $user_details['nama'] ?> Telah Melakukan Penghapusan Hydrant ">
                                                                            <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">
                                                                 

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
    }
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
            $(document).ready(function() {
                $('#dalam').DataTable({
                    "paging": true,
                    "lengthMenu": [10, 25, 50, 75, 100], // Atur panjang halaman sesuai kebutuhan Anda
                    "pageLength": 10 // Set jumlah baris default per halaman
                });
            });

        </script>

        <!--   Core JS Files   -->
           
        <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

<?php
include('../koneksi.php');
// Ambil nomor pendaftaran tertinggi dari tabel data_siswa
$sql = "SELECT MAX(code_hydrant) AS max_registration_number FROM data_hydrant";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_registration_number = $row["max_registration_number"];

    // Jika tidak ada nomor pendaftaran sebelumnya, mulai dari BYR001
    if ($last_registration_number === null) {
        $new_registration_number = "HDR001";
    } else {
        // Ubah nomor pendaftaran terakhir ke nomor pendaftaran baru
        $last_number = intval(substr($last_registration_number, 3));
        $next_number = $last_number + 1;
        $new_registration_number = "HDR" . sprintf("%03d", $next_number);
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
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Hydrant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="proses/hydrant/proses_tambah.php" method="post">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="firstName">Code Hydrant</label>
                                <input type="text" class="form-control" name="code_hydrant" id="firstName" placeholder="" value="<?php echo $new_registration_number; ?>" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Lokasi</label>
                                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder=""required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nomer_urut">Nomer Urut</label>
                                <input type="text" class="form-control" name="nomer_urut" id="nomer_urut"
                                       placeholder="Indoor: 1, 2, 3, ... | Outdoor: A1, A2, A3, ...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="firstName">Jenis Lokasi</label>
                                <select class="form-control" name="jenis_lokasi" id="jenis_lokasi" required>
                                    <option value="">Pilih</option>
                                    <option value="Outdoor">Outdoor</option>
                                    <option value="Indoor">Indoor</option>
                                </select>
                            </div>
                        </div>
                        <?php
                        include '../koneksi.php';

                        $user = $_SESSION['username'];

                        $query = "SELECT * FROM user where username='$user'";
                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                            die("query Error :" . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
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

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <input type="hidden" name="activity" id="activity" value="<?php echo $row['nama'] ?> Telah Melakukan Penambahan Hydrant ">
                            <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">

                        <?php
                        }
                        ?>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                


</html>