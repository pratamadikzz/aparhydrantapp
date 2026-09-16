<?php
// get_hydrant_data.php

include('../../../koneksi.php');

header('Content-Type: application/json');

if (isset($_GET['code_hydrant'])) {
    $code_hydrant = mysqli_real_escape_string($koneksi, trim($_GET['code_hydrant']));

    $query = "
    SELECT 
        dh.*, 
        l.id AS lokasi_id
    FROM 
        data_hydrant dh
    LEFT JOIN 
        tbl_lokasi l ON dh.lokasi = l.id
    WHERE 
        dh.code_hydrant = '$code_hydrant'
    ";

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
        exit;
    }

    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $scanCheck = "SELECT nama FROM laporan_hydrant WHERE code_hydrant = '$code_hydrant' AND MONTH(tanggal_inspeksi) = MONTH(CURDATE()) AND YEAR(tanggal_inspeksi) = YEAR(CURDATE()) LIMIT 1";
        $scanResult = mysqli_query($koneksi, $scanCheck);
        if ($scanResult && mysqli_num_rows($scanResult) > 0) {
            $scanRow = mysqli_fetch_assoc($scanResult);
            $data['already_scanned_by'] = $scanRow['nama'];
        }
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Data not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
