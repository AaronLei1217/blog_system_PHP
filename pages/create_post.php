<?php
// 連接到資料庫
require '../db/connection.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];  // 當前登入使用者的ID

    $query = "INSERT INTO posts (title, content, user_id, date_created) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $title, $content, $user_id);
    $stmt->execute();

    header('Location: dashboard.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="zh-hant">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../scss/create_post.css">
    <title>Create New Post</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <form action="create_post.php" method="post">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
            
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="4" required></textarea>
            
            <input type="submit" value="Create">
        </form>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
