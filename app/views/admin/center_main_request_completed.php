<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
        </script>

        <div class="Admin_Center_Main_Request_Completed">
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
                                    <th>Customer</th>
                                    <th>Collector Info</th>
                                    <th>Location</th>
                                    <th>Collection details</th>
                                    <th>Confirmation</th>

                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['completed_requests'] as $completed_request) : ?>
                                <tr class="table-row">
                                    <td>R<?php echo $completed_request->req_id?></td>
                                    <td><?php echo $completed_request->date?></td>
                                    <td><?php echo $completed_request->time?></td>
                                    <td><?php echo $completed_request->customer_name?></td>
                                    <td class="cancel-open">
                                        <img class="collector_img"
                                            src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $completed_request->collector_image?>"
                                            onclick="view_collector('<?php echo $completed_request->collector_image; ?>', '<?php echo $completed_request->collector_id; ?>', '<?php echo $completed_request->name; ?>', 
                                            '<?php echo $completed_request->collector_contact_no; ?>', '<?php echo $completed_request->collector_vehicle_no; ?>', '<?php echo $completed_request->collector_vehicle_type; ?>')">
                                    </td>
                                    <td>
                                        <i class='bx bx-map' style="font-size: 29px;"
                                            onclick="viewLocation(<?php echo $completed_request->lat; ?>, <?php echo $completed_request->longi; ?>)"></i>
                                    </td>

                                    <td class="cancel-open">
                                        <i class='bx bx-info-circle' style="font-size: 29px"
                                            onclick="view_collect_details(<?php echo htmlspecialchars(json_encode($completed_request), ENT_QUOTES, 'UTF-8') ?>)"></i>
                                    </td>

                                    <td>
                                        <?php
                                        $type = ($completed_request->added === 'no') ?
                                            '<button class="confirm_button" disabled>Confirm</button>' :
                                            '<button class="confirmed_button" disabled>Confirmed</button>';
                                        echo $type;
                                        ?>
                                    </td>

                                </tr>
                                <?php endforeach; ?>

                        </div>
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

                </div>
            </div>

            <div class="overlay" id="overlay"></div>

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
                            <p>Collector ID: <span id="collector_id">C</span></p>
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

// function viewLocation($lattitude,$longitude){
//     initMap($lattitude,$longitude);
//     document.querySelector('.location_pop').style.display = 'flex';
// }  

// function closemap(){
//     document.querySelector('.location_pop').style.display = 'none';
// }

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