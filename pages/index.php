<?php require '../db/connection.php'; ?>

<!DOCTYPE html>
<html lang="zh-hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scss/index.css">
    <title>Blog</title>
</head>
<body>
    <header>
        <?php include '../includes/header.php'; ?>
    </header>

    <main>
        <?php
            $query = "SELECT posts.*, users.username 
            FROM posts JOIN users 
            ON posts.user_id = users.id 
            ORDER BY date_created DESC";
  
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="posts-list">';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="post-item">';
                    echo '<a href="post.php?id=' . $row['id'] . '"><h2>' . $row['title'] . '</h2></a>';
                    echo '<p>' . substr($row['content'], 0, 100);
                    echo '<a href="post.php?id=' . $row['id'] . '"> ...查看更多</a></p>'; // Show first 100 characters as a summary
                    echo '<span>' . $row['username'] . ' | ' . $row['date_created'] . '</span>';  // Display username
                    echo '</div>';
                    echo '<hr>';
                }
                echo '</div>';
            } else {
                echo '<p>No posts found.</p>';
            }
        ?>
    </main>

    <footer>
        <?php include '../includes/footer.php'; ?>
    </footer>
</body>
</html>
