<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
        </script>

        <div class="Admin_Garbage_Types_View">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">

                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>
                            <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
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
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <div class="main-right-top-profile-cont">
                                    <h3>Admin</h3>
                                </div>
                            </div>
                        </div>
                        <div class="main-right-top-two">
                            <h1>Garbage Types</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">View</b></p>
                                    <div class="line"  style="background-color: #1ca557;"></div>
                                </div>
                            </a>
                            <a href="">
                                <div class="main-right-top-three-content">
                                    <p>Add</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                        </div>
                    </div>
                    
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Garbage ID</th>
                                    <th>Garbage Type</th>
                                    <th>Credits per waste quantity</th>
                                    <th>Approximate Amount</th>
                                    <th>Minimum Amount</th>
                                    <th>Selling Price</th>
                                    <th>Update</th>
                                    
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['garbage_types'] as $garbage_type) : ?>
                                <tr class="table-row">
                                    <td><?php echo $garbage_type->ID?></td>
                                    <td><?php echo $garbage_type->name?></td>
                                    <td><?php echo $garbage_type->credits_per_waste_quantity?></td>
                                    <td><?php echo $garbage_type->approxiamte_amount?></td>
                                    <td><?php echo $garbage_type->minimum_amount?></td>
                                    <td><?php echo $garbage_type->selling_price?></td>
                                    <td><a href="<?php echo URLROOT ?>/admin/garbage_types_update/<?php echo $garbage_type->ID?>"><i class='bx bx-refresh' style="font-size: 30px; font-weight:1000px;"></i></a></td>
                                    
                                </tr>
                                <?php endforeach; ?>

                        </div>
                    </div>
                  
                </div>
                

                <div class="overlay" id="overlay"></div>

                <?php if($data['click_update']=='True') : ?>
                <div class="update_click" id="update_popup">
                    <div class="popup-form" id="popup">
                        <img src="<?php echo IMGROOT?>/close_popup.png" class="update-popup-img" alt="" id="close_update">
                        <h2>Update Details</h2>
                        <center>
                            <div class="update-topic-line"></div>
                        </center>
                        <form class="updatePopupform" method="post"
                            action="<?php echo URLROOT;?>/admin/garbage_types_update/<?php echo $data['id'];?>" id="update_form">
                            <div class="updateData A">
                                <label>Garbage Type</label><br>
                                <input type="text" name="garbage_type" placeholder="Enter garbage type"
                                    value="<?php echo $data['garbage_type']; ?>" ><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['garbage_type_err']?>
                                </div>
                            </div>
                            <div class="updateData">
                                <label>Credits per waste quantity</label><br>
                                <input type="text" name="credit_per_waste_quantity" placeholder="Enter Credits per waste quantity"
                                    value="<?php echo $data['credit_per_waste_quantity']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['credit_per_waste_quantity_err']?>
                                </div>
                            </div>
                            <div class="updateData">
                                <label>Approximate Amount</label><br>
                                <input type="text" name="approximate_amount" placeholder="Enter Approximate Amount"
                                    value="<?php echo $data['approximate_amount']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['approximate_amount_err']?>
                                </div>
                            </div>
                            <div class="updateData">
                                <label>Minimum Amount</label><br>
                                <input type="text" name="minimum_amount" placeholder="Enter Minimum Amount"
                                    value="<?php echo $data['minimum_amount']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['minimum_amount_err']?>
                                </div>
                            </div>
                            <div class="updateData B">
                                <label>Selling Price</label><br>
                                <input type="text" name="selling_price" placeholder="Enter Selling Price"
                                    value="<?php echo $data['selling_price']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['selling_price_err']?>
                                </div>
                            </div>

                            <div class="btns1">
                                <button type="submit" class="updatebtn">Update</button>
                               <button type="button" class="cancelbtn1" id="close_update_popup">Cancel</button></a>
                            </div>

                        </form>

                    </div>
                </div>

                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<script>


document.addEventListener('DOMContentLoaded', function() {
    const element = document.getElementById('update_popup');
    const overlay = document.getElementById('overlay');
    

    if (element) {
        element.classList.add('active');
        overlay.style.display = "flex";

    }

});

document.addEventListener('DOMContentLoaded', function(){
    const close_update_popup =document.getElementById('close_update_popup');
    const close_update_button = document.getElementById('close_update');

    close_update_popup.addEventListener('click', function(){
        var updatePopup = document.getElementById('update_popup');
        updatePopup.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

    close_update_button.addEventListener('click', function(){
        var updatePopup = document.getElementById('update_popup');
        updatePopup.classList.remove('active');
        document.getElementById('overlay').style.display = "none";

    });

});

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>