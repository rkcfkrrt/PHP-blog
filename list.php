<?php
session_start();
require_once("conn.php");
require_once("utils.php");
//列出所有文章
$sql = 'SELECT * FROM `wendyl_blog_articles` WHERE is_deleted = 0 ORDER BY id DESC';
$result = $conn->query($sql);
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
    <div class="container">
      <div class="admin-posts">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="admin-post">
          <div class="admin-post__title">
              <?php echo(escape($row['title'])); ?>
          </div>
          <div class="admin-post__info">
            <div class="admin-post__created-at">
            <?php echo(escape($row['created_at'])); ?>
            </div>
            <form method="POST" action="blog.php">
              <input type="hidden" name="id" value="<?php echo(escape($row['id']));?>">
              <input type="submit" class="btn-read-more" value="READ MORE">
            </form>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>