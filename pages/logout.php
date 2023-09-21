<?php
// 啟動 session
session_start();

// 銷毀所有 session 變數
session_destroy();

// 或者，也可以用 unset() 函數銷毀單個 session 變數
// unset($_SESSION['user_id']);

// 重新導向到登入頁面（或任何您希望用戶登出後看到的頁面）
header("Location: index.php");
exit();
?>
