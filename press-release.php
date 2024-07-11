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
    <title>ข่าวประชาสัมพันธ์ &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:title" content="ข่าวประชาสัมพันธ์ &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/press-release">
    <meta property="og:site_name" content="ข่าวประชาสัมพันธ์ &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/press-release">
    <meta name="twitter:title" content="ข่าวประชาสัมพันธ์ &#8211; <?php echo $server['sv_title']; ?>">
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

    <!-- Message breakpoint -->
    <section>
        <div class="wp-content-message-breadcrumb">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header align-items-center">
                        <div class="overlay"></div>
                        <div class="wp-content-breadcrumb-title">
                            <h1 class="display-5">ข่าวประชาสัมพันธ์</h1>
                        </div>
                        <div class="wp-content-header-breadcrumb">
                            <div class="wp-content-breadcrumb-item">
                                <a href="<?php echo $server['sv_url']; ?>">หน้าหลัก</a><span class="breadcrumb-divider"></span>ข่าวประชาสัมพันธ์
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course e-Learning -->
    <section>
        <div class="wp-content-course">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>ประชาสัมพันธ์</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="row gx-4">
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="#" class="wp-content-a-card">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="https://elearning.set.or.th/_c_/data-file/assets/courses/thumbnail/160519024242-WMD1001.png" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <h4 class="wp-content-course-code">30204-2007</h4>
                                            <h4 class="wp-content-course-title">หลักการสื่อสารข้อมูลและเครื่อข่าย</h4>
                                            <h4 class="wp-content-course-subject text-muted">คุณสมบัติพื้นฐานและรูปแบบของการสื่อสารข้อมูล องค์ประกอบของเครือข่ายคอมพิวเตอร์ และหลักการทำงานของเครือข่ายคอมพิวเตอร์</h4>
                                            <h4 class="wp-content-course-category"><i class="fas fa-folder-open"></i>เครือข่ายคอมพิวเตอร์</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="#" class="wp-content-a-card">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="https://elearning.set.or.th/_c_/data-file/assets/courses/thumbnail/160519024242-WMD1001.png" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <h4 class="wp-content-course-code">30204-2007</h4>
                                            <h4 class="wp-content-course-title">หลักการสื่อสารข้อมูลและเครื่อข่าย</h4>
                                            <h4 class="wp-content-course-subject text-muted">คุณสมบัติพื้นฐานและรูปแบบของการสื่อสารข้อมูล องค์ประกอบของเครือข่ายคอมพิวเตอร์ และหลักการทำงานของเครือข่ายคอมพิวเตอร์</h4>
                                            <h4 class="wp-content-course-category"><i class="fas fa-folder-open"></i>เครือข่ายคอมพิวเตอร์</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="#" class="wp-content-a-card">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="https://elearning.set.or.th/_c_/data-file/assets/courses/thumbnail/160519024242-WMD1001.png" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <h4 class="wp-content-course-code">30204-2007</h4>
                                            <h4 class="wp-content-course-title">หลักการสื่อสารข้อมูลและเครื่อข่าย</h4>
                                            <h4 class="wp-content-course-subject text-muted">คุณสมบัติพื้นฐานและรูปแบบของการสื่อสารข้อมูล องค์ประกอบของเครือข่ายคอมพิวเตอร์ และหลักการทำงานของเครือข่ายคอมพิวเตอร์</h4>
                                            <h4 class="wp-content-course-category"><i class="fas fa-folder-open"></i>เครือข่ายคอมพิวเตอร์</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="#" class="wp-content-a-card">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="https://elearning.set.or.th/_c_/data-file/assets/courses/thumbnail/160519024242-WMD1001.png" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <h4 class="wp-content-course-code">30204-2007</h4>
                                            <h4 class="wp-content-course-title">หลักการสื่อสารข้อมูลและเครื่อข่าย</h4>
                                            <h4 class="wp-content-course-subject text-muted">คุณสมบัติพื้นฐานและรูปแบบของการสื่อสารข้อมูล องค์ประกอบของเครือข่ายคอมพิวเตอร์ และหลักการทำงานของเครือข่ายคอมพิวเตอร์</h4>
                                            <h4 class="wp-content-course-category"><i class="fas fa-folder-open"></i>เครือข่ายคอมพิวเตอร์</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="#" class="wp-content-a-card">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="https://elearning.set.or.th/_c_/data-file/assets/courses/thumbnail/160519024242-WMD1001.png" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <h4 class="wp-content-course-code">30204-2007</h4>
                                            <h4 class="wp-content-course-title">หลักการสื่อสารข้อมูลและเครื่อข่าย</h4>
                                            <h4 class="wp-content-course-subject text-muted">คุณสมบัติพื้นฐานและรูปแบบของการสื่อสารข้อมูล องค์ประกอบของเครือข่ายคอมพิวเตอร์ และหลักการทำงานของเครือข่ายคอมพิวเตอร์</h4>
                                            <h4 class="wp-content-course-category"><i class="fas fa-folder-open"></i>เครือข่ายคอมพิวเตอร์</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="#" class="wp-content-a-card">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="https://elearning.set.or.th/_c_/data-file/assets/courses/thumbnail/160519024242-WMD1001.png" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <h4 class="wp-content-course-code">30204-2007</h4>
                                            <h4 class="wp-content-course-title">หลักการสื่อสารข้อมูลและเครื่อข่าย</h4>
                                            <h4 class="wp-content-course-subject text-muted">คุณสมบัติพื้นฐานและรูปแบบของการสื่อสารข้อมูล องค์ประกอบของเครือข่ายคอมพิวเตอร์ และหลักการทำงานของเครือข่ายคอมพิวเตอร์</h4>
                                            <h4 class="wp-content-course-category"><i class="fas fa-folder-open"></i>เครือข่ายคอมพิวเตอร์</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="#" class="wp-content-a-card">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="https://elearning.set.or.th/_c_/data-file/assets/courses/thumbnail/160519024242-WMD1001.png" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <h4 class="wp-content-course-code">30204-2007</h4>
                                            <h4 class="wp-content-course-title">หลักการสื่อสารข้อมูลและเครื่อข่าย</h4>
                                            <h4 class="wp-content-course-subject text-muted four-text">คุณสมบัติพื้นฐานและรูปแบบของการสื่อสารข้อมูล องค์ประกอบของเครือข่ายคอมพิวเตอร์ และหลักการทำงานของเครือข่ายคอมพิวเตอร์</h4>
                                            <h4 class="wp-content-course-category"><i class="fas fa-folder-open"></i>เครือข่ายคอมพิวเตอร์</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="#" class="wp-content-a-card">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="https://elearning.set.or.th/_c_/data-file/assets/courses/thumbnail/160519024242-WMD1001.png" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <h4 class="wp-content-course-code">30204-2007</h4>
                                            <h4 class="wp-content-course-title">หลักการสื่อสารข้อมูลและเครื่อข่าย</h4>
                                            <h4 class="wp-content-course-subject text-muted">คุณสมบัติพื้นฐานและรูปแบบของการสื่อสารข้อมูล องค์ประกอบของเครือข่ายคอมพิวเตอร์ และหลักการทำงานของเครือข่ายคอมพิวเตอร์</h4>
                                            <h4 class="wp-content-course-category"><i class="fas fa-folder-open"></i>เครือข่ายคอมพิวเตอร์</h4>
                                        </div>
                                    </div>
                                </a>
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