<?php

$count= $_POST["berapa"];

for ($i=1; $i <= $count; $i++){
        
    echo "Data ke $i <br>";
    echo '<form method="post" action="formproses.php">
    <label for="nama">Nama: </label>
    <input type="text" name="nama[]">
    <br>
    <label for="nilai">Nilai: </label>
    <input type="number" min=0 max=100 name="nilai[]">
    <br><br>';
}
echo '<button type="submit">Kirim</button>
</form>';
