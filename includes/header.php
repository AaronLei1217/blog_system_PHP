<!DOCTYPE html>
<link rel="stylesheet" href="../scss/header.css">
<header>
    <div id="header">
        <h1>Welcome to My Blog</h1>
        <nav>
            <a href="index.php">Home</a> |
            <a href="login.php">Login</a> |
            <a href="register.php">Register</a> |
            <a href="dashboard.php">Dashboard</a> |
            <a href="logout.php">Logout</a>
            <?php 
                // 確認SESSION狀態
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                // 確認登入狀態
                if(isset($_SESSION['username'])){
                   echo '<br>Hi '. $_SESSION['username']; 
                }else{
                    echo '<br>please login';
                }
            ?>
        </nav>
    </div>
</header>
