<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">

        <div class="Admin_Center_Main_Garbage_Stock">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <a
                                href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                                <div class="main-right-top-back-button">
                                    <i class='bx bxs-chevrons-left'></i>
                                </div>
                            </a>
                            <div class="main-right-top-search" style="visibility: hidden;">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>

                            <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                        </div>
                        <div class="main-right-top-two">
                            <h1>Center Garbage Details</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/Admin/waste_handover/<?php echo $data['center_region']?>"
                                id="waste_handover">
                                <div class="main-right-top-three-content" >
                                    <p>Waste Handover</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/center_main_garbage_stock/<?php echo $data['center_region']?>"
                                id="garbage_stock">
                                <div class="main-right-top-three-content" id="current">
                                    <p>Garbage Stock</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/stock_releases/<?php echo $data['center_region']?>"
                                id="stock_releases">
                                <div class="main-right-top-three-content">
                                    <p>Stock Releases</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <div class="main-right-bottom-top-box">
                                <div class="box-content">
                                    <i class="icon fas fa-trash"></i>
                                    <p>Polythene</p>
                                    <span><?php echo $data['current_polythene']?> <small> kg</small></span>
                                </div>
                                <div class="box-content">
                                    <i class="icon fas fa-box"></i>
                                    <p>Plastics</p>
                                    <span><?php echo $data['current_plastic']?> <small> kg</small></span>
                                </div>
                                <div class="box-content">
                                    <i class="icon fas fa-glass-whiskey"></i>
                                    <p>Glass</p>
                                    <span><?php echo $data['current_glass']?> <small> kg</small></span>
                                </div>
                                <div class="box-content">
                                    <i class="icon fas fa-file-alt"></i>
                                    <p>Paper Waste</p>
                                    <span><?php echo $data['current_paper']?> <small> kg</small></span>
                                </div>
                                <div class="box-content">
                                    <i class="icon fas fa-laptop"></i>
                                    <p>Electronic Waste</p>
                                    <span><?php echo $data['current_electronic']?> <small> kg</small></span>
                                </div>
                                <div class="box-content">
                                    <i class="icon fas fa-box"></i>
                                    <p>Metals</p>
                                    <span><?php echo $data['current_metals']?> <small> kg</small></span>
                                </div>

                            </div>


                        </div>
                      


                    </div>

                        

                    

                   

                </div>
            </div>
        </div>

    </div>
</div>
<script>

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>