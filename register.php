<?php
// เชื่อมต่อฐานข้อมูล
require_once('server.php');
session_start();

// รับคำสั่งมาจากปุ่ม
if (isset($_REQUEST['btn_register_sdgfsdbdfsjkd'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $register_url = getName($n);
    $register_firstname = $_POST["register_firstname"];
    $register_lastname = $_POST["register_lastname"];
    $register_email = $_POST["register_email"];
    $register_password_1 = $_POST["register_password_1"];
    $register_password_2 = $_POST["register_password_2"];
    $register_school = $_POST["register_school"];
    $register_tel = $_POST["register_tel"];
    $register_level = "2"; // Set default = 2 (1 = admins , 2 = students)
    $register_time_add = datetime();
    $register_time_edit = datetime();
    $register_time_login = datetime();

    // เช็คที่อยู่อีเมลซ้ำ
    $check_email = "SELECT * FROM tbl_member_db WHERE mb_email ='$register_email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        $_SESSION['userid'] = $row['mb_id'];
        $_SESSION['email'] = $row['mb_email'];

        if ($register_email == $_SESSION['email']) {
            $errorMsg = "ที่อยู่อีเมล์นี้ได้ถูกใช้ไปแล้ว";
        }
    }

    // เช็คการป้อนข้อมูล
    if (empty($register_firstname) || empty($register_lastname) || empty($register_email) || empty($register_password_1) || empty($register_password_2) || empty($register_tel)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    } else if ($register_password_1 != $register_password_2) {
        $errorMsg = "กรุณากรอกรหัสผ่านทั้งสองให้ตรงกัน";
    }

    // เข้ารหัสพาสเวิร์ด
    $passwordenc = md5($register_password_1);

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_member_db(mb_url, mb_firstname, mb_lastname, mb_email, mb_password, mb_school, mb_tel, mb_level, mb_time_add, mb_time_edit, mb_time_login)
                VALUE('$register_url', '$register_firstname', '$register_lastname', '$register_email', '$passwordenc', '$register_school', '$register_tel', '$register_level', '$register_time_add', '$register_time_edit', '$register_time_login')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "สมัครสมาชิกสำเร็จ";
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
    <title>สมัครสมาชิก &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="สมัครสมาชิก &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/register">
    <meta property="og:site_name" content="สมัครสมาชิก &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/register">
    <meta name="twitter:title" content="สมัครสมาชิก &#8211; <?php echo $server['sv_title']; ?>">
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

    <!-- Form register -->
    <section>
        <div class="wp-content-LRF">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="pt-100 d-none d-lg-block"></div>
                    <div class="wp-content-LRF-container">
                        <form action="" method="post">
                            <div class="col-sm-12 col-md-6 col-lg-5 mx-auto">

                            <div class="alert alert-primary d-flex align-item-center justify-content-center mb-3" role="alert">
                                <i class="fas fa-info-circle me-2"></i>ประกาศผู้ดูแลระบบ :: ขอปิดระบบในส่วนการสมัครสมาชิก ขออภัยในความไม่สะดวก ทีมงาน DBTLEARNING
                            </div>

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
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="register_firstname" class="form-label ms-2">ชื่อจริง <span class="sp-red">*</span></label>
                                                <input type="text" name="register_firstname" class="form-control" id="register_firstname" value="<?php echo isset($register_firstname) ? $register_firstname : '' ?>" placeholder="First Name" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="register_lastname" class="form-label ms-2">นามสกุล <span class="sp-red">*</span></label>
                                                <input type="text" name="register_lastname" class="form-control" id="register_lastname" value="<?php echo isset($register_lastname) ? $register_lastname : '' ?>" placeholder="Last Name" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="register_email" class="form-label ms-2">ที่อยู่อีเมล <span class="sp-red">*</span></label>
                                                <input type="email" name="register_email" class="form-control" id="register_email" value="<?php echo isset($register_email) ? $register_email : '' ?>" placeholder="Email" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="register_password_1" class="form-label ms-2">รหัสผ่าน <span class="sp-red">*</span></label>
                                                <input type="password" name="register_password_1" class="form-control" id="register_password_1" value="<?php echo isset($register_password_1) ? $register_password_1 : '' ?>" placeholder="Password" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="register_password_2" class="form-label ms-2">ยืนยันรหัสผ่าน <span class="sp-red">*</span></label>
                                                <input type="password" name="register_password_2" class="form-control" id="register_password_2" value="<?php echo isset($register_password_2) ? $register_password_2 : '' ?>" placeholder="Confirm Password" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="register_school" class="form-label ms-2">ชื่อสถานศึกษา (ถ้ามี)</label>
                                                <input type="text" name="register_school" class="form-control" id="register_school" value="<?php echo isset($register_school) ? $register_school : '' ?>" placeholder="College" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="register_tel" class="form-label ms-2">เบอร์โทรศัพท์ <span class="sp-red">*</span></label>
                                                <input type="tel" name="register_tel" class="form-control" id="register_tel" value="<?php echo isset($register_tel) ? $register_tel : '' ?>" placeholder="Phone Number" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="wp-content-LRF-form-link"><a href="<?php echo $server['sv_url']; ?>/forgot-password">ลืมรหัสผ่าน ?</a></div>
                                            <div class="wp-content-LRF-form-link">หากมีบัญชีแล้ว <a href="<?php echo $server['sv_url']; ?>/login">ลงชื่อเข้าใช้</a></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-sm-6 mt-3 mx-auto">
                                                <div class="d-grid">
                                                    <button type="submit" name="btn_register_disabled" class="btn btn-blue" disabled>สมัครสมาชิก</button>
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