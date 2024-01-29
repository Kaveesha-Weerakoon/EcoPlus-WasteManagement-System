<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Agent_Main">
    <div class="Discount_Agent">
        <div class="Discount_Agent_ValidateUser">
            <div class="main">
             <?php require APPROOT . '/views/credit_discount_agents/agent_sidebar/side_bar.php'; ?>
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
                            <img src="<?php echo IMGROOT?>/img_upload/credit_discount_agent/<?php echo $_SESSION['agent_profile']?>" alt="">
                                <div class="main-right-top-profile-cont">
                                <h3><?php echo $_SESSION['agent_name']?></h3>
                                <p>ID : D <?php echo $_SESSION['agent_id']?></p>
                                </div>
                            </div>
                        </div>
                        <div class="main-right-top-two">
                            <h1>Credit Discount Agent</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/CreditDiscountsAgent/validateUser">
                                <div class="main-right-top-three-content">
                                    <p>Validate User</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/CreditDiscountsAgent/balance_validation">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;"> Discount</b></p>
                                    <div class="line"  style="background-color: #1ca557;"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="main-bottom-down">         
                    <form action="?action=validateUser" method="POST">
                        <h1>Validate User</h1>
                        <label for="customer_id">Customer ID:</label>
                        <input type="text" name="customer_id" required>
                        <button type="submit">Validate</button>
                    </form>

                    </div>
                </div>
                    
                    <script src="<?php echo JSROOT?>/Admin_Center_Manager.js"> </script>        
            </div>
        </div>

        <?php if($data['registered']=='True') : ?>
        <div class="center_manager_success">
        <div class="popup" id="popup">
            <img src="<?php echo IMGROOT?>/check.png" alt="">
            <h2>Success!!</h2>
            <p>Discount Agent has been registered successfully</p>
            <a href="<?php echo URLROOT?>/admin/discount_agents"><button type="button" >OK</button></a>

        </div>
        </div>
        <?php endif; ?>
    
    </div> 
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>