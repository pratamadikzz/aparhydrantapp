    <?php
    session_start();

    // Simpan nama operator khusus scan yang diisi dari halaman index
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scan_name'])) {
      $scan_name = trim($_POST['scan_name']);
      if ($scan_name !== '') {
        $_SESSION['scan_name'] = $scan_name;
      }
      header('Location: index.php');
      exit();
    }

    // Cek apakah pengguna sudah login atau belum
    if (!isset($_SESSION['username'])) {
      // Jika belum login, arahkan ke login.php
      header("Location: login.php");
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
      <title>Cek Apar | Hydrant - Dashboard</title>
      <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
      <link rel="icon" href="assets/img/logokecilAH.png" type="image/x-icon" />

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
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=fire_hydrant" />

      <style>
        .operator-modal .modal-dialog {
          width: calc(100% - 32px);
          max-width: 440px;
        }

        .operator-modal .modal-content {
          overflow: hidden;
          border: 1px solid rgba(255, 255, 255, .72);
          border-radius: 24px;
          background: #fff;
          box-shadow: 0 28px 70px rgba(15, 23, 42, .25);
        }

        .operator-modal .modal-header {
          position: relative;
          display: block;
          padding: 30px 30px 22px;
          border: 0;
          background: linear-gradient(135deg, #991b1b 0%, #dc2626 58%, #f97316 100%);
          color: #fff;
        }

        .operator-modal .modal-header::after {
          position: absolute;
          right: -42px;
          bottom: -68px;
          width: 168px;
          height: 168px;
          border: 1px solid rgba(255, 255, 255, .18);
          border-radius: 50%;
          content: "";
        }

        .operator-modal__icon {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          width: 52px;
          height: 52px;
          margin-bottom: 18px;
          border: 1px solid rgba(255, 255, 255, .35);
          border-radius: 16px;
          background: rgba(255, 255, 255, .16);
          font-size: 21px;
        }

        .operator-modal__eyebrow {
          margin: 0 0 6px;
          color: rgba(255, 255, 255, .74);
          font-size: .7rem;
          font-weight: 700;
          letter-spacing: .12em;
          text-transform: uppercase;
        }

        .operator-modal .modal-title {
          position: relative;
          z-index: 1;
          margin: 0;
          color: #fff;
          font-size: 1.55rem;
          font-weight: 700;
        }

        .operator-modal__description {
          position: relative;
          z-index: 1;
          max-width: 320px;
          margin: 8px 0 0;
          color: rgba(255, 255, 255, .86);
          font-size: .88rem;
          line-height: 1.6;
        }

        .operator-modal .modal-body {
          padding: 26px 30px 30px;
        }

        .operator-modal__label {
          display: block;
          margin-bottom: 9px;
          color: #1e293b;
          font-size: .84rem;
          font-weight: 700;
        }

        .operator-modal__input-wrap {
          position: relative;
        }

        .operator-modal__input-wrap i {
          position: absolute;
          top: 50%;
          left: 16px;
          z-index: 1;
          color: #94a3b8;
          font-size: 16px;
          transform: translateY(-50%);
        }

        .operator-modal .form-control {
          height: 52px;
          padding: 12px 16px 12px 44px;
          border: 1px solid #dbe3ee;
          border-radius: 13px;
          background: #f8fafc;
          color: #0f172a;
          font-size: .94rem;
          transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .operator-modal .form-control::placeholder {
          color: #94a3b8;
        }

        .operator-modal .form-control:focus {
          border-color: #ef4444;
          background: #fff;
          box-shadow: 0 0 0 4px rgba(239, 68, 68, .12);
        }

        .operator-modal__hint {
          display: flex;
          align-items: flex-start;
          gap: 7px;
          margin-top: 10px;
          color: #64748b;
          font-size: .76rem;
          line-height: 1.5;
        }

        .operator-modal__hint i {
          margin-top: 2px;
          color: #f97316;
        }

        .operator-modal__actions {
          margin-top: 24px;
        }

        .operator-modal__submit {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          gap: 9px;
          width: 100%;
          min-height: 50px;
          border: 0;
          border-radius: 13px;
          background: #dc2626;
          color: #fff;
          font-size: .9rem;
          font-weight: 700;
          box-shadow: 0 10px 20px rgba(220, 38, 38, .2);
          transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
        }

        .operator-modal__submit:hover,
        .operator-modal__submit:focus {
          background: #b91c1c;
          color: #fff;
          box-shadow: 0 13px 24px rgba(185, 28, 28, .25);
          transform: translateY(-1px);
        }

        .logout-modal .modal-dialog {
          width: calc(100% - 32px);
          max-width: 400px;
        }

        .logout-modal .modal-content {
          overflow: hidden;
          border: 1px solid #e2e8f0;
          border-radius: 24px;
          background: #fff;
          box-shadow: 0 28px 70px rgba(15, 23, 42, .25);
        }

        .logout-modal .modal-body {
          padding: 32px 30px 28px;
          text-align: center;
        }

        .logout-modal__icon {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          width: 64px;
          height: 64px;
          margin-bottom: 18px;
          border: 8px solid #fee2e2;
          border-radius: 50%;
          background: #fef2f2;
          color: #dc2626;
          font-size: 21px;
        }

        .logout-modal .modal-title {
          margin: 0;
          color: #0f172a;
          font-size: 1.35rem;
          font-weight: 700;
        }

        .logout-modal__description {
          max-width: 295px;
          margin: 9px auto 0;
          color: #64748b;
          font-size: .88rem;
          line-height: 1.6;
        }

        .logout-modal__actions {
          display: flex;
          gap: 10px;
          margin-top: 26px;
        }

        .logout-modal__button {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          gap: 8px;
          min-height: 48px;
          border-radius: 12px;
          font-size: .86rem;
          font-weight: 700;
          transition: background .2s ease, border-color .2s ease, color .2s ease, transform .2s ease;
        }

        .logout-modal__button--cancel {
          flex: 1;
          border: 1px solid #cbd5e1;
          background: #fff;
          color: #475569;
        }

        .logout-modal__button--cancel:hover,
        .logout-modal__button--cancel:focus {
          border-color: #94a3b8;
          background: #f8fafc;
          color: #1e293b;
        }

        .logout-modal__button--confirm {
          flex: 1.25;
          border: 1px solid #dc2626;
          background: #dc2626;
          color: #fff;
          box-shadow: 0 9px 18px rgba(220, 38, 38, .2);
        }

        .logout-modal__button--confirm:hover,
        .logout-modal__button--confirm:focus {
          border-color: #b91c1c;
          background: #b91c1c;
          color: #fff;
          transform: translateY(-1px);
        }

        .dashboard-notification-link {
          position: relative;
          display: inline-flex !important;
          align-items: center;
          justify-content: center;
          width: 42px;
          height: 42px;
          margin-right: 4px;
          border-radius: 13px;
          background: #f8fafc;
          color: #475569 !important;
          transition: background .2s ease, color .2s ease, transform .2s ease;
        }

        .dashboard-notification-link:hover {
          background: #fff1f2;
          color: #dc2626 !important;
          transform: translateY(-1px);
        }

        .dashboard-notification-link .notification {
          top: 1px;
          right: -2px;
          min-width: 19px;
          height: 19px;
          padding: 2px 5px;
          border: 2px solid #fff;
          border-radius: 999px;
          background: #dc2626 !important;
          font-size: .62rem;
          font-weight: 700;
          line-height: 13px;
        }

        .dashboard-notification-menu {
          width: min(360px, calc(100vw - 24px));
          margin-top: 9px;
          overflow: hidden;
          padding: 0;
          border: 1px solid #e2e8f0;
          border-radius: 18px;
          box-shadow: 0 18px 42px rgba(15, 23, 42, .16);
        }

        .dashboard-notification-header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 16px 18px 14px;
          border-bottom: 1px solid #f1f5f9;
          background: #fff;
        }

        .dashboard-notification-header strong {
          display: block;
          color: #172033;
          font-size: .9rem;
        }

        .dashboard-notification-header span {
          display: block;
          margin-top: 3px;
          color: #94a3b8;
          font-size: .7rem;
        }

        .dashboard-notification-header i {
          color: #dc2626;
          font-size: 17px;
        }

        .dashboard-notification-list {
          max-height: 300px;
          background: #fff;
        }

        .dashboard-notification-list a {
          display: flex !important;
          align-items: center;
          gap: 11px;
          min-height: 68px;
          padding: 11px 18px !important;
          border-bottom: 1px solid #f1f5f9;
          color: #334155 !important;
          text-decoration: none;
          transition: background .2s ease;
        }

        .dashboard-notification-list a:hover {
          background: #f8fafc;
        }

        .dashboard-notification-list a:last-child {
          border-bottom: 0;
        }

        .dashboard-notification-list .notif-icon {
          display: inline-flex;
          flex: 0 0 38px;
          align-items: center;
          justify-content: center;
          width: 38px;
          height: 38px;
          border-radius: 12px;
          background: #fff1f2;
        }

        .dashboard-notification-list .notif-icon--warning {
          background: #fff7ed;
        }

        .dashboard-notification-list .notif-icon img {
          width: 22px;
          height: 22px;
          object-fit: contain;
        }

        .dashboard-notification-list .notif-content {
          min-width: 0;
        }

        .dashboard-notification-list .notif-content .block {
          display: block;
          overflow: hidden;
          color: #334155;
          font-size: .76rem;
          font-weight: 600;
          line-height: 1.45;
          text-overflow: ellipsis;
          white-space: nowrap;
        }

        .dashboard-notification-empty {
          padding: 28px 18px;
          color: #94a3b8;
          text-align: center;
          font-size: .78rem;
        }

        .bs4ToastWrapper {
          z-index: 1080;
          top: 82px;
          right: 24px;
          left: auto;
          width: min(360px, calc(100vw - 32px));
          overflow: hidden;
          border: 1px solid #e2e8f0;
          border-radius: 16px;
          background: #fff;
          box-shadow: 0 18px 42px rgba(15, 23, 42, .18);
        }

        .bs4ToastWrapper .toast-header {
          min-height: 42px;
          padding: 10px 14px;
          border: 0;
          background: #fff !important;
          color: #172033 !important;
        }

        .bs4ToastWrapper .toast-header strong {
          font-size: .8rem;
        }

        .bs4ToastWrapper .toast-header strong::before {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          width: 22px;
          height: 22px;
          margin-right: 8px;
          border-radius: 8px;
          background: #fee2e2;
          color: #dc2626;
          content: "!";
          font-size: .75rem;
          font-weight: 800;
        }

        .bs4ToastWrapper .toast-body {
          padding: 0 14px 14px 44px;
          color: #64748b;
          font-size: .76rem;
          line-height: 1.45;
        }

        .bs4ToastWrapper .close {
          color: #94a3b8;
          font-size: 1.1rem;
          opacity: 1;
        }

        @media (max-width: 600px) {
          .dashboard-notification-menu {
            position: fixed !important;
            top: 62px;
            right: 12px;
            left: auto;
            margin-top: 0;
          }

          .bs4ToastWrapper {
            top: 68px;
            right: 16px;
            width: calc(100vw - 32px);
          }
        }

        @media (max-width: 480px) {

          .operator-modal .modal-header,
          .operator-modal .modal-body {
            padding-right: 22px;
            padding-left: 22px;
          }

          .logout-modal .modal-body {
            padding-right: 22px;
            padding-left: 22px;
          }

          .logout-modal__actions {
            flex-direction: column-reverse;
          }

          .logout-modal__button--cancel,
          .logout-modal__button--confirm {
            flex: none;
            width: 100%;
          }
        }
      </style>

    </head>


    <body onload="checkExpiredAparCount(); checkWarningAparCount();checkUninspectedApar() ">

      <?php if (empty($_SESSION['scan_name'])): ?>
        <div class="modal fade operator-modal" id="operatorNameModal" tabindex="-1" role="dialog" aria-labelledby="operatorNameModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="operator-modal__icon" aria-hidden="true"><i class="fa-solid fa-user-check"></i></div>
                <p class="operator-modal__eyebrow">Identitas inspeksi</p>
                <h5 class="modal-title" id="operatorNameModalLabel">Masukkan Nama Anda</h5>
                <p class="operator-modal__description">Nama ini akan dicatat sebagai operator pada setiap aktivitas pemeriksaan.</p>
              </div>
              <div class="modal-body">
                <form method="post" action="index.php" id="operatorNameForm">
                  <div class="form-group">
                    <label class="operator-modal__label" for="scanNameInput">Nama Operator</label>
                    <div class="operator-modal__input-wrap">
                      <i class="fa-solid fa-id-card" aria-hidden="true"></i>
                      <input type="text" name="scan_name" id="scanNameInput" class="form-control" placeholder="Contoh: Budi Santoso" maxlength="100" autocomplete="name" required>
                    </div>
                    <div class="operator-modal__hint"><i class="fa-solid fa-circle-info" aria-hidden="true"></i><span>Gunakan nama lengkap agar riwayat inspeksi mudah ditelusuri.</span></div>
                  </div>
                  <div class="operator-modal__actions">
                    <button type="submit" class="operator-modal__submit">Mulai Pemeriksaan <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="modal fade logout-modal" id="logoutConfirmModal" tabindex="-1" role="dialog" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div class="logout-modal__icon" aria-hidden="true"><i class="fa-solid fa-right-from-bracket"></i></div>
              <h5 class="modal-title" id="logoutConfirmModalLabel">Keluar dari akun?</h5>
              <p class="logout-modal__description">Sesi Anda akan diakhiri dan Anda perlu login kembali untuk mengakses dashboard.</p>
              <div class="logout-modal__actions">
                <button type="button" class="logout-modal__button logout-modal__button--cancel" id="cancelLogoutButton">Batal</button>
                <a href="admin/logout.php" class="logout-modal__button logout-modal__button--confirm">Ya, Logout <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
          <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.php" class="logo">
                <img src="assets/img/logoAH.png" alt="navbar brand" class="navbar-brand" height="200px" width="200px" />
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
                <?php if ($user_level === 'admin' || $user_level === 'user'): ?>
                  <li class="nav-item">
                    <a href="admin/scan.php">
                      <i class="fa-solid fa-qrcode"></i>
                      <p>Scan Code</p>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if ($user_level === 'admin'): ?>
                  <li class="nav-item">
                    <a href="admin/user.php">
                      <i class="fas fa-address-card"></i>
                      <p>Data Pengguna</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#apar">
                      <i class="fa-solid fa-database"></i>
                      <p>Data Master</p>
                      <span class="caret"></span>
                    </a>
                    <div class="collapse" id="apar">
                      <ul class="nav nav-collapse">
                        <li>
                          <a href="admin/hydrant.php">
                            <span class="sub-item">Data Hydrant</span>
                          </a>
                        </li>
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
                        <a href="admin/laporan.php">
                          <span class="sub-item">Laporan Inspeksi Apar</span>
                        </a>
                      </li>
                      <li>
                        <a href="admin/laporanhydrant.php">
                          <span class="sub-item">Laporan Inspeksi Hydrant</span>
                        </a>
                      </li>

                    </ul>
                  </div>
                </li>





                <li class="nav-item">
                  <a href="#" id="logoutTrigger" role="button" aria-haspopup="dialog" aria-controls="logoutConfirmModal">
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
                          <script type="text/javascript">
                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat',
                              'Sabtu'
                            ];

                            function updateDateTime() {
                              var date = new Date();
                              var day = date.getDate();
                              var month = date.getMonth();
                              var thisDay = myDays[date.getDay()];
                              var yy = date.getYear();
                              var year = (yy < 1000) ? yy + 1900 : yy;

                              // Waktu (jam:menit:detik)
                              var hours = ("0" + date.getHours()).slice(-2);
                              var minutes = ("0" + date.getMinutes()).slice(-2);
                              var seconds = ("0" + date.getSeconds()).slice(-2);

                              // Gabung tanggal + waktu
                              var fullDateTime = thisDay + ', ' + day + ' ' + months[month] + ' ' + year +
                                ' - ' + hours + ':' + minutes + ':' + seconds;

                              document.getElementById("tanggal_waktu").innerHTML = fullDateTime;
                            }

                            setInterval(updateDateTime, 1000); // Update setiap 1 detik
                            updateDateTime(); // Panggil langsung biar muncul tanpa nunggu 1 detik
                          </script>

                          <span id="tanggal_waktu"></span>
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
                    <a class="nav-link dropdown-toggle dashboard-notification-link" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Notifikasi">
                      <i class="fa fa-bell"></i>
                      <span class="notification" style="background-color: red;"><?php echo $total_items; ?></span>
                    </a>
                    <ul class="dropdown-menu notif-box dashboard-notification-menu animated fadeIn" aria-labelledby="notifDropdown">
                      <li>
                        <div class="dashboard-notification-header">
                          <div><strong>Notifikasi</strong><span><?php echo $total_items; ?> perlu diperhatikan</span></div>
                          <i class="fa-solid fa-bell" aria-hidden="true"></i>
                        </div>
                      </li>
                      <li>
                        <div class='notif-scroll scrollbar-outer dashboard-notification-list'>
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
                                echo "  <a href='admin/apar.php?code=" . urlencode($row["code_apar"]) . "&guide=expired'>";
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
                                echo "  <a href='admin/apar.php?code=" . urlencode($row["code_apar"]) . "&guide=near_expiry'>";
                                echo "  <div class='notif-icon notif-icon--warning'>";
                                echo "   <img src='assets/img/warning.png' width='40px'> ";
                                echo " </div>";
                                echo "  <div class='notif-content'>";
                                echo "    <span class='block'>" . $row["code_apar"] . ", Mendekati Waktu Expired " . "</span>";

                                echo "  </div>";
                                echo "</a>";
                              }
                            }

                            if ($total_items === 0) {
                              echo "<div class='dashboard-notification-empty'><i class='fa-regular fa-circle-check'></i><br>Semua aset dalam kondisi terpantau.</div>";
                            }

                            ?>


                          </div>
                        </div>
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

          <div class="container dashboard-container">
            <div class="page-inner">
              <section class="dashboard-hero">
                <div class="dashboard-hero__content">
                  <span class="dashboard-eyebrow"><i class="fa-solid fa-chart-line"></i> Ringkasan operasional</span>
                  <h1>Selamat datang, <?php echo htmlspecialchars($_SESSION['scan_name'] ?? $_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></h1>
                  <p>Kelola inspeksi APAR dan Hydrant dengan lebih cepat, rapi, dan terukur.</p>
                </div>
                <?php if ($user_level === 'admin' || $user_level === 'user'): ?>
                  <a class="dashboard-hero__action" href="admin/scan.php">
                    <span class="dashboard-hero__action-icon"><i class="fa-solid fa-qrcode"></i></span>
                    <span><strong>Mulai Scan</strong><small>Periksa aset sekarang</small></span>
                    <i class="fa-solid fa-arrow-up-right-from-square dashboard-hero__action-arrow"></i>
                  </a>
                <?php endif; ?>
              </section>

              <?php if ($user_level === 'admin'): ?>
                <div class="dashboard-section-heading">
                  <div>
                    <span class="dashboard-eyebrow dashboard-eyebrow--dark">Akses cepat</span>
                    <h2>Kelola aktivitas utama</h2>
                  </div>
                  <span class="dashboard-section-note">Pilih menu untuk melanjutkan pekerjaan</span>
                </div>
              <?php endif; ?>

              <?php if ($user_level === 'admin'): ?>
                <div class="row dashboard-actions">
                  <div class="col-sm-6 col-lg-4">
                    <a class="dashboard-action-card dashboard-action-card--scan" href="admin/scan.php">
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


                  <div class="col-sm-6 col-lg-4">
                    <a class="dashboard-action-card dashboard-action-card--inventory" href="admin/apar.php">
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

                  <div class="col-sm-6 col-lg-4">
                    <a class="dashboard-action-card dashboard-action-card--agenda" href="admin/agenda.php">
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
                  <div class="row dashboard-actions dashboard-actions--secondary">
                    <div class="col-sm-6 col-md-3">
                      <a class="dashboard-action-card dashboard-action-card--danger" href="admin/rusak_exp.php?filter=expired_damaged">
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
                      <a class="dashboard-action-card dashboard-action-card--report" href="admin/laporan.php">
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
                      <a class="dashboard-action-card dashboard-action-card--users ab" href="admin/user.php">
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
              <?php endif; ?>

              <style>
                .dashboard-container {
                  background: #f5f7fb;
                }

                .dashboard-hero {
                  position: relative;
                  display: flex;
                  align-items: center;
                  justify-content: space-between;
                  gap: 28px;
                  min-height: 220px;
                  margin: 8px 0 32px;
                  overflow: hidden;
                  padding: 34px 38px;
                  border-radius: 24px;
                  background: linear-gradient(118deg, #111827 0%, #1e293b 58%, #b91c1c 100%);
                  box-shadow: 0 18px 38px rgba(15, 23, 42, .16);
                }

                .dashboard-hero::before,
                .dashboard-hero::after {
                  position: absolute;
                  border: 1px solid rgba(255, 255, 255, .12);
                  border-radius: 50%;
                  content: "";
                  pointer-events: none;
                }

                .dashboard-hero::before {
                  top: -108px;
                  right: 160px;
                  width: 250px;
                  height: 250px;
                }

                .dashboard-hero::after {
                  right: -86px;
                  bottom: -142px;
                  width: 300px;
                  height: 300px;
                }

                .dashboard-hero__content,
                .dashboard-hero__action {
                  position: relative;
                  z-index: 1;
                }

                .dashboard-eyebrow {
                  display: inline-flex;
                  align-items: center;
                  gap: 8px;
                  color: #fca5a5;
                  font-size: .7rem;
                  font-weight: 700;
                  letter-spacing: .12em;
                  text-transform: uppercase;
                }

                .dashboard-hero h1 {
                  max-width: 650px;
                  margin: 12px 0 8px;
                  color: #fff;
                  font-size: clamp(1.65rem, 3vw, 2.45rem);
                  font-weight: 700;
                  letter-spacing: 0;
                }

                .dashboard-hero p {
                  max-width: 560px;
                  margin: 0;
                  color: #cbd5e1;
                  font-size: .95rem;
                }

                .dashboard-hero__action {
                  display: flex;
                  align-items: center;
                  gap: 12px;
                  min-width: 225px;
                  padding: 13px 15px;
                  border: 1px solid rgba(255, 255, 255, .2);
                  border-radius: 16px;
                  background: rgba(255, 255, 255, .12);
                  color: #fff;
                  text-decoration: none;
                  backdrop-filter: blur(10px);
                  transition: background .2s ease, transform .2s ease;
                }

                .dashboard-hero__action:hover {
                  background: rgba(255, 255, 255, .2);
                  color: #fff;
                  transform: translateY(-2px);
                }

                .dashboard-hero__action-icon {
                  display: inline-flex;
                  align-items: center;
                  justify-content: center;
                  width: 42px;
                  height: 42px;
                  border-radius: 12px;
                  background: #ef4444;
                  box-shadow: 0 8px 18px rgba(239, 68, 68, .28);
                }

                .dashboard-hero__action strong,
                .dashboard-hero__action small {
                  display: block;
                }

                .dashboard-hero__action strong {
                  font-size: .88rem;
                }

                .dashboard-hero__action small {
                  margin-top: 2px;
                  color: #cbd5e1;
                  font-size: .72rem;
                }

                .dashboard-hero__action-arrow {
                  margin-left: auto;
                  color: #fca5a5;
                  font-size: .82rem;
                }

                .dashboard-section-heading {
                  display: flex;
                  align-items: flex-end;
                  justify-content: space-between;
                  gap: 16px;
                  margin-bottom: 16px;
                }

                .dashboard-eyebrow--dark {
                  color: #dc2626;
                }

                .dashboard-section-heading h2 {
                  margin: 5px 0 0;
                  color: #172033;
                  font-size: 1.3rem;
                  font-weight: 700;
                }

                .dashboard-section-note {
                  color: #64748b;
                  font-size: .78rem;
                }

                .dashboard-actions {
                  margin-right: -10px;
                  margin-left: -10px;
                }

                .dashboard-actions>[class*="col-"] {
                  padding-right: 10px;
                  padding-left: 10px;
                }

                .dashboard-action-card {
                  display: block;
                  height: 100%;
                  color: inherit;
                  text-decoration: none;
                }

                .dashboard-action-card .card {
                  height: calc(100% - 20px);
                  overflow: hidden;
                  border: 0;
                  border-radius: 18px;
                  background: #fff;
                  box-shadow: 0 8px 22px rgba(15, 23, 42, .07);
                  transition: box-shadow .2s ease, transform .2s ease;
                }

                .dashboard-action-card:hover .card {
                  background: #fff;
                  box-shadow: 0 15px 30px rgba(15, 23, 42, .14);
                  transform: translateY(-4px);
                }

                .dashboard-action-card .custom-card-body {
                  position: relative;
                  min-height: 174px;
                  height: 100%;
                  border: 1px solid #e2e8f0;
                  border-radius: 18px;
                }

                .dashboard-action-card .custom-card-body::after {
                  position: absolute;
                  right: -28px;
                  bottom: -42px;
                  width: 115px;
                  height: 115px;
                  border-radius: 50%;
                  background: rgba(248, 113, 113, .08);
                  content: "";
                }

                .dashboard-action-card .icon-big {
                  position: relative;
                  z-index: 1;
                  width: 76px;
                  height: 76px;
                  border-radius: 22px;
                  background: #fef2f2;
                }

                .dashboard-action-card .icon-big img {
                  max-width: 58px;
                  max-height: 58px;
                  object-fit: contain;
                }

                .dashboard-action-card--danger .icon-big {
                  background: #fff7ed;
                }

                .dashboard-action-card--inventory .icon-big,
                .dashboard-action-card--users .icon-big {
                  background: #eff6ff;
                }

                .dashboard-action-card--agenda .icon-big {
                  background: #f0fdf4;
                }

                .dashboard-action-card--report .icon-big {
                  background: #fefce8;
                }

                .dashboard-action-card .card-category {
                  position: relative;
                  z-index: 1;
                  margin-bottom: 0;
                  color: #1e293b !important;
                  font-size: .86rem;
                  font-weight: 700;
                }

                .dashboard-stats-heading {
                  display: flex;
                  align-items: center;
                  justify-content: space-between;
                  margin: 18px 0 14px;
                }

                .dashboard-stats-heading h2 {
                  margin: 0;
                  color: #172033;
                  font-size: 1.3rem;
                  font-weight: 700;
                }

                .dashboard-stats-heading span {
                  color: #94a3b8;
                  font-size: .78rem;
                }

                .dashboard-stats .card {
                  overflow: hidden;
                  border: 1px solid #e2e8f0;
                  border-radius: 18px;
                  box-shadow: 0 8px 22px rgba(15, 23, 42, .05);
                }

                .dashboard-stats .card-body {
                  min-height: 112px;
                }

                .dashboard-stats .icon-big {
                  width: 48px;
                  height: 48px;
                  border-radius: 14px;
                }

                .dashboard-stats .card-category {
                  margin-bottom: 3px;
                  color: #64748b;
                  font-size: .78rem;
                }

                .dashboard-stats .card-title {
                  margin: 0;
                  color: #172033;
                  font-size: 1.45rem;
                  font-weight: 700;
                }

                .custom-card-body {
                  display: flex;
                  flex-direction: column;
                  align-items: center;
                  justify-content: center;
                  height: 150px;
                }

                .icon-big {
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  width: 100px;
                  height: 100px;
                }

                .card-category {
                  font-size: 14px;
                }

                .card-stats {
                  margin-bottom: 20px;
                }

                @media (max-width: 767px) {
                  .dashboard-hero {
                    align-items: flex-start;
                    flex-direction: column;
                    padding: 28px 24px;
                  }

                  .dashboard-hero__action {
                    width: 100%;
                  }

                  .dashboard-section-heading {
                    align-items: flex-start;
                    flex-direction: column;
                  }

                  .dashboard-section-note {
                    display: none;
                  }
                }
              </style>

              <div class="dashboard-stats-heading">
                <h2>Ringkasan aset</h2>
                <span>Data terkini sistem</span>
              </div>

              <div class="dashboard-stats">
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
                  $query = "SELECT COUNT(*) AS total_hydrant FROM data_hydrant";
                  $result = mysqli_query($koneksi, $query);

                  if (!$result) {
                    die("Query error: " . mysqli_error($koneksi));
                  }

                  $row = mysqli_fetch_assoc($result);
                  $total_siswa = $row['total_hydrant'];

                  $koneksi->close();
                  ?>
                  <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small" style="background-color: red;">
                              <i><svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#FFFFFF">
                                  <path d="M203.08-120v-30.77H280v-160.77h-56.92q-16.08 0-28.04-11.96t-11.96-28.04v-87.69q0-16.08 11.96-28.04t28.04-11.96H280V-640h-76.92v-30.77h78.77q11.53-72.61 66.96-120.92Q404.23-840 480-840t131.19 48.31q55.43 48.31 66.96 120.92h78.77V-640H680v160.77h56.92q16.08 0 28.04 11.96t11.96 28.04v87.69q0 16.08-11.96 28.04t-28.04 11.96H680v160.77h76.92V-120H203.08Zm276.89-153.85q50.34 0 85.95-35.58 35.62-35.58 35.62-85.92t-35.59-85.96q-35.58-35.61-85.92-35.61t-85.95 35.58q-35.62 35.59-35.62 85.92 0 50.34 35.59 85.96 35.58 35.61 85.92 35.61Zm.17-30.77q-37.76 0-64.33-26.43-26.58-26.43-26.58-64.19t26.43-64.34q26.44-26.57 64.2-26.57 37.76 0 64.33 26.43 26.58 26.43 26.58 64.19t-26.43 64.34q-26.44 26.57-64.2 26.57Z" />
                                </svg></i>
                            </div>
                          </div>
                          <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                              <p class="card-category">Total Hydrant</p>
                              <h4 class="card-title"><?php echo $row['total_hydrant']; ?></h4>
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
      <link href="assets/css/bs4Toast.css" rel="stylesheet">
      <script src="assets/js/core/jquery-3.7.1.min.js"></script>
      <script src="assets/js/bootstrap.js"></script>
      <script src="assets/js/bs4-toast.js"></script>

      <script>
        function dangerT(count) {
          bs4Toast.error('Perlu tindakan', 'Ada ' + count + ' APAR yang sudah expired.', {
            delay: 6000,
            icon: {
              type: 'fontawesome',
              class: 'fa-solid fa-triangle-exclamation'
            }
          });
        }

        function warning(count) {
          bs4Toast.warning('Perhatian', 'Ada ' + count + ' APAR yang mendekati tanggal expired.', {
            delay: 6000,
            icon: {
              type: 'fontawesome',
              class: 'fa-solid fa-clock'
            }
          });
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

      <!-- jQuery Vector laporan -->
      <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
      <script src="assets/js/plugin/jsvectormap/world.js"></script>

      <!-- Sweet Alert -->
      <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

      <!-- Kaiadmin JS -->
      <script src="assets/js/kaiadmin.min.js"></script>

      <?php if (empty($_SESSION['scan_name'])): ?>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var operatorModal = document.getElementById('operatorNameModal');
            if (operatorModal) {
              $('#operatorNameModal').modal({
                backdrop: 'static',
                keyboard: false
              });
              $('#operatorNameModal').modal('show');
            }
          });
        </script>
      <?php endif; ?>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var logoutTrigger = document.getElementById('logoutTrigger');
          if (logoutTrigger) {
            logoutTrigger.addEventListener('click', function(event) {
              event.preventDefault();
              $('#logoutConfirmModal').modal('show');
            });
          }

          var cancelLogoutButton = document.getElementById('cancelLogoutButton');
          if (cancelLogoutButton) {
            cancelLogoutButton.addEventListener('click', function() {
              $('#logoutConfirmModal').modal('hide');
            });
          }
        });
      </script>

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