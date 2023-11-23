<?php
  //  CODE HERE
  include 'config.php';
  session_start();
  
  if(isset($_SESSION['username'])){
    return header('location: index.php');
  }
  
  if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encryptPass = md5($password);

    $query = "SELECT * FROM users WHERE email='$email' AND `password`='$encryptPass'";
    $result = mysqli_query($config, $query)->fetch_all(MYSQLI_ASSOC);
    if ($result) {
      $_SESSION['username'] = $result[0]['username'];
      $_SESSION['role'] = $result[0]['role'];
      header('location: index.php');
    } else {
      echo 'Email atau password salah';
      $error = true;
    }
    // print_r($result);
    // echo $email.$password;
  }
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-4 mx-auto">
        <?php if(isset($error)) {?>
        <div class="alert alert-danger" role="alert">
          Email or password is incorrect
        </div>
        <?php }?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= (isset($email)) ? $email : ''; ?>">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div id="emailHelp" class="form-text">If you don't have account please
          <a href="register.php">register</a> first
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>