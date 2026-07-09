<?php
// คลาสแม่แบบ Abstract
abstract class ParentClass
{
    // กำหนดคุณสมบัติบังคับคลาสลูก: ต้องมีเมธอด prefixName และต้องรับค่าพารามิเตอร์ ($name) 1 ตัว
    // ระดับการเข้าถึงเริ่มต้นถูกตั้งไว้เป็น protected (เฉพาะในคลาสและคลาสลูกเท่านั้นที่เห็น)
    abstract protected function prefixName($name);
}

// คลาสลูกที่นำโครงสร้างคลาสแม่ไปพัฒนาต่อ
class ChildClass extends ParentClass
{

    // กฎของ OOP: คลาสลูกสามารถเปลี่ยนระดับการเข้าถึงให้ "หลวมขึ้น" หรือเท่าเดิมได้ 
    // ในที่นี้เปลี่ยนจาก protected เป็น public เพื่อให้สามารถเรียกใช้นอกคลาสได้
    public function prefixName($name)
    {
        // ระบบเงื่อนไขสำหรับตรวจสอบค่าที่ส่งเข้ามาเพื่อเติมคำนำหน้าชื่อ (Prefix)
        if ($name == "John Doe") {
            $prefix = "Mr.";
        } elseif ($name == "Jane Doe") {
            $prefix = "Mrs.";
        } else {
            $prefix = "";
        }
        // ส่งค่าคำนำหน้าชื่อรวมกับชื่อจริงกลับออกไป
        return "$prefix $name";
    }
}

// 1. สร้างออบเจกต์จากคลาสลูก
$class = new ChildClass;

// 2. เรียกใช้งานและดูผลลัพธ์
echo $class->prefixName("John Doe"); // ผลลัพธ์: Mr. John Doe
echo "<br>";
echo $class->prefixName("Jane Doe"); // ผลลัพธ์: Mrs. Jane Doe
echo "<br>";
echo $class->prefixName("Baby Doe"); // ผลลัพธ์:  Baby Doe (ไม่มีคำนำหน้าเพราะไม่ตรงเงื่อนไข)
?>