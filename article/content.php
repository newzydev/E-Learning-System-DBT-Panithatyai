<?php
require_once('../server.php');
session_start();

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$at_url = $_GET['at_url'];
$query_data_con = "SELECT * FROM tbl_article_db as a
INNER JOIN tbl_category_db as c ON a.cg_url=c.cg_url 
WHERE at_url = '$at_url'";
$result_data_con = mysqli_query($conn, $query_data_con);
$cont = mysqli_fetch_assoc($result_data_con);

// นับจำนวนการเข้าชมเว็บ
$sql = "UPDATE tbl_article_db SET 
at_view = at_view+1 WHERE at_url = '$at_url'";
// สั่งรันคำสั่ง sql
$result = mysqli_query($conn, $sql);

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
    <title><?php echo $cont['at_title']; ?> &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="<?php echo $cont['at_title']; ?>" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/wp-contents/uploads/articles/<?php echo $cont['at_img']; ?>" />
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/article/<?php echo $cont['at_url']; ?>" />
    <meta property="og:site_name" content="<?php echo $cont['at_title']; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="th_TH" />
    <meta property="og:locale:alternate" content="en_US" />
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/article/<?php echo $cont['at_url']; ?>" />
    <meta name="twitter:title" content="<?php echo $cont['at_title']; ?>" />
    <meta name="twitter:image" content="<?php echo $server['sv_url']; ?>/wp-contents/uploads/articles/<?php echo $cont['at_img']; ?>" />
    <meta name="description" content="<?php echo $server['sv_description']; ?>" />
    <meta name="keywords" content="<?php echo $cont['at_title']; ?>, <?php echo $server['sv_keyword']; ?>" />
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS Style -->
    <link rel="stylesheet" href="<?php echo $server['sv_url']; ?>/assets/css/style-main.css">
</head>

<body id="content">
    <!-- Header -->
    <?php include('../include/header.php'); ?>

    <!-- Message breakpoint -->
    <section>
        <div class="wp-content-message-breadcrumb">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header align-items-center">
                        <div class="overlay"></div>
                        <div class="wp-content-breadcrumb-title">
                            <h1 class="display-5"><?php echo $cont['at_title']; ?></h1>
                        </div>
                        <div class="wp-content-header-breadcrumb">
                            <div class="wp-content-breadcrumb-item">
                                <a href="<?php echo $server['sv_url']; ?>">หน้าหลัก</a><span class="breadcrumb-divider"></span><a href="<?php echo $server['sv_url']; ?>/articles">บทความทั้งหมด</a><span class="breadcrumb-divider"></span><?php echo $cont['at_title']; ?>
                            
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
                    <div class="col-sm-12 col-md-12 col-lg-8 mb-4">
                        <div class="wp-content-read">
                            <div class="wp-content-read-thumbnail">
                                <img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/articles/<?php echo $cont['at_img']; ?>" width="100%" alt="<?php echo $cont['at_title']; ?>">
                            </div>
                            <div class="wp-content-read-date d-none d-md-block">
                                <i class="far fa-calendar-alt"></i><?php echo $cont['at_time_add']; ?><span></span><i class="fas fa-folder-open"></i><?php echo $cont['cg_name']; ?><span></span><i class="fas fa-user"></i>ADMIN DBT / PANITHATYAI
                            </div>
                            <div class="wp-content-read-date-m d-md-none d-md-block">
                                <div class="mt-2 mb-2"><i class="far fa-calendar-alt"></i><?php echo $cont['at_time_add']; ?></div>
                                <div class="mt-2 mb-2"><i class="fas fa-folder-open"></i><?php echo $cont['cg_name']; ?></div>
                                <div><i class="fas fa-user"></i>ADMIN DBT / PANITHATYAI</div>
                            </div>
                            <div class="wp-content-read-detail">
                                <div class="overflow">
                                    <p><?php echo $cont['at_content']; ?></p>
                                </div>
                            </div>
                            <div class="wp-content-read-view">
                                <span>&#x26A1;&#x26A1;&#x26A1; จำนวนการเข้าชม <?php echo number_format($cont['at_view']); ?> ครั้ง &#x26A1;&#x26A1;&#x26A1;</span>
                            </div>
                            <div class="wp-content-read-share">
                                <span>Share this :</span>
                                <div class="wp-content-link-share">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $server['sv_url']; ?>/article/<?php echo $cont['at_url']; ?>" onclick="window.open(this.href, 'mywin','left=100,top=100,width=600,height=350,toolbar=0'); return false;" class="fab fa-facebook" title="Click to share on Facebook"></a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo $server['sv_url']; ?>/article/<?php echo $cont['at_url']; ?>&text=<?php echo $cont['at_title']; ?>" onclick="window.open(this.href, 'mywin','left=100,top=100,width=600,height=350,toolbar=0'); return false;" class="fab fa-twitter" title="Click to share on Twitter"></a>
                                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo $server['sv_url']; ?>/article/<?php echo $cont['at_url']; ?>&media=&description=<?php echo $cont['at_title']; ?>" onclick="window.open(this.href, 'mywin','left=100,top=100,width=600,height=350,toolbar=0'); return false;" class="fab fa-pinterest" title="Click to share on Pinterest"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('../include/aside.php'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('../include/footer.php'); ?>

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