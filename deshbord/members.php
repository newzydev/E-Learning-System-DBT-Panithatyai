<?php
require_once('../server.php');
session_start();

// โปรใฟล์
include('php/profile.php');

// ดึงข้อมูลจากฐานข้อมูลมาแสดงทั้งหมด
$search = isset($_POST['search_query']) ? $_POST['search_query'] : '';

$query_data = "SELECT * FROM tbl_member_db WHERE mb_url LIKE '%$search%' OR mb_url LIKE '%$search%' OR mb_firstname LIKE '%$search%' OR mb_lastname LIKE '%$search%' ORDER BY mb_id DESC";
$result_data = mysqli_query($conn, $query_data);
$count_data = mysqli_num_rows($result_data);
$order = 1;

// Export pdf
$query_export = "SELECT * FROM tbl_member_db ORDER BY mb_id DESC";
$result_export = mysqli_query($conn, $query_export);
$count_export = mysqli_num_rows($result_export);
$order = 1;

// อัพเดทระดับผู้ใช้
if (isset($_REQUEST['btn_level_save'])) {

    $mb_url = $_POST["mb_url"];
    $mb_level = $_POST["mb_level"];
    $mb_time_edit = datetime();

    // เช็คการป้อนข้อมูล
    if (empty($mb_level)) {
        $errorMsg = "กรุณาเลือกระดับผู้ใช้";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_member_db SET mb_level = '$mb_level', mb_time_edit = '$mb_time_edit' WHERE mb_url = '$mb_url'";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ";
            $redirect = $server['sv_url'] . "/deshbord/members";
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
        <title>จัดการผู้ใช้ทั้งหมด &#8211; แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</title>
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

        <!-- Members database -->
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
                                        <strong>ตารางฐานข้อมูลบัญชีผู้ใช้</strong>
                                    </div>
                                </div><?php
                                if (isset($_POST['search_query'])) {
                                ?>
                                
                                <div class="col-sm-12 col-md-10 col-lg-5 mx-auto">
                                    <form action="" method="POST">
                                        <div class="row d-flex">
                                            <div class="col-sm-12 col-md-6 mb-2 mb-md-0">
                                                <input type="search" class="form-control form-control-sm" name="search_query" value="<?php echo isset($search) ? $search : '' ?>" placeholder="ไอดีผู้ใช้, ชื่อ - สกุล" autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <div class="d-grid">
                                                    <a href="<?php echo $server['sv_url']; ?>/deshbord/members" class="btn btn-sm btn-warning">กลับไป</a>
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
                                                <input type="search" class="form-control form-control-sm" name="search_query" value="<?php echo isset($search) ? $search : '' ?>" placeholder="ไอดีผู้ใช้, ชื่อ - สกุล" autocomplete="off" required>
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
                                                            <th>ไอดีผู้ใช้</th>
                                                            <th>ชื่อ - สกุล</th>
                                                            <th>ที่อยู่อีเมล์</th>
                                                            <th>โทรศัพท์</th>
                                                            <th>ระดับผู้ใช้</th>
                                                            <th>วันที่และเวลาเข้าสู่ระบบ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody><?php while ($row = mysqli_fetch_assoc($result_data)) { ?>

                                                        <tr valign="middle" class="text-nowrap">
                                                            <td style="width: 10rem;">#<?php echo number_format($order++) ?></td>
                                                            <td style="width: 15rem;"><?php echo $row['mb_url']; ?></td>
                                                            <td style="width: 20rem;"><?php echo $row['mb_firstname'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row['mb_lastname']; ?></td>
                                                            <td style="width: 20rem;"><?php echo substr($row['mb_email'], 0, 3) . "******" . substr($row['mb_email'], -10); ?></td>
                                                            <td style="width: 15rem;"><?php echo substr($row['mb_tel'], 0, 3) . "****" . substr($row['mb_tel'], 7, 10); ?></td>
                                                            <td style="width: 15rem;"><a href="#" data-bs-toggle="modal" data-bs-target="#DATA<?php echo $row['mb_url']; ?>"><?php if ($row['mb_level'] == "1") { echo "แอดมิน"; } else if ($row['mb_level'] == "2") { echo "นักศึกษา"; } else { echo "อาจารย์"; } ?><i class="fas fa-edit ms-2"></i></a></td>
                                                            <td style="width: 10rem;"><?php echo $row['mb_time_login']; ?></td>
                                                        </tr>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="mb_url" value="<?php echo $row['mb_url']; ?>">
                                                            <div class="modal fade" id="DATA<?php echo $row['mb_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="DATA<?php echo $row['mb_url']; ?>">ระดับผู้ใช้งาน &#8211; คุณ<?php echo $row['mb_firstname'] . "&nbsp;&nbsp;&nbsp" . $row['mb_lastname']; ?></h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <select class="form-select" name='mb_level'>
                                                                                <option>-- เลือกระดับผู้ใช้ --</option>
                                                                                <?php
                                                                                if ($row['mb_level'] == "1") {
                                                                                    echo "<option selected value='1'>แอดมิน</option>";
                                                                                    echo "<option value='2'>นักเรียน/นักศึกษา</option>";
                                                                                } else if ($row['mb_level'] == "2") {
                                                                                    echo "<option value='1'>แอดมิน</option>";
                                                                                    echo "<option selected value='2'>นักเรียน/นักศึกษา</option>";
                                                                                }
                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="btn_level_save" class="btn btn-success">บันทึกข้อมูล</button>
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