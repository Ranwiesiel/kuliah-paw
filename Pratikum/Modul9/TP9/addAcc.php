<?php
include 'koneksi.inc';
session_start();

if(isset($_POST['submit'])){
    $username = htmlentities($_POST['username']);
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['no_telp'];
    $level = $_POST['level'];
    $insertData = "INSERT INTO user (username, `password`, nama, alamat, hp, `level`) VALUES ('$username', '$password', '$nama', '$alamat', '$hp', '$level')";
    try{
        mysqli_query($koneksi, $insertData);
        // header('location: login.php');
        echo("Error description: " . mysqli_error($koneksi));
    } catch(Exception $e){
        echo "". $e->getMessage();
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class='container mt-5 mb-5'>
        <div class='row'>
            <div class='col-5 mx-auto'>
                <h4>Tambah Akun Baru</h4>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="Username" class="form-control" id="username" autocomplete="off" name='username' required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" name='password' required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama User</label>
                        <input type="nama" id="nama" class="form-control" name='nama' autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea name="alamat" class="form-control" placeholder="Alamat" id="floatingTextarea2" style="height: 100px" autocomplete="off" required></textarea>
                            <label for="floatingTextarea2">Alamat</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No HP</label>
                        <input type="number" id="no_telp" class="form-control" name='no_telp' placeholder="08xxx" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="user" class="form-label">Jenis User</label>
                        <select class='form-select' name="level">
                            <option value='1'>Admin</option>
                            <option value='2'>User</option>
                        </select>
                    </div>
                    <button type="submit" name='submit' class="btn btn-primary mb-2">Simpan</button>
                    <a href="index.php" class="btn btn-secondary mb-2" role="button">Kembali</a>
                </form>
                <span>Punya akun? <a href="login.php">Login</a></span>
            </div>
        </div>
    </div>
</body>
</html>