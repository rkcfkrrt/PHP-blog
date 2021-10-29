<?php
session_start();
require_once("conn.php");
//登入
//確認帳號密碼有無輸入
if (empty($_POST['username']) || empty($_POST['password'])) {
  header('Location: login.php?errCode=1');
  die();
}

$username = $_POST['username'];
$password = $_POST['password'];
//檢查有無符合的 username
$sql = "SELECT * FROM `wendyl_blog_users` WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$result = $stmt->execute();
if(!$result) {
  die($conn->error);
}
$result = $stmt->get_result();
if ($result->num_rows === 0) {
  header('Location: login.php?errCode=1');
  die();
}
//檢查密碼
$row = $result->fetch_assoc();
if (password_verify($password, $row['password'])) {
  //成功
  $_SESSION['username'] = $username;
  header('Location: index.php');
  exit();
} else {
  header('Location: login.php?errCode=1');
  exit();
}
?>