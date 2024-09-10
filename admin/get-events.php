<?php
header('Content-Type: application/json');
include '../koneksi.php';

// Query to fetch all events
$sql = "SELECT * FROM events";
$result = $koneksi->query($sql);

$events = array();

while ($row = $result->fetch_assoc()) {
    $color = $row['keterangan'] == 'Belum Inspeksi' ? 'red' : 'green';
    $events[] = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'start' => $row['start'],
        'color' => $color
    );
}

echo json_encode($events);
?>
