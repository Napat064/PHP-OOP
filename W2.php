<?php
// สร้างคลาส (Class) ชื่อ Fruit เพื่อเป็นแม่พิมพ์สำหรับสร้างวัตถุประเภทผลไม้
class Fruit
{
    // คุณสมบัติ (Properties) หรือตัวแปรภายในคลาส
    public $name;
    public $color;

    // คอนสตรักเตอร์ (Constructor) เมธอดที่จะทำงานอัตโนมัติทันทีเมื่อมีการสร้างวัตถุ (new)
    function __construct($name, $color)
    {
        $this->name = $name;   // กำหนดค่าชื่อผลไม้ให้กับคลาส
        $this->color = $color; // 定กำหนดค่าสีผลไม้ให้กับคลาส
    }

    // เมธอด (Method) หรือฟังก์ชันสำหรับแสดงข้อมูลรายละเอียดของผลไม้
    function get_details()
    {
        echo "Name: " . $this->name . ". Color: " . $this->color . ".<br>";
    }
}

// การสร้างวัตถุ (Object) ตัวที่ 1: แอปเปิ้ล
$apple = new Fruit('Apple', 'Red'); // ส่งค่า 'Apple' และ 'Red' เข้าไปที่ __construct
$apple->get_details();              // เรียกใช้เมธอดเพื่อแสดงผล (ผลลัพธ์: Name: Apple. Color: Red.)

// การสร้างวัตถุ (Object) ตัวที่ 2: กล้วย
$banana = new Fruit('Banana', 'Yellow'); // ส่งค่า 'Banana' และ 'Yellow' เข้าไปที่ __construct
$banana->get_details();                  // เรียกใช้เมธอดเพื่อแสดงผล (ผลลัพธ์: Name: Banana. Color: Yellow.)
?>