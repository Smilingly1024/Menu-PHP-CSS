<?php
include 'conn.php'; // เชื่อมต่อฐานข้อมูล
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน

    // เพิ่มผู้ใช้งานใหม่ลงในฐานข้อมูล
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    
    if ($stmt->execute()) {
        echo "ลงทะเบียนสำเร็จ! คุณสามารถเข้าสู่ระบบได้"; // แจ้งเตือนเมื่อสมัครสมาชิกสำเร็จ
    } else {
        echo "เกิดข้อผิดพลาดในการลงทะเบียน"; // แจ้งเตือนหากมีข้อผิดพลาด
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>ลงทะเบียน</title>
</head>
<body>
    <div class="register-container">
        <h2>ลงทะเบียน</h2>
        <form action="" method="POST">
            <label for="username">ชื่อผู้ใช้งาน:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">รหัสผ่าน:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">ลงทะเบียน</button>
        </form>
    </div>
</body>
</html>
