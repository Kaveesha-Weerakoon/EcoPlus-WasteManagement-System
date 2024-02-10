<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Request_Main">
        <div class="CenterManager_Request_Incomming">


            <div class="main">
                <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

                <div class="main-right">

                    <?php require APPROOT . '/views/center_managers/centermanager_requests/requests_top_bar.php'; ?>


                    <?php if(!empty($data['incoming_requests'])) : ?>
                    <div class="main-right-bottom" id="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Request details</th>
                                    <th>Assign</th>
                                    <th>Cancel</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['incoming_requests'] as $request) : ?>
                                <tr class="table-row">
                                    <td>R<?php echo $request->req_id?></td>
                                    <td><?php  echo $request->name?></td>
                                    <td><?php  echo $request->date?></td>
                                    <td><?php  echo $request->time?></td>

                                    <td>
                                        <i class='bx bx-info-circle' style="font-size: 29px"
                                            onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"></i>
                                    </td>
                                    <td>
                                        <i class='bx bxs-user-check' style="font-size: 32px;"
                                            onclick="assign(<?php echo $request->req_id ?>, '<?php echo htmlspecialchars($request->date, ENT_QUOTES, 'UTF-8')?>')"></i>

                                    </td>
                                    <td>
                                        <i class='bx bx-x-circle' style="font-size: 29px; color:#DC2727;"
                                            onclick="cancel(<?php echo $request->req_id ?>)"></i>

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
                    <?php else: ?>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-content">
                            <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                            <h1>You Have No Incomming Requests</h1>
                            <p>Incomming requests will be appeared as soon as customer requests</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>


                <div class="cancel-confirm" id="cancel-confirm">
                    <form class="cancel-confirm-content" id="cancel-form" method="post"
                        action="<?php echo URLROOT?>/centermanagers/request_cancell">
                        <!-- <img class="confirm-content-img" src="<?php echo IMGROOT?>/close_popup.png" id="cancel-pop"> -->
                        <h1>Cancel the Request?</h1>
                        <input name="reason" type="text" placeholder="Input the Reason">
                        <input name="id" type="text">
                        <div class="cancel-confirm-button-container">
                            <button type="button" onclick="validateCancelForm()" id="cancel-pop"
                                class="cancel-reason-submit-button">Submit</button>
                            <button type="button" onclick="closecancel()" id="cancel-pop"
                                class="cancel-reason-cancel-button">Cancel</button>
                        </div>

                    </form>

                </div>

                <div class="overlay" id="overlay"></div>

                <div class="View" id="View">

                    <form class="View-content" id="assignForm" method="post"
                        action="<?php echo URLROOT?>/centermanagers/assing">
                        <img class="View-content-img" src="<?php echo IMGROOT?>/close_popup.png" id="cancel-assing">
                        <h2>Assign a Collector</h2>
                        <hr class="assign-line">
                        <div class="view_assing_middle">
                            <h3>Req ID: <b>R <div id="assign_req_id" style="display: inline;"></div></b></h3>
                        </div>
                        <input name="assign_req_id" type="text" id="assign_req_id" style="display: none;">

                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownToggle" aria-haspopup="true" aria-expanded="false">
                                Select a Collector
                                <span class="arrow-down"></span>
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="dropdownToggle">
                                <?php
                                     $collectors = $data['collectors'];
                                     $assigned_requests_count = $data['assigned_requests_count'];
                                     if (!empty($collectors)) {
                                     foreach ($collectors as $collector) {
                                           $request_count = isset($assigned_requests_count[$collector->id]) ? $assigned_requests_count[$collector->id] : 0;
                                               echo "<li class=\"dropdown-item\" data-id=\"$collector->id\">
                                               <img src=\"" . IMGROOT . "/img_upload/collector/$collector->image\"  > 
                                               <span class=\"collector-id\">C$collector->id</span>
                                                <span class=\"collector-name\">$collector->name</span>
                                                <span class=\"vehicle-type\">$collector->vehicle_type</span>
                                                </li>";
                             }
                         }else {
                                 echo "<li>No Collectors Available</li>";
                              }
                          ?>
                            </ul>
                        </div>

                        <!-- Hidden input field to store the selected collector's ID -->
                        <input type="hidden" name="selected_collector_id" id="selected_collector_id">

                        <div class="assigned-req-count-container">
                            <p>Number of Assigned requests for the requested date:</p>
                            <span id="request_count"></span>
                            <input name="requested_date" type="text" id="requested_date" >
                        </div>

                        <div class="assigned-map-container"></div>

                        <button type="button" onclick="assing_complete()">Assign</button>
                    </form>

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


            <script>
            function validateCancelForm() {
                var reasonInput = document.getElementsByName("reason")[0].value;

                if (reasonInput.trim() === "" || reasonInput.split(/\s+/).length > 200) {
                    alert("Please enter a reason");
                } else {
                    document.getElementById("cancel-form").submit();
                    closecancel();
                }
            }

            var selectedCollectorId = 0;
            var requestCount = document.getElementById('request_count');
            requestCount.innerHTML = 0;
            


            var dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    selectedCollectorId = this.getAttribute('data-id');
                    selected_collector_id.value = selectedCollectorId;

                    var requestDate= document.getElementById('requested_date').value;
                    console.log(requestDate);
                    var request = <?php echo json_encode($data['assigned_requests']); ?>;
                    var count = 0;
                    for (let req_id in request) {
                        if (request.hasOwnProperty(req_id)) {
                            //console.log(request[req_id].date);
                            if (request[req_id].collector_id == selectedCollectorId && request[req_id].date == requestDate) {
                                
                                count++;
                            };
                        }
                    }
                    requestCount.innerHTML = count;

                });
            });

            


            function assing_complete() {
                var assignForm = document.getElementById('assignForm');

                if (selectedCollectorId == null) {
                    alert('Please select a collector before assigning.');
                } else {
                    assignForm.submit();
                }
            }

            function assign(id, requestedDate) {
                var inputElement = document.querySelector('input[name="assign_req_id"]');

                inputElement.value = id;

                inputElement.style.display = 'none';

                var assign_reqid = document.getElementById('assign_req_id');
                assign_reqid.innerHTML = id;

                var dateInput = document.querySelector('input[name="requested_date"]');
                dateInput.value = requestedDate;
                dateInput.style.display = 'none';

                // var request_date = document.getElementById('requested_date');
                // request_date.innerHTML = requestedDate;

                var assign_popup = document.getElementById('View');
                assign_popup.classList.add('active');

                document.getElementById('overlay').style.display = "flex";

            }


            function cancel($id) {
                var inputElement = document.querySelector('input[name="id"]');
                inputElement.style.display = 'none';
                inputElement.value = $id;
                // document.getElementById('cancel-confirm').style.display = "flex";
                var cancel_popup = document.getElementById('cancel-confirm');
                cancel_popup.classList.add('active');

                document.getElementById('overlay').style.display = "flex";
            }

            function initMap() {
                var map = new google.maps.Map(document.getElementById('map-loaction'), {
                    center: {
                        lat: 7.8731,
                        lng: 80.7718
                    },
                    zoom: 7.2
                });

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

            function handleMarkerClick(marker, coordinate) {
                const adddetails = document.getElementById("View");
                var assign_reqid = document.getElementById('assign_reqid');
                /*assign_reqid.innerHTML = coordinate.req_id;*/
                assign(coordinate.req_id)
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

                    if (time.includes(input) || id.includes(input) || date.includes(input) || customer.includes(
                            input) || cid.includes(input) || conctact_no.includes(input) || instructions
                        .includes(input)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
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

            function closecancel() {
                const popup = document.getElementById("cancel-confirm");

                popup.classList.remove('active');
                document.getElementById('overlay').style.display = "none";
            }

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

            document.addEventListener("DOMContentLoaded", function() {

                const closeButton = document.getElementById("cancel-pop");
                const popup = document.getElementById("cancel-confirm");

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


                closeButton.addEventListener("click", function() {

                    console.log('as');
                });

                closeassign.addEventListener("click", function() {
                    assign.classList.remove('active');
                    document.getElementById('overlay').style.display = "none";
                    // assign.style.display = "none";
                });

                close_request_details.addEventListener("click", function() {
                    var request_popup = document.getElementById("request-details-popup-box");
                    request_popup.classList.remove('active');
                    document.getElementById('overlay').style.display = "none";
                });


            });

            document.addEventListener('DOMContentLoaded', function() {
                const dropdownToggle = document.getElementById('dropdownToggle');
                const dropdownMenu = document.querySelector('.dropdown-menu');
                const dropdownItems = dropdownMenu.querySelectorAll('li');

                dropdownToggle.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('show');
                });

                dropdownItems.forEach(function(item) {
                    item.addEventListener('click', function() {
                        dropdownToggle.textContent = this.textContent;
                        dropdownMenu.classList.remove('show');
                    });
                });

                document.addEventListener('click', function(event) {
                    if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event
                            .target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            });



            document.getElementById('searchInput').addEventListener('input', searchTable);
            </script>

        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>