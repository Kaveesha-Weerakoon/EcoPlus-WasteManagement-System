<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Annoucement">


        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">

                        <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>

                    </div>
                    <div class="main-right-top-two">
                        <h1>Announcements</h1>
                    </div>
                    <div class="main-right-top-three">
                        <h4>Explore Our Latest Announcements Here!</h4>
                    </div>
                </div>

                <div class="main-right-bottom">
                    <?php foreach ($data['annoucements'] as $announcement): ?>
                    <div class="cont">
                        <div class="left slide-top">
                            <h2><?php echo $announcement->header; ?></h2>
                            <p><?php echo $announcement->date; ?></p>
                            <img src="<?php echo IMGROOT . '/img_upload/Annoucement/' . $announcement->img; ?>"
                                alt="logo">
                        </div>
                        <div class="right ">
                            <div class="cont slide-top">
                                <p><?php echo $announcement->text ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>



                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.querySelectorAll('.slide-top');

    function checkSlide() {
        elements.forEach(function(element) {
            var containerScrollTop = document.querySelector('.main-right-bottom').scrollTop;
            var slideInAt = containerScrollTop + window.innerHeight - element.clientHeight / 2;
            var elementTop = element.getBoundingClientRect().top + containerScrollTop;
            var elementHeight = element.clientHeight;
            var isHalfShown = elementTop + elementHeight / 2 < containerScrollTop + window.innerHeight;
            var isNotScrolledPast = containerScrollTop < elementTop + elementHeight;

            // Add class for slide-in animation if element is half shown and not scrolled past
            if (isHalfShown && isNotScrolledPast) {
                element.classList.add('slide-in');
            } else {
                element.classList.remove('slide-in');
            }

            // Add class for slide-out animation if element is scrolled past
            if (!isHalfShown || !isNotScrolledPast) {
                element.classList.add('slide-out');
            } else {
                element.classList.remove('slide-out');
            }
        });
    }

    var container = document.querySelector('.main-right-bottom');
    container.addEventListener('scroll', checkSlide);

    // Trigger checkSlide once after DOM content has loaded
    checkSlide();
}); /* Notification View */
document.getElementById('submit-notification').onclick = function() {
    var form = document.getElementById('mark_as_read');
    var dynamicUrl = "<?php echo URLROOT;?>/customers/view_notification/announcements";
    form.action = dynamicUrl; // Set the action URL
    form.submit(); // Submit the form

};
/* ----------------- */
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>