<?php
require 'config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'admin/sign-in.php');
    die();
}
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Görsel Ekle</title>
    <link href="<?= ROOT_URL ?>css/style-admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="form-card">
            <h1>Görsel Ekle</h1>
            <form action="<?= ROOT_URL ?>admin/add-image-logic.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value=<?= $id ?>>
                <input type="file" name="images[]" accept=".jpeg, .jpg, .png" multiple>
                <div class="buttons">
                    <button type="submit" name="submit" class="btn add">Bitir</button>
                    <a href="<?= ROOT_URL ?>admin/view-images.php?id=<?= $id ?>" class="btn cancel">İptal</a>
                </div>
            </form>
        </div>
        <?php if (isset($_SESSION['add-image'])) : ?>
            <div class="err_message">
                <p>
                    <?= $_SESSION['add-image'];
                    unset($_SESSION['add-image']);
                    ?>
                </p>
            </div>
        <?php endif ?>
    </div>
</body>

</html>