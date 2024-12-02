<?php
session_start(); // 세션 시작

require 'vendor/autoload.php'; // Composer의 autoload 파일
use GeoIp2\Database\Reader;

function getUserCountryCode()
{
    try {
        // GeoIP 데이터베이스 파일 경로
        $reader = new Reader('GeoLite2-Country.mmdb');
        $userIp = $_SERVER['REMOTE_ADDR'];

        // 로컬 테스트 시 외부 IP 설정 (테스트 환경에서는 아래 주석을 해제하세요)
        // $userIp = '8.8.8.8'; // 예시 IP (구글 DNS)

        // GeoIP를 통해 국가 코드 가져오기
        $record = $reader->country($userIp);
        return $record->country->isoCode; // ISO 코드 반환 (예: KR, US)
    } catch (Exception $e) {
        return 'KR'; // 오류 시 기본 국가 코드 (한국)
    }
}

// 기본 언어 설정 함수
function getDefaultLanguage()
{
    // 세션에 저장된 언어가 있으면 그 언어를 사용
    if (isset($_SESSION['language'])) {
        return $_SESSION['language'];
    }

    // IP를 기반으로 국가 코드 확인
    $countryCode = getUserCountryCode();

    // 국가 코드에 따른 기본 언어 설정
    switch ($countryCode) {
        case 'KR': // 한국
            return 'ko';
        case 'JP': // 일본
            return 'ja';
        case 'CN': // 중국
            return 'zh';
        case 'US': // 미국
        case 'GB': // 영국
        case 'AU': // 호주
        case 'CA': // 캐나다
            return 'en';
        default: // 기본 영어 설정
            return 'en';
    }
}

// 언어 설정하기
if (isset($_GET['lang'])) {
    $selectedLang = $_GET['lang'];
    $_SESSION['language'] = $selectedLang;
} else {
    $selectedLang = getDefaultLanguage(); // 기본 언어 설정
}
?>


<!DOCTYPE html>
<html lang="<?= $selectedLang; ?>">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/pages/main.css">
    <!-- <link rel="stylesheet" href="assets/style/components/header.css"> -->
    <link rel="stylesheet" href="assets/style/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/gh/sun-typeface/SUIT@2/fonts/static/woff2/SUIT.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- multilang script -->
    <!-- <script src="./multilingual-support.js" defer></script> -->
    <link rel="stylesheet" href="header.css" />

    <style>
        body {
            font-family: 'SUIT', sans-serif;
        }

        li {
            list-style: none;
        }

        a {
            text-decoration: none;
        }
    </style>
    <script>
        function setLanguage(lang) {
            window.location.href = "?lang=" + lang;
        }
    </script>

</html>

<body>
    <div class="root">
        <!-- header start here -->
        <!-- <!--?php include("./header.php"); ?> -->

        <!-- 헤더 섹션 -->
        <header class="header-container">
            <div class="header-wrapper">
                <div class="header-logo">
                    <a href="index.php">
                        <img src="assets/images/logo.svg" alt="logo" />
                    </a>
                </div>
                <div class="burger-menu-wrapper">
                    <img src="assets/images/mobile/menu.svg" class="burger-menu" alt="burger-menu"
                        onclick="handleBurgerMenu()">
                    <div class="side-bar-container">
                        <div class="sidebar-background">
                            <div class="close-btn">
                                <img src="assets/images/mobile/close.svg" alt="close" onclick="handleBurgerMenuClose()">
                            </div>
                        </div>
                        <div class="side-bar-wrapper">
                            <nav class="side-bar-section">
                                <div class="side-bar-list">
                                    <a class="side-bar-item navigate" href="listing.php">Listing</a>
                                    <a class="side-bar-item navigate" href="about.php">About us</a>
                                    <a class="side-bar-item navigate" href="product.php">Product</a>
                                    <a class="side-bar-item navigate" href="contact.php">Contact</a>
                                </div>
                                <!-- 언어 선택 드롭다운 -->
                                <select id="language-selector" class="side-bar-list lang" onchange="setLanguage(this.value)" class="form-select">
                                    <option value="ko" <?= $selectedLang === 'ko' ? 'selected' : ''; ?>>한국어</option>
                                    <option value="en" <?= $selectedLang === 'en' ? 'selected' : ''; ?>>English</option>
                                    <option value="ja" <?= $selectedLang === 'ja' ? 'selected' : ''; ?>>日本語</option>
                                    <option value="zh" <?= $selectedLang === 'zh' ? 'selected' : ''; ?>>中文</option>
                                </select>
                            </nav>
                        </div>
                    </div>
                </div>
                <nav class="header-nav">
                    <ul>
                        <li><a class="nav-item navigate" href="listing.php">Listing</a></li>
                        <li><a class="nav-item navigate" href="about.php">About us</a></li>
                        <li><a class="nav-item navigate" href="product.php">Product</a></li>
                        <li><a class="nav-item navigate" href="contact.php">Contact</a></li>
                    </ul>
                    <!-- 언어 선택 드롭다운 -->
                    <select id="language-selector" class="dropdown" onchange="setLanguage(this.value)" class="form-select">
                        <option value="ko" <?= $selectedLang === 'ko' ? 'selected' : ''; ?>>한국어</option>
                        <option value="en" <?= $selectedLang === 'en' ? 'selected' : ''; ?>>English</option>
                        <option value="ja" <?= $selectedLang === 'ja' ? 'selected' : ''; ?>>日本語</option>
                        <option value="zh" <?= $selectedLang === 'zh' ? 'selected' : ''; ?>>中文</option>
                    </select>
                </nav>
            </div>
        </header>
        <!-- header end -->

        <div class="bg-video">
            <div class="bg-color"></div>

            <video class="bg-video-content" autoplay muted loop>
                <source src="./assets/main-background-video.mp4" type="video/mp4" />
                Your browser is not supported!
            </video>
        </div>
        <main class="content-container">
            <div class="content-section">
                <div class="content-wrapper">
                    <div class="logo-wrapper">
                        <img src="assets/images/small-logo.svg" alt="logo" />
                        <p>Meet <span>STIP</span></p>
                    </div>
                    <div class="content-text">
                        <p class="letter-title">
                            <span class="strong">S</span>
                            <span>hare your wisdom with the world</span>
                        </p>
                        <p class="letter-title">
                            <span class="strong">T</span>
                            <span>he seeds of progress begin with you</span>
                        </p>
                        <p class="letter-title">
                            <span class="strong">I</span>
                            <span>ntellectual treasures spark the flame</span>
                        </p>
                        <p class="letter-title">
                            <span class="strong">P</span>
                            <span>roperty shared lets innovation flow</span>
                        </p>
                    </div>
                    <div class="content-bottom">
                        <div class="text">
                            <p>Share your wisdom with the world</p>
                            <p>The seeds of progress begin with you</p>
                        </div>
                        <div class="buttons">
                            <a href="listing.html">
                                <button class="normal-button" style="width: 180px;">
                                    Listing
                                </button>
                            </a>
                            <div class="watch-video-area">
                                <img src="./assets/images/play-circle.svg" alt="" />
                                <span>Watch video</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="logo-slider-section">
                <div class="bottom-gradient"></div>
                <div class="slider-container">
                    <!-- 그라데이션 오버레이 -->
                    <div class="gradient-overlay gradient-left"></div>
                    <div class="gradient-overlay gradient-right"></div>

                    <!-- 슬라이더 -->
                    <div class="swiper" dir="ltr">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 1" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 2" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 3" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 4" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 5" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 6" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 6" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 6" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 6" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 6" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 6" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 6" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 6" class="company-logo">
                            </div>
                            <div class="swiper-slide">
                                <img src="./assets/images/logo.svg" alt="STIP Logo 6" class="company-logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <!-- footer start -->
        <?php include("./footer.php"); ?>
        <!-- footer end -->
    </div>
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     fetch('./header.php')
        //         .then(response => response.text())
        //         .then(data => {
        //             document.getElementById('header-placeholder').innerHTML = data;
        //         });
        // })
        const handleBurgerMenu = () => {
            const nav = document.querySelector(".side-bar-container");
            nav.classList.add("open");
            nav.classList.remove("close");
        };

        const handleBurgerMenuClose = () => {
            const nav = document.querySelector(".side-bar-container");
            nav.classList.remove("open");
            nav.classList.add("close");
        };

        const swiper = new Swiper('.swiper', {
            autoplay: {
                delay: 0, //add
                disableOnInteraction: false,
            },
            breakpoints: {
                900: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
                1100: {
                    slidesPerView: 5,
                    spaceBetween: 10,
                },
                1200: {
                    slidesPerView: 6,
                    spaceBetween: 10,
                },
            },
            responsive: [{
                breakpoint: 900,
                slidesPerView: 3,
                spaceBetween: 10,
            }, ],
            speed: 10000,
            loop: true,
            loopAdditionalSlides: 1,
            slidesPerView: 3,
            spaceBetween: 10,
        })
    </script>
    <!-- <script src="./components/header.js" defer></script> -->
</body>

</html>