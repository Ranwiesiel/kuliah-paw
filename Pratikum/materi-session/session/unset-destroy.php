<?php
  session_start();
  $_SESSION['username'] = 'admin';
  $_SESSION['email'] = 'admin@gmai.com';
  print_r($_SESSION);
  session_unset();
  // session_destroy();
  print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
</body>
</html>