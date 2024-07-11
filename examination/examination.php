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

    $score = $data_3['total_score'];

    if ($score >= 3) {
        $success = "ขอแสดงความยินดี คุณผ่านแบบทดสอบ";
    } else {
        $fail = "ขอแสดงความเสียใจ คุณไม่ผ่านแบบทดสอบ";
    }
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

// รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
$mb_url = $url_acount;
$cs_url = $urlcourse;
$unit_url = $urlunit;

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
                        <div class="wp-content-cs-b">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 my-4">
                                
                                <?php if (isset($success)) { ?>
                                    <div class="wp-alert-success mb-4">
                                        <h2 class="text-center text-success m-0"><i class="fas fa-check-circle me-2"></i><?php echo $success; ?></h2>
                                    </div>
                                <?php } ?>

                                <?php if (isset($fail)) { ?>
                                    <div class="wp-alert-fail mb-4">
                                        <h2 class="text-center text-danger m-0"><i class="fas fa-check-circle me-2"></i><?php echo $fail; ?></h2>
                                    </div>
                                <?php } ?>

                                    <div class="wp-content-score mb-4">
                                        <h3 class="text-center m-0">คะแนนที่คุณได้ [<?php echo $data_3['total_score']; ?>/5] คะแนน</h3>
                                    </div>

                                    <div class="wp-alert-menu text-center">
                                        <a href="<?php echo $server['sv_url']; ?>/course/<?php echo $urlcourse; ?>" class="btn btn-outline-warning">กลับไปหน้าหลักสูตร</a>
                                        <a href="<?php echo $server['sv_url']; ?>" class="btn btn-warning">กลับไปยังหน้าหลัก</a>
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