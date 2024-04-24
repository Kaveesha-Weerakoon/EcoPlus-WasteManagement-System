<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_Request_Top">
        <div class="Collector_Request_Completed">
            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&callback=initMap" async
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
                                    <p><b style="color: #1ca557;">Completed</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/collectors/request_cancelled">
                                <div class="main-right-top-three-content">
                                    <p>Cancelled</p>
                                    <div class="line1"></div>
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
                                <div class="main-right-top-four-component" style="background-color: #ecf0f1"
                                    id="tables">
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
                        <?php if(!empty($data['completed_requests'])) : ?>
                        <div class="main-right-bottom">
                            <div class="main-right-bottom-one" id="main-right-bottom-one">
                                <div class="main-right-bottom-top">
                                    <table class="table">
                                        <tr class="table-header">
                                            <th>Req ID</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Request Details</th>
                                            <th>Location</th>
                                            <th>Collection Details</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="main-right-bottom-down">

                                    <table class="table">
                                        <?php foreach($data['completed_requests'] as $request) : ?>
                                        <tr class="table-row">
                                            <td>R<?php echo $request->req_id?></td>
                                            <td><?php  echo $request->date?></td>
                                            <td><?php  echo $request->time?></td>
                                            <td> <i class='bx bx-info-circle' style="font-size: 29px"
                                                    onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)">
                                                </i></td>
                                            <td>
                                                <i class='bx bx-map' style="font-size: 29px;"
                                                    onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"></i>
                                            </td>
                                            <td><i class='fa-solid fa-coins' style="font-size: 22px"
                                                    onclick="view_collect_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)">
                                                </i></td>

                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                            <div class="main-right-bottom-two" id="main-right-bottom-two">
                                <div class="map-locations" id="map-loaction">

                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="main-right-bottom-three">
                            <div class="main-right-bottom-three-content">
                                <img src="<?php echo IMGROOT?>/Center_Manager_Request_Assign_Empty.jpg" alt="">
                                <h1>You have No completed Requests</h1>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="collect-details-pop" id="collect-details-popup-box">
                        <div class="collect-details-pop-form">
                            <img src="<?php echo IMGROOT?>/close_popup.png" alt=""
                                class="collect-details-pop-form-close" id="collect-details-pop-form-close">
                            <div class="collect-details-pop-form-top">
                                <div class="collect-details-topic">Collection Details<div id="req_id3"></div>
                                </div>
                            </div>

                            <div class="collect-details-pop-form-content">
                                <div class="collect-details-pop-form-content-labels">
                                    <h3>Polythene Quantity</h3>
                                    <h3>Plastic Quantity</h3>
                                    <h3>Glass Quantity </h3>
                                    <h3>Paper Waste Quantity</h3>
                                    <h3>Electronic Waste Quantity </h3>
                                    <h3>Metals Quantity</h3>
                                    <h3 class="note">Note</h3>
                                    <h3>Earned Credits</h3>
                                </div>
                                <div class="collect-details-pop-form-content-right-values">
                                    <div class="collect-details-pop-form-content-right-values-cont">
                                        <h3 id="Polythene_Quantity"></h3>
                                        <h3>&nbsp Kg</h3>
                                    </div>
                                    <div class="collect-details-pop-form-content-right-values-cont">
                                        <h3 id="Plastic_Quantity"></h3>
                                        <h3>&nbsp Kg</h3>
                                    </div>
                                    <div class="collect-details-pop-form-content-right-values-cont">
                                        <h3 id="Glass_Quantity"></h3>
                                        <h3>&nbsp Kg</h3>
                                    </div>
                                    <div class="collect-details-pop-form-content-right-values-cont">
                                        <h3 id="Paper_Waste_Quantity"></h3>
                                        <h3>&nbsp Kg</h3>
                                    </div>
                                    <div class="collect-details-pop-form-content-right-values-cont">
                                        <h3 id="Electronic_Waste_Quantity"></h3>
                                        <h3>&nbsp Kg</h3>
                                    </div>
                                    <div class="collect-details-pop-form-content-right-values-cont">
                                        <h3 id="Metals_Quantity"></h3>
                                        <h3>&nbsp Kg</h3>
                                    </div>
                                    <div class="collect-details-pop-form-content-right-values-cont">
                                        <h3 id="Note" class="note"></h3>
                                    </div>
                                    <div class="collect-details-pop-form-content-right-values-cont">
                                        <h3 id="Earned_Credits"></h3>
                                    </div>
                                </div>
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
                    <div class="overlay" id="overlay"></div>
                    <div class="request-details-pop" id="request-details-popup-box">
                        <div class="request-details-pop-form">
                            <img src="<?php echo IMGROOT?>/close_popup.png" alt=""
                                class="request-details-pop-form-close" id="request-details-pop-form-close"
                                onclick="close_request_details()">
                            <div class="request-details-pop-form-top">
                                <div class="request-details-topic">Request ID: R <div id="req_id4"></div>
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
</div>
</div>
</div>


<script>
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

function view_collect_details(request) {
    var locationPop = document.getElementById('collect-details-popup-box');
    locationPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    document.getElementById('Polythene_Quantity').innerText = request.Polythene;
    document.getElementById('Plastic_Quantity').innerText = request.Plastic;
    document.getElementById('Glass_Quantity').innerText = request.Glass;
    document.getElementById('Paper_Waste_Quantity').innerText = request.Paper_Waste;
    document.getElementById('Electronic_Waste_Quantity').innerText = request.Electronic_Waste;
    document.getElementById('Metals_Quantity').innerText = request.Metals;
    document.getElementById('Note').innerText = request.note;
    document.getElementById('Earned_Credits').innerText = request.credit_amount;
}

function view_request_details(request) {

    var requestDetails_popup = document.getElementById('request-details-popup-box');
    requestDetails_popup.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    document.getElementById('req_id4').innerText = request.req_id;
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

function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');
    console.log("hello");
    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
        var time = row.querySelector('td:nth-child(3)').innerText.toLowerCase();


        if (time.includes(input) || id.includes(input) || date.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });


}

document.getElementById('searchInput').addEventListener('input', searchTable);
document.addEventListener("DOMContentLoaded", function() {

    const collector_view = document.getElementById("personal-details-popup-box");
    const close_view = document.getElementById("collect-details-pop-form-close");

    close_view.addEventListener("click", function() {
        var locationPop = document.getElementById('collect-details-popup-box');
        locationPop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";

    });

});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>