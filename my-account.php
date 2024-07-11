<?php
require_once('server.php');
session_start();

if (isset($_SESSION['member_url'])) {
    // รับค่ามาจากเซสชั่น
    $member_url = $_SESSION['member_url'];

    // เช็คค่าที่ส่งมาจากเซสชั่น
    $query = "SELECT * FROM tbl_member_db WHERE mb_url ='$member_url'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $acount = mysqli_fetch_array($result);
    }

    $url_acount = $acount['mb_url'];

    // ดึงข้อมูลจากฐานข้อมูล หลักสูตร มาแสดง
    $query_data = "SELECT * FROM tbl_register_course_db as re
                    INNER JOIN tbl_course_db as co ON re.cs_url=co.cs_url
                    WHERE mb_url = '$url_acount' ORDER BY rc_id ASC";
    $result_data = mysqli_query($conn, $query_data);
}

// เช็กล็อคอิน
if (!isset($_SESSION['member_url'])) {
    session_destroy();
    unset($_SESSION['member_url']);
    $redirect = $server['sv_url'];
    header("location:$redirect");
} else {
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <title>My Account &#8211; <?php echo $server['sv_title']; ?></title>
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

    <!-- CSS Style -->
    <link rel="stylesheet" href="<?php echo $server['sv_url']; ?>/assets/css/style-main.css">
</head>

<body>
    <!-- Header -->
    <?php include('include/header.php'); ?>

    <!-- Detail -->
    <section>
        <div class="wp-content-cs">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="pt-100 d-none d-lg-block"></div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-3">
                                <div class="wp-content-cs-b mb-4">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        
                                        <span class="nav-link" id="v-pills-account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account" aria-selected="true">บัญชีผู้ใช้</span>
                                        <span class="nav-link active" id="v-pills-course-tab" data-bs-toggle="pill" data-bs-target="#v-pills-course" type="button" role="tab" aria-controls="v-pills-course" aria-selected="true">หลักสูตรที่ลงทะเบียน</span>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-9">
                                <div class="wp-content-cs-b">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        
                                        <div class="tab-pane fade" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
                                            <div class="wp-account-desktop d-none d-lg-block">
                                                <div class="pt-50"></div>
                                                <div class="wp-account-icon d-flex align-item-center justify-content-center">
                                                    <div class="account-icon">
                                                        <i class="far fa-user"></i>
                                                    </div>
                                                    <div class="account-icon-fullname">
                                                        <h3><?php echo $mb_fullname; ?></h3>
                                                        <p>DBT-ID : <?php echo $acount['mb_url']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="account-icon-fullname-div"></div>
                                                <div class="wp-account-info">
                                                    <div class="row">
                                                        <div class="col-5 right">
                                                            <div class="sp-orange">ชื่อ :</div>
                                                            <div class="sp-orange">นามสกุล :</div>
                                                            <div class="sp-orange">ศึกษา :</div>
                                                            <div class="sp-orange">อีเมล :</div>
                                                            <div class="sp-orange">เวลาเข้าสู่ระบบ :</div>
                                                        </div>
                                                        <div class="col-7 left">
                                                            <div><?php echo $acount['mb_firstname']; ?></div>
                                                            <div><?php echo $acount['mb_lastname']; ?></div>
                                                            <div><?php echo $acount['mb_school']; ?></div>
                                                            <div><?php echo $acount['mb_email']; ?></div>
                                                            <div><?php echo $mb_time_login; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-50"></div>
                                            </div>
                                            <div class="wp-account-mobile d-lg-none d-lg-block">
                                                <div class="wp-account-icon d-flex align-item-center">
                                                    <div class="account-icon">
                                                        <i class="far fa-user"></i>
                                                    </div>
                                                    <div class="account-icon-fullname">
                                                        <h4><?php echo $mb_fullname; ?></h4>
                                                        <p>DBT-ID : <?php echo $acount['mb_url']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="account-icon-fullname-div"></div>
                                                <div class="col-sm-12">
                                                    <label><span class="sp-orange">ชื่อ :</span><br><?php echo $acount['mb_firstname']; ?><br>
                                                    <span class="sp-orange">นามสกุล :</span><br><?php echo $acount['mb_lastname']; ?><br>
                                                    <span class="sp-orange">ศึกษา :</span><br><?php echo $acount['mb_school']; ?><br>
                                                    <span class="sp-orange">อีเมล :</span><br><?php echo $acount['mb_email']; ?><br>
                                                    <span class="sp-orange">เวลาเข้าสู่ระบบ :</span><br><?php echo $mb_time_login; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="v-pills-course" role="tabpanel" aria-labelledby="v-pills-course-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>หลักสูตร</th>
                                                            <th></th>
                                                            <th>รหัสรายวิชา</th>
                                                            <th>คำอธิบายรายวิชาสั้น ๆ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody><?php while ($row = mysqli_fetch_assoc($result_data)) { ?>

                                                        <tr valign="middle" class="text-nowrap">
                                                            <td style="width: 10rem;"><a href="<?php echo $server['sv_url']; ?>/course/<?php echo $row['cs_url']; ?>"><img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/courses/<?php echo $row['cs_img']; ?>" width="100%"></a></td>
                                                            <td style="width: 15rem;"><a href="<?php echo $server['sv_url']; ?>/course/<?php echo $row['cs_url']; ?>"><?php echo $row['cs_name']; ?></a></td>
                                                            <td style="width: 10rem;"><a href="<?php echo $server['sv_url']; ?>/course/<?php echo $row['cs_url']; ?>"><?php echo $row['cs_code']; ?></a></td>
                                                            <td style="width: 20rem;"><a href="<?php echo $server['sv_url']; ?>/course/<?php echo $row['cs_url']; ?>"><?php echo $row['cs_des']; ?></a></td>
                                                        </tr><?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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

<?php } ?>