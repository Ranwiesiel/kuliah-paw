<?php $nama = $email = $tanggal = ''?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form</title>
</head>
<body>
	<form method="post" action="formData.php">
		<label for="nama">Nama Lengkap</label>
		<input type="text" name="nama" value="<?= $_POST['nama'] ?? $nama ?>">
		<p>
		<label for="email">Email Address</label>
		<input type="text" name="email" value="<?= $_POST['email'] ?? $email ?>">
		<p>
		<label for="tanggal">Tanggal</label>
		<input name="tanggal" value="<?= $_POST['tanggal'] ?? $tanggal ?>" placeholder="yyyy/mm/dd">
		<p>
		<input type="submit" name="submit" value="Submit"><input type="reset" name="submit" value="Reset">
	</form>
</body>
</html>

<?php
$koneksi = mysqli_connect("localhost", "root", "", "testing");

if (isset($_POST['submit'])){
	$nama= $_POST['nama'];
	$email= $_POST['email'];
	$tanggal= $_POST['tanggal'];
	$patt= "/^[a-zA-Z\s'-]+$/";
	if ($_SERVER['REQUEST_METHOD']=='POST'){
		if (empty($nama)){
			echo "Nama kosong";
		} elseif (!is_string($nama) || !preg_match($patt, $nama) || preg_match("/^\s+/", $nama)){
			echo "Nama tidak valid<br>";
		} else{
			echo strtoupper($nama) . "<br>";
			if (isset($email)){
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  echo("$email Valid<br>");
				  if (isset($tanggal)){
					$tgl = array_map('intval',explode("/", $tanggal));
					if ($tgl[0] >= 1500){
						if (checkdate($tgl[1], $tgl[2], $tgl[0])){
							echo "Tanggal $tanggal benar";

							mysqli_query($koneksi, "INSERT INTO `data` (nama, email, tanggal) VALUES ('$nama', '$email', '$tanggal')");
						}
					} else {
						echo "invalid tanggal $tanggal";
					}
				}
				} else {
				  echo("$email email Invalid<br>");
				}
			}
		}
	}
}
?>