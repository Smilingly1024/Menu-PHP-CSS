<?php
session_start();
include 'conn.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ค้นหาผู้ใช้งานในฐานข้อมูล
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบรหัสผ่าน
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username']; // เก็บชื่อผู้ใช้งานในเซสชัน
        header("Location: menu.php"); // เปลี่ยนเส้นทางไปยังหน้าเมนู
        exit();
    } else {
        echo "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง"; // แจ้งเตือนหากล็อกอินไม่สำเร็จ
    }
}
?>
