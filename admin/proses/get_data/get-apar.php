<?php
header('Content-Type: application/json');
include '../../../koneksi.php';

// Query to fetch APAR codes
$sql = "SELECT code_apar FROM data_apar";
$result = $koneksi->query($sql);

$aparCodes = array();
while ($row = $result->fetch_assoc()) {
    $aparCodes[] = $row['code_apar'];
}

// Use natural sorting to sort the APAR codes
natcasesort($aparCodes);

// Reindex the array to ensure it's a numerical array after sorting
$aparCodes = array_values($aparCodes);

echo json_encode($aparCodes);
?>
