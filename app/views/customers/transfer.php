<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">

    <div class="Customer_Transfercredit">

        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
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
                        <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3>Kaveesha</h3>
                            <p>ID : C <?php echo $_SESSION['user_id']?></p>
                        </div>
                    </div>
                </div>
                <div class="main-bottom">
                    <div class="main-bottom-component">
                        <form id="myForm" class="main-bottom-component-left"
                            action="<?php echo URLROOT;?>/customers/transfer" method="post">
                            <div class="main-bottom-component-left-topic">
                                <h2>Transfer your Eco-credits</h2>
                                <div class="line"></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <p>Customer ID (for transfer):</p>
                                <input value="<?php echo $data['customer_id']; ?>" type="text" name="customer_id">
                                <div class="err"><?php echo $data['customer_id_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <p>Credit Amount:</p>
                                <input value="<?php echo $data['credit_amount']; ?>" type="text" name="credit_amount">
                                <div class="err"><?php echo $data['credit_amount_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-button">
                                <button type="submit">Transfer</button>
                            </div>
                        </form>

                        <div class="main-bottom-component-right">
                            <img src="<?php echo IMGROOT?>/moneyTransfer.jpg" alt="" />
                        </div>
                    </div>
                </div>
                <?php if($data['completed']=='True') : ?>
                <div class="credit_transfer_success">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Credit Transferd Successfully</p>
                        <a href="<?php echo URLROOT?>/customers/transfer_history"><button type="button">OK</button></a>

                    </div>
                </div>

            </div>
            <?php endif; ?>
            <?php if($data['transfer_confirm']=='True') : ?>
            <div class="delete_confirm" id="cancel_confirm">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                    <h2>Transfer Confirmation</h2>
                    <p>This action will Transfer <?php echo $data['credit_amount']?> credit from your account</p>
                    <div class="btns">
                        <a id="cancelLink"><button type="button" class="deletebtn"
                                onclick="submitForm()">Confirm</button></a>
                        <a href="<?php echo URLROOT;?>/customers/transfer"><button type="button"
                                class="cancelbtn">Cancel</button></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>


        </div>
    </div>

    <script>
    function submitForm() {
        var form = document.getElementById('myForm');
        form.action = "<?php echo URLROOT;?>/customers/transfer_complete";
        form.method = 'post';
        form.submit();
    }
    </script>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>