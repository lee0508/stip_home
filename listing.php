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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <link rel="stylesheet" type="" href="assets/style/components/header.css" /> -->
  <link rel="stylesheet" href="assets/style/pages/listing.css" />
  <link rel="stylesheet" href="assets/style/reset.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <link
    href="https://cdn.jsdelivr.net/gh/sun-typeface/SUIT@2/fonts/static/woff2/SUIT.css"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <link rel="stylesheet" href="header.css" />

  <!-- multilang script -->
  <!-- <script src="./multilingual-support.js" defer></script> -->
  <style>
    body {
      font-family: "SUIT", sans-serif;
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
</head>

<body>
  <div class="root">
    <!-- header start -->
    <!--?php include("./header.php"); ?>-->
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

    <div class="bg-image">
      <img src="assets/images/bg-image.jpg" alt="bg-image" />
    </div>
    <div class="bg-mobile-image">
      <img src="assets/images/light-bg-image.png" alt="bg-mobile-image" />
    </div>
    <main class="content-container">
      <div class="content-wrapper">
        <div class="title-area">
          <h1 class="letter-title">
            <span> Listing </span>
          </h1>
          <p><span>S</span>hare your wisdom with the world</p>
          <p><span>T</span>he seeds of progress begin with you</p>
        </div>
        <div class="row-area">
          <div class="radius-box column">
            <div class="input-box">
              <label class="required">Name</label>
              <input type="text" placeholder="이름을 입력해주세요." />
            </div>
            <div class="input-box">
              <label class="required">Email</label>
              <input type="text" placeholder="메일을 입력해주세요." />
            </div>
            <div class="input-box">
              <label class="required">Mobile</label>
              <input type="text" placeholder="연락처를 입력해주세요." />
            </div>
            <div class="input-box button">
              <label class="required">Submit the SMART5 patent evaluation report</label>
              <button class="normal-button">Submit</button>
            </div>
            <div class="input-box button">
              <label class="required">Payment</label>
              <button class="normal-button">Connect</button>
            </div>
          </div>
          <div class="radius-box frame">
            <div class="radius-box swiper-container" id="swiperContainer">
              <div class="swiper grid-swiper" id="swiperWrapper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide swiper-grid-box">
                    <img src="assets/images/news/news.png" alt="1" />
                    <img src="assets/images/news/news-01.png" alt="2" />
                    <img src="assets/images/news/news-02.png" alt="3" />
                    <img src="assets/images/news/news-03.png" alt="4" />
                    <img src="assets/images/news/news-04.png" alt="5" />
                    <img src="assets/images/news/news-05.png" alt="6" />
                  </div>
                  <div class="swiper-slide swiper-grid-box">
                    <img src="assets/images/news/news-06.png" alt="7" />
                    <img src="assets/images/news/news-07.png" alt="8" />
                    <img src="assets/images/news/news-08.png" alt="9" />
                    <img src="assets/images/news/news-09.png" alt="10" />
                    <img src="assets/images/news/news-10.png" alt="11" />
                    <img src="assets/images/news/news-11.png" alt="12" />
                  </div>
                  <div class="swiper-slide swiper-grid-box">
                    <img src="assets/images/news/news-12.png" alt="13" />
                    <img src="assets/images/news/news-13.png" alt="14" />
                    <img src="assets/images/news/news-14.png" alt="15" />
                    <img src="assets/images/news/news-15.png" alt="16" />
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
              <div class="single-swiper" id="singleSwiperWrapper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news.png" alt="1" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-01.png" alt="2" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-02.png" alt="3" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-03.png" alt="4" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-04.png" alt="5" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-05.png" alt="6" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-06.png" alt="7" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-07.png" alt="8" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-08.png" alt="9" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-09.png" alt="10" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-10.png" alt="11" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-11.png" alt="12" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-12.png" alt="13" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-13.png" alt="14" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-14.png" alt="15" />
                  </div>
                  <div class="swiper-slide single-view">
                    <img src="assets/images/news/news-15.png" alt="16" />
                  </div>
                </div>
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
    //   fetch("./header.php")
    //     .then((response) => response.text())
    //     .then((data) => {
    //       document.getElementById("header-placeholder").innerHTML = data;
    //     });
    // });
    const Texts = [
      "STIP",
      "Intellectual",
      "Property",
      "Trade",
      "Platform",
      "Digital",
      "Patent",
      "Trademark",
      "Drama",
      "Movie",
      "Comics",
      "Franchise",
      "Music",
      "Dance",
      "Companies",
      "Research",
      "Creators",
      "Inventors",
      "Funding",
      "Ownership",
      "Innovation",
    ];

    const swiperContainer = document.getElementById("swiperContainer");

    const swiperWrapper = document.getElementById("swiperWrapper");

    const swiper = new Swiper(".grid-swiper", {
      slidesPerView: "auto",
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      speed: 1000, // 전환 속도를 좀 더 부드럽게 조정
      slidesPerView: 1,

      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      on: {
        //   beforeResize: function () {
        //     const vw = window.innerWidth;
        //     if (vw < 1000) {
        //       this.params.spaceBetween = 20;
        //       return;
        //     }
        //     if (vw < 1380) {
        //       this.params.spaceBetween = 10;
        //       return;
        //     }
        //     this.params.spaceBetween =
        //       swiperContainer.offsetWidth - 32 - swiperWrapper.offsetWidth;
        //   },
      },
    });

    const singleSwiper = new Swiper(".single-swiper", {
      slidesPerView: "auto",
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      breakpoints: {
        768: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        700: {
          slidesPerView: 4,
          spaceBetween: 10,
        },
      },
      spaceBetween: 10,
      speed: 1000, // 전환 속도를 좀 더 부드럽게 조정
      slidesPerView: 3,
    });
  </script>
  <script>
    document
      .querySelector(".dropdown-menu")
      .addEventListener("click", (e) => {
        document.querySelector(".btn-secondary").innerHTML =
          e.target.textContent;
      });
  </script>
  <!-- <script src="./components/header.js" defer></script> -->
</body>

</html>