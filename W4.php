<?php
// สร้างคลาส (Class) ชื่อ Fruit
class Fruit
{
    // กำหนดคุณสมบัติเป็น public หมายถึง "สามารถเข้าถึงหรือแก้ไขค่าจากภายนอกคลาสได้โดยตรง"
    public $name;

    // เมธอด (Method) สำหรับแสดงรายละเอียด
    public function get_details()
    {
        echo "Name: " . $this->name . ".";
    }
}

// 1. สร้างออบเจกต์ (Object) ใหม่จากคลาส Fruit
$apple = new Fruit();

// 2. กำหนดค่าให้กับตัวแปร $name ได้ทันทีจากภายนอกคลาส (เพราะเป็น public)
$apple->name = "Apple";

// 3. เรียกใช้งานเมธอดเพื่อแสดงผล (ผลลัพธ์: Name: Apple.)
$apple->get_details();
?>