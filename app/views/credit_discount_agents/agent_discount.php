<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Agent_Main">
    <div class="Discount_Agent">
        <div class="Discount_Agent_Discount">
            <div class="main">
                <?php require APPROOT . '/views/credit_discount_agents/agent_sidebar/side_bar.php'; ?>
                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <?php require APPROOT . '/views/credit_discount_agents/agent_profile/agent_profile.php'; ?>

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

                            <label for="customer_id">Branch:</label>
                            <input value="<?php echo $data['center']; ?>" type="text" name="center">
                            <div class="err"><?php echo $data['center_err']; ?></div>

                            <button type="submit">Validate</button>
                        </form>

                    </div>
                </div>

                <script src="<?php echo JSROOT?>/Admin_Center_Manager.js"> </script>
            </div>
            <?php if($data['success']=='True') : ?>
            <div class="request_success">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Discount Given</p>
                    <a href="<?php echo URLROOT?>/CreditDiscountsAgent/balance_validation"><button
                            type="button">OK</button></a>
                </div>
            </div>
            <?php echo $data['success'];?>
            <?php endif; ?>
        </div>



    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>