<?php
session_start();
require_once("conn.php");
require_once("utils.php");
//輸出該 id 全文
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
          <li><a href="list.php">文章列表</a></li>
          <li><a href="about.php">關於我</a></li>
        </div>
        <div>
        <?php if (!empty($_SESSION['username'])) { ?>
          <li><a href="admin.php">管理後台</a></li>
          <li><a href="logout.php">登出</a></li>
        <?php } else { ?>
          <li><a href="login.php">登入</a></li>
        <?php } ?>
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
    <div class="posts">
      <article class="post">
        <div class="post__header">
          <div>關於 WendyL</div>
        </div>
        <div class="blog__content">
        一個在考古界打滾數年，滾著滾著不小心誤入網頁領域的廢文製造者。<br/>
					在職參與「<a class="blog__link" href="https://bootcamp.lidemy.com/">Lidemy 程式導師實驗計畫第四期</a>」，開始過著白天上班、晚上上課寫作業與偶爾爆炸的生活。<br/>
					擅長在忙碌中尋找生活的平衡，堅持即使很忙也要盡量找時間下廚給自己和家人吃點好吃的，而休閒時間最喜歡的其中一件事是出門散步兼抓寶。</div>
        </div>
      </article>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>