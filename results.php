<?php
require_once('server.php');
session_start();

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$search = isset($_GET['search_query']) ? $_GET['search_query'] : '';

$query_data_search = "SELECT * FROM tbl_article_db as a
                INNER JOIN tbl_category_db as c ON a.cg_url=c.cg_url 
                WHERE at_url LIKE '%$search%' OR at_title LIKE '%$search%' OR cg_name LIKE '%$search%' 
                ORDER BY at_id DESC";
$result_data_search = mysqli_query($conn, $query_data_search);
$count_data = mysqli_num_rows($result_data_search);
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
    <title><?php echo $search ?> &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <?php include('include/header.php'); ?>

    <!-- Message breakpoint -->
    <section>
        <div class="wp-content-message-breadcrumb">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header align-items-center">
                        <div class="overlay"></div>
                        <div class="wp-content-breadcrumb-title">
                            <h1 class="display-5">ผลลัพธ์&nbsp;&nbsp;<?php echo number_format($count_data); ?>&nbsp;&nbsp;รายการ</h1>
                        </div>
                        <div class="wp-content-header-breadcrumb">
                            <div class="wp-content-breadcrumb-item">
                                <a href="<?php echo $server['sv_url']; ?>">หน้าหลัก</a><span class="breadcrumb-divider"></span><a href="<?php echo $server['sv_url']; ?>/articles">บทความทั้งหมด</a><span class="breadcrumb-divider"></span><?php echo $search ?>
                            
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
                    <div class="col-sm-12 col-md-12 col-lg-8 mb-4"><?php while ($row = mysqli_fetch_assoc($result_data_search)) { ?>
                        
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