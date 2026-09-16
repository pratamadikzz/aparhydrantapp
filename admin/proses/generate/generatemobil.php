<?php
session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke login.php
    header("Location:../../../login.php");
    exit();
}

// Tambahkan kode lainnya untuk index.php di bawah sini
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Cek Apar - Generate Barcode</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../../../assets/img/logokecilAH.png" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../../../assets/js/plugin/webfont/webfont.min.js"></script>
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
                urls: ["../../../assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../../../assets/css/kaiadmin.min.css" />

</head>
 

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="../../../index.php" class="logo">
                        <img src="../../../assets/img/logoAH.png" alt="navbar brand" class="navbar-brand" height="200px" width="200px" />
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
              <a href="../../../index.php">
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
              <a href="../../scan.php">
                <i class="fa-solid fa-qrcode"></i>
                <p>Scan Code</p>

              </a>
            </li>
            <li class="nav-item">
              <a href="../../user.php">
                <i class="fas fa-address-card"></i>
                <p>Data Pengguna</p>

              </a>
            </li>
            <li class="nav-item">
              <a data-toggle="collapse" href="#apar" aria-expanded="false" aria-controls="apar">
                <i class="fa-solid fa-fire-extinguisher"></i>
                <p>Data Master Apar</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="apar">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="../../apar.php">
                      <span class="sub-item">Data Apar</span>
                    </a>
                  </li>
                  <li>
                    <a href="../../apar_mobil.php">
                      <span class="sub-item">Data Apar Mobil</span>
                    </a>
                  </li>
                  <li>
                    <a href="../../jenis_apar.php">
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
                    <a href="../../lokasi.php">
                      <span class="sub-item">Lokasi</span>
                    </a>
                  </li>
                  <li>
                    <a href="../../departemen.php">
                      <span class="sub-item">Departemen</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="../../activity.php">
              <i class="fa-regular fa-calendar"></i>
                <p>Aktivitas Pengguna</p>

              </a>
            </li>
            <li class="nav-item">
                            <a href="../../calender-exp.php">
                                <i class="fa-regular fa-calendar"></i>
                                <p>Kalender Apar</p>

                            </a>
                        </li>


            <li class="nav-item">
              <a href="../../agenda.php">
                <i class="fa-solid fa-calendar-xmark"></i>
                <p>Agenda Inspeksi</p>

              </a>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#laporan">
                <i class="fa-solid fa-bullhorn"></i>
                <p>Laporan Inspeksi</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="laporan">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="../../laporan.php">
                      <span class="sub-item">Laporan Inspeksi Apar</span>
                    </a>
                  </li>
                  <li>
                    <a href="../../laporanhydrant.php">
                      <span class="sub-item">Laporan Inspeksi Hydrant</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>


            <li class="nav-item">
              <a href="../../logout.php">
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
                        <a href="../../../index.php" class="logo">
                            <img src="../../../assets/img/logoAH.png" alt="navbar brand" class="navbar-brand" height="200px" width="200px" />
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
                        include '../../../koneksi.php';

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
                                                include '../../../koneksi.php';

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
                                                        echo "  <img src='../../../assets/img/danger.png' width='40px'>";
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
                                                        echo "   <img src='../../../assets/img/warning.png' width='40px'> ";
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
                                  
                                </ul>
                            </li>
                            <?php
                            include '../../../koneksi.php';

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
                                            <img src="../../../assets/img/orang.png" alt="..." class="avatar-img rounded-circle" />
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
            <script src="../../../assets/js/html5-qrcode.min.js"></script>
            <style>
            .qr-code {
                position: relative;
                display: inline-block;
            }

            .qr-code img.card-image {
                width: 100%;
                height: auto;
            }

            .qr-code .qr-image {
                position: absolute;
                top: 128px;
                right: 20px;
                width: 140px;
                height: 140px;
            }


            .qr-container {
                position: absolute;
                top: 128px;
                right: 20px;
            }

            .card-text {
                position: absolute;
                top: 55%;
                left: 20px;
                transform: translate(0, -50%);
                display: flex;
                align-items: center;
                gap: 20px;
                /* Adjust gap as needed */
                text-align: left;
                /* Ensure text is aligned to the left */
            }


            .card-t,
            .card-i {
                font-size: 12px;
            }

            .card-t div,
            .card-i div {
                margin-bottom: 4px;
            }

            .nama-mesin {
                display: block;
                max-width: 150px;
                word-wrap: break-word;
                white-space: normal;
            }

            /* CSS tambahan untuk kelas span baru */
            .text-mesin {
                font-weight: bold;

                /* Anda bisa mengganti warna sesuai keinginan */
            }

            .text-lokasi {
                font-weight: bold;
                /* Anda bisa mengganti warna sesuai keinginan */
            }

            .text-department {
                font-weight: bold;

                /* Anda bisa mengganti warna sesuai keinginan */
            }

            .separator {
                margin: 0 5px;
                /* Adjust space around the colon */
            }
        </style>

<?php
include '../../../koneksi.php';

if (isset($_GET['code'])) {
    $code = $_GET["code"];

    // Fetch specific data based on code_apar
    $query = "SELECT * FROM data_apar WHERE code_apar = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }

    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        die("No data found for the provided code.");
    }
?>

<div class="page-inner">
    <div class="container-fluid">
        <br>
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">QR Code</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="header">
                            <h1>QR Code Generator</h1>
                            <center>
                                <div class="col-md-3 mb-3">
                                    <input type="text" class="qr-input form-control" value="<?php echo htmlspecialchars($code); ?>" disabled>
                                    <br>
                                    <button class="btn btn-primary generate-btn" onclick="generateQRCode()" style="display:none;">Generate QR Code</button>
                                    <button id="download-btn" class="btn btn-success">Download as Image</button>
                                </div>
                                <div class="card col-lg-12 col-12 p-0 fixed-top d-flex flex-row"></div>
                                <span id="code_apar_value" style="display: none;"><?php echo htmlspecialchars($row['code_apar']); ?></span>
                                <span id="lokasi_value" style="display: none;"><?php echo htmlspecialchars($row['plat_nomer']); ?></span>

                                <div id="qrcode" style="display:none;"></div> <!-- Div for QR code -->
                                <canvas id="canvas" width="800" height="600" style="display:none;"></canvas> <!-- Ukuran kanvas ditingkatkan -->
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

</body>
<script src="../../../assets/js/qrcode.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    generateQRCode();
});

function generateQRCode() {
    var qrInput = document.querySelector(".qr-input");
    var canvas = document.getElementById("canvas");

    if (qrInput.value.length > 0) {
        // Generate QR code using QRCode.js
        var qrcodeDiv = document.getElementById("qrcode");
        qrcodeDiv.innerHTML = ""; // Clear previous QR code
        var qrcode = new QRCode(qrcodeDiv, {
            text: qrInput.value,
            width: 340,
            height: 340
        });

        setTimeout(function() {
            var qrImg = qrcodeDiv.querySelector('img');
            var qrImgSrc = qrImg.src;

            var context = canvas.getContext('2d');
            context.clearRect(0, 0, canvas.width, canvas.height);

            // Load the card image
            var cardImage = new Image();
            cardImage.crossOrigin = "Anonymous"; // Ensure cross-origin is handled
            cardImage.src = "../../../assets/img/5.png";
            cardImage.onload = function() {
                // Draw the card image on the canvas
                context.globalCompositeOperation = "source-over"; // Ensure default composition mode
                context.drawImage(cardImage, 0, 0, canvas.width, canvas.height);

                // Create QR image
                var qrImg = new Image();
                qrImg.crossOrigin = "Anonymous"; // Ensure cross-origin is handled
                qrImg.src = qrImgSrc;

                qrImg.onload = function() {
                    // Calculate the position for the QR code
                    const qrX = canvas.width - qrImg.width - 30; // 30px padding from right
                    const qrY = 144; // 144px padding from top

                    // Draw the QR code on the canvas
                    context.drawImage(qrImg, qrX, qrY, qrImg.width, qrImg.height);

                    // Set text properties
                    context.font = "bold 25px verdana"; // Increased font size
                    context.fillStyle = "black";
                    context.textAlign = "left";

                    // Get the text values
                    const noMesinText = document.getElementById('code_apar_value').innerText;
                    const namaLokasiText = document.getElementById('lokasi_value').innerText;

                    // Draw the labels on the canvas
                    const labelX = 20;
                    const valueX = 230; // Adjusted position for values
                    const baseY = 278;
                    const lineHeight = 60;

                    context.fillText("", labelX, baseY);
                    context.fillText(noMesinText, valueX, baseY);

                    context.fillText("", labelX, baseY + lineHeight);
                    context.fillText(namaLokasiText, valueX, baseY + lineHeight);

                    // Show the canvas
                    canvas.style.display = 'block';
                }
            }
        }, 1000); // Delay to ensure QR code generation is complete
    }
}

document.getElementById('download-btn').addEventListener('click', function() {
    var canvas = document.getElementById('canvas');
    var codeApar = document.getElementById('code_apar_value').innerText.trim();
    var link = document.createElement('a');
    link.href = canvas.toDataURL('image/png');
    link.download = codeApar + '.png';
    link.click();
});
</script>

</div>



</div>

<!-- Custom template | don't include it in your project! -->

<!-- End Custom template -->
</div>
<script src="../../../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/core/popper.min.js"></script>
    <script src="../../../assets/js/core/bootstrap.min.js"></script>


    <!-- jQuery Scrollbar -->
    <script src="../../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../../../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../../../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../../../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../../../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../../../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../../../assets/js/kaiadmin.min.js"></script>


<!-- Kaiadmin DEMO methods, don't include it in your project! -->


</body>

</html>