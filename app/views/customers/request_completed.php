<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Request_Main">
        <div class="Customer_Request_Completed">
           <div class="main">
            <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="<?php echo URLROOT?>/customers">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_DashBoard_Icon.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Customer_Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    <a href="<?php echo URLROOT?>/customers/history">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_tracking _Icon.png" alt="">
                            <h2>History</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/editprofile">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_Edit_Pro_Icon.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>
                </div>
                <div class="main-left-bottom">

                <a href="<?php echo URLROOT?>/customers/logout">
                        <div class="main-left-bottom-content">
                            <img src="<?php echo IMGROOT?>/Logout.png" alt="">
                            <p>Log out</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-one-input">
                           <img src="<?php echo IMGROOT?>/Search.png" alt="">
                           <input type="text" placeholder="Search">
                        </div>
                        <div class="main-right-top-one-content">
                            <p><?php echo $_SESSION['user_name']?></p>
                            <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Requests</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/customers/request_main">
                            <div class="main-right-top-three-content">
                                <p>Current</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/customers/request_completed">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Completed</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/customers/request_cancelled">
                            <div class="main-right-top-three-content">
                                <p>Cancelled</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Req ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Collector Name</th>
                                <th>Contact No</th>
                                <th>Earned Credits</th>
                                <th>Details</th>
                            </tr>
                        </table>
                    </div>

                    <div class="main-right-bottom-down">
                        <table class="table">
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Samantha</td>
                                <td>07712312312</td>
                                <td>123</td>
                                <td class="x"><img src="../../../src/View.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Samantha</td>
                                <td>07712312312</td>
                                <td>123</td>
                                <td class="x"><img src="../../../src/View.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Samantha</td>
                                <td>07712312312</td>
                                <td>123</td>
                                <td class="x"><img src="../../../src/View.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Samantha</td>
                                <td>07712312312</td>
                                <td>123</td>
                                <td class="x"><img src="../../../src/View.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Samantha</td>
                                <td>07712312312</td>
                                <td>123</td>
                                <td class="x"><img src="../../../src/View.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Samantha</td>
                                <td>07712312312</td>
                                <td>123</td>
                                <td class="x"><img src="../../../src/View.png" alt=""></td>
                            </tr>
                        </table>

                    </div>
                </div>
                <div class="View" id="View">
                    <div class="View-content">

                        <img class="View-content-img" src="../../../src/cancel.png" id="close">
                        <h2>Details of the Collect</h2>
                        <div class="View-content-content">
                            <div class="View-content-content-content">
                                <img src="../../../src/Polythene.png" alt="">
                                <h6>Polythene</h6>
                                <p>12 Kg</p>
                            </div>
                            <div class="View-content-content-content">
                                <img src="../../../src/Plastic.png" alt="">
                                <h6>Plastic</h6>
                                <p>12 Kg</p>
                            </div>
                            <div class="View-content-content-content">
                                <img src="../../../src/Glass.png" alt="">
                                <h6>Glass</h6>
                                <p>12 Kg</p>
                            </div>
                            <div class="View-content-content-content">
                                <img src="../../../src/paper.png" alt="">
                                <h6>Paper Waste</h6>
                                <p>12 Kg</p>
                            </div>
                            <div class="View-content-content-content">
                                <img src="../../../src/Electronic_Waste.png" alt="">
                                <h6>Electronic Waste</h6>
                                <p>12 Kg</p>
                            </div>
                            <div class="View-content-content-content">
                                <img src="../../../src/Metal.png" alt="">
                                <h6>Metals</h6>
                                <p>12 Kg</p>
                            </div>

                        </div>
                        <h3>Credits &nbsp;Earned &nbsp;: &nbsp; 123.231</h3>
                    </div>

                </div>
                <script src="./Request_Completed.js"></script>
           </div>
    </div>  
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
