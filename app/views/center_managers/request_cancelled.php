<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Request_Main"> 
        <div class="CenterManager_Request_Cancelled">
           <div class="main">
               <div class="main-left">
                   <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                  </div>
                  <div class="main-left-middle">
                      <a href="<?php echo URLROOT?>/centermanagers">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Home.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                      </a>
                      <a href="">
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                      </a>
                      <a href="">
                        <div class="main-left-middle-content Collector ">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Center.png" alt="">
                            <h2>Center Waste Management</h2>
                        </div>
                      </a>
                      <a href="<?php echo URLROOT?>/centermanagers/editprofile">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                      </a>

                  </div>
                  <a href="<?php echo URLROOT?>/centermanagers/logout">
                    <div class="main-left-bottom">
                    <div class="main-left-bottom-content">
                        <img src="<?php echo IMGROOT?>/logout.png" alt="">
                        <p>Log out</p>
                    </div>
                    </div>
                  </a>
               </div>
               <div class="main-right">
                   <div class="main-right-top">
                        <div class="main-right-top-one">
                           <div class="main-right-top-one-search">
                              <img src="<?php echo IMGROOT?>/Search.png" alt="">
                              <input id="searchInput" type="text" placeholder="Search">
                          </div>

                          <div class="main-right-top-one-content">
                              <p><?php echo $_SESSION['center_manager_name']?></p>
                              <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
                          </div>
                        </div>
                        <div class="main-right-top-two">
                          <h1>Requests</h1>
                        </div>
                        <div class="main-right-top-three">
                          <a href="<?php echo URLROOT?>/centermanagers/request_incomming">
                              <div class="main-right-top-three-content">
                                 <p>Incoming</p>
                                 <div class="line1"></div>
                              </div>
                           </a>
                          <a href="">
                            <div class="main-right-top-three-content">
                                <p>Assigned</p>
                                <div class="line1"></div>
                            </div>
                          </a>
                           <a href="">
                            <div class="main-right-top-three-content">
                                <p>Completed</p>
                                <div class="line1"></div>
                            </div>
                           </a>
                           <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Cancelled</b></p>
                                <div class="line"></div>
                            </div>
                           </a>
                        </div>
                        <div class="main-right-top-four">
                        <div class="main-right-top-four-left">
                            <p>Date</p>
                            <input type="date" id="selected-date">
                            <button onclick="loadLocations()">Filter</button>
                            
                        </div>
                        <div class="main-right-top-four-right" >

                            <div class="main-right-top-four-component" style="" id="maps">
                                <img src="<?php echo IMGROOT?>/map.png" alt="">
                                <p>Maps</p>
                            </div>      

                            <div class="main-right-top-four-component" id="tables" style="background-color: #ecf0f1;">
                                <img src="<?php echo IMGROOT?>/cells.png" alt="">
                                <p>Tables</p>
                               </div>
                        </div>
                        </div>
                   </div>

                   <div class="main-right-bottom" id="main-right-bottom">
                      <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Req ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Customer ID</th>
                                <th>Cancelled By</th>
                                <th>Location</th>
                                <th>Request Details</th>
                                <th>Reason</th>
                            </tr>
                        </table>
                      </div>
                      <div class="main-right-bottom-down">
                        <table class="table">
                          <!-- <?php foreach($data['cancelled_request'] as $request) : ?> -->
                           <tr class="table-row">
                                <td>R<?php echo $request->req_id?></td>
                                <td><?php  echo $request->date?></td>
                                <td><?php  echo $request->time?></td>
                                <td><?php  echo $request->customer_id?></td>
                                <td><?php  echo $request->cancelled_by?></td>
                                <td><img onclick="assign(<?php echo $request->req_id ?>)" class="add" src="<?php echo IMGROOT?>/assign.png" alt=""></td>
                                <td><img onclick="assign(<?php echo $request->req_id ?>)" class="add" src="<?php echo IMGROOT?>/assign.png" alt=""></td>
                                <td><?php  echo $request->reason?></td>


                               
                            </tr>
                            <!-- <?php endforeach; ?> -->

                        </table>
                      </div>
                   </div>
                


               </div>

           </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
