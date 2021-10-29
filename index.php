<?php
session_start();
require_once("conn.php");
require_once("utils.php");

$username = NULL;
if (!empty($_SESSION['username'])) {
  $username = $_SESSION['username'];
}
//每頁顯示 5 篇文章
$page = 1;
if (!empty($_GET['page'])) {
  $page = intval($_GET['page']);
}
$item_per_page = 5;
$offset = ($page - 1) * $item_per_page;

$stmt = $conn->prepare('SELECT * FROM `wendyl_blog_articles` WHERE is_deleted = 0 ORDER BY id DESC limit ? offset ?');
$stmt->bind_param('ii', $item_per_page, $offset);
$result = $stmt->execute();
if (!$result) {
  die('Error:' . $conn->error);
}
$result = $stmt->get_result();
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
    <?php while ($row = $result->fetch_assoc()) { ?>
      <article class="post">
        <div class="post__header">
          <div><?php echo(escape($row['title'])); ?></div>
          <?php if (!empty($_SESSION['username'])) { ?>
          <div class="post__actions">
            <form method="POST" action="edit.php">
              <input type="hidden" name="id" value="<?php echo(escape($row['id']));?>">
              <input type="submit" class="post__action" value="編輯">
            </form>
          </div>
          <?php } ?>
        </div>
        <div class="post__info">
          <?php echo(escape($row['created_at'])); ?>
        </div>
        <div class="post__content" >
          <?php echo(escape($row['content'])); ?>
        </div>
        <form method="POST" action="blog.php">
          <input type="hidden" name="id" value="<?php echo(escape($row['id']));?>">
          <input type="submit" class="btn-read-more" value="READ MORE">
        </form>
      </article>
    <?php } ?>
    </div>
  </div>
  <?php
  $stmt = $conn->prepare('SELECT count(id) as count FROM `wendyl_blog_articles` WHERE is_deleted = 0');
  $result = $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $total_page = ceil($row['count'] / $item_per_page);
  ?>
  <div class="paginator">
    <?php if ($page != 1) { ?>
      <a href="index.php?page=1" class="paginator__list">首頁</a>
      <a href="index.php?page=<?php echo($page - 1) ?>" class="paginator__list" >上一頁</a>
    <?php } ?>
    <?php if ($page != $total_page) { ?>
      <a href="index.php?page=<?php echo($page + 1) ?>" class="paginator__list" >下一頁</a>
      <a href="index.php?page=<?php echo $total_page ?>" class="paginator__list" >尾頁</a>
    <?php } ?>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>