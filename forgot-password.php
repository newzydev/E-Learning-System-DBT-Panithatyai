<?php
require_once('server.php');
session_start();

if (isset($_REQUEST['btn_forgot'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $email = $_POST['forgotEmail'];
    $tel = $_POST['forgotTel'];

    $query = "SELECT * FROM tbl_member_db WHERE mb_email ='$email' AND mb_tel ='$tel'";
    $result = mysqli_query($conn, $query);

    // เช็คการป้อนข้อมูล
    if (empty($email) || empty($tel)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // เช็คล็อคอิน
    if (!isset($errorMsg)) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            $_SESSION['member_url'] = $row['mb_url'];
            $_SESSION['level'] = "3";

            header("location:reset-password");
        } else {
            $errorMsg = "ที่อยู่อีเมลหรือเบอร์โทรศัพท์ไม่ถูกต้อง";
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
    <meta http-equiv="expires" content="0">
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
    <meta name="google-site-verification" content="5X1AFUYfrOjT4q0K9dF8BPM0MU2WYJum6iZ5RytNmDs">

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
                                                <label for="LRF_email" class="form-label ms-2">ที่อยู่อีเมลที่ลงทะเบียน <span class="sp-red">*</span></label>
                                                <input type="email" name="forgotEmail" class="form-control" id="LRF_email" placeholder="Email" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="LRF_tel" class="form-label ms-2">เบอร์โทรศัพท์ที่ลงทะเบียน <span class="sp-red">*</span></label>
                                                <input type="tel" name="forgotTel" class="form-control" id="LRF_tel" placeholder="Phone Number" autocomplete="off">
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