<?php
require_once('../server.php');
session_start();

// โปรใฟล์
include('php/profile.php');

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$url = $_GET['url'];
$cs_time_edit = datetime();

// เพิ่มข้อมูล
if (isset($_REQUEST['btn_add'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร ส่วนรายละเอียด
    $cs_url = $url;
    $unit_url = getName($n);
    $unit_number = $_POST["unit_number"];
    $unit_name = $_POST["unit_name"];

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร ส่วนเนื้อหาหลักสูตร
    $unit_item_name_item = $_POST["unit_item_name_item"];
    $unit_item_detail_item = $_POST["unit_item_detail_item"];

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร ส่วนแบบทดสอบ
    $qut_1 = $_POST["qut_1"]; // แบทดสอบข้อที่ 1
    $opt_1_1 = $_POST["opt_1_1"]; // ตัวเลือก (ก.)
    $opt_1_2 = $_POST["opt_1_2"]; // ตัวเลือก (ข.)
    $opt_1_3 = $_POST["opt_1_3"]; // ตัวเลือก (ค.)
    $opt_1_4 = $_POST["opt_1_4"]; // ตัวเลือก (ง.)
    $opt_1_5 = $_POST["opt_1_5"]; // ตัวเลือก (จ.)
    $answer_1 = $_POST["answer_1"]; // คำตอบที่ถูกต้อง
    // ========================================= //
    $qut_2 = $_POST["qut_2"]; // แบทดสอบข้อที่ 2
    $opt_2_1 = $_POST["opt_2_1"]; // ตัวเลือก (ก.)
    $opt_2_2 = $_POST["opt_2_2"]; // ตัวเลือก (ข.)
    $opt_2_3 = $_POST["opt_2_3"]; // ตัวเลือก (ค.)
    $opt_2_4 = $_POST["opt_2_4"]; // ตัวเลือก (ง.)
    $opt_2_5 = $_POST["opt_2_5"]; // ตัวเลือก (จ.)
    $answer_2 = $_POST["answer_2"]; // คำตอบที่ถูกต้อง
    // ========================================= //
    $qut_3 = $_POST["qut_3"]; // แบทดสอบข้อที่ 3
    $opt_3_1 = $_POST["opt_3_1"]; // ตัวเลือก (ก.)
    $opt_3_2 = $_POST["opt_3_2"]; // ตัวเลือก (ข.)
    $opt_3_3 = $_POST["opt_3_3"]; // ตัวเลือก (ค.)
    $opt_3_4 = $_POST["opt_3_4"]; // ตัวเลือก (ง.)
    $opt_3_5 = $_POST["opt_3_5"]; // ตัวเลือก (จ.)
    $answer_3 = $_POST["answer_3"]; // คำตอบที่ถูกต้อง
    // ========================================= //
    $qut_4 = $_POST["qut_4"]; // แบทดสอบข้อที่ 4
    $opt_4_1 = $_POST["opt_4_1"]; // ตัวเลือก (ก.)
    $opt_4_2 = $_POST["opt_4_2"]; // ตัวเลือก (ข.)
    $opt_4_3 = $_POST["opt_4_3"]; // ตัวเลือก (ค.)
    $opt_4_4 = $_POST["opt_4_4"]; // ตัวเลือก (ง.)
    $opt_4_5 = $_POST["opt_4_5"]; // ตัวเลือก (จ.)
    $answer_4 = $_POST["answer_4"]; // คำตอบที่ถูกต้อง
    // ========================================= //
    $qut_5 = $_POST["qut_5"]; // แบทดสอบข้อที่ 5
    $opt_5_1 = $_POST["opt_5_1"]; // ตัวเลือก (ก.)
    $opt_5_2 = $_POST["opt_5_2"]; // ตัวเลือก (ข.)
    $opt_5_3 = $_POST["opt_5_3"]; // ตัวเลือก (ค.)
    $opt_5_4 = $_POST["opt_5_4"]; // ตัวเลือก (ง.)
    $opt_5_5 = $_POST["opt_5_5"]; // ตัวเลือก (จ.)
    $answer_5 = $_POST["answer_5"]; // คำตอบที่ถูกต้อง
    // ========================================= //

    // เช็คการป้อนข้อมูล
    if (empty($unit_number) || empty($unit_name) ||
        empty($unit_item_name_item) || empty($unit_item_detail_item) ||
        empty($qut_1) || empty($opt_1_1) || empty($opt_1_2) || empty($opt_1_3) || empty($opt_1_4) || empty($opt_1_5) || empty($answer_1) ||
        empty($qut_2) || empty($opt_2_1) || empty($opt_2_2) || empty($opt_2_3) || empty($opt_2_4) || empty($opt_2_5) || empty($answer_2) ||
        empty($qut_3) || empty($opt_3_1) || empty($opt_3_2) || empty($opt_3_3) || empty($opt_3_4) || empty($opt_3_5) || empty($answer_3) ||
        empty($qut_4) || empty($opt_4_1) || empty($opt_4_2) || empty($opt_4_3) || empty($opt_4_4) || empty($opt_4_5) || empty($answer_4) ||
        empty($qut_5) || empty($opt_5_1) || empty($opt_5_2) || empty($opt_5_3) || empty($opt_5_4) || empty($opt_5_5) || empty($answer_5)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql_1 = "INSERT INTO tbl_unit_db(cs_url, unit_url, unit_number, unit_name,
                qut_1, opt_1_1, opt_1_2, opt_1_3, opt_1_4, opt_1_5, answer_1,
                qut_2, opt_2_1, opt_2_2, opt_2_3, opt_2_4, opt_2_5, answer_2,
                qut_3, opt_3_1, opt_3_2, opt_3_3, opt_3_4, opt_3_5, answer_3,
                qut_4, opt_4_1, opt_4_2, opt_4_3, opt_4_4, opt_4_5, answer_4,
                qut_5, opt_5_1, opt_5_2, opt_5_3, opt_5_4, opt_5_5, answer_5)
                VALUE('$cs_url', '$unit_url', '$unit_number', '$unit_name',
                '$qut_1', '$opt_1_1', '$opt_1_2', '$opt_1_3', '$opt_1_4', '$opt_1_5', '$answer_1',
                '$qut_2', '$opt_2_1', '$opt_2_2', '$opt_2_3', '$opt_2_4', '$opt_2_5', '$answer_2',
                '$qut_3', '$opt_3_1', '$opt_3_2', '$opt_3_3', '$opt_3_4', '$opt_3_5', '$answer_3',
                '$qut_4', '$opt_4_1', '$opt_4_2', '$opt_4_3', '$opt_4_4', '$opt_4_5', '$answer_4',
                '$qut_5', '$opt_5_1', '$opt_5_2', '$opt_5_3', '$opt_5_4', '$opt_5_5', '$answer_5')";

        // สั่งรันคำสั่ง sql
        $result_1 = mysqli_query($conn, $sql_1);

        foreach($_POST['unit_item_name_item'] as $row=>$course){
            $unit_item_url = getName($n);
            $unit_item_name_item = $_POST['unit_item_name_item'][$row];
            $unit_item_detail_item = $_POST['unit_item_detail_item'][$row];
            $sql_2 = "INSERT INTO tbl_unit_item_db(cs_url, unit_url, unit_item_url, unit_item_name_item, unit_item_detail_item)
                        VALUE('$cs_url', '$unit_url', '$unit_item_url', '$unit_item_name_item', '$unit_item_detail_item')";
            $result_2 = mysqli_query($conn, $sql_2);
        }
    
        // อัพเดทเวลาแก้ไข tbl_course_db
        $sql_3 = "UPDATE tbl_course_db SET
        cs_time_edit = '$cs_time_edit'
        WHERE cs_url = '$url'";
        $result_3 = mysqli_query($conn, $sql_3);

        if ($result || $result_1 || $result_2 || $result_3) {
            $successMsg = "บันทึกข้อมูลสำเร็จ";
            $redirect = $server['sv_url'] . "/deshbord/courses";
            header("refresh:1;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}

// ออกจากระบบ
if (isset($_REQUEST['logout'])) {
    session_destroy();
    unset($_SESSION['member_url']);
    $redirect = $server['sv_url'] . "/login";
    header("location:$redirect");
}

// เช็กล็อคอิน
if (!isset($_SESSION['member_url']) || $_SESSION['level'] != "1") {
    session_destroy();
    unset($_SESSION['member_url']);
    $redirect = $server['sv_url'] . "/login";
    header("location:$redirect");
} else {
?>
    <!DOCTYPE html>
    <html lang="th">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8">
        <title>ฟอร์มเพิ่มหน่วยบทเรียน &#8211; แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $server['sv_url']; ?>/assets/images/180x180.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $server['sv_url']; ?>/assets/images/32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $server['sv_url']; ?>/assets/images/16x16.png">

        <!-- CSS Library -->
        <link rel="stylesheet" href="<?php echo $server['sv_url']; ?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">

        <!-- CSS Style -->
        <link rel="stylesheet" href="<?php echo $server['sv_url']; ?>/assets/css/style-main.css">
    </head>

    <body>
        <!-- Header -->
        <?php include('../include/header-deshbord.php'); ?>

        <!-- Form insert -->
        <section>
            <div class="wp-content-desh">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="container">
                        <div class="pt-100 d-none d-lg-block"></div>
                        <div class="wp-content-desh-container">

                            <!-- Form search -->
                            <div class="mb-3 wp-content-desh-title">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <strong>ฟอร์มเพิ่มหน่วยบทเรียน</strong>
                                </div>
                            </div>

                            <?php
                            if (isset($errorMsg)) {
                            ?>
                                <div class="error mb-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="text-center">
                                                <strong class="text-danger"><i class="fas fa-quote-left me-2"></i><?php echo $errorMsg; ?><i class="fas fa-quote-right ms-2"></i></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php
                            if (isset($successMsg)) {
                            ?>
                                <div class="success mb-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="text-center">
                                                <strong class="text-success"><i class="fas fa-quote-left me-2"></i><?php echo $successMsg; ?><i class="fas fa-quote-right ms-2"></i></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="mb-3 wp-content-desh-data">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="wp-content-desh-form">
                                        <div class="pt-100 d-none d-lg-block"></div>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="col-sm-12 col-md-12 col-lg-8 mx-auto">
                                                <div class="wp-content-form">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <h2>ส่วนรายละเอียด</h2>
                                                            <p>(คำแนะนำ : กรุณาเตรียมข้อมูลให้เรียบร้อยก่อนทำรายการ และตรวจสอบความถูกต้องก่อนบันทึกข้อมูล)</p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="unit_number" class="form-label">หน่วยที่ <span class="sp-red">*</span></label>
                                                                <input type="text" name="unit_number" class="form-control" id="unit_number" value="<?php echo isset($unit_number) ? $unit_number : '' ?>" placeholder="(Ex. หน่วยที่ 1)" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="unit_name" class="form-label">รายชื่อหน่วย <span class="sp-red">*</span></label>
                                                                <input type="text" name="unit_name" class="form-control" id="unit_name" value="<?php echo isset($unit_name) ? $unit_name : '' ?>" placeholder="(Ex. หลักการสื่อสารข้อมูลและเครือข่าย)" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <h2>ส่วนเนื้อหาบทเรียน</h2>
                                                            <p>(คำแนะนำ : กรุณาเตรียมข้อมูลให้เรียบร้อยก่อนทำรายการ และตรวจสอบความถูกต้องก่อนบันทึกข้อมูล)</p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="row">
                                                                <ol style="margin-bottom: 0;">
                                                                    <li class="mb-3" style="list-style: none;">
                                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">หัวข้อ <span class="sp-red">*</span></label>
                                                                                <input type="text" name="unit_item_name_item[]" class="form-control" placeholder="(Ex. ความหมายของการสื่อสารข้อมูล)" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">เนื้อหา <span class="sp-red">*</span></label>
                                                                                <textarea name="unit_item_detail_item[]" class="form-control" rows="5" placeholder="(Ex. การสื่อสารข้อมูล หมายถึง การถ่ายโอนแลกเปลี่ยนข้อมูลกันระหว่างผู้ส่งกับผู้รับ โดยช่องทางการสื่อสาร เช่น คอมพิวเตอร์เป็นตัวกลางในการส่งข้อมูล เพื่อให้ผู้ส่งแลพผู้รับเกิดความเข้าใจซึ่งกันและกัน)"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                                            <div class="row">
                                                                                <div class="col-sm-3 mb-2 mb-md-0">
                                                                                    <div class="d-grid">
                                                                                        <button class="btn btn-warning btn-add-item">+ เพิ่มหัวข้อ และ เนื้อหา</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <div class="d-grid">
                                                                                        <button class="btn btn-info btn-remove-item">- ลบหัวข้อ และ เนื้อหา</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <h2>ส่วนแบบทดสอบ</h2>
                                                            <p>(คำแนะนำ : กรุณาเตรียมข้อมูลให้เรียบร้อยก่อนทำรายการ และตรวจสอบความถูกต้องก่อนบันทึกข้อมูล)</p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="row">

                                                                <div class="test-item">
                                                                    <div class="mb-3">
                                                                        <label for="qut_1" class="form-label">ข้อที่ 1 <span class="sp-red">*</span></label>
                                                                        <input type="text" name="qut_1" class="form-control" id="qut_1" value="<?php echo isset($qut_1) ? $qut_1 : '' ?>" placeholder="คำถาม" autocomplete="off">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">คำตอบข้อที่ 1 <span class="sp-red">*</span></label>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_1_1" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_1_1) ? $opt_1_1 : '' ?>" placeholder="ตัวเลือก (ก.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_1_1" type="radio" name="answer_1" value="1" checked>
                                                                                <label class="form-check-label one-text" for="ans_1_1">
                                                                                    (เลือกตัวเลือกที่ 1)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_1_2" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_1_2) ? $opt_1_2 : '' ?>" placeholder="ตัวเลือก (ข.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_1_2" type="radio" name="answer_1" value="2">
                                                                                <label class="form-check-label one-text" for="ans_1_2">
                                                                                    (เลือกตัวเลือกที่ 2)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_1_3" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_1_3) ? $opt_1_3 : '' ?>" placeholder="ตัวเลือก (ค.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_1_3" type="radio" name="answer_1" value="3">
                                                                                <label class="form-check-label one-text" for="ans_1_3">
                                                                                    (เลือกตัวเลือกที่ 3)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_1_4" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_1_4) ? $opt_1_4 : '' ?>" placeholder="ตัวเลือก (ง.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_1_4" type="radio" name="answer_1" value="4">
                                                                                <label class="form-check-label one-text" for="ans_1_4">
                                                                                    (เลือกตัวเลือกที่ 4)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_1_5" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_1_5) ? $opt_1_5 : '' ?>" placeholder="ตัวเลือก (จ.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_1_5" type="radio" name="answer_1" value="5">
                                                                                <label class="form-check-label one-text" for="ans_1_5">
                                                                                    (เลือกตัวเลือกที่ 5)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="test-item">
                                                                    <div class="mb-3">
                                                                        <label for="qut_2" class="form-label">ข้อที่ 2 <span class="sp-red">*</span></label>
                                                                        <input type="text" name="qut_2" class="form-control" id="qut_2" value="<?php echo isset($qut_2) ? $qut_2 : '' ?>" placeholder="คำถาม" autocomplete="off">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">คำตอบข้อที่ 2 <span class="sp-red">*</span></label>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_2_1" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_2_1) ? $opt_2_1 : '' ?>" placeholder="ตัวเลือก (ก.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_2_1" type="radio" name="answer_2" value="1" checked>
                                                                                <label class="form-check-label one-text" for="ans_2_1">
                                                                                    (เลือกตัวเลือกที่ 1)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_2_2" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_2_2) ? $opt_2_2 : '' ?>" placeholder="ตัวเลือก (ข.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_2_2" type="radio" name="answer_2" value="2">
                                                                                <label class="form-check-label one-text" for="ans_2_2">
                                                                                    (เลือกตัวเลือกที่ 2)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_2_3" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_2_3) ? $opt_2_3 : '' ?>" placeholder="ตัวเลือก (ค.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_2_3" type="radio" name="answer_2" value="3">
                                                                                <label class="form-check-label one-text" for="ans_2_3">
                                                                                    (เลือกตัวเลือกที่ 3)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_2_4" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_2_4) ? $opt_2_4 : '' ?>" placeholder="ตัวเลือก (ง.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_2_4" type="radio" name="answer_2" value="4">
                                                                                <label class="form-check-label one-text" for="ans_2_4">
                                                                                    (เลือกตัวเลือกที่ 4)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_2_5" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_2_5) ? $opt_2_5 : '' ?>" placeholder="ตัวเลือก (จ.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_2_5" type="radio" name="answer_2" value="5">
                                                                                <label class="form-check-label one-text" for="ans_2_5">
                                                                                    (เลือกตัวเลือกที่ 5)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="test-item">
                                                                    <div class="mb-3">
                                                                        <label for="qut_3" class="form-label">ข้อที่ 3 <span class="sp-red">*</span></label>
                                                                        <input type="text" name="qut_3" class="form-control" id="qut_3" value="<?php echo isset($qut_3) ? $qut_3 : '' ?>" placeholder="คำถาม" autocomplete="off">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">คำตอบข้อที่ 3 <span class="sp-red">*</span></label>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_3_1" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_3_1) ? $opt_3_1 : '' ?>" placeholder="ตัวเลือก (ก.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_3_1" type="radio" name="answer_3" value="1" checked>
                                                                                <label class="form-check-label one-text" for="ans_3_1">
                                                                                    (เลือกตัวเลือกที่ 1)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_3_2" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_3_2) ? $opt_3_2 : '' ?>" placeholder="ตัวเลือก (ข.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_3_2" type="radio" name="answer_3" value="2">
                                                                                <label class="form-check-label one-text" for="ans_3_2">
                                                                                    (เลือกตัวเลือกที่ 2)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_3_3" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_3_3) ? $opt_3_3 : '' ?>" placeholder="ตัวเลือก (ค.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_3_3" type="radio" name="answer_3" value="3">
                                                                                <label class="form-check-label one-text" for="ans_3_3">
                                                                                    (เลือกตัวเลือกที่ 3)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_3_4" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_3_4) ? $opt_3_4 : '' ?>" placeholder="ตัวเลือก (ง.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_3_4" type="radio" name="answer_3" value="4">
                                                                                <label class="form-check-label one-text" for="ans_3_4">
                                                                                    (เลือกตัวเลือกที่ 4)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_3_5" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_3_5) ? $opt_3_5 : '' ?>" placeholder="ตัวเลือก (จ.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_3_5" type="radio" name="answer_3" value="5">
                                                                                <label class="form-check-label one-text" for="ans_3_5">
                                                                                    (เลือกตัวเลือกที่ 5)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="test-item">
                                                                    <div class="mb-3">
                                                                        <label for="qut_4" class="form-label">ข้อที่ 4 <span class="sp-red">*</span></label>
                                                                        <input type="text" name="qut_4" class="form-control" id="qut_4" value="<?php echo isset($qut_4) ? $qut_4 : '' ?>" placeholder="คำถาม" autocomplete="off">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">คำตอบข้อที่ 4 <span class="sp-red">*</span></label>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_4_1" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_4_1) ? $opt_4_1 : '' ?>" placeholder="ตัวเลือก (ก.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_4_1" type="radio" name="answer_4" value="1" checked>
                                                                                <label class="form-check-label one-text" for="ans_4_1">
                                                                                    (เลือกตัวเลือกที่ 1)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_4_2" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_4_2) ? $opt_4_2 : '' ?>" placeholder="ตัวเลือก (ข.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_4_2" type="radio" name="answer_4" value="2">
                                                                                <label class="form-check-label one-text" for="ans_4_2">
                                                                                    (เลือกตัวเลือกที่ 2)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_4_3" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_4_3) ? $opt_4_3 : '' ?>" placeholder="ตัวเลือก (ค.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_4_3" type="radio" name="answer_4" value="3">
                                                                                <label class="form-check-label one-text" for="ans_4_3">
                                                                                    (เลือกตัวเลือกที่ 3)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_4_4" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_4_4) ? $opt_4_4 : '' ?>" placeholder="ตัวเลือก (ง.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_4_4" type="radio" name="answer_4" value="4">
                                                                                <label class="form-check-label one-text" for="ans_4_4">
                                                                                    (เลือกตัวเลือกที่ 4)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_4_5" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_4_5) ? $opt_4_5 : '' ?>" placeholder="ตัวเลือก (จ.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_4_5" type="radio" name="answer_4" value="5">
                                                                                <label class="form-check-label one-text" for="ans_4_5">
                                                                                    (เลือกตัวเลือกที่ 5)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="test-item">
                                                                    <div class="mb-3">
                                                                        <label for="qut_5" class="form-label">ข้อที่ 5 <span class="sp-red">*</span></label>
                                                                        <input type="text" name="qut_5" class="form-control" id="qut_5" value="<?php echo isset($qut_5) ? $qut_5 : '' ?>" placeholder="คำถาม" autocomplete="off">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">คำตอบข้อที่ 5 <span class="sp-red">*</span></label>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_5_1" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_5_1) ? $opt_5_1 : '' ?>" placeholder="ตัวเลือก (ก.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_5_1" type="radio" name="answer_5" value="1" checked>
                                                                                <label class="form-check-label one-text" for="ans_5_1">
                                                                                    (เลือกตัวเลือกที่ 1)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_5_2" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_5_2) ? $opt_5_2 : '' ?>" placeholder="ตัวเลือก (ข.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_5_2" type="radio" name="answer_5" value="2">
                                                                                <label class="form-check-label one-text" for="ans_5_2">
                                                                                    (เลือกตัวเลือกที่ 2)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_5_3" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_5_3) ? $opt_5_3 : '' ?>" placeholder="ตัวเลือก (ค.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_5_3" type="radio" name="answer_5" value="3">
                                                                                <label class="form-check-label one-text" for="ans_5_3">
                                                                                    (เลือกตัวเลือกที่ 3)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_5_4" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_5_4) ? $opt_5_4 : '' ?>" placeholder="ตัวเลือก (ง.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_5_4" type="radio" name="answer_5" value="4">
                                                                                <label class="form-check-label one-text" for="ans_5_4">
                                                                                    (เลือกตัวเลือกที่ 4)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="far fa-circle me-2"></i>
                                                                            <input type="text" name="opt_5_5" class="form-control mt-2 mb-2 me-2" value="<?php echo isset($opt_5_5) ? $opt_5_5 : '' ?>" placeholder="ตัวเลือก (จ.)" autocomplete="off">
                                                                            <div class="form-check w-25 mt-2 mb-2">
                                                                                <input class="form-check-input" id="ans_5_5" type="radio" name="answer_5" value="5">
                                                                                <label class="form-check-label one-text" for="ans_5_5">
                                                                                    (เลือกตัวเลือกที่ 5)
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="row">
                                                                        <div class="mb-2 mb-md-0">
                                                                            <div class="d-grid">
                                                                                <a href="<?php echo $server['sv_url']; ?>/deshbord/example/ตัวอย่างการเตรียมข้อมูล.txt" download class="btn btn-warning"><i class="fas fa-download me-2"></i>ดาวโหลดใฟล์ตัวอย่างการเตรียมข้อมูล</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                                                                    <div class="d-grid">
                                                                        <a href="<?php echo $server['sv_url']; ?>/deshbord/course_unit?url=<?php echo $url; ?>" class="btn btn-danger">กลับไปที่รายการบทเรียน</a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                                                                    <div class="d-grid">
                                                                        <button type="submit" name="btn_add" class="btn btn-success">บันทึกข้อมูล</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="pb-100 d-none d-lg-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pb-100 d-none d-lg-block"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <?php include('../include/footer.php'); ?>

        <!-- Page to top -->
        <button class="btn btn-blue" id="button">
            <i class="fas fa-angle-up"></i>
        </button>

        <!-- Javascript Library -->
        <script src="<?php echo $server['sv_url']; ?>/assets/js/jquery-3.6.0.min.js"></script>
        <script src="<?php echo $server['sv_url']; ?>/assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo $server['sv_url']; ?>/assets/js/script-main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    </body>

    </html>
<?php } ?>