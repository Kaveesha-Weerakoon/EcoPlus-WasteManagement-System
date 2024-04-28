<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_Complains">
        <div class="main">
            <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search" style="visibility:hidden">
                        <i class='bx bxl-sketch'></i> <input type="text" placeholder="Welcome Back !" id="searchInput"
                            readonly oninput="highlightMatchingText()">
                    </div>
                    <?php require APPROOT . '/views/collectors/collector_notification/collector_notification.php'; ?>
                </div>
                <div class="main-bottom">
                    <div class="main-bottom-top">
                        <h2>Complaints</h2>
                        <div class="main-bottom-top-cont">
                            <a href="">
                                <div class="main-bottom-top-content">
                                    <p><b style="color:#1ca557;">Complaint</b></p>
                                    <div class="line2"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/collectors/complains_history">
                                <div class="main-bottom-top-content">
                                    <p>History</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="main-bottom-down">
                        <div class="main-bottom-component">
                            <form class="main-bottom-component-left" action="<?php echo URLROOT;?>/collectors/complains"
                                method="post">
                                <div class="main-bottom-component-left-topic">
                                    <h2>Make a Complaint</h2>
                                    <div class="line"></div>
                                </div>

                                <div class="main-bottom-component-left-component">
                                    <h2>Name</h2>
                                    <input value="<?php echo $data['name']; ?>" type="text" name="name"
                                        placeholder="Name">
                                    <div class="err"><?php echo $data['name_err']; ?></div>
                                </div>

                                <div class="main-bottom-component-left-component">
                                    <h2>Contact Number</h2>
                                    <input value="<?php echo $data['contact_no']; ?>" name="contact_no" type="text"
                                        placeholder="Contact Number">
                                    <div class="err"><?php echo $data['contact_no_err']; ?></div>
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
                                    <button type="submit">Submit</button>
                                </div>
                            </form>
                            <!-- <div class="main-bottom-component-right">
                                <img src="<?php echo IMGROOT?>/makeComplaints.png" alt="" />
                            </div> -->

                        </div>
                    </div>


                </div>
                <?php if($data['completed']=='True') : ?>
                <div class="complain_success" style="">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Complain has been reported successfully</p>
                        <a href="<?php echo URLROOT?>/collectors/history_complains"><button
                                type="button">OK</button></a>


                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div>

<script>
                    /* Notification View */
                document.getElementById('submit-notification').onclick = function() {
                    var form = document.getElementById('mark_as_read');
                    var dynamicUrl = "<?php echo URLROOT;?>/collectors/view_notification/complains";
                    form.action = dynamicUrl; // Set the action URL
                    form.submit(); // Submit the form

                };
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>