<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" type="" href="assets/style/components/header.css" />
  <link rel="stylesheet" href="assets/style/pages/contact.css" />
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
</head>

<body>
  <div class="root">
    <?php include("./header.php"); ?>

    <!-- header end -->
    <div class="bg-image">
      <img src="assets/images/bg-image.jpg" alt="bg-image" />
    </div>
    <div class="bg-mobile-image">
      <img src="assets/images/light-bg-image.png" alt="bg-mobile-image" />
    </div>
    <main class="content-container">
      <div class="contact-wrapper">
        <div class="title-wrapper">
          <h1 class="letter-title">
            <span>Community</span>
          </h1>
          <span>Talk to our team about<br />
            your enterprise needs.</span>
        </div>
        <div class="row-wrapper">
          <div class="radius-box community">
            <div class="top-content-area">
              <h6>Community<br />support</h6>
              <span>
                Talk to our team about<br />
                your enterprise needs.
              </span>
            </div>
            <div class="social-link-list">
              <div class="link-box">
                <a href="#">
                  <img src="assets/images/linkedIn.png" alt="" />
                </a>
              </div>
              <div class="link-box">
                <a href="#">
                  <img src="assets/images/youtube.png" alt="" />
                </a>
              </div>
              <div class="link-box">
                <a href="#">
                  <img src="assets/images/twitterX.png" alt="" />
                </a>
              </div>
              <div class="link-box">
                <a href="#">
                  <img src="assets/images/telegram.png" alt="" />
                </a>
              </div>
            </div>
          </div>
          <div class="radius-box community">
            <div class="top-content-area">
              <h6>
                Listing<br />
                support
              </h6>
              <span>
                Get help with your project<br />from the Community
              </span>
            </div>
            <button class="normal-button">
              <span>Start chat</span>
            </button>
          </div>
        </div>
      </div>
    </main>
    <!-- footer start -->
    <?php include("./footer.php"); ?>
    <!-- footer end -->
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      fetch("./header.php")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("header-placeholder").innerHTML = data;
        });
    });
  </script>
  <script src="./components/header.js" defer></script>
</body>

</html>