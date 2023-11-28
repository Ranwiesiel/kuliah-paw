<?php
  //  CODE HERE
  session_start();
  include 'config.php';

  if ($_SESSION['role'] != 'admin'){
    header('location: index-user.php');
  }

  if(isset($_GET['user'])){
    $username = $_GET['user'];
    $updateRole = "UPDATE users SET `role`='admin' WHERE username='$username'";
    mysqli_query($config, $updateRole);
  } else if (isset($_GET['admin'])){
    $username = $_GET['admin'];
    $updateRole = "UPDATE users SET `role`='user' WHERE username='$username'";
    mysqli_query($config, $updateRole);
  }

  if(!isset($_SESSION['username'])){
    header('location: login.php');
  }
  // echo $_SESSION['username'];
  if(isset($_POST['submit'])){
    session_destroy();
    header('location: login.php');
  }

  $getUsers = "SELECT * FROM users WHERE `role`='user'";
  $getAdmins = "SELECT * FROM users WHERE `role`='admin'";

  $admins = mysqli_query($config, $getAdmins); 
  $users = mysqli_query($config, $getUsers); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Session</title>
</head>

<body>
  <h1 class="text-center mt-5">Ini dashboard admin, halo 🙌 <span class="badge bg-info">
      <?= $_SESSION['username'] ?>
    </span></h1>
  <div class="container">
    <div class="row">
      <div class="col-4 mx-auto">
        <ul class="list-group my-4">
          <h3>Admins</h3>
          <?php foreach($admins as $admin) { ?>
          <li class="list-group-item d-flex justify-content-between">
            <div class="name-tag">
              <?= $admin['username'] ?>
              <h6 class="card-subtitle my-2 text-body-secondary">
                <?= $admin['email'] ?>
              </h6>
            </div>
            <a href="<?= '?admin='.$admin['username']; ?>" class="text-decoration-none">
              <h2>👎</h2>
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
      <div class="col-4 mx-auto">
        <ul class="list-group my-4">
          <h3>Users</h3>
          <?php foreach($users as $user) { ?>
          <li class="list-group-item d-flex justify-content-between">
            <div class="name-tag">
              <?= $user['username'] ?>
              <h6 class="card-subtitle my-2 text-body-secondary">
                <?= $user['email'] ?>
              </h6>
            </div>
            <a href="<?= '?user='.$user['username']; ?>" class="text-decoration-none">
              <h2>👍</h2>
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
    <form method="POST">
      <input type="submit" class="btn btn-danger" name="submit" value="Logout">
    </form>
  </div>
</body>

</html>