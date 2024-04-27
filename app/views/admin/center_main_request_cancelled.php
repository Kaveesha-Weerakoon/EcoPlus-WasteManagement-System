<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
        </script>

        <div class="Admin_Center_Main_Request_Cancelled">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">

                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <a
                                href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                                <div class="main-right-top-back-button">
                                    <i class='bx bxs-chevrons-left'></i>
                                </div>
                            </a>
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>

                            <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                        </div>
                        <div class="main-right-top-two">
                            <h1>Requests</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/Admin/incoming_requests/<?php echo $data['center_region']?>"
                                id="incoming">

                                <div class="main-right-top-three-content" id="current">
                                    <p>Incoming</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/assigned_requests/<?php echo $data['center_region']?>"
                                id="assigned">
                                <div class="main-right-top-three-content">
                                    <p>Assigned</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/Admin/completed_requests/<?php echo $data['center_region']?>"
                                id="completed">
                                <div class="main-right-top-three-content">
                                    <p>Completed</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/cancelled_requests/<?php echo $data['center_region']?>"
                                id="cancelled">
                                <div class="main-right-top-three-content">
                                    <p>Cancelled</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Customer ID</th>
                                    <th>Location</th>
                                    <th>Request details</th>
                                    <th>Refund</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['cancelled_requests'] as $cancelled_requests) : ?>
                                <tr class="table-row">
                                    <td><?php echo $cancelled_requests->req_id?></td>
                                    <td><?php echo $cancelled_requests->date?></td>
                                    <td><?php echo $cancelled_requests->time?></td>
                                    <td><?php echo $cancelled_requests->customer_id?></td>


                                    <td><i onclick="viewLocation(<?php echo $cancelled_requests->lat; ?>, <?php echo $cancelled_requests->longi; ?>)"
                                            class='bx bx-map' style="font-size: 29px;"></i></td>
                                    <td><i onclick="view_request_details(<?php echo htmlspecialchars(json_encode($cancelled_requests), ENT_QUOTES, 'UTF-8') ?>)"
                                            class='bx bx-info-circle' style="font-size: 29px"></i>
                                    </td>
                                    <td>
                                        <?php
                                            if ($cancelled_requests->fine == 0) {
                                                 echo '<i class="fa-solid fa-ban"></i>';
                                            } else {
                                                echo '<i class="fa-solid fa-rotate-left" onclick="revert(' . $cancelled_requests->req_id . ')"></i>';
                                            }
                                        ?>
                                    </td>




                                </tr>
                                <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="overlay" id="overlay"></div>

                    <div class="location_pop" id="location_pop">
                        <div class="location_pop_content">
                            <div class="location_pop_map">

                            </div>
                            <div class="location_close">
                                <button onclick="closemap()">Close</button>
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
                            <span>Cancelled By</span><br>
                            <span>Cancelled Time</span><br>
                            <span>Reason</span><br>


                        </div>
                        <div class="request-details-right-values">
                            <span id="req_id2"></span><br>
                            <span id="req_name"></span><br>
                            <span id="req_date"></span><br>
                            <span id="req_time"></span><br>
                            <span id="req_contactno"></span><br>
                            <span id="instructions"></span><br>
                            <span id="cancelled_by"></span><br>
                            <span id="cancelled_time"></span><br>
                            <span id="reason"></span><br>

                        </div>
                    </div>
                </div>
            </div>
            <div class="delete_confirm" id="cancel_confirm">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                    <h2>Refund the Fine?</h2>
                    <p>This action refund the fine</p>
                    <div class="btns">
                        <a id="cancelLink"><button type="button" class="deletebtn">Confirm</button></a>
                        <a id="close_cancel"><button type="button" class="cancelbtn">Cancel</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
function initMap(latitude, longitude) {
    var mapCenter = {
        lat: latitude,
        lng: longitude
    };

    var map = new google.maps.Map(document.querySelector('.location_pop_map'), {
        center: mapCenter,
        zoom: 15
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

function revert(id) {
    var newRequestId = id;
    var newURL = "<?php echo URLROOT?>/admin/refund/" + newRequestId;
    document.getElementById('cancelLink').href = newURL;
    document.getElementById('overlay').style.display = "flex";

    document.getElementById('cancel_confirm').classList.add('active');
}
document.addEventListener("DOMContentLoaded", function() {
    const close_cancel = document.getElementById("close_cancel");
    close_cancel.addEventListener("click", function() {
        document.getElementById('cancel_confirm').classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });
});


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

function view_request_details(request) {
    var personalPop = document.getElementById('request-details-popup-box');
    personalPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    //document.getElementById('request-details-popup-box').style.display = "flex";
    document.getElementById('req_id3').innerText = request.req_id;
    document.getElementById('req_id2').innerText = request.customer_id;
    document.getElementById('req_name').innerText = request.name;
    document.getElementById('req_date').innerText = request.date;
    document.getElementById('req_time').innerText = request.time;
    document.getElementById('req_contactno').innerText = request.contact_no;
    document.getElementById('instructions').innerText = request.instructions;
    document.getElementById('cancelled_by').innerText = request.cancelled_by;
    document.getElementById('cancelled_time').innerText = request.cancelled_time;

    document.getElementById('reason').innerText = request.reason;

}

document.addEventListener("DOMContentLoaded", function() {
    const close_request_details = document.getElementById("request-details-pop-form-close");

    close_request_details.addEventListener("click", function() {
        //document.getElementById('request-details-popup-box').style.display = "none";
        const request_details = document.getElementById("request-details-popup-box");
        request_details.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

});

function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');
    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var status = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
        var date = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
        var time = row.querySelector('td:nth-child(4').innerText.toLowerCase();

        if (time.includes(input) || id.includes(input) || status.includes(input) || date
            .includes(
                input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });

}

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>