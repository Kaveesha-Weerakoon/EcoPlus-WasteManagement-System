<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">

    <div class="CenterManager_Dashboard">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <!-- <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bxl-sketch'></i> <input type="text" placeholder="Welcome Back !" id="searchInput"
                            readonly oninput="highlightMatchingText()">
                    </div>
                    <div class="main-right-top-notification" id="notification">
                        <i class='bx bx-bell'></i>
                        <?php if (!empty($data['notification'])) : ?>
                        <div class="dot"></div>
                        <?php endif; ?>
                    </div>
                    <div id="notification_popup" class="notification_popup">
                        <h1>Notifications</h1>
                        <div class="notification_cont">
                            <?php foreach($data['notification'] as $notification) : ?>

                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                <?php echo $notification->notification?>
                            </div>
                            <?php endforeach; ?>

                        </div>
                        <form class="mark_as_read" method="post" action="<?php echo URLROOT;?>/customers/">
                            <i class='bx bx-signal-4'></i>
                            <button type="submit">Mark all as read</button>
                        </form>

                    </div>
                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['user_name']?></h3>
                            <p>ID : C <?php echo $_SESSION['user_id']?></p>
                        </div>
                    </div>
                </div> -->
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" id="notification">
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
                        <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['center_manager_name']?></h3>
                            <p>ID : CM <?php echo $_SESSION['center_manager_id']?></p>
                        </div>
                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-one">
                        <div class="main-right-bottom-one-left">
                            <div class="left">
                                <h1>Total Balance</h1>
                                <h3>+Eco 26.23 </h3>
                                <p>Last Update</p>
                                <button onclick="redirect_transfercredit()">Transfer Credit</button>

                            </div>

                            <div class="right">
                                <h1>Eco<span class="main-credit"></span> </h1>
                                <h3>WALLET AMOUNT</h3>
                            </div>
                        </div>
                        <div class="main-right-bottom-one-right">

                            <canvas id="myChart" width="700" height="300"></canvas>
                        </div>
                    </div>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-cont A" id="credit_per_waste_quantity">
                            <div class="icon_container">
                                <i class='bx bx-dollar-circle'></i>
                            </div>
                            <h3>Collectors</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A">
                            <div class="icon_container">
                                <i class='bx bx-money-withdraw'></i>
                            </div>
                            <h3>Center Workers</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A">
                            <div class="icon_container">
                                <i class='bx bxs-bank'></i>
                            </div>
                            <h3>Discount Agents</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_complains()">
                            <div class="icon_container">
                                <i class='bx bx-donate-heart'></i>
                            </div>
                            <h3>Complaints</h3>
                        </div>

                    </div>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-left">
                            <!-- <h1>Recent Transactions</h1>

                            <?php
                                 $transaction_history = $data['transaction_history'];
                                 $limited_transactions = array_slice($transaction_history, 0, 3);

                                 foreach ($limited_transactions as $transaction):
                            ?>
                            <div class="main-right-bottom-three-left-cont">
                                <?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                <img class="td-pro_pic"
                                    src="<?php echo (empty($transaction->receiver_image) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/' . $transaction->receiver_image) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->receiver_image; ?>"
                                    alt="">
                                <?php else: ?>
                                <img class="td-pro_pic"
                                    src="<?php echo (empty($transaction->sender_image) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/'. $transaction->sender_image) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->sender_image; ?>"
                                    alt="">
                                <?php endif; ?>
                                <h3><?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                    C <?php echo $transaction->receiver_id; ?>
                                    <?php else: ?>
                                    C <?php echo $transaction->sender_id; ?>
                                    <?php endif; ?>
                                </h3>
                                <h2
                                    style="color: <?php echo ($transaction->sender_id == $_SESSION['user_id']) ? '#F13E3E' : '#1ca557'; ?>;">
                                    <?php
                                          echo ($transaction->sender_id == $_SESSION['user_id']) ? "-Eco " : "+Eco ";
                                          echo $transaction->transfer_amount;
                                    ?>
                                </h2>
                            </div>
                            <?php endforeach; ?> -->
                            
                        </div>
                        <div class="main-right-bottom-three-right">
                            <div class="main-right-bottom-three-right-left">
                                <h1>Requests Satisfied</h1>
                                <div class="main-right-bottom-three-right-cont">
                                    <div class="circular-progress">
                                        <span class="progress-value">
                                            0 %
                                        </span>
                                    </div>
                                </div>
                                <button onclick="redirect_requests()">
                                    Request Now
                                </button>
                            </div>
                            <div class="main-right-bottom-three-right-right">
                                <h1>Centers</h1>
                                <div class="map" id="map"></div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            
            <!-- <div class="main-right">
                <div class="main-right-left">
                    <div class="main-right-left-one">
                        <div class="main-right-left-one-text">
                            <div class="change">Welcome back</div> Eco plus
                        </div>
                        <div class="main-right-left-one-right">
                            <img src="<?php echo IMGROOT?>/Search.png" alt="">
                            <input type="text" placeholder="Search Anything">
                            <img src="<?php echo IMGROOT?>/notifications.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-left-two">
                        <a href="<?php echo URLROOT?>/centermanagers/collectors" class="main-right-left-two-a">
                            <div class="main-right-left-two-component" style="background-image: url('<?php echo IMGROOT?>/Dashboard1.png');">
                                <h1>Collectors</h1>
                                <img src="<?php echo IMGROOT?>/Collector.png" alt="">
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers" class="main-right-left-two-a">
                            <div class="main-right-left-two-component" style="background-image: url('<?php echo IMGROOT?>/Dashboard2.png');">
                                <h1>Center Workers</h1>
                                <img src="<?php echo IMGROOT?>/Center_Workers.png" alt="">
                            </div>
                        </a>
                    </div> 
                    <div class="main-right-left-three">
                        <div class="main-right-left-three-content">
                            <div class="main-right-left-three-content-left">
                                <img src="<?php echo IMGROOT?>/Center_Img.png" alt="">
                                <h1><?php echo $data['center_name']?></h1>
                                <h4>Center ID: CEN <?php echo $data['center_id']?></h3>
                            </div>
                            <div class="main-right-left-three-content-right">
                                <button>Incoming Requests</button>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="main-right-right">
                    <div class="main-right-right-top">
                        <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
                        <h2><?php echo $_SESSION['center_manager_name']?></h2>
                        <p>Center Manager ID: CM <?php echo $_SESSION['center_manager_id']?></p>
                        <button>Profile</button>
                    </div>
                    <div class="main-right-right-bottom">
                        <img src="<?php echo IMGROOT?>/Dashboard-Man.jpg" alt="">
                    </div>
                </div>
            </div> -->
        </div>
    </div>
 </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
