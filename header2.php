<div class="dropdown">
  <button
    class="btn btn-secondary dropdown-toggle"
    type="button"
    id="languageDropdown"
    data-bs-toggle="dropdown"
    aria-expanded="false">
    한국어
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