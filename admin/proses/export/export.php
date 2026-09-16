<?php
require __DIR__ . '/../../../vendor/autoload.php'; // Load the PhpSpreadsheet autoloader reliably

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
include '../../../koneksi.php';
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


$aparMobilSheet = $spreadsheet->createSheet();
$aparMobilSheet->setTitle('Apar Mobil');

// Set header values for Apar Mobil sheet (same columns as the previous one, without lokasi and departemen)
$aparMobilSheet->setCellValue('B2', 'No');
$aparMobilSheet->setCellValue('C2', 'Code Apar');
$aparMobilSheet->setCellValue('D2', 'Plat Nomer');
$aparMobilSheet->setCellValue('E2', 'Jenis Apar');
$aparMobilSheet->setCellValue('F2', 'Vendor Refill');
$aparMobilSheet->setCellValue('G2', 'Kondisi Fisik');
$aparMobilSheet->setCellValue('H2', 'Status Tabung');
$aparMobilSheet->setCellValue('I2', 'Masa Pemakaian');
$aparMobilSheet->setCellValue('J2', 'Tanggal Refill');
$aparMobilSheet->setCellValue('K2', 'Tanggal Expired');
$aparMobilSheet->setCellValue('L2', 'Nozzle');
$aparMobilSheet->setCellValue('M2', 'Tabung');
$aparMobilSheet->setCellValue('N2', 'Pressure');
$aparMobilSheet->setCellValue('O2', 'Catridge');
$aparMobilSheet->setCellValue('P2', 'Pin');
$aparMobilSheet->setCellValue('Q2', 'Handle');
$aparMobilSheet->setCellValue('R2', 'Berat');

// Apply yellow background color to headers
$aparMobilSheet->getStyle('B2:R2')->applyFromArray($headerStyleArray);
$aparMobilSheet->getRowDimension(2)->setRowHeight(50);

foreach (range('B', 'Q') as $columnID) {
    $aparMobilSheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Fetch data from database for Apar Mobil (exclude lokasi and departemen)
$queryAparMobil = "SELECT 
    da.code_apar, 
    ja.jenis_apar AS jenis_apar,
    da.vendor,
    da.plat_nomer,
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
    jenis_apar ja ON da.jenis_apar = ja.id 
WHERE 
    da.plat_nomer != '' AND da.plat_nomer IS NOT NULL
ORDER BY 
    da.code_apar ASC";

$resultAparMobil = mysqli_query($koneksi, $queryAparMobil);
if (!$resultAparMobil) {
    die("Query error: " . mysqli_error($koneksi));
}

$rowNumberAparMobil = 3; // Start from the third row for Apar Mobil
$noAparMobil = 1;

while ($rowAparMobil = mysqli_fetch_assoc($resultAparMobil)) {
    $aparMobilSheet->setCellValue('B' . $rowNumberAparMobil, $noAparMobil);
    $aparMobilSheet->setCellValue('C' . $rowNumberAparMobil, $rowAparMobil['code_apar']);
    $aparMobilSheet->setCellValue('D' . $rowNumberAparMobil, $rowAparMobil['plat_nomer']);
    $aparMobilSheet->setCellValue('E' . $rowNumberAparMobil, $rowAparMobil['jenis_apar']);
    $aparMobilSheet->setCellValue('F' . $rowNumberAparMobil, $rowAparMobil['vendor']);
    $aparMobilSheet->setCellValue('G' . $rowNumberAparMobil, $rowAparMobil['kondisi']);
    $aparMobilSheet->setCellValue('H' . $rowNumberAparMobil, $rowAparMobil['tanggal_penggantian'] == '' ? 'Lama' : date('d-m-Y', strtotime($rowAparMobil['tanggal_penggantian'])));
    $aparMobilSheet->setCellValue('I' . $rowNumberAparMobil, $rowAparMobil['masa_pemakaian']);
    $aparMobilSheet->setCellValue('J' . $rowNumberAparMobil, $rowAparMobil['tanggal_refill'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($rowAparMobil['tanggal_refill'])));
    $aparMobilSheet->setCellValue('K' . $rowNumberAparMobil, $rowAparMobil['tanggal_expired'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($rowAparMobil['tanggal_expired'])));
    $aparMobilSheet->setCellValue('L' . $rowNumberAparMobil, $rowAparMobil['nozzle']);
    $aparMobilSheet->setCellValue('M' . $rowNumberAparMobil, $rowAparMobil['tabung']);
    $aparMobilSheet->setCellValue('N' . $rowNumberAparMobil, $rowAparMobil['presure']);
    $aparMobilSheet->setCellValue('O' . $rowNumberAparMobil, $rowAparMobil['catridge']);
    $aparMobilSheet->setCellValue('P' . $rowNumberAparMobil, $rowAparMobil['pin']);
    $aparMobilSheet->setCellValue('Q' . $rowNumberAparMobil, $rowAparMobil['handle']);
    $aparMobilSheet->setCellValue('R' . $rowNumberAparMobil, $rowAparMobil['berat']);

    // Apply styles for expired or "Tidak Layak" rows if necessary
    $expired_date = new DateTime($rowAparMobil['tanggal_expired']);
    $current_date = new DateTime();
    if ($expired_date < $current_date) {
        applyExpiredRowStyle($aparMobilSheet, $rowNumberAparMobil);
    }

    if ($rowAparMobil['kondisi'] == 'Tidak Layak') {
        applyTidakLayakRowStyle($aparMobilSheet, $rowNumberAparMobil);
    }

    $rowNumberAparMobil++;
    $noAparMobil++;
}

$hydrantSheet = $spreadsheet->createSheet();
$hydrantSheet->setTitle('Data Hydrant Indoor');

// Set header values for the new sheet
$hydrantSheet->setCellValue('B2', 'No');
$hydrantSheet->setCellValue('C2', 'Code Hydrant');
$hydrantSheet->setCellValue('D2', 'Nomer Urut');
$hydrantSheet->setCellValue('E2', 'Lokasi');
$hydrantSheet->setCellValue('F2', 'Jenis Lokasi');
$hydrantSheet->setCellValue('G2', 'Hose');
$hydrantSheet->setCellValue('H2', 'Nozzle');
$hydrantSheet->setCellValue('I2', 'Valve');
$hydrantSheet->setCellValue('J2', 'Kunci');
$hydrantSheet->setCellValue('K2', 'Seal Karet Hose');
$hydrantSheet->setCellValue('L2', 'Seal Karet Nozzle');
$hydrantSheet->setCellValue('M2', 'Box Hydrant');
$hydrantSheet->setCellValue('N2', 'Keterangan');

// Apply yellow background color to headers
$hydrantSheet->getStyle('B2:N2')->applyFromArray($headerStyleArray);
$hydrantSheet->getRowDimension(2)->setRowHeight(50);

foreach (range('B', 'N') as $columnID) {
    $hydrantSheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Fetch data from database for hydrant indoor
$queryHydrant = "SELECT * FROM data_hydrant WHERE jenis_lokasi = 'Indoor' ORDER BY id ASC";
$resultHydrant = mysqli_query($koneksi, $queryHydrant);
if (!$resultHydrant) {
    die("Query error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
}

$rowNumberHydrant = 3; // Start from the third row for hydrants
$noHydrant = 1;

while ($rowHydrant = mysqli_fetch_assoc($resultHydrant)) {
    $hydrantSheet->setCellValue('B' . $rowNumberHydrant, $noHydrant);
    $hydrantSheet->setCellValue('C' . $rowNumberHydrant, $rowHydrant['code_hydrant']);
    $hydrantSheet->setCellValue('D' . $rowNumberHydrant, $rowHydrant['nomer_urut']);
    $hydrantSheet->setCellValue('E' . $rowNumberHydrant, $rowHydrant['lokasi']);
    $hydrantSheet->setCellValue('F' . $rowNumberHydrant, $rowHydrant['jenis_lokasi']);
    $hydrantSheet->setCellValue('G' . $rowNumberHydrant, $rowHydrant['hose']);
    $hydrantSheet->setCellValue('H' . $rowNumberHydrant, $rowHydrant['nozzle']);
    $hydrantSheet->setCellValue('I' . $rowNumberHydrant, $rowHydrant['valve']);
    $hydrantSheet->setCellValue('J' . $rowNumberHydrant, $rowHydrant['kunci']);
    $hydrantSheet->setCellValue('K' . $rowNumberHydrant, $rowHydrant['seal_karet_hose']);
    $hydrantSheet->setCellValue('L' . $rowNumberHydrant, $rowHydrant['seal_karet_nozzle']);
    $hydrantSheet->setCellValue('M' . $rowNumberHydrant, $rowHydrant['box_hydrant']);
    $hydrantSheet->setCellValue('N' . $rowNumberHydrant, $rowHydrant['keterangan']);

    // Additional styling can be applied here if needed

    $rowNumberHydrant++;
    $noHydrant++;
}

$hydrantOutSheet = $spreadsheet->createSheet();
$hydrantOutSheet->setTitle('Data Hydrant Outdoor');

// Set header values for the new sheet
$hydrantOutSheet->setCellValue('B2', 'No');
$hydrantOutSheet->setCellValue('C2', 'Code Hydrant');
$hydrantOutSheet->setCellValue('D2', 'Nomer Urut');
$hydrantOutSheet->setCellValue('E2', 'Lokasi');
$hydrantOutSheet->setCellValue('F2', 'Jenis Lokasi');
$hydrantOutSheet->setCellValue('G2', 'Hose');
$hydrantOutSheet->setCellValue('H2', 'Nozzle');
$hydrantOutSheet->setCellValue('I2', 'Valve');
$hydrantOutSheet->setCellValue('J2', 'Kunci');
$hydrantOutSheet->setCellValue('K2', 'Seal Karet Hose');
$hydrantOutSheet->setCellValue('L2', 'Seal Karet Nozzle');
$hydrantOutSheet->setCellValue('M2', 'Box Hydrant');
$hydrantOutSheet->setCellValue('N2', 'Keterangan');

// Apply yellow background color to headers
$hydrantOutSheet->getStyle('B2:N2')->applyFromArray($headerStyleArray);
$hydrantOutSheet->getRowDimension(2)->setRowHeight(50);

foreach (range('B', 'N') as $columnID) {
    $hydrantOutSheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Fetch data from database for hydrant indoor
$queryHydrant = "SELECT * FROM data_hydrant WHERE jenis_lokasi = 'Outdoor' ORDER BY id ASC";
$resultHydrant = mysqli_query($koneksi, $queryHydrant);
if (!$resultHydrant) {
    die("Query error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
}

$rowNumberHydrant = 3; // Start from the third row for hydrants
$noHydrant = 1;

while ($rowHydrant = mysqli_fetch_assoc($resultHydrant)) {
    $hydrantOutSheet->setCellValue('B' . $rowNumberHydrant, $noHydrant);
    $hydrantOutSheet->setCellValue('C' . $rowNumberHydrant, $rowHydrant['code_hydrant']);
    $hydrantOutSheet->setCellValue('D' . $rowNumberHydrant, $rowHydrant['nomer_urut']);
    $hydrantOutSheet->setCellValue('E' . $rowNumberHydrant, $rowHydrant['lokasi']);
    $hydrantOutSheet->setCellValue('F' . $rowNumberHydrant, $rowHydrant['jenis_lokasi']);
    $hydrantOutSheet->setCellValue('G' . $rowNumberHydrant, $rowHydrant['hose']);
    $hydrantOutSheet->setCellValue('H' . $rowNumberHydrant, $rowHydrant['nozzle']);
    $hydrantOutSheet->setCellValue('I' . $rowNumberHydrant, $rowHydrant['valve']);
    $hydrantOutSheet->setCellValue('J' . $rowNumberHydrant, $rowHydrant['kunci']);
    $hydrantOutSheet->setCellValue('K' . $rowNumberHydrant, $rowHydrant['seal_karet_hose']);
    $hydrantOutSheet->setCellValue('L' . $rowNumberHydrant, $rowHydrant['seal_karet_nozzle']);
    $hydrantOutSheet->setCellValue('M' . $rowNumberHydrant, $rowHydrant['box_hydrant']);
    $hydrantOutSheet->setCellValue('N' . $rowNumberHydrant, $rowHydrant['keterangan']);

    // Additional styling can be applied here if needed

    $rowNumberHydrant++;
    $noHydrant++;
}



// Save the file
$writer = new Xlsx($spreadsheet);

// Set "Data Apar" as the active sheet
$spreadsheet->setActiveSheetIndex(0);

// Determine base project directory and backup folder
$baseDir = dirname(__DIR__, 3); // project root
$backupDir = $baseDir . DIRECTORY_SEPARATOR . 'BACKUP REKAP DATA APAR DAN HYDRANT';

// Ensure backup folder exists
if (!is_dir($backupDir)) {
    @mkdir($backupDir, 0777, true);
}

$waktu = 'Rekap Data  ' . date('d-m-Y') . '.xlsx';
$fullPath = $backupDir . DIRECTORY_SEPARATOR . $waktu;

// Try saving a copy to backup folder (suppress warnings)
try {
    $writer->save($fullPath);
} catch (\Throwable $e) {
    // ignore write-to-disk errors; continue to allow direct download
}

// Clear any previous output to avoid corrupting the binary stream
if (ob_get_length()) {
    @ob_end_clean();
}

// Output for browser download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $waktu . '"');
header('Cache-Control: max-age=0');

// Send spreadsheet to output and exit
$writer->save('php://output');
exit;

?>
