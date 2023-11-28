<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_mhs");
$raw = mysqli_query($koneksi, "SELECT * FROM tbl_mhs");

$dataChart = "SELECT COUNT(id_mhs) jumlah, alamat_mhs FROM tbl_mhs GROUP BY alamat_mhs";
$hasilChart = mysqli_query($koneksi, $dataChart);
$hasilChart = mysqli_fetch_all($hasilChart, MYSQLI_ASSOC);
$hasilJumlah = array_column($hasilChart, "jumlah");
$hasilAlamat = array_column($hasilChart, "alamat_mhs");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratikum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col mx-auto">
                <button class="btn btn-success" onClick="ExportToExcel()">Export Exel</button>
                <a href="" class="btn btn-primary" value="">Tambah Data</a>
                <table class="table" id="table">
                    <thead>
                        <tr>
                        <th scope="col">ID Mahasiswa</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telpon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($data = mysqli_fetch_assoc($raw)){?>
                            <tr>
                            <td scope="tdow"><?=$data['id_mhs']?></td>
                            <td><?=$data['nama_mhs']?></td>
                            <td><?=$data['alamat_mhs']?></td>
                            <td><?=$data['no_telp']?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
                <div class="col-5 mx-auto">
                    <canvas id="myChart" ></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'pie',
            data: {
            labels: <?= json_encode($hasilAlamat) ?>,
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: <?= json_encode($hasilJumlah) ?>,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(100, 100, 255, 0.9)',
                    'rgba(220, 50, 255, 0.9)',
                    'rgba(255, 99, 50, 0.9)',
                    'rgba(150, 150, 255, 0.9)',
                    'rgba(100, 100, 255, 0.9)'
                ]
            }]
            },
            options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
            }
        });



        function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('table');
        var wb = XLSX.utils.table_to_book(elt, {
            sheet: "sheet1"
        });
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