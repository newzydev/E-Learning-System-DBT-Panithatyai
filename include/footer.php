<?php 
// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$query_data_f = "SELECT * FROM tbl_article_db as a
INNER JOIN tbl_category_db as c ON a.cg_url=c.cg_url 
ORDER BY at_id DESC LIMIT 2";
$result_data_f = mysqli_query($conn, $query_data_f);
?>
<footer class="wp-content-footer">
        <div class="container">
            <div class="wp-content-footer-detail">
                <div class="row gx-4">
                    <div class="col-sm-12 col-md-12 col-lg-4 mb-3">
                        <div class="wp-content-footer-banner">
                            <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" width="100%">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-2 mb-3">
                        <div class="wp-content-footer-header">
                            ข่าวประชาสัมพันธ์
                        </div>
                        <div class="wp-content-footer-item"><?php while ($row = mysqli_fetch_assoc($result_data_f)) { ?>

                            <div class="one-text"><a href="<?php echo $server['sv_url']; ?>/article/<?php echo $row['at_url']; ?>" class="wp-content-footer-link" title="<?php echo $row['at_title']; ?>"><?php echo $row['at_title']; ?></a></div><?php } ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-2 mb-3">
                        <div class="wp-content-footer-header">
                            นโยบาย / แผนผัง
                        </div>
                        <div class="wp-content-footer-item">
                            <div><a href="<?php echo $server['sv_url']; ?>/privacy-policy" class="wp-content-footer-link" title="นโยบายความเป็นส่วนตัว">นโยบายความเป็นส่วนตัว</a></div>
                            <div><a href="<?php echo $server['sv_url']; ?>/sitemap" class="wp-content-footer-link" title="แผนผังเว็บไซต์">แผนผังเว็บไซต์</a></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-2 mb-3">
                        <div class="wp-content-footer-header">
                            โซเชียลมีเดีย
                        </div>
                        <div class="wp-content-footer-item">
                            <div><a href="https://www.facebook.com/dekpanithatyai" class="wp-content-footer-link" target="_blank" title="Facebook วิทยาลัยเทคโนโลยีพณิชยการหาดใหญ่">Facebook College</a></div>
                            <div><a href="https://www.facebook.com/DBTLEARNING" class="wp-content-footer-link" target="_blank" title="Facebook แหล่งเรียนรู้สาขาเทคโนโลยีธุรกิจดิจิทัล">Facebook DBT</a></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-2 mb-3">
                        <div class="wp-content-footer-header">
                            ติดต่อเรา
                        </div>
                        <div class="wp-content-footer-item">
                            <div><a href="https://mail.google.com/mail/?view=cm&fs=1&to=contact@dbtlearning.com&authuser=0" target="_blank" class="wp-content-footer-link" title="contact@dbtlearning.com">contact@dbtlearning.com</a></div>
                            <div><a href="http://www.dbtlearning.com/" class="wp-content-footer-link" title="www.dbtlearning.com">www.dbtlearning.com</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wp-content-footer-divider"></div>
            <div class="wp-content-footer-copyright">
                &copy; <?php echo $cr_years; ?> DBT / Panithatyai. All rights reserved.<br>จำนวนเข้าชมเว็บไซต์ <a style="background: #fff;color: #13181C;">&nbsp;<?php echo number_format($server['sv_view']); ?>&nbsp;</a> ครั้ง/เดือน<br>อีเมล์: contact@dbtlearning.com เวอร์ชั่น: 1.2.32
            </div>
        </div>
    </footer>

    <div class="modal fade" id="saveimg" tabindex="-1" aria-labelledby="saveimgLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saveimgLabel" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">" อ๊ะ! อย่า Save ภาพสิคะ "</h5>
                <hr>
                <div class="d-flex justify-content-center">
                    <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" width="250" height="50">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="message" tabindex="-1" aria-labelledby="messageLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageLabel" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">" อ๊ะ! อย่าคลิกขวา สิคะ "</h5>
                <hr>
                <div class="d-flex justify-content-center">
                    <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" width="250" height="50">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="message1" tabindex="-1" aria-labelledby="message1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="message1Label" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">" อ๊ะ! อย่ากด Ctrl + U สิคะ "</h5>
                <hr>
                <div class="d-flex justify-content-center">
                    <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" width="250" height="50">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="message2" tabindex="-1" aria-labelledby="message2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="message2Label" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">" อ๊ะ! อย่ากด F12 สิคะ "</h5>
                <hr>
                <div class="d-flex justify-content-center">
                    <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" width="250" height="50">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="message3" tabindex="-1" aria-labelledby="message3Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="message3Label" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">" อ๊ะ! อย่ากด Ctrl + S สิคะ "</h5>
                <hr>
                <div class="d-flex justify-content-center">
                    <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" width="250" height="50">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="message4" tabindex="-1" aria-labelledby="message4Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="message4Label" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">" อ๊ะ! อย่ากด F5 สิคะ "</h5>
                <hr>
                <div class="d-flex justify-content-center">
                    <img src="<?php echo $server['sv_url']; ?>/assets/images/banner.png" width="250" height="50">
                </div>
            </div>
        </div>
    </div>
</div>