<?php
include '../koneksi.php';

if ($koneksi->connect_error) {
  die("Connection failed: " . $koneksi->connect_error);
}

$sql = "
  SELECT da.code_apar, da.tanggal_expired, tl.lokasi AS lokasi, td.departemen AS departemen, da.kondisi
  FROM data_apar da
  JOIN tbl_lokasi tl ON da.lokasi = tl.id
  JOIN tbl_departemen td ON da.departemen = td.id
  WHERE da.tanggal_expired IS NOT NULL";

$result = $koneksi->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $color = '';
      $textColor = '';
      
      $today = date("Y-m-d");
      $thirty_days_from_now = date("Y-m-d", strtotime("+30 days"));
  
      if ($row['tanggal_expired'] < $today) {
        $color = 'red';
      } elseif ($row['tanggal_expired'] <= $thirty_days_from_now && $row['tanggal_expired'] >= $today) {
        $color = '#F6E96B';
        $textColor = 'black';
      }
  
      $events[] = array(
        'title' => $row['code_apar'],
        'start' => $row['tanggal_expired'],
        'color' => $color,
        'textColor' => $textColor,
        'extendedProps' => array(
          'lokasi' => $row['lokasi'],
          'departemen' => $row['departemen'],
          'tanggal_expired' => $row['tanggal_expired'],
          'kondisi' => $row['kondisi']
        )
      );
    }
  }
  
  $koneksi->close();
  
  echo json_encode($events);
  ?>
