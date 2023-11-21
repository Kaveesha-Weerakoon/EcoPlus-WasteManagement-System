<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Transfercredit">

    <div class="main">
      <div class="main-top">
      <a href="<?php echo URLROOT?>/customers">
          <img class="back_button" src="<?php echo IMGROOT?>/Back.png" alt="" />
        </a>

        <div class="main-top-component">
          <p><?php echo $_SESSION['user_name']?></p>
          <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="" />
        </div>
      </div>
      <div class="main-bottom">
        <div class="main-bottom-component" >
          <form class="main-bottom-component-left" action="<?php echo URLROOT;?>/customers/transfer" method="post">
            <div class="main-bottom-component-left-topic">
              <h2>Transfer your Eco-credits</h2>
              <div class="line"></div>
            </div>

            <div class="main-bottom-component-left-component">
                <p>Customer ID (for transfer):</p>
                <input value="<?php echo $data['customer_id']; ?>" type="text" name="customer_id"  >
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
    </div>
 
    <?php if($data['completed']=='True') : ?>
            <div class="credit_transfer_success">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>credit_transfer_successfully</p>
                    <a href="<?php echo URLROOT?>/customers/transfer"><button type="button" >OK</button></a>

                </div>
            </div>
        <?php endif; ?>

</div>
  

<?php require APPROOT . '/views/inc/footer.php'; ?>
