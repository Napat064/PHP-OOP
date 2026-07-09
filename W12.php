<?php
// คลาสแม่แบบ Abstract
abstract class ParentClass
{
    // บังคับว่าคลาสลูกต้องมีพารามิเตอร์ $name อย่างน้อย 1 ตัว
    abstract protected function prefixName($name);
}

// คลาสลูกที่นำมาพัฒนาต่อ
class ChildClass extends ParentClass
{

    // กฎของ PHP OOP: คลาสลูกสามารถเพิ่มพารามิเตอร์เสริมเข้าไปได้ (ในที่นี้คือ $separator และ $greet)
    // แต่พารามิเตอร์ที่เพิ่มเข้ามา "ต้องกำหนดค่าเริ่มต้นไว้เสมอ" (Optional Arguments) เพื่อไม่ให้ขัดกับกฎของคลาสแม่
    public function prefixName($name, $separator = ".", $greet = "Dear")
    {
        if ($name == "John Doe") {
            $prefix = "Mr";
        } elseif ($name == "Jane Doe") {
            $prefix = "Mrs";
        } else {
            $prefix = "";
        }
        // ส่งค่ากลับโดยนำคำทักทาย ($greet), คำนำหน้า ($prefix), ตัวคั่น ($separator) และชื่อจริงมาร้อยต่อกัน
        return "$greet $prefix$separator $name";
    }
}

// 1. สร้างออบเจกต์จากคลาสลูก
$class = new ChildClass;

// 2. เรียกใช้งานแบบไม่ส่งพารามิเตอร์เสริม (ระบบจะใช้ค่าเริ่มต้น . และ Dear อัตโนมัติ)
echo $class->prefixName("John Doe"); // ผลลัพธ์: Dear Mr. John Doe
echo "<br>";
echo $class->prefixName("Jane Doe"); // ผลลัพธ์: Dear Mrs. Jane Doe
?>