<?php
// สร้างคลาสชื่อ Goodbye
class Goodbye
{
    // กำหนดค่าคงที่ (Constant) ภายในคลาสด้วยคำสั่ง const 
    // ค่าคงที่จะไม่สามารถเปลี่ยนแปลงค่าได้หลังจากกำหนดไว้แล้ว และเป็นเคสตัวพิมพ์ใหญ่ทั้งหมด (ตามธรรมเนียม)
    const MESSAGE = "Thank you for visiting W3Schools.com!";
}

// วิธีเข้าถึงค่าคงที่จากภายนอกคลาส: ใช้ "ชื่อคลาส" ตามด้วยเครื่องหมาย Scope Resolution Operator (::)
// ข้อดี: ไม่ต้องเขียน $goodbye = new Goodbye(); ให้เปลืองหน่วยความจำ สามารถดึงค่ามาใช้ได้ทันที
echo Goodbye::MESSAGE; // ผลลัพธ์: Thank you for visiting W3Schools.com!
?>