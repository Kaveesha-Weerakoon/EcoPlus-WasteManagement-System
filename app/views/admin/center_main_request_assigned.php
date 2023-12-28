<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer></script>
    
        <div class="Admin_Center_Main_Request_Assigned">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>
                <!-- <div class="main-left">
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
                </div> -->
                

                <div class="main-right">
                    <div class="main-top">
                        <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
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
                                <a href="<?php echo URLROOT?>/Admin/incoming_requests/<?php echo $data['center_region']?>">
                                    <div class="main-right-top-three-content">
                                        <p>Incoming</p>
                                        <div class="line1"></div>
                                    </div>
                                </a>
                                <a href="">
                                    <div class="main-right-top-three-content">
                                        <p><b style="color: #1B6652;">Assigned</b></p>
                                        <div class="line"></div>
                                    </div>
                                </a>

                                <a href="<?php echo URLROOT?>/admin/center_add">
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
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Customer ID</th>
                                        <th>Collector ID</th>
                                        <th>Collector</th>
                                        <th>Location</th>
                                        <th>Request details</th>
                                       
                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">
                                <table class="table">
                                <?php foreach($data['assigned_requests'] as $assigned_requests) : ?>
                                    <tr class="table-row">
                                        <td>R<?php echo $assigned_requests->req_id?></td>
                                        <td><?php echo $assigned_requests->date?></td>
                                        <td><?php echo $assigned_requests->time?></td>
                                        <td>C<?php echo $assigned_requests->customer_id?></td>
                                        <td><?php echo $assigned_requests->collector_id?></td>
                                        <td>
                                        <img onclick="" class="collector_img"
                                            src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $assigned_requests->image?>"
                                            alt="">
                                        </td>
                                        <td><img onclick="viewLocation(<?php echo $assigned_requests->lat; ?>, <?php echo $assigned_requests->longi; ?>)" 
                                        src="<?php echo IMGROOT?>/location.png" alt="" class="location_icon">
                                        </td>
                                        <td>
                                        <img onclick="view_request_details(<?php echo htmlspecialchars(json_encode($assigned_requests), ENT_QUOTES, 'UTF-8') ?>)"
                                            class="cancel" src="<?php echo IMGROOT ?>/info.png" alt="">
                                        </td>
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
        document.getElementById('req_name').innerText = request.customer_name;
        document.getElementById('req_date').innerText = request.date;
        document.getElementById('req_time').innerText = request.time;
        document.getElementById('req_contactno').innerText = request.customer_contactno;
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
