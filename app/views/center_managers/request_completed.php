<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
    </script>

    <div class="CenterManager_Request_Main">
        <div class="CenterManager_Request_Completed">
            <div class="main">
                <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
                <div class="main-right">
                    <?php require APPROOT . '/views/center_managers/centermanager_requests/requests_top_bar.php'; ?>

                    <?php if(!empty($data['completed_requests'])) : ?>
                    <div class="main-right-bottom" id="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <!-- <th>Customer</th> -->
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Request details</th>
                                    <th>Collector info</th>
                                    <th>Location</th>
                                    <th>Collection details</th>
                                    <th>Confirmation</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['completed_requests'] as $request) : ?>
                                <tr class="table-row" id="table-row">
                                    <td><?php echo $request->req_id?></td>
                                    <!-- <td><?php  echo $request->customer_name?></td> -->
                                    <td><?php  echo $request->date?></td>
                                    <td><?php  echo $request->time?></td>
                                    <td>
                                        <i class='bx bx-comment-detail' style="font-size: 29px;"
                                            onclick="view_request_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"></i>
                                    </td>
                                    <td class="cancel-open">
                                        <img class="collector_img"
                                            src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $request->collector_image?>"
                                            onclick="view_collector('<?php echo $request->collector_image; ?>', '<?php echo $request->collector_id; ?>', '<?php echo $request->name; ?>', 
                                            '<?php echo $request->collector_contact_no; ?>', '<?php echo $request->collector_vehicle_no; ?>', '<?php echo $request->collector_vehicle_type; ?>')">
                                    </td>
                                    <td>
                                        <i class='bx bx-map' style="font-size: 29px;"
                                            onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"></i>
                                    </td>



                                    <td class="cancel-open">
                                        <i class='bx bx-info-circle' style="font-size: 29px"
                                            onclick="view_collect_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"></i>
                                    </td>
                                    <!-- <td><a href="<?php echo URLROOT?>/centermanagers/confirm_garbage_details/<?php echo $request->req_id?>"><button class="confirm_button">Confirm</button></a></td> -->

                                    <td>
                                        <?php
                                        $type = ($request->added === 'no') ?
                                            '<a href="' . URLROOT . '/centermanagers/confirm_garbage_details/' . $request->req_id . '"><button class="confirm_button">Confirm</button></a>' :
                                            '<button class="confirmed_button" disabled>Confirmed</button>';
                                        echo $type;
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-content">
                            <img src="<?php echo IMGROOT?>/undraw_questions_re_1fy7.svg" alt="">
                            <h1>You have No Completed Requests</h1>
                            <p>Completed requests will be appeared as soon as collector completes it</p>
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

                <div class="collect-details-pop" id="collect-details-popup-box">
                    <div class="collect-details-pop-form">
                        <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="collect-details-pop-form-close"
                            id="collect-details-pop-form-close">
                        <div class="collect-details-pop-form-top">
                            <div class="collect-details-topic">Collection Details
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
                                <h3>Completed Time</h3>
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
                                    <h3 id="completed_time"></h3>
                                </div>
                                <div class="collect-details-pop-form-content-right-values-cont">
                                    <h3 id="Earned_Credits"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overlay" id="overlay"></div>

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
                                <p>Collector ID: <span id="collector_id"></span></p>
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
                            <div class="request-details-topic">Request ID: <div id="req_id3"></div>
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

                <?php if($data['confirm_popup']=='True') : ?>
                <div class="confirm-garbage-popup-box" id="confirm-garbage-popup-box">
                    <div class="confirm-garbage-popup-form" id="popup">
                        <div class="form-container">
                            <div class="form-title">Garbage Details</div>
                            <form
                                action="<?php echo URLROOT;?>/centermanagers/confirm_garbage_details/<?php echo $data['req_id'];?>"
                                class="main-right-bottom-content" method="post">
                                <div class="user-details">
                                    <div class="left-details">
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Polythene</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-trash"></i>
                                                <input name="polythene_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg"
                                                    value="<?php echo $data['polythene_quantity']?>">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['polythene_quantity_err']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Plastic</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-box"></i>
                                                <input name="plastic_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg"
                                                    value="<?php echo $data['plastic_quantity']?>">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['plastic_quantity_err']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Glass</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-glass-whiskey"></i>
                                                <input name="glass_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg"
                                                    value="<?php echo $data['glass_quantity']?>">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['glass_quantity_err']?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-details">
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Paper Waste</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-file-alt"></i>
                                                <input name="paper_waste_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg"
                                                    value="<?php echo $data['paper_waste_quantity']?>">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['paper_waste_quantity_err']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Electronic Waste</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-laptop"></i>
                                                <input name="electronic_waste_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg"
                                                    value="<?php echo $data['electronic_waste_quantity']?>">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['electronic_waste_quantity_err']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-right-bottom-content-content">
                                            <span class="details">Metals</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-box"></i>
                                                <input name="metals_quantity" type="text"
                                                    placeholder="Enter Quantity in Kg"
                                                    value="<?php echo $data['metals_quantity']?>">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['metals_quantity_err']?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wide-note">
                                        <div class="main-right-bottom-content-content A">
                                            <span class="details">Center Manager Note</span>
                                            <div class="input-container">
                                                <i class="icon fas fa-sticky-note"></i>
                                                <input name="note" class="note-input" type="text"
                                                    placeholder="Enter Note" value="<?php echo $data['note']?>">
                                                <div class="error-div" style="color:red">
                                                    <?php echo $data['note_err']?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-button">
                                    <button type="submit">Confirm</button>
                                    <button type="button" class="cancel-button" id="cancelBtn">Cancel</button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($data['confirm_success']=='True') : ?>
                <div class="request_success">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Garbage details updated successfully</p>
                        <a href="<?php echo URLROOT?>/centermanagers/request_completed"><button
                                type="button">OK</button></a>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<script>
/* Notification View */
document.getElementById('submit-notification').onclick = function() {
    var form = document.getElementById('mark_as_read');
    var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/request_completed";
    form.action = dynamicUrl; // Set the action URL
    form.submit(); // Submit the form

};
/* ----------------- */

function view_collector(image, col_id, name, contact_no, type, vehno) {
    var locationPop = document.getElementById('personal-details-popup-box');
    locationPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
    document.getElementById('collector_profile_img').src = '<?php echo IMGROOT ?>/img_upload/collector/' + image;
    document.getElementById('collector_id').innerText = col_id;
    document.getElementById('collector_name').innerText = name;
    document.getElementById('collector_conno').innerText = contact_no;
    document.getElementById('collector_vehicle_no').innerText = vehno;
    document.getElementById('collector_vehicle_type').innerText = type;
}

function view_request_details(request) {

    var requestDetails_popup = document.getElementById('request-details-popup-box');
    requestDetails_popup.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    // document.getElementById('request-details-popup-box').style.display = "flex";
    document.getElementById('req_id3').innerText = request.request_id;
    document.getElementById('req_id2').innerText = request.customer_id;
    document.getElementById('req_name').innerText = request.customer_name;
    document.getElementById('req_date').innerText = request.date;
    document.getElementById('req_time').innerText = request.time;
    document.getElementById('req_contactno').innerText = request.contact_no;
    document.getElementById('instructions').innerText = request.instructions;

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
    document.getElementById('completed_time').innerText = request.completed_datetime;
    document.getElementById('Earned_Credits').innerText = request.credit_amount;
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


document.getElementById('searchInput').addEventListener('input', searchTable);

function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');

    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
        var time = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
   

        if (time.includes(input) || id.includes(input) || date.includes(input) ) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });

}

document.getElementById('searchInput').addEventListener('input', searchTable);
document.addEventListener("DOMContentLoaded", function() {
    const close_collector = document.getElementById("personal-details-popup-form-close");
    const collector_view = document.getElementById("personal-details-popup-box");
    const close_view = document.getElementById("collect-details-pop-form-close");
    const close_request_details = document.getElementById("request-details-pop-form-close");


    close_collector.addEventListener("click", function() {
        collector_view.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

    close_view.addEventListener("click", function() {
        var locationPop = document.getElementById('collect-details-popup-box');
        locationPop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";

    });

    close_request_details.addEventListener("click", function() {
        var request_popup = document.getElementById("request-details-popup-box");
        request_popup.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

});

document.getElementById('cancelBtn').addEventListener('click', function() {
    // Redirect to the specified URL
    window.location.href = "<?php echo URLROOT?>/centermanagers/request_completed";
});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>