<?php
require "koneksi.inc";

if(isset($_POST['proses'])){
    $data = mysqli_query($koneksi, "SELECT COUNT(DISTINCT pelanggan_id) id, SUM(total) total FROM transaksi WHERE waktu_transaksi BETWEEN '$_POST[tgl_awal]' AND '$_POST[tgl_tujuan]'");
    $totalData = mysqli_fetch_assoc($data);
    
    $dataChart = mysqli_query($koneksi, "SELECT total, waktu_transaksi FROM transaksi WHERE waktu_transaksi BETWEEN '$_POST[tgl_awal]' AND '$_POST[tgl_tujuan]'");
    $hasilChart = mysqli_fetch_all($dataChart, MYSQLI_ASSOC);
    $hasilTgl = array_column($hasilChart, "waktu_transaksi");
    $hasilTotal = array_column($hasilChart, "total");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Filtered</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        @media print{
            .noPrint{
                display: none;   
            }
            .canvas {
                min-height: 100%;
                max-width: 200%;
                max-height: 200%;
                height: auto!important;
                width: auto!important;
            }
        }
    </style>

</head>
<body>
    <div class="container test" id="table">
        <div id="laporan">
            <table>
                <tr>
                    <td><h3>Rekap Laporan Penjualan </h3><h5><?=$_POST['tgl_awal']?> sampai <?=$_POST['tgl_tujuan']?></h5></td>
                </tr>
            </table>
        </div>
        <div class="row mt-4 noPrint">
            <div class="col">
                <a href="index.php" class="btn btn-primary">Kembali</a><br>
                <button class="btn btn-success mt-3" onClick="window.print()">Cetak</button>
                <button class="btn btn-success mt-3" onClick="exportToExcel()">Excel</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <canvas class="canvas" id="myChart"></canvas> <!-- style="width:1%;max-width:100%" -->
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-info">
                            <th scope="col" width=2%>No</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ind=0; foreach($hasilTgl as $dumy){?>
                            <?php $date = date_create($hasilTgl[$ind])?>
                            <tr>
                            <td><?=$ind+1?></td>
                            <td>Rp <?=$hasilTotal[$ind]?></td>
                            <td><?=date_format($date,"d M y ");?></td>
                            </tr>
                        <?php $ind++; }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr>
                            <th scope="col">Jumlah Pelanggan</th>
                            <th scope="col">Jumlah Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$totalData['id']?> Orang</td>
                            <td>Rp <?=$totalData['total']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: <?= json_encode($hasilTgl) ?>,
            datasets: [{
                label: 'Total',
                data: <?= json_encode($hasilTotal) ?>,
                borderWidth: 1,
                backgroundColor: [
                    '#e5e5ef5'
                ]
            }]
            },
            options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10000
                    }
                }
            }
            }
        });


        function exportToExcel(type, fn, dl) {
            var ws = document.getElementById('table');
            var ws = XLSX.utils.table_to_sheet(ws);
            
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('Data Tabel.' + (type || 'xlsx')));
        }

    </script>

</body>
</html>