<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Agent_Main">
    <div class="Discount_Agent">
        <div class="Discount_Agent_Discount">
            <div class="main">
                <?php require APPROOT . '/views/credit_discount_agents/agent_sidebar/side_bar.php'; ?>
                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search" style="visibility:hidden">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>
                            <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
                                <i class='bx bx-bell'></i>
                                <div class="dot"></div>
                            </div>

                            <div class="main-right-top-profile">
                                <img src="<?php echo IMGROOT?>/img_upload/credit_discount_agent/<?php echo $_SESSION['agent_profile']?>"
                                    alt="">
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
                                    <div class="line1"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="main-bottom-down">
                        <form action="<?php echo URLROOT;?>/CreditDiscountsAgent/balance_validation" method="post">
                            <h1>Discount</h1>

                            <label for="customer_id">Customer ID:</label>
                            <input value="<?php echo $data['customer_id']; ?>" type="text" name="customer_id">
                            <div class="err"><?php echo $data['customer_id_err']; ?></div>

                            <label for="customer_id">Discount:</label>
                            <input value="<?php echo $data['discount_amount']; ?>" type="text" name="discount_amount">
                            <div class="err"><?php echo $data['discount_amount_err']; ?></div>

                            <label for="customer_id">Center:</label>
                            <input value="<?php echo $data['center']; ?>" type="text" name="center">
                            <div class="err"><?php echo $data['center_err']; ?></div>

                            <button type="submit">Validate</button>
                        </form>

                    </div>
                </div>

                <script src="<?php echo JSROOT?>/Admin_Center_Manager.js"> </script>
            </div>
        </div>



    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>