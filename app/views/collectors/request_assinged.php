<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">

    <div class="Collector_Request_Top">
        <div class="Collector_Reuqest_Assigned">
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
                            <a href="">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">Assigned</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/collectors/request_completed">
                                <div class="main-right-top-three-content">
                                    <p>Completed</p>
                                    <div class="line1"></div>
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

                                <div class="main-right-top-four-component"
                                    style="background-color: var(--request-top-color);" id="tables">
                                    <!-- <img src="<?php echo IMGROOT?>/cells.png" alt=""> -->
                                    <i class='bx bx-table' style="color:var(--main-text-color); font-size: 23px;"></i>
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
                    <?php if(!empty($data['assigned_requests'])) : ?>
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
                                        <th>Status</th>
                                        <th>Cancel</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">

                                <table class="table">
                                    <?php foreach($data['assigned_requests'] as $request) : ?>
                                    <tr class="table-row">
                                        <td>R<?php echo $request->req_id?></td>
                                        <td><?php  echo $request->date?></td>
                                        <td><?php  echo $request->time?></td>

                                        <td> <i class='bx bx-info-circle' style="font-size: 29px"
                                                onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)">
                                            </i></td>
                                        <td> <i class='bx bx-map'
                                                onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"
                                                style="font-size: 29px;"> </i></td>

                                        <td class="cancel-open">
                                            <?php
                                           
                                             if ($request->status== "assinged") {
                                                if ($request->date> date('Y-m-d')) { // Assuming $request->data is in 'Y-m-d' format
                                                    echo '<i class="fa-solid fa-arrow-up-right-dots"></i>';
                                                } else {
                                                    echo '<i onclick="ontheway(' . $request->req_id . ')" class="fa-solid fa-arrow-up-right-dots"></i>';
                                                }

                                            } else {
                                            echo '<a
                                                href="' . URLROOT . '/Collectors/enterWaste_And_GenerateEcoCredits/' . $request->req_id . '">
                                                <i  class="fa-solid fa-check-circle"></i>
                                            </a>';
                                            }
                                            ?>

                                        </td>
                                        <td>

                                            <i onclick="<?php echo ($request->status == "assinged") ? 'cancel2(' . $request->req_id . ')' : 'cancel(' . $request->req_id . ')'; ?>"
                                                class='bx bx-x-circle' style="font-size: 29px; color:#DC2727;"> </i>


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
                            <img src="<?php echo IMGROOT?>/undraw_questions_re_1fy7.svg" alt="">
                            <h1>You have No cancel Requests</h1>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>


                <?php if($data['success']=='True') : ?>

                <div class="complain_success" style="">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Complain has been reported successfully</p>
                        <a href="<?php echo URLROOT?>/collectors/history_complains"><button
                                type="button">OK</button></a>


                    </div>
                </div>
                <?php endif; ?>

                <?php if($data['popup']=='True') : ?>
                <div class="personal-details-popup-box" id="personal-details-popup-box">
                    <div class="personal-details-popup-form" id="popup">
                        <div class="form-container">
                            <div class="form-title">Eco Credits Calculation</div>
                            <form id="myForm"
                                action="<?php echo URLROOT;?>/collectors/enterWaste_And_GenerateEcoCredits/<?php echo  $data['req_id']?>"
                                class="main-right-bottom-content" method="post">
                                <div class="user-details">
                                    <div class="user-details-cont">
                                        <?php foreach($data['types'] as $type) : ?>
                                        <div class="main-right-bottom-content-content">
                                            <span class="details"><?php echo ucfirst($type->name); ?></span>
                                            <div class="input-container">
                                                <i class="<?php echo $type->icon?>"></i>
                                                <input name="<?php echo $type->name?>_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg"
                                                    value="<?php echo $data["{$type->name}_quantity"]; ?>">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data["{$type->name}_quantity_err"]?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>

                                    </div>

                                    <div class="wide-note">
                                        <div class="main-right-bottom-content-content A">
                                            <span class="details">Note</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-sticky-note"></i>
                                                <input name="note" class="note-input" type="text"
                                                    placeholder="Enter Note" value="<?php echo $data['note']; ?>">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['note_err']?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input style="visibility:hidden" id="verification" name="verification">

                                <div class="form-button">
                                    <button type="submit" onclick="handleFormSubmission()">Calculate Eco
                                        Credits</button>
                                    <a href="<?php echo URLROOT?>/collectors/request_assinged"><button type="button"
                                            class="cancel-button">Cancel</button></a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="popup-background" id="ecoCreditsPopup" style="display: none;">
                    <div class="popup-content">
                        <h2>Calculated Eco Credits</h2>
                        <p>Eco Credits: <span id="calculatedEcoCredits"></span></p>
                        <button id="okButtonEcoCredits" onclick="closeCalculatedCreditsPopup()">OK</button>
                    </div>
                </div>

                <?php if($data['popup_confirm_collect']=='True') : ?>
                <div class="pop_up_confirm_collect">
                    <div class="pop_up_confirm_collect_cont">
                        <h1>Credit Calculation</h1>
                        <div class="cont">
                            <h5></h5>
                            <h6>Kg</h6>
                            <h6></h6>
                            <h6>
                                Credits
                            </h6>
                            <h6></h6>
                            <h6>
                            </h6>

                        </div>
                        <div class="details">


                            <?php foreach($data['creditData'] as $type) : ?>
                            <div class="cont">
                                <h5><?php echo $type->name; ?></h5>
                                <h6><?php echo empty($data[$type->name . '_quantity']) ? 0 : $data[$type->name . '_quantity']; ?>
                                </h6>
                                <h6>*</h6>
                                <h6><?php echo $type->credits_per_waste_quantity; ?></h6>
                                <h6>=</h6>
                                <h6><?php echo floatval($data[$type->name . '_quantity']) * $type->credits_per_waste_quantity; ?>
                                </h6>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <h4>Total = <?php echo $data['credit_Amount']?></h4>
                        <input type="text" id="visibleinput" placeholder="Enter the Verfication Code">
                        <div class="err">
                            <p><?php echo $data['verification_err']?></p>
                        </div>

                        <div class="buttons">
                            <button class="complete-btn"
                                onclick="submitForm(<?php echo $data['req_id']?>)">Complete</button>
                            <a
                                href="<?php echo URLROOT?>/collectors/request_pop_cancel/<?php echo $data['req_id']?>/<?php echo True?>">
                                <button class="cancel-btn" type="button">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>

                <?php endif; ?>


                <form class="on_the_way" id="ontheway" action="<?php echo URLROOT?>/collectors/request_ontheway"
                    method="post">
                    <div class="content">
                        <div class="content-top">
                            <h2>Req ID&nbsp
                            </h2>
                            <h2 id="on_the_way_req_id"></h2>
                        </div>
                        <input type="text" style="visibility: hidden;" id="post_req_id" name="post_req_id">
                        <h3>Mark as On the way</h3>
                        <div class="content-left">
                            <button type="button" onclick="markontheway()" class="left"
                                id="mark-on-the-way">Mark</button>
                            <button type="button" onclick="closemarkontheway()">Cancel</button>
                        </div>
                    </div>
                </form>

                <div class="location_pop" id="location_pop">
                    <div class="location_pop_content">
                        <div class="location_pop_map">

                        </div>
                        <div class="location_close">
                            <button onclick="closemap()">Close</button>
                        </div>
                    </div>
                </div>


                <div class="cancel-confirm" id="cancel-confirm">
                    <form class="cancel-confirm-content" id="cancel-form" method="post"
                        action="<?php echo URLROOT?>/collectors/request_assinged">

                        <h1>Cancel the Request?</h1>
                        <input name="reason" type="text" placeholder="Input the Reason">
                        <input name="id" type="text">
                        <input name="collector_id" id="collector_id" type="text">
                        <h2>Major Reason</h2>
                        <div class="cancel_fine_container">
                            <label>
                                <input type="radio" name="attribute" value="No Response">
                                No Response
                            </label>

                            <label>
                                <input type="radio" name="attribute" value="Unmeasurable">
                                Unmeasurable
                            </label>

                            <label>
                                <input type="radio" name="attribute" value="None">
                                No of the Above
                            </label>
                        </div>
                        <div class="cancel-confirm-button-container">
                            <button type="button" onclick="validateCancelForm()" id="cancel-pop"
                                class="cancel-reason-submit-button">Submit</button>
                            <button type="button" onclick="closecancel()" id="cancel-pop"
                                class="cancel-reason-cancel-button">Cancel</button>
                        </div>

                    </form>

                </div>

                <div class="cancel-confirm" id="cancel-confirm-2">
                    <form class="cancel-confirm-content" id="cancel-form-2" method="post"
                        action="<?php echo URLROOT?>/collectors/request_assinged">

                        <h1>Cancel the Request?</h1>
                        <input name="reason" type="text" placeholder="Input the Reason">
                        <input name="id" id="cancel-req-id-2" type="text">
                        <input name="collector_id" id="collector_id2" type="text">
                        <div class="cancel-confirm-button-container">
                            <button type="button" onclick="validateCancelForm2()" id="cancel-pop"
                                class="cancel-reason-submit-button">Submit</button>
                            <button type="button" onclick="closecancel2()" id="cancel-pop"
                                class="cancel-reason-cancel-button">Cancel</button>
                        </div>

                    </form>

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
function viewLocation($lattitude, $longitude) {
    initMap2($lattitude, $longitude);
    var locationPop = document.getElementById('location_pop');
    locationPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function view_request_details(request) {

    var requestDetails_popup = document.getElementById('request-details-popup-box');
    requestDetails_popup.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

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

function closemap() {
    var locationPop = document.getElementById('location_pop');
    locationPop.classList.remove('active');
    document.getElementById('overlay').style.display = "none";
}

function ontheway($id) {
    var id = document.getElementById('on_the_way_req_id');
    id.textContent = $id;
    var ontheway = document.getElementById('ontheway');
    var id1 = document.getElementById('post_req_id');
    id1.value = $id;
    ontheway.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function markontheway() {
    var form = document.getElementById('ontheway');
    form.submit();
}

function closemarkontheway() {
    var ontheway = document.getElementById('ontheway');
    ontheway.classList.remove('active');
    document.getElementById('overlay').style.display = "none";
}

function cancel($id) {
    var inputElement = document.querySelector('input[name="id"]');
    inputElement.style.display = 'none';
    var collector_id = document.getElementById('collector_id');
    collector_id.style.display = 'none';
    inputElement.value = $id;
    var cancel_popup = document.getElementById('cancel-confirm');
    cancel_popup.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function cancel2($id) {
    var inputElement = document.getElementById('cancel-req-id-2');
    inputElement.style.display = 'none';
    inputElement.value = $id;

    var collector_id = document.getElementById('collector_id2');
    collector_id.style.display = 'none';
    var cancel_popup = document.getElementById('cancel-confirm-2');
    cancel_popup.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function validateCancelForm() {
    var reasonInput = document.getElementsByName("reason")[0].value;
    var attributeSelected = document.querySelector('input[name="attribute"]:checked');

    if (reasonInput.trim() === "" || reasonInput.split(/\s+/).length > 200) {
        alert("Please enter a reason");
    } else if (!attributeSelected) {
        alert("Please select a major reason");

    } else {
        document.getElementById("cancel-form").submit();
    }
}

function validateCancelForm2() {
    var reasonInput = document.getElementsByName("reason")[1].value;
    if (reasonInput.trim() === "" || reasonInput.split(/\s+/).length > 200) {
        alert("Please enter a reason");
    } else {
        document.getElementById("cancel-form-2").submit();
    }
}

function closecancel2() {
    document.getElementsByName("reason")[1].value = "";
    const popup = document.getElementById("cancel-confirm-2");
    popup.classList.remove('active');
    document.getElementById('overlay').style.display = "none";
}

function closecancel() {
    document.getElementsByName("reason")[0].value = "";
    const popup = document.getElementById("cancel-confirm");
    popup.classList.remove('active');
    document.getElementById('overlay').style.display = "none";
    var radioButton = document.querySelector('input[name="attribute"]:checked');
    if (radioButton) {
        radioButton.checked = false;
    }
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

function initMap() {
    var map = new google.maps.Map(document.getElementById('map-loaction'), {
        center: {
            lat: <?= !empty($data['lattitude']) ? $data['lattitude'] : 6 ?>,
            lng: <?= !empty($data['longitude']) ? $data['longitude'] : 81.00 ?>
        },
        zoom: 11
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
    calculateTSPRoute(map, incomingRequests);
}

function calculateTSPRoute(map, locations) {
    // Use the DirectionsService to get road-based directions between locations
    let directionsService = new google.maps.DirectionsService();
    let minDistance = Infinity;
    let tspRoute;

    // Try starting from each location
    for (let i = 0; i < locations.length; i++) {
        let waypoints = locations.map(location => ({
            location: new google.maps.LatLng(parseFloat(location.lat), parseFloat(location.longi))
        }));

        // Circular permutation to try each starting point
        waypoints = [...waypoints.slice(i), ...waypoints.slice(0, i)];

        let request = {
            origin: waypoints[0].location,
            destination: waypoints[waypoints.length - 1].location,
            waypoints: waypoints.slice(1, -1),
            optimizeWaypoints: true,
            travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, function(response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                let route = response.routes[0];
                let totalDistance = route.legs.reduce((sum, leg) => sum + leg.distance.value, 0);

                if (totalDistance < minDistance) {
                    minDistance = totalDistance;
                    tspRoute = route;
                }
            } else {
                console.error("Directions request failed with status:", status);
            }

            // Draw the TSP route with the best starting point on the map
            if (i === locations.length - 1) {
                let pathCoordinates = [];
                for (let leg of tspRoute.legs) {
                    pathCoordinates.push(...leg.steps.map(step => step.path).flat());
                }

                let path = new google.maps.Polyline({
                    path: pathCoordinates,
                    geodesic: true,
                    strokeColor: "#0000FF",
                    strokeOpacity: 1.0,
                    strokeWeight: 2.5
                });

                path.setMap(map);
            }
        });
    }
}

function initMap2(latitude = 7.4, longitude = 81.00000000) {
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
            lat: <?= !empty($data['lattitude']) ? $data['lattitude'] : 6 ?>,
            lng: <?= !empty($data['longitude']) ? $data['longitude'] : 81.00 ?>
        },
        zoom: selectedDate ? 11 : 11
    });

    var incomingRequestsForDate = <?php echo $data['jsonData']; ?>;
    var filteredRequests;

    if (selectedDate) {
        filteredRequests = incomingRequestsForDate.filter(function(coordinate) {
            return coordinate.date === selectedDate;
        });
    } else {
        filteredRequests = incomingRequestsForDate;
    }

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
    calculateTSPRoute(map, filteredRequests);

}

function submitForm($id) {
    var inputValue = document.getElementById("visibleinput").value;
    document.getElementById("verification").value = inputValue;

    var form = document.getElementById('myForm');
    form.action = "<?php echo URLROOT;?>/collectors/Eco_Credit_Insert/" + $id;
    form.method = 'post';
    form.submit();
}

document.addEventListener("DOMContentLoaded", function() {
    const maps = document.getElementById("maps");
    const table = document.getElementById("tables");
    const main_right_bottom = document.getElementById("main-right-bottom-one");
    const main_right_bottom_two = document.getElementById("main-right-bottom-two");
    const closeButton = document.getElementById("cancel-pop");
    const cancel_popup = document.getElementById("cancel-confirm");
    const cancel_form = document.getElementById("cancel-form");

    const overlay = document.getElementById('overlay');
    const personal_details_popup_box = document.getElementById('personal-details-popup-box');

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
            main_right_bottom.style.display = "grid";
        }
        if (main_right_bottom_two !== null) {
            main_right_bottom_two.style.display = "none";
        }
        table.style.backgroundColor = "#ecf0f1";
        maps.style.backgroundColor = "";

    });

    if (personal_details_popup_box) {
        if (
            <?php echo json_encode($data['popup']); ?> == "True" &&
            <?php echo json_encode($data['popup_confirm_collect']); ?> == "False") {
            personal_details_popup_box.classList.add('active');
            overlay.style.display = "flex";
        }

    }





});

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>