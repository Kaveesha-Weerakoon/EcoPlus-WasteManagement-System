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
                                    <td class="cancel-open"><a href=""><i class='bx bxs-user'
                                                style="font-size: 29px;"></i></a></td>
                                    <td class="cancel-open"><a href=""><i class='bx bxs-trash'
                                                style="font-size: 29px;"></i></a></td>



                                </tr> <?php endforeach; ?>

                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>