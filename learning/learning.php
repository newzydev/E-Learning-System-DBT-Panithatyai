<?php
require_once('../server.php');
session_start();

if (isset($_SESSION['member_url'])) {
    // รับค่ามาจากเซสชั่น
    $member_url = $_SESSION['member_url'];

    // เช็คค่าที่ส่งมาจากเซสชั่น
    $query = "SELECT * FROM tbl_member_db WHERE mb_url ='$member_url'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $acount = mysqli_fetch_array($result);
    }

    $url_acount = $acount['mb_url'];
    $urlcourse = $_GET['urlcourse'];
    $urlunit = $_GET['urlunit'];

    $query_data_3 = "SELECT * FROM tbl_register_unit_db WHERE mb_url = '$url_acount' AND cs_url = '$urlcourse' AND unit_url = '$urlunit'";
    $result_data_3 = mysqli_query($conn, $query_data_3);
    $data_3 = mysqli_fetch_assoc($result_data_3);
}

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$urlcourse = $_GET['urlcourse'];
$query_data = "SELECT * FROM tbl_course_db WHERE cs_url = '$urlcourse'";
$result_data = mysqli_query($conn, $query_data);
$data = mysqli_fetch_assoc($result_data);

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$urlunit = $_GET['urlunit'];
$query_data_1 = "SELECT * FROM tbl_unit_db WHERE unit_url = '$urlunit'";
$result_data_1 = mysqli_query($conn, $query_data_1);
$data_1 = mysqli_fetch_assoc($result_data_1);

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$query_data_2 = "SELECT * FROM tbl_unit_item_db WHERE unit_url = '$urlunit' ORDER BY unit_item_id ASC";
$result_data_2 = mysqli_query($conn, $query_data_2);
$count_data = mysqli_num_rows($result_data_2);
$order = 1;

// ครวจสอบคำตอบ
if (isset($_REQUEST['btn_sent'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $mb_url = $url_acount;
    $cs_url = $urlcourse;
    $unit_url = $urlunit;
    isset( $_POST["answer_1"] ) ? $answer_1 = $_POST["answer_1"] : $answer_1 = "";
    isset( $_POST["answer_2"] ) ? $answer_2 = $_POST["answer_2"] : $answer_2 = "";
    isset( $_POST["answer_3"] ) ? $answer_3 = $_POST["answer_3"] : $answer_3 = "";
    isset( $_POST["answer_4"] ) ? $answer_4 = $_POST["answer_4"] : $answer_4 = "";
    isset( $_POST["answer_5"] ) ? $answer_5 = $_POST["answer_5"] : $answer_5 = "";

    // เช็คการป้อนข้อมูล
    if (empty($answer_1) || empty($answer_2) || empty($answer_3) || empty($answer_4) || empty($answer_5)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // ตรวจคำตอบว่าเหมือนกันมั้ย
    if ($answer_1 == $data_1['answer_1']) {
        $score_1 = 1;
    } else {
        $score_1 = 0;
    }

    if ($answer_2 == $data_1['answer_2']) {
        $score_2 = 1;
    } else {
        $score_2 = 0;
    }

    if ($answer_3 == $data_1['answer_3']) {
        $score_3 = 1;
    } else {
        $score_3 = 0;
    }

    if ($answer_4 == $data_1['answer_4']) {
        $score_4 = 1;
    } else {
        $score_4 = 0;
    }

    if ($answer_5 == $data_1['answer_5']) {
        $score_5 = 1;
    } else {
        $score_5 = 0;
    }

    // รวมคะแนนที่ได้
    $total_score = $score_1 + $score_2 + $score_3 + $score_4 + $score_5;
    
    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_register_unit_db(mb_url, cs_url, unit_url, total_score)
                VALUE('$mb_url', '$cs_url', '$unit_url', '$total_score')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "ส่งคำตอบสำเร็จ";
            $redirect = $server['sv_url'] . "/examination/examination?urlcourse=" . $urlcourse . "&urlunit=" .$urlunit;
            header("refresh:1;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}
// เช็กล็อคอิน
if (!isset($_SESSION['member_url'])) {
    session_destroy();
    unset($_SESSION['member_url']);
    $redirect = $server['sv_url'];
    header("location:$redirect");
} else {
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <title>วิชา<?php echo $data['cs_name']; ?> &#8211; <?php echo $server['sv_title']; ?></title>
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
    <?php include('../include/header.php'); ?>

    <!-- Detail -->
    <section>
        <div class="wp-content-cs">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="pt-100 d-none d-lg-block"></div>
                        <?php if (isset($errorMsg)) { ?>
                            <div class="wp-content-cs-b mb-3">
                                <div class="alert alert-danger d-flex align-item-center justify-content-center" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i><?php echo $errorMsg; ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (isset($successMsg)) { ?>
                            <div class="wp-content-cs-b mb-3">
                                <div class="alert alert-success d-flex align-item-center justify-content-center" role="alert">
                                    <i class="fas fa-check-circle me-2"></i><?php echo $successMsg; ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { ?>
                            
                        <?php } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { ?>
                            <div class="wp-content-cs-b mb-3">
                                <div class="alert alert-success d-flex align-item-center justify-content-center" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>คุณได้ทำแบบทดสอบแล้ว จะไม่สามารถทำซ้ำได้ คะแนนของคุณคือ [<?php echo $data_3['total_score']; ?>/5] คะแนน
                                </div>
                            </div>
                        <?php } ?>

                        <div class="wp-content-cs-b mb-4">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-3 mb-2 mb-md-0">
                                    <img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/courses/<?php echo $data['cs_img']; ?>" width="100%">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-7">
                                    <div>
                                        <label class="form-label"><span class="sp-orange">รหัสรายวิชา</span> <br><?php echo $data['cs_code']; ?></label>
                                    </div>
                                    <div>
                                        <label class="form-label"><span class="sp-orange">รายวิชาชื่อ</span> <br><?php echo $data['cs_name']; ?></label>
                                    </div>
                                    <div>
                                        <label class="form-label"><span class="sp-orange">คำอธิบายรายวิชาสั้น ๆ</span> <br><?php echo $data['cs_des']; ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <form action="" method="get">
                                        <div class="d-grid mb-2">
                                            <a class="btn btn-outline-primary"><?php echo $data_1['unit_number']; ?> <?php echo $data_1['unit_name']; ?></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-3">
                                <div class="wp-content-cs-b mb-4">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        
                                        <?php
                                        $i = 0;
                                        foreach ($result_data_2 as $row) {
                                            $actives = '';
                                            if ($i == 0) {
                                            $actives = 'active';
                                            }
                                        ?>
                                        <span class="nav-link one-text <?php echo $actives; ?>" id="v-pills-<?php echo $row['unit_item_name_item']; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo $row['unit_item_url']; ?>" type="button" role="tab" aria-controls="v-pills-<?php echo $row['unit_item_name_item']; ?>" aria-selected="true"><?php echo $order++.".&nbsp;&nbsp;".$row['unit_item_name_item']; ?></span>
                                        <?php
                                            $i++;
                                        } ?>
        
                                        <span class="nav-link" id="v-pills-test-tab" data-bs-toggle="pill" data-bs-target="#v-pills-test" type="button" role="tab" aria-controls="v-pills-test" aria-selected="true">แบบทดสอบหลังเรียน</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-9">
                                <div class="wp-content-cs-b">
                                    <div class="tab-content" id="v-pills-tabContent">
        
                                        <?php
                                        $i = 0;
                                        foreach ($result_data_2 as $row) {
                                            $actives = '';
                                            if ($i == 0) {
                                            $actives = 'show active';
                                            }
                                        ?>
                                        <div class="tab-pane fade <?php echo $actives; ?>" id="v-pills-<?php echo $row['unit_item_url']; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $row['unit_item_url']; ?>-tab">
                                            <h2 class="sp-orange"><?php echo $row['unit_item_name_item']; ?></h2>
                                            <p><?php echo $row['unit_item_detail_item']; ?></p>
                                        </div>
                                        <?php
                                            $i++;
                                        } ?>
        
                                        <div class="tab-pane fade" id="v-pills-test" role="tabpanel" aria-labelledby="v-pills-test-tab">
                                            <form action="" method="post">    
                                                <h2 class="sp-orange">แบบทดสอบ <?php echo $data_1['unit_number']; ?> <?php echo $data_1['unit_name']; ?></h2>
                                                <p>นักเรียนนักศึกษาจงตอบคำถามให้ครบทุกข้อ แบบทดสอบมีทั้งหมด 5 ข้อ จงเลือกคำตอบที่ถูกที่สุด</p>
                                                <div class="test-item">
                                                    <div class="mb-3">
                                                        <label class="form-label">ข้อที่ 1 &#8211; <?php echo $data_1['qut_1']; ?> <span class="sp-red">*</span></label>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_1_1" type="radio" name="answer_1" value="1" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_1_1"><?php echo $data_1['opt_1_1']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_1_2" type="radio" name="answer_1" value="2" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_1_2"><?php echo $data_1['opt_1_2']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_1_3" type="radio" name="answer_1" value="3" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_1_3"><?php echo $data_1['opt_1_3']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_1_4" type="radio" name="answer_1" value="4" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_1_4"><?php echo $data_1['opt_1_4']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_1_5" type="radio" name="answer_1" value="5" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_1_5"><?php echo $data_1['opt_1_5']; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="test-item">
                                                    <div class="mb-3">
                                                        <label class="form-label">ข้อที่ 2 &#8211; <?php echo $data_1['qut_2']; ?> <span class="sp-red">*</span></label>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_2_1" type="radio" name="answer_2" value="1" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_2_1"><?php echo $data_1['opt_2_1']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_2_2" type="radio" name="answer_2" value="2" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_2_2"><?php echo $data_1['opt_2_2']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_2_3" type="radio" name="answer_2" value="3" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_2_3"><?php echo $data_1['opt_2_3']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_2_4" type="radio" name="answer_2" value="4" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_2_4"><?php echo $data_1['opt_2_4']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_2_5" type="radio" name="answer_2" value="5" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_2_5"><?php echo $data_1['opt_2_5']; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="test-item">
                                                    <div class="mb-3">
                                                        <label class="form-label">ข้อที่ 3 &#8211; <?php echo $data_1['qut_3']; ?> <span class="sp-red">*</span></label>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_3_1" type="radio" name="answer_3" value="1" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_3_1"><?php echo $data_1['opt_3_1']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_3_2" type="radio" name="answer_3" value="2" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_3_2"><?php echo $data_1['opt_3_2']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_3_3" type="radio" name="answer_3" value="3" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_3_3"><?php echo $data_1['opt_3_3']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_3_4" type="radio" name="answer_3" value="4" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_3_4"><?php echo $data_1['opt_3_4']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_3_5" type="radio" name="answer_3" value="5" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_3_5"><?php echo $data_1['opt_3_5']; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="test-item">
                                                    <div class="mb-3">
                                                        <label class="form-label">ข้อที่ 4 &#8211; <?php echo $data_1['qut_4']; ?> <span class="sp-red">*</span></label>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_4_1" type="radio" name="answer_4" value="1" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_4_1"><?php echo $data_1['opt_4_1']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_4_2" type="radio" name="answer_4" value="2" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_4_2"><?php echo $data_1['opt_4_2']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_4_3" type="radio" name="answer_4" value="3" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_4_3"><?php echo $data_1['opt_4_3']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_4_4" type="radio" name="answer_4" value="4" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_4_4"><?php echo $data_1['opt_4_4']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_4_5" type="radio" name="answer_4" value="5" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_4_5"><?php echo $data_1['opt_4_5']; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="test-item">
                                                    <div class="mb-3">
                                                        <label class="form-label">ข้อที่ 5 &#8211; <?php echo $data_1['qut_5']; ?> <span class="sp-red">*</span></label>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_5_1" type="radio" name="answer_5" value="1" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_5_1"><?php echo $data_1['opt_5_1']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_5_2" type="radio" name="answer_5" value="2" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_5_2"><?php echo $data_1['opt_5_2']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_5_3" type="radio" name="answer_5" value="3" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_5_3"><?php echo $data_1['opt_5_3']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_5_4" type="radio" name="answer_5" value="4" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_5_4"><?php echo $data_1['opt_5_4']; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mt-1 mb-1">
                                                                <input class="form-check-input" id="ans_5_5" type="radio" name="answer_5" value="5" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                                <label class="form-check-label" for="ans_5_5"><?php echo $data_1['opt_5_5']; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <hr>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="mb-2">
                                                        <b>ยืนยันจะส่งแบบทดสอบ</b>
                                                    </div>
                                                    <div class="mb-3 form-check">
                                                        <input type="checkbox" name="confirm_accept" id="confirm_accept" class="form-check-input" <?php if (empty($data_3['mb_url']) || empty($data_3['cs_url'] || empty($data_3['unit_url']))) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url'] && $urlunit == $data_3['unit_url']) { echo "disabled"; } ?>>
                                                        <label class="form-check-label" for="confirm_accept">ยืนยัน</label>
                                                    </div>
                                                </div>
        
                                                <div class="col-sm-12 col-md-6 col-lg-3 mx-auto">
                                                    <div class="d-grid">
                                                        <button type="submit" name="btn_sent" id="btn_confirm" class="btn btn-all" disabled><i class="fas fa-arrow-right me-2"></i>ส่งคำตอบ</button>
                                                    </div>
                                                </div>
        
                                            </form>
                                        </div>
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