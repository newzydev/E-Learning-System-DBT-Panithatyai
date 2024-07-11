<?php
// เชื่อมต่อฐานข้อมูล
// $conn = mysqli_connect("localhost", "root", "", "dbt_2564") or die("เกิดข้อผิดพลาดเกิดขึ้น ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
$conn = mysqli_connect("localhost", "cp009141_dbt", "Sakdar39814", "cp009141_dbtdate") or die("เกิดข้อผิดพลาดเกิดขึ้น ไม่สามารถเชื่อมต่อฐานข้อมูลได้ T-T");
$conn->set_charset("utf8");

// ดึงข้อมูลจากฐานข้อมูล
$server_query = "SELECT * FROM tbl_server_db";
$result = mysqli_query($conn, $server_query);
$server = mysqli_fetch_assoc($result);

// วัน/เดือน/ปี ภาษาไทย
function datetime()
{
    // เดือนภาษาไทย
    $ThaiMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

    // กำหนดคุณสมบัติ
    $months = date("m") - 1; // ค่าเดือน (1-12)
    $day = date("d"); // ค่าวันที่(1-31)
    $years = date("Y") + 543; // ค่า ค.ศ.บวก 543 ทำให้เป็น พ.ศ.

    return "$day $ThaiMonth[$months] $years";
}
$cr_years = date("Y");

// Generating Random
date_default_timezone_set('Asia/Bangkok');
$date1 = date("Ymd_His");
$numrand = (mt_rand());

$n = 10;
function getName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
?>