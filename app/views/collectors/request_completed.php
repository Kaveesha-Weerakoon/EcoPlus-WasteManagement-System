<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_Request_Top">
        <div class="Collector_Request_Completed">

            <div class="main">
                <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>
                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>
                            <div class="main-right-top-notification" id="notification">
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
                                <img src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $_SESSION['collector_profile']?>"
                                    alt="">
                                <div class="main-right-top-profile-cont">
                                    <h3><?php echo $_SESSION['collector_name']?></h3>
                                    <p>ID : Col <?php echo $_SESSION['collector_id']?></p>
                                </div>
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
                                            <th>Customer</th>
                                            <th>C ID</th>
                                            <th>Contact No</th>
                                            <th>Instructions</th>
                                            <th>Location</th>
                                            <th>Complete</th>
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
                                            <td><?php  echo $request->name?></td>
                                            <td><?php  echo $request->customer_id?></td>
                                            <td><?php  echo $request->contact_no?></td>
                                            <td><?php  echo $request->instructions?></td>
                                            <td>
                                            <i class='bx bx-map' style="font-size: 29px;"
                                             onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"></i>
                                            </td>
                                            <td><img onclick="view_collect_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"
                                                    src="<?php echo IMGROOT?>/view.png" alt=""></td>
                                            
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
                            <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="collect-details-pop-form-close"
                                id="collect-details-pop-form-close">
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
                                            <h3>Note</h3>
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
                                                <h3 id="Note"></h3>
                                            </div>
                                            <div class="collect-details-pop-form-content-right-values-cont">
                                                <h3 id="Earned_Credits"></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="overlay" id="overlay"></div>
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

document.getElementById('searchInput').addEventListener('input', searchTable);
document.addEventListener("DOMContentLoaded", function() {
    const close_collector = document.getElementById("personal-details-popup-form-close");
    const collector_view = document.getElementById("personal-details-popup-box");
    const close_view = document.getElementById("collect-details-pop-form-close");
    

    close_collector.addEventListener("click", function() {
        collector_view.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

    close_view.addEventListener("click", function() {
        var locationPop = document.getElementById('collect-details-popup-box');
        locationPop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";

    });

});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>