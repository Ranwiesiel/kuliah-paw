<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Transaksi</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function tambah(){
            $("#template-form")
            .clone()
            .appendTo($("#form-baru"))
        }
    </script>

</head>
<body>
    <form method="post" action="index%20copy.php">
            <div id="template-form">
            <label for="pilih">Makanan</label>:
            <select name="pilih[]">
                <option value="burger" data-harga=5000>Burger</option>
                <option value="pizza" data-harga=10000>Pizza</option>
                <option value="spageti" data-harga=15000>Spageti</option>
            </select>
            <label for="jumlah">Jumlah:</label>
            <input type="number" name="jumlah[]" min=0 max=100 />
            <p>
            </div>
            <div id="form-baru"></div>
            <button type="button" onclick="tambah()">Tambah</button>
            <input type="submit" value="Kirim" />
            <p>
        </form>

</body>
</html>

<?php

$harga= array(
    5000 => "burger",
    10000 => "pizza",
    15000 => "spageti",
);

if (isset($_POST["pilih"])){
    $makanan = $_POST["pilih"];
    $jumlah = $_POST["jumlah"];
    $harga_makanan = array();
    $total_harga = array();
    $total_semua = 0;

    echo '<table border=1 style="width:40%">
    <tr>
    <th>Makanan</th><th>Jumlah</th><th>Harga</th>
    </tr>';
    for ($i=0; $i < count($makanan); $i++){

        $harga_makanan[] = array_search($makanan[$i], $harga);
        $total_harga[] += $jumlah[$i] * $harga_makanan[$i];

        echo '<tr>
                <td align=center>' . $makanan[$i] . '</td><td align=center>' . $jumlah[$i] . '</td><td align=center>' . $total_harga[$i] . '</td>
              </tr>';
        
        $total_semua += $total_harga[$i];

    }
    echo '  <tr>
                <td></td><td align=center>Total</td><td align=center>' . $total_semua . '</td>
            </tr>
          </table>';
}

?>