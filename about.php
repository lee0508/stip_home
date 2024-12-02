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
  <title>Document</title>
  <!-- <link rel="stylesheet" type="" href="assets/style/components/header.css" /> -->
  <link rel="stylesheet" href="assets/style/pages/about.css" />
  <link rel="stylesheet" href="assets/style/reset.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/TagCloud@2.2.0/dist/TagCloud.min.js"></script>
  <link href="https://cdn.jsdelivr.net/gh/sun-typeface/SUIT@2/fonts/static/woff2/SUIT.css" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <link rel="stylesheet" href="header.css" />

  <!-- multilang script -->
  <script src="./multilingual-support.js" defer></script>
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
      <img src="./assets/images/bg-image.jpg" alt="bg-image" />
    </div>
    <div class="bg-mobile-image">
      <img src="./assets/images/light-bg-image.png" alt="bg-mobile-image" />
    </div>
    <main class="content-container">
      <div class="row-wrapper">
        <div class="content-wrapper">
          <div class="title-area">
            <h6>Intellectual Property</h6>
            <h1 class="letter-title">
              <span>Meet STIP</span>
            </h1>
          </div>
          <div class="content-area">
            <p>
              <span>STIP</span> is an exchange platform supporting the trade
              of digital IPs,<br />
              including patent, trademark, drama, movie, comics, franchise,
              music,<br />
              dance, etc.
            </p>
            <p>
              It provides companies, research institutions, creators, and
              inventors with<br />
              opportunities to raise funds without transferring IP ownership.
            </p>
          </div>
          <div class="bottom-area">
            <p>Hyundo Jeong</p>
            <p>Founder</p>
          </div>
        </div>
        <div class="circle-wrapper">
          <span class="Sphere"></span>
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
    const radius = Math.max(
      150,
      Math.min(280, window.innerWidth - window.innerWidth * 0.95)
    );
    const tagCloud = TagCloud(".Sphere", Texts, {
      // Sphere radius in px
      radius: radius,

      // slow, normal, fast
      maxSpeed: "normal",
      initSpeed: "normal",

      // Rolling direction [0 (top) , 90 (left), 135 (right-bottom)]
      direction: 205,

      // interaction with mouse or not [Default true (decelerate to rolling init speed, and keep rolling with mouse).]
      keep: true,
    });

    const cloudContainer = document.querySelector(".Sphere");
    const tagElements = cloudContainer.querySelectorAll(".tagcloud--item");
    if (tagElements) {
      for (let i = 0; i < tagElements.length; i++) {
        if (tagElements[i].textContent === "STIP") {
          tagElements[i].style.color = "#2997E1";
          break;
        }
      }
    }
    var color = "#FF5733 ";
    document.querySelector(".Sphere").style.color = color;
  </script>
  <script src="./components/header.js" defer></script>
</body>

</html>