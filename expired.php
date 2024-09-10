<?php
// getExpiredAparCount.php
include 'koneksi.php'; // Include your database koneksiection file

function getExpiredAparCount($koneksi) {
    $currentDate = date('Y-m-d');
    $query = "SELECT COUNT(*) as expired_count FROM data_apar WHERE tanggal_expired < ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $currentDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['expired_count'];
}

header('Content-Type: application/json');
echo json_encode(['expired_count' => getExpiredAparCount($koneksi)]);
?>
    