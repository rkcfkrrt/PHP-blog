<?php
session_start();
require_once("conn.php");

$title = $_POST['title'];
$content = $_POST['content'];
//新增文章
$stmt = $conn->prepare('INSERT INTO `wendyl_blog_articles` (`title`, `content`) VALUES (?, ?)');
$stmt->bind_param('ss', $title, $content);
$result = $stmt->execute();

if ($result) {
  //成功
  header('Location: admin.php');
  exit();
} else {
  header('Location: add_post.php?errCode=1');
  die();
}

?>