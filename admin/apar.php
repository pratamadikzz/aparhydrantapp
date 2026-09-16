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

// 🔽 TAMBAHKAN KODE INI DI SINI
include '../koneksi.php';

$query = "
SELECT MAX(CAST(SUBSTRING(code_apar, 3) AS UNSIGNED)) AS max_code 
FROM data_apar
";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

$lastNumber = $row['max_code'] ?? 0;
$newNumber  = $lastNumber + 1;

$new_registration_number = 'AP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
// 🔼 SAMPAI SINI

$detailCode = trim($_GET['code'] ?? '');
$detailGuide = $_GET['guide'] ?? '';
$updated = isset($_GET['updated']) && $_GET['updated'] === '1';
$detailApar = null;

if ($detailCode !== '') {
  $safeDetailCode = mysqli_real_escape_string($koneksi, $detailCode);
  $detailQuery = "
    SELECT data_apar.*, tbl_lokasi.lokasi, tbl_departemen.departemen, jenis_apar.jenis_apar
    FROM data_apar
    LEFT JOIN tbl_lokasi ON data_apar.lokasi = tbl_lokasi.id
    LEFT JOIN tbl_departemen ON data_apar.departemen = tbl_departemen.id
    LEFT JOIN jenis_apar ON data_apar.jenis_apar = jenis_apar.id
    WHERE data_apar.code_apar = '$safeDetailCode'
    LIMIT 1
  ";
  $detailResult = mysqli_query($koneksi, $detailQuery);
  if ($detailResult) {
    $detailApar = mysqli_fetch_assoc($detailResult);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Cek Apar | Hydrant - Data Apar</title>
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
  <style>
    .apar-detail-panel {
      margin: 18px 0 30px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      border-radius: 24px;
      background: #fff;
      box-shadow: 0 18px 42px rgba(15, 23, 42, .1);
    }

    .apar-detail-hero {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 20px;
      padding: 26px 30px;
      background: linear-gradient(118deg, #111827, #1e293b 58%, #b91c1c);
      color: #fff;
    }

    .apar-detail-eyebrow {
      margin: 0 0 7px;
      color: #fca5a5;
      font-size: .7rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
    }

    .apar-detail-hero h1 {
      margin: 0;
      color: #fff;
      font-size: clamp(1.35rem, 3vw, 1.9rem);
      font-weight: 700;
    }

    .apar-detail-hero p {
      margin: 7px 0 0;
      color: #cbd5e1;
      font-size: .82rem;
    }

    .apar-detail-back {
      border: 1px solid rgba(255, 255, 255, .22);
      border-radius: 11px;
      background: rgba(255, 255, 255, .1);
      color: #fff;
      font-size: .78rem;
      font-weight: 700;
      white-space: nowrap;
    }

    .apar-detail-back:hover {
      background: rgba(255, 255, 255, .2);
      color: #fff;
    }

    .apar-detail-guide {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin: 22px 30px 0;
      padding: 15px 17px;
      border: 1px solid #fed7aa;
      border-radius: 15px;
      background: #fff7ed;
      color: #9a3412;
    }

    .apar-detail-guide i {
      margin-top: 2px;
      color: #ea580c;
    }

    .apar-detail-guide div {
      flex: 1;
      font-size: .77rem;
      line-height: 1.5;
    }

    .apar-detail-guide strong {
      display: block;
      margin-bottom: 3px;
      font-size: .82rem;
    }

    .apar-detail-guide button {
      border: 0;
      background: transparent;
      color: #9a3412;
      font-size: .74rem;
      font-weight: 700;
      white-space: nowrap;
    }

    .apar-detail-body {
      padding: 26px 30px 30px;
    }

    .apar-detail-status {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      margin-bottom: 18px;
      padding: 7px 11px;
      border-radius: 999px;
      background: #fef2f2;
      color: #b91c1c;
      font-size: .74rem;
      font-weight: 700;
    }

    .apar-detail-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 12px;
    }

    .apar-detail-item {
      min-height: 72px;
      padding: 13px 14px;
      border: 1px solid #e2e8f0;
      border-radius: 13px;
      background: #f8fafc;
    }

    .apar-detail-item span,
    .apar-detail-item strong {
      display: block;
    }

    .apar-detail-item span {
      margin-bottom: 5px;
      color: #94a3b8;
      font-size: .68rem;
      font-weight: 600;
      text-transform: uppercase;
    }

    .apar-detail-item strong {
      overflow: hidden;
      color: #1e293b;
      font-size: .82rem;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .apar-detail-missing {
      margin: 20px 0 30px;
      padding: 22px;
      border: 1px solid #fecaca;
      border-radius: 16px;
      background: #fff1f2;
      color: #9f1239;
    }

    .apar-detail-modal .modal-content {
      overflow: hidden;
      border: 0;
      border-radius: 22px;
      box-shadow: 0 24px 60px rgba(15, 23, 42, .22);
    }

    .apar-detail-modal .modal-header {
      display: block;
      padding: 24px 26px 20px;
      border: 0;
      background: linear-gradient(118deg, #111827, #1e293b 58%, #b91c1c);
      color: #fff;
    }

    .apar-detail-modal .modal-title {
      color: #fff;
      font-size: 1.25rem;
      font-weight: 700;
    }

    .apar-detail-modal .modal-header p {
      margin: 5px 0 0;
      color: #cbd5e1;
      font-size: .78rem;
    }

    .apar-detail-modal .modal-body {
      padding: 24px 26px;
      background: #fff;
    }

    .apar-modal-guide {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-bottom: 18px;
      padding: 13px 14px;
      border: 1px solid #fed7aa;
      border-radius: 13px;
      background: #fff7ed;
      color: #9a3412;
      font-size: .76rem;
      line-height: 1.5;
    }

    .apar-modal-guide div {
      flex: 1;
    }

    .apar-modal-guide strong {
      display: block;
      margin-bottom: 2px;
      font-size: .8rem;
    }

    .apar-modal-guide button {
      border: 0;
      background: transparent;
      color: #9a3412;
      font-size: .72rem;
      font-weight: 700;
      white-space: nowrap;
    }

    .apar-detail-modal .modal-footer {
      gap: 8px;
      padding: 16px 26px 22px;
      border: 0;
      background: #fff;
    }

    .apar-detail-modal__edit {
      border: 0;
      border-radius: 11px;
      background: #dc2626;
      color: #fff;
      font-size: .8rem;
      font-weight: 700;
      box-shadow: 0 8px 16px rgba(220, 38, 38, .2);
    }

    .apar-detail-modal__edit:hover {
      background: #b91c1c;
      color: #fff;
    }

    .apar-detail-modal__close {
      border-radius: 11px;
      font-size: .8rem;
      font-weight: 600;
    }

    @media (max-width: 767px) {
      .apar-detail-hero {
        flex-direction: column;
        padding: 22px;
      }

      .apar-detail-back {
        width: 100%;
      }

      .apar-detail-guide,
      .apar-detail-body {
        margin-right: 22px;
        margin-left: 22px;
      }

      .apar-detail-body {
        padding-right: 0;
        padding-left: 0;
      }

      .apar-detail-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (max-width: 480px) {
      .apar-detail-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>


<body data-detail-code="<?php echo htmlspecialchars($detailCode, ENT_QUOTES, 'UTF-8'); ?>" data-detail-id="<?php echo htmlspecialchars($detailApar['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
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
                    <li class="active">
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
                            echo "  <a href='apar.php?code=" . urlencode($row["code_apar"]) . "&guide=near_expiry'>";
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
                            echo "  <a href='apar.php?code=" . urlencode($row["code_apar"]) . "&guide=expired'>";
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

          <?php if ($detailCode !== ''): ?>
            <?php if ($detailApar): ?>
              <section class="apar-detail-panel" id="aparDetailPanel" aria-labelledby="aparDetailTitle">
                <div class="apar-detail-hero">
                  <div>
                    <p class="apar-detail-eyebrow">Detail aset APAR</p>
                    <h1 id="aparDetailTitle"><?php echo htmlspecialchars($detailApar['code_apar'], ENT_QUOTES, 'UTF-8'); ?></h1>
                    <p>Informasi lengkap aset dari Data Master APAR</p>
                  </div>
                  <a class="btn apar-detail-back" href="apar.php"><i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Data Master</a>
                </div>

                <?php if ($detailGuide !== 'skip'): ?>
                  <div class="apar-detail-guide" id="aparDetailGuide" role="status">
                    <i class="fa-solid fa-compass" aria-hidden="true"></i>
                    <div>
                      <strong>Petunjuk tindakan</strong>
                      <?php if ($detailGuide === 'expired'): ?>
                        APAR ini sudah expired. Periksa kondisi fisik dan jadwalkan penggantian atau refill sesuai prosedur.
                      <?php else: ?>
                        APAR ini mendekati tanggal expired. Tinjau tanggalnya, cek kondisi aset, dan siapkan jadwal refill sebelum jatuh tempo.
                      <?php endif; ?>
                    </div>
                    <button type="button" id="skipAparDetailGuide">Lewati</button>
                  </div>
                <?php endif; ?>

                <div class="apar-detail-body">
                  <?php
                  $detailExpired = !empty($detailApar['tanggal_expired']) && $detailApar['tanggal_expired'] !== '0000-00-00' && $detailApar['tanggal_expired'] < date('Y-m-d');
                  $detailStatus = $detailExpired ? 'Sudah Expired' : (($detailApar['kondisi'] ?? '') === 'Tidak Layak' ? 'Perlu Pemeriksaan' : 'Perlu Dipantau');
                  ?>
                  <div class="apar-detail-status"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $detailStatus; ?></div>
                  <div class="apar-detail-grid">
                    <div class="apar-detail-item"><span>Lokasi</span><strong><?php echo htmlspecialchars($detailApar['lokasi'] ?? 'Belum diatur', ENT_QUOTES, 'UTF-8'); ?></strong></div>
                    <div class="apar-detail-item"><span>Departemen</span><strong><?php echo htmlspecialchars($detailApar['departemen'] ?? 'Belum diatur', ENT_QUOTES, 'UTF-8'); ?></strong></div>
                    <div class="apar-detail-item"><span>Jenis APAR</span><strong><?php echo htmlspecialchars($detailApar['jenis_apar'] ?? 'Belum diatur', ENT_QUOTES, 'UTF-8'); ?></strong></div>
                    <div class="apar-detail-item"><span>Jenis Tabung</span><strong><?php echo htmlspecialchars(strtoupper($detailApar['jenis_tabung'] ?? '-'), ENT_QUOTES, 'UTF-8'); ?></strong></div>
                    <div class="apar-detail-item"><span>Vendor</span><strong><?php echo htmlspecialchars($detailApar['vendor'] ?? 'Belum diatur', ENT_QUOTES, 'UTF-8'); ?></strong></div>
                    <div class="apar-detail-item"><span>Kondisi</span><strong><?php echo htmlspecialchars($detailApar['kondisi'] ?? 'Belum diatur', ENT_QUOTES, 'UTF-8'); ?></strong></div>
                    <div class="apar-detail-item"><span>Tanggal Refill</span><strong><?php echo ($detailApar['tanggal_refill'] ?? '') === '0000-00-00' ? 'Belum diatur' : date('d-m-Y', strtotime($detailApar['tanggal_refill'])); ?></strong></div>
                    <div class="apar-detail-item"><span>Tanggal Expired</span><strong><?php echo ($detailApar['tanggal_expired'] ?? '') === '0000-00-00' ? 'Belum diatur' : date('d-m-Y', strtotime($detailApar['tanggal_expired'])); ?></strong></div>
                    <div class="apar-detail-item"><span>Berat</span><strong><?php echo htmlspecialchars($detailApar['berat'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></strong></div>
                  </div>
                </div>
              </section>
            <?php else: ?>
              <div class="apar-detail-missing">Data APAR dengan kode <strong><?php echo htmlspecialchars($detailCode, ENT_QUOTES, 'UTF-8'); ?></strong> tidak ditemukan.</div>
            <?php endif; ?>
          <?php endif; ?>

          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="center-button">
                <button type="button" class="btn btn-luxurious" data-toggle="modal" data-target="#exampleModalScrollable">
                  Tambah Apar
                </button>

                <style>
                  .btn-luxurious {
                    background: linear-gradient(135deg, #B22222, #FF6347, #FFD700);
                    color: #fff;
                    font-weight: 600;
                    padding: 10px 20px;
                    border-radius: 25px;
                    border: none;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
                    transition: all 0.3s ease;
                    font-size: 16px;
                  }

                  .btn-luxurious:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
                    background: linear-gradient(135deg, #FF4500, #FF6347, #FFD700);
                    cursor: pointer;
                  }
                </style>

                <div>
                </div>
                <a href="proses/export/export.php" target="_blank" class="btn btn-export">
                  <span class="icon text-white-75">
                    <i class="fas fa-print"></i>
                  </span>
                  <span class="text">Export Data Apar</span>
                </a>

                <style>
                  .btn-export {
                    display: inline-flex;
                    align-items: center;
                    background: linear-gradient(135deg, #1E90FF, #00CED1);
                    color: #fff;
                    font-weight: 600;
                    padding: 10px 20px;
                    border-radius: 25px;
                    border: none;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
                    text-decoration: none;
                    transition: all 0.3s ease;
                    font-size: 16px;
                  }

                  .btn-export .icon {
                    margin-right: 8px;
                    font-size: 18px;
                  }

                  .btn-export:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
                    background: linear-gradient(135deg, #00BFFF, #20B2AA);
                    cursor: pointer;
                  }
                </style>


              </div>

              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="display" style="width:100%">
                      <thead>
                        <tr>
                          <th style="background-color:yellow;"> No </th>
                          <th style="background-color:yellow;"> Code Apar </th>
                          <th style="background-color:yellow;"> Lokasi </th>
                          <th style="background-color:yellow;"> Departemen </th>
                          <th style="background-color:yellow;"> Jenis Apar </th>
                          <th style="background-color:yellow;"> Jenis Tabung </th>
                          <th style="background-color:yellow;"> Vendor Refill </th>
                          <th style="background-color:yellow;"> Kondisi Fisik </th>
                          <th style="background-color:yellow;"> Status Tabung </th>
                          <th style="background-color:yellow;"> Masa Pemakaian </th>
                          <th style="background-color:yellow;"> Tanggal Refill </th>
                          <th style="background-color:yellow;"> Tanggal Expired </th>
                          <th style="background-color:yellow;"> Nozzle </th>
                          <th style="background-color:yellow;"> Tabung </th>
                          <th style="background-color:yellow;"> Pressure </th>
                          <th style="background-color:yellow;"> Catridge </th>
                          <th style="background-color:yellow;"> Pin </th>
                          <th style="background-color:yellow;"> Handle </th>
                          <th style="background-color:yellow;"> Berat </th>
                          <th style="background-color:yellow;"> Aksi </th>
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
                        // Fetch lokasi options

                        $query = "
                        SELECT 
    data_apar.*, 
    tbl_lokasi.lokasi, 
    tbl_departemen.departemen, 
    jenis_apar.jenis_apar 
FROM data_apar 
JOIN tbl_lokasi ON data_apar.lokasi = tbl_lokasi.id 
JOIN tbl_departemen ON data_apar.departemen = tbl_departemen.id 
JOIN jenis_apar ON data_apar.jenis_apar = jenis_apar.id 
ORDER BY data_apar.id ASC
";
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                          die("query error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
                        }

                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                          $edit_modal_id = "editModal" . $row['id']; // ID modal yang unik
                          $hapus_modal_id = "hapusModal" . $row['id']; // ID modal yang unik
                          $expired_date = new DateTime($row['tanggal_expired']);
                          $current_date = new DateTime();
                          $apar_id = $row['id'];
                          // Check if the item is expired
                          $is_expired = $expired_date < $current_date;
                        ?>
                          <tr <?php if ($is_expired) echo 'style="background-color: #FF4C4C;"'; ?>>
                            <td style="text-align: center;"><?php echo $no; ?></td>
                            <td><?php echo $row['code_apar']; ?></td>
                            <td><?php echo $row['lokasi']; ?></td>
                            <td><?php echo $row['departemen']; ?></td>
                            <td><?php echo $row['jenis_apar']; ?></td>
                            <td><?php echo strtoupper($row['jenis_tabung']); ?></td>
                            <td><?php echo $row['vendor']; ?></td>
                            <td><?php echo $row['kondisi']; ?></td>
                            <td><?php echo $row['tanggal_penggantian'] == '' ? 'Lama' : date('d-m-Y', strtotime($row['tanggal_penggantian'])); ?></td>
                            <td><?php echo $row['masa_pemakaian']; ?></td>
                            <td><?php echo $row['tanggal_refill'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($row['tanggal_refill'])); ?></td>
                            <td><?php echo $row['tanggal_expired'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($row['tanggal_expired'])); ?></td>
                            <td><?php echo $row['nozzle']; ?></td>
                            <td><?php echo $row['tabung']; ?></td>
                            <td>
                              <?php
                              echo ($row['jenis_tabung'] === 'pressure')
                                ? $row['presure']
                                : '-';
                              ?>
                            </td>

                            <td>
                              <?php
                              echo ($row['jenis_tabung'] === 'catridge')
                                ? $row['catridge']
                                : '-';
                              ?>
                            </td>
                            <td><?php echo $row['pin']; ?></td>
                            <td><?php echo $row['handle']; ?></td>
                            <td><?php echo $row['berat']; ?></td>
                            <td style="text-align: center;">
                              <div class="btn-group">
                                <a title="scan" class="btn btn-primary" style="font-size: 20px;" href="proses/generate/generate.php?code=<?php echo $row['code_apar']; ?>"><i class="fa-solid fa-qrcode"></i></a>
                                <button type="button" title="Detail APAR" class="btn btn-info" style="font-size: 20px;" data-toggle="modal" data-target="#detailModal<?php echo $row['id']; ?>" aria-label="Detail <?php echo htmlspecialchars($row['code_apar'], ENT_QUOTES, 'UTF-8'); ?>"><i class="fa-solid fa-circle-info"></i></button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" style="font-size: 20px;" data-target="#<?php echo $edit_modal_id; ?>"><i class=" fa-solid fa-pen-to-square"></i></button>
                                <button type="button" class="btn btn-danger " data-toggle="modal" style="font-size: 20px;" data-target="#<?php echo $hapus_modal_id; ?>"> <i class="fa-solid fa-trash-can"></i></i></button>
                              </div>
                            </td>
                          </tr>
                          <div class="modal fade apar-detail-modal" id="detailModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle<?php echo $row['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="detailModalTitle<?php echo $row['id']; ?>"><i class="fa-solid fa-fire-extinguisher mr-2"></i><?php echo htmlspecialchars($row['code_apar'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                  <p>Detail lengkap aset APAR dari Data Master</p>
                                </div>
                                <div class="modal-body">
                                  <?php if ($detailCode === $row['code_apar'] && ($detailGuide === 'expired' || $detailGuide === 'near_expiry')): ?>
                                    <div class="apar-modal-guide" id="aparModalGuide<?php echo $row['id']; ?>">
                                      <i class="fa-solid fa-compass mt-1"></i>
                                      <div>
                                        <strong>Petunjuk tindakan</strong>
                                        <?php if ($detailGuide === 'expired'): ?>
                                          Aset ini sudah expired. Klik <b>Edit APAR</b> untuk memperbarui tanggal refill, expired, vendor, atau kondisinya.
                                        <?php else: ?>
                                          Aset ini mendekati expired. Tinjau datanya, lalu klik <b>Edit APAR</b> untuk menyiapkan jadwal refill sebelum jatuh tempo.
                                        <?php endif; ?>
                                      </div>
                                      <button type="button" class="skip-apar-modal-guide" data-guide-id="aparModalGuide<?php echo $row['id']; ?>">Lewati</button>
                                    </div>
                                  <?php endif; ?>
                                  <div class="apar-detail-grid">
                                    <div class="apar-detail-item"><span>Code APAR</span><strong><?php echo htmlspecialchars($row['code_apar'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Lokasi</span><strong><?php echo htmlspecialchars($row['lokasi'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Departemen</span><strong><?php echo htmlspecialchars($row['departemen'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Jenis APAR</span><strong><?php echo htmlspecialchars($row['jenis_apar'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Jenis Tabung</span><strong><?php echo htmlspecialchars(strtoupper($row['jenis_tabung']), ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Vendor Refill</span><strong><?php echo htmlspecialchars($row['vendor'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Kondisi Fisik</span><strong><?php echo htmlspecialchars($row['kondisi'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Tanggal Refill</span><strong><?php echo $row['tanggal_refill'] === '0000-00-00' ? 'Belum diatur' : date('d-m-Y', strtotime($row['tanggal_refill'])); ?></strong></div>
                                    <div class="apar-detail-item"><span>Tanggal Expired</span><strong><?php echo $row['tanggal_expired'] === '0000-00-00' ? 'Belum diatur' : date('d-m-Y', strtotime($row['tanggal_expired'])); ?></strong></div>
                                    <div class="apar-detail-item"><span>Masa Pemakaian</span><strong><?php echo htmlspecialchars($row['masa_pemakaian'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Berat</span><strong><?php echo htmlspecialchars($row['berat'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Nozzle / Tabung</span><strong><?php echo htmlspecialchars($row['nozzle'] . ' / ' . $row['tabung'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                    <div class="apar-detail-item"><span>Pressure</span><strong><?php echo $row['jenis_tabung'] === 'pressure' ? htmlspecialchars($row['presure'], ENT_QUOTES, 'UTF-8') : '-'; ?></strong></div>
                                    <div class="apar-detail-item"><span>Catridge</span><strong><?php echo $row['jenis_tabung'] === 'catridge' ? htmlspecialchars($row['catridge'], ENT_QUOTES, 'UTF-8') : '-'; ?></strong></div>
                                    <div class="apar-detail-item"><span>Pin / Handle</span><strong><?php echo htmlspecialchars($row['pin'] . ' / ' . $row['handle'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light apar-detail-modal__close" data-dismiss="modal">Tutup</button>
                                  <button type="button" class="btn apar-detail-modal__edit" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $edit_modal_id; ?>"><i class="fa-solid fa-pen-to-square mr-1"></i> Edit APAR</button>
                                </div>
                              </div>
                            </div>
                          </div>
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
                                      <?php
                                      // Assuming the ID is passed via URL
                                      $apar_query = "SELECT * FROM data_apar WHERE id = $apar_id";
                                      $apar_result = mysqli_query($koneksi, $apar_query);
                                      $row = mysqli_fetch_assoc($apar_result);

                                      // Fetch lokasi options
                                      $lokasi_query = "SELECT id, lokasi FROM tbl_lokasi";
                                      $lokasi_result = mysqli_query($koneksi, $lokasi_query);
                                      $lokasi_options = [];
                                      while ($lokasi_row = mysqli_fetch_assoc($lokasi_result)) {
                                        $lokasi_options[] = $lokasi_row;
                                      }

                                      // Fetch departemen options
                                      $departemen_query = "SELECT id, departemen FROM tbl_departemen";
                                      $departemen_result = mysqli_query($koneksi, $departemen_query);
                                      $departemen_options = [];
                                      while ($departemen_row = mysqli_fetch_assoc($departemen_result)) {
                                        $departemen_options[] = $departemen_row;
                                      }

                                      $jenis_query = "SELECT id, jenis_apar FROM jenis_apar";
                                      $jenis_hasil = mysqli_query($koneksi, $jenis_query);
                                      $jenis_option = [];
                                      while ($jenis_row = mysqli_fetch_assoc($jenis_hasil)) {
                                        $jenis_option[] = $jenis_row;
                                      }
                                      ?>
                                      <div class="col-md-6 mb-3">
                                        <label for="lokasi">Lokasi</label>
                                        <select class="form-control" name="lokasi" id="lokasi" required>
                                          <?php foreach ($lokasi_options as $lokasi) { ?>
                                            <option value="<?php echo $lokasi['id']; ?>" <?php if ($lokasi['id'] == $row['lokasi']) echo 'selected'; ?>>
                                              <?php echo $lokasi['lokasi']; ?>
                                            </option>
                                          <?php } ?>
                                        </select>
                                        </select>
                                        <div class="invalid-feedback">
                                          Valid Lokasi is required.
                                        </div>
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="departemen">Departemen</label>
                                        <select class="form-control" name="departemen" id="departemen" required>
                                          <?php foreach ($departemen_options as $departemen) { ?>
                                            <option value="<?php echo $departemen['id']; ?>" <?php if ($departemen['id'] == $row['departemen']) echo 'selected'; ?>>
                                              <?php echo $departemen['departemen']; ?>
                                            </option>
                                          <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                          Valid Departemen is required.
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6 mb-3">
                                        <label for="vendor">Vendor Refill</label>
                                        <input type="text" class="form-control" name="vendor" id="vendor" value="<?php echo $row['vendor']; ?>">
                                        <div class="invalid-feedback">
                                          Valid Departemen is required.
                                        </div>
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="jenisApar">Status Tabung</label>
                                        <input type="date" class="form-control" name="tanggal_penggantian" id="jenisApar" value="<?php echo $row['tanggal_penggantian']; ?>">
                                        <div class="invalid-feedback">
                                          Valid Tanggal Refill is required.
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
                                      <div class="col-md-12 mb-3">
                                        <label class="" for="">Masa Pemakaian</label>
                                        <div class="form-inline">
                                          <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="masa_pemakaian" id="masa_pemakaian_baik" value="1 Tahun" <?php echo ($row['masa_pemakaian'] == '1 Tahun') ? 'checked' : ''; ?>>
                                            <label class="custom-label text-black" for="masa_pemakaian_1 Tahun">1 Tahun</label>
                                          </div>
                                          <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="masa_pemakaian" id="masa_pemakaian_tidak_baik" value="2 Tahun" <?php echo ($row['masa_pemakaian'] == '2 Tahun') ? 'checked' : ''; ?>>
                                            <label class="custom-label text-black" for="masa_pemakaian_tidak_baik">2 Tahun</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12 mb-3">
                                        <label class="" for="">Kondisi Fisik</label>
                                        <div class="form-inline">
                                          <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="kondisi" id="kondisi_baik" value="Layak" <?php echo ($row['kondisi'] == 'Layak') ? 'checked' : ''; ?>>
                                            <label class="custom-label text-black" for="kondisi_1 Tahun">Layak</label>
                                          </div>
                                          <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="kondisi" id="kondisi_tidak_baik" value="Tidak Layak" <?php echo ($row['kondisi'] == 'Tidak Layak') ? 'checked' : ''; ?>>
                                            <label class="custom-label text-black" for="kondisi_tidak_baik">Tidak Layak</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12 mb-3">
                                        <label for="jenisApar">Jenis Apar</label>
                                        <select class="form-control" name="jenis_apar" id="jenis_apar" required>
                                          <?php foreach ($jenis_option as $jenis) { ?>
                                            <option value="<?php echo $jenis['id']; ?>" <?php if ($jenis['id'] == $row['jenis_apar']) echo 'selected'; ?>>
                                              <?php echo $jenis['jenis_apar']; ?>
                                            </option>
                                          <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                          Valid Jenis Apar is required.
                                        </div>
                                      </div>
                                      <div class="col-md-12 mb-3">
                                        <label>Jenis Tabung</label>
                                        <select class="form-control" name="jenis_tabung" required>
                                          <option value="pressure" <?= $row['jenis_tabung'] == 'pressure' ? 'selected' : '' ?>>Pressure</option>
                                          <option value="catridge" <?= $row['jenis_tabung'] == 'catridge' ? 'selected' : '' ?>>Catridge</option>
                                        </select>
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
                                      <div class="col-md-12 mb-3" id="group-pressure">
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
                                      <div class="col-md-12 mb-3" id="group-catridge">
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
                                        <select class="form-control" name="berat" id="berat" required>
                                          <option>Pilih...</option>
                                          <option value="0,5 Kg" <?php echo ($row['berat'] == '0,5 Kg') ? 'selected' : ''; ?>>0,5 Kg</option>
                                          <option value="1 Kg" <?php echo ($row['berat'] == '1 Kg') ? 'selected' : ''; ?>>1 Kg</option>
                                          <option value="2 Kg" <?php echo ($row['berat'] == '2 Kg') ? 'selected' : ''; ?>>2 Kg</option>
                                          <option value="2.3 Kg" <?php echo ($row['berat'] == '2,3 Kg') ? 'selected' : ''; ?>>2,3 Kg</option>
                                          <option value="3 Kg" <?php echo ($row['berat'] == '3 Kg') ? 'selected' : ''; ?>>3 Kg</option>
                                          <option value="4,5 Kg" <?php echo ($row['berat'] == '4,5 Kg') ? 'selected' : ''; ?>>4,5 Kg</option>
                                          <option value="4,6 Kg" <?php echo ($row['berat'] == '4,6 Kg') ? 'selected' : ''; ?>>4,6 Kg</option>
                                          <option value="5 Kg" <?php echo ($row['berat'] == '5 Kg') ? 'selected' : ''; ?>>5 Kg</option>
                                          <option value="6 Kg" <?php echo ($row['berat'] == '6 Kg') ? 'selected' : ''; ?>>6 Kg</option>
                                          <option value="6,8 Kg" <?php echo ($row['berat'] == '6,8 Kg') ? 'selected' : ''; ?>>6,8 Kg</option>
                                          <option value="7 Kg" <?php echo ($row['berat'] == '7 Kg') ? 'selected' : ''; ?>>7 Kg</option>
                                          <option value="9 Kg" <?php echo ($row['berat'] == '9 Kg') ? 'selected' : ''; ?>>9 Kg</option>
                                          <option value="25 Kg" <?php echo ($row['berat'] == '25 Kg') ? 'selected' : ''; ?>>25 Kg</option>
                                          <option value="50 Kg" <?php echo ($row['berat'] == '50 Kg') ? 'selected' : ''; ?>>50 Kg</option>
                                          <option value="60 Kg" <?php echo ($row['berat'] == '60 Kg') ? 'selected' : ''; ?>>60 Kg</option>
                                        </select>
                                        <div class="invalid-feedback">
                                          Valid Berat is required.
                                        </div>
                                      </div>
                                    </div>
                                    <input type="hidden" name="activity" id="activity" value="<?php echo $user_details['nama'] ?> Telah Melakukan Pengeditan Apar  ">
                                    <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>

                          <script>
                            document.addEventListener("DOMContentLoaded", function() {

                              const jenisTabung = document.querySelectorAll('select[name="jenis_tabung"]');

                              jenisTabung.forEach(select => {

                                const modal = select.closest('.modal');
                                const pressureGroup = modal.querySelector('#group-pressure');
                                const catridgeGroup = modal.querySelector('#group-catridge');

                                function update() {
                                  if (select.value === 'pressure') {
                                    pressureGroup.style.display = 'block';
                                    catridgeGroup.style.display = 'none';

                                    catridgeGroup.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
                                  } else if (select.value === 'catridge') {
                                    catridgeGroup.style.display = 'block';
                                    pressureGroup.style.display = 'none';

                                    pressureGroup.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
                                  }
                                }

                                // jalan saat modal pertama muncul
                                update();

                                // jalan saat dropdown diganti
                                select.addEventListener('change', update);
                              });

                            });
                          </script>




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
                                  <form class="needs-validation" action="proses/apar/proses_hapus.php" method="post">
                                    <div class="row">
                                      <div class="col-md-12 mb-3">
                                        <label for="firstName">APAKAH ANDA YAKIN HAPUS?</label>
                                        <input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $row['id']; ?>" required="">
                                        <div class="invalid-feedback">
                                          Valid first name is required.
                                        </div>
                                      </div>
                                      <input type="hidden" name="code_apar" id="code_apar" value="<?php echo $row['code_apar']; ?>">
                                      <input type="hidden" name="activity" id="activity" value="<?php echo $user_details['nama'] ?> Telah Melakukan Penghapusan Apar  ">
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
                          $no++;
                        }

                        ?>
                      </tbody>
                    </table>
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



    <?php if ($detailCode !== ''): ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var guide = document.getElementById('aparDetailGuide');
          var skipGuide = document.getElementById('skipAparDetailGuide');
          var guideKey = 'skipAparDetailGuide_' + document.body.dataset.detailCode;

          if (guide && localStorage.getItem(guideKey) === '1') {
            guide.remove();
          }

          skipGuide?.addEventListener('click', function() {
            localStorage.setItem(guideKey, '1');
            guide.remove();
          });

          document.getElementById('aparDetailPanel')?.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });

          document.querySelectorAll('.skip-apar-modal-guide').forEach(function(button) {
            button.addEventListener('click', function() {
              var guideElement = document.getElementById(button.dataset.guideId);
              if (guideElement) {
                guideElement.remove();
              }
            });
          });

          var detailModal = document.getElementById('detailModal' + document.body.dataset.detailId);
          if (detailModal && document.body.dataset.detailCode) {
            $('#' + detailModal.id).modal('show');
          }

          <?php if ($updated): ?>
            if (typeof swal === 'function') {
              swal({
                title: 'Berhasil diperbarui',
                text: 'Data APAR <?php echo htmlspecialchars($detailCode, ENT_QUOTES, 'UTF-8'); ?> sudah berhasil disimpan.',
                icon: 'success',
                button: {
                  text: 'Lanjutkan',
                  className: 'btn btn-primary'
                }
              });
            }
          <?php endif; ?>
        });
      </script>
    <?php endif; ?>
</body>
<?php
include('../koneksi.php');
// Ambil nomor pendaftaran tertinggi dari tabel data_siswa
// Ambil kode terakhir berdasarkan angka setelah 'AP'
$sql = "SELECT MAX(CAST(SUBSTRING(code_apar, 3) AS UNSIGNED)) AS max_number FROM data_apar";
$result = $koneksi->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $last_number = (int)($row['max_number'] ?? 0);
  $next_number = $last_number + 1;
  $new_registration_number = 'AP' . str_pad($next_number, 3, '0', STR_PAD_LEFT);
} else {
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
              <label for="codeApar">Code Apar</label>
              <input type="text" class="form-control" name="code_apar" id="codeApar" placeholder="" value="<?php echo $new_registration_number; ?>" required readonly style="color: black;">
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
            <div class="col-md-6 mb-3">
              <label for="lokasi">Lokasi</label>
              <select class="custom-select d-block w-100" name="lokasi" id="lokasi" required>
                <option value="">Pilih...</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['id'] . '">' . $row['lokasi'] . '</option>';
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
              <label for="departemen">Departemen</label>
              <select class="custom-select d-block w-100" name="departemen" id="departemen" required>
                <option value="">Pilih...</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['id'] . '">' . $row['departemen'] . '</option>';
                }
                ?>
              </select>
              <div class="invalid-feedback">
                Valid departemen is required.
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
              <select class="form-control" name="jenis_apar" id="jenisApar" required>
                <option value="">Pilih...</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['id'] . '">' . $row['jenis_apar'] . '</option>';
                }
                ?>
              </select>

              <div class="col-md-12 mb-3">
                <label for="jenisTabung">Jenis Tabung</label>
                <select class="form-control" name="jenis_tabung" id="jenisTabung" required>
                  <option value="">Pilih...</option>
                  <option value="pressure">Pressure</option>
                  <option value="catridge">Catridge</option>
                </select>
                <div class="invalid-feedback">
                  Jenis tabung wajib dipilih
                </div>
              </div>

              <input type="hidden" name="nozzle" />
              <input type="hidden" name="tabung" />
              <input type="hidden" name="presure" />
              <input type="hidden" name="catridge" />
              <input type="hidden" name="pin" />
              <input type="hidden" name="handle" />
              <div class="invalid-feedback">
                Valid jenis apar is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="tanggalRefill">Tanggal Refill</label>
              <input type="date" class="form-control" name="tanggal_refill" id="tanggalRefill" placeholder="" required>
              <div class="invalid-feedback">
                Valid tanggal refill is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="tanggalExpired">Tanggal Expired</label>
              <input type="date" class="form-control" name="tanggal_expired" id="tanggalExpired" placeholder="" required>
              <div class="invalid-feedback">
                Valid tanggal expired is required.
              </div>
            </div>
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
                Valid berat is required.
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

              <input type="hidden" name="activity" id="activity" value="<?php echo $row['nama'] ?> Telah Melakukan Penambahan Apar ">
              <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $dayName . ', ' . date('d-m-Y H:i:s') ?>">

            <?php
            }
            ?>
          </div>
          <div class="modal-footer" style="border-top:none; padding:20px 30px; justify-content:flex-end; background:#f0f2f5;">
            <!-- Close Button -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button>

            <!-- Save Changes Button -->
            <button type="submit" class="btn btn-primary save-btn">
              Save changes
            </button>
          </div>

          <style>
            /* Close Button */
            .btn-secondary {
              border-radius: 50px;
              padding: 10px 28px;
              font-weight: 500;
              background: #6c757d;
              color: white;
              border: none;
              box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
              transition: all 0.3s ease;
            }

            .btn-secondary:hover {
              transform: translateY(-2px);
              box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
              background: #5a6268;
            }

            /* Save Changes Button */
            .save-btn {
              border-radius: 50px;
              padding: 10px 28px;
              font-weight: 600;
              color: white;
              border: none;
              background: linear-gradient(145deg, #B22222, #FF4500);
              box-shadow: 0 6px 18px rgba(178, 34, 34, 0.4);
              transition: all 0.3s ease;
              animation: pulse 2.5s infinite;
            }

            .save-btn:hover {
              transform: translateY(-3px);
              box-shadow: 0 8px 25px rgba(178, 34, 34, 0.6);
              background: linear-gradient(145deg, #FF6347, #B22222);
            }

            /* Pulse animation for glowing effect */
            @keyframes pulse {
              0% {
                box-shadow: 0 6px 18px rgba(178, 34, 34, 0.4);
              }

              50% {
                box-shadow: 0 6px 25px rgba(178, 34, 34, 0.7);
              }

              100% {
                box-shadow: 0 6px 18px rgba(178, 34, 34, 0.4);
              }
            }
          </style>

        </form>

      </div>
    </div>
  </div>
</div>

</html>