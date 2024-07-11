<?php
require_once('server.php');
session_start();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <title>HOW TO USE &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="HOW TO USE &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/video-tutorials-on-how-to-use-the-system.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/how-to-use">
    <meta property="og:site_name" content="HOW TO USE &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/how-to-use">
    <meta name="twitter:title" content="HOW TO USE &#8211; <?php echo $server['sv_title']; ?>">
    <meta name="twitter:image" content="<?php echo $server['sv_url']; ?>/assets/images/video-tutorials-on-how-to-use-the-system.png">
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
                            <h1 class="display-5">วิธีใช้งานระบบ</h1>
                        </div>
                        <div class="wp-content-header-breadcrumb">
                            <div class="wp-content-breadcrumb-item">
                                <a href="<?php echo $server['sv_url']; ?>">หน้าหลัก</a><span class="breadcrumb-divider"></span>วิธีใช้งานระบบ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sitemap -->
    <section>
        <div class="wp-content-about">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>วิธีใช้งานระบบ</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="col-sm-9 mx-auto">
                            <div class="wp-content-about-widget-thai">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="text-center mb-3">
                                            วิดีโอการใช้งานระบบ
                                        </div>
                                        <video width="100%" controls controlsList="nodownload" poster="<?php echo $server['sv_url']; ?>/assets/images/video-tutorials-on-how-to-use-the-system.png" class="mb-3" style="box-shadow: 0 1px 6px 1px rgba(0, 0, 0, 0.2);border-radius: 5px;">
                                            <source src="<?php echo $server['sv_url']; ?>/assets/video-tutorials-on-how-to-use-the-system.mp4" type="video/mp4">
                                            Your browser does not support HTML video.
                                        </video>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="text-center mb-3">
                                            วิธีการใช้งานระบบ
                                        </div>
                                        <div>
                                            1)&nbsp;&nbsp;เลือกหลักสูตรได้จากหน้าแรก หรือหน้าหลักสูตรทั้งหมด<br>
                                            2)&nbsp;&nbsp;เมื่อผู้ใช้คลิกเลือกหลักสูตรก็จะแสดงหน้ารายละเอียดหลักสูตร<br>
                                            3)&nbsp;&nbsp;ผู้ใช้จำเป็นจะต้องลงชื่อเข้าใช้ระบบก่อน ระบบจึงจะอนุญาตให้ผู้ใช้ลงทะเบียนหลักสูตรได้<br>
                                            4)&nbsp;&nbsp;เมื่อผู้ใช้ลงชื่อเข้าใช้ระบบเรียบร้อยแล้ว ผู้ใช้สามารถเลือกลงทะเบียนหลักสูตรได้<br>
                                            5)&nbsp;&nbsp;เมื่อผู้ใช้ลงทะเบียนหลักสูตรเรียบร้อยแล้ว ระบบก็จะพาไปยังหน้าหลักสูตร<br>
                                            6)&nbsp;&nbsp;หน้าหลักสูตรผู้ใช้สามารถเลือกเรียนได้แต่ละหน่วย แล้วแต่ละหน่วยจะมีแบบทดสอบท้ายหน่วย 5 ข้อ<br>
                                            7)&nbsp;&nbsp;เมื่อผู้ใช้เลือกหน่วย ระบบก็จะพาผู้ใช้ไปยังหน้าหน่วยซึ่งประกอบด้วยหัวข้อและเนื้อหา<br>
                                            8)&nbsp;&nbsp;เมื่อผู้ใช้เรียนจากหัวข้อและเนื้อหาเรียบร้อยแล้ว ผู้ใช้จะต้องเลือกเมนูทำแบบทดสอบ<br>
                                            9)&nbsp;&nbsp;เมื่อผู้ใช้เลือกเมนูทำแบบทดสอบ หน้าแบบทดสอบจะแสดงขึ้นมา<br>
                                            10)&nbsp;&nbsp;เมื่อผู้ใช้ทำแบบทดสอบเรียบร้อยแล้ว ผู้ใช้จะต้องติ๊กยืนยัน ถึงจะสามารถคลิกปุ่มส่งคำตอบได้<br>
                                            11)&nbsp;&nbsp;หลังจากนั้นระบบจะทำการตรวจสอบ และคำนวนคะแนนให้<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ถ้าผู้ใช้ทำถูก 3 ข้อขึ้นไป ระบบก็จะแสดงข้อความว่า “ขอแสดงความยินดี คุณผ่านแบบทดสอบ”<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ถ้าผู้ใช้ทำผิด 3 ข้อขึ้นไป ระบบก็จะแสดงข้อความว่า “ขอแสดงความเสียใจ คุณไม่ผ่านแบบทดสอบ”<br>
                                            12)&nbsp;&nbsp;เสร็จสิ้น ผู้ใช้สามารถกดปุ่มกลับไปยังหน้าหลักสูตร หรือสู่หน้าหลักได้เลย

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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