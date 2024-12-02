<?php
include_once("./common.php");
?>
<header class="header-container">
  <div class="header-wrapper">
    <div class="header-logo">
      <a href="./index.php">
        <img src="./assets/images/logo.svg" alt="logo" />
      </a>
    </div>
    <nav class="header-nav">
      <div class="burger-menu-wrapper">
        <img
          src="./assets/images/mobile/menu.svg"
          class="burger-menu"
          alt="burger-menu"
          onclick="handleBurgerMenu()" />
        <div class="side-bar-container">
          <div class="sidebar-background">
            <div class="close-btn">
              <img
                src="./assets/images/mobile/close.svg"
                alt="close"
                onclick="handleBurgerMenuClose()" />
            </div>
          </div>
          <div class="side-bar-wrapper">
            <nav class="side-bar-section">
              <div class="side-bar-list">
                <!-- <a class="side-bar-item navigate" href="index.php">Main</a> -->
                <a class="side-bar-item navigate" href="./listing.php">Listing</a>
                <a class="side-bar-item navigate" href="./about.php">About us</a>
                <a class="side-bar-item navigate" href="./product.php">Product</a>
                <a class="side-bar-item navigate" href="./contact.php">Contact</a>
              </div>
              <div class="side-bar-list lang">
                <span
                  class="side-bar-item ko"
                  onclick="handleLangChange('ko',true)">한국어</span>
                <span
                  class="side-bar-item en"
                  onclick="handleLangChange('en',true)">English</span>
                <span
                  class="side-bar-item ja"
                  onclick="handleLangChange('ja',true)">日本語</span>
                <span
                  class="side-bar-item zh"
                  onclick="handleLangChange('zh',true)">中文</span>
              </div>
            </nav>
          </div>
        </div>
      </div>
      <ul>
        <li>
          <a class="nav-item navigate" href="listing.php">Listing</a>
        </li>
        <li>
          <a class="nav-item navigate" href="about.php">About us</a>
        </li>
        <li>
          <a class="nav-item navigate" href="product.php">Product</a>
        </li>
        <li>
          <a class="nav-item navigate" href="contact.php">Contact</a>
        </li>
        <!--<div class="dropdown">
          <button
            class="btn btn-secondary dropdown-toggle"
            type="button"
            id="dropdownMenuButton1"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            한국어
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li>
              <div class="dropdown-item" onclick="handleLangChange('ko')">
                한국어
              </div>
            </li>
            <li>
              <div class="dropdown-item" onclick="handleLangChange('en')">
                English
              </div>
            </li>
            <li>
              <div class="dropdown-item" onclick="handleLangChange('ja')">
                日本語
              </div>
            </li>
            <li>
              <div class="dropdown-item" onclick="handleLangChange('zh')">
                中文
              </div>
            </li>
          </ul>
        </div>-->
        <div class="dropdown">
          <button
            class="btn btn-secondary dropdown-toggle"
            type="button"
            id="languageDropdown"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            <?php $code = detectLanguageFromIP(); ?>
            <!-- English -->
          </button>
          <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            <?php
            $languages = [
              'ko' => '한국어',
              'en' => 'English',
              'ja' => '日本語',
              'zh' => '中文'
            ];

            foreach ($languages as $code => $name):
            ?>
              <li>
                <div
                  class="dropdown-item"
                  onclick="handleLangChange('<?= $code ?>')">
                  <?= $name ?>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </ul>
    </nav>
  </div>
</header>