<?php
require 'config/database.php';

$title = $_SESSION['add-estate-data']['title'] ?? null;
$price = $_SESSION['add-estate-data']['price'] ?? null;
$site = $_SESSION['add-estate-data']['site'] ?? null;
$floor = $_SESSION['add-estate-data']['floor'] ?? null;
$rooms = $_SESSION['add-estate-data']['rooms'] ?? null;
$gross = $_SESSION['add-estate-data']['gross'] ?? null;
$front = $_SESSION['add-estate-data']['front'] ?? null;
$balcony = $_SESSION['add-estate-data']['balcony'] ?? null;
$bath = $_SESSION['add-estate-data']['bath'] ?? null;
$kullan = $_SESSION['add-estate-data']['kullan'] ?? null;
$status = $_SESSION['add-estate-data']['status'] ?? null;
$credit = $_SESSION['add-estate-data']['credit'] ?? null;
$location = $_SESSION['add-estate-data']['location'] ?? null;
$info = $_SESSION['add-estate-data']['info'] ?? null;
unset($_SESSION['add-estate-data']);

if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'admin/sign-in.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Yeni Emlak Ekle</title>
    <link href="<?= ROOT_URL ?>css/style-admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="form-card">
            <h1>Yeni Emlak Ekle</h1>
            <form action="<?= ROOT_URL ?>admin/add-estate-logic.php" method="POST" enctype="multipart/form-data">
                <label>Unvan</label>
                <input type="text" name="title" value = <?= $title ?>>
                <label>Fiyat</label>
                <input type="text" name="price" value = <?= $price ?>>
                <label>Site</label>
                <input type="text" name="site" value = <?= $site ?>>
                <label>Kat</label>
                <input type="text" name="floor" value = <?= $floor ?>>
                <label>Oda Sayısı</label>
                <input type="text" name="rooms" value = <?= $rooms ?>>
                <label>Brüt</label>
                <input type="text" name="gross" value = <?= $gross ?>>
                <label>Cephe</label>
                <input type="text" name="front" value = <?= $front ?>>
                <label>Balkon</label>
                <input type="text" name="balcony" value = <?= $balcony ?>>
                <label>Banyo</label>
                <input type="text" name="bath" value = <?= $bath ?>>
                <label>Kullanım</label>
                <input type="text" name="kullan" value = <?= $kullan ?>>
                <label>Tapu Durumu</label>
                <input type="text" name="status" value = <?= $status ?>>
                <label>Kredi</label>
                <input type="text" name="credit" value = <?= $credit ?>>
                <label>Konum</label>
                <input type="text" name="location" value = <?= $location ?>>
                <label>Açıklama</label>
                <textarea type="text" name="info" value = <?= $info ?>></textarea>
                <label>Görseller</label>
                <input type="file" name="images[]" accept=".jpeg, .jpg, .png" multiple>
                <label>Video</label>
                <input type="file" name="video" accept="video/*">
                <div class="buttons">
                    <button type="submit" name="submit" class="btn add">Bitir</button>
                    <a href="<?= ROOT_URL ?>admin/dashboard.php" class="btn cancel">İptal</a>
                </div>
                <?php if (isset($_SESSION['add-estate'])) : ?>
                    <div class="err_message">
                        <p>
                            <?= $_SESSION['add-estate'];
                            unset($_SESSION['add-estate']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</body>

</html>