<div class="main-right-top">

    <div class="main-right-top-one">
        <div class="main-right-top-search">
            <i class='bx bx-search-alt-2'></i>
            <input id="complaintSearch" type="text" placeholder="Search">
        </div>
        <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>

    </div>
    <div class="main-right-top-two">
        <h1>History</h1>
    </div>
    <div class="main-right-top-three">
        <a href="<?php echo URLROOT?>/customers/history" id="discounts">
            <div class="main-right-top-three-content">
                <p>Discounts</p>
                <div class="line1"></div>
            </div>
        </a>

        <a href="<?php echo URLROOT?>/customers/history_complains">
            <div class="main-right-top-three-content" id="complain">
                <p>Complaints</p>
                <div class="line1"></div>
            </div>
        </a>
        <a href="<?php echo URLROOT?>/customers/transfer_history" id="transfer">
            <div class="main-right-top-three-content">
                <p>Transfer</p>
                <div class="line1"></div>
            </div>
        </a>
    </div>
</div>

<script>
/*animation*/
document.addEventListener("DOMContentLoaded", function() {
    var mainRightBottomContent = document.querySelector('.main-right-bottom-two-content');

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