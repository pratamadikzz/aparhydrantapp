<?php
// getWarningAparCount.php
include 'koneksi.php'; // Termasuk file koneksi database Anda

function getWarningAparCount($koneksi) {
    $currentDate = date('Y-m-d');
    $warningDate = date('Y-m-d', strtotime('+30 days', strtotime($currentDate)));
    $query = "SELECT COUNT(*) as warning_count FROM data_apar WHERE tanggal_expired BETWEEN ? AND ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $currentDate, $warningDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['warning_count'];
}

header('Content-Type: application/json');
echo json_encode(['warning_count' => getWarningAparCount($koneksi)]);
?>
