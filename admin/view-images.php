<?php
require 'config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'admin/sign-in.php');
    die();
}
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM estate_images WHERE estate_id='$id'";
    $result = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Görseller</title>
    <link href="<?= ROOT_URL ?>css/style-admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <?php if (isset($_SESSION['add-image-success'])) : ?>
            <div class="succ_message">
                <p>
                    <?= $_SESSION['add-image-success'];
                    unset($_SESSION['add-image-success']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit-image-success'])) : ?>
            <div class="succ_message">
                <p>
                    <?= $_SESSION['edit-image-success'];
                    unset($_SESSION['edit-image-success']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['delete-image-success'])) : ?>
            <div class="succ_message">
                <p>
                    <?= $_SESSION['delete-image-success'];
                    unset($_SESSION['delete-image-success']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <div class="form-card">
            <h1>Görseller</h1>
            <form>
                <?php while ($estate_image = mysqli_fetch_assoc($result)) : ?>
                    <div><img src="../images/<?= $estate_image['filename'] ?>" alt="..."></div>
                    <div class="buttons" style="margin: 0 0 35px 0;">
                        <a href="<?= ROOT_URL ?>admin/edit-image.php?id=<?= $estate_image['id'] ?>" class="btn edit"><img src="../icons/edit.svg" width="24" height="24" alt="" /></a>
                        <a href="<?= ROOT_URL ?>admin/delete-image.php?id=<?= $estate_image['id'] ?>" class="btn delete"><img src="../icons/delete.svg" width="24" height="24" alt="" /></a>
                    </div>
                <?php endwhile ?>
                <a href="<?= ROOT_URL ?>admin/add-image.php?id=<?= $id ?>" class="btn add">+ Görsel Ekle</a>
                <div class="buttons">
                    <a href="<?= ROOT_URL ?>admin/dashboard.php" class="btn cancel">Geri Dön</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>