<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Customer">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
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

                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Customers</h1>
                    </div>
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Profile</th>
                                <th>Request Details</th>
                                <th>Block</th>
                                <th>Delete</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">

                        <table class="table">
                            <?php foreach($data['customers'] as $customer) : ?>
                            <tr class="table-row">
                                <td>C <?php echo $customer->user_id?></td>
                                <td><?php echo $customer->name?></td>
                                <td><img class="customer_img"
                                        onclick="view_customer_details(<?php echo htmlspecialchars(json_encode($customer), ENT_QUOTES, 'UTF-8') ?>)"
                                        src="<?php echo IMGROOT ?>/img_upload/customer/<?php echo ($customer->image == '') ? 'Profile.png' : $customer->image; ?>"
                                        alt=""></td>

                                <td><a
                                        href="<?php echo URLROOT?>/Admin/get_customer_fined_requests/<?php echo $customer->user_id?>"><i
                                            class='bx bx-info-circle' style="font-size: 29px"></i></a></td>
                                <td>
                                    <?php if ($customer->blocked ==FALSE) : ?>
                                    <i class="fa-solid fa-user-lock" style="font-size: 20px;"
                                        onclick="block_user('<?php echo $customer->user_id; ?>')"></i>
                                    <?php else : ?>
                                    <i class="fa-solid fa-unlock" style="font-size: 20px;"
                                        onclick="un_block_user('<?php echo $customer->user_id; ?>')"></i>
                                    <?php endif; ?>
                                </td>

                                <td><a
                                        href="<?php echo URLROOT?>/Admin/customerdelete_confirm/<?php echo $customer->user_id?>"><i
                                            class='bx bxs-trash' style="font-size: 29px;"></i></a></td>
                                <?php endforeach; ?>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <?php if($data['delete_confirm']=='True') : ?>
        <div class="delete_confirm">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/trash.png" alt="">
                <?php
                        echo "<h2>Delete this Collector?</h2>";
                        echo "<p>This action will permanently delete this center manager</p>";          
                    ?>
                <div class="btns">

                    <a href="<?php echo URLROOT?>/Admin/customerdelete/<?php echo $data['id']?>"><button type="button"
                            class="deletebtn">Delete</button></a>

                    <a href="<?php echo URLROOT?>/Admin/customers"><button type="button"
                            class="cancelbtn">Cancel</button></a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="request-details-pop" id="request-details-popup-box">
            <div class="request-details-pop-form">
                <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="request-details-pop-form-close"
                    id="request-details-pop-form-close" onclick="close_request_details()">
                <div class="request-details-pop-form-top">
                    <div class="request-details-topic">Customer Details<div id="req_id3"></div>
                    </div>
                </div>

                <div class="request-details-pop-form-content">
                    <div class="request-details-right-labels">
                        <span>Customer Id</span><br>
                        <span>Name</span><br>
                        <span>Email</span><br>
                        <span>Contact No</span><br>
                        <span>Address</span><br>
                        <span>Region</span><br>
                    </div>
                    <div class="request-details-right-values">
                        <span id="customer_id"></span><br>
                        <span id="customer_name"></span><br>
                        <span id="customer_email"></span><br>
                        <span id="customer_mobno"></span><br>
                        <span id="customer_address"></span><br>
                        <span id="customer_region"></span><br>
                    </div>
                </div>
            </div>
        </div>
        <?php if($data['fine']=='True') : ?>
        <div class="total_request">
            <div class="total_request_cont">
                <div class="top-close">
                    <a href="<?php echo URLROOT?>/admin/customers"> <img src="<?php echo IMGROOT?>/close_popup.png"
                            class="top-close-img" alt="" id="close_update"></a>
                </div>
                <div class="top">
                    <div class="top-cont">
                        <i class="fa-solid fa-square-check" style="font-size:40px"></i>
                        <h4>Completed Requests</h4>
                        <h5>
                            <?php echo count($data['completed_requests'])?>
                        </h5>
                    </div>
                    <div class="top-cont">
                        <i class="fa-solid fa-square-xmark" style="font-size:40px"></i>
                        <h4>Fined Requests</h4>
                        <h5>
                            <?php echo count($data['fined_requests'])?>
                        </h5>
                    </div>
                </div>
                <h1 class="req_h1">Fined Requests</h1>
                <div class="bottom">
                    <?php if (!empty($data['fined_requests'])) : ?>
                    <div class="bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Request ID</th>
                                <th>Cancelled Date & Time</th>
                                <th>Fine Type</th>
                            </tr>
                        </table>
                    </div>
                    <div class="bottom-down">

                        <table class="table">
                            <?php foreach($data['fined_requests'] as $fined_requests) : ?>

                            <tr class="table-row">
                                <td>
                                    <?php echo $fined_requests->req_id?>
                                </td>
                                <td> <?php echo $fined_requests->cancelled_time?>
                                </td>
                                <td><?php echo $fined_requests->fine_type?></td>
                            </tr>
                            <?php endforeach; ?>

                        </table>
                    </div>
                    <?php else: ?>
                    <h3>No Fined Requests</h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="delete_confirm2" id="cancel_confirm">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                <h2>Block the User?</h2>
                <p>This action will Block the user </p>
                <div class="btns">
                    <a id="cancelLink"><button type="button" class="deletebtn">Block</button></a>
                    <a id="close_cancel"><button type="button" class="cancelbtn">Cancel</button></a>
                </div>
            </div>
        </div>
        <div class="delete_confirm2" id="cancel_confirm2">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                <h2>UnBlock the User?</h2>
                <p>This action will UnBlock the user </p>
                <div class="btns">
                    <a id="unblockLink"><button type="button" class="deletebtn">UnBlock</button></a>
                    <a id="close_unblock"><button type="button" class="cancelbtn">Cancel</button></a>
                </div>
            </div>
        </div>
        <div class="overlay" id="overlay"></div>

    </div>
</div>
<script>
function view_customer_details(customer) {
    var requestDetails_popup = document.getElementById('request-details-popup-box');
    requestDetails_popup.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
    document.getElementById('customer_id').innerText = customer.user_id
    document.getElementById('customer_name').innerText = customer.name
    document.getElementById('customer_email').innerText = customer.email
    document.getElementById('customer_address').innerText = customer.address
    document.getElementById('customer_region').innerText = customer.city;
    document.getElementById('customer_mobno').innerText = customer.mobile_number;
}

function close_request_details() {
    var requestDetails_popup = document.getElementById('request-details-popup-box');
    requestDetails_popup.classList.remove('active');
    document.getElementById('overlay').style.display = "none";
}

function block_user(id) {
    var userId = id;
    var newURL = "<?php echo URLROOT?>/admin/blockuser/" + userId;
    document.getElementById('cancelLink').href = newURL;
    document.getElementById('overlay').style.display = "flex";
    document.getElementById('cancel_confirm').classList.add('active');
}

function un_block_user(id) {
    var userId = id;
    var newURL = "<?php echo URLROOT?>/admin/unblockuser/" + userId;
    document.getElementById('unblockLink').href = newURL;
    document.getElementById('overlay').style.display = "flex";
    document.getElementById('cancel_confirm2').classList.add('active');
}

document.addEventListener("DOMContentLoaded", function() {

    const close_cancel = document.getElementById("close_cancel");
    const close_unblock = document.getElementById("close_unblock");

    close_cancel.addEventListener("click", function() {
        document.getElementById('cancel_confirm').classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });


    close_unblock.addEventListener("click", function() {
        document.getElementById('cancel_confirm2').classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>