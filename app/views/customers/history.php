<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer-main-main">
    <div class="Customer-history-top">
     <div class="Customer-main-history"> 
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
                    <a href="<?php echo URLROOT?>/customers/request_main">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    </a>
                    
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Customer_tracking _Icon.png" alt="">
                            <h2>History</h2>
                        </div>
                    
                    <a href="<?php echo URLROOT?>/customers/editprofile">
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
                        <img src="<?php echo IMGROOT?>/Search.png" alt="">
                        <input type="text" placeholder="Search">
                        <div class="main-right-top-one-content">
                            <p><?php echo $_SESSION['user_name']?></p>
                            <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>History</h1>
                    </div>
                    <div class="main-right-top-three">
                        
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Credits History</b></p>
                                <div class="line"></div>
                            </div>
                        
                        <a href="<?php echo URLROOT?>/customers/history_complains">
                            <div class="main-right-top-three-content">
                                <p>Complaints History</p>
                                <div class="line1"></div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-container">
                        <div class="main-right-bottom-container-top">
                            <div class="circle"></div>
                            <h4>Discount Details</h4>
                        </div>
                        <div class="main-right-bottom-container-container">
                            <div class="main-right-bottom-top">
                                <table class="table">
                                    <tr class="table-header">
                                        <th>Discount Agent ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Credit Discounts Agent</th>
                                        <th>Branch</th>
                                        <th>Amount of Eco Credits</th>
                                        <th>Discount gained</th>

                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">
                                <table class="table">
                                    <tr class="table-row">
                                        <td>D20462</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>Keels</td>
                                        <td>Kelaniya</td>
                                        <td>50</td>
                                        <td>23.45</td>
                                    </tr>
                                    <tr class="table-row">
                                        <td>D20462</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>Keels</td>
                                        <td>Kelaniya</td>
                                        <td>50</td>
                                        <td>23.45</td>
                                    </tr>
                                    <tr class="table-row">
                                        <td>D20462</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>Keels</td>
                                        <td>Kelaniya</td>
                                        <td>50</td>
                                        <td>23.45</td>
                                    </tr>
                                    <tr class="table-row">
                                        <td>D20462</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>Keels</td>
                                        <td>Kelaniya</td>
                                        <td>50</td>
                                        <td>23.45</td>
                                    </tr>
                                    <tr class="table-row">
                                        <td>D20462</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>Keels</td>
                                        <td>Kelaniya</td>
                                        <td>50</td>
                                        <td>23.45</td>

                                    </tr>
                                    <tr class="table-row">
                                        <td>D20462</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>Keels</td>
                                        <td>Kelaniya</td>
                                        <td>50</td>
                                        <td>23.45</td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="main-right-bottom-container">
                        <div class="main-right-bottom-container-top">
                            <div class="circle"></div>
                            <h4>Transfer Details <h4>
                        </div>
                        <div class="main-right-bottom-container-container">
                            <div class="main-right-bottom-top">
                                <table class="table">
                                    <tr class="table-header table2">
                                        <th>Transferred account ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Amount of Eco credits</th>


                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">
                                <table class="table">
                                    <tr class="table2row">
                                        <td>C 23232</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>23.45</td>
                                    </tr>
                                    <tr class="table2row">
                                        <td>C 23232</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>23.45</td>
                                    </tr>
                                    <tr class="table2row">
                                        <td>C 23232</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>23.45</td>
                                    </tr>
                                    <tr class="table2row">
                                        <td>C 23232</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>23.45</td>
                                    </tr>
                                    <tr class="table2row">
                                        <td>C 23232</td>
                                        <td>13/05/2022</td>
                                        <td>12.00 PM</td>
                                        <td>23.45</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
     </div>
  </div> 
<?php require APPROOT . '/views/inc/footer.php'; ?>
