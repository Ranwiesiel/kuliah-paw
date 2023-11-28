<?php
$nama= $_POST["nama"];
$nilai= $_POST["nilai"];
$data= array_combine($nama, $nilai);

$min= 0;
$max= 0;
$total= 0;
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nilai</title>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <br>
    <table border=1 cellpadding=5>
       <tr>
           <th>No</td><th>Nama</th><th>Nilai</th>
       </tr>
       <?php
       for ($i=0; $i < count($data); $i++){
           echo '<tr>
               <td>' . $i+1 . '</td><td>' . array_keys($data)[$i] . '</td><td>' . array_values($data)[$i] . '</td>
           </tr>';

           if ($min > array_values($data)[$i] || $min == 0){
            $min= array_values($data)[$i];
           } if ($max < array_values($data)[$i]){
            $max= array_values($data)[$i];
           }

           $total+= array_values($data)[$i];
       }

       $rata= $total/count($data);

       ?>

    </table>
    <?php
    echo "<p>Nilai Tertinggi: <b>" . array_search($max, $data) . "</b><br> dengan nilai: ". $max;
    echo "<p>Nilai Terendah: <b>" . array_search($min, $data) . "</b><br> dengan nilai: ". $min;
    echo "<br>Nilai rata-rata: " . number_format($rata, 2);
    ?>
</body>
</html