<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Center_Garbage_Stock">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
                        </div>
                        <div class="main-right-top-notification" id="notification">
                            <i class='bx bx-bell'></i>
                            <div class="dot"></div>
                        </div>
                        <div id="notification_popup" class="notification_popup">
                            <h1>Notifications</h1>
                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                Request 1232 Has been Cancelled
                            </div>
                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                Request 1232 Has been Assigned
                            </div>
                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                Request 1232 Has been Cancelled
                            </div>
                        </div>
                        <div class="main-right-top-profile">
                            <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>"
                                alt="">
                            <div class="main-right-top-profile-cont">
                                <h3><?php echo $_SESSION['center_manager_name']?></h3>
                                <p>ID : Col <?php echo $_SESSION['center_manager_id']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Center Waste Management</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/centermanagers/waste_management">
                            <div class="main-right-top-three-content">
                                <p>Waste Handover</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_garbage_stock">
                            <div class="main-right-top-three-content">
                                <p><b style="color:#1ca557;">Garbage Stock</b></p>
                                <div class="line" style="background-color: #1ca557;"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers_add">
                            <div class="main-right-top-three-content">
                                <p>Stock Relaeses</p>
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
                                <span><?php echo $data['current_paper_waste']?> <small> kg</small></span>
                            </div>
                            <div class="box-content">
                                <i class="icon fas fa-laptop"></i>
                                <p>Electronic Waste</p>
                                <span><?php echo $data['current_electronic_waste']?> <small> kg</small></span>
                            </div>
                            <div class="box-content">
                                <i class="icon fas fa-box"></i>
                                <p>Metals</p>
                                <span><?php echo $data['current_metals']?> <small> kg</small></span>
                            </div>

                        </div>


                    </div>
                    <div class="main-right-bottom-down">
                        <a href=""><button class="release-button">Release Stocks</button></a>
                    </div>

                    
                </div>

            </div>
        </div>

        <div class="garbage-release-popup-box" id="garbage-release-popup-box">
            <div class="garbage-release-popup-form" id="popup">
                <div class="form-container">
                    <div class="form-title">Release Stocks</div>
                    <form action="" class="main-right-bottom-content" method="post">
                        <div class="user-details">
                            <div class="left-details">
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Polythene</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-trash"></i>
                                        <input name="polythene_quantity" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="">
                                        <!-- <div class="error-div" style="color:red">
                                            <?php echo $data['polythene_quantity_err']?>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Plastic</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-box"></i>
                                        <input name="plastic_quantity" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="">
                                        <!-- <div class="error-div" style="color:red">
                                            <?php echo $data['plastic_quantity_err']?>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Glass</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-glass-whiskey"></i>
                                        <input name="glass_quantity" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="">
                                        <!-- <div class="error-div" style="color:red">
                                            <?php echo $data['glass_quantity_err']?>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="right-details">
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Paper Waste</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-file-alt"></i>
                                        <input name="paper_waste_quantity" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="">
                                        <!-- <div class="error-div" style="color:red">
                                            <?php echo $data['paper_waste_quantity_err']?>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Electronic Waste</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-laptop"></i>
                                        <input name="electronic_waste_quantity" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="">
                                        <!-- <div class="error-div" style="color:red">
                                            <?php echo $data['electronic_waste_quantity_err']?>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Metals</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-box"></i>
                                        <input name="metals_quantity" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="">
                                        <!-- <div class="error-div" style="color:red">
                                            <?php echo $data['metals_quantity_err']?>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="wide-note">
                                <div class="main-right-bottom-content-content A">
                                    <span class="details">Released Person</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-sticky-note"></i>
                                        <input name="note" class="note-input" type="text"
                                            placeholder="Enter Released Person" value="">
                                        <!-- <div class="error-div" style="color:red">
                                            <?php echo $data['note_err']?>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content A">
                                    <span class="details">Center Manager Note</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-sticky-note"></i>
                                        <input name="note" class="note-input" type="text"
                                            placeholder="Enter Note" value="">
                                        <!-- <div class="error-div" style="color:red">
                                            <?php echo $data['note_err']?>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-button">
                            <button type="submit">Release</button>
                            <a href="<?php echo URLROOT?>/centermanagers/center_garbage_stock"><button type="button"
                                    class="cancel-button">Cancel</button></a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>

</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>