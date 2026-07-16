<?php
$host = 'localhost';
$db = 'food_db';
$user = 'root';
$pass = ''; // ปรับเปลี่ยนตามรหัสผ่านของคุณ
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // แก้ไข: ใช้เฉพาะ $e->getMessage() เพื่อแสดงข้อผิดพลาด หรือเปลี่ยนเป็น die() เพื่อหยุดการทำงานอย่างปลอดภัย
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage());
}
?>