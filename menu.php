<?php
session_start(); // เริ่มเซสชัน
include 'conn.php'; // เชื่อมต่อฐานข้อมูล

// สมมติว่าชื่อผู้ใช้งานถูกเก็บในเซสชัน
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'ผู้ใช้งาน'; // เปลี่ยน 'ผู้ใช้งาน' เป็นค่าปริยายถ้าไม่มี

// ตรวจสอบการคลิกออกจากระบบ
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy(); // ทำลายเซสชัน
    header("Location: login.php"); // เปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบ
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
    <title>เมนูระบบ POS</title>
</head>
<body>
    <div class="header-container">
        <div class="username">ยินดีต้อนรับ, <?php echo htmlspecialchars($username); ?></div> <!-- แสดงชื่อผู้ใช้งาน -->
        <div class="datetime" id="datetime"></div> <!-- แสดงวันที่และเวลา -->
    </div>
    <div class="menu-container">
        <?php
        // ดึงข้อมูลเมนู
        $sql = "SELECT menu_name, menu_link, icon FROM menus";
        $stmt = $pdo->query($sql);
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($menus as $menu): ?>
            <a href="<?php echo htmlspecialchars($menu['menu_link']); ?>" class="menu-box">
                <i class="<?php echo htmlspecialchars($menu['icon']); ?>"></i>
                <span><?php echo htmlspecialchars($menu['menu_name']); ?></span>
            </a>
        <?php endforeach; ?>
    </div>
    
    <script>
        function updateDateTime() {
            const now = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            document.getElementById('datetime').textContent = now.toLocaleString('th-TH', options);
        }

        setInterval(updateDateTime, 1000); // อัปเดตทุกวินาที
        updateDateTime(); // เรียกใช้ฟังก์ชันทันที
    </script>
</body>
</html>
