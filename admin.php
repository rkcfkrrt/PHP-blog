<?php
session_start();
require_once("conn.php");
require_once("utils.php");
//確認身分
if (empty($_SESSION['username'])) {
  header('Location: index.php');
  die();
}

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
          <li><a href="add_post.php">新增文章</a></li>
          <li><a href="logout.php">登出</a></li>
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
            <form method="POST" action="edit.php">
              <input type="hidden" name="id" value="<?php echo(escape($row['id']));?>">
              <input type="submit" class="admin-post__btn" value="編輯">
            </form>
            <form method="POST" action="delete.php">
              <input type="hidden" name="id" value="<?php echo(escape($row['id']));?>">
              <input type="submit" class="admin-post__btn" value="刪除">
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