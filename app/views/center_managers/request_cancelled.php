<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
    </script>

    <div class="CenterManager_Request_Main">
        <div class="CenterManager_Request_Cancelled">
            <div class="main">
                <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
                <div class="main-right">
                    <?php require APPROOT . '/views/center_managers/centermanager_requests/requests_top_bar.php'; ?>

                    <?php if(!empty($data['cancelled_request'])) : ?>
                    <div class="main-right-bottom" id="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Customer ID</th>
                                    <th>Cancelled By</th>
                                    <th>Location</th>
                                    <th>Request Details</th>
                                    <th>Reason</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['cancelled_request'] as $request) : ?>
                                <tr class="table-row" id="table-row">
                                    <td>R<?php echo $request->req_id?></td>
                                    <td><?php  echo $request->date?></td>
                                    <td><?php  echo $request->time?></td>
                                    <td><?php  echo $request->customer_id?></td>
                                    <td><?php  if ($request->cancelled_by === 'Me') {
                                  echo 'Customer';
                                } else {
                                  if (empty($request->collector_id)){
                                    echo $request->cancelled_by;
                                  }
                                  else{
                                    echo 'Collector '.$request->collector_id;
                                  }
                                }?>
                                    </td>
                                    <td><img onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"
                                            class="add" src="<?php echo IMGROOT?>/location.png" alt=""></td>
                                    <td><img onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"
                                            class="add" src="<?php echo IMGROOT?>/info.png" alt=""></td>
                                    <td><?php  echo $request->reason?></td>



                                </tr>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-content">
                            <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                            <h1>You have No Cancelled Requests</h1>
                            <p>Cancelled requests will be appeared as soon as you cancel a request</p>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>

                <div class="location_pop">
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
    document.querySelector('.location_pop').style.display = 'flex';
}

function closemap() {
    document.querySelector('.location_pop').style.display = 'none';

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


document.getElementById('searchInput').addEventListener('input', searchTable);

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

document.addEventListener("DOMContentLoaded", function() {
    const close_request_details = document.getElementById("request-details-pop-form-close");

    close_request_details.addEventListener("click", function() {
        document.getElementById('request-details-popup-box').style.display = "none";
    });
});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>