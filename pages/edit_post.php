<?php
require '../db/connection.php';

$id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

//以下程式碼為點擊UPDATE做更新 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=?, category=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $content, $category, $id);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<link rel="stylesheet" href="../scss/edit.css">
<?php include '../includes/header.php'; ?>

<main class="edit-page">
    <form id="edit-form" method="post">
        <input type="hidden" name="id" id="edit-id" value="<?php echo $id; ?>">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="edit-title" value="<?php echo $row['title']; ?>">
        </div>
        <div>
            <label for="content">Content</label>
            <input type="text" name="content" id="edit-content" value="<?php echo $row['content']; ?>"></input>
        </div>
        <div>
            <label for="category">Category</label>
            <input type="text" name="category" id="edit-category" value="<?php echo $row['category']; ?>">
        </div>
        <button type="submit">Update</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
