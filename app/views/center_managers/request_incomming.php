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
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Customer</th>
                                    <th>C ID</th>
                                    <th>Contact No</th>
                                    <th>Instructions</th>
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
                                    <td><?php  echo $request->date?></td>
                                    <td><?php  echo $request->time?></td>
                                    <td><?php  echo $request->name?></td>
                                    <td><?php  echo $request->customer_id?></td>
                                    <td><?php  echo $request->contact_no?></td>
                                    <td><?php  echo $request->instructions?></td>
                                    <td>
                                        <i class='bx bxs-user-check' style="font-size: 32px;" onclick="assign(<?php echo $request->req_id ?>)"></i>
                                        <!-- <img onclick="assign(<?php echo $request->req_id ?>)" class="add"
                                            src="<?php echo IMGROOT?>/assign.png" alt=""> -->
                                    </td>
                                    <td>
                                        <i class='bx bx-x-circle' style="font-size: 29px; color:#DC2727;"
                                        onclick="cancel(<?php echo $request->req_id ?>)"></i>
                                        <!-- <img onclick="cancel(<?php echo $request->req_id ?>)" class="cancel"
                                            src="<?php echo IMGROOT?>/close_popup.png" alt=""> -->
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

                        <img class="view_assing" src="<?php echo IMGROOT?>/selection.png" alt="">
                        <div class="view_assing_middle">
                            <h3>Req ID: <b>R <div id="assign_reqid" style="display: inline;"></div></b></h3>
                        </div>
                        <input name="assign_req_id" type="text" id="assign_req_id" style="display: none;">
                       

                        <select id="dropdown" name="collectors">
                            <?php
                         $collectors = $data['collectors'];
                         $assigned_requests_count = $data['assigned_requests_count'];
                          if (!empty($collectors)) {
                             foreach ($collectors as $collector) {
                                $request_count = isset($assigned_requests_count[$collector->id]) ? $assigned_requests_count[$collector->id] : 0;
                                //$request_count = $assigned_requests_count[$collector->id] ?? 12;

                                 echo "<option value=\"$collector->id\">C $collector->id $collector->name $collector->vehicle_type <span class=\"assigned_count\">$request_count</span></option>";
                            }
                          } else {
                               echo "<option value=\"default\">No Collectors Available</option>";
                            }
                         ?>

                        </select>

                        <Button type="submit" onclick="assing_complete()">Assign</Button>
                    </form>
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

            function assing_complete() {
                var dropdown = document.getElementById('dropdown');
                var assignForm = document.getElementById('assignForm');
                if (dropdown.value === 'default') {
                    alert('Please select a collector before assigning.');
                } else {
                    assignForm.submit();
                }
            }

            function assign($id) {
                var inputElement = document.querySelector('input[name="id"]');

                var assign_reqid = document.getElementById('assign_req_id');

                assign_reqid.value = $id;

                inputElement.style.display = 'none';

                assign_reqid.innerHTML = $id;

                // document.getElementById("View").style.display = "flex"
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

            document.addEventListener("DOMContentLoaded", function() {

                const closeButton = document.getElementById("cancel-pop");
                const popup = document.getElementById("cancel-confirm");

                const closeassign = document.getElementById("cancel-assing");
                const assign = document.getElementById("View");

                const maps = document.getElementById("maps");
                const table = document.getElementById("tables");
                const main_right_bottom = document.getElementById("main-right-bottom");
                const main_right_bottom_two = document.getElementById("main-right-bottom-two");


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


            });

            document.getElementById('searchInput').addEventListener('input', searchTable);
            </script>

        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>