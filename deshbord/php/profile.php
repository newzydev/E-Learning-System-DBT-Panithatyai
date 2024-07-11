<?php 
// เช็คเซสชั่น
if (isset($_SESSION['member_url'])) {
    // รับค่ามาจากเซสชั่น
    $member_url = $_SESSION['member_url'];

    // เช็คค่าที่ส่งมาจากเซสชั่น
    $query = "SELECT * FROM tbl_member_db WHERE mb_url ='$member_url'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $acount = mysqli_fetch_array($result);
    }

    $mb_fullname = $acount['mb_firstname'] . "&nbsp;&nbsp;&nbsp;" . $acount['mb_lastname'];
    $mb_time_login = $acount['mb_time_login'];
}

// แก้ไขบัญชีผู้ใช้ profile page 1
if (isset($_REQUEST['btn_profile_page_1_save'])) {

    $mb_url = $acount["mb_url"];
    $profile_firstname = $_POST["profile_firstname"];
    $profile_lastname = $_POST["profile_lastname"];
    $profile_email = $_POST["profile_email"];
    $profile_school = $_POST["profile_school"];
    $profile_tel = $_POST["profile_tel"];
    $mb_time_edit = datetime();

    // เช็คการป้อนข้อมูล
    if (empty($profile_firstname) || empty($profile_lastname) || empty($profile_email) || empty($profile_school) || empty($profile_tel)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_member_db SET 
        mb_url = '$mb_url', 
        mb_firstname = '$profile_firstname', 
        mb_lastname = '$profile_lastname', 
        mb_email = '$profile_email', 
        mb_school = '$profile_school', 
        mb_tel = '$profile_tel', 
        mb_time_edit = '$mb_time_edit' 
        WHERE mb_url = '$mb_url'";

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

// เปลี่ยนรหัสผ่าน profile page 2
if (isset($_REQUEST['btn_profile_page_2_save'])) {

    $mb_url = $acount["mb_url"];
    $profile_password_1 = $_POST["profile_password_1"];
    $profile_password_2 = $_POST["profile_password_2"];
    $mb_time_edit = datetime();

    // เช็คการป้อนข้อมูล
    if (empty($profile_password_1) || empty($profile_password_2)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    } else if ($profile_password_1 != $profile_password_2) {
        $errorMsg = "กรุณากรอกรหัสผ่านทั้งสองให้ตรงกัน";
    }

    // เข้ารหัสพาสเวิร์ด
    $passwordenc = md5($profile_password_1);

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_member_db SET 
        mb_url = '$mb_url', 
        mb_password = '$passwordenc', 
        mb_time_edit = '$mb_time_edit' 
        WHERE mb_url = '$mb_url'";

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

// ลบบัญชีผู้ใช้ profile page 3
if (isset($_REQUEST['btn_profile_delete'])) {

    $mb_url = $acount["mb_url"];

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "DELETE FROM tbl_member_db WHERE mb_url = '$mb_url'";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            session_destroy();
            unset($_SESSION['member_url']);
            $redirect = $server['sv_url'] . "/login";
            header("location:$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}
?>