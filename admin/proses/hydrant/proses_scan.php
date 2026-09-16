<?php
// File: admin/proses/hydrant/proses_scan.php
// FIX MASALAH 3: Cek duplikat sudah ada, dipertahankan + diperkuat

// FIX (Tanggal Inspeksi salah): scan.php mengatur timezone ke Asia/Jakarta
// saat merender halaman, tapi itu TIDAK berlaku di sini karena file ini
// jalan sebagai request terpisah (POST submit). Tanpa baris ini, date()
// di bawah memakai timezone default server (sering kali UTC), sehingga
// scan dini hari WIB (00:00-06:59) bisa tersimpan dengan tanggal kemarin.
date_default_timezone_set('Asia/Jakarta');

include('../../../koneksi.php');
session_start();

$day = date('Y-m-d');

// Retrieve POST data
$id               = $_POST['idhydrant'];
$code_hydrant     = mysqli_real_escape_string($koneksi, $_POST['code_hydrant']);
$NomerUrut        = mysqli_real_escape_string($koneksi, $_POST['NomerUrut']);
$lokasiHydrant    = mysqli_real_escape_string($koneksi, $_POST['lokasiHydrant']);
$hose             = mysqli_real_escape_string($koneksi, $_POST['hose']);
$nozzleHydrant    = mysqli_real_escape_string($koneksi, $_POST['nozzleHydrant']);
$jenis_lokasi     = mysqli_real_escape_string($koneksi, $_POST['jenis_lokasi']);
$valve            = mysqli_real_escape_string($koneksi, $_POST['valve']);
// Kunci sekarang cuma diisi untuk hydrant Outdoor (field-nya disembunyikan
// di form scan untuk Indoor), jadi ambil dengan default kosong supaya
// scan Indoor (yang tidak mengirim field ini) tidak menyebabkan error.
$kunci            = mysqli_real_escape_string($koneksi, $_POST['kunci'] ?? '');
$seal_karet_hose  = mysqli_real_escape_string($koneksi, $_POST['seal_karet_hose']);
$seal_karet_nozzle= mysqli_real_escape_string($koneksi, $_POST['seal_karet_nozzle']);
$box_hydrant      = mysqli_real_escape_string($koneksi, $_POST['box_hydrant']);
$keterangan       = mysqli_real_escape_string($koneksi, $_POST['keteranganHydrant']);
$tanggal          = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
$activity         = mysqli_real_escape_string($koneksi, $_POST['activity']);

// FIX (Nama kembali jadi Admin_CII): scan.php SUDAH mengirim nama operator
// yang benar lewat $_POST['nama'] (diisi dari popup "Masukkan Nama
// Operator", disimpan di $_SESSION['scan_name']). Nama itu HARUS
// dipercaya langsung, bukan ditimpa lagi dengan query ke tabel user
// (yang isinya nama akun login, mis. "Admin_CII"). Username login
// cuma dipakai kalau operator memang belum sempat isi nama sama sekali.
$nama = trim($_POST['nama'] ?? '');

if ($nama === '' && isset($_SESSION['username'])) {
    $username_session = mysqli_real_escape_string($koneksi, $_SESSION['username']);
    $queryNama = "SELECT nama FROM user WHERE username='$username_session' LIMIT 1";
    $resultNama = mysqli_query($koneksi, $queryNama);
    if ($resultNama && mysqli_num_rows($resultNama) > 0) {
        $rowNama = mysqli_fetch_assoc($resultNama);
        $nama = trim($rowNama['nama']);
    }
}

if ($nama === '' && isset($_SESSION['username'])) {
    $nama = $_SESSION['username'];
}

$nama = mysqli_real_escape_string($koneksi, $nama);

// Update query untuk tabel data_hydrant
$query1 = "UPDATE data_hydrant SET 
            code_hydrant='$code_hydrant',
            nomer_urut='$NomerUrut',  
            lokasi='$lokasiHydrant', 
            jenis_lokasi='$jenis_lokasi', 
            hose='$hose',
            nozzle='$nozzleHydrant',
            valve='$valve',
            kunci='$kunci',
            seal_karet_hose='$seal_karet_hose', 
            seal_karet_nozzle='$seal_karet_nozzle',
            box_hydrant='$box_hydrant',
            keterangan='$keterangan' 
            WHERE id='$id'";

// Insert query untuk tabel aktivitas
$query2 = "INSERT INTO aktivitas (tanggal,keterangan,code_apar) VALUES ('$tanggal', '$activity','$code_hydrant')";

// FIX MASALAH 3: Cek duplikat - hydrant yang sama di bulan & tahun yang sama
$selectReport = "SELECT id, nama FROM laporan_hydrant 
                 WHERE code_hydrant='$code_hydrant' 
                 AND MONTH(tanggal_inspeksi)=MONTH('$day') 
                 AND YEAR(tanggal_inspeksi)=YEAR('$day') 
                 LIMIT 1";
$resultReport = mysqli_query($koneksi, $selectReport);
if ($resultReport && mysqli_num_rows($resultReport) > 0) {
    $existingReport = mysqli_fetch_assoc($resultReport);
    $existingName   = $existingReport['nama'];
    $errorMessage   = "Kode Hydrant ini sudah di-scan bulan ini oleh $existingName";
    header("Location:../../scan.php?scan_error=" . urlencode($errorMessage));
    exit;
}

// Insert data baru ke laporan_hydrant
$query3 = "INSERT INTO laporan_hydrant 
           (nama, code_hydrant, nomer_urut, tanggal_inspeksi, lokasi, jenis_lokasi, 
            hose, nozzle, valve, kunci, seal_karet_hose, seal_karet_nozzle, box_hydrant, keterangan) 
           VALUES 
           ('$nama','$code_hydrant','$NomerUrut','$day','$lokasiHydrant','$jenis_lokasi',
            '$hose','$nozzleHydrant','$valve','$kunci','$seal_karet_hose','$seal_karet_nozzle',
            '$box_hydrant','$keterangan')";

// Eksekusi semua query
if (mysqli_query($koneksi, $query1)) {
    if (mysqli_query($koneksi, $query2)) {
        if (mysqli_query($koneksi, $query3)) {
            header("location:../../scan.php");
        } else {
            echo "Error query3: " . $query3 . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Error query2: " . $query2 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error query1: " . $query1 . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>