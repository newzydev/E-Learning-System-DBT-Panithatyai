<?php
require_once('../server.php');
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
    $url = $_GET['cs_url'];

    $query_data_1 = "SELECT * FROM tbl_register_course_db WHERE mb_url = '$url_acount' AND cs_url = '$url'";
    $result_data_1 = mysqli_query($conn, $query_data_1);
    $data_1 = mysqli_fetch_assoc($result_data_1);
}

// ดึงข้อมูลภจาก tbl_course_db มาแสดง
$url = $_GET['cs_url'];
$query_data = "SELECT * FROM tbl_course_db WHERE cs_url = '$url'";
$result_data = mysqli_query($conn, $query_data);
$data = mysqli_fetch_assoc($result_data);

// เพิ่มข้อมูล
if (isset($_REQUEST['register_course'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $register_course_url = $_POST["register_course_url"];
    $register_course_memner = $_POST["register_course_memner"];

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_register_course_db(cs_url, mb_url)
                VALUE('$register_course_url', '$register_course_memner')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "ลงทะเบียนหลักสูตรสำเร็จ";
            $redirect = $server['sv_url'] . "/unit/" .$data['cs_url'];
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
    <title>วิชา<?php echo $data['cs_name']; ?> &#8211; <?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:title" content="วิชา<?php echo $data['cs_name']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/wp-contents/uploads/courses/<?php echo $data['cs_img']; ?>">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/course/<?php echo $data['cs_url']; ?>">
    <meta property="og:site_name" content="วิชา<?php echo $data['cs_name']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $data['cs_des']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/course/<?php echo $data['cs_url']; ?>">
    <meta name="twitter:title" content="วิชา<?php echo $data['cs_name']; ?>">
    <meta name="twitter:image" content="<?php echo $server['sv_url']; ?>/wp-contents/uploads/courses/<?php echo $data['cs_img']; ?>">
    <meta name="description" content="<?php echo $data['cs_des']; ?>">
    <meta name="keywords" content="<?php echo $data['cs_name']; ?>, <?php echo $server['sv_keyword']; ?>">
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
    <?php include('../include/header.php'); ?>

    <!-- Detail -->
    <section>
        <div class="wp-content-cs">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="pt-100 d-none d-lg-block"></div>

                        <div class="wp-content-cs-b mb-3">
                            <div class="alert alert-warning d-flex align-item-center justify-content-center" role="alert">
                            <i class="fas fa-info-circle me-2"></i>ตั้งแต่วันที่ 1 เมษายน เป็นต้นไปจะไม่มีการเพิ่มหลักสูตร / หน่วยเรียน เข้ามาอีก
                            </div>
                        </div>

                        <?php if (isset($successMsg)) { ?>
                            <div class="wp-content-cs-b mb-3">
                                <div class="alert alert-success d-flex align-item-center justify-content-center" role="alert">
                                    <i class="fas fa-check-circle me-2"></i><?php echo $successMsg; ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (!isset($_SESSION['member_url'])) { ?>
                            <div class="wp-content-cs-b mb-3">
                                <div class="alert alert-primary d-flex align-item-center justify-content-center" role="alert">
                                <i class="fas fa-info-circle me-2"></i>คุณจำเป็นต้อง "ลงชื่อเข้าใช้" จึงจะสามารถลงทะเบียนหลักสูตรได้ หากยังไม่มีบัญชีผู้ใช้ "สมัครสมาชิก"
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (empty($data_1['cs_url']) || empty($data_1['mb_url'])) { ?>
                            
                        <?php } else if (isset($_SESSION['member_url']) && $url == $data_1['cs_url'] && $url_acount == $data_1['mb_url']) { ?>
                            <div class="wp-content-cs-b mb-3">
                                <div class="alert alert-primary d-flex align-item-center justify-content-center" role="alert">
                                <i class="fas fa-info-circle me-2"></i>คุณได้ทำการลงทะเบียนหลักสูตรนี้แล้ว สามารถเข้าสู่บทเรียนได้เลย
                                </div>
                            </div>
                        <?php } ?>
                        
                        <div class="wp-content-cs-b">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-3 mb-2">
                                    <img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/courses/<?php echo $data['cs_img']; ?>" width="100%">
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <div>
                                        <label class="form-label"><span class="sp-orange">รหัสรายวิชา</span> <br><?php echo $data['cs_code']; ?></label>
                                    </div>
                                    <div>
                                        <label class="form-label"><span class="sp-orange">รายวิชาชื่อ</span> <br><?php echo $data['cs_name']; ?></label>
                                    </div>
                                    <div>
                                        <label class="form-label"><span class="sp-orange">คำอธิบายรายวิชาสั้น ๆ</span> <br><?php echo $data['cs_des']; ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2">

                                    <?php if (isset($_SESSION['member_url'])) { ?>
                                        <form action="" method="post">
                                            <div class="d-grid mb-2">
                                                <input type="hidden" name="register_course_url" value="<?php echo $data['cs_url']; ?>">
                                                <input type="hidden" name="register_course_memner" value="<?php echo $mb_url; ?>">
                                                <button type="submit" name="register_course" class="btn btn-primary <?php if (isset($_SESSION['member_url']) && $url == $data_1['cs_url'] && $url_acount == $data_1['mb_url']) { echo "d-none"; } ?>">ลงทะเบียนหลักสูตร</button>
                                            </div>
                                        </form>
                                    <?php } ?>

                                    <?php if (!isset($_SESSION['member_url'])) { ?>
                                        <div class="d-grid">
                                            <a href="<?php echo $server['sv_url']; ?>/login" class="btn btn-outline-primary mb-2">ลงชื่อเข้าใช้</a>
                                            <a href="<?php echo $server['sv_url']; ?>/register" class="btn btn-primary">สมัครสมาชิก</a>
                                        </div>
                                    <?php } ?>

                                    <?php if (empty($data_1['cs_url']) || empty($data_1['mb_url'])) { ?>
                            
                                    <?php } else if (isset($_SESSION['member_url']) && $url == $data_1['cs_url'] && $url_acount == $data_1['mb_url']) { ?>
                                        <div class="d-grid">
                                            <a href="<?php echo $server['sv_url']; ?>/unit/<?php echo $data['cs_url']; ?>" class="btn btn-primary mb-2">เข้าสู่บทเรียน</a>
                                        </div>
                                    <?php } ?>

                                    <div class="d-grid">
                                        <div class="wp-content-read-share" style="text-align: center;">
                                            <span>Share this :</span>
                                            <div class="wp-content-link-share">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $server['sv_url']; ?>/course/<?php echo $data['cs_url']; ?>" onclick="window.open(this.href, 'mywin','left=100,top=100,width=600,height=350,toolbar=0'); return false;" class="fab fa-facebook" title="Click to share on Facebook"></a>
                                                <a href="https://twitter.com/intent/tweet?url=<?php echo $server['sv_url']; ?>/course/<?php echo $data['cs_url']; ?>&text=วิชา<?php echo $data['cs_name']; ?>" onclick="window.open(this.href, 'mywin','left=100,top=100,width=600,height=350,toolbar=0'); return false;" class="fab fa-twitter" title="Click to share on Twitter"></a>
                                                <a href="https://pinterest.com/pin/create/button/?url=<?php echo $server['sv_url']; ?>/course/<?php echo $data['cs_url']; ?>&media=&description=วิชา<?php echo $data['cs_name']; ?>" onclick="window.open(this.href, 'mywin','left=100,top=100,width=600,height=350,toolbar=0'); return false;" class="fab fa-pinterest" title="Click to share on Pinterest"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                    <p><span class="sp-orange">จุดประสงค์รายวิชา</span> <br><?php echo $data['cs_objective']; ?></p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <p><span class="sp-orange">สมรรถนะรายวิชา</span> <br><?php echo $data['cs_capacity']; ?></p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <p><span class="sp-orange">คำอธิบายรายวิชา</span> <br><?php echo $data['cs_description']; ?></p>
                                </div>
                            </div>
                        </div>
                    <div class="pb-100 d-none d-lg-block"></div>
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