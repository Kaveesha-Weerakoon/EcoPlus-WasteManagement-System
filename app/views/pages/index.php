<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Home-main">
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
                <a href="#home">Home</a>
                <a href="#services">Services</a>
                <a href="#aboutUs">About Us</a>
                <a href="#announcements">Announcements</a>
                <a href="#contact">Contact</a>
                <button class="signin-button" onclick="redirectLogin()">Sign In</button>
                </div>
            </nav>
        </header>

        <!-- hero banner  section -->
        <section class="header-section" id="home">
            <div class="header-content">
                <div class="title-subtitle">
                <div class="text-wrapper">Dispose | Recycle | Eco-Rewards</div>
                <div class="div">Recycle Responsibly, Reap Rewards!</div>
                <p class="this-is-a-template">
                    Dispose responsibly, recycle efficiently, and earn Eco-rewards with <br> 
                    <b>Eco Plus</b> your sustainable waste management solution.
                </p>
                </div>
                
                <div class="button">
                    <div class="text-wrapper-2" onclick="redirectSignUp()" >Join Now</div>
                </div>
                
            </div>
            <img class="headerimage" src="<?php echo IMGROOT;?>/home1.jpg" alt="" />
        </section>

        <!-- services section -->
        <section class="services-section" id="services">
            <div class="text-wrapper">Our Services</div>
            <div class="cards-section">
                <div class="services-card">
                    <img
                        class="services-card-icon"
                        src="<?php echo IMGROOT;?>/bin.png"
                        alt=""
                    />
                    <div class="title-description">
                        <div class="title">Garbage Collection</div>
                        <p class="text-wrapper-2">
                        Conveniently request non-biodegradable waste collection. We'll pick up your trash hassle-free
                        </p>
                    </div>
                </div>
                <div class="services-card">
                    <img 
                        class="services-card-icon" 
                        src="<?php echo IMGROOT;?>/recycling.png" 
                        alt="" 
                    />
                    <div class="title-description">
                        <div class="title">Recycling Solutions</div>
                        <p class="text-wrapper-2">
                        Release waste to recycling parties and companies, Transforming waste into valuable resources
                        </p>
                    </div>
                </div>
                <div class="services-card">
                    <img
                        class="services-card-icon"
                        src="<?php echo IMGROOT;?>/award.png"
                        alt=""
                    />
                    <div class="title-description">
                        <div class="title">Earn Eco-Rewards</div>
                        <p class="text-wrapper-2">
                        Earn eco-credits for your waste contributions and enjoy discounts on bills and purchases
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About us Section -->
        <section class="about-us-section" id="aboutUs">
            <div class="text-wrapper">About Us</div>
            <div class="about-us-container">
                <div class="about-us-content">
                <div class="title">Why you should choose us?</div>
                <ul class="about-us-content-list">
                    <li>Eco Plus offers region-based collection and recycling services for non-biodegradable garbage</li>
                    <li>Our system rewards customers with eco-credits, empowering them to save on bills and contribute to a cleaner environment</li>
                    <li>At Eco Plus, We partner with recycling parties to ensure that collected garbage is reused responsibly</li>
                    <li>Our team is promoting eco-friendly habits and making a positive impact on the planet through innovative waste solutions</li>
                    <li>Join us in our mission to create a greener future by choosing Eco Plus for your waste management needs</li>
                </ul>

                </div>
                <div class="about-us-image">
                    <img src="<?php echo IMGROOT?>/home2.jpg" alt="">
                </div>
            </div>
        
        </section>

        <!-- announcement section -->
        <section class="announcement-section" id="announcements">
            <div class="text-wrapper">Announcements</div>
            <div class="cards-section">
                <?php $count = 0;
                foreach ($data['announcements'] as $announcement):
                  if($count == 2) break;?>
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
                <?php
                  $count++;
                  endforeach?>
                <!-- <div class="Announcement-cont">
                <div class="left slide-top">
                    <h2>We are now in Kaluthara</h2>
                    <p>2024-03-26</p>
                    <img src="<?php echo IMGROOT;?>/img_upload/Annoucement/Colombo.jpg"
                        alt="logo">
                </div>
                <div class="right ">
                    <div class="cont slide-top">
                        <p>
                            We're thrilled to announce the grand opening of a brand new region right here in Kalutara!
                            Prepare to embark on a journey of discovery as we unveil this exciting addition to our town. 
                            Featuring stunning landscapes, vibrant communities, and endless opportunities, this new region
                            promises to captivate your senses and ignite your adventurous spirit. Join us in celebrating 
                            this momentous occasion and be among the first to explore the wonders of Kalutara's newest gem!
                            Get ready to write the next chapter of Kalutara's extraordinary story!
                        </p>
                    </div>
                </div>
                </div> -->
                
            </div>
            <div class="view-more-button">
                <button onclick= "redirectAnnouncements()" >View More -></button>
            </div>
        </section>

        <!-- contact section -->
        <section class="contact-section" id="contact">
            <h2 class="text-wrapper">Lets work together</h2>
            <div class="div">
                <!-- contact info -->
                <div class="contact-info">
                <div class="text-description">
                    <p class="p">
                    For any inquiries or assistance, feel free to reach out to us. 
                    Our team is ready to help you with your waste management needs and 
                    eco-friendly initiatives. Contact us today for a cleaner, greener tomorrow!
                    </p>
                </div>

                <!-- social links -->
                <div class="social-links">
                    <a href="#" title="whatsapp">
                    <img class="img" src="<?php echo IMGROOT;?>/whatsapp.png" alt="" />
                    </a>
                    <a href="#" title="facebook">
                    <img class="img" src="<?php echo IMGROOT;?>/facebook.png" alt="" />
                    </a>
                    <a href="#" title="instagram">
                    <img class="img" src="<?php echo IMGROOT;?>/instagram.png" alt="" />
                    </a>
                </div>
                </div>
                <!-- contact form -->
             
                <div class="contact-form"> 
                <form action="<?php echo URLROOT?>/pages/mail_subscriptions#contact" method="post">
                    <div class="input-fields">
                        <input type="text" class="input-field" name="name" placeholder="Name" value="<?php echo $data['name']?>"/>
                        <div class="err" ><?php echo $data['name_err']?></div>
                        <input type="text" class="input-field" name="email" placeholder="Email" value="<?php echo $data['email']?>"/>
                        <div class="err" ><?php echo $data['email_err']?></div>
                    </div>
                    <button class="button" type="submit"><span class="contact">Submit</span></button>

                </form>
                    
              
                </div>
                
                
            </div>
        </section>

        <!-- footer -->
        <footer class="footer">
            <hr />
            <p>@copyright 2025 | All right preserved by Eco Plus</p>
        </footer>

        <?php if($data['success']=='True') : ?>
            <div class="success">
                <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/check.png" alt="">
                <h2>Success!!</h2>
                <p>Mail Subscription recorded successfully</p>
                <a href="<?php echo URLROOT?>/pages/index"><button type="button" >OK</button></a>

                </div>
            </div>
        <?php endif; ?>



    </div>
    <script>
        
        const hamburger = document.querySelector(".hamburger");
        const navLink = document.querySelector(".nav__link");

        hamburger.addEventListener("click", () => {
        //console.log("Btn clicked");
        navLink.classList.toggle("hide");
        });


        navLink.addEventListener("click", () => {
            
            navLink.classList.add("hide");
        })

        function redirectLogin() {
            var linkUrl = "<?php echo URLROOT?>/users/login";
            window.location.href = linkUrl;
        }

        function redirectSignUp() {
            var linkUrl = "<?php echo URLROOT?>/users/register";
            window.location.href = linkUrl;
        }

        function redirectSignUp() {
            var linkUrl = "<?php echo URLROOT?>/users/register";
            window.location.href = linkUrl;
        }

        function redirectAnnouncements(){
            var linkUrl = "<?php echo URLROOT?>/pages/announcement_view";
            window.location.href = linkUrl;
        }

    </script>
   
</div>
<!-- <div class="Home-main">
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
</div> -->

<?php require APPROOT . '/views/inc/footer.php'; ?>