<?php
  //  CODE HERE
  session_start();
  if ($_SESSION['role'] != 'user'){
    header('location: index.php');
  }

  if(!isset($_SESSION['username'])){
    header('location: login.php');
  }

  if(isset($_POST['submit'])){
    session_destroy();
    header('location: login.php');
  }
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
  <h1 class="text-center mt-5">Ini dashboard user, halo 🙌 <span class="badge bg-info">
      <?= $_SESSION['username'] ?>
    </span></h1>
  <form method="POST">
    <input type="submit" class="btn btn-danger" name="submit" value="Logout">
  </form>
</body>

</html>