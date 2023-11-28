<?php
session_start();
if (isset($_GET['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (($username == "kasir") && ($password == "kasir")){
        echo 'Login valid Kasir';
        $_SESSION['isLogin'] = true;
        $_SESSION['nama'] = $username;
        $_SESSION['level'] = 'kasir';
        header('location: index.php');

    } else if (($username == "admin") && ($password == "admin")){
        echo 'Login valid Admin';
        $_SESSION['isLogin'] = true;
        $_SESSION['nama'] = $username;
        $_SESSION['level'] = 'admin';
        header('location: index.php');
    } else {
        echo "Username atau password salah!";
        if (isset($_SESSION['isLogin'])){
            $_SESSION['isLogin'] = false;
            $_SESSION['nama'] = '';
            $_SESSION['level'] = '';
        }
    }
}

if (isset($_GET['guest'])){
    $_SESSION['isLogin'] = false;
    $_SESSION['nama'] = '';
    $_SESSION['level'] = '';
    header('location: insertOrder.php');
}
?>