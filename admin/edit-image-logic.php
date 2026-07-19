<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $estate_id = filter_var($_POST['estate_id'], FILTER_SANITIZE_NUMBER_INT);
    $prev_image_name = filter_var($_POST['prev_image_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $image = $_FILES['image'];

    if ($image['name']) {
        $prev_image_path = '../images/' . $prev_image_name;
        if ($prev_image_path) {
            unlink($prev_image_path);
        }
        $time = time();
        $image_name = $time . "_" . $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_destination_path = '../images/' . $image_name;
        if ($image['size'] < 2_000_000) {
            move_uploaded_file($image_tmp_name, $image_destination_path);
        } else {
            $_SESSION['edit_image'] = "Dosya boyutu 2MB'ı aşıyor.";
        }
    }

    if (isset($_SESSION['edit-image'])) {
        $_SESSION['edit-image'] = "Görsel güncelleme hatası";
        header('location: ' . ROOT_URL . 'admin/edit-image.php?id=' . $id);
        die();
    } else {
        $image_name_to_insert = $prev_image_name;
        if ($image['name']) {
            $time = time();
            $image_name_to_insert = $time . "_" . $image['name'];
        }
        $query = "UPDATE estate_images SET filename='$image_name_to_insert' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        if (!mysqli_errno($connection)) {
            $_SESSION['edit-image-success'] = "Görsel başarıyla güncellenedi";
            header('location: ' . ROOT_URL . 'admin/view-images.php?id='. $estate_id);
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
