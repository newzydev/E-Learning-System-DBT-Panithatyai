<div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="wp-content-aside">
                            <div class="wp-content-search mb-4">
                                <form action="<?php echo $server['sv_url']; ?>/results.php" method="GET">
                                    <input type="search" name="search_query" class="form-control form-control-lg" value="<?php echo isset($search) ? $search : '' ?>" placeholder="ค้นหา . . ." title="ค้นหา . . ." required autocomplete="off">
                                </form>
                            </div>
                            <div class="wp-content-list-menu mb-4">
                                <?php 
                                // ดึงข้อมูลจากฐานข้อมูลมาแสดง
                                $query_data_menu1 = "SELECT * FROM tbl_category_db ORDER BY cg_id DESC";
                                $result_data_menu1 = mysqli_query($conn, $query_data_menu1);
                                ?>
                                <h3>หมวดหมู่</h3>
                                <ul class="list-group list-group-flush"><?php while ($row = mysqli_fetch_assoc($result_data_menu1)) { ?>

                                    <li class="list-group-item one-text"><a href="<?php echo $server['sv_url']; ?>/results.php?search_query=<?php echo $row['cg_name']; ?>" title="<?php echo $row['cg_name']; ?>"><?php echo $row['cg_name']; ?></a></li><?php } ?>

                                </ul>
                            </div>
                            <div class="wp-content-list-menu mb-4">
                                <?php 
                                // ดึงข้อมูลจากฐานข้อมูลมาแสดง
                                $query_data_menu2 = "SELECT * FROM tbl_article_db ORDER BY at_id DESC LIMIT 15";
                                $result_data_menu2 = mysqli_query($conn, $query_data_menu2);
                                ?>
                                <h3>ข่าวประชาสัมพันธ์ (ล่าสุด)</h3>
                                <ul class="list-group list-group-flush"><?php while ($row = mysqli_fetch_assoc($result_data_menu2)) { ?>
                                    
                                    <li class="list-group-item one-text"><a href="<?php echo $server['sv_url']; ?>/article/<?php echo $row['at_url']; ?>" title="<?php echo $row['at_title']; ?>"><?php echo $row['at_title']; ?></a></li><?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>