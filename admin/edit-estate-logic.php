<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $prev_video_name = filter_var($_POST['prev_video_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
    $video = $_FILES['video'];

    if (!$title) {
        $_SESSION['edit-estate'] = "Lütfen unvanı girin";
    } elseif (!$price) {
        $_SESSION['edit-estate'] = "Lütfen fiyatı girin";
    } elseif (!$site) {
        $_SESSION['edit-estate'] = "Lütfen siteyi girin";
    } elseif (!$floor) {
        $_SESSION['edit-estate'] = "Lütfen katı girin";
    } elseif (!$rooms) {
        $_SESSION['edit-estate'] = "Lütfen oda sayısını girin";
    } elseif (!$gross) {
        $_SESSION['edit-estate'] = "Lütfen brütü girin";
    } elseif (!$front) {
        $_SESSION['edit-estate'] = "Lütfen cepheyi girin";
    } elseif (!$balcony) {
        $_SESSION['edit-estate'] = "Lütfen balkonu girin";
    } elseif (!$bath) {
        $_SESSION['edit-estate'] = "Lütfen banyoyu girin";
    } elseif (!$kullan) {
        $_SESSION['edit-estate'] = "Lütfen kullanımı girin";
    } elseif (!$status) {
        $_SESSION['edit-estate'] = "Lütfen tapu durumuyu girin";
    } elseif (!$credit) {
        $_SESSION['edit-estate'] = "Lütfen krediyi girin";
    } elseif (!$location) {
        $_SESSION['edit-estate'] = "Lütfen konumu girin";
    } elseif (!$info) {
        $_SESSION['edit-estate'] = "Lütfen açıklama yazın";
    } else {
        if ($video['name']) {
            $prev_video_path = '../videos/' . $prev_video_name;
            if ($prev_video_path) {
                unlink($prev_video_path);
            }
            $time = time();
            $video_name = $time . "_" . $video['name'];
            $video_tmp_name = $video['tmp_name'];
            $video_destination_path = '../videos/' . $video_name;
            if ($video['size'] < 40_000_000) {
                move_uploaded_file($video_tmp_name, $video_destination_path);
            } else {
                $_SESSION['edit_estate'] = "Dosya boyutu 40MB'ı aşıyor.";
            }
        }
    }

    if (isset($_SESSION['edit-estate'])) {
        $_SESSION['edit-estate'] = "Emlak güncelleme hatası";
        header('location: ' . ROOT_URL . 'admin/dashboard.php');
        die();
    } else {
        $video_name_to_insert = $prev_video_name;
        if ($video['name']) {
            $time = time();
            $video_name_to_insert = $time . "_" . $video['name'];
        }
        $query = "UPDATE estates SET title='$title', price='$price', site='$site', floor='$floor', rooms='$rooms', gross='$gross', front='$front', balcony='$balcony', bath='$bath', kullan='$kullan', status='$status', credit='$credit', location='$location', info='$info', video='$video_name_to_insert' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        if (!mysqli_errno($connection)) {
            $_SESSION['edit-estate-success'] = "Emlak başarıyla güncellenedi";
            header('location: ' . ROOT_URL . 'admin/dashboard.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
