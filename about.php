<?php
require_once('server.php');
session_start();

// ออกจากระบบ
if (isset($_REQUEST['logout'])) {
    session_destroy();
    unset($_SESSION['member_url']);
    $redirect = $server['sv_url'] . "/login";
    header("location:$redirect");
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <title>ABOUNT &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="ABOUNT &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/about">
    <meta property="og:site_name" content="ABOUNT &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/about">
    <meta name="twitter:title" content="ABOUNT &#8211; <?php echo $server['sv_title']; ?>">
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
                            <h1 class="display-5">เกี่ยวกับเรา</h1>
                        </div>
                        <div class="wp-content-header-breadcrumb">
                            <div class="wp-content-breadcrumb-item">
                                <a href="<?php echo $server['sv_url']; ?>">หน้าหลัก</a><span class="breadcrumb-divider"></span>เกี่ยวกับเรา
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section>
        <div class="wp-content-about">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>สัญลักษณ์ของแหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="wp-content-about-widget-title">
                            เครื่องหมายประจำเว็บไซต์ เป็นรูป วงกลม
                        </div>
                        <div class="wp-content-about-widget-img">
                            <img src="<?php echo $server['sv_url']; ?>/assets/images/logo.png">
                        </div>
                        <div class="wp-content-about-widget-item">
                            วงกลม หมายถึง การเป็นกลุ่มเดียวกัน มิตรภาพ ความรัก ความสัมพันธ์
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="wp-content-about">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>สัญลักษณ์ของวิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="wp-content-about-widget-title">
                            เครื่องหมายประจำวิทยาลัย เป็นรูป เรือ รวงข้าว ดวงดาว
                        </div>
                        <div class="wp-content-about-widget-img">
                            <img src="<?php echo $server['sv_url']; ?>/assets/images/Logo-Hcc-Innernew.png">
                        </div>
                        <div class="wp-content-about-widget-item">
                            เรือ หมายถึง การค้า, ธุรกิจ<br>รวงข้าว หมายถึง ความเจริญงอกงาม<br>ดวงดาว หมายถึง ความสำเร็จในชีวิต
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wp-content-about">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>สีของวิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="wp-content-about-widget-title">
                            คือ สีฟ้า สีขาว
                        </div>
                        <div class="wp-content-about-widget-img">
                            <img src="<?php echo $server['sv_url']; ?>/assets/images/web-color.jpg">
                        </div>
                        <div class="wp-content-about-widget-item">
                            สีฟ้า หมายถึง ความดีงามอันสูงส่งเป็นเลิศ<br>สีขาว หมายถึง ความบริสุทธิ์
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wp-content-about">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>หลักการและกรอบแนวคิด</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="wp-content-about-widget-thai">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่ เน้นการปฏิรูปการศึกษาและการเรียนรู้ โดยมีกลไกที่จะก่อให้เกิดผลต่อการพัฒนาการศึกษาและการเรียนรู้อย่างเป็นระบบ รวมทั้งจัดระบบการศึกษาและการเรียนรู้ในฐานะที่เป็นส่วนหนึ่งของระบบการพัฒนาประเทศ จึงต้องเชื่อมโยงกับการพัฒนาระบบอื่น ทั้งด้านเศรษฐกิจ สังคม การเมือง การปกครอง เกษตรกรรม สาธารณสุข การจ้างงาน เป็นต้น
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wp-content-about">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>วิสัยทัศน์</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="wp-content-about-widget-thai">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่ กาหนดวิสัยทัศน์ของวิทยาลัยฯ ไว้ดังนี้ “เป็นสถาบันแห่งการเรียนรู้วิชาชีพ มุ่งผลิตกาลังคนด้านอาชีวศึกษาให้ได้มาตรฐานสู่ความเป็นสากล”
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wp-content-about">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>พันธกิจ</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="wp-content-about-widget-thai">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่ กำหนดพันธกิจเพื่อให้บรรลุซึ่งวิสัยทัศน์ของวิทยาลัยฯ ไว้ดังนี้<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.&nbsp;&nbsp;คุณลักษณะของผู้สำเร็จการศึกษาอาชีวศึกษาที่พึงประสงค์: พัฒนาด้านความรู้ ด้านทักษะและการประยุกต์ใช้ มีคุณธรรมและจริยธรรม<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;&nbsp;การจัดการอาชีวศึกษา: มุ่งสู่กระบวนการจัดการเรียนรู้ที่เน้นผู้เรียนเป็นสำคัญ<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;&nbsp;การสร้างสังคมแห่งการเรียนรู้: สร้างภาคีเครือข่ายการเรียนรู้และแลกเปลี่ยนเรียนรู้ร่วมกันระหว่างบุคคล ชุมชน หน่วยงาน องค์กร สถานประกอบการ<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.&nbsp;&nbsp;การจัดการสถานศึกษาสู่ความเป็นเลิศ: สร้างความเป็นเลิศในทุกด้านและยกระดับคุณภาพมาตรฐานสู่สากล
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wp-content-about">
        <div class="vol-sm-12 col-md-12 col-lg-12">
            <img src="<?php echo $server['sv_url']; ?>/assets/images/wp-content-3.png" width="100%">
        </div>
    </div>

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