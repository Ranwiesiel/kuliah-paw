<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Batang dengan Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" style="width:1%;max-width:100%"></canvas>
    <button onclick="window.print()">Print this page</button>
</body>
</html>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart (ctx, {
        type: 'bar',
        data: {
            labels: ["Produk A", "Product B", "Product C", "Product D"],
            datasets: [{
                label: "Penjualan",
                data: [12,19,3,5],
                backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(54,162,235, 0.2)", "rgba(255, 206, 86, 0.2)"],
                borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)", "rgba(255, 206, 86, 1)"],
                borderWidth: 1
            }]
        },
        options: {
            scales:{
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
// header("Content-Disposition: attachment; filename=laporan.xls");