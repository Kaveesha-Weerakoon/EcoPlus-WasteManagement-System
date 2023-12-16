<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Complains">

        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-top">
                    <a href="<?php echo URLROOT?>/customers">
                        <img class="back_button" src="<?php echo IMGROOT?>/Back.png" alt="" />
                    </a>

                    <div class="main-top-component">
                        <p><?php echo $_SESSION['user_name']?></p>
                        <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                            alt="">
                    </div>
                </div>
                <div class="main-bottom">
                    <div class="main-bottom-component">
                        <form class="main-bottom-component-left" action="<?php echo URLROOT;?>/customers/complains"
                            method="post">
                            <div class="main-bottom-component-left-topic">
                                <h2>Make a Complain</h2>
                                <div class="line"></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Name</h2>
                                <input value="<?php echo $data['name']; ?>" type="text" name="name" placeholder="Name">
                                <div class="err"><?php echo $data['name_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Contact Number</h2>
                                <input value="<?php echo $data['contact_no']; ?>" name="contact_no" type="text"
                                    placeholder="Contact Number">
                                <div class="err"><?php echo $data['contact_no_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Region</h2>
                                <input type="text" value="<?php echo $data['region']; ?>" name="region"
                                    placeholder="Region">
                                <div class="err"><?php echo $data['region_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Subject</h2>
                                <input value="<?php echo $data['subject']; ?>" name="subject" type="text"
                                    placeholder="Subject">
                                <div class="err"><?php echo $data['subject_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Complain</h2>
                                <input value="<?php echo $data['complain']; ?>" name="complain" type="text"
                                    placeholder="Complain">
                                <div class="err"><?php echo $data['complain_err']; ?></div>
                            </div>
                            <div class="main-bottom-component-left-button">
                                <button type="submit">Make Complain</button>
                            </div>
                        </form>
                        <div class="main-bottom-component-right">
                            <img src="<?php echo IMGROOT?>/makeComplaints.png" alt="" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php if($data['completed']=='True') : ?>
        <div class="center_worker_success">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/check.png" alt="">
                <h2>Success!!</h2>
                <p>Complain has been reported successfully</p>
                <a href="<?php echo URLROOT?>/customers/history_complains"><button type="button">OK</button></a>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>