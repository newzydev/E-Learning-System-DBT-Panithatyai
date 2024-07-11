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
    <title>PRIVACY POLICY &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="PRIVACY POLICY &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/about">
    <meta property="og:site_name" content="PRIVACY POLICY &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/about">
    <meta name="twitter:title" content="PRIVACY POLICY &#8211; <?php echo $server['sv_title']; ?>">
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
                            <h1 class="display-5">นโยบายความเป็นส่วนตัว</h1>
                        </div>
                        <div class="wp-content-header-breadcrumb">
                            <div class="wp-content-breadcrumb-item">
                                <a href="<?php echo $server['sv_url']; ?>">หน้าหลัก</a><span class="breadcrumb-divider"></span>นโยบายความเป็นส่วนตัว
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Privacy Policy -->
    <section>
        <div class="wp-content-about">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>นโยบายความเป็นส่วนตัว</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="col-sm-9 mx-auto">
                            <div class="wp-content-about-widget-thai">
                                <?php echo $server['sv_privacy_policy']; ?>
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