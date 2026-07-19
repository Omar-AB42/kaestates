<?php
require 'config/database.php';

$query = "SELECT * FROM estates";
$result = mysqli_query($connection, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KA Emlak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="<?= ROOT_URL ?>css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <img src="images/PFP.png" width="100" height="100" alt="Khaled Abdulhak" className="PFP" />
        <div className="headlinks">
            <div class="logo-title">Halit Abdulhak</div>
            <div class="logo-subtitle">Profesyonel ve Dürüst İşletme</div>
        </div>
    </header>
    <section>
        <div class="sectiontitle">Emlak Fırsatları</div>
        <div class="estGrid">
            <?php while ($estate = mysqli_fetch_assoc($result)) : ?>
                <?php $estate_id = $estate['id'];
                $query_images = "SELECT * FROM estate_images WHERE estate_id=$estate_id";
                $result_images = mysqli_query($connection, $query_images);  ?>
                <div class="card">
                    <div class="coabar">
                        <div class="coa">
                            <?= $estate['price'] ?>
                        </div>
                        <div id="videoOverlay">
                            <video id="fullscreenVideo" controls>
                                <source id="fullscreenSource" src="">
                            </video>
                            <button style="font-family:'Trebuchet MS'" id="videoX" onclick="closeVideo()">X</button>
                        </div>
                        <button class="coa"
                            onclick="playVideo('videos/<?= htmlspecialchars($estate['video']) ?>')">
                            Video İzle
                            <img src="icons/play.svg" width="24" height="24" alt="">
                        </button>
                    </div>
                    <div id="carousel<?= $estate['id'] ?>" class="carousel slide">
                        <div class="carousel-inner">
                            <?php
                            $first = true;
                            while ($image = mysqli_fetch_assoc($result_images)) :
                            ?>
                                <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                    <img src="images/<?= htmlspecialchars($image['filename']) ?>"
                                        class="d-block w-100"
                                        alt="">
                                </div>
                            <?php
                                $first = false;
                            endwhile;
                            ?>
                        </div>
                        <button
                            class="carousel-control-prev"
                            type="button"
                            data-bs-target="#carousel<?= $estate['id'] ?>"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button
                            class="carousel-control-next"
                            type="button"
                            data-bs-target="#carousel<?= $estate['id'] ?>"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <th>Unvan</th>
                                <td><?= $estate['title'] ?></td>
                            </tr>
                            <tr>
                                <th>Site</th>
                                <td><?= $estate['site'] ?></td>
                            </tr>
                            <tr>
                                <th>Kat</th>
                                <td><?= $estate['floor'] ?></td>
                            </tr>
                            <tr>
                                <th>Oda Sayısı</th>
                                <td><?= $estate['rooms'] ?></td>
                            </tr>
                            <tr>
                                <th>Brüt</th>
                                <td><?= $estate['gross'] ?></td>
                            </tr>
                            <tr>
                                <th>Cephe</th>
                                <td><?= $estate['front'] ?></td>
                            </tr>
                            <tr>
                                <th>Balkon</th>
                                <td><?= $estate['balcony'] ?></td>
                            </tr>
                            <tr>
                                <th>Banyo</th>
                                <td><?= $estate['bath'] ?></td>
                            </tr>
                            <tr>
                                <th>Kullanım</th>
                                <td><?= $estate['kullan'] ?></td>
                            </tr>
                            <tr>
                                <th>Tapu Durumu</th>
                                <td><?= $estate['status'] ?></td>
                            </tr>
                            <tr>
                                <th>Kredi</th>
                                <td><?= $estate['credit'] ?></td>
                            </tr>
                            <tr>
                                <th>Konum</th>
                                <td><a href="<?= htmlspecialchars($estate['location']) ?>" target="_blank">Google Maps'ta incele</a></td>
                            </tr>
                            <tr>
                                <th>Açıklama</th>
                                <td><?= $estate['info'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endwhile ?>
        </div>
    </section>
    <footer>
        <div class="address">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22890.722039599335!2d28.655616!3d41.01898239999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa08b53a53b01%3A0xb400ec44e7243407!2sTorium%20AVM!5e1!3m2!1sen!2str!4v1782836421302!5m2!1sen!2str"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin">
            </iframe>
            <div style="font-size: larger;">
                Adress: Torium AVM - Haramidere - İstanbul
            </div>
        </div>
        <div class="contactlist">
            <div class="contact">
                <img src="icons/whatsapp.svg" width="24" height="24" alt="" />
                <div>+905393965139</div>
            </div>
            <div class="contact">
                <img src="icons/instagram.svg" width="24" height="24" alt="" />
                <a href="https://www.instagram.com/" style="text-decoration:none; color: #fff;">Khaled Abdulhak</a>
            </div>
            <div class="contact">
                <img src="icons/tiktok.svg" width="24" height="24" alt="" />
                <a href="https://www.tiktok.com/" style="text-decoration:none; color: #fff;">Khaled Abdulhak</a>
            </div>
        </div>
    </footer>
    <div class="copyright">Her hakkı saklıdır @2026</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        function playVideo(src) {

            const overlay = document.getElementById("videoOverlay");
            const video = document.getElementById("fullscreenVideo");
            const x = document.getElementById("videoX");

            video.src = src;
            video.load();

            overlay.style.display = "flex";
            x.style.display = "block";

            video.play();
        }

        function closeVideo() {

            const overlay = document.getElementById("videoOverlay");
            const video = document.getElementById("fullscreenVideo");
            const x = document.getElementById("videoX");

            video.pause();
            video.currentTime = 0;

            overlay.style.display = "none";
            x.style.display = "none";
        }
    </script>
</body>

</html>