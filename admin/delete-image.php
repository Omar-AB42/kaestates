<?php
require 'config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'admin/sign-in.php');
    die();
}

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM estate_images WHERE id=$id";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $image = mysqli_fetch_assoc($result);
        $image_name = $image['filename'];
        $image_path = '../images/' . $image_name;
        if ($image_path) {
            unlink($image_path);

            $estate_id = $image['estate_id'];
            $delete_query = "DELETE FROM estate_images WHERE id=$id LIMIT 1";
            $delete_result = mysqli_query($connection, $delete_query);
            if (!mysqli_errno($connection)) {
                $_SESSION['delete-image-success'] = "Görsel başarıyla silendi";
                header('location: ' . ROOT_URL . 'admin/view-images.php?id=' . $estate_id);
                die();
            }
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}