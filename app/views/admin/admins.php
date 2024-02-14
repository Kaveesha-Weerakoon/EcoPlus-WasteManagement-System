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
                                    <td class="cancel-open"><a href=""><i class='bx bxs-trash'
                                                style="font-size: 29px;"></i></a></td>



                                </tr> <?php endforeach; ?>

                            </table>


                        </div>
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
                            <img src="" id="collector_profile_pic" alt="">
                        <p>Admin ID: <span id="collector_id">C</span></p>
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
                            <span id="collector_name"></span><br>
                            <span id="collector_email"></span><br>
                            <span id="collector_nic"></span><br>
                            <span id="collector_address"></span><br>
                            <span id="collector_contact_no"></span><br>
                            <span id="collector_dob"></span><br>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </div>
</div>

<script>
     function openpersonaldetails(Admin){
        var personalPop = document.getElementById('personal-details-popup-box');
        personalPop.classList.add('active');
        document.getElementById('overlay').style.display = "flex";
       
        document.getElementById('collector_id').textContent =Admin.user_id;
        document.getElementById('collector_profile_pic').src =  "<?php echo IMGROOT?>/img_upload/Admin/" + Admin.image;
        document.getElementById('collector_name').textContent = Admin.name;
        document.getElementById('collector_email').textContent = Admin.email;
        document.getElementById('collector_nic').textContent = Admin.nic;
        document.getElementById('collector_address').textContent =Admin.address;
        document.getElementById('collector_contact_no').textContent = Admin.contact_no;
        document.getElementById('collector_dob').textContent = Admin.dob;
        

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
<?php require APPROOT . '/views/inc/footer.php'; ?>