<?php
// getUninspectedApar.php
include 'koneksi.php'; // Termasuk file koneksi database Anda

function getUninspectedApar($koneksi) {
    $query = "SELECT start, COUNT(*) as uninspected_count FROM events WHERE keterangan = 'Belum Inspeksi' GROUP BY start";
    $result = $koneksi->query($query);
    $uninspectedApar = [];
    while ($row = $result->fetch_assoc()) {
        $uninspectedApar[] = $row;
    }
    return $uninspectedApar;
}

header('Content-Type: application/json');
echo json_encode(getUninspectedApar($koneksi));
?>
