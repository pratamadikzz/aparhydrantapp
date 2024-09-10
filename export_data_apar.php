<?php
include('koneksi.php');
$result = mysqli_query($koneksi, "SELECT * FROM data_apar");
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

?>
<html>

<head>
    <title>Cek Apar | Cetak Laporan</title>
    <link rel="icon" href="assets/img/logokecil.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<br>

<body>
    <div class="container">
        <h2>Data Laporan Inspeksi</h2>
        <h4></h4>
        <div class="data-tables datatable-dark">
            <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                <thead>
                <tr>
                          <th style="background-color:yellow;"> No </th>
                          <th style="background-color:yellow;"> Code Apar </th>
                          <th style="background-color:yellow;"> Lokasi </th>
                          <th style="background-color:yellow;"> Departemen </th>
                          <th style="background-color:yellow;"> Jenis Apar </th>
                          <th style="background-color:yellow;"> Vendor </th>
                          <th style="background-color:yellow;"> Kondisi </th>
                          <th style="background-color:yellow;"> Tanggal Penggantian </th>
                          <th style="background-color:yellow;"> Masa Pemakaian </th>
                          <th style="background-color:yellow;"> Tanggal Refill </th>
                          <th style="background-color:yellow;"> Tanggal Expired </th>
                          <th style="background-color:yellow;"> Nozzle </th>
                          <th style="background-color:yellow;"> Tabung </th>
                          <th style="background-color:yellow;"> Pressure </th>
                          <th style="background-color:yellow;"> Catridge </th>
                          <th style="background-color:yellow;"> Pin </th>
                          <th style="background-color:yellow;"> Handle </th>
                          <th style="background-color:yellow;"> Berat </th>
                          <th style="background-color:yellow;"> Aksi </th>
                        </tr>
                </thead>
                <tbody>
                <?php
                        include('koneksi.php');
                        $query = "SELECT * FROM data_apar ORDER BY id ASC";
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                          die("query error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
                        }

                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                          $edit_modal_id = "editModal" . $row['id']; // ID modal yang unik
                          $expired_date = new DateTime($row['tanggal_expired']);
                          $current_date = new DateTime();

                          // Check if the item is expired
                          $is_expired = $expired_date < $current_date;
                        ?>
    <tr <?php if ($is_expired) echo 'style="background-color: #FF4C4C;"'; ?>>
                            <td style="text-align: center;"><?php echo $no; ?></td>
                            <td><?php echo $row['code_apar']; ?></td>
                            <td><?php echo $row['lokasi']; ?></td>
                            <td><?php echo $row['departemen']; ?></td>
                            <td><?php echo $row['jenis_apar']; ?></td>
                            <td><?php echo $row['vendor']; ?></td>
                            <td><?php echo $row['kondisi']; ?></td>
                            <td><?php echo $row['tanggal_penggantian'] == '' ? 'Sudah Lama' : date('d-m-Y', strtotime($row['tanggal_penggantian']));?></td>
                            <td><?php echo $row['masa_pemakaian']; ?></td>
                            <td><?php echo $row['tanggal_refill'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($row['tanggal_refill']));?></td>
                            <td><?php echo $row['tanggal_expired'] == '0000-00-00' ? 'Belum di Lihat' : date('d-m-Y', strtotime($row['tanggal_expired']));?></td>
                            <td><?php echo $row['nozzle']; ?></td>
                            <td><?php echo $row['tabung']; ?></td>
                            <td><?php echo $row['presure']; ?></td>
                            <td><?php echo $row['catridge']; ?></td>
                            <td><?php echo $row['pin']; ?></td>
                            <td><?php echo $row['handle']; ?></td>
                            <td><?php echo $row['berat']; ?></td>
    </tr>
<?php
}
?>


                </tbody>
            </table>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#mauexport').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>