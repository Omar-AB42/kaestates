<?php
require 'config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'admin/sign-in.php');
    die();
}

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM estates WHERE id=$id";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $estate = mysqli_fetch_assoc($result);
        $video_name = $estate['video'];
        $video_path = '../videos/' . $video_name;
        if ($video_path) {
            unlink($video_path);

            $query_image_names = "SELECT * FROM estate_images WHERE estate_id='$id'";
            $result_image_names = mysqli_query($connection, $query_image_names);
            while ($image_names = mysqli_fetch_assoc($result_image_names)) {
                $image_path = '../images/' . $image_names['filename'];
                if ($image_path) {
                    unlink($image_path);
                }
            }
            $delete_query = "DELETE FROM estates WHERE id=$id LIMIT 1";
            $delete_result = mysqli_query($connection, $delete_query);
            if (!mysqli_errno($connection)) {
                $_SESSION['delete-estate-success'] = "Emlak başarıyla silendi";
                header('location: ' . ROOT_URL . 'admin/dashboard.php');
                die();
            }
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
