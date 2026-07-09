<?php
// คลาสแม่แบบ Abstract (ไม่สามารถนำไปสร้างเป็นออบเจกต์ตรงๆ ได้ เช่น new Car() จะเอิร์เรอร์)
abstract class Car
{
    // คุณสมบัติทั่วไปที่คลาสลูกจะได้รับไป
    public $name;

    // เมธอดทั่วไป (Non-abstract method) มีการเขียนโค้ดทำงานไว้ปกติ คลาสลูกสืบทอดไปใช้ได้เลย
    public function __construct($name)
    {
        $this->name = $name;
    }

    // เมธอด Abstract (ไม่มีปีกกาโค้ดข้างใน) 
    // ทำหน้าที่เป็น "กฎเหล็ก" บังคับว่า คลาสลูกทุกคลาสที่สืบทอดไป "ต้อง" เขียนโค้ดในเมธอด intro() นี้ด้วยตัวเอง
    abstract public function intro();
}

// คลาสลูก Audi สืบทอดมาจาก Car
class Audi extends Car
{
    // ต้องสร้างเมธอด intro() ตามกฎของคลาสแม่ (ถ้าไม่สร้างจะเกิด Error)
    public function intro()
    {
        return "German quality! I'm an $this->name!";
    }
}

// คลาสลูก Citroen สืบทอดมาจาก Car
class Citroen extends Car
{
    // ต้องสร้างเมธอด intro() เช่นกัน แต่สามารถกำหนดการทำงานในสไตล์ของตัวเองได้
    public function intro()
    {
        return "French extravagance! I'm a $this->name!";
    }
}

// สร้างออบเจกต์จากคลาสลูก Audi
$audi = new audi("Audi");
echo $audi->intro(); // ผลลัพธ์: German quality! I'm an Audi!
echo "<br>";

// สร้างออบเจกต์จากคลาสลูก Citroen
$citroen = new citroen("Citroen");
echo $citroen->intro(); // ผลลัพธ์: French extravagance! I'm a Citroen!
?>