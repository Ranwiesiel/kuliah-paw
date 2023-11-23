<?php
require "koneksi.inc";
$raw = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama FROM transaksi INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id");

$totalData = mysqli_query($koneksi, "SELECT COUNT(DISTINCT pelanggan_id) id, SUM(total) total FROM transaksi");
$totalData = mysqli_fetch_assoc($totalData);

$raw2 = mysqli_query($koneksi, "SELECT * FROM transaksi");
$dataChart = mysqli_fetch_all($raw2, MYSQLI_ASSOC);
$hasilTotal = array_column($dataChart, "total");
$hasiltgl= array_column($dataChart, "waktu_transaksi");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form method="post" class="row g-2 mt-2" action="proceed.php">
            <label for="filter">Filter Tanggal:</label>
            <div class="col">
                <input type="date" class="form-control" name="tgl_awal">
            </div>
            <div class="col">
                <input type="date" class="form-control" name="tgl_tujuan">
            </div>
            <div class="col">
                <button class="btn btn-success" name="proses">Tampilkan</button>
            </div>
        </form>
        <div class="row mt-3">
            <div class="col mx-auto">
                <div class="col-6 mx-auto">
                    <canvas id="myChart"></canvas>
                </div>
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr class="table-info">
                            <th scope="col" width=15%>ID Pelanggan</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($data = mysqli_fetch_assoc($raw)){?>
                            <tr>
                            <td><?=$data['pelanggan_id']?></td>
                            <td><?=$data['nama']?></td>
                            <td>Rp <?=$data['total']?></td>
                            <td><?=$data['waktu_transaksi']?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table table-bordered" id="table">
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: <?= json_encode($hasiltgl) ?>,
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
    </script>
</body>
</html>