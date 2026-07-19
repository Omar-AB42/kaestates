<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $site = filter_var($_POST['site'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $floor = filter_var($_POST['floor'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $rooms = filter_var($_POST['rooms'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gross = filter_var($_POST['gross'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $front = filter_var($_POST['front'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $balcony = filter_var($_POST['balcony'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bath = filter_var($_POST['bath'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $kullan = filter_var($_POST['kullan'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $credit = filter_var($_POST['credit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $location = filter_var($_POST['location'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $info = filter_var($_POST['info'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $images = $_FILES['images'];
    $video = $_FILES['video'];

    if (!$title) {
        $_SESSION['add-estate'] = "Lütfen unvanı girin";
    } elseif (!$price) {
        $_SESSION['add-estate'] = "Lütfen fiyatı girin";
    } elseif (!$site) {
        $_SESSION['add-estate'] = "Lütfen siteyi girin";
    } elseif (!$floor) {
        $_SESSION['add-estate'] = "Lütfen katı girin";
    } elseif (!$rooms) {
        $_SESSION['add-estate'] = "Lütfen oda sayısını girin";
    } elseif (!$gross) {
        $_SESSION['add-estate'] = "Lütfen brütü girin";
    } elseif (!$front) {
        $_SESSION['add-estate'] = "Lütfen cepheyi girin";
    } elseif (!$balcony) {
        $_SESSION['add-estate'] = "Lütfen balkonu girin";
    } elseif (!$bath) {
        $_SESSION['add-estate'] = "Lütfen banyoyu girin";
    } elseif (!$kullan) {
        $_SESSION['add-estate'] = "Lütfen kullanımı girin";
    } elseif (!$status) {
        $_SESSION['add-estate'] = "Lütfen tapu durumuyu girin";
    } elseif (!$credit) {
        $_SESSION['add-estate'] = "Lütfen krediyi girin";
    } elseif (!$location) {
        $_SESSION['add-estate'] = "Lütfen konumu girin";
    } elseif (!$info) {
        $_SESSION['add-estate'] = "Lütfen açıklama yazın";
    } elseif (!$images['name'][0]) {
        $_SESSION['add-estate'] = "Lütfen en az bir görsel yükleyin";
    } elseif (!$video['name']) {
        $_SESSION['add-estate'] = "Lütfen videoyu yükleyin";
    } else {
        foreach ($images['name'] as $i => $name) {
            $time = time();
            $image_name = $time . "_" . $name;
            $image_tmp_name = $images['tmp_name'][$i];
            $images_destination_path = '../images/' . $image_name;
            if ($images['size'][$i] < 2_000_000) {
                move_uploaded_file($image_tmp_name, $images_destination_path);
            } else {
                $_SESSION['add_estate'] = "Dosya boyutu 2MB'ı aşıyor.";
            }
        }

        $time = time();
        $video_name = $time . "_" . $video['name'];
        $video_tmp_name = $video['tmp_name'];
        $video_destination_path = '../videos/' . $video_name;
        if ($video['size'] < 40_000_000) {
            move_uploaded_file($video_tmp_name, $video_destination_path);
        } else {
            $_SESSION['add_estate'] = "Dosya boyutu 40MB'ı aşıyor.";
        }
    }

    if (isset($_SESSION['add-estate'])) {
        $_SESSION['add-estate-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-estate.php');
        die();
    } else {
        $time = time();
        $video_name = $time . "_" . $video['name'];
        $query = "INSERT INTO estates (title, price, site, floor, rooms, gross, front, balcony, bath, kullan, status, credit, location, info, video) VALUES ('$title', '$price', '$site', '$floor', '$rooms', '$gross', '$front', '$balcony', '$bath', '$kullan', '$status', '$credit', '$location', '$info', '$video_name')";
        $result = mysqli_query($connection, $query);
        $estate_id = $connection->insert_id;
        foreach ($images['name'] as $i => $name) {
            $time = time();
            $image_name = $time . "_" . $name;
            $query_images = "INSERT INTO estate_images (estate_id, filename) VALUES ('$estate_id', '$image_name')";
            $result2 = mysqli_query($connection, $query_images);
        }
        if (!mysqli_errno($connection)) {
            $_SESSION['add-estate-success'] = "Emlak başarıyla güncellendi";
            header('location: ' . ROOT_URL . 'admin/dashboard.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add-estate.php');
    die();
}
