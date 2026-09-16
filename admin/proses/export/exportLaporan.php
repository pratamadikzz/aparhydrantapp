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
$sheet->setCellValue('C2', 'Nama Inspeksi');
$sheet->setCellValue('D2', 'Tanggal Inspeksi');
$sheet->setCellValue('E2', 'Code Apar');
$sheet->setCellValue('F2', 'Lokasi');
$sheet->setCellValue('G2', 'Departemen');
$sheet->setCellValue('H2', 'Jenis Apar');
$sheet->setCellValue('I2', 'Vendor Refill');
$sheet->setCellValue('J2', 'Kondisi Fisik');
$sheet->setCellValue('K2', 'Status Tabung');
$sheet->setCellValue('L2', 'Masa Pemakaian');
$sheet->setCellValue('M2', 'Tanggal Refill');
$sheet->setCellValue('N2', 'Tanggal Expired');
$sheet->setCellValue('O2', 'Nozzle');
$sheet->setCellValue('P2', 'Tabung');
$sheet->setCellValue('Q2', 'Pressure');
$sheet->setCellValue('R2', 'Catridge');
$sheet->setCellValue('S2', 'Pin');
$sheet->setCellValue('T2', 'Handle');
$sheet->setCellValue('U2', 'Berat');

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

$sheet->getStyle('B2:U2')->applyFromArray($headerStyleArray);
$sheet->getRowDimension(2)->setRowHeight(50);

foreach (range('B', 'U') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Fetch data from database
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

// Define the month mapping (adjust according to your month input)
$monthMapping = [
    'Januari' => '01',
    'Februari' => '02',
    'Maret' => '03',
    'April' => '04',
    'Mei' => '05',
    'Juni' => '06',
    'Juli' => '07',
    'Agustus' => '08',
    'September' => '09',
    'Oktober' => '10',
    'November' => '11',
    'Desember' => '12'
];

// Convert the month name to a number
$bulanNumber = isset($monthMapping[$bulan]) ? $monthMapping[$bulan] : '';

// Fetch data from database with month and year filter
include '../../../koneksi.php';
$query = "SELECT 
    da.code_apar, 
    tl.lokasi AS lokasi, 
    td.departemen AS departemen, 
    ja.jenis_apar AS jenis_apar,
    da.vendor,
    da.nama,
    da.tanggal_inspeksi,
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
    laporan da
JOIN 
    tbl_lokasi tl ON da.lokasi = tl.id
JOIN 
    tbl_departemen td ON da.departemen = td.id
JOIN 
    jenis_apar ja ON da.jenis_apar = ja.id
WHERE 
    MONTH(da.tanggal_inspeksi) = '$bulanNumber' AND YEAR(da.tanggal_inspeksi) = '$tahun'
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
    $sheet->setCellValue('C' . $rowNumber, $row['nama']);
    $sheet->setCellValue('D' . $rowNumber, $row['tanggal_inspeksi']);
    $sheet->setCellValue('E' . $rowNumber, $row['code_apar']);
    $sheet->setCellValue('F' . $rowNumber, $row['lokasi']);
    $sheet->setCellValue('G' . $rowNumber, $row['departemen']);
    $sheet->setCellValue('H' . $rowNumber, $row['jenis_apar']);
    $sheet->setCellValue('I' . $rowNumber, $row['vendor']);
    $sheet->setCellValue('J' . $rowNumber, $row['kondisi']);
    $sheet->setCellValue('K' . $rowNumber, $row['tanggal_penggantian'] == '' ? 'Lama' : date('d-m-Y', strtotime($row['tanggal_penggantian'])));
    $sheet->setCellValue('L' . $rowNumber, $row['masa_pemakaian']);
    $sheet->setCellValue('M' . $rowNumber, $row['tanggal_refill'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($row['tanggal_refill'])));
    $sheet->setCellValue('N' . $rowNumber, $row['tanggal_expired'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($row['tanggal_expired'])));
    $sheet->setCellValue('O' . $rowNumber, $row['nozzle']);
    $sheet->setCellValue('P' . $rowNumber, $row['tabung']);
    $sheet->setCellValue('Q' . $rowNumber, $row['presure']);
    $sheet->setCellValue('R' . $rowNumber, $row['catridge']);
    $sheet->setCellValue('S' . $rowNumber, $row['pin']);
    $sheet->setCellValue('T' . $rowNumber, $row['handle']);
    $sheet->setCellValue('U' . $rowNumber, $row['berat']);

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

// Determine base project directory and backup folder
$baseDir = dirname(__DIR__, 3);
$backupDir = $baseDir . DIRECTORY_SEPARATOR . 'BACKUP LAPORAN INSPEKSI' . DIRECTORY_SEPARATOR . 'APAR';

// Ensure backup folder exists
if (!is_dir($backupDir)) {
    @mkdir($backupDir, 0777, true);
}

$waktu = 'Laporan Inspeksi Apar ' . date('d-m-Y') . '.xlsx';
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
