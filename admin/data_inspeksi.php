<?php
// Koneksi database
include '../koneksi.php';

// Ambil parameter bulan dan tahun dari URL
if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];

    // Array bulan dalam Bahasa Indonesia
    $bulan_indonesia = [
        "Januari" => "01", "Februari" => "02", "Maret" => "03", "April" => "04",
        "Mei" => "05", "Juni" => "06", "Juli" => "07", "Agustus" => "08",
        "September" => "09", "Oktober" => "10", "November" => "11", "Desember" => "12"
    ];

    // Pastikan nama bulan ada di dalam array
    if (array_key_exists($bulan, $bulan_indonesia)) {
        $bulan_angka = $bulan_indonesia[$bulan]; // Ambil angka bulan dari array
    } else {
        echo "Bulan tidak valid.";
        exit;
    }

    // Debugging: Output bulan dan tahun

    // Query untuk mengambil data berdasarkan bulan dan tahun dari tanggal_inspeksi
    $query = "
    SELECT laporan.*, tl.lokasi, td.departemen, tj.jenis_apar
    FROM laporan 
    LEFT JOIN jenis_apar tj ON laporan.jenis_apar = tj.id
    LEFT JOIN tbl_lokasi tl ON laporan.lokasi = tl.id
    LEFT JOIN tbl_departemen td ON laporan.departemen = td.id
    WHERE MONTH(laporan.tanggal_inspeksi) = '$bulan_angka' 
    AND YEAR(laporan.tanggal_inspeksi) = '$tahun'
    ";
    


    $result = mysqli_query($koneksi, $query);

    // Periksa jika hasil query tidak kosong
    if (mysqli_num_rows($result) > 0) {
        $laporan = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "";
    }
} else {
    echo "";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inspeksi - <?php echo $bulan . " " . $tahun; ?></title>
    <link rel="icon" href="../assets/img/logokecilAH.png" type="image/x-icon" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
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
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Laporan Inspeksi Bulan <?php echo $bulan . " " . $tahun; ?></h2>

    <!-- Tombol Kembali -->
 
    
    

    <!-- Card dengan shadow -->
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Tabel Responsif -->
            <div class="table-responsive">
                <table id="laporanTable" class="table table-bordered table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Inspeksi</th>
                            <th>Code Apar</th>
                            <th>Lokasi</th>
                            <th>Departemen</th>
                            <th>Jenis Apar</th>
                            <th>Vendor Refill</th>
                            <th>Kondisi Fisik</th>
                            <th>Status Tabung</th>
                            <th>Masa Pemakaian</th>
                            <th>Tanggal Refill</th>
                            <th>Tanggal Expired</th>
                            <th>Nozzle</th>
                            <th>Tabung</th>
                            <th>Pressure</th>
                            <th>Catridge</th>
                            <th>Pin</th>
                            <th>Handle</th>
                            <th>Berat</th>
                            <th>Plat Nomer</th>
                             <th>Aksi</th> <!-- Tambah kolom Aksi -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporan)): ?>
                            <?php foreach ($laporan as $index => $data): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($data['nama']); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($data['tanggal_inspeksi'])); ?></td>
                                    <td><?php echo htmlspecialchars($data['code_apar']); ?></td>
                                    <td><?php echo htmlspecialchars($data['lokasi']); ?></td>
                                    <td><?php echo htmlspecialchars($data['departemen']); ?></td>
                                    <td><?php echo htmlspecialchars($data['jenis_apar']); ?></td>
                                    <td><?php echo htmlspecialchars($data['vendor']); ?></td>
                                    <td><?php echo htmlspecialchars($data['kondisi']); ?></td>
                                    <td><?php echo htmlspecialchars($data['tanggal_penggantian'] == '' ? 'Tabung Lama' : date('d-m-Y', strtotime($data['tanggal_penggantian']))); ?></td>
                                    <td><?php echo htmlspecialchars($data['masa_pemakaian']); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($data['tanggal_refill'])); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($data['tanggal_expired'])); ?></td>
                                    <td><?php echo htmlspecialchars($data['nozzle']); ?></td>
                                    <td><?php echo htmlspecialchars($data['tabung']); ?></td>
                                    <td><?php echo htmlspecialchars($data['presure']); ?></td>
                                    <td><?php echo htmlspecialchars($data['catridge']); ?></td>
                                    <td><?php echo htmlspecialchars($data['pin']); ?></td>
                                    <td><?php echo htmlspecialchars($data['handle']); ?></td>
                                    <td><?php echo htmlspecialchars($data['berat']); ?></td>
                                    <td><?php echo htmlspecialchars($data['plat_nomer']); ?></td>
                                    <td>
                <button class="btn btn-danger btn-sm hapus-btn" data-id="<?php echo $data['id']; ?>">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="20" class="text-center">Tidak ada data inspeksi untuk bulan ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <!-- Inisialisasi DataTables -->
    <script>
    $('#laporanTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fas fa-arrow-left"></i> Kembali',
                className: 'btn btn-warning',
                action: function (e, dt, node, config) {
                    window.history.back();
                }
            },
            {
                text: '<i class="fas fa-file-excel"></i> Export Excel',
                className: 'btn btn-success',
                action: function (e, dt, node, config) {
                    window.location.href = 'proses/export/exportLaporan.php?bulan=<?= $_GET['bulan'] ?>&tahun=<?= $_GET['tahun'] ?>';
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> Export PDF',
                className: 'btn btn-danger',
                orientation: 'landscape',
                pageSize: 'A4',
                customize: function (doc) {
                    // Set margin
                    doc.pageMargins = [10, 10, 10, 10];

                    // Set default font size
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 10;

                    // Validasi dan atur kolom
                    if (doc.content[1] && doc.content[1].table && doc.content[1].table.body[0]) {
                        const colCount = doc.content[1].table.body[0].length;
                        doc.content[1].table.widths = ['2%', '4%', '6%', '4%','5%', '9%', '5%', '7%','6%', '5%', '7%', '6%','6%', '3%', '3%', '3%','3%','3%', '3%', '3%', '5%'].slice(0, colCount); // Contoh untuk 4 kolom
                    } else {
                        console.error("Tabel tidak valid atau kosong.");
                    }

                    // Tambahkan padding
                    doc.content[1].layout = {
                        paddingTop: function () { return 2; },
                        paddingBottom: function () { return 2; },
                        paddingLeft: function () { return 3; },
                        paddingRight: function () { return 3; }
                    };
                }
            }
          
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
        }
    });
</script>

<script>
$(document).on('click', '.hapus-btn', function() {
    var id = $(this).data('id');
    swal({
        title: "Apakah Anda yakin?",
        text: "Data ini akan dihapus permanen!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            window.location.href = 'proses/hapusLaporan.php?id=' + id;
        }
    });
});

</script>


</body>
</html>
