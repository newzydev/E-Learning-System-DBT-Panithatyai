<?php
require_once('server.php');
session_start();

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$query_data_a = "SELECT * FROM tbl_article_db as a
INNER JOIN tbl_category_db as c ON a.cg_url=c.cg_url 
ORDER BY at_id DESC";
$result_data_a = mysqli_query($conn, $query_data_a);
$count_data = mysqli_num_rows($result_data_a);
$order = 1;

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
    <title>ARTICLES &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="ARTICLES &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/articles">
    <meta property="og:site_name" content="ARTICLES &#8211; <?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/articles">
    <meta name="twitter:title" content="ARTICLES &#8211; <?php echo $server['sv_title']; ?>">
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

<body id="content">
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
                            <h1 class="display-5">บทความทั้งหมด&nbsp;&nbsp;<?php echo number_format($count_data); ?>&nbsp;&nbsp;รายการ</h1>
                        </div>
                        <div class="wp-content-header-breadcrumb">
                            <div class="wp-content-breadcrumb-item">
                                <a href="<?php echo $server['sv_url']; ?>">หน้าหลัก</a><span class="breadcrumb-divider"></span>บทความทั้งหมด
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section id="m-80">
        <div class="wp-content-read">
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-12 col-md-12 col-lg-8 mb-4" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;"><?php while ($row = mysqli_fetch_assoc($result_data_a)) { ?>
                        
                        <a href="<?php echo $server['sv_url']; ?>/article/<?php echo $row['at_url']; ?>" style="display: block;" title="<?php echo $row['at_title']; ?>">
                            <div class="col-sm-12 mb-4">
                                <div class="wp-content-read">
                                    <div class="wp-content-read-thumbnail">
                                        <img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/articles/<?php echo $row['at_img']; ?>" width="100%">
                                    </div>
                                    <div class="wp-content-read-title">
                                        <i class="fas fa-quote-left me-2"></i><?php echo $row['at_title']; ?><i class="fas fa-quote-right ms-2"></i>
                                    </div>
                                    <div class="wp-content-read-date d-none d-md-block">
                                        <i class="far fa-calendar-alt"></i><?php echo $row['at_time_add']; ?><span></span><i class="fas fa-folder-open"></i><?php echo $row['cg_name']; ?><span></span><i class="fas fa-user"></i>ADMIN DBT / PANITHATYAI
                                    </div>
                                    <div class="wp-content-read-date-m d-md-none d-md-block">
                                        <div class="mt-2 mb-2"><i class="far fa-calendar-alt"></i><?php echo $row['at_time_add']; ?></div>
                                        <div class="mt-2 mb-2"><i class="fas fa-folder-open"></i><?php echo $row['cg_name']; ?></div>
                                        <div><i class="fas fa-user"></i>ADMIN DBT / PANITHATYAI</div>
                                    </div>
                                </div>
                            </div>
                        </a><?php } ?>

                    </div>
                    <?php include('include/aside.php'); ?>
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