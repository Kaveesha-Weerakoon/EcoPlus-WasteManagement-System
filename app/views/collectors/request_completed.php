<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_Request_Top">
        <div class="Collector_request_completed">
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
                                    <p><b style="color: #1B6652;">Completed</b></p>
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
                                            <th>Complete</th>
                                            <th>Credits</th>
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
                                            <td><img onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"
                                                    src="<?php echo IMGROOT?>/view.png" alt=""></td>
                                            <td><?php  echo $request->credit_amount?></td>
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

                    <div class="request-details-pop" id="request-details-popup-box">
                        <div class="request-details-pop-form">
                            <img src="<?php echo IMGROOT?>/close_popup.png" alt=""
                                class="request-details-pop-form-close" id="request-details-pop-form-close">
                            <div class="request-details-pop-form-top">
                                <div class="request-details-topic">Request ID R <div id="req_id3"></div>
                                </div>
                            </div>

                            <div class="request-details-pop-form-content">
                                <div class="personal-details-right-labels">
                                    <span>Polythene Quantity :-</span><br>
                                    <span>Plastic Quantity :-</span><br>
                                    <span>Glass Quantity :-</span><br>
                                    <span>Paper Waste Quantity :-</span><br>
                                    <span>Electronic Waste Quantity :-</span><br>
                                    <span>Metals Quantity :-</span><br>
                                    <span>Note :-</span><br>
                                </div>
                                <div class="personal-details-right-values">
                                    <span id="Polythene_Quantity"></span><br>
                                    <span id="Plastic_Quantity">23</span><br>
                                    <span id="Glass_Quantity">23</span><br>
                                    <span id="Paper_Waste_Quantity"></span><br>
                                    <span id="Electronic_Waste_Quantity"></span><br>
                                    <span id="Metals_Quantity"></span><br>
                                    <span id="Note"></span><br>
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
function initMap() {
    var map = new google.maps.Map(document.getElementById('map-loaction'), {
        center: {
            lat: 7.8731,
            lng: 80.7718
        },
        zoom: 14.5
    });;
    var incomingRequests = <?php echo $data['jsonData']; ?>;
    incomingRequests.forEach(function(coordinate) {
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat(coordinate.lat),
                lng: parseFloat(coordinate.longi)
            },
            map: map,
            title: 'Marker'
        });
        marker.addListener('click', function() {
            handleMarkerClick(marker, coordinate);
        });
    });
}

function view_request_details(request) {
    document.getElementById('request-details-popup-box').style.display = "flex";
    document.getElementById('Polythene_Quantity').innerText = request.Polythene;
    document.getElementById('Plastic_Quantity').innerText = request.Plastic;
    document.getElementById('Glass_Quantity').innerText = request.Glass;
    document.getElementById('Paper_Waste_Quantity').innerText = request.Paper_Waste;
    document.getElementById('Electronic_Waste_Quantity').innerText = request.Electronic_Waste;
    document.getElementById('Metals_Quantity').innerText = request.Metals;
    document.getElementById('Note').innerText = request.note;
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

function handleMarkerClick(marker, coordinate) {
    const adddetails = document.getElementById("View");
    var assign_reqid = document.getElementById('assign_reqid');
    assign_reqid.innerHTML = coordinate.req_id;
    adddetails.style.display = "flex";
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
    const maps = document.getElementById("maps");
    const table = document.getElementById("tables");
    const main_right_bottom = document.getElementById("main-right-bottom-one");
    const main_right_bottom_two = document.getElementById("main-right-bottom-two");
    const closeButton = document.getElementById("cancel-pop");
    const cancel_popup = document.getElementById("cancel-confirm");
    const cancel_form = document.getElementById("cancel-form");
    const btns = document.getElementById("btns");

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

    closeButton.addEventListener("click", function() {
        cancel_form.style.width = "0px";
        cancel_form.style.height = "0px";
        cancel_popup.style.display = "none";
        btns.style.display = "none";
        document.querySelector("#cancel-confirm img").style.display = "none";
        document.querySelector("#cancel-confirm h2").style.display = "none";
        document.querySelector("#cancel-confirm input").style.display = "none";
        document.querySelector("#cancel-confirm p").style.display = "none";
    });

});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>