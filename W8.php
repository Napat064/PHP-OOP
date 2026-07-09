<?php
// สร้างคลาสชื่อ Goodbye
class Goodbye
{
    // กำหนดค่าคงที่ (Constant) ประจำคลาส
    const MESSAGE = "Thank you for visiting W3Schools.com!";

    // เมธอดทั่วไปภายในคลาส
    public function bye()
    {
        // การเรียกใช้ค่าคงที่จาก "ภายในคลาสตัวเอง" จะใช้คำว่า self ตามด้วยเครื่องหมาย ::
        // (self:: หมายถึง คลาสนี้ที่เป็นวิกาลปัจจุบัน ต่างจาก $this-> ที่ใช้เรียกตัวแปรหรือเมธอดทั่วไป)
        echo self::MESSAGE;
    }
}

// 1. สร้างออบเจกต์ขึ้นมาจากคลาส Goodbye
$goodbye = new Goodbye();

// 2. เรียกใช้งานเมธอด bye() ของออบเจกต์
// ผลลัพธ์: เมธอดจะไปดึงเอาค่าจาก self::MESSAGE มาแสดงผล (Thank you for visiting W3Schools.com!)
$goodbye->bye();
?>