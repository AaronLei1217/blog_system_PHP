<?php
include '../db/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $query = "INSERT INTO users (username, password, email) 
              VALUES ('$username', '$password', '$email')";
    if ($conn->query($query) === TRUE) {
        echo "Registration successful";
        header('Location: login.php');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
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
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <label for="email">Email:</label>
        <input type="email" name="email">
        <button type="submit">Register</button>
    </form>
</body>
</html>
