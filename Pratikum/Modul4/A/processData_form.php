<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form proses data</title>
</head>
<body>
	<fieldset style="background-color: #dddcff;">
		<legend><b>Personal Data</b></legend>
		<table>
			<form method="post" action="processData.php" >
				<tr>
					<td><label for='nama'>Nama Lengkap</label></td>
					<td><input type='text' name='nama'></td>
				</tr>
				<tr>
					<td><label for='email'>Email Address</label></td>
					<td><input type='text' name='email'></td>
				</tr>
				<tr>
					<td><label for='password'>Password</label></td>
					<td><input type='password' name='password'></td>
				</tr>
				<tr>
					<td><label for='alamat'>Alamat</label></td>
					<td><input type='textarea' name='alamat'></td>
				</tr>
				<tr>
					<td><label for='provinsi'>Provinsi</label></td>
					<td>
						<select name='provinsi'>
							<option value='Jatim'>Jawa Timur</option>
							<option value='Jateng'>Jawa Tengah</option>
							<option value='Jabar'>Jawa Barat</option>
							<option value='Sumatra'>Sumatra</option>
							<option value='Sulawesi'>Sulawesi</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<input type='text' name='country' value='Indonesia' hidden>
					</td>
					<td></td>
				</tr>
				<tr>
					<td>
						<label for='gender'>Jenis Kelamin</label>
					</td>
					<td>
						<input type='radio' name='gender' value='Laki-laki'>
						<label for='gender'>Laki-laki</label>
						<input type='radio' name='gender' value='Perempuan'>
						<label for='gender'>Perempuan</label>
					</td>
				</tr>
				<tr>
					<td>Sudah Bekerja?</td>
					<td>
						<input type='checkbox' name='Sudah bekerja?' value='Belum' checked hidden>
						<input type='checkbox' name='Sudah bekerja?' value='Sudah'>
						<label for='Sudah bekerja'>Sudah</label>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='submit' value='Submit'>
						<input type='reset' value='Reset'>
					</td>
				</tr>
			</form>
		</table>
	</fieldset>
</body>
</html>