<?php
require_once('server.php');
session_start();

if (isset($_REQUEST['btn_login'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $login_email = mysqli_real_escape_string($conn, $_POST['login_email']);
    $login_password = mysqli_real_escape_string($conn, $_POST['login_password']);
    $passwordenc = md5($login_password);

    $query = "SELECT * FROM tbl_member_db WHERE mb_email ='$login_email' AND mb_password ='$passwordenc'";
    $result = mysqli_query($conn, $query);

    // เช็คการป้อนข้อมูล
    if (empty($login_email) || empty($login_password)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // เช็คล็อคอิน
    if (!isset($errorMsg)) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            $_SESSION['member_url'] = $row['mb_url'];
            $_SESSION['level'] = $row['mb_level'];

            $time_login = datetime()." ".date("H:i:s");
            $member_login = $_SESSION['member_url'];

            if ($_SESSION['level'] == "1") {
                $successMsg = "เข้าสู่ระบบสำเร็จ : ผู้ดูแลระบบ";
                $redirect = $server['sv_url'] . "/deshbord/members";
                header("refresh:1;$redirect");
                $sql = "UPDATE tbl_member_db SET mb_time_login = '$time_login' WHERE mb_url = '$member_login'";
                $time_login = mysqli_query($conn, $sql);
            }

            if ($_SESSION['level'] == "2") {
                $successMsg = "เข้าสู่ระบบสำเร็จ : นักเรียน/นักศึกษา";
                $redirect = $server['sv_url'];
                header("refresh:1;$redirect");
                $sql = "UPDATE tbl_member_db SET mb_time_login = '$time_login' WHERE mb_url = '$member_login'";
                $time_login = mysqli_query($conn, $sql);
            }
            
        } else {
            $errorMsg = "ที่อยู่อีเมลหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <title>ลงชื่อเข้าใช้ &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="ลงชื่อเข้าใช้ &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/login">
    <meta property="og:site_name" content="ลงชื่อเข้าใช้ &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/login">
    <meta name="twitter:title" content="ลงชื่อเข้าใช้ &#8211; <?php echo $server['sv_title']; ?>">
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

    <!-- Form login -->
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
                                                <label for="login_email" class="form-label ms-2">ที่อยู่อีเมลที่ลงทะเบียน <span class="sp-red">*</span></label>
                                                <input type="email" name="login_email" class="form-control" id="login_email" value="<?php echo isset($login_email) ? $login_email : '' ?>" placeholder="Email" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="login_password" class="form-label ms-2">รหัสผ่านที่ลงทะเบียน <span class="sp-red">*</span></label>
                                                <input type="password" name="login_password" class="form-control" id="login_password" value="<?php echo isset($login_password) ? $login_password : '' ?>" placeholder="Password" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="wp-content-LRF-form-link"><a href="<?php echo $server['sv_url']; ?>/forgot-password">ลืมรหัสผ่าน ?</a></div>
                                            <div class="wp-content-LRF-form-link">หากยังไม่มีบัญชี <a href="<?php echo $server['sv_url']; ?>/register">สมัครสมาชิก</a></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-sm-6 mt-3 mx-auto">
                                                <div class="d-grid">
                                                    <button type="submit" name="btn_login" class="btn btn-blue">ลงชื่อเข้าใช้</button>
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