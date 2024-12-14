<?php
session_start();
session_unset(); // ลบค่าทั้งหมดในเซสชัน
session_destroy(); // ทำลายเซสชัน

header("Location: login.php"); // เปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบ
exit;
?>