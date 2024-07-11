<?php
error_reporting(0);
require_once('server.php');
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
}

if (isset($_REQUEST['btn_forgot'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $member_id = $_SESSION['member_id'];
    $password_1 = $_POST["password_1"];
    $password_2 = $_POST["password_2"];
    $edittime = datetime();

    // เช็คการป้อนข้อมูล
    if (empty($password_1) || empty($password_2)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    } else if ($password_1 != $password_2) {
        $errorMsg = "รหัสผ่านทั้งสองไม่ตรงกัน";
    }

    // เข้ารหัสพาสเวิร์ด
    $passwordenc = md5($password_1);

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_member_db SET mb_password = '$passwordenc',mb_time_edit = '$edittime' WHERE mb_url = '$member_url'";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "เปลี่ยนรหัสผ่านสำเร็จ";
            $redirect = $server['sv_url'] . "/login";
            header("refresh:1;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }

}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <title>ลืมรหัสผ่าน ? &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:title" content="ลืมรหัสผ่าน ? &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/forgot-password">
    <meta property="og:site_name" content="ลืมรหัสผ่าน ? &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/forgot-password">
    <meta name="twitter:title" content="ลืมรหัสผ่าน ? &#8211; <?php echo $server['sv_title']; ?>">
    <meta name="twitter:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta name="description" content="<?php echo $server['sv_description']; ?>">
    <meta name="keywords" content="<?php echo $server['sv_keyword']; ?>">
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
    <?php include('include/header.php'); ?>

    <!-- Form forgot-password -->
    <section>
        <div class="wp-content-LRF">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="pt-100 d-none d-lg-block"></div>
                    <div class="wp-content-LRF-container">
                        <form action="" method="post">
                            
                            <div class="col-sm-12 col-md-6 col-lg-5 mx-auto">
                                <?php
                                if (isset($errorMsg)) {
                                ?>
                                    <div class="error mb-3 text-center">
                                        <strong class="text-danger"><i class="fas fa-quote-left me-2"></i><?php echo $errorMsg; ?><i class="fas fa-quote-right ms-2"></i></strong>
                                    </div>
                                <?php } ?>
    
                                <?php
                                if (isset($successMsg)) {
                                ?>
                                    <div class="success mb-3 text-center">
                                        <strong class="text-success"><i class="fas fa-quote-left me-2"></i><?php echo $successMsg; ?><i class="fas fa-quote-right ms-2"></i></strong>
                                    </div>
                                <?php } ?>
                                <div class="wp-content-LRF-form">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="forgotEmail" class="form-label ms-2">อีเมลที่ลงทะเบียน</label>
                                                <input type="email" name="forgotEmail" class="form-control" id="forgotEmail" value="<?php echo $acount['mb_email']; ?>" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="LRF_password_1" class="form-label ms-2">รหัสผ่านใหม่ <span class="sp-red">*</span></label>
                                                <input type="password" name="password_1" class="form-control" id="LRF_password_1" value="<?php echo isset($password_1) ? $password_1 : '' ?>" placeholder="Password" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="LRF_password_2" class="form-label ms-2">ยืนยันรหัสผ่านใหม่ <span class="sp-red">*</span></label>
                                                <input type="password" name="password_2" class="form-control" id="LRF_password_2" value="<?php echo isset($password_2) ? $password_2 : '' ?>" placeholder="Confirm Password" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="wp-content-LRF-form-link"><a href="<?php echo $server['sv_url']; ?>/login">ลงชื่อเข้าใช้</a></div>
                                            <div class="wp-content-LRF-form-link">หากยังไม่มีบัญชี <a href="<?php echo $server['sv_url']; ?>/register">สมัครสมาชิก</a></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-sm-6 mt-3 mx-auto">
                                                <div class="d-grid">
                                                    <button type="submit" name="btn_forgot" class="btn btn-blue">เปลี่ยนรหัสผ่าน</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="pb-100 d-none d-lg-block"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('include/footer.php'); ?>

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