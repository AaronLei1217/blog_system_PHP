<?php
require 'db/connection.php';

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM posts WHERE id=$id";
  
  if (mysqli_query($connection, $sql)) {
    header("Location: dashboard.php");
  } else {
    echo "Error deleting record: " . mysqli_error($connection);
  }
}
?>
