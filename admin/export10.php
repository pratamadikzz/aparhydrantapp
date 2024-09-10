<?php
require '../vendor/autoload.php';
include('../koneksi.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Buat objek spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set judul kolom
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Code Apar');
$sheet->setCellValue('C2', 'Lokasi');
$sheet->setCellValue('D2', 'Departemen');
$sheet->setCellValue('E2', 'Tanggal Inspeksi');
$sheet->setCellValue('F2', 'Keterangan');

// Terapkan styling pada header
$headerStyleArray = [
    'font' => ['bold' => true],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => 'FFFF00'] // Warna kuning
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
];

$sheet->getStyle('A1:F1')->applyFromArray($headerStyleArray);

// Atur tinggi baris untuk baris 1
$sheet->getRowDimension('1')->setRowHeight(30);
$sheet->getRowDimension('2')->setRowHeight(30);

// Atur lebar kolom secara otomatis dengan sedikit tambahan
foreach (range('A', 'F') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Ambil data dari database
$queryevents = "SELECT * FROM events ORDER BY id ASC";
$resultevents = mysqli_query($koneksi, $queryevents);
if (!$resultevents) {
    die("query error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
}

$rowNumber = 2; // Baris pertama untuk judul kolom
$no = 1;
while ($evs = mysqli_fetch_assoc($resultevents)) {
    // Ambil data dari tabel data_apar berdasarkan title dari events
    $title = $evs['title'];
    $query_apar = "SELECT * FROM data_apar WHERE code_apar = '$title'";
    $result_apar = mysqli_query($koneksi, $query_apar);
    if (!$result_apar) {
        die("query error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
    }
    $row = mysqli_fetch_assoc($result_apar);

    // Set nilai untuk setiap kolom
    $sheet->setCellValue('A' . $rowNumber, $no);
    $sheet->setCellValue('B' . $rowNumber, $evs['title']);
    $sheet->setCellValue('C' . $rowNumber, $row['lokasi']);
    $sheet->setCellValue('D' . $rowNumber, $row['departemen']);
    $sheet->setCellValue('E' . $rowNumber, $evs['start']);
    $sheet->setCellValue('F' . $rowNumber, $evs['keterangan']);

    $rowNumber++;
    $no++;
}

// Atur ulang lebar kolom setelah data ditambahkan
foreach (range('A', 'F') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
    $currentWidth = $sheet->getColumnDimension($columnID)->getWidth();
    $sheet->getColumnDimension($columnID)->setWidth($currentWidth + 2); // Tambahan lebar
}

// Buat writer dan simpan ke output buffer
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data_inspeksi.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
