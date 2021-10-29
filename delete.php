<?php
session_start();
require_once("conn.php");

$id = $_POST['id'];

$stmt = $conn->prepare('UPDATE `wendyl_blog_articles` SET is_deleted = 1 WHERE id = ?');
$stmt->bind_param('i', $id);
$result = $stmt->execute();

if ($result) {
  //成功
  header('Location: admin.php');
  exit();
} else {
  header('Location: admin.php?errCode=1');
  die();
}

?>