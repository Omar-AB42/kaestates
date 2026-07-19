<?php
require 'config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'admin/sign-in.php');
    die();
}

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM estates WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    $estate = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Emlak Düzenle</title>
    <link href="<?= ROOT_URL ?>css/style-admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="form-card">
            <h1>Emlak Düzenle</h1>
            <form action="<?= ROOT_URL ?>admin/edit-estate-logic.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value=<?= $estate['id'] ?>>
                <input type="hidden" name="prev_video_name" value=<?= $estate['video'] ?>>
                <label>Unvan</label>
                <textarea type="text" name="title"><?= htmlspecialchars($estate['title']) ?></textarea>
                <label>Fiyat</label>
                <textarea type="text" name="price"><?= htmlspecialchars($estate['price']) ?></textarea>
                <label>Site</label>
                <textarea type="text" name="site"><?= htmlspecialchars($estate['site']) ?></textarea>
                <label>Kat</label>
                <textarea type="text" name="floor"><?= htmlspecialchars($estate['floor']) ?></textarea>
                <label>Oda Sayısı</label>
                <textarea type="text" name="rooms"><?= htmlspecialchars($estate['rooms']) ?></textarea>
                <label>Brüt</label>
                <textarea type="text" name="gross"><?= htmlspecialchars($estate['gross']) ?></textarea>
                <label>Cephe</label>
                <textarea type="text" name="front"><?= htmlspecialchars($estate['front']) ?></textarea>
                <label>Balkon</label>
                <textarea type="text" name="balcony"><?= htmlspecialchars($estate['balcony']) ?></textarea>
                <label>Banyo</label>
                <textarea type="text" name="bath"><?= htmlspecialchars($estate['bath']) ?></textarea>
                <label>Kullanım</label>
                <textarea type="text" name="kullan"><?= htmlspecialchars($estate['kullan']) ?></textarea>
                <label>Tapu Durumu</label>
                <textarea type="text" name="status"><?= htmlspecialchars($estate['status']) ?></textarea>
                <label>Kredi</label>
                <textarea type="text" name="credit"><?= htmlspecialchars($estate['credit']) ?></textarea>
                <label>Konum</label>
                <textarea type="text" name="location"><?= htmlspecialchars($estate['location']) ?></textarea>
                <label>Açıklama</label>
                <textarea type="text" name="info" style="height: 20vh"><?= htmlspecialchars($estate['info']) ?></textarea>
                <label>Video</label>
                <input type="file" name="video" accept="video/*">
                <div class="buttons">
                    <button type="submit" name="submit" class="btn add">Güncel</button>
                    <a href="<?= ROOT_URL ?>admin/dashboard.php" class="btn cancel">İptal</a>
                </div>
                <?php if (isset($_SESSION['edit-estate'])) : ?>
                    <div class="err_message">
                        <p>
                            <?= $_SESSION['edit-estate'];
                            unset($_SESSION['edit-estate']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</body>

</html>