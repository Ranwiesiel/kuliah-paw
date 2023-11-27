<?php
session_start();

    $_SESSION['isLogin'] = false;
    $_SESSION['nama'] = '';
    $_SESSION['level'] = '';
    header("location: login.php");

?>