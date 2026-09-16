<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$user_level = $_SESSION['level'] ?? 'guest';

/* QUERY DULU */
$sql = "SELECT * FROM hosereel ORDER BY id ASC";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

/* BARU MASUKIN KE ARRAY */
$dataHose = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dataHose[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Cek Apar | Hydrant  - Scan Barcode</title>
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
                                      <li>
                    <a href="hoseriil.php">
                      <span class="sub-item">Data Hose Reel</span>
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
                      <span class="fw-bold"><?php echo $_SESSION['nama_pengguna']; ?></span>
                    </span>
                  </a>
                <?php
              }
                ?>
                </li>

          </div>
        </nav>
        
        <div class="main-content mt-4">
    <div class="container-fluid">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Hose Reel</h3>
    <?php if($user_level === 'admin'): ?>
       <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahHoseReelModal">
    Tambah Data
</button>
    <?php endif; ?>
</div>
        <div class="table-responsive">
            <?php
            include '../koneksi.php'; // pastikan path sesuai

            // Ambil semua data dari tabel hosereel
            $sql = "SELECT * FROM hosereel ORDER BY id ASC";
            $result = mysqli_query($koneksi, $sql);
            ?>
            <table class="table table-bordered table-striped">
    <thead style="background-color:#dc3545; color:white;">
<tr>
  <th>No</th>
  <th>Code Hose Reel</th>
  <th>Lokasi</th>

  <th colspan="2" class="text-center">Valve</th>
  <th colspan="2" class="text-center">Hose</th>
  <th colspan="2" class="text-center">Nozzle</th>
  <th colspan="2" class="text-center">Clamp Nozzle</th>
  <th colspan="2" class="text-center">Drum Hose</th>

  <th>Keterangan</th>
  <th>Aksi</th>
</tr>
<tr style="background:#b52b2b; color:white;">
  <th></th><th></th><th></th>

  <th>Baik</th><th>Tidak</th>
  <th>Baik</th><th>Tidak</th>
  <th>Baik</th><th>Tidak</th>
  <th>Baik</th><th>Tidak</th>
  <th>Baik</th><th>Tidak</th>

  <th></th><th></th>
</tr>
</thead>


              <tbody>
<?php if(count($dataHose) > 0): ?>
<?php $no = 1; foreach($dataHose as $row): ?>
<tr>
  <td><?= $no++; ?></td>
  <td><?= $row['code']; ?></td>
  <td><?= $row['lokasi']; ?></td>

  <td class="text-center"><?= $row['valve']=='Baik'?'✓':'' ?></td>
  <td class="text-center"><?= $row['valve']=='Tidak'?'✓':'' ?></td>

  <td class="text-center"><?= $row['hose']=='Baik'?'✓':'' ?></td>
  <td class="text-center"><?= $row['hose']=='Tidak'?'✓':'' ?></td>

  <td class="text-center"><?= $row['nozzle']=='Baik'?'✓':'' ?></td>
  <td class="text-center"><?= $row['nozzle']=='Tidak'?'✓':'' ?></td>

  <td class="text-center"><?= $row['clamp_nozzle']=='Baik'?'✓':'' ?></td>
  <td class="text-center"><?= $row['clamp_nozzle']=='Tidak'?'✓':'' ?></td>

  <td class="text-center"><?= $row['drum_hose']=='Baik'?'✓':'' ?></td>
  <td class="text-center"><?= $row['drum_hose']=='Tidak'?'✓':'' ?></td>

  <td><?= $row['keterangan']; ?></td>

  <td>
      
    <!--  <a title="QR Code"
   class="btn btn-primary btn-sm"
   href="proses/generate/generate_hosereel.php?code=<?= $row['code']; ?>">
   <i class="fa-solid fa-qrcode"></i>
</a> -->

    <a href="edit_hosereel.php?id=<?= $row['id']; ?>" 
   class="btn btn-warning btn-sm" 
   title="Edit">
   <i class="fa-solid fa-pen-to-square"></i>
</a>

    <a href="hapus_hosereel.php?id=<?= $row['id']; ?>"
       class="btn btn-danger btn-sm btn-hapus">
       <i class="fa fa-trash"></i>
    </a>
  </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
  <td colspan="15" class="text-center">Data belum ada</td>
</tr>
<?php endif; ?>
</tbody>

               
                 
            </table>
         <?php foreach($dataHose as $row): ?>
<div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <form action="proses_edit_hosereel.php" method="POST">
      <input type="hidden" name="id" value="<?= $row['id']; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Hose Reel</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <label>Code</label>
          <input type="text" class="form-control" name="code"
                 value="<?= $row['code']; ?>" readonly>

          <label>Lokasi</label>
          <input type="text" class="form-control" name="lokasi"
                 value="<?= $row['lokasi']; ?>" required>

          <label>Valve</label>
          <select name="valve" class="form-control">
            <option value="Baik" <?= $row['valve']=='Baik'?'selected':''; ?>>Baik</option>
            <option value="Tidak" <?= $row['valve']=='Tidak'?'selected':''; ?>>Tidak</option>
          </select>

          <!-- lanjut field lain -->
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Update</button>
          <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php endforeach; ?>

        </div>
    </div>
</div>     
        <!-- End Navbar -->
      </div>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="../assets/js/html5-qrcode.min.js"></script>
      <style>
        .container {
          display: flex;
          align-items: center;
          justify-content: center;
        }
      </style>
<footer class="footer">
      <div class="container-fluid d-flex justify-content-between">

        <div class="copyright">
          PT Corinthian Industries Indonesia
        </div>

      </div>
    </footer>
<!-- Custom template | don't include it in your project! -->

  <!-- End Custom template -->
  </div>
    
    <?php
include '../koneksi.php';

// Ambil kode terakhir dari tabel hosereel
$query = "SELECT code FROM hosereel ORDER BY id DESC LIMIT 1";
$result = mysqli_query($koneksi, $query);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $last_code = $row['code'];
    
    // Misal format: HR001, HR002, dst
    $number = (int)substr($last_code, 2); // ambil angka setelah HR
    $number++;
    $new_code = 'HR' . str_pad($number, 3, '0', STR_PAD_LEFT);
} else {
    $new_code = 'HR001'; // jika belum ada data
}
?>

   <!-- Modal Tambah Hose Reel -->
<div class="modal fade" id="tambahHoseReelModal" tabindex="-1" role="dialog" aria-labelledby="tambahHoseReelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="proses_tambah_hosereel.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahHoseReelModalLabel">Tambah Hose Reel</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Code Hose Reel</label>
                <input type="text" class="form-control" name="code" value="<?= $new_code; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" class="form-control" name="lokasi" required>
            </div>
            <div class="form-group">
                <label>Valve</label>
                <select class="form-control" name="valve" required>
                    <option value="Baik">Baik</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hose</label>
                <select class="form-control" name="hose" required>
                    <option value="Baik">Baik</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nozzle</label>
                <select class="form-control" name="nozzle" required>
                    <option value="Baik">Baik</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label>Clamp Nozzle</label>
                <select class="form-control" name="clamp_nozzle" required>
                    <option value="Baik">Baik</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label>Drum Hose</label>
                <select class="form-control" name="drum_hose" required>
                    <option value="Baik">Baik</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan"></textarea>
            </div>

            <?php
            $user = $_SESSION['username'];
            $query_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user'");
            $row_user = mysqli_fetch_assoc($query_user);

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

            <input type="hidden" name="activity" value="<?= $row_user['nama']; ?> Telah Menambah Hose Reel">
            <input type="hidden" name="tanggal" value="<?= $dayName . ', ' . date('d-m-Y H:i:s'); ?>">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelectorAll('.btn-hapus').forEach(function(button){
      button.addEventListener('click', function(e){
          e.preventDefault();
          let href = this.getAttribute('href');
          Swal.fire({
            title: 'Yakin?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = href;
            }
          })
      });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>