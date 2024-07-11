<?php
require_once('../server.php');
session_start();

// โปรใฟล์
include('php/profile.php');

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$url = $_GET['url'];
$query_data = "SELECT * FROM tbl_course_db WHERE cs_url = '$url'";
$result_data = mysqli_query($conn, $query_data);
$data = mysqli_fetch_assoc($result_data);

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$query_data = "SELECT * FROM tbl_unit_db WHERE cs_url = '$url' ORDER BY unit_id DESC";
$result_data = mysqli_query($conn, $query_data);
$count_data = mysqli_num_rows($result_data);
$order = 1;

// ลบข้อมูล
if (isset($_REQUEST['btn_delete'])) {

    $unit_url = $_POST["unit_url"];

    // ลบข้อมูลในฐานข้อมูล
    $sql_1 = "DELETE FROM tbl_unit_db WHERE unit_url = '$unit_url'";
    $sql_2 = "DELETE FROM tbl_unit_item_db WHERE unit_url = '$unit_url'";

    // สั่งรันคำสั่ง sql
    $result_1 = mysqli_query($conn, $sql_1);
    $result_2 = mysqli_query($conn, $sql_2);

    if ($result_1 || $result_2) {
        $successMsg = "ลบข้อมูลสำเร็จ";
        $redirect = $server['sv_url'] . "/deshbord/course_unit?url=" .$url;
        header("refresh:1;$redirect");
    } else {
        echo mysqli_error($conn);
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
        <title>ฟอร์มเพิ่มหน่วยบทเรียน &#8211; แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</title>
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
                                    <strong>ฟอร์มเพิ่มหน่วยบทเรียน</strong>
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
                                            <div class="col-sm-12 col-md-12 col-lg-8 mx-auto">
                                                <div class="wp-content-form">
                                                    <div class="row">
                                                        
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <h2>ส่วนรายละเอียด</h2>
                                                            <hr>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <p><span class="sp-orange">รหัสรายวิชา</span> <br><?php echo $data['cs_code']; ?></p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <p><span class="sp-orange">รายวิชาชื่อ</span> <br><?php echo $data['cs_name']; ?></p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <p><span class="sp-orange">คำอธิบายรายวิชาสั้น ๆ</span> <br><?php echo $data['cs_des']; ?></p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <p><span class="sp-orange">จุดประสงค์รายวิชา</span> <br><?php echo $data['cs_objective']; ?></p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <p><span class="sp-orange">สมรรถนะรายวิชา</span> <br><?php echo $data['cs_capacity']; ?></p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <p><span class="sp-orange">คำอธิบายรายวิชา</span> <br><?php echo $data['cs_description']; ?></p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <h2>ส่วนหน่วยบทเรียน</h2>
                                                            <p>(คำแนะนำ : กรุณาเตรียมข้อมูลให้เรียบร้อยก่อนทำรายการ และตรวจสอบความถูกต้องก่อนบันทึกข้อมูล)</p>
                                                            <hr>
                                                            <a href="<?php echo $server['sv_url']; ?>/deshbord/course_unit_insert?url=<?php echo $url; ?>" class="btn btn-warning mb-3">+ เพิ่มบทเรียน</a>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="course-unit">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ลำดับ</th>
                                                                                <th>ไอดีหน่วย</th>
                                                                                <th>หน่วย</th>
                                                                                <th>รายชื่อหน่วย</th>
                                                                                <th class="text-center">การทำงาน</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody><?php while ($row = mysqli_fetch_assoc($result_data)) { ?>

                                                                            <tr valign="middle" class="text-nowrap">
                                                                                <td style="width: 10rem;">#<?php echo number_format($order++) ?></td>
                                                                                <td style="width: 12rem;"><?php echo $row['unit_url']; ?></td>
                                                                                <td style="width: 12rem;"><?php echo $row['unit_number']; ?></td>
                                                                                <td style="width: 50rem;"><?php echo $row['unit_name']; ?></td>
                                                                                <td style="width: 5rem;">
                                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#DELETE<?php echo $row['unit_url']; ?>" class="btn btn-sm btn-danger">ลบบทเรียน</button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <form action="" method="post">
                                                                                <input type="hidden" name="unit_url" value="<?php echo $row['unit_url']; ?>">
                                                                                <div class="modal fade" id="DELETE<?php echo $row['unit_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-md">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="DELETE<?php echo $row['unit_url']; ?>">ลบข้อมูล</h5>
                                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                                                                        <div class="mb-3">
                                                                                                            ยืนยันที่จะลบข้อมูลเร็คคอร์ดนี้ หากต้องการ ให้กดปุ่ม "ยืนยัน" หากไม่ต้องการ ให้กดปุ่ม "ยกเลิก" 
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <a class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</a>
                                                                                                <button type="submit" name="btn_delete" class="btn btn-success">ยืนยันที่จะลบ</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form><?php } ?>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                                                                    <div class="d-grid">
                                                                        <a href="<?php echo $server['sv_url']; ?>/deshbord/courses" class="btn btn-danger">กลับไปที่รายการหลักสูตร</a>
                                                                    </div>
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