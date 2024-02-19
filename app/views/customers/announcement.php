<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Annoucement">


        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" placeholder="Search">
                        </div>
                        <div class="main-right-top-notification" id="notification">
                            <i class='bx bx-bell'></i>
                            <?php if (!empty($data['notification'])) : ?>
                            <div class="dot"><?php echo count($data['notification'])?></div>
                            <?php endif; ?>
                        </div>
                        <div id="notification_popup" class="notification_popup">
                            <h1>Notifications</h1>
                            <div class="notification_cont">
                                <?php foreach($data['notification'] as $notification) : ?>

                                <div class="notification">
                                    <div class="notification-green-dot">

                                    </div>
                                    <div class="notification_right">
                                        <p><?php echo date('Y-m-d', strtotime($notification->datetime)); ?></p>
                                        <?php echo $notification->notification ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            </div>
                            <form class="mark_as_read" method="post"
                                action="<?php echo URLROOT;?>/customers/view_notification/garbage_types">
                                <i class="fa-solid fa-check"> </i>
                                <button type="submit">Mark all as read</button>
                            </form>

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
});
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>