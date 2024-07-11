<?php
require_once('server.php');
session_start();

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$query_data_1 = "SELECT * FROM tbl_article_db ORDER BY at_id DESC";
$result_data_1 = mysqli_query($conn, $query_data_1);

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$query_data_2 = "SELECT * FROM tbl_course_db ORDER BY cs_id DESC";
$result_data_2 = mysqli_query($conn, $query_data_2);

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
    <title>SITE MAP &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="SITE MAP &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/sitemap">
    <meta property="og:site_name" content="SITE MAP &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/sitemap">
    <meta name="twitter:title" content="SITE MAP &#8211; <?php echo $server['sv_title']; ?>">
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
                            <h1 class="display-5">แผนผังเว็บไซต์</h1>
                        </div>
                        <div class="wp-content-header-breadcrumb">
                            <div class="wp-content-breadcrumb-item">
                                <a href="<?php echo $server['sv_url']; ?>">หน้าหลัก</a><span class="breadcrumb-divider"></span>แผนผังเว็บไซต์
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
                        <h3>แผนผังเว็บไซต์</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="wp-content-about-widget-thai">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 sitemap mb-3">
                                    <strong class="sp-orange">แถบเมนู</strong>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>" class="sitemap-link">หน้าหลัก</a></p>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/about" class="sitemap-link">เกี่ยวกับเรา</a></p>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/courses" class="sitemap-link">หลักสูตรทั้งหมด</a></p>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/articles" class="sitemap-link">บทความทั้งหมด</a></p>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/web-developer" class="sitemap-link">ทีมงานผู้พัฒนา</a></p>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/contact-us" class="sitemap-link">ติดต่อเรา</a></p>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/how-to-use" class="sitemap-link">วิธีใช้งานระบบ</a></p>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 sitemap mb-3">
                                    <strong class="sp-orange">สมาชิก</strong>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/login" class="sitemap-link">ลงชื่อเข้าใช้</a></p>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/register" class="sitemap-link">สมัครสมาชิก</a></p>
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/forgot-password" class="sitemap-link">ลืมรหัสผ่าน ?</a></p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 sitemap mb-3">
                                    <strong class="sp-orange">หลักสูตรทั้งหมด (เรียงลำดับจากข้อมูลล่าสุด)</strong><?php while ($row = mysqli_fetch_assoc($result_data_2)) { ?>
                                        
                                    <p>- <a href="<?php echo $server['sv_url']; ?>/course/<?php echo $row['cs_url']; ?>" class="sitemap-link"><?php echo $row['cs_name']; ?></a></p><?php } ?>
                                        
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 sitemap mb-3">
                                    <strong class="sp-orange">บทความทั้งหมด (เรียงลำดับจากข้อมูลล่าสุด)</strong><?php while ($row = mysqli_fetch_assoc($result_data_1)) { ?>

                                    <p>- <a href="<?php echo $server['sv_url']; ?>/article/<?php echo $row['at_url']; ?>" class="sitemap-link"><?php echo $row['at_title']; ?></a></p><?php } ?>

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