<?php
  require 'config/config.php';
  $stmt = $pdo->prepare("DELETE FROM user WHERE id =".$_GET['id']);
  $stmt->execute();
  header("Location:userlist.php");


 ?>
