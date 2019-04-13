<?php
include_once "posts.php";
insertPost($_POST['title'], $_POST['body']);
header('Location: index.php');
exit();
?>
