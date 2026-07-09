<?php
class Fruit
{
    // คุณสมบัติ (Properties หรือตัวแปรภายในคลาส)
    public $name;
    public $color;

    // เมธอดสำหรับกำหนดค่าให้กับคุณสมบัติ (Method to set the properties)
    function set_details($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    // เมธอดสำหรับแสดงค่าของคุณสมบัติออกทางหน้าจอ (Method to display the properties)
    function get_details()
    {
        echo "Name: " . $this->name . ". Color: " . $this->color . ".<br>";
    }
}
?>