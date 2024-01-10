<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Creit_Discount_Agent_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
        async defer>
    </script>
    <div class="Creit_Discount_Agent_Main_Dashboard ">
        <div class="main">
            <?php require APPROOT . '/views/credit_discount_agents/agent_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
                        <i class='bx bx-bell'></i>
                        <div class="dot"></div>
                    </div>
                    <div id="notification_popup" class="notification_popup">
                        <h1>Notifications</h1>
                        <div class="notification">
                            <div class="notification-green-dot">

                            </div>
                            Request 1232 Has been Cancelled
                        </div>
                        <div class="notification">
                            <div class="notification-green-dot">

                            </div>
                            Request 1232 Has been Assigned
                        </div>
                        <div class="notification">
                            <div class="notification-green-dot">

                            </div>
                            Request 1232 Has been Cancelled
                        </div>


                    </div>
                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                        <div class="main-right-top-profile-cont">
                            <h3>Admin</h3>
                        </div>
                    </div>
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-one">
                        <div class="main-right-bottom-one-left">
                            <div class="left">
                                <h1>Rupee Value</h1>
                                <h3>per </h3>
                                <p>Eco credit</p>
                                <button>Change Value</button>
                            </div>
                            <div class="right">
                                <h1>Rs <span class="main-credit"> 2.62</span> </h1>
                                <h3>1 ECO CREDIT</h3>
                            </div>
                        </div>
                        <div class="main-right-bottom-one-right">

                            <!-- <canvas id="myChart" width="688" height="300"></canvas> -->
                        </div>
                    </div>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-cont A" onclick="redirect_customers()">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h4 id="customer_count" style="font-weight:bold"></h4>
                            <h3>Customers</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_collectors()">
                            <div class=" icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h4 id="collector_count" style="font-weight:bold"></h4>

                            <h3>Collectors</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h4 style="font-weight:bold">12</h4>

                            <h3>Discount Agents</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_centermanagers()">
                            <div class=" icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h4 style="font-weight:bold" id="cm_count"></h4>

                            <h3>Center Managers</h3>
                        </div>

                    </div>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-left">
                            <h1>Recent Transactions</h1>
                            <div class="main-right-bottom-three-left-cont">
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <h3>Dayana</h3>
                                <h2>+$ 12.21</h2>
                            </div>
                            <div class="main-right-bottom-three-left-cont">
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <h3>James</h3>
                                <h2>+$ 12.21</h2>
                            </div>
                            <div class="main-right-bottom-three-left-cont">
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <h3>Samantha</h3>
                                <h2 style="color: #F13E3E;">-$ 12.21</h2>
                            </div>
                            <!-- <div class="map" id="map"></div> -->
                        </div>
                        <div class="main-right-bottom-three-right">
                            <div class="main-right-bottom-three-right-left">
                                <h1>Credits per Waste Qunatity</h1>
                                <i class='bx bx-dollar-circle'></i> <button onclick="redirect_credits_per()">
                                    Change
                                </button>
                            </div>
                            <div class="main-right-bottom-three-right-right">
                                <h1>Centers</h1>
                                <div class="map" id="map"></div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="pop-eco_credits" id="pop-eco_credits">
                <form class="Eco_Credits-main" method="post" action="<?php echo URLROOT;?>/admin/pop_eco_credit">
                    <div class="Eco_Credits-main-top">
                        <h1> Eco Credits Per Kilogram</h1>
                        <img class="View-content-img" src="<?php echo IMGROOT?>/close_popup.png" id="close-eco_credits">
                    </div>
                    <div class="View-content-content">
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Polythene</h6>
                            <input type="text" name="polythene" value="<?php echo $data['polythene_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Plastic</h6>
                            <input type="text" name="plastic" value="<?php echo $data['plastic_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Glass</h6>
                            <input type="text" name="glass" value="<?php echo $data['glass_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Paper Waste</h6>
                            <input type="text" name="paper" value="<?php echo $data['paper_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Electronic Waste</h6>
                            <input type="text" name="electronic" value="<?php echo $data['electronic_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Metals</h6>
                            <input type="text" name="metal" value="<?php echo $data['metal_credit']; ?>">
                        </div>

                    </div>

                    <button type="submit">Update</button>
                </form>
            </div>
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
            <div class="overlay" id="overlay">

            </div>
        </div>
        <!-- <script src="Admin_Dashboard.js"></script> -->
    </div>
</div>
