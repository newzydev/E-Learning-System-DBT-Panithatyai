<!-- Messenger ปลั๊กอินแชท Code -->
<div id="fb-root"></div>

<!-- Your ปลั๊กอินแชท code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "113400294580125");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v12.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<canvas class="snow" id="snow" width="1848" height="515"></canvas>
<script>
    (function () {

    var canvas, ctx;
    var points = [];
    var maxDist = 100;

    function init() {
        //Add on load scripts
        canvas = document.getElementById("snow");
        ctx = canvas.getContext("2d");
        resizeCanvas();
        pointFun();
        setInterval(pointFun, 20);
        window.addEventListener('resize', resizeCanvas, false);
    }
    //Particle constructor
    function point() {
        this.x = Math.random() * (canvas.width + maxDist) - (maxDist / 2);
        this.y = Math.random() * (canvas.height + maxDist) - (maxDist / 2);
        this.z = (Math.random() * 0.5) + 0.5;
        this.vx = ((Math.random() * 2) - 0.5) * this.z;
        this.vy = ((Math.random() * 1.5) + 1.5) * this.z;
        this.fill = "rgba(255,255,255," + ((0.4 * Math.random()) + 0.5) + ")";
        this.dia = ((Math.random() * 2.5) + 1.5) * this.z;
        points.push(this);
    }
    //Point generator
    function generatePoints(amount) {
        var temp;
        for (var i = 0; i < amount; i++) {
            temp = new point();
        };
        // console.log(points);
    }
    //Point drawer
    function draw(obj) {
        ctx.beginPath();
        ctx.strokeStyle = "transparent";
        ctx.fillStyle = obj.fill;
        ctx.arc(obj.x, obj.y, obj.dia, 0, 2 * Math.PI);
        ctx.closePath();
        ctx.stroke();
        ctx.fill();
    }
    //Updates point position values
    function update(obj) {
        obj.x += obj.vx;
        obj.y += obj.vy;
        if (obj.x > canvas.width + (maxDist / 2)) {
            obj.x = -(maxDist / 2);
        }
        else if (obj.xpos < -(maxDist / 2)) {
            obj.x = canvas.width + (maxDist / 2);
        }
        if (obj.y > canvas.height + (maxDist / 2)) {
            obj.y = -(maxDist / 2);
        }
        else if (obj.y < -(maxDist / 2)) {
            obj.y = canvas.height + (maxDist / 2);
        }
    }
    //
    function pointFun() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (var i = 0; i < points.length; i++) {
            draw(points[i]);
            update(points[i]);
        };
    }

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        points = [];
        generatePoints(window.innerWidth / 3);
        pointFun();
    }

    //Execute when DOM has loaded
    document.addEventListener('DOMContentLoaded', init, false);
    })();
</script>

<header class="d-none d-lg-block">
        <div class="header-menu-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col left">
                        <a href="<?php echo $server['sv_url']; ?>">
                            <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" width="400">
                        </a>
                    </div>
                    <div class="col">
                        <div class="wp-name-text">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#profile"><?php echo $mb_fullname; ?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?php echo $mb_time_login; ?>
                        </div>
                    </div>
                    <div class="col right">
                        <p>ออกจากระบบ เพื่อจบการทำงานของระบบ</p>
                        <form action="<?php echo $server['sv_url']; ?>/logout.php" method="post">
                            <a href="<?php echo $server['sv_url']; ?>/my-account" class="btn btn-outline-primary">หลักสูตรที่ลงทะเบียน</a>
                            <button type="submit" name="logout" class="btn btn-primary">ออกจากระบบ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Desktop Device -->
    <nav class="navbar-shadow navbar navbar-expand-lg navbar-light sticky-lg-top d-none d-lg-block">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" class="d-lg-none d-lg-block" width="50">
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar1">
                <i class="fas fa-bars"></i>
            </button>
            <div id="navbar1" class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/members" class="nav-link pe-3 ps-3"><i class="fas fa-users"></i>รายการบัญชี</a>
                    </li>
                    <!-- <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/infographics" class="nav-link pe-3 ps-3"><i class="fas fa-book-open"></i>รายการสไลต์</a>
                    </li> -->
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/courses" class="nav-link pe-3 ps-3"><i class="fas fa-book-open"></i>รายการหลักสูตร</a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/articles" class="nav-link pe-3 ps-3"><i class="fas fa-folder-open"></i>รายการบทความ</a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/categorys" class="nav-link pe-3 ps-3"><i class="fas fa-folder-open"></i>รายการหมวดหมู่</a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/contacts" class="nav-link pe-3 ps-3"><i class="fas fa-envelope"></i>กล่องข้อความ</a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/settings" class="nav-link pe-3 ps-3"><i class="fas fa-laptop-code"></i>ตั้งค่าเว็บไซต์</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Device -->
    <nav class="navbar-shadow navbar navbar-mobile navbar-expand-lg navbar-light fixed-top d-lg-none d-lg-block">
        <div class="container">
            <a href="<?php echo $server['sv_url']; ?>" class="navbar-brand">
                <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" class="d-lg-none d-lg-block" width="200">
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar1">
                <i class="fas fa-bars"></i>
            </button>
            <div id="navbar1" class="collapse navbar-collapse">
                <ul class="navbar-nav navbar-nav-mobile mx-auto">
                    <hr>
                    <li class="nav-item">
                        <a href="#" class="nav-link mobile" data-bs-toggle="modal" data-bs-target="#profile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-user"></i><?php echo $mb_fullname; ?></div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li>
                    <div class="divider"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/my-account" class="nav-link mobile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-book"></i>หลักสูตรที่ลงทะเบียน</div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li>
                    <div class="divider"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/members" class="nav-link mobile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-users"></i>รายการบัญชี</div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li>
                    <!-- <div class="divider"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/infographics" class="nav-link mobile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-book-open"></i>รายการสไลต์</div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li> -->
                    <div class="divider"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/courses" class="nav-link mobile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-folder-open"></i>รายการหลักสูตร</div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li>
                    <div class="divider"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/articles" class="nav-link mobile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-folder-open"></i>รายการบทความ</div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li>
                    <div class="divider"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/categorys" class="nav-link mobile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-folder-open"></i>รายการหมวดหมู่</div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li>
                    <div class="divider"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/contacts" class="nav-link mobile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-envelope"></i>กล่องข้อความ</div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li>
                    <div class="divider"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/deshbord/settings" class="nav-link mobile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-laptop-code"></i>ตั้งค่าเว็บไซต์</div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li>
                    <div class="divider"></div>
                    <li class="nav-item">
                        <a href="<?php echo $server['sv_url']; ?>/logout.php?logout" class="nav-link mobile">
                            <div class="d-flex justify-content-between">
                                <div><i class="fas fa-sign-in-alt"></i>ออกจากระบบ</div>
                                <div><i class="fas fa-angle-down"></i></div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile modal page 1 -->
    <form action="" method="post">
        <div class="modal fade" id="profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profile"><?php echo $mb_fullname; ?> &#8211; [<?php if ($acount['mb_level'] == "1") { echo "แอดมิน"; } else if ($acount['mb_level'] == "2") { echo "นักเรียน/นักศึกษา"; } else { echo "ครู/อาจารย์"; } ?>] &#8211; [1/2]</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="profile_firstname" class="form-label">ชื่อจริง <span class="sp-red">*</span></label>
                                    <input type="text" name="profile_firstname" class="form-control" id="profile_firstname" value="<?php echo $acount['mb_firstname']; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="profile_lastname" class="form-label">นามสกุล <span class="sp-red">*</span></label>
                                    <input type="text" name="profile_lastname" class="form-control" id="profile_lastname" value="<?php echo $acount['mb_lastname']; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="profile_email" class="form-label">ที่อยู่อีเมล <span class="sp-red">*</span></label>
                                    <input type="email" name="profile_email" class="form-control" id="profile_email" value="<?php echo $acount['mb_email']; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="profile_school" class="form-label">ชื่อสถานศึกษา (ถ้ามี)</label>
                                    <input type="text" name="profile_school" class="form-control" id="profile_school" value="<?php echo $acount['mb_school']; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="profile_tel" class="form-label">เบอร์โทรศัพท์ <span class="sp-red">*</span></label>
                                    <input type="tel" name="profile_tel" class="form-control" id="profile_tel" value="<?php echo $acount['mb_tel']; ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-warning" data-bs-target="#profile2" data-bs-toggle="modal" data-bs-dismiss="modal">เปลี่ยนรหัสผ่าน</a>
                        <button type="submit" name="btn_profile_page_1_save" class="btn btn-success">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Profile modal page 2 -->
    <form action="" method="post">
        <div class="modal fade" id="profile2" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profile"><?php echo $mb_fullname; ?> &#8211; [<?php if ($acount['mb_level'] == "1") { echo "แอดมิน"; } else if ($acount['mb_level'] == "2") { echo "นักเรียน/นักศึกษา"; } else { echo "ครู/อาจารย์"; } ?>] &#8211; [2/2]</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="profile_password_1" class="form-label">รหัสผ่านใหม่ <span class="sp-red">*</span></label>
                                    <input type="password" name="profile_password_1" class="form-control" id="profile_password_1" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="profile_password_2" class="form-label">ยืนยันรหัสผ่านใหม่ <span class="sp-red">*</span></label>
                                    <input type="password" name="profile_password_2" class="form-control" id="profile_password_2" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="delete_account" class="form-label">หากไม่ต้องการบัญชีนี้แล้ว</label>
                                    <a href="#" id="delete_account" data-bs-target="#profile3" data-bs-toggle="modal" data-bs-dismiss="modal">ลบบัญชีผู้ใช้</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-warning" data-bs-target="#profile" data-bs-toggle="modal" data-bs-dismiss="modal">ย้อนกลับ</a>
                        <button type="submit" name="btn_profile_page_2_save" class="btn btn-success">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Profile modal page 3 -->
    <form action="" method="post">
        <div class="modal fade" id="profile3" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profile"><?php echo $mb_fullname; ?> &#8211; [<?php if ($acount['mb_level'] == "1") { echo "แอดมิน"; } else if ($acount['mb_level'] == "2") { echo "นักเรียน/นักศึกษา"; } else { echo "ครู/อาจารย์"; } ?>]</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    ยืนยันที่จะลบบัญชีผู้ใช้ของท่าน หากต้องการ ให้กดปุ่ม "ยืนยัน" หากไม่ต้องการ ให้กดปุ่ม "ยกเลิก" 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</a>
                        <button type="submit" name="btn_profile_delete" class="btn btn-success">ยืนยันที่จะลบ</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="wp-content-top d-lg-none d-lg-block"></div>
    