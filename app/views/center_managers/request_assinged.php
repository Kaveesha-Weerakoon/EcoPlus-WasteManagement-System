<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initializeMaps" async defer>
    </script>
    <div class="CenterManager_Request_Main">
        <div class="CenterManager_Request_Assinged">
            <div class="main">
                <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

                <div class="main-right">
                    <?php require APPROOT . '/views/center_managers/centermanager_requests/requests_top_bar.php'; ?>


                    <?php if(!empty($data['assined_requests'])) : ?>

                    <div class="main-right-bottom" id="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Location</th>
                                    <th>Collector info</th>
                                    <th>Request Details</th>
                                    <!-- <th>Cancel</th> -->
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
                                    <td>
                                        <i class='bx bx-map' style="font-size: 29px;"
                                        onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"></i>

                                    </td>
                                    <td class="cancel-open">

                                        <img class="collector_img"
                                            src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $request->image?>"
                                            onclick="view_collector(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)">
                                    </td>
                                    <td>
                                        <i class='bx bx-info-circle' style="font-size: 29px"
                                            onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"></i>

                                    </td>
                                    <!-- <td>
                                        <i class='bx bx-x-circle' style="font-size: 29px; color:#DC2727;"
                                            onclick="cancel(<?php echo $request->req_id ?>,<?php echo  $request->collector_id ?>)"></i>

                                    </td> -->
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

            <div class="location_pop" id="location_pop">
                <div class="location_pop_content">
                    <div class="location_pop_map">

                    </div>
                    <div class="location_close">
                        <button onclick="closemap()">Close</button>
                    </div>
                </div>
            </div>

            <!-- cancel popup -->
            <!-- <div class="cancel-confirm" id="cancel-confirm">
                <form class="cancel-confirm-content" id="cancel-form" method="post"
                    action="<?php echo URLROOT?>/centermanagers/assinged_request_cancell">

                    <h1>Cancel the Request?</h1>
                    <input name="reason" type="text" placeholder="Input the Reason">
                    <input name="id" type="text">
                    <input name="collector_id" id="collector_id" type="text">
                    <div class="cancel-confirm-button-container">
                        <button type="button" onclick="validateCancelForm()" id="cancel-pop"
                            class="cancel-reason-submit-button">Submit</button>
                        <button type="button" onclick="closecancel()" id="cancel-pop"
                            class="cancel-reason-cancel-button">Cancel</button>
                    </div>

                </form>

            </div> -->

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

            <div class="personal-details-popup-box" id="personal-details-popup-box">
                <div class="personal-details-popup-form" id="popup">
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="personal-details-popup-form-close"
                        id="personal-details-popup-form-close">
                    <center>
                        <div class="personal-details-topic">Collector Details</div>
                    </center>

                    <div class="personal-details-popup">
                        <div class="personal-details-left">
                            <img id="collector_profile_img" src="<?php echo IMGROOT?>/img_upload/collector/?>"
                                class="profile-pic" alt="">
                            <p>Collector ID: <span id="col_id">C</span></p>
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
        </div>
    </div>
</div>
<script>
/* Notification View */
document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/request_assigned";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */

// function cancel(id, collector_id) {
//     var inputElement = document.querySelector('input[name="id"]');
//     inputElement.style.display = 'none';
//     var collector_id = document.getElementById('collector_id');
//     collector_id.style.display = 'none';

//     inputElement.value = id;
//     collector_id.value = collector_id;

//     // document.getElementById("cancel-confirm").style.display = "flex"
//     var cancel_popup = document.getElementById('cancel-confirm');
//     cancel_popup.classList.add('active');

//     document.getElementById('overlay').style.display = "flex";

// }

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

// function validateCancelForm() {
//     var reasonInput = document.getElementsByName("reason")[0].value;

//     if (reasonInput.trim() === "" || reasonInput.split(/\s+/).length > 200) {
//         alert("Please enter a reason");
//     } else {
//         document.getElementById("cancel-form").submit();
//     }
//     document.getElementById('overlay').style.display = "none";

// }

function view_collector(request) {
    var Pop = document.getElementById('personal-details-popup-box');
    Pop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
    document.getElementById('collector_profile_img').src = '<?php echo IMGROOT ?>/img_upload/collector/' + request
        .image;
    document.getElementById('col_id').innerText = request.collector_id;
    document.getElementById('collector_name').innerText = request.collector_name;
    document.getElementById('collector_conno').innerText = request.contact_no;
    document.getElementById('collector_vehicle_no').innerText = request.vehicle_no;
    document.getElementById('collector_vehicle_type').innerText = request.vehicle_type;
}

function view_request_details(request) {

    var requestDetails_popup = document.getElementById('request-details-popup-box');
    requestDetails_popup.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    document.getElementById('req_id3').innerText = request.req_id;
    document.getElementById('req_id2').innerText = request.customer_id;
    document.getElementById('req_name').innerText = request.customer_name;
    document.getElementById('req_date').innerText = request.date;
    document.getElementById('req_time').innerText = request.time;
    document.getElementById('req_contactno').innerText = request.customer_contactno;
    document.getElementById('instructions').innerText = request.instructions;

}

function initializeMaps() {
    initMap();
    initLocationPop();
}


function initLocationPop(latitude = 7.4, longitude = 81.00000000) {
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
    initLocationPop($lattitude, $longitude);
    var locationPop = document.getElementById('location_pop');
    locationPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function closemap() {
    var locationPop = document.getElementById('location_pop');
    locationPop.classList.remove('active');
    document.getElementById('overlay').style.display = "none";

}



function initMap() {
    var map = new google.maps.Map(document.getElementById('map-loaction'), {
        center: {
            lat: <?= !empty($data['lattitude']) ? $data['lattitude'] : 6 ?>,
            lng: <?= !empty($data['longitude']) ? $data['longitude'] : 81.00 ?>
        },
        zoom: 9
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
            // view_collector(coordinate.image, coordinate.collector_id, coordinate.name, coordinate
            //     .contact_no, coordinate.vehicle_no, coordinate.vehicle_type, coordinate.req_id);
            view_collector(coordinate);
        });
    });

    var defaultLatLng = {
        lat: <?php echo $data['lattitude'] ?>,
        lng: <?php echo $data['longitude'] ?>
    };

        // Add a circle to the first map
    var circle2 = new google.maps.Circle({
        map: map,
        center: defaultLatLng,
        radius: <?php echo $data['radius']?>,
        fillColor: '#47b076',
        fillOpacity: 0.3,
        strokeColor: '#47b076',
        strokeOpacity: 1,
        strokeWeight: 2
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

// function closecancel() {
//     const popup = document.getElementById("cancel-confirm");

//     popup.classList.remove('active');
//     document.getElementById('overlay').style.display = "none";
// }

document.addEventListener("DOMContentLoaded", function() {

    // const closeButton = document.getElementById("cancel-pop");
    // const popup = document.getElementById("cancel-confirm");
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
        maps.style.backgroundColor = "var(--request-top-color)";
        table.style.backgroundColor = "";
    });

    table.addEventListener("click", function() {
        if (main_right_bottom !== null) {
            main_right_bottom.style.display = "flex";
        }
        if (main_right_bottom_two !== null) {
            main_right_bottom_two.style.display = "none";
        }
        table.style.backgroundColor = "var(--request-top-color)";
        maps.style.backgroundColor = "";

    });

    close_collector_pop.addEventListener("click", function() {
        const collector_view = document.getElementById("personal-details-popup-box");
        collector_view.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

    // closeButton.addEventListener("click", function() {
    //     popup.style.display = "none";
    // });

    close_request_details.addEventListener("click", function() {
       
        var request_popup = document.getElementById("request-details-popup-box");
        request_popup.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });
});

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>