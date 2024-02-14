<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Admin">
        <div class="Admin_Admin_View">


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

                            <div class="main-right-top-profile">
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <div class="main-right-top-profile-cont">
                                    <h3>Admin</h3>
                                </div>
                            </div>
                        </div>
                        <div class="main-right-top-two">
                            <h1>Admins</h1>
                        </div>
                        <div class="main-right-top-three">

                            <div class="main-right-top-three-content">
                                <p><b style="color:#1ca557;">View</b></p>
                                <div class="line1"></div>
                            </div>
                            <a href="<?php echo URLROOT?>/admin/addadmins2">

                                <div class="main-right-top-three-content">
                                    <p>Register</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Admin ID</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Personal Details</th>
                                    <th>Delete</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['admin'] as $admin) : ?>

                                <tr class="table-row">
                                    <td>CM <?php echo $admin->user_id?></td>
                                    <td><img src="<?php echo IMGROOT?>/img_upload/admin/<?php echo $admin->image?>"
                                            alt="" class="manager_img"></td>
                                    <td><?php echo $admin->name?></td>
                                    <td><?php echo $admin->email?></td>
                                    <td><i onclick="openpersonaldetails((<?php echo htmlspecialchars(json_encode( $admin), ENT_QUOTES, 'UTF-8') ?>))"
                                                 class='bx bxs-user' style="font-size: 29px;"></i></td>
                                    <td class="cancel-open"><a href="<?php echo URLROOT?>/admin/admin_delete_confirm/<?php echo $admin->user_id?>"><i class='bx bxs-trash'
                                                style="font-size: 29px;"></i></a></td>



                                </tr> <?php endforeach; ?>

                            </table>


                        </div>
                    </div>
                </div>
            </div>


            <div class="overlay" id="overlay"></div>


<div class="personal-details-popup-box" id="personal-details-popup-box">
    <div class="personal-details-popup-form">
        <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="personal-details-popup-form-close"
        id="personal-details-popup-form-close">
        <center>
            <div class="personal-details-topic">Personal Details</div>
        </center>

        <div class="personal-details-popup">
            <div class="personal-details-left">
                <!-- <img src="<?php echo IMGROOT?>/img_upload/Admin/<?php echo $data['image']?>" class="profile-pic"
                    alt=""> -->
                    <img src="" id="admin_profile_pic" alt="">
                <p>Admin ID: <span id="admin_id">C</span></p>
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
                    <span id="admin_name"></span><br>
                    <span id="admin_email"></span><br>
                    <span id="admin_nic"></span><br>
                    <span id="admin_address"></span><br>
                    <span id="admin_contact_no"></span><br>
                    <span id="admin_dob"></span><br>

                </div>
            </div>
        </div>
    </div>

</div>



            <?php if($data['confirm_delete']=='True') : ?>
                    <div class="delete_confirm">
                            <div class="popup" id="popup">
                                <img src="<?php echo IMGROOT?>/trash.png" alt="">
                                <?php
                                    echo "<h2>Delete this Admin?</h2>";
                                    echo "<p>This action will permanently delete this Admin</p>";
                                
                                ?>
                                <div class="btns">
                                    <?php
                                            echo '<a href="' . URLROOT . '/Admin/admin_delete/' . $data['admin_id'] . '"><button type="button" class="deletebtn">Delete</button></a>';
                                    
                                    ?>                     
                                    <a href="<?php echo URLROOT?>/Admin/admins"><button type="button" class="cancelbtn" >Cancel</button></a>
                                </div>
                            </div>
                    </div>
                    <?php endif; ?>
                    <?php if($data['success']=='True') : ?>
                        <div class="center_manager_success">
                                <div class="popup" id="popup">
                                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                                    <h2>Success!!</h2>
                                    <p>Admin has been deleted successfully</p>
                                    <a href="<?php echo URLROOT?>/admin/admins"><button type="button" >OK</button></a>
                                </div>
                        </div>
             d<?php endif; ?>
    
        </div>
    </div>
</div>




    <script>
     function openpersonaldetails(Admin){
        var personalPop = document.getElementById('personal-details-popup-box');
        personalPop.classList.add('active');
        document.getElementById('overlay').style.display = "flex";
       
        document.getElementById('admin_id').textContent =Admin.user_id;
        document.getElementById('admin_profile_pic').src =  "<?php echo IMGROOT?>/img_upload/Admin/" + Admin.image;
        document.getElementById('admin_name').textContent = Admin.name;
        document.getElementById('admin_email').textContent = Admin.email;
        document.getElementById('admin_nic').textContent = Admin.nic;
        document.getElementById('admin_address').textContent =Admin.address;
        document.getElementById('admin_contact_no').textContent = Admin.contact_no;
        document.getElementById('admin_dob').textContent = Admin.dob;
        

    }

    document.addEventListener('DOMContentLoaded', function() {
        var close_personal_details = document.getElementById('personal-details-popup-form-close');
        close_personal_details.addEventListener('click', function() {
            const personal_details = document.getElementById("personal-details-popup-box");
            personal_details.classList.remove('active');
            document.getElementById('overlay').style.display = "none";
            
        });
    });


</script>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>