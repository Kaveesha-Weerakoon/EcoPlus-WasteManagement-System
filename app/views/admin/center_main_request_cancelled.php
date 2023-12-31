<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer></script>
    
        <div class="Admin_Center_Main_Request_Cancelled">
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
                            <a href="<?php echo URLROOT?>/Admin/incoming_requests/<?php echo $data['center_region']?>" id="incoming">

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


                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Customer ID</th>
                                    <th>Cancelled By</th>
                                    <th>Location</th>
                                    <th>Request details</th>
                                    <th>Reason</th>
                                    
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                            <?php foreach($data['cancelled_requests'] as $cancelled_requests) : ?>
                                <tr class="table-row">
                                    <td>R<?php echo $cancelled_requests->req_id?></td>
                                    <td><?php echo $cancelled_requests->date?></td>
                                    <td><?php echo $cancelled_requests->time?></td>
                                    <td>C<?php echo $cancelled_requests->customer_id?></td>
                                    <td><?php echo $cancelled_requests->cancelled_by?></td>
                                    <td><img onclick="viewLocation(<?php echo $cancelled_requests->lat; ?>, <?php echo $cancelled_requests->longi; ?>)" 
                                    src="<?php echo IMGROOT?>/location.png" alt="" class="location_icon">
                                    </td>
                                    <td>
                                    <img onclick="view_request_details(<?php echo htmlspecialchars(json_encode($cancelled_requests), ENT_QUOTES, 'UTF-8') ?>)"
                                        class="cancel" src="<?php echo IMGROOT ?>/info.png" alt="">
                                    </td>
                                    <td><?php echo $cancelled_requests->reason?></td>
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

            <div class="request-details-pop" id="request-details-popup-box">
                <div class="request-details-pop-form">
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="request-details-pop-form-close"
                        id="request-details-pop-form-close">
                    <div class="request-details-pop-form-top">
                        <div class="request-details-topic">Request ID: R <div id="req_id3"></div>
                        </div>
                    </div>

                    <div class="request-details-pop-form-content">
                        <div class="request-details-right-labels">
                            <span>Customer Id</span><br>
                            <span>Name</span><br>
                            <span>Date</span><br>
                            <span>Time</span><br>
                            <span>Contact No</span><br>
                            <span>Instructions</span><br>
                        </div>
                        <div class="request-details-right-values">
                            <span id="req_id2"></span><br>
                            <span id="req_name"></span><br>
                            <span id="req_date"></span><br>
                            <span id="req_time"></span><br>
                            <span id="req_contactno"></span><br>
                            <span id="instructions"></span><br>
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

    function view_request_details(request) {

        document.getElementById('request-details-popup-box').style.display = "flex";
        document.getElementById('req_id3').innerText = request.req_id;
        document.getElementById('req_id2').innerText = request.customer_id;
        document.getElementById('req_name').innerText = request.name;
        document.getElementById('req_date').innerText = request.date;
        document.getElementById('req_time').innerText = request.time;
        document.getElementById('req_contactno').innerText = request.contact_no;
        document.getElementById('instructions').innerText = request.instructions;

    }

    document.addEventListener("DOMContentLoaded", function() {
        const close_request_details = document.getElementById("request-details-pop-form-close");

        close_request_details.addEventListener("click", function() {
        document.getElementById('request-details-popup-box').style.display = "none";
        });

    });

   

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
