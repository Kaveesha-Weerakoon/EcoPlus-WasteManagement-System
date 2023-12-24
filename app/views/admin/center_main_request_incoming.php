<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer></script>
    
        <div class="Admin_Center_Main_Request_Incoming">
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
                    <a href="./Complains/Complains_customer.html">
                        <div class="main-left-middle-content Collector">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Complains.png" alt="">
                            <h2>Complaints</h2>
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
                    <div class="main-top">
                        <a href="<?php echo URLROOT?>/admin">
                            <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                        </a>

                        <div class="main-top-component">
                            <p>Admin</p>
                            <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                        </div>
                    </div>
                    <div class="main-bottom">
                        <div class="main-bottom-top">
                            <div class="main-right-top-two">
                                <h1>Requests</h1>
                            </div>
                            <div class="main-right-top-three">
                                <a href="">
                                    <div class="main-right-top-three-content">
                                        <p><b style="color: #1B6652;">Incoming</b></p>
                                        <div class="line"></div>
                                    </div>
                                </a>
                                <a href="<?php echo URLROOT?>/Admin/assigned_requests/<?php echo $data['center_region']?>">
                                    <div class="main-right-top-three-content">
                                        <p>Assigned</p>
                                        <div class="line1"></div>
                                    </div>
                                </a>

                                <a href="<?php echo URLROOT?>/Admin/cancelled_requests/<?php echo $data['center_region']?>">
                                    <div class="main-right-top-three-content">
                                        <p>Completed</p>
                                        <div class="line1"></div>
                                    </div>
                                </a>

                                <a href="<?php echo URLROOT?>/Admin/cancelled_requests/<?php echo $data['center_region']?>">
                                    <div class="main-right-top-three-content">
                                        <p>Cancelled</p>
                                        <div class="line1"></div>
                                    </div>
                                </a>

                            </div>
                        </div>
                        <div class="main-bottom-down">
                            <div class="main-right-bottom-top ">
                                <table class="table">
                                    <tr class="table-header">
                                        <th>Req ID</th>
                                        <th>C ID</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Location</th>
                                        <th>Contact No</th>
                                        <th>Instructions</th>
                                       
                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">
                                <table class="table">
                                <?php foreach($data['incoming_requests'] as $incoming_requests) : ?>
                                    <tr class="table-row">
                                        <td>R<?php echo $incoming_requests->req_id?></td>
                                        <td>C<?php echo $incoming_requests->customer_id?></td>
                                        <td><?php echo $incoming_requests->name?></td>
                                        <td><?php echo $incoming_requests->date?></td>
                                        <td><?php echo $incoming_requests->time?></td>
                                        <td><img onclick="viewLocation(<?php echo $incoming_requests->lat; ?>, <?php echo $incoming_requests->longi; ?>)" src="<?php echo IMGROOT?>/location.png" alt=""></td>
                                        <td><?php echo $incoming_requests->contact_no?></td>
                                        <td><?php echo $incoming_requests->instructions?></td>
                                    </tr>   
                                    <?php endforeach; ?>  
                                            
                            </div>
                        </div>
                    </div>
                    <div class="location_pop">
                        <div class="location_pop_content">
                            <div class="location_pop_map">
                            
                            </div>
                            <div class="location_close">
                                <button onclick="closemap()">Close</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    
    </div>
</div>
<script>
    function initMap(latitude, longitude) {
        var mapCenter = { lat: latitude, lng: longitude };

        var map = new google.maps.Map(document.querySelector('.location_pop_map'), {
          center: mapCenter,
          zoom: 15
        });

        var marker = new google.maps.Marker({
        position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
        map: map,
        title: 'Marked Location'
    });
    }

    function viewLocation($lattitude,$longitude){
        initMap($lattitude,$longitude);
        document.querySelector('.location_pop').style.display = 'flex';
    }  
     
    function closemap(){
        document.querySelector('.location_pop').style.display = 'none';
    }
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
