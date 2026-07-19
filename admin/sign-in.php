<?php
require 'config/constants.php';
$username = $_SESSION['sign-in-data']['username'] ?? null;
$password = $_SESSION['sign-in-data']['password'] ?? null;
unset($_SESSION['sign-in-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link href="<?= ROOT_URL ?>css/style-admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="form-card">
            <h1>Yönetici Paneline Giriş Yap</h1>
            <form action="<?= ROOT_URL ?>admin/sign-in-logic.php" method="POST">
                <label>Kullanıcı Adı</label>
                <input type="text" name="username" value="<?= $username ?>">
                <label>Şifre</label>
                <input type="text" name="password" value="<?= $password ?>">
                <div class="buttons">
                    <button type="submit" name="submit" class="btn add">Giriş Yap</button>
                </div>
                <?php if(isset($_SESSION['sign-in'])) : ?>
                    <div class="err_message">
                        <p>
                            <?= $_SESSION['sign-in'];
                            unset($_SESSION['sign-in']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</body>

</html>