<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $images = $_FILES['images'];

    if (!$images['name'][0]) {
        $_SESSION['add-image'] = "Lütfen en az bir görsel yükleyin";
    } else {
        foreach ($images['name'] as $i => $name) {
            $time = time();
            $image_name = $time . "_" . $name;
            $image_tmp_name = $images['tmp_name'][$i];
            $images_destination_path = '../images/' . $image_name;
            if ($images['size'][$i] < 2_000_000) {
                move_uploaded_file($image_tmp_name, $images_destination_path);
            } else {
                $_SESSION['add_image'] = "Dosya boyutu 2MB'ı aşıyor.";
            }
        }
    }

    if (isset($_SESSION['add-image'])) {
        header('location: ' . ROOT_URL . 'admin/add-image.php?id=' . $id);
        die();
    } else {
        foreach ($images['name'] as $i => $name) {
            $time = time();
            $image_name = $time . "_" . $name;
            $query = "INSERT INTO estate_images (estate_id, filename) VALUES ('$id', '$image_name')";
            $result = mysqli_query($connection, $query);
        }
        if (!mysqli_errno($connection)) {
            $_SESSION['add-image-success'] = "Görsel başarıyla eklendi";
            header('location: ' . ROOT_URL . 'admin/view-images.php?id=' . $id);
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
