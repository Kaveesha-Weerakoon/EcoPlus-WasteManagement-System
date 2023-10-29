<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer-main-main">
    <div class="Customer-Request-Main">
        <div class="Customer-Request-Ongoing">
          <div class="main">
            <div class="main-left">
                <div class="main-left-top">
                    <img src="../../../src/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="../CustomerDashboard.html">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="../../../src/Customer_DashBoard_Icon.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="../Request/Request_Ongoing.html">
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="../../../src/Customer_Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    </a>
                    <a href="../History/History.html">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="../../../src/Customer_tracking _Icon.png" alt="">
                            <h2>History</h2>
                        </div>
                    </a>
                    <a href="../EditProfile.html">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="../../../src/Customer_Edit_Pro_Icon.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>
                </div>
                <div class="main-left-bottom">

                    <a href="../../../Login.html">
                        <div class="main-left-bottom-content">
                            <img src="../../../src/Logout.png" alt="">
                            <p>Log out</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <img src="../../../src/Search.png" alt="">
                        <input type="text" placeholder="Search">
                        <div class="main-right-top-one-content">
                            <p>Ananda Perera</p>
                            <img src="../../../src/Requests Profile.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Requests</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="Request_Ongoing.html">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Current</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="Request_Completed.html">
                            <div class="main-right-top-three-content">
                                <p>Completed</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="Request_Cancelled.html">
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
                                <th>Status</th>
                                <th>Collector Name</th>
                                <th>Contact No</th>
                                <th>Cancel</th>
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
                                <td>Assigned</td>
                                <td>Samantha</td>
                                <td>077-4567890</td>
                                <td class="cancel-open"><img src="../../../src/cancel.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Assigned</td>
                                <td>Samantha</td>
                                <td>077-4567890</td>
                                <td class="cancel-open"><img src="../../../src/cancel.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Assigned</td>
                                <td>Samantha</td>
                                <td>077-4567890</td>
                                <td class="cancel-open"><img src="../../../src/cancel.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Assigned</td>
                                <td>Samantha</td>
                                <td>077-4567890</td>
                                <td class="cancel-open"><img src="../../../src/cancel.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Not Assigned</td>
                                <td>Samantha</td>
                                <td>077-4567890</td>
                                <td class="cancel-open"><img src="../../../src/cancel.png" alt=""></td>
                            </tr>
                            <tr class="table-row">
                                <td>R1231</td>
                                <td>13/05/2022</td>
                                <td>12:00 P.M</td>
                                <td>Collection</td>
                                <td>Assigned</td>
                                <td>Samantha</td>
                                <td>077-4567890</td>
                                <td class="cancel-open"><img src="../../../src/cancel.png" alt=""></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <div class="confirm-cancel" id="confimcancel">
                <div class=" confim-cancell-content">
                    <h1>Cancel the Request?</h1>
                    <div class="confim-cancell-content-box">
                        <button id="cancel" style="background-color: tomato;">OK</button>
                        <button id="okay">CANCELL </button>
                    </div>
                </div>
          </div>
         </div>
    </div>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
