<?php
require 'koneksi.inc';
session_start();

if($_SESSION["level"] != "2"){
    header("location: index.php");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("location: login.php");
}

if(!isset($_SESSION["username"])){
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-9 mx-auto">
                <div class="card mt-3">
                    <div class="card-header">
                    <h2 class="mb-2">Login sebagai <b>User Biasa</b> dengan username <b><i><?=$_SESSION['username']?></i></b></h2>
                    <form method="post" action="">
                        <button type="submit" name="logout" class="btn btn-primary">Logout</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>