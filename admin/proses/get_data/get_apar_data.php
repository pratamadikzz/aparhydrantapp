<?php

// get_apar_data.php

include('../../../koneksi.php');
header('Content-Type: application/json');

if (isset($_GET['code_apar'])) {
    $code_apar = mysqli_real_escape_string($koneksi, trim($_GET['code_apar']));

    $query = "
    SELECT 
        da.*, 
        l.id AS lokasi_id,
        d.id AS departemen_id,
        ja.id AS jenis_apar_id
    FROM 
        data_apar da
    LEFT JOIN 
        tbl_lokasi l ON da.lokasi = l.id
    LEFT JOIN 
        tbl_departemen d ON da.departemen = d.id
    LEFT JOIN 
        jenis_apar ja ON da.jenis_apar = ja.id
    WHERE 
        da.code_apar = '$code_apar'
";

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
        exit;
    }

    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $scanCheck = "SELECT nama FROM laporan WHERE code_apar = '$code_apar' AND MONTH(tanggal_inspeksi) = MONTH(CURDATE()) AND YEAR(tanggal_inspeksi) = YEAR(CURDATE()) LIMIT 1";
        $scanResult = mysqli_query($koneksi, $scanCheck);
        if ($scanResult && mysqli_num_rows($scanResult) > 0) {
            $scanRow = mysqli_fetch_assoc($scanResult);
            $data['already_scanned_by'] = $scanRow['nama'];
        }
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }
}
