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
                        <a href="<?php echo URLROOT?>/centermanagers/garbage_types">
                            <div class="main-right-top-three-content">
                                <p>Garbage Types</p>
                                <div class="line"></div>
                            </div>
                        </a>
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
                        <a href="<?php echo URLROOT?>/centermanagers/stock_release_details">
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
                    <div class="main-right-bottom-down">
                        <a href="<?php echo URLROOT?>/centermanagers/release_stocks"><button
                                class="release-button">Release Stocks</button></a>
                    </div>


                </div>

            </div>
        </div>

        <?php if($data['release_popup']=='True') : ?>
        <div class="garbage-release-popup-box" id="garbage-release-popup-box">
            <div class="garbage-release-popup-form" id="popup">
                <div class="form-container">
                    <div class="form-title">Release Stocks</div>
                    <form action="<?php echo URLROOT?>/centermanagers/release_stocks" class="main-right-bottom-content"
                        method="post" id="myForm">
                        <div class="user-details">
                            <div class="cont">
                                <?php foreach($data['types'] as $type) : ?> <div
                                    class="main-right-bottom-content-content">
                                    <span class="details"><?php echo ucfirst($type->name);?></span>
                                    <div class="input-container">
                                        <i class="<?php echo $type->icon?>"></i>
                                        <input name="<?php echo $type->name?>" type="text"
                                            placeholder="Enter Quantity in Kg" value="<?php echo $data[$type->name]?>">
                                        <div class="error-div" style="color:red">
                                            <?php echo $data["{$type->name}_err"]?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="wide-note">
                                <div class="main-right-bottom-content-content A">
                                    <span class="details">Released Person</span>
                                    <div class="input-container">
                                        <i class="icon fas fa-sticky-note"></i>
                                        <input name="released_person" class="note-input" type="text"
                                            placeholder="Enter Released Person"
                                            value="<?php echo $data['released_person']?>">
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
                            <button type="button" class="cancel-button" id="cancelBtn">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($data['sell_price_pop']=='True') : ?>
        <div class="pop_up_confirm_collect">
            <div class="pop_up_confirm_collect_cont">
                <h1>Sell Price Calculation</h1>
                <div class="cont">
                    <h5></h5>
                    <h6>Kg</h6>
                    <h6></h6>
                    <h6>
                        Price
                    </h6>
                    <h6></h6>
                    <h6>
                    </h6>

                </div>
                <?php foreach($data['types'] as $type) : ?>
                <div class="cont">
                    <h5><?php echo ucfirst($type->name); ?></h5>
                    <h6><?php echo empty($data["{$type->name}"]) ? 0 : $data["{$type->name}"] ?>
                    </h6>
                    <h6>*</h6>
                    <h6>
                        <?php echo $type->selling_price?>
                    </h6>
                    <h6>=</h6>
                    <h6><?php echo floatval($data["{$type->name}"]) * ($type->selling_price) ?>
                    </h6>

                </div>
                <?php endforeach; ?>


                <h4>Total Price= <?php echo $data['total_sell_price']?></h4>
                <div class="buttons">
                    <button onclick="submitForm()" class="complete-btn" id="complete-btn">OK</button>
                    <button onclick="cancelForm()" class="cancel-btn" type="button">Cancel</button>

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
                <a href="<?php echo URLROOT?>/centermanagers/stock_release_details"><button
                        type="button">OK</button></a>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>
<script>
document.getElementById('cancelBtn').addEventListener('click', function() {
    window.location.href = "<?php echo URLROOT?>/centermanagers/center_garbage_stock";
});


function submitForm($id) {
    var form = document.getElementById('myForm');
    form.action = "<?php echo URLROOT;?>/centermanagers/release_stocks/True";
    form.method = 'post';
    form.submit();
}

function cancelForm() {
    var url = "<?php echo URLROOT; ?>/centermanagers/release_stocks/False/Flase";
    window.location.href = url;
}
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>