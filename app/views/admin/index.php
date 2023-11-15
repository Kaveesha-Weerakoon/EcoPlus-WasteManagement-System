<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Dashboard ">
        <div class="main">
            <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="./Collector_DashBoard.html">
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Home.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="./Collector_Requests/Collector_Requests.html">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Reports.png" alt="">
                            <h2>Reports</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/admin/complain_customers">
                        <div class="main-left-middle-content Collector">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Complains.png" alt="">
                            <h2>Complains</h2>
                        </div>
                    </a>
                    <a href="./Collector_Edit_Profile/Collector_EditProfile.html">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>

                </div> 
                <a href="<?php echo URLROOT?>/admin/logout">
                <div class="main-left-bottom">
                   
                    <div class="main-left-bottom-content">
                        <img src="<?php echo IMGROOT?>/logout.png" alt="">
                        <p>Log out</p>
                    </div>
                   
                </div>
                </a>
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

                        <div class="main-right-left-two-component A" id="customers">
                            <a href="<?php echo URLROOT?>/admin/customers">
                               <h3>Customers</h3>
                               <img src="<?php echo IMGROOT?>/customer.png" alt="">
                            </a>

                        </div>

                        <div class="main-right-left-two-component B" id="center_manager">
                               <a href="<?php echo URLROOT?>/admin/center_managers">

                                   <h3>Center Managers</h3>
                                   <img src="<?php echo IMGROOT?>/center_manager.png" alt="">
                               </a>
                        </div>
                        

                        <div class="main-right-left-two-component C">
                            <h3>Credit Discounts Agent</h3>
                            <img src="<?php echo IMGROOT?>/Credit_discounts _agent.png" alt="">
                        </div>


                        <div class="main-right-left-two-component D">
                           <a href="<?php echo URLROOT?>/admin/collectors">
                              <h3>Collectors</h3>
                              <img src="<?php echo IMGROOT?>/collectors.png" alt="">
                            </a>
                        </div>

                    </div>
                    <div class="main-right-left-three">             
                        <div class="main-right-left-three-component">
                            <img src="<?php echo IMGROOT?>/Centers.png" alt="">
                            <h6>Centers</h6>
                            <div class="center_btn_container">
                                <a href="<?php echo URLROOT?>/admin/center"><button id="center" class="center_btn">View</button></a>
                            </div>           
                        </div>
                        
                        <div class="main-right-left-three-component">
                            <img src="<?php echo IMGROOT?>/Logo2.png" alt="">
                            <h6>Manage Eco Credit Details</h6>
                            <div class="component">
                                <a href="<?php echo URLROOT?>/admin/pop_eco_credit"><button class="button1" id="Open-eco_credits">Eco credits</button></a>
                                <a href="<?php echo URLROOT?>/admin/pop_eco_credit"><button class="button1" id="Open-eco_credits">Rupee Value</button></a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="main-right-right">
                    <div class="main-right-right-top">
                        <img src="<?php echo IMGROOT?>/CustomerDashboard_image.png" alt="">
                        <h2>Admin</h2>
                        <p>Welcome To Admin Portal</p>
                    </div>
                    <div class="main-right-right-bottom">
                        <img src="<?php echo IMGROOT?>/Admin_DashBoard.png" alt="">
                    </div>
                </div>
            </div>
            <?php if($data['pop_eco_credits']=='True') : ?>
            <div class="pop-eco_credits" id="pop-eco_credits">
                <form class="Eco_Credits-main" method="post" action="<?php echo URLROOT;?>/admin/pop_eco_credit">
                    <div class="Eco_Credits-main-top">      
                        <h1> Eco Credits Per Kilogram</h1>
                        <a href="<?php echo URLROOT?>/admin"> 
                        <img class="View-content-img" src="<?php echo IMGROOT?>/cancel.png" id="close-eco_credits">
                        </a>
                    </div>
                    <div class="View-content-content" >
                        <div class="View-content-content-content">
                            <img src="<?php echo IMGROOT?>/Polythene.png" alt="">
                            <h6>Polythene</h6>
                            <input type="text" name="polythene" value="<?php echo $data['polythene_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <img src="<?php echo IMGROOT?>/Plastic.png" alt="">
                            <h6>Plastic</h6>
                            <input type="text" name="plastic" value="<?php echo $data['plastic_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <img src="<?php echo IMGROOT?>/Glass.png" alt="">
                            <h6>Glass</h6>
                            <input type="text" name="glass" value="<?php echo $data['glass_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <img src="<?php echo IMGROOT?>/paper.png" alt="">
                            <h6>Paper Waste</h6>
                            <input type="text" name="paper" value="<?php echo $data['paper_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <img src="<?php echo IMGROOT?>/Electronic_Waste.png" alt="">
                            <h6>Electronic Waste</h6>
                            <input type="text" name="electronic" value="<?php echo $data['electronic_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <img src="<?php echo IMGROOT?>/Metal.png" alt="">
                            <h6>Metals</h6>
                            <input type="text" name="metal" value="<?php echo $data['metal_credit']; ?>">
                        </div>

                    </div>

                    <button type="submit">Update</button>
                </form>
            </div>
            <?php endif; ?>
            <div class="pop-rupee_value" id="pop-rupee_value">
                <div class="rupee-main">
                    <div class="rupee-main-top">
                        <h1>Rupee Value per Eco Credit </h1>
                        <img class="View-content-img" src="<?php echo IMGROOT?>/cancel.png" id="close-rupee">
                    </div>
                    <div class="rupee-main-down">
                        <h4>1 Eco Credit =</h4>
                        <input type="text" value="100">
                    </div>
                    <button>Update</button>
                </div>

            </div>
        </div>
        <script src="Admin_Dashboard.js"></script>   
    </div>
</div>  

<?php require APPROOT . '/views/inc/footer.php'; ?>
