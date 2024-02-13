<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Home-main">
    <div class="main">
        <div class="main-top">
            <img src="<?php echo IMGROOT;?>/HomeLogo.png" alt="">
            <div class="set">
                <p id="Home">Home</p>
                <p>About Us</p>
                <p>Contact Us</p>
                <p>Policies</p>
                <button onclick="redirectLogin()">Sign In</button>
            </div>
        </div>
        <div class="main-bottom">
            <div class="main-bottom-left">
                <h1>WASTE RECYCLE</h1>
                <p>Recycle with us and earn Eco Credits Your ticket to eco-friendly rewards!</p>
                <button onclick="redirectSignUp()">Join Now</button>
            </div>
            <div class="main-bottom-right">
                <img id="changingImage" src="<?php echo IMGROOT;?>/home1.jpg" alt="">
            </div>
        </div>
    </div>
    <script>
    var images = ['<?php echo IMGROOT;?>/home2.jpg', '<?php echo IMGROOT;?>/home3.jpg',
        '<?php echo IMGROOT;?>/home1.jpg',
    ];
    var currentIndex = 0;
    var changingImage = document.getElementById('changingImage');

    function changeImage() {
        changingImage.style.opacity = '0';
        setTimeout(function() {
            changingImage.src = images[currentIndex];
            changingImage.style.opacity = '1';
            currentIndex = (currentIndex + 1) % images.length;
        }, 1100); // Wait for 1 second (opacity transition time) before changing the image
    }

    setInterval(changeImage, 2900);
    // Change the image every 3 seconds (3000 milliseconds)

    function redirectLogin() {
        var linkUrl = "<?php echo URLROOT?>/users/login";
        window.location.href = linkUrl;
    }

    function redirectSignUp() {
        var linkUrl = "<?php echo URLROOT?>/users/register";
        window.location.href = linkUrl;
    }
    </script>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>