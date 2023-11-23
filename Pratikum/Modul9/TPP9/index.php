<?php
require 'koneksi.inc';
session_start();

if($_SESSION["level"] != "1"){
    header("location: index-user.php");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("location: login.php");
}

if(!isset($_SESSION["username"])){
    header("location: login.php");
}

if(isset($_GET['user'])){
    $id = $_GET['user'];
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id'");
}

$query = mysqli_query($koneksi, "SELECT id_user, username, nama, `level` FROM user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="mb-3 d-flex justify-content-end">
                    <a href="addAcc.php" class="btn btn-primary" role="button">Tambah User</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Level</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($query as $row):?>
                            <tr>
                                <td width=4%><?=$no++?></td>
                                <td><?=$row['username']?></td>
                                <td><?=$row['nama']?></td>
                                <td><?=($row['level'] == 1) ? "Admin" : "User Biasa"?></td>
                                <td width=20%>
                                    <a href="editData.php?id=<?=$row['id_user']?>" class="btn btn-success" role="button">Edit</a>
                                    <a href="?user=<?=$row['id_user']?>" class="btn btn-danger" role="button">hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form method="post" action="">
                    <button type="submit" name="logout" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>