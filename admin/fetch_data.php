<?php
include ('../koneksi.php');

$lokasi_sql = "SELECT DISTINCT lokasi FROM tbl_lokasi";
$departemen_sql = "SELECT DISTINCT departemen FROM departemen";

$lokasi_result = $koneksi->query($lokasi_sql);
$departemen_result = $koneksi->query($departemen_sql);

$lokasi_data = [];
$departemen_data = [];

if ($lokasi_result->num_rows > 0) {
    while($row = $lokasi_result->fetch_assoc()) {
        $lokasi_data[] = $row['lokasi'];
    }
}

if ($departemen_result->num_rows > 0) {
    while($row = $departemen_result->fetch_assoc()) {
        $departemen_data[] = $row['departemen'];
    }
}

$koneksi->close();

echo json_encode(['lokasi' => $lokasi_data, 'departemen' => $departemen_data]);
?>
