<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Main_Workers">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>
            <!-- <div class="main-left">
            <div class="main-left-top">
                <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                <h1>Eco Plus</h1>
            </div>
            <div class="main-left-middle">
                <a href="./Collector_DashBoard.html">
                    <div class="main-left-middle-content current">
                        <div class="main-left-middle-content-line"></div>
                        <img src="<?php echo IMGROOT?>/Home.png" alt="">
                        <h2>Dashboard</h2>
                    </div>
                </a>
                <a href="./Collector_Requests/Collector_Requests.html">
                    <div class="main-left-middle-content">
                        <div class="main-left-middle-content-line1"></div>
                        <img src="<?php echo IMGROOT?>/Reports.png" alt="">
                        <h2>Reports</h2>
                    </div>
                </a>
                <a href="./Complains/Complains_customer.html">
                    <div class="main-left-middle-content Collector">
                        <div class="main-left-middle-content-line1"></div>
                        <img src="<?php echo IMGROOT?>/Complains.png" alt="">
                        <h2>Complaints</h2>
                    </div>
                </a>
                <a href="./Collector_Edit_Profile/Collector_EditProfile.html">
                    <div class="main-left-middle-content">
                        <div class="main-left-middle-content-line1"></div>
                        <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                        <h2>Edit Profile</h2>
                    </div>
                </a>

            </div>
            <div class="main-left-bottom">
                <div class="main-left-bottom-content">
                    <img src="<?php echo IMGROOT?>/logout.png" alt="">
                    <p>Log out</p>
                </div>
            </div>
            </div> -->

            <div class="main-right">
                <div class="main-top">
                    <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                        <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                    </a>

                    <div class="main-top-component">
                        <p>Admin</p>
                        <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                    </div>
                </div>
                <div class="main-bottom">
                    <div class="main-bottom-top">
                        <div class="main-right-top-two">
                            <h1>Center Workers</h1>
                        </div>
                    </div>

                    <?php if(!empty($data['workers_in_center'])) : ?>
                    <div class="main-bottom-down">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Name</th>
                                    <th>NIC</th>
                                    <th>Address</th>
                                    <th>DOB</th>
                                    <th>Contact No</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                            <?php foreach($data['workers_in_center'] as $worker) : ?>
                                <tr class="table-row">
                                    <td><?php echo $worker->name?></td>
                                    <td><?php echo $worker->nic?></td>
                                    <td><?php echo $worker->address?></td>
                                    <td><?php echo $worker->dob?></td>
                                    <td><?php echo $worker->contact_no?></td>
                                </tr>   
                                <?php endforeach; ?>  
                            </table>            
                        </div>

                    </div>
                    <?php else: ?>
                        <div class="main-right-bottom-two">
                            <div class="main-right-bottom-two-content">
                                <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                                <h1>There are no center workers in the center</h1>
                                <p>All the center workers will appear here</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>


</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>