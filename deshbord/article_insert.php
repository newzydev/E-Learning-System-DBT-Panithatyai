<?php
require_once('../server.php');
session_start();

// โปรใฟล์
include('php/profile.php');

// เพิ่มข้อมูล
if (isset($_REQUEST['btn_add'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $at_url = getName($n);
    $at_title = $_POST["at_title"];
    $at_content = $_POST["at_content"];
    $cg_url = $_POST["cg_url"];
    $at_time_add = datetime();
    $at_time_edit = datetime();

    $at_img_enc = strrchr($_FILES['at_img']['name'], ".");
    $newname1 = $numrand . $date1 . "_" . $cr_years . $at_img_enc;
    $type1 = $_FILES['at_img']['type'];
    $size1 = $_FILES['at_img']['size'];
    $temp1 = $_FILES['at_img']['tmp_name'];

    $path1 = "../wp-contents/uploads/articles/" . $newname1;

    // เช็คการป้อนข้อมูล
    if (empty($at_title) || empty($cg_url)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    } else if (empty($at_img_enc)) {
        $errorMsg = "กรุณาเลือกรูปภาพ";
    } else if ($type1 == "image/jpg" || $type1 == 'image/jpeg' || $type1 == "image/png") {
        if (!file_exists($path1)) {
            if ($size1 < 5000000) {
                move_uploaded_file($temp1, '../wp-contents/uploads/articles/' . $newname1);
            } else {
                $errorMsg = "ไฟล์ของคุณใหญ่เกินไป โปรดอัปโหลดขนาด 5MB";
            }
        } else {
            $errorMsg = "ไฟล์มีอยู่แล้ว... ตรวจสอบโฟลเดอร์อัพโหลด";
        }
    } else {
        $errorMsg = "อนุญาตให้อัปโหลดรูปแบบไฟล์ JPG, JPEG และ PNG เท่านั้น";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_article_db(at_url, at_img, at_title, at_content, cg_url, at_time_add, at_time_edit)
                VALUE('$at_url', '$newname1', '$at_title', '$at_content', '$cg_url', '$at_time_add', '$at_time_edit')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ";
            $redirect = $server['sv_url'] . "/deshbord/articles";
            header("refresh:1;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}

// ดึงข้อมูลจากฐานข้อมูลหมวดหมู่มาแสดง
$query_data_cat = "SELECT * FROM tbl_category_db ORDER BY cg_id DESC";
$result_data_cat = mysqli_query($conn, $query_data_cat);

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
        <title>ฟอร์มเพิ่มบทความ &#8211; แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</title>
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
                                    <strong>ฟอร์มเพิ่มบทความ</strong>
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
                                                                    <label for="at_title" class="form-label ms-2">บทความเรื่อง <span class="sp-red">*</span></label>
                                                                    <input type="text" name="at_title" class="form-control" id="at_title" value="<?php echo isset($at_title) ? $at_title : '' ?>" placeholder="บทความเรื่อง" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="cg_url" class="form-label ms-2">หมวดหมู่ <span class="sp-red">*</span></label>
                                                                    <select name="cg_url" class="form-select" id="cg_url" aria-label="Default select example">
                                                                        <option selected>--- เลือกหมวดหมู่ ---</option><?php while ($row = mysqli_fetch_assoc($result_data_cat)) { ?>
                                                                        
                                                                        <option value="<?php echo $row['cg_url'] ?>"><?php echo $row['cg_name'] ?></option><?php } ?>
                                                                            
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="at_content" class="form-label ms-2">เนื้อหา</label>
                                                                    <textarea name="at_content" class="form-control" id="at_content"><?php echo isset($at_content) ? $at_content : '' ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div>
                                                                    <label for="at_img" class="form-label ms-2">รูปภาพ ขนาด (1280 x 720) พิกเซล <span class="sp-red">*</span></label>
                                                                    <input type="file" name="at_img" class="form-control" id="at_img" accept=".jpg, .jpeg, .png" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2 mb-md-0">
                                                                        <div class="d-grid">
                                                                            <button type="reset" class="btn btn-danger">ล้างค่าฟอร์ม</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                                                        <div class="d-grid">
                                                                            <button type="submit" name="btn_add" class="btn btn-success">บันทึกข้อมูล</button>
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
            $('#at_content').summernote({
                placeholder: 'เนื้อหาของบทความ',
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