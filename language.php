<?php
// session_start();

// 기본 언어 설정
$defaultLang = 'en';

// 언어 선택 처리
if (isset($_GET['lang'])) {
  $selectedLang = $_GET['lang'];
  $_SESSION['lang'] = $selectedLang;
} else {
  $selectedLang = $_SESSION['lang'] ?? $defaultLang;
}

// 선택된 언어 파일 불러오기
$langFile = 'lang/' . $selectedLang . '.php';
if (file_exists($langFile)) {
  require_once $langFile;
} else {
  require_once 'lang/en.php';
}
