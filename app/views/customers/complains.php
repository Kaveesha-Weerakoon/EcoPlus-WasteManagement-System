<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Complains">

        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>
                    <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>

                </div>
                <div class="main-bottom">
                    <div class="main-bottom-component">
                        <form class="main-bottom-component-left" action="<?php echo URLROOT;?>/customers/complains"
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
                                <h2>Region</h2>
                                <input value="<?php echo $data['region']?>" name="region" id="region" type=" text"
                                    readonly>

                                <div class="err"><?php echo $data['region_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Req ID</h2>
                                <input value="<?php echo $data['subject']; ?>" name="subject" type="text"
                                    placeholder="None / Req Id">
                                <div class="err"><?php echo $data['subject_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Complaint</h2>
                                <input value="<?php echo $data['complain']; ?>" name="complain" type="text"
                                    placeholder="Complain">
                                <div class="err"><?php echo $data['complain_err']; ?></div>
                            </div>
                            <div class="main-bottom-component-left-component">
                                <h2>Complaint Title</h2>
                                <input value="<?php echo $data['complain_title']; ?>" name="complain_title" type="text"
                                    placeholder="Complain">
                                <div class="err"><?php echo $data['complain_title_err']; ?></div>
                            </div>
                            <div class="main-bottom-component-left-component">
                                <h2>Complaint Body</h2>
                                <input value="<?php echo $data['complain_body']; ?>" name="complain_body" type="text"
                                    placeholder="Complain">
                                <div class="err"><?php echo $data['complain_body_err']; ?></div>
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
                <?php if($data['completed']=='True') : ?>
                <div class="complain_success" style="">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Complaint has been reported successfully</p>
                        <a href="<?php echo URLROOT?>/customers/history_complains"><button type="button">OK</button></a>


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
    var dynamicUrl = "<?php echo URLROOT;?>/customers/view_notification/complains";
    form.action = dynamicUrl; // Set the action URL
    form.submit(); // Submit the form

};
/* ----------------- */
/*animation*/
document.addEventListener("DOMContentLoaded", function() {
    var mainRightBottomContent = document.querySelector('.main-bottom-component');

    function checkSlide() {
        var elementTop = mainRightBottomContent.getBoundingClientRect().top;
        var isHalfShown = elementTop < window.innerHeight;
        var isNotScrolledPast = window.scrollY < elementTop + mainRightBottomContent.clientHeight;

        if (isHalfShown && isNotScrolledPast) {
            mainRightBottomContent.classList.add('slide-in');
        } else {
            mainRightBottomContent.classList.remove('slide-in');
        }
    }

    window.addEventListener('scroll', checkSlide);
    checkSlide(); // Trigger once on page load
});
/* ----------------- */
</script>
<script src="<?php echo JSROOT?>/Customer.js"> </script>

<?php require APPROOT . '/views/inc/footer.php'; ?>