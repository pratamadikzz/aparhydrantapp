<?php

// get_apar_data.php

include('../koneksi.php');

if (isset($_GET['code_apar'])) {
    $code_apar = $_GET['code_apar'];

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
        die("Query error: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($result);

    echo json_encode($data);
}
?>
