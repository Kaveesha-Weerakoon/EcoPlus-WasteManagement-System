<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_Request_Top">
        <div class="Collector_Request_Cancelled">
            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async
                defer></script>

            <div class="main">
                <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>
                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>
                            <?php require APPROOT . '/views/collectors/collector_notification/collector_notification.php'; ?>
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
                                    <p><b style="color: #1ca557;">Cancelled</b></p>
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
                            <div class="main-right-top-four-component" style="background-color: var(--request-top-color);" id="tables">
                                    <!-- <img src="<?php echo IMGROOT?>/cells.png" alt=""> -->
                                    <i class='bx bx-table'  style="color:var(--main-text-color); font-size: 23px;"></i>
                                    <p>Tables</p>
                                </div>


                                <div class="main-right-top-four-component" id="maps">
                                    <!-- <img src="<?php echo IMGROOT?>/map.png" alt=""> -->
                                    <i class='bx bx-map' style="color:var(--main-text-color); font-size: 23px;"></i>
                                    <p>Maps</p>
                                </div>


                            </div>
                        </div>
                    </div>
                    <?php if(!empty($data['cancelled_requests'])) : ?>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Cancelled By</th>
                                    <th>Location</th>
                                    <th>Request Details</th>
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
                                    <td><?php  echo $request->cancelled_by?></td>
                                    <td><img onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"
                                            src="<?php echo IMGROOT?>/location.png" alt=""></td>

                                    <td>
                                        <i class='bx bx-info-circle' style="font-size: 29px"
                                            onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"></i>
                                    </td>
                                    <td><?php  echo $request->reason?> </td>

                                </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>
                    </div>
                    <?php else: ?>
                        <div class="main-right-bottom-three">
                            <div class="main-right-bottom-three-content">
                                <img src="<?php echo IMGROOT?>/undraw_questions_re_1fy7.svg" alt="">
                                <h1>You have No cancel Requests</h1>
                            </div>
                        </div>
                    <?php endif; ?>
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
                <div class="overlay" id="overlay"></div>

                <div class="request-details-pop" id="request-details-popup-box">
                    <div class="request-details-pop-form">
                        <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="request-details-pop-form-close"
                            id="request-details-pop-form-close" onclick="close_request_details()">
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
</div>
<script>
function view_request_details(request) {

    var requestDetails_popup = document.getElementById('request-details-popup-box');
    requestDetails_popup.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    // document.getElementById('request-details-popup-box').style.display = "flex";
    document.getElementById('req_id3').innerText = request.req_id;
    document.getElementById('req_id2').innerText = request.customer_id;
    document.getElementById('req_name').innerText = request.name;
    document.getElementById('req_date').innerText = request.date;
    document.getElementById('req_time').innerText = request.time;
    document.getElementById('req_contactno').innerText = request.contact_no;
    document.getElementById('instructions').innerText = request.instructions;

}

function close_request_details() {
    var requestDetails_popup = document.getElementById('request-details-popup-box');
    requestDetails_popup.classList.remove('active');
    document.getElementById('overlay').style.display = "none";
    console.log("");
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

function loadLocations() {
    var selectedDate = document.getElementById("selected-date").value;
    var rows = document.querySelectorAll('.table-row');

    rows.forEach(function(row) {
        var date = row.querySelector('td:nth-child(2)').innerText;

        if (date.includes(selectedDate)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');

    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
        var time = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
        var customer = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
        var cid = row.querySelector('td:nth-child(5)').innerText.toLowerCase();
        var conctact_no = row.querySelector('td:nth-child(6)').innerText.toLowerCase();
        var instructions = row.querySelector('td:nth-child(7)').innerText.toLowerCase();

        if (time.includes(input) || id.includes(input) || date.includes(input) || customer.includes(input) ||
            cid.includes(input) || conctact_no.includes(input) || instructions.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });


}
document.getElementById('searchInput').addEventListener('input', searchTable);

document.addEventListener("DOMContentLoaded", function() {

});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>