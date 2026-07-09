<?php
// คลาสแม่ (Parent class หรือ Base class)
class Fruit
{
    // คุณสมบัติที่คลาสแม่มี และจะถูกส่งต่อให้คลาสลูกด้วย
    public $name;
    public $color;

    // คอนสตรักเตอร์ของคลาสแม่สำหรับรับค่าเริ่มต้น
    public function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    // เมธอดแนะนำตัวของคลาสแม่
    public function intro()
    {
        echo "The fruit is $this->name and the color is $this->color.<br>";
    }
}

// คลาสลูก (Child class) ชื่อ Strawberry ทำการสืบทอด (extends) มาจาก Fruit
// ทำให้ Strawberry ได้รับ $name, $color, __construct() และ intro() มาใช้งานโดยอัตโนมัติ
class Strawberry extends Fruit
{
    // เมธอดเฉพาะตัวของคลาส Strawberry เอง (คลาสแม่จะไม่มีเมธอดนี้)
    public function message()
    {
        echo "Am I a fruit or a berry? ";
    }
}

// สร้างออบเจกต์จากคลาสลูก (Strawberry) 
// โดยส่งค่าเข้าไปที่ __construct() ของคลาสแม่ที่สืบทอดมา
$strawberry = new Strawberry("Strawberry", "red");

// เรียกใช้เมธอด intro() ของคลาสแม่ (สืบทอดมาใช้งานได้เลย)
$strawberry->intro();   // ผลลัพธ์: The fruit is Strawberry and the color is red.

// เรียกใช้เมธอด message() ของตัวเอง
$strawberry->message(); // ผลลัพธ์: Am I a fruit or a berry? 
?>