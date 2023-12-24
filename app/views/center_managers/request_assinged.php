<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
    </script>
    <div class="CenterManager_Request_Main">
        <div class="CenterManager_Request_Assinged">
            <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
                <!-- <div class="main-left">
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
                </div> -->
                <div class="main-right">

                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-one-search">
                                <img src="<?php echo IMGROOT?>/Search.png" alt="">
                                <input id="searchInput" type="text" placeholder="Search">
                            </div>

                            <div class="main-right-top-one-content">
                                <p><?php echo $_SESSION['center_manager_name']?></p>
                                <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>"
                                    alt="">
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
                            <a href="<?php echo URLROOT?>/centermanagers/request_assigned">
                                <div class="main-right-top-three-content">
                                    <p><b style="color: #1B6652;">Assigned</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="">
                                <div class="main-right-top-three-content">
                                    <p>Completed</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/centermanagers/request_cancelled">
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
                    <?php if(!empty($data['assined_requests'])) : ?>

                    <div class="main-right-bottom" id="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Customer ID</th>
                                    <th>Collector ID</th>
                                    <th>Collector</th>
                                    <th>Request Details</th>
                                    <th>Cancel</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['assined_requests'] as $request) : ?>

                                <tr class="table-row">
                                    <td>R <?php echo $request->req_id?></td>
                                    <td><?php echo $request->date?></td>
                                    <td><?php echo $request->time?></td>
                                    <td><?php echo $request->customer_id?></td>

                                    <td><?php echo $request->collector_id?></td>
                                    <td>
                                        <img onclick="" class="collector_img"
                                            src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $request->image?>"
                                            alt="">
                                    </td>
                                    <td>
                                        <img onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"
                                            class="cancel" src="<?php echo IMGROOT ?>/info.png" alt="">
                                    </td>
                                    <td>
                                        <img onclick="cancel(<?php echo $request->req_id ?>,<?php echo  $request->collector_id ?>)"
                                            class="cancel" src="<?php echo IMGROOT?>/close_popup.png" alt="">
                                    </td>
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
                            <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                            <h1>You have No Assinged Requests</h1>
                            <p>Assigned requests will be appeared as soon as you assign collectors</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="cancel-confirm" id="cancel-confirm">
                <form class="cancel-confirm-content" id="cancel-form" method="post"
                    action="<?php echo URLROOT?>/centermanagers/assinged_request_cancell">
                    <div class="cancel-confirm-top-close">
                        <img class="View-content-img" src="<?php echo IMGROOT?>/close_popup.png" id="cancel-pop">
                    </div>
                    <h1>Cancel the Request?</h1>
                    <img class="cancel-confirm-content-warning" src="<?php echo IMGROOT?>/warning.png" alt="">
                    <input name="reason" type="text" placeholder="Input the Reason">
                    <input name="id" type="text">
                    <input name="collector_id" id="collector_id" type="text">
                    <button onclick="validateCancelForm()" id="cancel-pop" style="background-color: tomato;">OK</button>
                </form>

            </div>
            <div class="personal-details-popup-box" id="personal-details-popup-box">
                <div class="personal-details-popup-form" id="popup">
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="personal-details-popup-form-close"
                        id="personal-details-popup-form-close">
                    <center>
                        <div class="personal-details-topic">Request ID R<div id="req_id"></div>
                        </div>
                    </center>

                    <div class="personal-details-popup">
                        <div class="personal-details-left">
                            <img id="collector_profile_img" src="<?php echo IMGROOT?>/img_upload/collector/?>"
                                class="profile-pic" alt="">
                            <p>Collector ID: <span id="collector_id">C<?php?></span></p>
                        </div>
                        <div class="personal-details-right">
                            <div class="personal-details-right-labels">
                                <span>Name</span><br>
                                <span>Contact No</span><br>
                                <span>Vehicle No</span><br>
                                <span>Vehicle Type</span><br>

                            </div>
                            <div class="personal-details-right-values">
                                <span id="collector_name"></span><br>
                                <span id="collector_conno"></span><br>
                                <span id="collector_vehicle_no"></span><br>
                                <span id="collector_vehicle_type"></span><br>
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
                            <span id="req_id2">23</span><br>
                            <span id="req_name">23</span><br>
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
function cancel(id, collector_id) {
    var inputElement = document.querySelector('input[name="id"]');
    inputElement.style.display = 'none';
    var collector_id = document.getElementById('collector_id');
    collector_id.style.display = 'none';

    inputElement.value = id;
    collector_id.value = collector_id;

    document.getElementById("cancel-confirm").style.display = "flex"
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

        if (time.includes(input) || id.includes(input) || date.includes(input) || customer.includes(input) ||
            cid.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });

}

function validateCancelForm() {
    var reasonInput = document.getElementsByName("reason")[0].value;

    if (reasonInput.trim() === "" || reasonInput.split(/\s+/).length > 200) {
        alert("Please enter a reason");
    } else {
        document.getElementById("cancel-form").submit();
    }
}

function view_collector(image, col_id, name, contact_no, type, vehno, request_id) {
    document.getElementById('personal-details-popup-box').style.display = 'flex';
    document.getElementById('collector_profile_img').src = '<?php echo IMGROOT ?>/img_upload/collector/' + image;
    document.getElementById('collector_id').innerText = col_id;
    document.getElementById('collector_name').innerText = name;
    document.getElementById('collector_conno').innerText = contact_no;
    document.getElementById('collector_vehicle_no').innerText = vehno;
    document.getElementById('collector_vehicle_type').innerText = type;
    document.getElementById('req_id').innerText = request_id;
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


function initMap() {
    var map = new google.maps.Map(document.getElementById('map-loaction'), {
        center: {
            lat: 7.8731,
            lng: 80.7718
        },
        zoom: 14.5
    });

    var incomingRequests = <?php echo $data['jsonData']; ?>;
    incomingRequests.forEach(function(coordinate) {
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat(coordinate.lat),
                lng: parseFloat(coordinate.longi)
            },
            map: map,
        });
        marker.addListener('click', function() {
            view_collector(coordinate.image, coordinate.collector_id, coordinate.name, coordinate
                .contact_no, coordinate.vehicle_no, coordinate.vehicle_type, coordinate.req_id);
        });
    });
}

function loadLocations() {
    var selectedDate = document.getElementById('selected-date').value;
    if (selectedDate.trim() !== "") {
        updateMapForDate(selectedDate);

        var rows = document.querySelectorAll('.table-row');
        rows.forEach(function(row) {
            console.log('d');
            var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            if (date.includes(selectedDate)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    } else {
        var rows = document.querySelectorAll('.table-row');
        rows.forEach(function(row) {

            row.style.display = '';

        });

        var map = new google.maps.Map(document.getElementById('map-loaction'), {
            center: {
                lat: 7.8731,
                lng: 80.7718
            },
            zoom: 7.2
        });

        var incomingRequestsForDate = <?php echo $data['jsonData']; ?>;

        incomingRequestsForDate.forEach(function(coordinate) {
            var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(coordinate.lat),
                    lng: parseFloat(coordinate.longi)
                },
                map: map,
                title: 'Marker'
            });

            marker.addListener('click', function() {
                handleMarkerClick(marker);
            });
        });
    }
}

function updateMapForDate(selectedDate) {
    var map = new google.maps.Map(document.getElementById('map-loaction'), {
        center: {
            lat: 7.8731,
            lng: 80.7718
        },
        zoom: 7.2
    });

    var incomingRequestsForDate = <?php echo $data['jsonData']; ?>;
    var filteredRequests = incomingRequestsForDate.filter(function(coordinate) {
        return coordinate.date === selectedDate;
    });

    filteredRequests.forEach(function(coordinate) {
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat(coordinate.lat),
                lng: parseFloat(coordinate.longi)
            },
            map: map,
            title: 'Marker'
        });

        marker.addListener('click', function() {
            handleMarkerClick(marker);
        });
    });
}
document.addEventListener("DOMContentLoaded", function() {

    const closeButton = document.getElementById("cancel-pop");
    const popup = document.getElementById("cancel-confirm");
    const close_collector_pop = document.getElementById("personal-details-popup-form-close");
    const closeassign = document.getElementById("cancel-assing");
    const assign = document.getElementById("View");

    const maps = document.getElementById("maps");
    const table = document.getElementById("tables");
    const main_right_bottom = document.getElementById("main-right-bottom");
    const main_right_bottom_two = document.getElementById("main-right-bottom-two");
    const close_request_details = document.getElementById("request-details-pop-form-close");

    maps.addEventListener("click", function() {
        if (main_right_bottom !== null) {
            main_right_bottom.style.display = "none";
        }
        if (main_right_bottom_two !== null) {
            main_right_bottom_two.style.display = "flex";
        }
        maps.style.backgroundColor = "#ecf0f1";
        table.style.backgroundColor = "";
    });

    table.addEventListener("click", function() {
        if (main_right_bottom !== null) {
            main_right_bottom.style.display = "flex";
        }
        if (main_right_bottom_two !== null) {
            main_right_bottom_two.style.display = "none";
        }
        table.style.backgroundColor = "#ecf0f1";
        maps.style.backgroundColor = "";

    });

    close_collector_pop.addEventListener("click", function() {
        document.getElementById('personal-details-popup-box').style.display = "none";
    });

    closeButton.addEventListener("click", function() {
        popup.style.display = "none";
    });

    close_request_details.addEventListener("click", function() {
        document.getElementById('request-details-popup-box').style.display = "none";
    });
});

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>