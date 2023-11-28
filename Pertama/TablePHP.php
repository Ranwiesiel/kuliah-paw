<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table php</title>
</head>
<body>
    <?php
        echo '<table border="1" cellspacing="0" cellpadding="5">';
        echo '<tr align="center" bgcolor="yellow">';
        echo '<td rowspan="2">No</td>';
        echo '<td rowspan="2">Nama</td>';
        echo '<td colspan="2">Alamat</td>';
        echo '<td rowspan="2">Kota</td>';
        echo '</tr>';
        echo '<tr align="center" bgcolor="yellow">';
        echo '<td>Jalan</td>';
        echo '<td>Kelurahan</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="center">1</td>';
        echo '<td>Budi</td>';
        echo '<td>Sumatera</td>';
        echo '<td>Gubeng</td>';
        echo '<td>Surabaya</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right">2</td>';
        echo '<td>Iwan</td>';
        echo '<td>Telang</td>';
        echo '<td><font color="red">Kamal</font></td>';
        echo '<td>Bangkalan</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right">3</td>';
        echo '<td>Yuni</td>';
        echo '<td>A.Yani</td>';
        echo '<td>Jember</td>';
        echo '<td>Jember</td>';
        echo '</tr>';
        echo '</table>';
    ?>
</body>
</html>