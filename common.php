<?php
require_once 'vendor/autoload.php';

use GeoIp2\Database\Reader;

function detectLanguageFromIP()
{
  $cacheFile = '/path/to/ip_cache.json';
  $cacheDuration = 86400; // 24시간 캐시

  // 캐시 확인
  if (file_exists($cacheFile)) {
    $cacheData = json_decode(file_get_contents($cacheFile), true);
    if (
      isset($cacheData['ip']) &&
      $cacheData['ip'] === $_SERVER['REMOTE_ADDR'] &&
      $cacheData['timestamp'] > (time() - $cacheDuration)
    ) {
      return $cacheData['lang'];
    }
  }

  $defaultLang = 'en';
  $languages = ['ko', 'en', 'ja', 'zh'];

  try {
    $reader = new Reader('/path/to/GeoLite2-Country.mmdb');
    $clientIP = $_SERVER['REMOTE_ADDR'];

    // 로컬 IP 처리
    if (in_array($clientIP, ['::1', '127.0.0.1'])) {
      $clientIP = file_get_contents('https://api.ipify.org');
    }

    $record = $reader->country($clientIP);
    $countryCode = strtolower($record->country->isoCode);

    $languageMapping = [
      'kr' => 'ko',
      'jp' => 'ja',
      'cn' => 'zh',
      'tw' => 'zh',
      'us' => 'en',
      'gb' => 'en',
      'ca' => 'en',
      'au' => 'en'
    ];

    $detectedLang = isset($languageMapping[$countryCode])
      ? $languageMapping[$countryCode]
      : $defaultLang;

    // 캐시 저장
    $cacheData = [
      'ip' => $_SERVER['REMOTE_ADDR'],
      'lang' => $detectedLang,
      'timestamp' => time()
    ];
    file_put_contents($cacheFile, json_encode($cacheData));

    return $detectedLang;
  } catch (Exception $e) {
    error_log('IP 언어 감지 오류: ' . $e->getMessage());
    return $defaultLang;
  }
}
