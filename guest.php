<?php
session_start();

// Proteksi tamu
if (!isset($_SESSION['guest']) || $_SESSION['guest'] !== true) {
    header("Location: index.php");
    exit;
}

$lokasi = $_SESSION['lokasi'] ?? '';

// --- pilih koneksi berdasarkan lokasi database ---
if ($lokasi === 'Bogor') {
    $db_host = "sql202.infinityfree.com";
    $db_user = "if0_39754101";
    $db_pass = "AparWeb2025";
    $db_name = "if0_39754101_db_cekapar";
    $judul = "Data APAR — Bogor";
} elseif ($lokasi === 'Majalengka') {
    $db_host = "sql202.infinityfree.com";
    $db_user = "if0_39754101";
    $db_pass = "AparWeb2025";
    $db_name = "if0_39754101_db_cekapar_maja"; // sesuaikan kalau beda
    $judul = "Data APAR — Majalengka";
} else {
    die("Lokasi tamu tidak valid.");
}

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$koneksi) {
    die("Koneksi DB gagal: " . mysqli_connect_error());
}

// ambil logo jika tersedia untuk PDF export
$logoPath = __DIR__ . "/../assets/img/logoAH.png"; // adjust path kalau perlu
$logoBase64 = null;
if (file_exists($logoPath) && is_readable($logoPath)) {
    $data = @file_get_contents($logoPath);
    if ($data !== false) {
        $mime = @mime_content_type($logoPath);
        if ($mime === false) $mime = 'image/png';
        $logoBase64 = 'data:' . $mime . ';base64,' . base64_encode($data);
    }
}


// Query data — gunakan kolom yang kamu sebutkan
// Query data — join ke tabel referensi
$sql = "SELECT 
          data_apar.id,
          data_apar.code_apar,
          tbl_lokasi.lokasi AS lokasi,
          tbl_departemen.departemen AS departemen,
          jenis_apar.jenis_apar AS jenis_apar,
          data_apar.vendor,
          data_apar.kondisi,
          data_apar.tanggal_penggantian,
          data_apar.masa_pemakaian,
          data_apar.tanggal_refill,
          data_apar.tanggal_expired,
          data_apar.nozzle,
          data_apar.tabung,
          data_apar.presure,
          data_apar.catridge,
          data_apar.pin,
          data_apar.handle,
          data_apar.berat,
          data_apar.plat_nomer
        FROM data_apar
        JOIN tbl_lokasi ON data_apar.lokasi = tbl_lokasi.id
        JOIN tbl_departemen ON data_apar.departemen = tbl_departemen.id
        JOIN jenis_apar ON data_apar.jenis_apar = jenis_apar.id
        ORDER BY data_apar.id ASC";

$result = mysqli_query($koneksi, $sql);

?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($judul) ?></title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <!-- DataTables CSS + Buttons -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css"/>

 <style>
  :root {
    --brand: #0b5ed7;
    --brand-dark: #08306b;
    --accent: #f6c84c;
    --gray-light: #f8f9fa;
  }

  body {
    background: linear-gradient(180deg, #f7fbff 0%, #f2f7ff 100%);
    font-family: 'Segoe UI', sans-serif;
  }

  /* Layout */
  .app-shell {
    min-height: 100vh;
    display: flex;
    gap: 1rem;
  }

  /* Sidebar */
  .sidebar {
    width: 240px;
    background: linear-gradient(180deg, var(--brand-dark), var(--brand));
    color: #fff;
    padding: 18px 14px;
    border-radius: 0 1rem 1rem 0;
    box-shadow: 4px 0 12px rgba(0,0,0,0.15);
  }

  .sidebar .logo {
    display: flex;
    align-items: center;
    gap: .75rem;
    margin-bottom: 1.5rem;
  }

  .sidebar .logo img {
    height: 46px;
    border-radius: 8px;
    box-shadow: 0 6px 20px rgba(11,59,138,.35);
  }

  .sidebar .nav-link {
    color: rgba(255,255,255,.85);
    border-radius: .6rem;
    padding: .65rem 1rem;
    transition: all .25s ease;
  }

  .sidebar .nav-link:hover {
    background: rgba(255,255,255,.15);
    color: #fff;
    transform: translateX(4px);
  }

  .sidebar .nav-link.active {
    background: var(--accent);
    color: #000;
    font-weight: 600;
  }

  /* Content */
  .content {
    flex: 1;
    padding: 20px;
  }

  .panel-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
  }

  .panel-title {
    font-weight: 700;
    color: var(--brand-dark);
  }

  /* Card */
  .card {
    border: none;
    border-radius: 1rem;
  }

  .card-body {
    padding: 1.5rem;
  }

  /* Table */
  table.dataTable thead th {
    background: var(--gray-light);
    color: #222;
    font-weight: 600;
  }

  table.dataTable tbody tr:nth-child(even) {
    background-color: #fdfdfd;
  }

  table.dataTable tbody tr:hover {
    background-color: #f1f7ff;
    transition: 0.2s;
  }

  table.dataTable tbody td {
    vertical-align: middle;
    font-size: .9rem;
  }

  .badge-kondisi {
    font-weight: 600;
    padding: .35rem .6rem;
    border-radius: .5rem;
    color: #fff;
    font-size: .8rem;
  }

  /* Export button group */
  .dt-buttons .btn {
    border-radius: .6rem;
    font-size: .85rem;
    font-weight: 500;
    margin-right: .4rem;
    display: flex;
    align-items: center;
    gap: .4rem;
    transition: all .25s;
  }

  .dt-buttons .btn:hover {
    opacity: .9;
    transform: translateY(-1px);
  }

  /* Mobile tweaks */
  @media (max-width: 992px) {
    .sidebar { display:none; }
    .app-shell { padding:0; }
  }
</style>

</head>
<body>

<div class="app-shell">

  <!-- SIDEBAR -->
  <aside class="sidebar shadow-lg">
    <div class="logo">
      <img src="../assets/img/logoAH.png" alt="logo">
      <div>
        <div style="font-weight:700; font-size:1.05rem;">Pengecekan APAR</div>
        <div style="font-size:.85rem; opacity:.9">APAR & HYDRANT</div>
      </div>
    </div>

    <nav class="nav flex-column">
      <a class="nav-link active px-3 py-2 mb-1" href="#"><i class="fa-solid fa-fire-extinguisher me-2"></i> Data APAR</a>
      <a class="nav-link px-3 py-2 mt-3" href="../index.php"><i class="fa-solid fa-arrow-left me-2"></i> Kembali</a>
    </nav>

    <div class="mt-4" style="font-size:.9rem; opacity:.9">
      <div><strong>Lokasi:</strong> <?= htmlspecialchars($lokasi) ?></div>
      <div class="mt-2"><strong>Mode:</strong> Tamu (Read-only)</div>
    </div>
  </aside>

  <!-- CONTENT -->
  <main class="content">
    <div class="container-fluid">
    <!-- Tombol Hamburger di atas content -->
<div class="d-lg-none mb-3">
  <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
    <i class="fa-solid fa-bars"></i>
  </button>
</div>

<!-- OFFCANVAS SIDEBAR -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <nav class="nav flex-column">
      <a class="nav-link active mb-2" href="#"><i class="fa-solid fa-fire-extinguisher me-2"></i> Data APAR</a>
      <a class="nav-link mt-3" href="../index.php"><i class="fa-solid fa-arrow-left me-2"></i> Kembali</a>
    </nav>
  </div>
</div>

      <div class="panel-head">
        <div>
          <h3 class="panel-title mb-0"><?= htmlspecialchars($judul) ?></h3>
          <div class="text-muted small">Lihat data pengecekan APAR — tampilan tamu. Export: Excel / PDF / PNG / Print.</div>
        </div>

        <div class="d-flex align-items-center export-btns">
          <a href="login.php" class="btn btn-outline-danger btn-sm ms-2"><i class="fa-solid fa-sign-out-alt me-1"></i> Keluar</a>
        </div>
      </div>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="table-responsive" id="tableWrap">
            <table id="aparTable" class="table table-hover table-bordered display nowrap" style="width:100%">
              <thead class="table-light text-center align-middle">
                <tr>
                  <th>No</th>
                  <th>Code APAR</th>
                  <th>Lokasi</th>
                  <th>Departemen</th>
                  <th>Jenis</th>
                  <th>Vendor</th>
                  <th>Kondisi</th>
                  <th>Tgl Pengg</th>
                  <th>Masa Pemakaian</th>
                  <th>Tgl Refill</th>
                  <th>Tgl Expired</th>
                  <th>Nozzle</th>
                  <th>Tabung</th>
                  <th>Pressure</th>
                  <th>Catridge</th>
                  <th>Pin</th>
                  <th>Handle</th>
                  <th>Berat</th>
                  <th>Plat</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                if ($result && mysqli_num_rows($result) > 0):
                  while($r = mysqli_fetch_assoc($result)):
                    // condition badge
                    $kond = strtolower(trim($r['kondisi']));
                    if ($kond === 'baik') { $badge = 'badge-kondisi bg-success'; }
                    elseif (strpos($kond,'rusak') !== false) { $badge = 'badge-kondisi bg-danger'; }
                    elseif (strpos($kond,'isi') !== false || strpos($kond,'refill') !== false) { $badge = 'badge-kondisi bg-warning text-dark'; }
                    else { $badge = 'badge-kondisi bg-secondary'; }
                ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td><?= htmlspecialchars($r['code_apar']) ?></td>
                  <td><?= htmlspecialchars($r['lokasi']) ?></td>
                  <td><?= htmlspecialchars($r['departemen']) ?></td>
                  <td><?= htmlspecialchars($r['jenis_apar']) ?></td>
                  <td><?= htmlspecialchars($r['vendor']) ?></td>
                  <td class="text-center"><span class="<?= $badge ?>"><?= htmlspecialchars($r['kondisi']) ?></span></td>
                  <td class="text-center"><?= $r['tanggal_penggantian'] && $r['tanggal_penggantian'] != '0000-00-00' ? date('d-m-Y', strtotime($r['tanggal_penggantian'])) : '-' ?></td>
                  <td class="text-center"><?= htmlspecialchars($r['masa_pemakaian']) ?></td>
                  <td class="text-center"><?= $r['tanggal_refill'] && $r['tanggal_refill']!='0000-00-00' ? date('d-m-Y', strtotime($r['tanggal_refill'])) : '-' ?></td>
                  <td class="text-center"><?= $r['tanggal_expired'] && $r['tanggal_expired']!='0000-00-00' ? date('d-m-Y', strtotime($r['tanggal_expired'])) : '-' ?></td>
                  <td class="text-center"><?= htmlspecialchars($r['nozzle']) ?></td>
                  <td class="text-center"><?= htmlspecialchars($r['tabung']) ?></td>
                  <td class="text-center"><?= htmlspecialchars($r['presure']) ?></td>
                  <td class="text-center"><?= htmlspecialchars($r['catridge']) ?></td>
                  <td class="text-center"><?= htmlspecialchars($r['pin']) ?></td>
                  <td class="text-center"><?= htmlspecialchars($r['handle']) ?></td>
                  <td class="text-center"><?= htmlspecialchars($r['berat']) ?></td>
                  <td class="text-center"><?= htmlspecialchars($r['plat_nomer']) ?></td>
                </tr>
                <?php
                  endwhile;
                else:
                ?>
                <tr><td colspan="19" class="text-center text-danger py-4">⚠️ Data tidak ditemukan</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div> <!-- /table-responsive -->
        </div>
      </div>

    </div>
  </main>
</div>

<!-- SCRIPTS (order penting: jQuery -> DataTables -> Buttons -> JSZip/pdfmake -> vfs_fonts -> init) -->
<script src="../assets/js/core/jquery-3.7.1.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- dependencies for excel/pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- html2canvas untuk export PNG -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
  // pass logo base64 dari PHP
  var logoBase64 = <?php echo json_encode($logoBase64); ?>;

  $(document).ready(function() {
    var table = $('#aparTable').DataTable({
      dom: 'Bfrtip',
      responsive: true, 
      buttons: [
        {
          extend: 'excelHtml5',
          text: '<i class="fa-solid fa-file-excel"></i> Excel',
          className: 'btn btn-success',
          title: 'Data APAR',
          exportOptions: { columns: ':visible' },
          customize: function(xlsx) {
            try {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              $('row c[r^="A1"]', sheet).attr('s','42');
            } catch(e) {}
          }
        },
      {
  extend: 'pdfHtml5',
  text: '<i class="fa-solid fa-file-pdf"></i> PDF',
  className: 'btn btn-danger',
  title: 'Data APAR',
  orientation: 'landscape',
  pageSize: 'A4',
  exportOptions: {
    // pastikan semua kolom ikut
    columns: ':visible'
  },
  customize: function (doc) {
    if (logoBase64) {
      doc.content.unshift({
        image: logoBase64,
        width: 40,
        alignment: 'center',
        margin: [0, 0, 0, 10]
      });
    }

    doc.content.unshift({
      text: 'DATA APAR',
      fontSize: 14,
      bold: true,
      alignment: 'center',
      margin: [0, 0, 0, 10]
    });

    // <<< Tambahin ini supaya semua kolom ngepas
    doc.styles.tableHeader.fontSize = 7;
    doc.defaultStyle.fontSize = 6; // kecilin font biar muat semua kolom
    doc.pageMargins = [10, 10, 10, 10]; // margin tipis biar lega

    // Auto fit lebar kolom
    var objLayout = {};
    objLayout['hLineWidth'] = function(i) { return 0.5; };
    objLayout['vLineWidth'] = function(i) { return 0.5; };
    objLayout['hLineColor'] = function(i) { return '#aaa'; };
    objLayout['vLineColor'] = function(i) { return '#aaa'; };
    objLayout['paddingLeft'] = function(i) { return 2; };
    objLayout['paddingRight'] = function(i) { return 2; };
    doc.content[doc.content.length - 1].layout = objLayout;

    // biar semua kolom kebaca → atur lebar otomatis
    var table = doc.content[doc.content.length - 1].table;
    var columnCount = table.body[0].length;
    table.widths = Array(columnCount).fill('*');
  }
},


        {
          extend: 'print',
          text: '<i class="fa-solid fa-print"></i> Print',
          className: 'btn btn-info',
          title: 'Data APAR',
          exportOptions: { columns: ':visible' }
        },
        {
          text: '<i class="fa-solid fa-image"></i> PNG',
          className: 'btn btn-warning',
          action: function() {
            var container = document.querySelector('.table-responsive');
            html2canvas(container, { scale: 2 }).then(function(canvas) {
              var link = document.createElement('a');
              link.href = canvas.toDataURL('image/png');
              link.download = 'Data_APAR.png';
              link.click();
            });
          }
        }
      ],
      pageLength: 10,
      ordering: true,
      lengthChange: false,
      language: {
        search: "Cari Data:",
        zeroRecords: "Tidak ada data ditemukan",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        infoEmpty: "Tidak ada data",
        paginate: { next: "Selanjutnya", previous: "Sebelumnya" }
      }
    });
  });
</script>

</body>
</html>
