<?php
require_once('server.php');
session_start();

// ดึงข้อมูลภาพสไลต์จาก tbl_infographic_db มาแสดง
// $query_pr = "SELECT * FROM tbl_infographic_db ORDER BY pr_id DESC LIMIT 5";
// $result_pr = mysqli_query($conn, $query_pr);
$query_pr = "SELECT * FROM tbl_article_db ORDER BY at_id DESC LIMIT 12";
$result_pr = mysqli_query($conn, $query_pr);

// ดึงข้อมูลภาพสไลต์จาก tbl_course_db มาแสดง
$query_data_1 = "SELECT * FROM tbl_course_db ORDER BY cs_id DESC LIMIT 12";
$result_data_1 = mysqli_query($conn, $query_data_1);

// ดึงข้อมูลภาพสไลต์จาก tbl_article_db มาแสดง
$query_data_2 = "SELECT * FROM tbl_article_db ORDER BY at_id DESC LIMIT 20";
$result_data_2 = mysqli_query($conn, $query_data_2);

// นับจำนวนการเข้าชมเว็บ
$sql_view = "UPDATE tbl_server_db SET sv_view = sv_view+1";
$result_view = mysqli_query($conn, $sql_view);

// ออกจากระบบ
if (isset($_REQUEST['logout'])) {
    session_destroy();
    unset($_SESSION['member_url']);
    $redirect = $server['sv_url'] . "/login";
    header("location:$redirect");
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <title><?php echo $server['sv_title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="0">
    <meta property="og:title" content="<?php echo $server['sv_title']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta property="og:url" content="<?php echo $server['sv_url']; ?>/">
    <meta property="og:site_name" content="<?php echo $server['sv_title']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:description" content="<?php echo $server['sv_description']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="<?php echo $server['sv_url']; ?>/">
    <meta name="twitter:title" content="<?php echo $server['sv_title']; ?>">
    <meta name="twitter:image" content="<?php echo $server['sv_url']; ?>/assets/images/logo-background.png">
    <meta name="description" content="<?php echo $server['sv_description']; ?>">
    <meta name="keywords" content="<?php echo $server['sv_keyword']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="5X1AFUYfrOjT4q0K9dF8BPM0MU2WYJum6iZ5RytNmDs">

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
    <?php include('include/header.php'); ?>

    <script src="<?php echo $server['sv_url']; ?>/assets/js/jssor.slider-28.1.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        window.jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Orientation: 2,
                $NoDrag: true
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 2000;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <style>
        /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .jssora061 {display:block;position:absolute;cursor:pointer;}
        .jssora061 .a {fill:none;stroke:#fff;stroke-width:360;stroke-linecap:round;}
        .jssora061:hover {opacity:.8;}
        .jssora061.jssora061dn {opacity:.5;}
        .jssora061.jssora061ds {opacity:.3;pointer-events:none;}
    </style>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:415px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/articles/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:415px;overflow:hidden;"><?php while ($row = mysqli_fetch_assoc($result_pr)) { ?>
            
            <div><a href="<?php echo $server['sv_url']; ?>/article/<?php echo $row['at_url']; ?>" title="<?php echo $row['at_title']; ?>"><img data-u="image" src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/articles/<?php echo $row['at_img']; ?>" /></a><div u="thumb"><a href="<?php echo $server['sv_url']; ?>/article/<?php echo $row['at_url']; ?>" title="<?php echo $row['at_title']; ?>" class="thumb-link"><?php echo $row['at_title']; ?></a></div></div><?php } ?>

        </div><a data-scale="0" href="https://www.jssor.com" style="display:none;position:absolute;">image gallery</a>
        <!-- Thumbnail Navigator -->
        <div u="thumbnavigator" style="position:absolute;bottom:0px;left:0px;width:980px;height:30px;color:#FFF;overflow:hidden;cursor:default;background-color:rgba(0,0,0,.5);">
            <div u="slides">
                <div u="prototype" style="position:absolute;top:0;left:0;width:980px;height:30px;">
                    <div u="thumbnailtemplate" style="position:absolute;top:0;left:0;width:100%;height:100%;font-weight:normal;line-height:30px;font-size:14px;padding-left:10px;box-sizing:border-box;text-align:center;"></div>
                </div>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora061" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="a" d="M11949,1919L5964.9,7771.7c-127.9,125.5-127.9,329.1,0,454.9L11949,14079"></path>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora061" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="a" d="M5869,1919l5984.1,5852.7c127.9,125.5,127.9,329.1,0,454.9L5869,14079"></path>
            </svg>
        </div>
    </div>
    <script type="text/javascript">jssor_1_slider_init();
    </script>
    <!-- #endregion Jssor Slider End -->

    <!-- Video HCC 2022 -->
    <!-- <section id="video-Present">
        <video width="100%" autoplay muted loop>
            <source src="<?php echo $server['sv_url']; ?>/assets/285007471_530216475304751_5223544134789149156_n.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <video width="100%" autoplay muted loop>
            <source src="<?php echo $server['sv_url']; ?>/assets/video-present-hcc-2022.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section> -->

    <section>
        <div class="wp-content-about">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>เกี่ยวกับเรา</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        ปัจจุบัน trend การศึกษาในสายอาชีพกำลังมาแรงแซงทางโค้ง จากตัวเลขบัณฑิตล้นงาน เพราะขาดทักษะเฉพาะทาง เรียนจบมาไม่ตรงคุณสมบัติที่ภาคธุรกิจต้องการ ประกอบกับตลาดแรงงานขาดแคลนแรงงานฝีมือที่มีฝีมือและความเชี่ยวชาญสูง ทำให้ต้องหันกลับมาพิจารณากันว่า ค่านิยมด้านการศึกษาของบ้านเรากำลังมุ่งไปถูกทิศทางหรือไม่ นอกจากนั้นยังส่งผลให้เด็กนักเรียนหรือคนรุ่นใหม่หลายๆคน เกิดคำถามในใจว่า เรียนสายอาชีพดีไหม และการเรียนสายอาชีพมีจุดแข็งหรือข้อดีอย่างไรสำหรับอนาคต
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Message -->
    <section>
        <div class="wp-content-message">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header align-items-center">
                        <div class="overlay"></div>
                        <div class="message">
                            <i class="display-6 fas fa-quote-left mb-3 me-2"></i>
                            <h1 class="display-5"><?php echo $server['sv_caption']; ?></h1>
                            <h5>&#8211; <?php echo $server['sv_author']; ?> &#8211;</h5>
                            <i class="display-6 fas fa-quote-right mt-2 ms-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course e-Learning -->
    <section>
        <div class="wp-content-course">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>หลักสูตรเรียน e-Learning</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="row gx-4"><?php while ($row = mysqli_fetch_assoc($result_data_1)) { ?>

                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="<?php echo $server['sv_url']; ?>/course/<?php echo $row['cs_url']; ?>" class="wp-content-a-card" title="<?php echo $row['cs_name']; ?>">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/courses/<?php echo $row['cs_img']; ?>" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <div class="wp-content-course-code"><?php echo $row['cs_code']; ?></div>
                                            <div class="wp-content-course-title one-text"><?php echo $row['cs_name']; ?></div>
                                            <div class="wp-content-course-subject"><?php echo $row['cs_des']; ?></div>
                                            <div class="wp-content-course-category one-text"><i class="fas fa-folder-open"></i>(<?php $url = $row['cs_url']; $qd = "SELECT * FROM tbl_unit_db WHERE cs_url = '$url'"; $rd = mysqli_query($conn, $qd); $ct = mysqli_num_rows($rd); echo number_format($ct) ?> หน่วย) <?php echo $row['cs_name']; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div><?php } ?>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-3 mx-auto">
                                        <div class="d-grid">
                                            <a href="<?php echo $server['sv_url']; ?>/courses" class="btn btn-all"><i class="fas fa-arrow-right me-2"></i>หลักสูตรทั้งหมด</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 mt-5">
                <div class="container">
                    <div class="wp-content-header">
                        <h3>ข่าวประชาสัมพันธ์</h3>
                    </div>
                    <div class="wp-content-divider"></div>
                    <div class="wp-content-detail">
                        <div class="row gx-4"><?php while ($row = mysqli_fetch_assoc($result_data_2)) { ?>

                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                                <a href="<?php echo $server['sv_url']; ?>/article/<?php echo $row['at_url']; ?>" class="wp-content-a-card" title="<?php echo $row['at_title']; ?>">
                                    <div class="wp-content-card">
                                        <div class="wp-content-thumbnail">
                                            <img src="<?php echo $server['sv_url']; ?>/wp-contents/uploads/articles/<?php echo $row['at_img']; ?>" width="100%">
                                        </div>
                                        <div class="wp-content-course">
                                            <div class="wp-content-course-code one-text text-center"><?php echo $row['at_title']; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div><?php } ?>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-3 mx-auto">
                                        <div class="d-grid">
                                            <a href="<?php echo $server['sv_url']; ?>/articles" class="btn btn-all"><i class="fas fa-arrow-right me-2"></i>ข่าวประชาสัมพันธ์ทั้งหมด</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Message -->
    <section>
        <div class="wp-content-message-1 wp-footer-overflow">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="wp-content-header align-items-center">
                        <div class="overlay"></div>
                        <div class="message">
                            <h1 class="display-5">แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่</h1>
                            <hr>
                            <div class="wp-content-count-down">
                                <div class="box">
                                    <h1 class="text-center">ประกาศเว็บไซต์จะหยุดให้บริการ</h1>
                                    <h5 class="text-center">
                                        [ ในวันที่ 20 พฤศจิกายน 2565 เป็นต้นไป ]
                                    </h5>
                                    <div class="allTime">
                                        <div class="wp days"></div>
                                        <div class="wp hrs"></div>
                                        <div class="wp min"></div>
                                        <div class="wp sec"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('include/footer.php'); ?>

    <!-- Page to top -->
    <button class="btn btn-blue" id="button">
        <i class="fas fa-angle-up"></i>
    </button>

    <!-- Javascript Library -->
    <script src="<?php echo $server['sv_url']; ?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo $server['sv_url']; ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $server['sv_url']; ?>/assets/js/script-main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <!-- Count down -->
    <!-- <script>
    let countDownBox = document.querySelector(".allTime");
    let daysBox	= document.querySelector(".days");
    let hrsBox = document.querySelector(".hrs");
    let minBox = document.querySelector(".min");
    let secBox = document.querySelector(".sec");
    let countDownDate = new Date("Nov 20, 2022 23:59:59").getTime();
    let x = setInterval(function() {
    let now = new Date().getTime();
    let distance = countDownDate - now;
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
    daysBox.innerHTML = days + "<span>วัน</span>";
    hrsBox.innerHTML = hours + "<span>ชั่วโมง</span>";
    minBox.innerHTML = minutes + "<span>นาที</span>";
    secBox.innerHTML = seconds + "<span>วินาที</span>";
    if (distance < 0) {
    clearInterval(x);
    countDownBox.innerHTML = "<h4>✅✅✅ เว็บไซต์ได้หยุดให้บริการ !!! ✅✅✅</h4>";
    }
    }, 1000);
    </script> -->
</body>

</html>