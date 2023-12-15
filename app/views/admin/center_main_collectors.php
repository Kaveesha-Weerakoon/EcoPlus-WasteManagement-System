<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Main_Collectors">
        <div class="main">

            <div class="main-left">
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
            </div>

            <div class="main-right">
                <div class="main-top">
                    <a href="<?php echo URLROOT?>/admin">
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
                            <h1>Collectors</h1>
                        </div>
                        <!-- <div class="main-right-top-three">
                            <a href="">
                                <div class="main-right-top-three-content">
                                    <p><b style="color: #1B6652;">View</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/admin/center_add">
                                <div class="main-right-top-three-content">
                                    <p>Add</p>
                                    <div class="line1"></div>
                                </div>
                            </a>

                        </div> -->
                    </div>
                    <div class="main-bottom-down">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Collector ID</th>
                                    <th>Profile Pic</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Personal details</th>
                                    <th>Vehicle details</th>
                                    <th>Collector Assitants</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                            <?php foreach($data['collectors_in_center'] as $collector) : ?>
                                <tr class="table-row">
                                    <td>C<?php echo $collector->id?></td>
                                    <td class="collector_image"><img
                                        src="<?php echo IMGROOT ?>/img_upload/collector/<?php echo $collector->image?>" alt=""></td>
                                    <td><?php echo $collector->name?></td>
                                    <td><?php echo $collector->email?></td>
                                    <td><a href="<?php echo URLROOT?>/admin/center_main/<?php echo $centers->id?>"><img src="<?php echo IMGROOT?>/Admin_Center.png" alt=""></a></td>
                                    <td><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                    <td class="delete"> <a href="<?php echo URLROOT?>/admin/center_delete/<?php echo $centers->id?>"><img src="<?php echo IMGROOT?>/delete.png" alt=""></a></td>
                                </tr>   
                                <?php endforeach; ?>  
                                        
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>


</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>