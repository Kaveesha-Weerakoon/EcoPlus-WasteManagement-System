<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="Collector_Main" >
  <div class="Collector_Dashboard" >
     <div class="main" >
            <div class="main-left" style="background: #8CF889;">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>

                <div class="main-left-middle">
                    <a href="<?php echo IMGROOT?>/Collector_DashBoard.html">
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Home.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/collectors/collector_assistants">
                        <div class="main-left-middle-content Collector">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/CollectorAssis.png" alt="">
                            <h2>Collector Assistants</h2>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>

                </div>             
                <div class="main-left-bottom">
                  <a href="<?php echo URLROOT?>/collectors/logout">
                    <div class="main-left-bottom-content">
                        <img src="<?php echo IMGROOT?>/logout.png" alt="">
                        <p>Log out</p>
                    </div>
                  </a>
                </div>
            </div>
            <div class="main-right">
                <div class="main-right-left">
                    <div class="main-right-left-one">
                        <div class="main-right-left-one-text">
                            <div class="change">Welcome back</div> Eco plus
                        </div>
                        <div class="main-right-left-one-right">
                            <img src="<?php echo IMGROOT?>/Search.png" alt="">
                            <input type="text" placeholder="Search Any thing">
                            <img src="<?php echo IMGROOT?>/notifications.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-left-two">
                        <img src="<?php echo IMGROOT?>/Collector_Dashboard.png" alt="">
                        <div class="main-right-left-two-component">
                            <h1>Welcome to Collector Portal</h1>
                            <a href=""><button>Assigned
                                    Requests</button></a>
                        </div>

                    </div>
                    <div class="main-right-left-three">
                        <h1>Credits per Waste Quantity</h1>
                        <div class="main-right-left-three-main">
                            <div class="main-right-left-three-component">
                                <img src="<?php echo IMGROOT?>/Polythene.png" alt="">
                                <h2>Polythene</h2>
                                <h3><?php echo $data['eco_credit_per']->polythene ?></h3>
                            </div>
                            <div class="main-right-left-three-component">
                                <img src="<?php echo IMGROOT?>/Plastic.png" alt="">
                                <h2>Plastic</h2>
                                <h3><?php echo $data['eco_credit_per']->plastic?></h3>
                            </div>
                            <div class="main-right-left-three-component">
                                <img src="<?php echo IMGROOT?>/Glass.png" alt="">
                                <h2>Glass</h2>
                                <h3><?php echo $data['eco_credit_per']->glass?></h3>
                            </div>
                            <div class="main-right-left-three-component">
                                <img src="<?php echo IMGROOT?>/paper.png" alt="">
                                <h2>Paper Waste</h2>
                                <h3><?php echo $data['eco_credit_per']->paper ?></h3>
                            </div>
                            <div class="main-right-left-three-component">
                                <img src="<?php echo IMGROOT?>/Electronic_Waste.png" alt="">
                                <h2>Electronic Waste</h2>
                                <h3><?php echo $data['eco_credit_per']->electronic ?></h3>
                            </div>
                            <div class="main-right-left-three-component">
                                <img src="<?php echo IMGROOT?>/Metal.png" alt="">
                                <h2>Metals</h2>
                                <h3><?php echo $data['eco_credit_per']->metal ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-right-right">
                    <div class="main-right-right-top">

                        <img src="<?php echo IMGROOT?>/CustomerDashboard_image.png" alt="">
                        <h2><?php echo $_SESSION['collector_name']?></h2>
                        <p>Collector ID: <?php echo $_SESSION['collector_id']?></p>

                        <button id="Profile">Profile</button>
                        <a href="<?php echo URLROOT?>/collectors/complains"><button>Complaints</button></a>
                    </div>
                    <div class="main-right-right-bottom">
                        <img src="<?php echo IMGROOT?>/Collector_Dashboard3.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="Pop" id="Popup">
                <div id="Profile_Pop" class="Profile">
                    <div class="profile-top">
                        <div class="profile-top-left"></div>
                        <img src="../../src/Close.png" id="Profile_close">
                    </div>
                    <div class="profile-down">
                        <div class="profile-down-top-content">
                            <img src="../../src/Profile2.png" alt="">
                            <h1 style="font-size: 29px;">Ananda Perera</h1>
                        </div>

                        <div class="profile-down-content">
                            <p>Name</p>
                            <input type="text" value="Ananda Perera">
                        </div>
                        <div class="profile-down-content">
                            <p>Collector ID</p>
                            <input type="text" value="C234567">
                        </div>

                        <div class="profile-down-content">
                            <p>Email</p>
                            <input type="text" value="AnandaPerera@gmail.com">
                        </div>
                        <div class="profile-down-content">
                            <p>Contact No</p>
                            <input type="text" value="0771231232">
                        </div>
                        <div class="profile-down-content">
                            <p>Address</p>
                            <input type="text" value="172, colombo, sri Lanka">
                        </div>
                        <div class="profile-down-content">
                            <p>City</p>
                            <input type="text" value="Homagama">
                        </div>


                    </div>
                </div>
            </div>
             <script src="Collector_Dashboard.js"></script> 
           </div>
   </div>

  </div>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>
