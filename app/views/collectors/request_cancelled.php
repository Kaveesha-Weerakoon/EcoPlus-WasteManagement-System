<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_Request_Top">
        <div class="Collector_Request_Cancelled">
            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async
                defer></script>

            <div class="main">
                <div class="main-left">
                    <div class="main-left-top">
                        <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                        <h1>Eco Plus</h1>
                    </div>

                    <div class="main-left-middle">
                        <a href="<?php echo URLROOT?>/collectors">
                            <div class="main-left-middle-content ">
                                <div class="main-left-middle-content-line1"></div>
                                <img src="<?php echo IMGROOT?>/Home.png" alt="">
                                <h2>Dashboard</h2>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-left-middle-content current ">
                                <div class="main-left-middle-content-line"></div>
                                <img src="<?php echo IMGROOT?>/Request.png" alt="">
                                <h2>Requests</h2>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/collectors/collector_assistants">
                            <div class="main-left-middle-content Collector">
                                <div class="main-left-middle-content-line1"></div>
                                <img src="<?php echo IMGROOT?>/CollectorAssis.png" alt="">
                                <h2>Collector Assistants</h2>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/collectors/editprofile">
                            <div class="main-left-middle-content ">
                                <div class="main-left-middle-content-line1"></div>
                                <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                                <h2>Edit Profile</h2>
                            </div>
                        </a>

                    </div>
                    <div class="main-left-bottom">
                        <a href="<?php echo URLROOT?>/collectors/logout">
                            <div class="main-left-bottom-content">
                                <img src="<?php echo IMGROOT?>/logout.png" alt="">
                                <p>Log out</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-one-search">
                                <img src="<?php echo IMGROOT?>/Search.png" alt="">
                                <input id="searchInput" type="text" placeholder="Search">
                            </div>

                            <div class="main-right-top-one-content">
                                <p><?php echo $_SESSION['collector_name']?></p>
                                <img src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $_SESSION['collector_profile']?>"
                                    alt="">
                            </div>
                        </div>
                        <div class="main-right-top-two">
                            <h1>Requests</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/collectors/request_assinged">
                                <div class="main-right-top-three-content">
                                    <p>Assigned</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/collectors/request_completed">
                                <div class="main-right-top-three-content">
                                    <p>Completed</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href=>
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
                            <div class="main-right-top-four-right">
                                <div class="main-right-top-four-component" id="tables"
                                    style="background-color: #ecf0f1">
                                    <img src="<?php echo IMGROOT?>/cells.png" alt="">
                                    <p>Tables</p>
                                </div>
                                <div class="main-right-top-four-component" id="maps">
                                    <img src="<?php echo IMGROOT?>/map.png" alt="">
                                    <p>Maps</p>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Request Details</th>
                                    <th>Location</th>
                                    <th>Cancelled By</th>
                                    <th>Reason</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">

                            <table class="table">
                                <?php foreach($data['cancelled_requests'] as $request) : ?>
                                <tr class="table-row">
                                    <td>R<?php echo $request->req_id?></td>
                                    <td><?php echo $request->date?></td>
                                    <td><?php echo $request->time?></td>
                                    <td><img onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"
                                            src="<?php echo IMGROOT?>/view.png" alt=""></td>
                                    <td><img onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"
                                            src="<?php echo IMGROOT?>/location.png" alt=""></td>
                                    <td><?php  echo $request->cancelled_by?></td>
                                    <td><?php  echo $request->reason?> </td>

                                </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>
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
                <div class="request-details-pop" id="request-details-popup-box">
                    <div class="request-details-pop-form">
                        <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="request-details-pop-form-close"
                            id="request-details-pop-form-close">
                        <div class="request-details-pop-form-top">
                            <div class="request-details-topic">Request ID R <div id="req_id3"></div>
                            </div>
                        </div>

                        <div class="request-details-pop-form-content">
                            <div class="personal-details-right-labels">
                                <span>Customer Id</span><br>
                                <span>Name</span><br>
                                <span>Date</span><br>
                                <span>Time</span><br>
                                <span>Contact No</span><br>
                                <span>Instructions</span><br>
                            </div>
                            <div class="personal-details-right-values">
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
</div>
<script>
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

function viewLocation($lattitude, $longitude) {
    initMap($lattitude, $longitude);
    console.log('as');
    document.querySelector('.location_pop').style.display = 'flex';
}

function initMap(latitude = 7.4, longitude = 81.00000000) {
    var mapCenter = {
        lat: latitude,
        lng: longitude
    };

    var map = new google.maps.Map(document.querySelector('.location_pop_map'), {
        center: mapCenter,
        zoom: 14.5
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

function closemap() {
    document.querySelector('.location_pop').style.display = 'none';

}
document.addEventListener("DOMContentLoaded", function() {
    const close_request_details = document.getElementById("request-details-pop-form-close");

    close_request_details.addEventListener("click", function() {
        document.getElementById('request-details-popup-box').style.display = "none";
    });
});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>