<?php
// 連接到資料庫
require '../db/connection.php';

session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit();
}

$user = $_SESSION['user_id'];

// 查詢所有文章
$query = "SELECT * FROM posts WHERE user_id = $user ORDER BY date_created DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<link rel="stylesheet" href="../scss/header.css">
<link rel="stylesheet" href="../scss/dashboard.css">

<?php include '../includes/header.php'; ?>

<main class="dashboard">
  <h1>Dashboard</h1>
  <div class="post-controls">
    <a href="create_post.php" class="create-post-button">Create New Post</a>
  </div>
  <?php
  // 列出所有文章供編輯或刪除
  if (mysqli_num_rows($result) > 0) {
    echo '<hr>';
    echo '<ul class="posts-list">';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<li>';
      echo '<a href="post.php?id=' . $row['id'] . '"><h2>' . $row['title'] . '</h2></a>';
      echo $row['date_created'] . '<br>';
      echo '<a href="edit_post.php?id=' . $row['id'] . '">Edit</a>';
      echo ' | ';
      echo '<a href="delete_post.php?id=' . $row['id'] . '">Delete</a>';
      echo '</li>';
      echo '<hr>';
    }
    echo '</ul>';
  } else {
    echo '<p>No posts found.</p>';
  }
  ?>
</main>

<?php include '../includes/footer.php'; ?>
