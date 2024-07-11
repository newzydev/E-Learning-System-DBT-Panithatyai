<?php
require_once('../server.php');
session_start();

// โปรใฟล์
include('php/profile.php');

// ลบข้อมูล
if (isset($_REQUEST['btn_delete'])) {

    $ct_url = $_POST["ct_url"];

    // ลบข้อมูลในฐานข้อมูล
    $sql = "DELETE FROM tbl_contact_db WHERE ct_url = '$ct_url'";

    // สั่งรันคำสั่ง sql
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $successMsg = "ลบข้อมูลสำเร็จ";
        $redirect = $server['sv_url'] . "/deshbord/contacts";
        header("refresh:1;$redirect");
    } else {
        echo mysqli_error($conn);
    }
}

// ดึงข้อมูลจากฐานข้อมูลมาแสดงทั้งหมด
$search = isset($_POST['search_query']) ? $_POST['search_query'] : '';

$query_data = "SELECT * FROM tbl_contact_db WHERE ct_url LIKE '%$search%' OR ct_firstname LIKE '%$search%' OR ct_lastname LIKE '%$search%' OR ct_email LIKE '%$search%' ORDER BY ct_id DESC";
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
        <title>จัดการมูลข้อความติดต่อ &#8211; แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</title>
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

        <!-- Contact database -->
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
                                        <strong>ตารางฐานข้อมูลข้อความติดต่อ</strong>
                                    </div>
                                </div><?php
                                if (isset($_POST['search_query'])) {
                                ?>
                                
                                <div class="col-sm-12 col-md-10 col-lg-5 mx-auto">
                                    <form action="" method="POST">
                                        <div class="row d-flex">
                                            <div class="col-sm-12 col-md-6 mb-2 mb-md-0">
                                                <input type="search" class="form-control form-control-sm" name="search_query" value="<?php echo isset($search) ? $search : '' ?>" placeholder="ไอดีข้อความ, ชิ่อ, สกุล, อีเมล" autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <div class="d-grid">
                                                    <a href="<?php echo $server['sv_url']; ?>/deshbord/contact" class="btn btn-sm btn-warning">กลับไป</a>
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
                                            <div class="col-sm-12 col-md-9 mb-2 mb-md-0">
                                                <input type="search" class="form-control form-control-sm" name="search_query" value="<?php echo isset($search) ? $search : '' ?>" placeholder="ไอดีข้อความ, ชิ่อ, สกุล, อีเมล" autocomplete="off" required>
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
                                        <div class="mb-3">
                                            <div class="alert alert-primary d-flex align-item-center justify-content-center" role="alert">
                                                <i class="fas fa-info-circle me-2"></i>ประกาศผู้ดูแลระบบ :: ขอปิดระบบในส่วนฟอร์มการติดต่อ เนื่องจากมีผู้ไม่หวังดีส่งข้อความเข้ามาในระบบจำนวนมาก ซึ่งทีมงานได้ตรวจสอบแล้วว่าข้อความทั้งหมดที่ได้ส่งมานั้น คือการพยายามมุ่งทำลายระบบ เจาะข้อมูลเซิร์ฟเวอร์ของเรา ทางทีมงานเล็งเห็นถึงความปลอดภัยของผู้ใช้งานถึงแม้ว่าทึมงานจะพัฒนาระบบและยกระบบความปลอดภัย ด้วยการเข้ารหัส ที่อยู่อีเมล์ เบอร์โทรศัพท์ และเบอร์โทรศัพท์ของผู้ใช้ไปตั้งแต่เริ่มต้นแล้ว รวมถึงระบบรักษาความปลอดภัยทุกหน้า มันอาจยังไม่พอ ในครั้งนี้จึงขอปิดระบบฟอร์มการติดต่อที่มีความเสี่ยงอยู่นี้<br><br>*** แต่ก็ยังสามารถติดต่อพูดคุยกับพวกเราได้ เช่นเดิม ผ่านชองทาง Facebook Page : แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่ หรือ @DBTLEARNING เพื่อให้ระบบมีความปลอดภัยยิ่งขึ้น<br><br>ขออภัยในความไม่สะดวก<br>ทีมงาน DBTLEARNING
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="wp-content-desh-table">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th>ไอดีข้อความ</th>
                                                            <th>ชื่อ - สกุล</th>
                                                            <th>เรื่อง</th>
                                                            <th class="text-center">การทำงาน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody><?php while ($row = mysqli_fetch_assoc($result_data)) { ?>

                                                        <tr valign="middle" class="text-nowrap">
                                                            <td style="width: 10rem;">#<?php echo number_format($order++) ?></td>
                                                            <td style="width: 10rem;"><?php echo $row['ct_url']; ?></td>
                                                            <td style="width: 15rem;"><?php echo $row['ct_firstname'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row['ct_lastname']; ?></td>
                                                            <td style="width: 55rem;"><?php echo $row['ct_subject']; ?></td>
                                                            <td style="width: 5rem;">
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#PREVIEW<?php echo $row['ct_url']; ?>" class="btn btn-sm btn-warning">ดูข้อความ</button>
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#DELETE<?php echo $row['ct_url']; ?>" class="btn btn-sm btn-danger">ลบ</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="ct_url" value="<?php echo $row['ct_url']; ?>">
                                                            <div class="modal fade" id="PREVIEW<?php echo $row['ct_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="EDIT<?php echo $row['ct_url']; ?>">ดูข้อความ &#8211; คุณ<?php echo $row['ct_firstname'] . "&nbsp;&nbsp;&nbsp" . $row['ct_lastname']; ?></h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                                    <div class="box-contact mb-3"><strong>ส่งจาก : </strong>คุณ<?php echo $row['ct_firstname'] . "&nbsp;&nbsp;&nbsp" . $row['ct_lastname']; ?></div>
                                                                                    <div class="box-contact mb-3"><strong>ที่อยู่อีเมล : </strong><?php echo $row['ct_email']; ?></div>
                                                                                    <div class="box-contact mb-3"><strong>ชื่อสถานศึกษา : </strong><?php echo $row['ct_local']; ?></div>
                                                                                    <div class="box-contact mb-3"><strong>หัวข้อเรื่อง : </strong><?php echo $row['ct_subject']; ?></div>
                                                                                    <div class="box-contact mb-3"><strong>ข้อความ : </strong><?php echo $row['ct_message']; ?></div>
                                                                                    <div class="box-contact"><strong>ส่งเมื่อ : </strong><?php echo $row['ct_time_sent']; ?></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a class="btn btn-danger" data-bs-dismiss="modal">ปิดแท็บ</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="ct_url" value="<?php echo $row['ct_url']; ?>">
                                                            <div class="modal fade" id="DELETE<?php echo $row['ct_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="DELETE<?php echo $row['ct_url']; ?>">ลบข้อมูล</h5>
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