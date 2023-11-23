<?php
require 'koneksi.inc';
session_start();

if ($_SESSION["level"] != "1") {
    header("location: index-user.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("location: login.php");
}

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

if (isset($_GET['user'])) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup" aria-expanded="false">
                <ul class="nav navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <a class="nav-link" href="#">Transaksi</a>
                    <a class="nav-link" href="#">Laporan</a>
                </ul>
                <ul class="nav navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="bi bi-person-fill"></i>
                            <?= $_SESSION["username"] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="?logout" class="ms-4">
                                    <i class="bi bi-box-arrow-left"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                        <?php $no = 1;
                        foreach ($query as $row) : ?>
                            <tr>
                                <td width=4%><?= $no++ ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= ($row['level'] == 1) ? "Admin" : "User Biasa" ?></td>
                                <td width=20%>
                                    <a href="editData.php?id=<?= $row['id_user'] ?>" class="btn btn-success" role="button">Edit</a>
                                    <a href="?user=<?= $row['id_user'] ?>" class="btn btn-danger" role="button">hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>