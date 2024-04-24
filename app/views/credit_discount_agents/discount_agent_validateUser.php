<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Agent_Main">
    <div class="Discount_Agent">
        <div class="Discount_Agent_ValidateUser">
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
                                    <p><b style="color:#1ca557;">Validate User</b></p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/CreditDiscountsAgent/balance_validation">
                                <div class="main-right-top-three-content">
                                    <p> Discount</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="main-bottom-down">
                        <form action="<?php echo URLROOT;?>/CreditDiscountsAgent/validateUser" method="POST">
                            <h1>Validate User</h1>

                            <label for="customer_id">Customer ID:</label>
                            <input value="<?php echo $data['customer_id']; ?>" type="text" name="customer_id">
                            <div class="err"><?php echo $data['customer_id_err']; ?></div>
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