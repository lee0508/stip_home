// Multilingual content translations
const translations = {
  ko: {
    pageTitle: "지적 재산권",
    mainTitle: "STIP를 만나보세요",
    mainContent1: "<span>STIP</span>는 특허, 상표, 드라마, 영화, 만화, 프랜차이즈, 음악,<br />댄스 등 디지털 IP의 거래를 지원하는 교환 플랫폼입니다.",
    mainContent2: "기업, 연구 기관, 크리에이터, 발명가들에게<br />IP 소유권 이전 없이 자금을 조달할 수 있는 기회를 제공합니다.",
    founder: "정현도",
    founderTitle: "창립자",
    footerSlogan: "IP를 공유하자, IP 시대입니다",
    companyName: "주식회사 아이피미디어그룹",
    navItems: {
      //main: "메인",
      listing: "목록",
      about: "회사 소개",
      product: "제품",
      contact: "연락처"
    }
  },
  en: {
    pageTitle: "Intellectual Property",
    mainTitle: "Meet STIP",
    mainContent1: "<span>STIP</span> is an exchange platform supporting the trade of digital IPs,<br />including patent, trademark, drama, movie, comics, franchise, music,<br />dance, etc.",
    mainContent2: "It provides companies, research institutions, creators, and inventors<br />with opportunities to raise funds without transferring IP ownership.",
    founder: "Hyundo Jeong",
    founderTitle: "Founder",
    footerSlogan: "Let's share the IP, It's IP time",
    companyName: "IP Media Group Inc.",
    navItems: {
      // main: "Main",
      listing: "Listing",
      about: "About us",
      product: "Product",
      contact: "Contact"
    }
  },
  ja: {
    pageTitle: "知的財産権",
    mainTitle: "STIPに出会う",
    mainContent1: "<span>STIP</span>は、特許、商標、ドラマ、映画、漫画、フランチャイズ、音楽、<br />ダンスなどデジタルIPの取引を支援する交換プラットフォームです。",
    mainContent2: "企業、研究機関、クリエイター、発明家に<br />IP所有権を移転せずに資金調達の機会を提供します。",
    founder: "鄭賢道",
    founderTitle: "創業者",
    footerSlogan: "IPを共有しよう、IPの時代です",
    companyName: "株式会社アイピーメディアグループ",
    navItems: {
      //main: "メイン",
      listing: "リスト",
      about: "会社概要",
      product: "製品",
      contact: "お問い合わせ"
    }
  },
  zh: {
    pageTitle: "知识产权",
    mainTitle: "认识STIP",
    mainContent1: "<span>STIP</span>是一个支持数字知识产权交易的平台，<br />包括专利、商标、剧集、电影、漫画、特许经营、音乐、<br />舞蹈等。",
    mainContent2: "为企业、研究机构、创作者和发明家提供<br />在不转让知识产权所有权的情况下筹集资金的机会。",
    founder: "郑玄道",
    founderTitle: "创始人",
    footerSlogan: "让我们共享IP，这是IP的时代",
    companyName: "IP媒体集团股份有限公司",
    navItems: {
      //main: "主页",
      listing: "列表",
      about: "关于我们",
      product: "产品",
      contact: "联系我们"
    }
  }
};

// Language change handler
function handleLangChange2(lang, isMobile = false) {
  const currentLang = translations[lang];

  // Update page title
  document.title = currentLang.pageTitle;

  // Update main content
  document.querySelector('.title-area h1').innerHTML = `<span>${currentLang.mainTitle}</span>`;

  const contentArea = document.querySelector('.content-area');
  contentArea.innerHTML = `
    <p>${currentLang.mainContent1}</p>
    <p>${currentLang.mainContent2}</p>
  `;

  // Update founder information
  const bottomArea = document.querySelector('.bottom-area');
  bottomArea.innerHTML = `
    <p>${currentLang.founder}</p>
    <p>${currentLang.founderTitle}</p>
  `;

  // Update footer
  const footerLogo = document.querySelector('.footer-logo');
  footerLogo.innerHTML = `
    <span>${currentLang.footerSlogan}</span>
    <img src="./assets/images/logo.svg" alt="logo" />
  `;

  // Update company name
  document.querySelector('.company-name').textContent = currentLang.companyName;

  // Update navigation items
  const navItems = document.querySelectorAll('.nav-item');
  const mobileNavItems = document.querySelectorAll('.side-bar-item.navigate');

  const navOrder = ['listing', 'about', 'product', 'contact'];

  navItems.forEach((item, index) => {
    item.textContent = currentLang.navItems[navOrder[index]];
    item.href = `${navOrder[index]}.php`;
  });

  mobileNavItems.forEach((item, index) => {
    item.textContent = currentLang.navItems[navOrder[index]];
    item.href = `${navOrder[index]}.php`;
  });

  // Update language dropdown button
  const languageMap = {
    'ko': '한국어',
    'en': 'English',
    'ja': '日本語',
    'zh': '中文'
  };

  const dropdownButton = document.getElementById('dropdownMenuButton1');
  if (dropdownButton) {
    dropdownButton.textContent = languageMap[lang];
  }

  // Language selector in mobile view
  const languageSpans = document.querySelectorAll('.side-bar-list.lang span');
  languageSpans.forEach(span => {
    span.classList.remove('active');
    if (span.classList.contains(lang)) {
      span.classList.add('active');
    }
  });
}

// Initialize with English as default
document.addEventListener('DOMContentLoaded', () => {
  handleLangChange2('en');
});
