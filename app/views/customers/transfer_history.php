<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_History_Top">
     <div class="Customer_Transfer_History"> 
           <div class="main">
              <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="<?php echo URLROOT?>/customers">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_DashBoard_Icon.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/customers/request_main">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    </a>
                    
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Customer_tracking _Icon.png" alt="">
                            <h2>History</h2>
                        </div>
                    
                    <a href="<?php echo URLROOT?>/customers/editprofile">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_Edit_Pro_Icon.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>
                </div>
                <div class="main-left-bottom">

                    <a href="<?php echo URLROOT?>/customers/logout">
                        <div class="main-left-bottom-content">
                            <img src="<?php echo IMGROOT?>/Logout.png" alt="">
                            <p>Log out</p>
                        </div>
                    </a>
                </div>
              </div>
              <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                       <div class="main-right-top-one-search">
                           <img src="<?php echo IMGROOT?>/Search.png" alt="">
                           <input type="text" placeholder="Search">
                        </div>
                        <div class="main-right-top-one-content">
                            <p><?php echo $_SESSION['user_name']?></p>
                            <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>History</h1>
                    </div>
                    <div class="main-right-top-three">

                       <a href="<?php echo URLROOT?>/customers/history">
                            <div class="main-right-top-three-content">
                                <p>Discounts History</p>
                                <div class="line1"></div>
                            </div>
                        </a>

                        <a href="<?php echo URLROOT?>/customers/history_complains">
                            <div class="main-right-top-three-content">
                                <p>Complaints History</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Transfer History</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-container">
                        <div class="main-right-bottom-container-top">
                            <div class="circle"></div>
                            <h4>Transfer History</h4>
                        </div>
                        <div class="main-right-bottom-container-bottom">
                        <div class="main-right-bottom-top">
                                <table class="table">
                                    <tr class="table-header">
                                        <th>Transfer ID</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Transaction Account</th>
                                        <th>Transaction Person</th>
                                        <th>Amount</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">
                                <table class="table">
                                 
                                <?php foreach ($data['transaction_history'] as $transaction): ?>
                                    <tr class="table-row">
                                        <td>T <?php echo $transaction->id ?></td>
                                        <td><?php echo $transaction->date . ' ' . $transaction->time; ?></td>
                                        <td>
                                            <?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                                <img class="status" src="<?php echo IMGROOT; ?>/send.png" alt="">
                                                <p>Sent</p>
                                            <?php else: ?>
                                                <img class="status" src="<?php echo IMGROOT; ?>/recieved.png" alt="">
                                                <p>Received</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                               C <?php echo $transaction->receiver_id; ?>
                                            <?php else: ?>
                                               C <?php echo $transaction->sender_id; ?>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                                <img class="td-pro_pic" src="<?php echo (empty($transaction->receiver_image) || !file_exists(IMGROOT . '/img_upload/customer/' . $transaction->receiver_image) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->receiver_image; ?>" alt="">
                                            <?php else: ?>
                                                <img class="td-pro_pic" src="<?php echo (empty($transaction->sender_image) || !file_exists(IMGROOT . '/img_upload/customer/' . $transaction->sender_image) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->sender_image; ?>" alt="">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $transaction->transfer_amount; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                </div>

              </div>
        </div>
     </div>
     </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
