<?php
session_start();
require_once("conn.php");
require_once("utils.php");
//輸出該 id 全文
$id = $_POST['id'];
$stmt = $conn->prepare('SELECT * FROM `wendyl_blog_articles` WHERE id = ?');
$stmt->bind_param('i', $id);
$result = $stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
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
          <div><?php echo(escape($row['title']));?></div>
          <?php if (!empty($_SESSION['username'])) { ?>
            <div class="post__actions">
              <form method="POST" action="edit.php">
                <input type="hidden" name="id" value="<?php echo(escape($row['id']));?>">
                <input type="submit" class="admin-post__btn" value="編輯">
              </form>
            </div>
          <?php } ?>
        </div>
        <div class="post__info">
          <?php echo escape($row['created_at']);?>
        </div>
        <div class="blog__content"><?php echo(escape($row['content']));?></div>
      </article>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>