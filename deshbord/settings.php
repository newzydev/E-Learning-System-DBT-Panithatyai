<?php
require_once('../server.php');
session_start();

// โปรใฟล์
include('php/profile.php');

// แก้ไขข้อมูล
if (isset($_REQUEST['btn_save'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $sv_title = $_POST["sv_title"];
    $sv_description = $_POST["sv_description"];
    $sv_keyword = $_POST["sv_keyword"];
    $sv_caption = $_POST["sv_caption"];
    $sv_author = $_POST["sv_author"];
    $sv_privacy_policy = $_POST["sv_privacy_policy"];
    $sv_url = $_POST["sv_url"];

    // เช็คการป้อนข้อมูล
    if (empty($sv_title) || empty($sv_description) || empty($sv_keyword) || empty($sv_caption) || empty($sv_author) || empty($sv_privacy_policy) || empty($sv_url)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_server_db SET 
        sv_title = '$sv_title',
        sv_description = '$sv_description',
        sv_keyword = '$sv_keyword',
        sv_caption = '$sv_caption',
        sv_author = '$sv_author',
        sv_privacy_policy = '$sv_privacy_policy',
        sv_url = '$sv_url'";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ";
            $redirect = $server['sv_url'] . "/deshbord/settings";
            header("refresh:1;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}

// ดึงข้อมูลจากฐานข้อมูลหมวดหมู่มาแสดง
$query_data = "SELECT * FROM tbl_server_db";
$result_data = mysqli_query($conn, $query_data);
$data = mysqli_fetch_assoc($result_data);

// ออกจากระบบ
if (isset($_REQUEST['logout'])) {
    session_destroy();
    unset($_SESSION['member_url']);
    $redirect = $server['sv_url'] . "/login";
    header("location:$redirect");
}

// เช็กล็อคอิน
if (!isset($_SESSION['member_url']) || $_SESSION['level'] != "1") {
    session_destroy();
    unset($_SESSION['member_url']);
    $redirect = $server['sv_url'] . "/login";
    header("location:$redirect");
} else {
?>
    <!DOCTYPE html>
    <html lang="th">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8">
        <title>ตั้งค่าเว็บไซต์ &#8211; แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</title>
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
        <?php include('../include/header-deshbord.php'); ?>

        <!-- Form insert -->
        <section>
            <div class="wp-content-desh">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="container">
                        <div class="pt-100 d-none d-lg-block"></div>
                        <div class="wp-content-desh-container">

                            <!-- Form search -->
                            <div class="mb-3 wp-content-desh-title">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <strong>ฟอร์มตั้งค่าเว็บไซต์</strong>
                                </div>
                            </div>
                            
                            <?php
                            if (isset($errorMsg)) {
                            ?>
                                <div class="error mb-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="text-center">
                                                <strong class="text-danger"><i class="fas fa-quote-left me-2"></i><?php echo $errorMsg; ?><i class="fas fa-quote-right ms-2"></i></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php
                            if (isset($successMsg)) {
                            ?>
                                <div class="success mb-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="text-center">
                                                <strong class="text-success"><i class="fas fa-quote-left me-2"></i><?php echo $successMsg; ?><i class="fas fa-quote-right ms-2"></i></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="mb-3 wp-content-desh-data">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="wp-content-desh-form">
                                        <div class="pt-100 d-none d-lg-block"></div>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <div class="col-sm-12 col-md-12 col-lg-8 mx-auto">
                                                    <div class="wp-content-form">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="sv_title" class="form-label ms-2">ไตเติ้ล <span class="sp-red">*</span></label>
                                                                    <input type="text" name="sv_title" class="form-control" id="sv_title" value="<?php echo $data['sv_title']; ?>" placeholder="ไตเติ้ล" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="sv_description" class="form-label ms-2">คำอธิบาย <span class="sp-red">*</span></label>
                                                                    <input type="text" name="sv_description" class="form-control" id="sv_description" value="<?php echo $data['sv_description']; ?>" placeholder="คำอธิบาย" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="sv_keyword" class="form-label ms-2">คีย์เวิร์ด <span class="sp-red">*</span></label>
                                                                    <input type="text" name="sv_keyword" class="form-control" id="sv_keyword" value="<?php echo $data['sv_keyword']; ?>" placeholder="คีย์เวิร์ด" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="sv_caption" class="form-label ms-2">แคปชั่น <span class="sp-red">*</span></label>
                                                                    <input type="text" name="sv_caption" class="form-control" id="sv_caption" value="<?php echo $data['sv_caption']; ?>" placeholder="แคปชั่น" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="sv_author" class="form-label ms-2">ผู้เขียน <span class="sp-red">*</span></label>
                                                                    <input type="text" name="sv_author" class="form-control" id="sv_author" value="<?php echo $data['sv_author']; ?>" placeholder="แคปชั่น" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="sv_privacy_policy" class="form-label ms-2">นโยบายความเป็นส่วนตัว <span class="sp-red">*</span></label>
                                                                    <textarea name="sv_privacy_policy" class="form-control" id="sv_privacy_policy"><?php echo $data['sv_privacy_policy']; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="sv_url" class="form-label ms-2">เส้นทางเว็บไซต์ <span class="sp-red">*</span></label>
                                                                    <input type="text" name="sv_url" class="form-control" id="sv_url" value="<?php echo $data['sv_url']; ?>" placeholder="เส้นทางเว็บไซต์" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                                                                        <div class="d-grid">
                                                                            <button type="submit" name="btn_save" class="btn btn-success">บันทึกข้อมูล</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <div class="pb-100 d-none d-lg-block"></div>
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
        <script>
            $('#sv_privacy_policy').summernote({
                placeholder: 'นโยบายความเป็นส่วนตัว',
                tabsize: 2,
                height: 400,
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']],
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ],
            });
        </script>
    </body>

    </html>
<?php } ?>