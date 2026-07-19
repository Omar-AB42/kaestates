<?php
require 'config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'admin/sign-in.php');
    die();
}
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM estate_images WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    $image = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Görsel Güncel</title>
    <link href="<?= ROOT_URL ?>css/style-admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="form-card">
            <h1>Görsel Güncel</h1>
            <form action="<?= ROOT_URL ?>admin/edit-image-logic.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value=<?= $id ?>>
                <input type="hidden" name="estate_id" value=<?= $image['estate_id'] ?>>
                <input type="hidden" name="prev_image_name" value=<?= $image['filename'] ?>>
                <div><img src="../images/<?= $image['filename'] ?>" alt="..."></div>
                <div><input type="file" name="image" accept=".jpeg, .jpg, .png"></div>
                <div class="buttons">
                    <button type="submit" name="submit" class="btn add">Bitir</button>
                    <a href="<?= ROOT_URL ?>admin/view-images.php?id=<?= $image['estate_id'] ?>" class="btn cancel">İptal</a>
                </div>
            </form>
        </div>
        <?php if (isset($_SESSION['edit-image'])) : ?>
            <div class="err_message">
                <p>
                    <?= $_SESSION['edit-image'];
                    unset($_SESSION['edit-image']);
                    ?>
                </p>
            </div>
        <?php endif ?>
    </div>
</body>

</html>