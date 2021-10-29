<?php
session_start();
require_once("conn.php");
//確認身分
if (empty($_SESSION['username'])) {
  header('Location: index.php');
  die();
}

?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php'>Who's Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="#">文章列表</a></li>
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
          <li><a href="admin.php">管理後台</a></li>
          <li><a href="#">登出</a></li>
        </div>
      </ul>
    </div>
  </nav>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form id="add_post" method="POST" action="handle_add_post.php" onSubmit="return checkForm(this);">
          <div class="edit-post__title">
            新增文章：
          </div>
          <div class="edit-post__input-wrapper">
            <input class="edit-post__input" id="title" name="title" placeholder="請輸入標題" />
          </div>
          <div class="edit-post__input-wrapper">
            <textarea rows="20" class="edit-post__content" id="content" name="content" placeholder="請輸入文章內容"></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
            <input type="submit" class="edit-post__btn" value="送出">
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
  <script>
    function checkForm() {
    var post = document.forms["add_post"];
    if (!post.title.value) {
      alert("Error: 標題填寫不完全");
      return false;
    } else if (!post.content.value) {
      alert("Error: 文章內容填寫不完全");
      return false;
    } else {
      return true;
    }
  }
  </script>
</body>
</html>