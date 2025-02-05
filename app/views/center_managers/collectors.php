<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Collector">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
                        </div>
                        <?php require APPROOT . '/views/center_managers/centermanager_notifications/centermanager_notifications.php'; ?>

                    </div>
                    <div class="main-right-top-two">
                        <h1>Collectors</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: var(--green-color-one);">View</b></p>
                                <div class="line" style="background-color: var(--green-color-one);"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/collectors_add">
                            <div class="main-right-top-three-content">
                                <p>Register</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/collector_assistants">
                            <div class="main-right-top-three-content">
                                <p>Assistants</p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
                </div>

                <?php if(!empty($data['collectors'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top ">
                        <table class="table">
                            <tr class="table-header">
                                <th>Collector ID</th>
                                <th>Profile Pic</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Personal Details</th>
                                <th>Vehicle Details</th>
                                <th>Update</th>
                                <th>Action</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['collectors'] as $collector) : ?>
                            <tr class="table-row">
                                <td><?php echo $collector->user_id?></td>
                                <td><img src="<?php echo IMGROOT ?>/img_upload/collector/<?php echo $collector->image?>"
                                        alt="" class="collector_img"></td>
                                <td><?php echo $collector->collector_name?></td>
                                <td><?php echo $collector->email?></td>
                                <td>
                                    <i class='bx bxs-user' style="font-size: 29px;"
                                        onclick="openPersonalDetails((<?php echo htmlspecialchars(json_encode($collector), ENT_QUOTES, 'UTF-8') ?>))"></i>
                                </td>
                                <td>
                                    <i class='bx bxs-truck' style="font-size: 29px;"
                                        onclick="openvehicledetails((<?php echo htmlspecialchars(json_encode($collector), ENT_QUOTES, 'UTF-8') ?>))"></i>

                                </td>
                                <td><a
                                        href="<?php echo URLROOT?>/centermanagers/collectors_update/<?php echo $collector->user_id ?>"><i
                                            class='bx bx-refresh' style="font-size: 30px; font-weight:1000px;"></i>
                                    </a></td>
                                <td>
                                    <?php
                                                if(str_contains($collector->request_type, 'assigned')) {
                                                    echo '<i class="fa-solid fa-triangle-exclamation" style="font-size: 24px; color:#DC2727;" onclick="delete_assigned_collector(\'' . $collector->user_id . '\')"></i>';
                                                } else {
                                                if ($collector->disable) {
                                                     echo '<i class="fa-solid fa-unlock" style="font-size: 20px;" onclick="un_block_user(\'' . $collector->user_id . '\')"></i>';
                                                } else {
                                                     echo '<i class="fa-solid fa-user-lock" style="font-size: 20px;" onclick="block_user(\'' . $collector->user_id . '\')"></i>';
                                                  }
                                            }
                                    ?>

                                </td>


                            </tr>
                            <?php endforeach; ?>

                    </div>
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                        <img src="<?php echo IMGROOT?>/undraw_questions_re_1fy7.svg" alt="">
                        <h1>There are no collectors available</h1>
                        <p>Register a collector now!</p>
                        <a href="<?php echo URLROOT?>/centermanagers/collectors_add"><button>Register</button></a>

                    </div>
                </div>
                <?php endif; ?>


            </div>

            <div class="overlay" id="overlay"></div>

            <?php if($data['click_update']=='True') : ?>
            <div class="update_click">
                <div class="popup-form" id="popup">
                    <a href="<?php echo URLROOT?>/centermanagers/collectors"><img
                            src="<?php echo IMGROOT?>/close_popup.png" class="update-popup-img" alt=""></a>
                    <h2>Update Details</h2>
                    <center>
                        <div class="update-topic-line"></div>
                    </center>
                    <form class="updatePopupform"
                        action="<?php echo URLROOT;?>/centermanagers/collectors_update/<?php echo $data['id'];?>"
                        method="post">
                        <div class="updatePopupform-div">
                            <div class="personal-details">Personal Details</div>
                            <div class="top-personal-details">
                                <div class="updateData">
                                    <label>Name</label><br>
                                    <input type="text" name="name" placeholder="Enter name"
                                        value="<?php echo $data['name']; ?>"><br>
                                    <div class="error-div" style="color:red">
                                        <?php echo $data['name_err']?>
                                    </div>
                                </div>
                                <div class="updateData">
                                    <label>NIC</label><br>
                                    <input type="text" name="nic" placeholder="Enter NIC"
                                        value="<?php echo $data['nic']; ?>"><br>
                                    <div class="error-div" style="color:red">
                                        <?php echo $data['nic_err']?>
                                    </div>
                                </div>
                                <div class="updateData">
                                    <label>Address</label><br>
                                    <input type="text" name="address" placeholder="Enter Address"
                                        value="<?php echo $data['address']; ?>"><br>
                                    <div class="error-div" style="color:red">
                                        <?php echo $data['address_err']?>
                                    </div>
                                </div>
                                <div class="updateData">
                                    <label>Contact No</label><br>
                                    <input type="text" name="contact_no" placeholder="Enter Contact No"
                                        value="<?php echo $data['contact_no']; ?>"><br>
                                    <div class="error-div" style="color:red">
                                        <?php echo $data['contact_no_err']?>
                                    </div>
                                </div>
                                <div class="updateData">
                                    <label>DOB</label><br>
                                    <input type="date" name="dob" placeholder="Enter DOB"
                                        value="<?php echo $data['dob']; ?>"><br>
                                    <div class="error-div" style="color:red">
                                        <?php echo $data['dob_err']?>
                                    </div>
                                </div>
                            </div>
                            <div class="vehicle-details">Vehicle Details</div>
                            <div class="bottom-vehicle-details">
                                <div class="updateData">
                                    <label>Vehicle Plate No</label><br>
                                    <input type="text" name="vehicle_no" placeholder="Enter Vehicle Plate No"
                                        value="<?php echo $data['vehicle_no']; ?>"><br>
                                    <div class="error-div" style="color:red">
                                        <?php echo $data['vehicle_no_err']?>
                                    </div>
                                </div>
                                <div class="updateData">
                                    <label>Vehicle Type</label><br>
                                    <input type="text" name="vehicle_type" placeholder="Enter Vehicle Type"
                                        value="<?php echo $data['vehicle_type']; ?>"><br>
                                    <div class="error-div" style="color:red">
                                        <?php echo $data['vehicle_type_err']?>
                                    </div>
                                </div>

                            </div>

                            <div class="btns1">
                                <button type="submit" class="updatebtn">Update</button>
                                <button type="button" class="cancelbtn1"><a
                                        href="<?php echo URLROOT?>/centermanagers/collectors">Cancel</a></button>
                            </div>

                        </div>


                    </form>
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

            <div class="delete_prohibitted" id="delete-prohibitted-popup">
                <div class="popup">
                    <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                    <h2>This action is prohibitted</h2>
                    <p>Collector <span class="Collector" id="collector_assigned"></span> has already assigned for
                        requests</p>

                    <button class="delete_prohibitted-ok-button" id="delete_prohibitted-ok-button">OK</button>



                </div>
            </div>



            <?php if($data['update_success']=='True') : ?>
            <div class="success_popup_box">
                <div class="popup1" id="popup1">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Collector details has updated successfully</p>
                    <a href="<?php echo URLROOT?>/centermanagers/collectors"><button type="button">OK</button></a>

                </div>
            </div>
            <?php endif; ?>


            <?php if($data['delete_success']=='True') : ?>
            <div class="success_popup_box">
                <div class="popup1" id="popup1">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Collector has deleted successfully</p>
                    <a href="<?php echo URLROOT?>/centermanagers/collectors"><button type="button">OK</button></a>
                </div>
            </div>
            <?php endif; ?>


        </div>




        <div class="personal-details-popup-box" id="personal-details-popup">
            <div class="personal-details-popup-form">
                <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="personal-details-popup-form-close"
                    id="personal-details-popup-form-close">
                <center>
                    <div class="personal-details-topic">Personal Details</div>
                </center>

                <div class="personal-details-popup">
                    <div class="personal-details-left">
                        <img src="" class="profile-pic" alt="" id="col_profile_img">
                        <p>Collector ID: <span id="col_id">C</span></p>
                    </div>
                    <div class="personal-details-right">
                        <div class="personal-details-right-labels">
                            <span>Name</span><br>
                            <span>Email</span><br>
                            <span>NIC</span><br>
                            <span>Address</span><br>
                            <span>Contact No</span><br>
                            <span>DOB</span><br>
                        </div>
                        <div class="personal-details-right-values">
                            <span id="col_name"></span><br>
                            <span id="col_email"></span><br>
                            <span id="col_nic"></span><br>
                            <span id="col_address"></span><br>
                            <span id="col_contact"></span><br>
                            <span id="col_dob"></span><br>

                        </div>
                    </div>
                </div>
            </div>

        </div>




        <div class="vehicle-details-popup-box" id="vehicle-details-popup-box">
            <div class="vehicle-details-popup-form" id="popup">
                <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="vehicle-details-popup-form-close"
                    id="vehicle-details-popup-form-close">
                <center>
                    <div class="vehicle-details-topic">Vehicle Details</div>
                </center>

                <div class="vehicle-details-popup">
                    <div class="vehicle-details-labels">
                        <span>Collector ID</span><br>
                        <span>Name</span><br>
                        <span>Vehicle Plate No</span><br>
                        <span>Vehicle Type</span><br>
                    </div>
                    <div class="vehicle-details-values">
                        <span id="vehicle_collector_id">C</span><br>
                        <span id="vehicle_collector_name"></span><br>
                        <span id="vehicle_collector_no"></span><br>
                        <span id="vehicle_type"></span><br>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<script>
/* Notification View */
document.getElementById('submit-notification').onclick = function() {
    var form = document.getElementById('mark_as_read');
    var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/collectors";
    form.action = dynamicUrl; // Set the action URL
    form.submit(); // Submit the form

};

function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');

    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var name = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
        var email = row.querySelector('td:nth-child(4)').innerText.toLowerCase();

        if (id.includes(input) || name.includes(input) || email.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });
}

document.getElementById('searchInput').addEventListener('input', searchTable);

function openvehicledetails(collector) {
    var locationPop = document.getElementById('vehicle-details-popup-box');
    locationPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    document.getElementById('vehicle_collector_id').textContent = collector.user_id;
    document.getElementById('vehicle_collector_name').textContent = collector.collector_name;
    document.getElementById('vehicle_collector_no').textContent = collector.vehicle_no;
    document.getElementById('vehicle_type').textContent = collector.vehicle_type;
}

function openPersonalDetails(collector) {
    var personalPop = document.getElementById('personal-details-popup');
    personalPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    document.getElementById('col_id').textContent = collector.user_id;
    document.getElementById('col_profile_img').src = '<?php echo IMGROOT ?>/img_upload/collector/' + collector.image;
    document.getElementById('col_name').textContent = collector.collector_name;
    document.getElementById('col_email').textContent = collector.email;
    document.getElementById('col_nic').textContent = collector.nic;
    document.getElementById('col_address').textContent = collector.address;
    document.getElementById('col_contact').textContent = collector.collector_contact;
    document.getElementById('col_dob').textContent = collector.dob;
}

function delete_assigned_collector(collector_id) {
    var collector_assigned = document.getElementById('collector_assigned');
    collector_assigned.textContent = collector_id;

    var delProhibittedPopup = document.getElementById('delete-prohibitted-popup');
    delProhibittedPopup.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function block_user(id) {
    var userId = id;
    var newURL = "<?php echo URLROOT?>/centermanagers/collector_block/" + userId;
    document.getElementById('cancelLink').href = newURL;
    document.getElementById('overlay').style.display = "flex";
    document.getElementById('cancel_confirm').classList.add('active');
}

function un_block_user(id) {
    var userId = id;
    var newURL = "<?php echo URLROOT?>/centermanagers/collector_unblock/" + userId;
    document.getElementById('unblockLink').href = newURL;
    document.getElementById('overlay').style.display = "flex";
    document.getElementById('cancel_confirm2').classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
    var close_vehicledetail = document.getElementById('vehicle-details-popup-form-close');
    var close_delete_prohibitted = document.getElementById('delete_prohibitted-ok-button');
    var close_personaldetails = document.getElementById('personal-details-popup-form-close');

    close_vehicledetail.addEventListener('click', function() {
        var vehicle_pop = document.getElementById('vehicle-details-popup-box');
        vehicle_pop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

    close_delete_prohibitted.addEventListener('click', function() {
        var delProhibittedPopup = document.getElementById('delete-prohibitted-popup');
        delProhibittedPopup.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

    close_personaldetails.addEventListener('click', function() {
        var personalPop = document.getElementById('personal-details-popup');
        personalPop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

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