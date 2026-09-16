<?php
include ('../../../koneksi.php');

// ========================
// AMBIL DATA POST
// ========================
$id = $_POST['id'];
$codeApar = $_POST['code_apar'];
$lokasi = $_POST['lokasi'];
$departemen = $_POST['departemen'];
$tanggal_refill = $_POST['tanggal_refill'];
$tanggal_expired = $_POST['tanggal_expired'];
$vendor = $_POST['vendor'];
$kondisi = $_POST['kondisi'];
$masa_pemakaian = $_POST['masa_pemakaian'];
$tanggal_penggantian = $_POST['tanggal_penggantian'];

$jenisApar = $_POST['jenis_apar'];
$jenisTabung = $_POST['jenis_tabung']; // ⬅️ PENTING
$nozzle = $_POST['nozzle'];
$tabung = $_POST['tabung'];
$presure = $_POST['presure'] ?? null;
$catridge = $_POST['catridge'] ?? null;
$pin = $_POST['pin'];
$handle = $_POST['handle'];
$berat = $_POST['berat'];
$plat = $_POST['plat'];

// ========================
// LOGIKA JENIS TABUNG
// ========================
if ($jenisTabung === 'pressure') {
    $catridge = null;
}

if ($jenisTabung === 'catridge') {
    $presure = null;
}

// ========================
// QUERY UPDATE UTAMA
// ========================
$query = "
UPDATE data_apar SET
    code_apar='$codeApar',
    lokasi='$lokasi',
    departemen='$departemen',
    vendor='$vendor',
    kondisi='$kondisi',
    masa_pemakaian='$masa_pemakaian',
    tanggal_penggantian='$tanggal_penggantian',
    tanggal_refill='$tanggal_refill',
    tanggal_expired='$tanggal_expired',
    jenis_apar='$jenisApar',
    jenis_tabung='$jenisTabung',
    nozzle='$nozzle',
    tabung='$tabung',
    presure=".($presure ? "'$presure'" : "NULL").",
    catridge=".($catridge ? "'$catridge'" : "NULL").",
    pin='$pin',
    handle='$handle',
    berat='$berat'
WHERE id='$id'
";

if (!mysqli_query($koneksi, $query)) {
    die("Error update: " . mysqli_error($koneksi));
}

// ========================
// UPDATE PLAT (JIKA ADA)
// ========================
if (!empty($plat)) {
    mysqli_query($koneksi, "UPDATE data_apar SET plat_nomer='$plat' WHERE id='$id'");
    $redirect = "../../apar_mobil.php";
} else {
    $redirect = "../../apar.php?code=" . urlencode($codeApar) . "&updated=1";
}

// ========================
// SIMPAN AKTIVITAS
// ========================
$tanggal = $_POST['tanggal'];
$activity = $_POST['activity'];

mysqli_query(
    $koneksi,
    "INSERT INTO aktivitas (code_apar, tanggal, keterangan)
     VALUES ('$codeApar', '$tanggal', '$activity')"
);

// ========================
// REDIRECT
// ========================
header("Location: $redirect");
exit;
?>
