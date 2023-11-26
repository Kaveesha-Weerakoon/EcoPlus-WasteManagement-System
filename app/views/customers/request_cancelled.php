<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Request_Main">
        <div class="Customer_Request_Cancelled">
        <div class="main">
            <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT ?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                     <a href="<?php echo URLROOT?>/customers">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT ?>/Customer_DashBoard_Icon.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT ?>/Customer_Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    <a href="<?php echo URLROOT?>/customers/history">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT ?>/Customer_tracking _Icon.png" alt="">
                            <h2>History</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/customers/editprofile">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT ?>/Customer_Edit_Pro_Icon.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>
                </div>
                <div class="main-left-bottom">
   
                <a href="<?php echo URLROOT?>/customers/logout">
  
                        <div class="main-left-bottom-content">
                            <img src="<?php echo IMGROOT ?>/Logout.png" alt="">
                            <p>Log out</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                       <div class="main-right-top-one-input">
                           <img src="<?php echo IMGROOT?>/Search.png" alt="">
                           <input type="text" placeholder="Search">
                        </div>
                        <div class="main-right-top-one-content">
                            <p><?php echo $_SESSION['user_name']?></p>
                            <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Requests</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/customers/request_main">
                            <div class="main-right-top-three-content">
                                <p>Current</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/customers/request_completed">
                            <div class="main-right-top-three-content">
                                <p>Completed</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                      
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Cancelled</b></p>
                                <div class="line"></div>
                            </div>
                        
                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Req ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Center</th>
                                <th>Location</th> 
                                <th>Collector</th>
                                <th>Cancelled By</th>
                                <th>Reason</th>

                            </tr>
                        </table>
                    </div>

                    <div class="main-right-bottom-down">
                        <table class="table">
                           <?php foreach($data['cancelled_request'] as $request) : ?>
                               <tr class="table-row">
                                 <td>R<?php echo $request->req_id?></td>
                                 <td><?php echo $request->date?></td>
                                 <td><?php echo $request->time?></td>
                                 <td><?php echo $request->region?></td>
                                 <td><img src="<?php echo IMGROOT?>/location.png" alt=""></td>
                                 <td><img src="<?php echo IMGROOT?>/view.png" alt=""></td>
                                 <td><?php echo $request->cancelled_by?></td>
                                 <td><?php echo ($request->reason ? $request->reason : 'None'); ?></td>                             </tr>
                            <?php endforeach; ?>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>  
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
