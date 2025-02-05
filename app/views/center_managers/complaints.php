<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Complaints">

        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>
                    <?php require APPROOT . '/views/center_managers/centermanager_notifications/centermanager_notifications.php'; ?>
                    
                </div>
                <div class="main-bottom">
                    <div class="main-bottom-component">
                        <form class="main-bottom-component-left" action="<?php echo URLROOT;?>/centermanagers/complaints"
                            method="post">
                            <div class="main-bottom-component-left-topic">
                                <h2>Make a Complaint</h2>
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
                                <h2>Subject</h2>
                                <input value="<?php echo $data['subject']; ?>" name="subject" type="text"
                                    placeholder="Subject">
                                <div class="err"><?php echo $data['subject_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component A">
                                <h2>Complaint</h2>
                                <input value="<?php echo $data['complaint']; ?>" name="complaint" type="text"
                                    placeholder="Complaint">
                                <div class="err"><?php echo $data['complaint_err']; ?></div>
                            </div>
                            <div class="main-bottom-component-left-button">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                        <div class="main-bottom-component-right">
                            <img src="<?php echo IMGROOT?>/makeComplaints.png" alt="" />
                        </div>

                    </div>
                </div>
                <?php if($data['completed']=='True') : ?>
                <div class="complain_success">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Complaint has been reported successfully</p>
                        <a href="<?php echo URLROOT?>/centermanagers/complaints"><button type="button">OK</button></a>


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
        var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/complaints";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>