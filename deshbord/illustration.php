<?php
require_once('../server.php');
session_start();

// โปรใฟล์
include('php/profile.php');

// เพิ่มข้อมูล
if (isset($_REQUEST['btn_add'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $cdn_url = getName($n);
    $cdn_time_add = datetime();
    $cdn_time_edit = datetime();

    $cdn_img_enc = strrchr($_FILES['cdn_img']['name'], ".");
    $newname1 = $numrand . $date1 . "_" . $cr_years . $cdn_img_enc;
    $type1 = $_FILES['cdn_img']['type'];
    $size1 = $_FILES['cdn_img']['size'];
    $temp1 = $_FILES['cdn_img']['tmp_name'];

    $path1 = "../wp-contents/uploads/cdn/" . $newname1;

    // เช็คการป้อนข้อมูล
    if (empty($cdn_img_enc)) {
        $errorMsg = "กรุณาเลือกรูปภาพ";
    } else if ($type1 == "image/jpg" || $type1 == 'image/jpeg' || $type1 == "image/png") {
        if (!file_exists($path1)) {
            if ($size1 < 5000000) {
                move_uploaded_file($temp1, '../wp-contents/uploads/cdn/' . $newname1);
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
        $sql = "INSERT INTO tbl_illustration_db(cdn_url, cdn_img, cdn_time_add, cdn_time_edit)
                VALUE('$cdn_url', '$newname1', '$cdn_time_add', '$cdn_time_edit')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ";
            $redirect = $server['sv_url'] . "/deshbord/illustration";
            header("refresh:1;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}

// ลบข้อมูล
if (isset($_REQUEST['btn_delete'])) {

    $cdn_img_delete = $_POST["cdn_img_delete"];

    $cdn_url = $_POST["cdn_url"];
    $directory = "../wp-contents/uploads/cdn/";

    // ลบข้อมูลจากโฟลเดอร์
    unlink($directory . $cdn_img_delete);

    // ลบข้อมูลในฐานข้อมูล
    $sql = "DELETE FROM tbl_illustration_db WHERE cdn_url = '$cdn_url'";

    // สั่งรันคำสั่ง sql
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $successMsg = "ลบข้อมูลสำเร็จ";
        $redirect = $server['sv_url'] . "/deshbord/illustration";
        header("refresh:1;$redirect");
    } else {
        echo mysqli_error($conn);
    }
}

// ดึงข้อมูลจากฐานข้อมูลมาแสดงทั้งหมด
$search = isset($_POST['search_query']) ? $_POST['search_query'] : '';

$query_data = "SELECT * FROM tbl_illustration_db WHERE cdn_url LIKE '%$search%' OR cdn_time_add LIKE '%$search%' ORDER BY cdn_id DESC";
$result_data = mysqli_query($conn, $query_data);
$count_data = mysqli_num_rows($result_data);
$order = 1;

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
        <title>จัดการภาพประกอบ &#8211; แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</title>
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

        <!-- Insert image -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="insert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="insert">เพิ่มภาพประกอบ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="mb-3">
                                        <label for="cdn_img" class="form-label ms-2">ภาพประกอบ <span class="sp-red">*</span></label>
                                        <input type="file" name="cdn_img" class="form-control" id="cdn_img" accept=".jpg, .jpeg, .png">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="btn_add" class="btn btn-success">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- images database -->
        <section>
            <div class="wp-content-desh">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="container">
                        <div class="pt-100 d-none d-lg-block"></div>
                        <div class="wp-content-desh-container">

                            <!-- Form search -->
                            <div class="mb-3 wp-content-desh-title">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="mb-3">
                                        <strong>ตารางฐานข้อมูลภาพประกอบ</strong>
                                    </div>
                                </div><?php
                                if (isset($_POST['search_query'])) {
                                ?>
                                
                                <div class="col-sm-12 col-md-10 col-lg-5 mx-auto">
                                    <form action="" method="POST">
                                        <div class="row d-flex">
                                            <div class="col-sm-12 col-md-6 mb-2 mb-md-0">
                                                <input type="search" class="form-control form-control-sm" name="search_query" value="<?php echo isset($search) ? $search : '' ?>" placeholder="ไอดีภาพประกอบ, วันที่เพิ่ม" autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <div class="d-grid">
                                                    <a href="<?php echo $server['sv_url']; ?>/deshbord/illustration" class="btn btn-sm btn-warning">กลับไป</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-sm btn-search btn-warning">ค้นหา</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><?php } else { ?>

                                <div class="col-sm-12 col-md-10 col-lg-5 mx-auto">
                                    <form action="" method="POST">
                                        <div class="row d-flex">
                                            <div class="col-sm-12 col-md-3 col-lg-3 mb-2 mb-md-0">
                                                <div class="d-grid">
                                                    <a data-bs-toggle="modal" data-bs-target="#insert" class="btn btn-sm btn-success">+ เพิ่ม</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 mb-2 mb-md-0">
                                                <input type="search" class="form-control form-control-sm" name="search_query" value="<?php echo isset($search) ? $search : '' ?>" placeholder="ไอดีภาพประกอบ, วันที่เพิ่ม" autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-sm btn-warning">ค้นหา</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><?php } ?>

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
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="wp-content-desh-table">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th>ไอดีรูปภาพ</th>
                                                            <th>ชื่อรูปภาพ</th>
                                                            <th>วัน/เดือน/ปี ที่เพิ่ม</th>
                                                            <th>วัน/เดือน/ปี ที่แก้ไข</th>
                                                            <th class="text-center">การทำงาน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody><?php while ($row = mysqli_fetch_assoc($result_data)) { ?>

                                                        <tr valign="middle" class="text-nowrap">
                                                            <td style="width: 10rem;">#<?php echo number_format($order++) ?></td>
                                                            <td style="width: 15rem;"><?php echo $row['cdn_url']; ?></td>
                                                            <td style="width: 30rem;"><?php echo $row['cdn_img']; ?></td>
                                                            <td style="width: 20rem;"><?php echo $row['cdn_time_add']; ?></td>
                                                            <td style="width: 20rem;"><?php echo $row['cdn_time_edit']; ?></td>
                                                            <td style="width: 10rem;">
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#PREVIEW<?php echo $row['cdn_url']; ?>" class="btn btn-sm btn-success">ดูภาพตัวอย่าง / คัดลอกลิงค์</button>
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#EDIT<?php echo $row['cdn_url']; ?>" class="btn btn-sm btn-warning">แก้ไข</button>
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#DELETE<?php echo $row['cdn_url']; ?>" class="btn btn-sm btn-danger">ลบ</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="cdn_url" value="<?php echo $row['cdn_url']; ?>">
                                                            <div class="modal fade" id="PREVIEW<?php echo $row['cdn_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="PREVIEW<?php echo $row['cdn_url']; ?>">ดูภาพตัวอย่าง / คัดลอกลิงค์</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <a href="<?php echo $server['sv_url']; ?>/wp-contents/uploads/cdn/<?php echo $row['cdn_img']; ?>" title="คลิกเพื่อคัดลอกที่อยู่รูปภาพ" target="_blank">
                                                                                <img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/cdn/<?php echo $row['cdn_img']; ?>" width="100%">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <form action="" method="post">
                                                            <div class="modal fade" id="EDIT<?php echo $row['cdn_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="EDIT<?php echo $row['cdn_url']; ?>">ประกาศ !!!</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            " ขณะนี้ไม่สามารถแก้ไขรูปภาพได้ เนื่องจากระบบในส่วนนี้ไม่ได้พัฒนาต่อแล้ว ขออภัยในความไม่สะดวก "
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="cdn_url" value="<?php echo $row['cdn_url']; ?>">
                                                            <input type="hidden" name="cdn_img_delete" value="<?php echo $row['cdn_img']; ?>">
                                                            <div class="modal fade" id="DELETE<?php echo $row['cdn_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="DELETE<?php echo $row['cdn_url']; ?>">ลบข้อมูล</h5>
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
                                </div>
                            </div>
                            
                            <div class="wp-content-desh-footer">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="wp-content-desh-detail">
                                        <div class="col-sm-12">จำนวนข้อมูลทั้งหมด <?php echo number_format($count_data) ?> เร็คคอร์ด</div>
                                        <div class="col-sm-12">ข้อมูล ณ วันที่ <?php echo datetime(); ?></div>
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