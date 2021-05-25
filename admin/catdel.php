<?php
    require 'config/config.php';
  $stmt = $pdo->prepare("DELETE FROM catagories WHERE id=".$_GET['id']);
  $stmt->execute();
  header("location:index.php");

 ?>
