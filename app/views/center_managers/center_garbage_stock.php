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
                        <a href="<?php echo URLROOT?>/centermanagers/release_stocks"><button class="release-button">Release Stocks</button></a>
                    </div>

                    
                </div>

            </div>
        </div>

        <?php if($data['release_popup']=='True') : ?>
        <div class="garbage-release-popup-box" id="garbage-release-popup-box">
            <div class="garbage-release-popup-form" id="popup">
                <div class="form-container">
                    <div class="form-title">Release Stocks</div>
                    <form action="<?php echo URLROOT?>/centermanagers/release_stocks" class="main-right-bottom-content" method="post">
                        <div class="user-details">
                            <div class="left-details">
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Polythene</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-trash"></i>
                                        <input name="polythene" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="<?php echo $data['polythene']?>">
                                        <div class="error-div" style="color:red">
                                            <?php echo $data['polythene_err']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Plastic</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-box"></i>
                                        <input name="plastic" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="<?php echo $data['plastic']?>">
                                        <div class="error-div" style="color:red">
                                            <?php echo $data['plastic_err']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Glass</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-glass-whiskey"></i>
                                        <input name="glass" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="<?php echo $data['glass']?>">
                                        <div class="error-div" style="color:red">
                                            <?php echo $data['glass_err']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="right-details">
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Paper Waste</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-file-alt"></i>
                                        <input name="paper_waste" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="<?php echo $data['paper_waste']?>">
                                        <div class="error-div" style="color:red">
                                            <?php echo $data['paper_waste_err']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Electronic Waste</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-laptop"></i>
                                        <input name="electronic_waste" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="<?php echo $data['electronic_waste']?>">
                                        <div class="error-div" style="color:red">
                                            <?php echo $data['electronic_waste_err']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <span class="details">Metals</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-box"></i>
                                        <input name="metals" type="text"
                                            placeholder="Enter Quantity in Kg"
                                            value="<?php echo $data['metals']?>">
                                        <div class="error-div" style="color:red">
                                            <?php echo $data['metals_err']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wide-note">
                                <div class="main-right-bottom-content-content A">
                                    <span class="details">Released Person</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-sticky-note"></i>
                                        <input name="released_person" class="note-input" type="text"
                                            placeholder="Enter Released Person" value="<?php echo $data['released_person']?>">
                                        <div class="error-div" style="color:red">
                                            <?php echo $data['released_person_err']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-right-bottom-content-content A">
                                    <span class="details">Release Note</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-sticky-note"></i>
                                        <input name="release_note" class="note-input" type="text"
                                            placeholder="Enter Note" value="<?php echo $data['release_note']?>">
                                        <div class="error-div" style="color:red">
                                            <?php echo $data['release_note_err']?>
                                        </div>
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
        <?php endif; ?>

        <?php if($data['release_success']=='True') : ?>
            <div class="request_success">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Garbage released successfully</p>
                    <a href="<?php echo URLROOT?>/centermanagers/center_garbage_stock"><button type="button">OK</button></a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
<script>

</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>