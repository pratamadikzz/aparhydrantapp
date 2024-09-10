<?php
require '../vendor/autoload.php'; // Make sure to load the PhpSpreadsheet autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Data Apar');

// Set cell values
$sheet->setCellValue('B2', 'No');
$sheet->setCellValue('C2', 'Code Apar');
$sheet->setCellValue('D2', 'Lokasi');
$sheet->setCellValue('E2', 'Departemen');
$sheet->setCellValue('F2', 'Jenis Apar');
$sheet->setCellValue('G2', 'Vendor Refill');
$sheet->setCellValue('H2', 'Kondisi Fisik');
$sheet->setCellValue('I2', 'Status Tabung');
$sheet->setCellValue('J2', 'Masa Pemakaian');
$sheet->setCellValue('K2', 'Tanggal Refill');
$sheet->setCellValue('L2', 'Tanggal Expired');
$sheet->setCellValue('M2', 'Nozzle');
$sheet->setCellValue('N2', 'Tabung');
$sheet->setCellValue('O2', 'Pressure');
$sheet->setCellValue('P2', 'Catridge');
$sheet->setCellValue('Q2', 'Pin');
$sheet->setCellValue('R2', 'Handle');
$sheet->setCellValue('S2', 'Berat');

// Apply yellow background color to headers
$headerStyleArray = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'color' => ['argb' => Color::COLOR_YELLOW],
    ],
    'font' => [
        'bold' => true,
        'color' => ['argb' => Color::COLOR_BLACK],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
];

$sheet->getStyle('B2:S2')->applyFromArray($headerStyleArray);
$sheet->getRowDimension(2)->setRowHeight(50);

foreach (range('B', 'S') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Fetch data from database
include '../koneksi.php';
$query = "SELECT 
    da.code_apar, 
    tl.lokasi AS lokasi, 
    td.departemen AS departemen, 
    ja.jenis_apar AS jenis_apar,
    da.vendor,
    da.kondisi,
    da.tanggal_penggantian,
    da.masa_pemakaian,
    da.tanggal_refill,
    da.tanggal_expired,
    da.nozzle,
    da.tabung,
    da.presure,
    da.catridge,
    da.pin,
    da.handle,
    da.berat
FROM 
    data_apar da
JOIN 
    tbl_lokasi tl ON da.lokasi = tl.id
JOIN 
    tbl_departemen td ON da.departemen = td.id
JOIN 
    jenis_apar ja ON da.jenis_apar = ja.id 
ORDER BY 
    da.code_apar ASC";

$result = mysqli_query($koneksi, $query);
if (!$result) {
    die("Query error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
}

$rowNumber = 3; // Start from the third row
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('B' . $rowNumber, $no);
    $sheet->setCellValue('C' . $rowNumber, $row['code_apar']);
    $sheet->setCellValue('D' . $rowNumber, $row['lokasi']);
    $sheet->setCellValue('E' . $rowNumber, $row['departemen']);
    $sheet->setCellValue('F' . $rowNumber, $row['jenis_apar']);
    $sheet->setCellValue('G' . $rowNumber, $row['vendor']);
    $sheet->setCellValue('H' . $rowNumber, $row['kondisi']);
    $sheet->setCellValue('I' . $rowNumber, $row['tanggal_penggantian'] == '' ? 'Lama' : date('d-m-Y', strtotime($row['tanggal_penggantian'])));
    $sheet->setCellValue('J' . $rowNumber, $row['masa_pemakaian']);
    $sheet->setCellValue('K' . $rowNumber, $row['tanggal_refill'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($row['tanggal_refill'])));
    $sheet->setCellValue('L' . $rowNumber, $row['tanggal_expired'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($row['tanggal_expired'])));
    $sheet->setCellValue('M' . $rowNumber, $row['nozzle']);
    $sheet->setCellValue('N' . $rowNumber, $row['tabung']);
    $sheet->setCellValue('O' . $rowNumber, $row['presure']);
    $sheet->setCellValue('P' . $rowNumber, $row['catridge']);
    $sheet->setCellValue('Q' . $rowNumber, $row['pin']);
    $sheet->setCellValue('R' . $rowNumber, $row['handle']);
    $sheet->setCellValue('S' . $rowNumber, $row['berat']);

    // Check for expired date
    $expired_date = new DateTime($row['tanggal_expired']);
    $current_date = new DateTime();
    if ($expired_date < $current_date) {
        applyExpiredRowStyle($sheet, $rowNumber);
    }

    // Check for condition "Tidak Layak"
    if ($row['kondisi'] == 'Tidak Layak') {
        applyTidakLayakRowStyle($sheet, $rowNumber);
    }

    $rowNumber++;
    $no++;
}

// Apply style for expired rows
function applyExpiredRowStyle($sheet, $rowNumber) {
    $expiredStyleArray = [
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['argb' => 'FFFF4C4C'], // Red color for expired
        ],
    ];
    $sheet->getStyle("B{$rowNumber}:S{$rowNumber}")->applyFromArray($expiredStyleArray);
}

// Apply style for "Tidak Layak" rows
function applyTidakLayakRowStyle($sheet, $rowNumber) {
    $tidakLayakStyleArray = [
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['argb' => 'FFFFA500'], // Orange color for "Tidak Layak"
        ],
    ];
    $sheet->getStyle("B{$rowNumber}:S{$rowNumber}")->applyFromArray($tidakLayakStyleArray);
}

// Save the file
$writer = new Xlsx($spreadsheet);
$waktu = 'Rekap Data-Apar ' . date('d-m-Y') . '.xlsx';
$writer->save($waktu);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $waktu . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
$writer->save('apar_data.xlsx');
?>
