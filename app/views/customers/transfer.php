<?php require APPROOT . '/views/inc/header.php'; ?>
 <div class="Customer-Transfer">
    <div class="main">
            <div class="main-top">
                <a href="<?php echo URLROOT?>/customers">
                    <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                </a>

                <div class="main-top-component">
                    <p>Ananda Perera</p>
                    <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                </div>
            </div>
            <div class="main-bottom">
                <div class="main-bottom-left">
                    <form class="main-bottom-left-component">
                        <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                        <h2>Transfer your Eco-credits</h2>
                        <div class="line"></div>
                        <div class="main-bottom-left-component-component">
                            <p>Customer ID (for transfer):</p>
                            <input type="text">
                        </div>
                        <div class="main-bottom-left-component-component">
                            <p>Credit Amount:</p>
                            <input type="text">
                        </div>
                        <button>Transfer</button>
                    </form>
                </div>
                <div class="main-bottom-right"><img src="../../src/Transfer_Credit.png" alt=""></div>
            </div>
     </div>
 </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
