<?php
include 'koneksi.inc';
session_start();

if(isset($_SESSION["username"])){
    if($_SESSION["level"] != 1){
        header("location: index.php");
    } else {
        header("location: index-user.php");
    }
}

if(isset($_POST['submit'])){
    $username = htmlentities($_POST['username']);
    $password = md5($_POST['password']);
    $query =  "SELECT username, `level` FROM user WHERE username='$username' AND `password`='$password'";
    $hasil = mysqli_query($koneksi, $query) -> fetch_assoc();

    if($hasil) {
        $_SESSION["username"] = $hasil["username"];
        $_SESSION["level"] = $hasil["level"];
        header("location: index.php");
    } else{
        $error = true;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class='container mt-5'>
        <div class='row'>
            <div class='col-5 mx-auto'>
                <?php if(isset($error)){ ?>
                    <span>Username atau Password salah!</span>
                <?php } ?>
                <div class="card">
                    <h5 class="card-header">Login</h5>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="Username" class="form-control" id="username" autocomplete="off" name='username'>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" name='password'>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" name='submit'>Login</button>
                        </form>
                        <p class="card-text">Tidak punya akun? <a href="addAcc.php">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>