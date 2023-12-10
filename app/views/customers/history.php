<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_History_Top">
        <div class="Customer_Main_History">
            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-one-search">
                                <img src="<?php echo IMGROOT?>/Search.png" alt="">
                                <input type="text" placeholder="Search">
                            </div>

                            <div class="main-right-top-one-content">
                                <p><?php echo $_SESSION['user_name']?></p>
                                <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                                    alt="">
                            </div>
                        </div>
                        <div class="main-right-top-two">
                            <h1>History</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/customers/history">
                                <div class="main-right-top-three-content">
                                    <p><b style="color: #1B6652;">Discounts</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/customers/history_complains">
                                <div class="main-right-top-three-content">
                                    <p>Complaints</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/customers/transfer_history">
                                <div class="main-right-top-three-content">
                                    <p>Transfer</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="main-right-bottom">
                        <div class="main-right-bottom-two">
                            <div class="main-right-bottom-two-content">
                                <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                                <h1>You Have No Disccounts On Supermarkets</h1>
                                <p></p>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>