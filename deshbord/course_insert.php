<?php
require_once('../server.php');
session_start();

// โปรใฟล์
include('php/profile.php');

// เพิ่มข้อมูล
if (isset($_REQUEST['btn_add'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร ส่วนรายละเอียด
    $cs_url = getName($n);
    $cs_code = $_POST["cs_code"];
    $cs_name = $_POST["cs_name"];
    $cs_des = $_POST["cs_des"];
    $cs_objective = $_POST["cs_objective"];
    $cs_capacity = $_POST["cs_capacity"];
    $cs_description = $_POST["cs_description"];
    $cs_time_add = datetime();
    $cs_time_edit = datetime();

    $cs_img_enc = strrchr($_FILES['cs_img']['name'], ".");
    $newname1 = $numrand . $date1 . "_" . $cr_years . $cs_img_enc;
    $type1 = $_FILES['cs_img']['type'];
    $size1 = $_FILES['cs_img']['size'];
    $temp1 = $_FILES['cs_img']['tmp_name'];

    $path1 = "../wp-contents/uploads/courses/" . $newname1; // ที่เก็บรูปภาพ

    if (empty($cs_img_enc)) { // เช็คการป้อนข้อมูล
        $errorMsg = "กรุณาเลือกรูปภาพ";
    } else if ($type1 == "image/jpg" || $type1 == 'image/jpeg' || $type1 == "image/png") { // เช็คนามสกุลใฟล์
        if (!file_exists($path1)) { // เช็คโฟลเดอร์อัพโหลดว่ามีใฟล์อยู่แล้วมั้ย
            if ($size1 < 5000000) { // เช็คขนาดใฟล์ไม่เกิน 5MB
                move_uploaded_file($temp1, '../wp-contents/uploads/courses/' . $newname1);
            } else {
                $errorMsg = "ไฟล์ของคุณใหญ่เกินไป โปรดอัปโหลดขนาด 5MB";
            }
        } else {
            $errorMsg = "ไฟล์มีอยู่แล้ว... ตรวจสอบโฟลเดอร์อัพโหลด";
        }
    } else {
        $errorMsg = "อนุญาตให้อัปโหลดรูปแบบไฟล์ JPG, JPEG และ PNG เท่านั้น";
    }

    // เช็คการป้อนข้อมูล ส่วนรายละเอียด
    if (empty($cs_code) || empty($cs_name) || empty($cs_des) || empty($cs_objective) || empty($cs_capacity) || empty($cs_description)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง ส่วนรายละเอียด";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_course_db(cs_url, cs_code, cs_name, cs_des, cs_objective, cs_capacity, cs_description, cs_img, cs_time_add, cs_time_edit)
                VALUE('$cs_url', '$cs_code', '$cs_name', '$cs_des', '$cs_objective', '$cs_capacity', '$cs_description', '$newname1', '$cs_time_add', '$cs_time_edit')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ";
            $redirect = $server['sv_url'] . "/deshbord/courses";
            header("refresh:1;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}

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
        <title>ฟอร์มเพิ่มรายวิชา &#8211; แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</title>
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
                                    <strong>ฟอร์มเพิ่มรายวิชา</strong>
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
                                                            <h2>ส่วนรายละเอียด</h2>
                                                            <p>(คำแนะนำ : กรุณาเตรียมข้อมูลให้เรียบร้อยก่อนทำรายการ และตรวจสอบความถูกต้องก่อนบันทึกข้อมูล)</p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="cs_code" class="form-label">รหัสรายวิชา <span class="sp-red">*</span></label>
                                                                <input type="text" name="cs_code" class="form-control" id="cs_code" value="<?php echo isset($cs_code) ? $cs_code : '' ?>" placeholder="(Ex. 30204-2007)" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="cs_name" class="form-label">รายวิชาชื่อ <span class="sp-red">*</span></label>
                                                                <input type="text" name="cs_name" class="form-control" id="cs_name" value="<?php echo isset($cs_name) ? $cs_name : '' ?>" placeholder="(Ex. เครือข่ายคอมพิวเตอร์)" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="mb-1">
                                                                <label for="cs_des" class="form-label">คำอธิบายรายวิชาสั้น ๆ <span class="sp-red">*</span> (จำกัดข้อความ 100 ตัวอักษร)</label>
                                                                <textarea name="cs_des" class="form-control" id="cs_des" rows="3" placeholder="(Ex. ศึกษาและปฏิบัติเกี่ยวกับหลักการเครือข่ายคอมพิวเตอร์ ความสำคัญ ประเภทและรูปแบบของระบบเครือข่าย)"><?php echo isset($cs_des) ? $cs_des : '' ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="mb-3">
                                                                <span id="now_length">จำนวนที่เหลือ 100 ตัวอักษร</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="cs_objective" class="form-label">จุดประสงค์รายวิชา <span class="sp-red">*</span> (ใช้&nbsp;&nbsp;BR&nbsp;&nbsp;ในการขึ้นบรรทัดใหม่)</label>
                                                                <textarea name="cs_objective" class="form-control" id="cs_objective" rows="5" placeholder="(Ex. 1.  เข้าใจเกี่ยวกับเครือข่ายคอมพิวเตอร์และความปลอดภัยสำหรับธุรกิจดิจิทัล <br> 2.  สามารถปฏิบัติการดูแลรักษาระบบเครื่อข่ายคอมพิวเตอร์และความปลอดภัยสำหรับธุรกิจดิจิทัล <br> 3.  สามารถปฏิบัติการใช้บริการอินเทอร์เน็ต)"><?php echo isset($cs_des_full) ? $cs_des_full : '' ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="cs_capacity" class="form-label">สมรรถนะรายวิชา <span class="sp-red">*</span> (ใช้&nbsp;&nbsp;BR&nbsp;&nbsp;ในการขึ้นบรรทัดใหม่)</label>
                                                                <textarea name="cs_capacity" class="form-control" id="cs_capacity" rows="5" placeholder="(Ex. 1.  แสดงครามรู้เกี่ยวกับเครือข่ายคอมพิวเตอร์และความปลอดภัยสำหรับธุรกิจติจิทัล <br> 2.  เลือก ติดตั้ง อุปกรณ์เครือข่ายคอมพิวเตอร์ตามคู่มือ <br> 3.  บำรุงรักษาระบบเครือข่ายตามมาตรฐาน)"><?php echo isset($cs_des_full) ? $cs_des_full : '' ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="cs_description" class="form-label">คำอธิบายรายวิชา <span class="sp-red">*</span></label>
                                                                <textarea name="cs_description" class="form-control" id="cs_description" rows="5" placeholder="(Ex. ศึกษาและปฏิบัติเกี่ยวกับหลักการเครือข่ายคอมพิวเตอร์ ความสำคัญ ประเภทและรูปแบบของระบบเครือข่าย อุปกรณ์ระบบเครือข่าย มาตรฐานด้านเครือข่ายคอมพิวเตอร์ การรับ-ส่งข้อมูลบนเครือข่ายโปรโตคอล การใช้บริการบนอินเทอร์เน็ต การบำรุงรักษาระบบเครือข่าย ระเบียบข้อบังคับด้านความปลอดภัยสำหรับธุรกิจดิจิทัล)"><?php echo isset($cs_des_full) ? $cs_des_full : '' ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="cs_img" class="form-label">รูปภาพ ขนาด (1280 x 720) พิกเซล <span class="sp-red">*</span></label>
                                                                <input type="file" name="cs_img" class="form-control" id="cs_img" accept=".jpg, .jpeg, .png" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="row">
                                                                <div class="mb-2 mb-md-0">
                                                                    <div class="d-grid">
                                                                        <a href="<?php echo $server['sv_url']; ?>/deshbord/example/ระบบจัดการฐานข้อมูล.rar" download class="btn btn-warning"><i class="fas fa-download me-2"></i>ดาวโหลดใฟล์ตัวอย่างรูปภาพ</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
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
    </body>

    </html>
<?php } ?>