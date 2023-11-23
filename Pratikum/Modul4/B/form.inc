<?php $nama = $email = $password = $alamat = ''; ?>

<fieldset style="background-color: #dddcff;">
	<legend><b>Personal Data</b></legend>
		<table>
			<form method="post" action="processData_form.php" >
				<tr>
					<td><label for='nama'>Nama Lengkap</label></td>
					<td><input type='text' name='nama' value='<?= $_POST['nama'] ?? $nama ?>'></td>
				</tr>
				<tr>
					<td><label for='email'>Email Address</label></td>
					<td><input type='text' name='email' value="<?= $_POST['email'] ?? $email ?>"></td>
				</tr>
				<tr>
					<td><label for='password'>Password</label></td>
					<td><input type='password' name='password' value="<?= $_POST['password'] ?? $password ?>"></td>
				</tr>
				<tr>
					<td><label for='alamat'>Alamat</label></td>
					<td><input type='textarea' name='alamat' value="<?= $_POST['alamat'] ?? $alamat ?>"></td>
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
						<input type='submit' name='submit' value='Submit'>
						<input type='reset' value='Reset'>
					</td>
				</tr>
			</form>
		</table>
</fieldset>