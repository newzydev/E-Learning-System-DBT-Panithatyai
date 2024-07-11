<?php
require_once('../server.php');
session_start();

// โปรใฟล์
include('php/profile.php');

// เพิ่มข้อมูล
if (isset($_REQUEST['btn_add'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $pr_url = getName($n);
    $pr_time_add = datetime();
    $pr_time_edit = datetime();

    $pr_img_enc = strrchr($_FILES['pr_img']['name'], ".");
    $newname1 = $numrand . $date1 . "_" . $cr_years . $pr_img_enc;
    $type1 = $_FILES['pr_img']['type'];
    $size1 = $_FILES['pr_img']['size'];
    $temp1 = $_FILES['pr_img']['tmp_name'];

    $path1 = "../wp-contents/uploads/infographics/" . $newname1;

    // เช็คการป้อนข้อมูล
    if (empty($pr_img_enc)) {
        $errorMsg = "กรุณาเลือกรูปภาพ";
    } else if ($type1 == "image/jpg" || $type1 == 'image/jpeg' || $type1 == "image/png") {
        if (!file_exists($path1)) {
            if ($size1 < 5000000) {
                move_uploaded_file($temp1, '../wp-contents/uploads/infographics/' . $newname1);
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
        $sql = "INSERT INTO tbl_infographic_db(pr_url, pr_img, pr_time_add, pr_time_edit)
                VALUE('$pr_url', '$newname1', '$pr_time_add', '$pr_time_edit')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ";
            $redirect = $server['sv_url'] . "/deshbord/infographics";
            header("refresh:1;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}

// แก้ไขข้อมูล
if (isset($_REQUEST['btn_edit'])) {

    $pr_img_edit = $_POST["pr_img_edit"];

    $pr_url = $_POST["pr_url"];
    $pr_time_edit = datetime();

    $pr_img_enc = strrchr($_FILES['pr_img']['name'], ".");
    $newname1 = $numrand . $date1 . "_" . $cr_years . $pr_img_enc;
    $type1 = $_FILES['pr_img']['type'];
    $size1 = $_FILES['pr_img']['size'];
    $temp1 = $_FILES['pr_img']['tmp_name'];

    $path1 = "../wp-contents/uploads/infographics/" . $newname1;

    $directory = "../wp-contents/uploads/infographics/";

    if (empty($pr_img_enc)) {
        $errorMsg = "กรุณาเลือกรูปภาพ";
    } 

    if ($pr_img_enc) {
        if ($type1 == "image/jpg" || $type1 == 'image/jpeg' || $type1 == "image/png") {
            if (!file_exists($path1)) {
                if ($size1 < 5000000) {
                    unlink($directory . $pr_img_edit);
                    move_uploaded_file($temp1, '../wp-contents/uploads/infographics/' . $newname1);
                } else {
                    $errorMsg = "ไฟล์ของคุณใหญ่เกินไป โปรดอัปโหลดขนาด 5MB";
                }
            } else {
                $errorMsg = "ไฟล์มีอยู่แล้ว... ตรวจสอบโฟลเดอร์อัพโหลด";
            }
        } else {
            $errorMsg = "อนุญาตให้อัปโหลดรูปแบบไฟล์ JPG, JPEG และ PNG เท่านั้น";
        }
    } else {
        $newname1 = $pr_img_edit;
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_infographic_db SET 
        pr_img = '$newname1',
        pr_time_edit = '$pr_time_edit'
        WHERE pr_url = '$pr_url'";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ";
            $redirect = $server['sv_url'] . "/deshbord/infographics";
            header("refresh:1;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}

// ลบข้อมูล
if (isset($_REQUEST['btn_delete'])) {

    $pr_img_delete = $_POST["pr_img_delete"];

    $pr_url = $_POST["pr_url"];
    $directory = "../wp-contents/uploads/infographics/";

    // ลบข้อมูลจากโฟลเดอร์
    unlink($directory . $pr_img_delete);

    // ลบข้อมูลในฐานข้อมูล
    $sql = "DELETE FROM tbl_infographic_db WHERE pr_url = '$pr_url'";

    // สั่งรันคำสั่ง sql
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $successMsg = "ลบข้อมูลสำเร็จ";
        $redirect = $server['sv_url'] . "/deshbord/infographics";
        header("refresh:1;$redirect");
    } else {
        echo mysqli_error($conn);
    }
}

// ดึงข้อมูลจากฐานข้อมูลมาแสดงทั้งหมด
$search = isset($_POST['search_query']) ? $_POST['search_query'] : '';

$query_data = "SELECT * FROM tbl_infographic_db WHERE pr_url LIKE '%$search%' OR pr_time_add LIKE '%$search%' ORDER BY pr_id DESC";
$result_data = mysqli_query($conn, $query_data);
$count_data = mysqli_num_rows($result_data);
$order = 1;

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
        <title>จัดการภาพสไลต์ &#8211; แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</title>
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
                            <h5 class="modal-title" id="insert">เพิ่มภาพสไลต์</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="mb-3">
                                        <label for="pr_img" class="form-label ms-2">ภาพสไลต์ ขนาด (2733 x 1040) พิกเซล <span class="sp-red">*</span></label>
                                        <input type="file" name="pr_img" class="form-control" id="pr_img" accept=".jpg, .jpeg, .png">
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
                                        <strong>ตารางฐานข้อมูลภาพสไลต์</strong>
                                    </div>
                                </div><?php
                                if (isset($_POST['search_query'])) {
                                ?>
                                
                                <div class="col-sm-12 col-md-10 col-lg-5 mx-auto">
                                    <form action="" method="POST">
                                        <div class="row d-flex">
                                            <div class="col-sm-12 col-md-6 mb-2 mb-md-0">
                                                <input type="search" class="form-control form-control-sm" name="search_query" value="<?php echo isset($search) ? $search : '' ?>" placeholder="ไอดีภาพสไลต์, วันที่เพิ่ม" autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <div class="d-grid">
                                                    <a href="<?php echo $server['sv_url']; ?>/deshbord/infographics" class="btn btn-sm btn-warning">กลับไป</a>
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
                                                <input type="search" class="form-control form-control-sm" name="search_query" value="<?php echo isset($search) ? $search : '' ?>" placeholder="ไอดีภาพสไลต์, วันที่เพิ่ม" autocomplete="off" required>
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
                                                            <td style="width: 15rem;"><?php echo $row['pr_url']; ?></td>
                                                            <td style="width: 30rem;"><?php echo $row['pr_img']; ?></td>
                                                            <td style="width: 20rem;"><?php echo $row['pr_time_add']; ?></td>
                                                            <td style="width: 20rem;"><?php echo $row['pr_time_edit']; ?></td>
                                                            <td style="width: 10rem;">
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#PREVIEW<?php echo $row['pr_url']; ?>" class="btn btn-sm btn-success">ดูตัวอย่าง</button>
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#EDIT<?php echo $row['pr_url']; ?>" class="btn btn-sm btn-warning">แก้ไข</button>
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#DELETE<?php echo $row['pr_url']; ?>" class="btn btn-sm btn-danger">ลบ</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="pr_url" value="<?php echo $row['pr_url']; ?>">
                                                            <div class="modal fade" id="PREVIEW<?php echo $row['pr_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="PREVIEW<?php echo $row['pr_url']; ?>">ดูภาพตัวอย่าง</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/infographics/<?php echo $row['pr_img']; ?>" width="100%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <form action="" method="post" enctype="multipart/form-data">
                                                            <input type="hidden" name="pr_url" value="<?php echo $row['pr_url']; ?>">
                                                            <input type="hidden" name="pr_img_edit" value="<?php echo $row['pr_img']; ?>">
                                                            <div class="modal fade" id="EDIT<?php echo $row['pr_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="EDIT<?php echo $row['pr_url']; ?>">แก้ไขข้อมูล</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label ms-2">ภาพสไลต์ใหม่ ขนาด (2733 x 1040) พิกเซล <span class="sp-red">*</span></label>
                                                                                        <input type="file" name="pr_img" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</a>
                                                                            <button type="submit" name="btn_edit" class="btn btn-success">บันทึกข้อมูล</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="pr_url" value="<?php echo $row['pr_url']; ?>">
                                                            <input type="hidden" name="pr_img_delete" value="<?php echo $row['pr_img']; ?>">
                                                            <div class="modal fade" id="DELETE<?php echo $row['pr_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="DELETE<?php echo $row['pr_url']; ?>">ลบข้อมูล</h5>
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