<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Announcements_View">
    <div class="main">
        <header class="header">
            <nav class="nav">
                <a href="#" class="logo"><img src="<?php echo IMGROOT;?>/Logo_No_Background.png" alt=""></a>

                <div class="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                </div>

                <div class="nav__link hide">
                <a href="index/#home">Home</a>
                <a href="index/#services">Services</a>
                <a href="index/#aboutUs">About Us</a>
                <a href="index/#announcements">Announcements</a>
                <a href="index/#contact">Contact</a>
                <button class="signin-button" onclick="redirectLogin()">Sign In</button>
                </div>
            </nav>
        </header>

        <section class="announcement-section" id="announcements">
            <div class="text-wrapper">Announcements</div>
            <div class="cards-section">
                <?php foreach ($data['announcements'] as $announcement):?>
                <div class="Announcement-cont">
                <div class="left slide-top">
                    <h2> <?php echo $announcement->header ?></h2>
                    <p><?php echo $announcement->date ?></p>
                    <img src="<?php echo IMGROOT . '/img_upload/Annoucement/' . $announcement->img; ?>"
                                alt="logo">
                </div>
                <div class="right ">
                    <div class="cont slide-top">
                        <p>
                            <?php echo $announcement->text ?>
                        </p>
                    </div>
                </div>
                </div>
                <?php endforeach?>
              
                
            </div>


    </div>
    <script>
        function redirectLogin() {
            var linkUrl = "<?php echo URLROOT?>/users/login";
            window.location.href = linkUrl;
        }
    </script>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>