<?php
session_start(); // 세션 시작
require_once 'language.php';

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

        /* content-section 스타일 */
        .content-container .content-section {
            position: absolute;
            left: 15.625%;
            top: 25%;

            @media screen and (max-width: 768px) {
                left: 50%;
                transform: translateX(-50%);
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        /* logo-slider-section 스타일 */
        /* .logo-slider-section {
            width: 100%;
            margin-top: auto;
            padding: 50px 0;
            position: relative;
        } */

        /* 슬라이더 컨테이너 */
        /* .slider-container {
            position: relative;
            max-width: 1920px;
            margin: 0 auto;
        } */

        /* 그라데이션 오버레이 */
        .gradient-overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            height: 200px;
            top: -52px;
            width: 26.042%;
            max-width: 500px;
        }

        .gradient-left {
            left: 0;
            background: rgba(0, 0, 0, 1);
            mask-image: linear-gradient(90deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.6587) 70%, transparent 100%);
            mask-repeat: no-repeat;
            filter: blur(100px);
        }

        .gradient-right {
            right: 0;
            background: rgba(0, 0, 0, 1);
            mask-image: linear-gradient(90deg, transparent 0%, rgba(0, 0, 0, 1) 70%, rgba(0, 0, 0, 1) 100%);
            mask-repeat: no-repeat;
            filter: blur(120px);
        }

        /* 하단 그라데이션 */
        .bottom-gradient {
            position: absolute;
            bottom: 0;
            padding-top: 240px;
            width: 100%;
            /* z-index: 1; */
            background: radial-gradient(50% 32% at 50% 100%, #009DFF 0%, rgba(0, 217, 255, 0.25) 53%, rgba(0, 119, 255, 0.15) 79%, rgba(0, 178, 255, 0) 100%);
        }

        /* logo-slider-section 스타일 */
        .logo-slider-section {
            width: 100%;
            margin-top: 80px;
            /* 버튼과 간격 확보를 위해 마진 추가 */
            padding: 50px 0;
            position: relative;
            z-index: -1;
        }

        /* 슬라이더 컨테이너 */
        .slider-container {
            position: relative;
            max-width: 1920px;
            margin: 0 auto;
            padding-top: 460px;
            /* 상단 여백 추가 */
        }

        /* 버튼 영역 간격 확보 */
        .buttons {
            display: flex;
            flex-direction: row;
            gap: 24px;
            align-items: center;
            margin-bottom: 30px;
            /* 슬라이더와의 간격 확보 */

            @media screen and (max-width: 768px) {
                gap: 16px;
                margin-bottom: 20px;
                /* 모바일 환경에서 간격 조정 */
            }
        }

        .content-bottom .buttons .normal-button {
            z-index: 9999;
        }

        .content-bottom .buttons .normal-button:hover {
            cursor: pointer;
            background: orange;
            color: #fcfcfc;
            font-size: 16px;
            font-weight: 500;
        }

        .content-bottom .buttons .watch-video-area {
            z-index: 9999;
        }

        /* .content-bottom .buttons .watch-video-area:hover {
            cursor: pointer;
            background-color: #009DFF;
            color: #fcfcfc;
        } */

        /* watch-video-area 스타일 */
        .watch-video-area {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .watch-video-area span {
            color: var(--white-color);
            font-size: 16px;
            font-weight: 500;
            position: relative;
            /* 밑줄을 추가하기 위해 position 설정 */

            @media screen and (max-width: 768px) {
                font-size: 14px;
            }
        }

        /* 마우스 호버 시 밑줄 효과 */
        .watch-video-area span::after {
            content: '';
            position: absolute;
            bottom: -2px;
            /* 글씨 아래 간격 */
            left: 0;
            width: 0;
            /* 기본 상태에서 너비 0 */
            height: 2px;
            /* 밑줄 두께 */
            background-color: var(--primary-color);
            /* 밑줄 색상 */
            transition: width 0.3s ease;
            /* 밑줄 애니메이션 */
        }

        .watch-video-area:hover span::after {
            width: 100%;
            /* 마우스 호버 시 밑줄 전체 너비 */
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
                                    <a class="side-bar-item navigate" href="listing.php"><?= $lang['listing'] ?></a>
                                    <a class="side-bar-item navigate" href="about.php"><?= $lang['about_us'] ?></a>
                                    <a class="side-bar-item navigate" href="product.php"><?= $lang['product'] ?></a>
                                    <a class="side-bar-item navigate" href="contact.php"><?= $lang['contact'] ?></a>
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
                        <li><a class="nav-item navigate" href="listing.php"><?= $lang['listing'] ?></a></li>
                        <li><a class="nav-item navigate" href="about.php"><?= $lang['about_us'] ?></a></li>
                        <li><a class="nav-item navigate" href="product.php"><?= $lang['product'] ?></a></li>
                        <li><a class="nav-item navigate" href="contact.php"><?= $lang['contact'] ?></a></li>
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
                        <!--<p><?php $lang['meet_stip'] ?></p>-->
                        <p>Meet <span>STIP</span></p>
                    </div>
                    <div class="content-text">
                        <p class="letter-title">
                            <span class="strong">S</span>
                            <span><?= $lang['share_wisdom'] ?></span>
                        </p>
                        <!-- <span>hare your wisdom with the world</span> -->
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
                            <a href="listing.php">
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
                delay: 0, // 자동 재생 딜레이 시간
                disableOnInteraction: false, // 사용자 상호작용 시에도 자동 재생 유지
            },
            breakpoints: {
                // 화면 크기별 슬라이드 설정
                900: {
                    slidesPerView: 3,
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
            speed: 10000, // 슬라이드 애니메이션 속도
            loop: true, // 슬라이드 반복
            loopAdditionalSlides: 1, // 추가 반복 슬라이드 개수
            slidesPerView: 3, // 기본 슬라이드 개수
            spaceBetween: 10, // 슬라이드 간격
        });


        // const swiper = new Swiper('.swiper', {
        //     autoplay: {
        //         delay: 0, //add
        //         disableOnInteraction: false,
        //     },
        //     breakpoints: {
        //         900: {
        //             slidesPerView: 4,
        //             spaceBetween: 10,
        //         },
        //         1100: {
        //             slidesPerView: 5,
        //             spaceBetween: 10,
        //         },
        //         1200: {
        //             slidesPerView: 6,
        //             spaceBetween: 10,
        //         },
        //     },
        //     responsive: [{
        //         breakpoint: 900,
        //         slidesPerView: 3,
        //         spaceBetween: 10,
        //     }, ],
        //     speed: 10000,
        //     loop: true,
        //     loopAdditionalSlides: 1,
        //     slidesPerView: 3,
        //     spaceBetween: 10,
        // })
    </script>
    <!-- <script src="./components/header.js" defer></script> -->
</body>

</html>