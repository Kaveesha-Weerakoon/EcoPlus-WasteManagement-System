<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer></script>
    
        <div class="Admin_Center_Main_Request_Incoming">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>
                
                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                            <div class="main-right-top-back-button">
                                <i class='bx bxs-chevrons-left'></i>
                            </div>
                            </a>
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>
                            <div class="main-right-top-notification"  style="visibility: hidden;" id="notification">
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
                        <div class="main-right-top-two">
                            <h1>Requests</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="" id="incoming">

                                <div class="main-right-top-three-content" id="current">
                                    <p>Incoming</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/assigned_requests/<?php echo $data['center_region']?>" id="assigned">
                                <div class="main-right-top-three-content">
                                    <p>Assigned</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                            <a href="" id="completed">
                                <div class="main-right-top-three-content">
                                    <p>Completed</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/cancelled_requests/<?php echo $data['center_region']?>" id="cancelled">
                                <div class="main-right-top-three-content">
                                    <p>Cancelled</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="main-top">
                        <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                            <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                        </a>

                        <div class="main-top-component">
                            <p>Admin</p>
                            <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                        </div>
                    </div>
                    
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
                    </div> -->

                    <div class="main-right-bottom">
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
