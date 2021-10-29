<?php
session_start();
require_once("conn.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
//編輯文章
$stmt = $conn->prepare('UPDATE `wendyl_blog_articles` SET title = ?, content = ? WHERE id = ?');
$stmt->bind_param('ssi', $title, $content, $id);
$result = $stmt->execute();

if ($result) {
  //成功
  header('Location: admin.php');
  exit();
} else {
  header('Location: edit.php?errCode=1');
  die();
}

?>