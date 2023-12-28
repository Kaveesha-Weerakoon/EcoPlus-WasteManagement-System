<?php require APPROOT . '/views/inc/header.php'; ?>
 <div class="Admin_Main">
    <div class="Admin_Customer_Complains">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <!-- <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="<?php echo URLROOT?>/admin">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Home.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Reports.png" alt="">
                            <h2>Reports</h2>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Complains.png" alt="">
                            <h2>Complains</h2>
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
                <a href="<?php echo URLROOT?>/admin/logout">
                <div class="main-left-bottom">
                    <div class="main-left-bottom-content">
                        <img src="<?php echo IMGROOT?>/logout.png" alt="">
                        <p>Log out</p>
                    </div>
                </div>
                </a>
            </div> -->
             <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <img src="<?php echo IMGROOT?>/Search.png" alt="">
                        <input type="text" placeholder="Search">
                        <div class="main-right-top-one-content">
                            <p>Admin Account</p>
                            <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Complaints</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Customers</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/Admin/complain_collectors">
                            <div class="main-right-top-three-content">
                                <p>Collectors</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p>Credit Discount Agent</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Complain ID</th>
                                <th>Customer ID</th>
                                <th>Date</th>
                                <th>Contact NO</th>
                                <th>Customer Name</th>
                                <th>Subject</th>
                                <th>Complain</th>
                                <th>Action</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                        <?php foreach($data['complains'] as $post) : ?>
                                       <tr class="table-row">
                                           <td>Com <?php echo $post->id?></td>
                                           <td>C<?php echo $post->customer_id?></td>
                                           <td><?php echo $post->date?></td>
                                           <td><?php echo $post->contact_no?></td>
                                           <td><?php echo $post->name?></td>
                                           <td><?php echo $post->subject?></td>
                                           <td><?php echo $post->complaint?></td>                                   
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/delete.png" alt=""></td>
                                        </tr>
                                  <?php endforeach; ?>
                        </table>

                    </div>
                </div>
             </div>
        </div>

    </div> 
 </div>
    


<?php require APPROOT . '/views/inc/footer.php'; ?>
