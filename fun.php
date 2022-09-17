<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function getUserName($conn,$uid) {
	$sql = "SELECT username FROM  `users` WHERE  `uid`= '$uid'";
	$result=mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($result);
	return $row['username'];
}
function getUserpic($conn,$uid) {
	$sql = "SELECT propic FROM  `users` WHERE  `uid`= '$uid'";
	$result=mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($result);
	return $row['propic'];
}
?>