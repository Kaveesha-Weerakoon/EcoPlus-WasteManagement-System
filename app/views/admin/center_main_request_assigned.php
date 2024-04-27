<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
        </script>

        <div class="Admin_Center_Main_Request_Assigned">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <a
                                href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                                <div class="main-right-top-back-button">
                                    <i class='bx bxs-chevrons-left'></i>
                                </div>
                            </a>
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>

                            <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                        </div>
                        <div class="main-right-top-two">
                            <h1>Requests</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/Admin/incoming_requests/<?php echo $data['center_region']?>"
                                id="incoming">

                                <div class="main-right-top-three-content" id="current">
                                    <p>Incoming</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/assigned_requests/<?php echo $data['center_region']?>"
                                id="assigned">
                                <div class="main-right-top-three-content">
                                    <p>Assigned</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/Admin/completed_requests/<?php echo $data['center_region']?>"
                                id="completed">
                                <div class="main-right-top-three-content">
                                    <p>Completed</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/cancelled_requests/<?php echo $data['center_region']?>"
                                id="cancelled">
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
                                    <td><i onclick="viewLocation(<?php echo $assigned_requests->lat; ?>, <?php echo $assigned_requests->longi; ?>)"
                                            class='bx bx-map' style="font-size: 29px;"></i></td>

                                    <td><i onclick="view_request_details(<?php echo htmlspecialchars(json_encode($assigned_requests), ENT_QUOTES, 'UTF-8') ?>)"
                                            class='bx bx-info-circle' style="font-size: 29px"></i></td>

                                </tr>
                                <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="location_pop" id="location_pop">
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

            <div class="overlay" id="overlay"></div>

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
    var mapCenter = {
        lat: latitude,
        lng: longitude
    };

    var map = new google.maps.Map(document.querySelector('.location_pop_map'), {
        center: mapCenter,
        zoom: 15
    });

    var marker = new google.maps.Marker({
        position: {
            lat: parseFloat(latitude),
            lng: parseFloat(longitude)
        },
        map: map,
        title: 'Marked Location'
    });
}

// function viewLocation($lattitude,$longitude){
//     initMap($lattitude,$longitude);
//     document.querySelector('.location_pop').style.display = 'flex';
// }  

// function closemap(){
//     document.querySelector('.location_pop').style.display = 'none';
// }

function viewLocation($lattitude, $longitude) {
    initMap($lattitude, $longitude);
    var locationPop = document.getElementById('location_pop');
    locationPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function closemap() {
    var locationPop = document.getElementById('location_pop');
    locationPop.classList.remove('active');
    document.getElementById('overlay').style.display = "none";
}

function view_request_details(request) {
    var personalPop = document.getElementById('request-details-popup-box');
    personalPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    //document.getElementById('request-details-popup-box').style.display = "flex";
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
        //document.getElementById('request-details-popup-box').style.display = "none";
        const request_details = document.getElementById("request-details-popup-box");
        request_details.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>