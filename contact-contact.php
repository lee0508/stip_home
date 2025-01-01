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
      <div class="contact-wrapper contact">
        <div class="title-wrapper">
          <h1 class="letter-title">
            <span> Contact </span>
          </h1>
          <span>Talk to our team about<br />
            your enterprise needs.</span>
        </div>
        <div class="radius-box form">
          <form>
            <div class="row-area">
              <div class="input-box">
                <label class="required" for="firstName">First Name</label>
                <input
                  type="text"
                  id="firstName"
                  name="firstName"
                  placeholder="이름을 입력해주세요." />
              </div>
              <div class="input-box">
                <label class="required" for="lastName">Last Name</label>
                <input
                  type="text"
                  id="lastName"
                  name="lastName"
                  placeholder="성을 입력해주세요." />
              </div>
            </div>
            <div class="row-area">
              <div class="input-box">
                <label class="required" for="company">Company</label>
                <input
                  type="text"
                  id="company"
                  name="company"
                  placeholder="회사를 입력해주세요." />
              </div>
              <div class="input-box">
                <label class="required" for="jobTitle">Job Title</label>
                <input
                  type="text"
                  id="jobTitle"
                  name="jobTitle"
                  placeholder="직함을 입력해주세요." />
              </div>
            </div>
            <div class="row-area">
              <div class="input-box">
                <label class="required" for="mobile">Mobile</label>
                <input
                  type="text"
                  id="mobile"
                  name="mobile"
                  placeholder="연락처를 입력해주세요." />
              </div>
              <div class="input-box">
                <label class="required" for="country">Country</label>
                <input
                  type="text"
                  id="country"
                  name="country"
                  placeholder="국가를 입력해주세요." />
              </div>
            </div>
            <div class="row-area">
              <div class="input-box">
                <label class="required" for="email">Email</label>
                <input
                  type="text"
                  id="email"
                  name="email"
                  placeholder="메일을 입력해주세요." />
              </div>
              <div class="input-box">
                <label class="required">Subject</label>
                <div class="select-box">
                  <div class="box-area empty">
                    <span class="selected-item">Subject</span>
                    <img
                      src="assets/images/arrow-down.svg"
                      alt="arrow-down" />
                  </div>
                  <ul class="box-list">
                    <li>
                      <div class="select-item" aria-label="Listing">
                        Listing
                      </div>
                    </li>
                    <li>
                      <div class="select-item" aria-label="Media Press">
                        Media Press
                      </div>
                    </li>
                    <li>
                      <div class="select-item" aria-label="Collaboration">
                        Collaboration
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="input-box textarea">
              <label class="required" for="message">How can we help?</label>
              <textarea
                id="message"
                name="message"
                placeholder="귀하의 비즈니스에 필요한 것에 대해 입력해주세요."></textarea>
            </div>
            <button class="normal-button">Contact</button>
          </form>
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
    const selectBox = document.querySelector(".select-box");
    const boxArea = selectBox.querySelector(".box-area");
    const selectedBox = boxArea.querySelector(".selected-item");
    const dropdown = selectBox.querySelector("ul");
    const dropdownItems = dropdown.querySelectorAll(".select-item");

    boxArea.addEventListener("click", () => {
      dropdown.classList.toggle("active");
      selectBox.classList.toggle("active");
    });

    dropdown.addEventListener("click", (e) => {
      const item = e.target.closest(".select-item");
      if (!item) return;
      boxArea.classList.remove("empty");
      selectedBox.innerHTML = item.innerHTML;
      dropdown.classList.remove("active");
      selectBox.classList.remove("active");
    });
  </script>
  <script src="./components/header.js" defer></script>
</body>

</html>