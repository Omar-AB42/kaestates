<?php
require 'config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'admin/sign-in.php');
    die();
}

$query = "SELECT id, title, price, site, floor, rooms FROM estates";
$estate_list = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Yönetici Paneli</title>
    <link href="<?= ROOT_URL ?>css/style-admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <h1>Yönetici Paneli</h1>
        <div class="toolbar">
            <a href="<?= ROOT_URL ?>admin/add-estate.php" class="btn add">+ Emlak Ekle</a>
            <a href="<?= ROOT_URL ?>admin/log-out.php" class="btn logout">Çıkış Yap</a>
        </div>
        <?php if (isset($_SESSION['add-estate-success'])) : ?>
            <div class="succ_message">
                <p>
                    <?= $_SESSION['add-estate-success'];
                    unset($_SESSION['add-estate-success']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit-estate-success'])) : ?>
            <div class="succ_message">
                <p>
                    <?= $_SESSION['edit-estate-success'];
                    unset($_SESSION['edit-estate-success']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit-estate'])) : ?>
            <div style="margin-bottom: 35px" class="err_message">
                <p>
                    <?= $_SESSION['edit-estate'];
                    unset($_SESSION['edit-estate']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['delete-estate-success'])) : ?>
            <div class="succ_message">
                <p>
                    <?= $_SESSION['delete-estate-success'];
                    unset($_SESSION['delete-estate-success']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <?php if (mysqli_num_rows($estate_list) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Unvan</th>
                        <th>Fiyat</th>
                        <th>Site</th>
                        <th>Kat</th>
                        <th>Oda Sayısı</th>
                        <th>Düzenle</th>
                        <th>Görserlleri Düzenle</th>
                        <th>Sil</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($estate = mysqli_fetch_assoc($estate_list)) : ?>
                        <tr>
                            <td><?= $estate['title'] ?></td>
                            <td><?= $estate['price'] ?></td>
                            <td><?= $estate['site'] ?></td>
                            <td><?= $estate['floor'] ?></td>
                            <td><?= $estate['rooms'] ?></td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-estate.php?id=<?= $estate['id'] ?>" class="btn edit"><img src="../icons/edit.svg" width="24" height="24" alt="" /></button></td>
                            <td><a href="<?= ROOT_URL ?>admin/view-images.php?id=<?= $estate['id'] ?>" class="btn edit"><img src="../icons/edit.svg" width="24" height="24" alt="" /></button></td>
                            <td><a href="<?= ROOT_URL ?>admin/delete-estate.php?id=<?= $estate['id'] ?>" class="btn delete"><img src="../icons/delete.svg" width="24" height="24" alt="" /></button></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="err_message">
                <p>No estates found</p>
            </div>
        <?php endif ?>
    </div>
</body>

</html>