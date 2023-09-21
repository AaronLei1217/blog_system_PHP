<?php
include '../db/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id FROM users 
              WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    // 帳號密碼驗證
    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['username'] = $username;
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        header('Location: index.php');
        exit;
    } else {
        echo "Invalid login credentials";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../scss/login.css">
</head>
<body>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
        <a href=register.php>Register</a>
    </form>
</body>
</html>
