<?php
  //  CODE HERE
  include 'config.php';
  session_start();

  if(isset($_SESSION['username'])){
    return header('location: index.php');
  }

  if(isset($_POST['submit'])){
    $password = $_POST['password'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    // echo $password.$email.$username;

    $insertData = "INSERT INTO users VALUES (null, '$username', '$email', md5('$password'), 'user')";
    try{
      mysqli_query($config, $insertData);
      header('location: login.php');
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Register</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-4 mx-auto mt-5">
        <?php if(isset($error)) {?>
        <div class="alert alert-danger" role="alert">
          Username sudah digunakan
        </div>
        <?php }?>
        <form method="POST">
          <div class="mb-3">
            <label for="inputUsername" class="form-label">Username</label>
            <input type="text" name="username" id="inputUsername" class="form-control" value="<?= (isset($username)) ? $username : ''; ?>" required>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= (isset($email)) ? $email : ''; ?>" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
        <div class="form-text">You have an accout? <a href="login.php">Login</a> now</div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>