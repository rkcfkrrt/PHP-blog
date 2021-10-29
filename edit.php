<?php
session_start();
require_once("conn.php");
require_once("utils.php");
//確認身分
if (empty($_SESSION['username'])) {
  header('Location: index.php');
  die();
}

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
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
          <li><a href="admin.php">管理後台</a></li>
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
      <div class="edit-post">
        <form method="POST" action="handle_edit.php">
          <input type="hidden" name="id" value="<?php echo(escape($id));?>">
          <div class="edit-post__title">
            編輯文章：
          </div>
          <div class="edit-post__input-wrapper">
            <input class="edit-post__input" name="title" value="<?php echo(escape($row['title']));?>" />
          </div>
          <div class="edit-post__input-wrapper">
            <textarea rows="20" class="edit-post__content" name="content"><?php echo(escape($row['content']));?></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
            <input type="submit" class="edit-post__btn" value="送出">
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>