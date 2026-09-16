<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include '../../../koneksi.php';

if (!isset($_GET['code'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Parameter code tidak ada'
    ]);
    exit;
}

$code = mysqli_real_escape_string($koneksi, $_GET['code']);

$query = "SELECT 
            id,
            code,
            lokasi,
            valve,
            hose,
            nozzle,
            clamp_nozzle,
            drum_hose,
            keterangan
          FROM hosereel
          WHERE code='$code'
          LIMIT 1";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    echo json_encode([
        'success' => false,
        'error' => mysqli_error($koneksi)
    ]);
    exit;
}

$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo json_encode([
        'success' => false,
        'message' => 'Data Hose Reel tidak ditemukan'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'data' => $data
]);
