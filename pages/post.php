<?php
require '../db/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
} else {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scss/post.css">
    <title><?php echo $post['title']; ?></title>
</head>
<body>
    <header>
        <?php include '../includes/header.php'; ?>
    </header>

    <main>
        <div class="post-content">
            <h1><?php echo $post['title']; ?></h1>
            <span><?php echo $post['username']; ?> | <?php echo $post['date_created']; ?></span>
            <p><?php echo $post['content']; ?></p>
        </div>
    </main>

    <footer>
        <?php include '../includes/footer.php'; ?>
    </footer>
</body>
</html>
