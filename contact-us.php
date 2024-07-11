<?php
require_once('server.php');
session_start();

// เพิ่มข้อมูล
if (isset($_REQUEST['btn_sent_fdsfsrdfsdgvdfd'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $ct_url = getName($n);
    $ct_firstname = $_POST["contact_firstname"];
    $ct_lastname = $_POST["contact_lastname"];
    $ct_email = $_POST["contact_email"];
    $ct_local = $_POST["contact_local"];
    $ct_subject = $_POST["contact_subject"];
    $ct_message = $_POST["contact_message"];
    $ct_time_sent = datetime();
    // เช็คการป้อนข้อมูล
    if (empty($ct_firstname) || empty($ct_lastname) || empty($ct_email) || empty($ct_subject) || empty($ct_message)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    } 

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_contact_db(ct_url, ct_firstname, ct_lastname, ct_email, ct_local, ct_subject, ct_message, ct_time_sent)
                VALUE('$ct_url', '$ct_firstname', '$ct_lastname', '$ct_email', '$ct_local', '$ct_subject', '$ct_message', '$ct_time_sent')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "ส่งข้อมูลติดต่อสำเร็จ";
            $redirect = $server['sv_url'] . "/contact-us";
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
    <title>CONTACT US &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="CONTACT US &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/contact-us">
    <meta property="og:site_name" content="CONTACT US &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/contact-us">
    <meta name="twitter:title" content="CONTACT US &#8211; <?php echo $server['sv_title']; ?>">
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

    <!-- Message breakpoint -->
    <section>
        <div class="wp-content-message-breadcrumb">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header align-items-center">
                        <div class="overlay"></div>
                        <div class="wp-content-breadcrumb-title">
                            <h1 class="display-5">ติดต่อเรา</h1>
                        </div>
                        <div class="wp-content-header-breadcrumb">
                            <div class="wp-content-breadcrumb-item">
                                <a href="<?php echo $server['sv_url']; ?>">หน้าหลัก</a><span class="breadcrumb-divider"></span>ติดต่อเรา
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section>
        <div class="wp-content-contact">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>ติดต่อเรา</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                    <div class="wp-contact-map mb-3">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.9291931977978!2d100.48931981525142!3d7.017609219167564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304d29a9dbcb41a1%3A0xe2494563659f4bbb!2z4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4LmA4LiX4LiE4LmC4LiZ4LmC4Lil4Lii4Li14Lie4LiT4Li04LiK4Lii4LiB4Liy4Lij4Lir4Liy4LiU4LmD4Lir4LiN4LmI!5e0!3m2!1sen!2sth!4v1641389638823!5m2!1sen!2sth" width="100%" height="410" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    </div>
                                    <div class="wp-contact-link">
                                        <div class="wp-contact-title">
                                            <h4 class="sp-orange">สถานที่ตั้ง</h4>
                                        </div>
                                        <div class="wp-contact-detail">
                                            <p>วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่ ตั้งอยู่ เลขที่ 4 ซ.5 ถ.เพชรเกษม ต.หาดใหญ่ อ.หาดใหญ่ จ.สงขลา ประตูทางเข้าวิทยาลัยสามารถเข้าได้ 2 ทาง<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ทางเข้าประตูวิทยาลัยส่วนหน้าซึ่งติดกับส่วนของห้องปฏิบัติการสาขาวิชาการโรงแรมและบริการ ติดริมถนนเพชรเกษม<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ประตูใหญ่ทางเข้าวิทยาลัยจะอยู่ในซอย 5 ถนนเพชรเกษม จากถนนใหญ่เข้ามาประมาณ 150 เมตร</p>
                                        </div>
                                    </div>
                                    <div class="wp-contact-link">
                                        <div class="wp-contact-title">
                                            <h4 class="sp-orange">โซเชียลมีเดีย</h4>
                                        </div>
                                        <div class="wp-contact-detail">
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<a href="https://www.facebook.com/dekpanithatyai">วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<a href="https://www.facebook.com/dekcompanit">สาขาเทคโนโลยีธุรกิจดิจิทัล</a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<a href="https://www.facebook.com/DBTLEARNING">แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</a></p>
                                        </div>
                                    </div>
                                    <div class="wp-contact-link">
                                        <div class="wp-contact-title">
                                            <h4 class="sp-orange">ติดต่อเรา</h4>
                                        </div>
                                        <div class="wp-contact-detail">
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<a href="https://mail.google.com/mail/?view=cm&fs=1&to=contact@dbtlearning.com&authuser=0" target="_blank">contact@dbtlearning.com</a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<a href="http://www.dbtlearning.com/">www.dbtlearning.com</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <div class="alert alert-primary d-flex align-item-center justify-content-center" role="alert">
                                                    <i class="fas fa-info-circle me-2"></i>ประกาศผู้ดูแลระบบ :: ขอปิดระบบในส่วนฟอร์มการติดต่อ เนื่องจากมีผู้ไม่หวังดีส่งข้อความเข้ามาในระบบจำนวนมาก ซึ่งทีมงานได้ตรวจสอบแล้วว่าข้อความทั้งหมดที่ได้ส่งมานั้น คือการพยายามมุ่งทำลายระบบ เจาะข้อมูลเซิร์ฟเวอร์ของเรา ทางทีมงานเล็งเห็นถึงความปลอดภัยของผู้ใช้งานถึงแม้ว่าทึมงานจะพัฒนาระบบและยกระบบความปลอดภัย ด้วยการเข้ารหัส ที่อยู่อีเมล์ เบอร์โทรศัพท์ และเบอร์โทรศัพท์ของผู้ใช้ไปตั้งแต่เริ่มต้นแล้ว รวมถึงระบบรักษาความปลอดภัยทุกหน้า มันอาจยังไม่พอ ในครั้งนี้จึงขอปิดระบบฟอร์มการติดต่อที่มีความเสี่ยงอยู่นี้<br><br>*** แต่ก็ยังสามารถติดต่อพูดคุยกับพวกเราได้ เช่นเดิม ผ่านชองทาง Facebook Page : แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่ หรือ @DBTLEARNING เพื่อให้ระบบมีความปลอดภัยยิ่งขึ้น<br><br>ขออภัยในความไม่สะดวก<br>ทีมงาน DBTLEARNING
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
    
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
    
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="contact_firstname" class="form-label">ชื่อจริง <span class="sp-red">*</span></label>
                                                <input type="text" name="contact_firstname" class="form-control" id="contact_firstname" placeholder="First Name" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="contact_lastname" class="form-label">นามสกุล <span class="sp-red">*</span></label>
                                                <input type="text" name="contact_lastname" class="form-control" id="contact_lastname" placeholder="Last Name" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="contact_email" class="form-label">ที่อยู่อีเมล <span class="sp-red">*</span></label>
                                                <input type="email" name="contact_email" class="form-control" id="contact_email" placeholder="Email" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="contact_local" class="form-label">ชื่อสถานศึกษา หน่วยงาน หรือบริษัท (ถ้ามี)</label>
                                                <input type="text" name="contact_local" class="form-control" id="contact_local" placeholder="College, Agency, Company" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="contact_subject" class="form-label">หัวข้อเรื่อง <span class="sp-red">*</span></label>
                                                <input type="text" name="contact_subject" class="form-control" id="contact_subject" placeholder="Subject" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label for="contact_message" class="form-label">ข้อความ <span class="sp-red">*</span> (จำกัดข้อความ 500 ตัวอักษร)</label>
                                                <textarea name="contact_message" class="form-control" id="contact_message" rows="10" placeholder="Message" size="500" disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <span id="now_length">จำนวนที่เหลือ 500 ตัวอักษร</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-2">
                                                <b>ยืนยันข้อมูลติดต่อ</b>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" name="confirm_accept_disabled" id="confirm_accept_disabled" class="form-check-input" disabled>
                                                <label class="form-check-label" for="confirm_accept_disabled">ยืนยัน</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-sm-3 mt-3 mx-auto">
                                                <div class="d-grid">
                                                    <button type="submit" name="btn_sent_disabled" id="btn_confirm" class="btn btn-primary" disabled>ส่งข้อความ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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