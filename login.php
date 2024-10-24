<?php
session_start(); // เริ่มเซสชัน
if (isset($_SESSION['username'])) {
    header("Location: menu.php"); // ถ้าล็อกอินแล้วให้ไปที่หน้าเมนู
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>เข้าสู่ระบบ</title>
</head>
<body>
    <div class="login-container">
        <h2>เข้าสู่ระบบ</h2>
        <form action="login_process.php" method="POST">
            <label for="username">ชื่อผู้ใช้งาน:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">รหัสผ่าน:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">เข้าสู่ระบบ</button>
        </form>
    </div>
</body>
</html>
