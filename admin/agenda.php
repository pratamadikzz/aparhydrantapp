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
    <title>Cek Apar | Hydrant  - Agenda Inspeksi</title>
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
    <link rel="stylesheet" href="../assets/css/admin-shell.css" />
    <script src="../assets/js/admin-shell.js"></script>
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


            <li class="nav-item active">
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
              <a href="logout.php" data-admin-logout>
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
  
        $user=$_SESSION['username'];

        $query ="SELECT * FROM user where username='$user'";
        $result = mysqli_query($koneksi,$query);

        if (!$result){
die("query Error :".mysqli_error($koneksi)."-".mysqli_error($koneksi));
        }
        $no =1;

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <div class="avatar-sm">
                 <img src="../assets/img/orang.png" alt="..." class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold"><?php echo $row[ 'nama'] ?></span>
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

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        #calendar {
            max-width: 900px;
            margin: 20px auto;
        }

        .modal-dialog {
            max-width: 500px;
            margin: 30px auto;
        }
    </style>
           <div class="container">
           <div class="page-inner">
    <br>
    <br>
    <br>
    <div id='calendar'></div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Inspeksi</h5>
                </div>
                <div class="modal-body">
                    <form id="addEventForm">
                        <div class="form-group">
                            <label for="code_apar">Code Apar:</label>
                            <select class="form-control" id="code_apar" name="code_apar">
                                <option value="ALL">Seluruh APAR</option>
                                <!-- Options will be populated via JavaScript -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start">Tanggal:</label>
                            <input type="date" class="form-control" id="start" name="start">
                        </div>
                        <input type="hidden" id="keterangan" name="keterangan" value="Belum Inspeksi">
                        <button type="button" class="btn btn-secondary" id="closeButton">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addEvent()">Tambahkan Inspeksi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-body text-center p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 62px; height: 62px; border-radius: 50%; background: #fef2f2; border: 8px solid #fee2e2; color: #dc2626; font-size: 20px;">
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                    <h5 class="font-weight-bold text-dark" id="deleteEventModalLabel">Hapus agenda inspeksi?</h5>
                    <p class="text-muted small mb-4">Agenda yang dipilih akan dihapus dari kalender dan tidak dapat dikembalikan.</p>
                    <div class="d-flex justify-content-center" style="gap: 10px;">
                        <button type="button" class="btn btn-light px-4" id="cancelDeleteEvent">Batal</button>
                        <button type="button" class="btn btn-danger px-4" id="confirmDeleteEvent"><i class="fa-solid fa-trash-can mr-1"></i> Hapus Agenda</button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var selectedAparCode = 'ALL'; // Default to "Seluruh APAR"
    var eventPendingDelete = null;

    // Fetch APAR codes and populate select input
    function fetchAparCodes() {
    $.ajax({
        url: 'proses/get_data/get-apar.php',
        dataType: 'json',
        success: function(data) {
            var select = document.getElementById('code_apar');
            select.innerHTML = '<option value="ALL">Seluruh APAR</option>';  // Add default option
            data.forEach(function(code) {
                var option = document.createElement('option');
                option.value = code;
                option.text = code;
                select.add(option);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error fetching APAR codes: ' + textStatus + ' : ' + errorThrown);
        }
    });
}

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        dateClick: function(info) {
            $('#eventModal').modal('show');
            document.getElementById('start').value = info.dateStr;
            fetchAparCodes();  // Fetch APAR codes when modal is shown
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: 'proses/get_data/get-events.php',
                dataType: 'json',
                data: {
                    code_apar: selectedAparCode
                },
                success: function(data) {
                    successCallback(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('AJAX error: ' + textStatus + ' : ' + errorThrown);
                }
            });
        },
        eventClick: function(info) {
            eventPendingDelete = info.event;
            $('#deleteEventModal').modal('show');
        }
    });

    calendar.render();

    document.getElementById('cancelDeleteEvent').addEventListener('click', function() {
        eventPendingDelete = null;
        $('#deleteEventModal').modal('hide');
    });

    document.getElementById('confirmDeleteEvent').addEventListener('click', function() {
        if (!eventPendingDelete) {
            return;
        }

        var eventId = eventPendingDelete.id;
        var confirmButton = this;
        confirmButton.disabled = true;
        confirmButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menghapus...';

        $.ajax({
            url: 'proses/random/delete-event.php',
            type: 'POST',
            data: { id: eventId },
            success: function(response) {
                $('#deleteEventModal').modal('hide');
                eventPendingDelete = null;
                calendar.refetchEvents();
                alert(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Gagal menghapus agenda: ' + textStatus + ' : ' + errorThrown);
            },
            complete: function() {
                confirmButton.disabled = false;
                confirmButton.innerHTML = '<i class="fa-solid fa-trash-can mr-1"></i> Hapus Agenda';
            }
        });
    });

    // Update the selected APAR code when the user changes the selection
    document.getElementById('code_apar').addEventListener('change', function() {
        selectedAparCode = this.value;
        calendar.refetchEvents(); // Refetch events when APAR code changes
    });

   window.addEvent = function() {
    var code_apar = document.getElementById('code_apar').value;
    var start = document.getElementById('start').value;
    var keterangan = document.getElementById('keterangan').value;

    if (start) {
        if (code_apar === 'ALL') {
            // Fetch all APAR codes except the default "Seluruh APAR"
            var options = document.getElementById('code_apar').options;
            var aparCodes = [];
            for (var i = 1; i < options.length; i++) { // Start from index 1 to skip "Seluruh APAR"
                aparCodes.push(options[i].value);
            }

            // Add an event for each APAR code
            aparCodes.forEach(function(code) {
                $.ajax({
                    url: 'proses/random/add-event.php',
                    type: 'POST',
                    data: {
                        title: code,
                        start: start,
                        keterangan: keterangan
                    },
                    success: function() {
                        calendar.refetchEvents();  // Refresh events from server
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('AJAX error: ' + textStatus + ' : ' + errorThrown);
                    }
                });
            });

            // Hide the modal after all events are added
            $('#eventModal').modal('hide');
        } else {
            // Add event for the selected APAR code
            $.ajax({
                url: 'proses/random/add-event.php',
                type: 'POST',
                data: {
                    title: code_apar,
                    start: start,
                    keterangan: keterangan
                },
                success: function() {
                    calendar.refetchEvents();  // Refresh events from server
                    $('#eventModal').modal('hide'); // Hide the modal after adding event
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('AJAX error: ' + textStatus + ' : ' + errorThrown);
                }
            });
        }
    } else {
        alert('Please select a date!');
    }
}

    // Event listener for Close button
    var closeButton = document.getElementById('closeButton');
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            $('#eventModal').modal('hide'); // Hide modal when Close button is clicked
        });
    }
});
</script>








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


</body>


</html>