<?php
// File: admin/proses/hydrant/hapus_laporan_hydrant.php
// Fungsi: Hapus 1 baris data dari tabel laporan_hydrant berdasarkan id
// FIX MASALAH 2: File baru untuk handle tombol hapus

include('../../../koneksi.php');

// Ambil id dari GET, pastikan angka saja (keamanan)
$id    = isset($_GET['id'])    ? intval($_GET['id'])           : 0;
$bulan = isset($_GET['bulan']) ? $_GET['bulan']                : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun']                : '';

if ($id > 0) {
    $query = "DELETE FROM laporan_hydrant WHERE id = $id";
    mysqli_query($koneksi, $query);
}

// Kembali ke halaman laporan hydrant dengan bulan & tahun yang sama
header("Location: ../../data_inspeksihydrant.php?bulan=" . urlencode($bulan) . "&tahun=" . urlencode($tahun));
exit;
?>