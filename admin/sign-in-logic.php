<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username) {
        $_SESSION['sign-in'] = "Lütfen bir kullanıcı adı yazın";
    } elseif (!$password) {
        $_SESSION['sign-in'] = "Lütfen şifreyi girin";
    } else {
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user-id'] = $user['id'];
                header('location: ' . ROOT_URL . 'admin/dashboard.php');
            } else {
                $_SESSION['sign-in'] = "Yanlış Şifre";
            }
        } else {
            $_SESSION['sign-in'] = "Kullanıcı Bulunamadı";
        }
    }

    if(isset($_SESSION['sign-in'])) {
        $_SESSION['sign-in-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/sign-in.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'admin/sign-in.php');
    die();
}
