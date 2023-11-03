<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer-credits-per-waste">
   <div class="main">
            <div class="main-top">
                <a href="<?php echo URLROOT ?>/customers">
                    <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                </a>

                <div class="main-top-component">
                    <p>Ananda Perera</p>
                    <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                </div>
            </div>
            <div class="main-bottom" style="background:white">
                <img class="logo" src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                <h1>Credits Per Waste Quantity</h1>
                <div class="main-bottom-line"></div>
                <div class="main-bottom-bottom">
                    <div class="main-bottom-bottom-top">
                        <div class="main-bottom-content" style="background: #DFFFD3;">
                            <img src="<?php echo IMGROOT?>/Polythene3.png" alt="">
                            <h4>Polythene</h4>
                            <h6><?php echo $data['eco_credit_per']->polythene?> Credits per 1kg</h6>
                        </div>
                        <div class="main-bottom-content" style="background: #DFFFD3;">
                            <img src="<?php echo IMGROOT?>/Plastic.png" alt="">
                            <h4>Plastic</h4>
                            <h6><?php echo $data['eco_credit_per']->plastic?> Credits per 1kg</h6>
                        </div>
                        <div class="main-bottom-content" style="background: #DFFFD3;">
                            <img src="<?php echo IMGROOT?>/Glass.png" alt="">
                            <h4>Glass</h4>
                            <h6><?php echo $data['eco_credit_per']->glass?> Credits per 1kg</h6>
                        </div>
                        <div class="main-bottom-content" style="background: #DFFFD3;">
                            <img src="<?php echo IMGROOT?>/paper.png" alt="">
                            <h4>Paper</h4>
                            <h6><?php echo $data['eco_credit_per']->paper?> Credits per 1kg</h6>
                        </div>

                    </div>
                    <div class="main-bottom-bottom-bottom">
                    <div class="main-bottom-content" style="background: #DFFFD3;">
                            <img src="<?php echo IMGROOT?>/Electronic_Waste.png" alt="">
                            <h4>Electronic Waste</h4>
                            <h6><?php echo $data['eco_credit_per']->electronic?> Credits per 1kg</h6>
                        </div>
                        <div class="main-bottom-content" style="background: #DFFFD3;">
                            <img src="<?php echo IMGROOT?>/Metal.png" alt="">
                            <h4>Metal</h4>
                            <h6><?php echo $data['eco_credit_per']->metal?> Credits per 1kg</h6>
                        </div>
                        <img class="image2" src="<?php echo IMGROOT?>/Credit_Per_Waste.png" alt="">
                    </div>
                </div>
            </div>
    </div>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
