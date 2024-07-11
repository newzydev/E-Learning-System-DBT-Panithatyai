<?php
require_once('../server.php');
session_start();

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$url = $_GET['cs_url'];
$query_data = "SELECT * FROM tbl_course_db WHERE cs_url = '$url'";
$result_data = mysqli_query($conn, $query_data);
$data = mysqli_fetch_assoc($result_data);

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
    $urlcourse = $url;

    $query_data_3 = "SELECT * FROM tbl_register_unit_db WHERE mb_url = '$url_acount' AND cs_url = '$urlcourse'";
    $result_data_3 = mysqli_query($conn, $query_data_3);
    $data_3 = mysqli_fetch_assoc($result_data_3);
}

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$query_data_1 = "SELECT * FROM tbl_unit_db WHERE cs_url = '$url' ORDER BY unit_id DESC";
$result_data_1 = mysqli_query($conn, $query_data_1);
$count_data = mysqli_num_rows($result_data_1);
$order = 1;

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
                        <div class="wp-content-cs-b">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-3 mb-2">
                                    <img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/courses/<?php echo $data['cs_img']; ?>" width="100%">
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
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
                                            <a class="btn btn-outline-primary">หลักสูตรนี้มี (<?php $url = $data['cs_url']; $qd = "SELECT * FROM tbl_unit_db WHERE cs_url = '$url'"; $rd = mysqli_query($conn, $qd); $ct = mysqli_num_rows($rd); echo number_format($ct) ?> หน่วย)</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                    <a class="list-group-item list-group-item-action active" aria-current="true">
                                        รายการบทเรียนทั้งหมด (เครื่องหมาย<i class="fas fa-check ms-2 me-2"></i>คือผ่านการเรียนและทำแบบทดสอบแล้ว)
                                    </a>
                                        <?php while ($row = mysqli_fetch_assoc($result_data_1)) { ?>

                                        <a href="<?php echo $server['sv_url']; ?>/learning/learning?urlcourse=<?php echo $data['cs_url']; ?>&urlunit=<?php echo $row['unit_url']; ?>" class="list-group-item list-group-item-action"><?php echo $row['unit_number']; ?> &#8211; <?php echo $row['unit_name']; ?></li><?php if (empty($data_3['unit_url'])) { } else if ($url_acount == $data_3['mb_url'] && $urlcourse == $data_3['cs_url']) { echo "<i class='fas fa-check ms-2 text-success'></i>"; } ?></a><?php } ?>
                                    
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