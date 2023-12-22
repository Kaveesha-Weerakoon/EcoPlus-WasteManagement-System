<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Request_Main">
        <div class="Customer_Request_Completed">
            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-one-input">
                                <img src="<?php echo IMGROOT?>/Search.png" alt="">
                                <input type="text" placeholder="Search">
                            </div>
                            <div class="main-right-top-one-content">
                                <p><?php echo $_SESSION['user_name']?></p>
                                <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                                    alt="">
                            </div>
                        </div>
                        <div class="main-right-top-two">
                            <h1>Requests</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/customers/request_main">
                                <div class="main-right-top-three-content">
                                    <p>Current</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/customers/request_completed">
                                <div class="main-right-top-three-content">
                                    <p><b style="color: #1B6652;">Completed</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/customers/request_cancelled">
                                <div class="main-right-top-three-content">
                                    <p>Cancelled</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Collector</th>
                                    <th>Collector Info</th>
                                    <th>Location</th>
                                    <th>Earned Credits</th>
                                    <th>Details</th>
                                </tr>
                            </table>
                        </div>

                        <div class="main-right-bottom-down">
                            <table class="table">
                            <?php foreach($data['completed_request'] as $request) : ?>
                                <tr class="table-row">
                                            <td>R<?php echo $request->request_id?></td>

                                            <td><?php  echo $request->date?></td>

                                            <td><?php  echo $request->time?></td>

                                            <td>
                                                <?php
                                                $typeContent = ($request->type === 'complete') ? 
                                                '<img class="collector_img" src="' . IMGROOT . '/img_upload/collector/' .$request->image . '" alt="1">':

                                                '<img class="collector_img" src="' . IMGROOT . '/collector.png" alt="1">';
                                                echo $typeContent
                                            ?>
                                            </td>

                                            <td class="cancel-open">
                                                <img src="<?php echo IMGROOT ?>/assign.png"
                                                <?php if ($request->type === 'completed') { ?>onclick="view_collector('<?php echo $request->collector_image; ?>', '<?php echo $request->collector_user_id; ?>', '<?php echo $request->name; ?>', '<?php echo $request->collector_contact_no; ?>', '<?php echo $request->collector_vehicle_no; ?>', '<?php echo $request->collector_vehicle_type; ?>')"
                                                <?php } ?> alt="">
                                            </td>

                                            <td class="cancel-open"><img src="<?php echo IMGROOT?>/location.png" alt=""
                                            onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)">
                                            </td>

                                            <td><?php  echo $request->credit_amount?></td>

                                            <td class="cancel-open"><img onclick="view_collect_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"
                                                src="<?php echo IMGROOT?>/view.png" alt="">
                                            </td>
                                </tr>
                            <?php endforeach; ?> 
                            </table>
                        </div>
                    </div>
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

                <div class="collect-details-pop" id="collect-details-popup-box">
                            <div class="collect-details-pop-form">
                            <a href="<?php echo URLROOT?>/Collectors/request_completed/"><img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="collect-details-pop-form-close"
                                    id="collect-details-pop-form-close"></a>
                                <div class="collect-details-pop-form-top">
                                    <div class="collect-details-topic">collect details<div id="req_id3"></div>
                                    </div>
                                </div>

                                <div class="collect-details-pop-form-content">
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
            

                <div class="personal-details-popup-box" id="personal-details-popup-box">
                    <div class="personal-details-popup-form" id="popup">
                    <a href="<?php echo URLROOT?>/customers/request_completed/"><img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="personal-details-popup-form-close"
                            id="personal-details-popup-form-close"></a>
                        <center>
                            <div class="personal-details-topic">Collector Details</div>
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

            </div>
        </div>
    </div>
</div>

                   
        <script>
        function view_collector(image, col_id, name, contact_no, type, vehno) {
            document.getElementById('personal-details-popup-box').style.display = 'flex';
            document.getElementById('collector_profile_img').src = '<?php echo IMGROOT ?>/img_upload/collector/' + image;
            document.getElementById('collector_id').innerText = col_id;
            document.getElementById('collector_name').innerText = name;
            document.getElementById('collector_conno').innerText = contact_no;
            document.getElementById('collector_vehicle_no').innerText = vehno;
            document.getElementById('collector_vehicle_type').innerText = type;
        }

        function view_collect_details(request) {
            document.getElementById('collect-details-popup-box').style.display = "flex";
            document.getElementById('Polythene_Quantity').innerText = request.Polythene;
            document.getElementById('Plastic_Quantity').innerText = request.Plastic;
            document.getElementById('Glass_Quantity').innerText = request.Glass;
            document.getElementById('Paper_Waste_Quantity').innerText = request.Paper_Waste;
            document.getElementById('Electronic_Waste_Quantity').innerText = request.Electronic_Waste;
            document.getElementById('Metals_Quantity').innerText = request.Metals;
            document.getElementById('Note').innerText = request.note;
        }

        function initMap(latitude, longitude) {
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

        function searchTable() {
            var input = document.getElementById('searchInput').value.toLowerCase();
            var rows = document.querySelectorAll('.table-row');
            rows.forEach(function(row) {
                var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                var status = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                var date = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
                var time = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
                var center = row.querySelector('td:nth-child(5)').innerText.toLowerCase();

                if (center.includes(input) || id.includes(input) || status.includes(input) || date.includes(
                        input) || time.includes(input)) {
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

            close_collector.addEventListener("click", function() {
                collector_view.style.display = "none"
            });

        });

        
    document.getElementById('searchInput').addEventListener('input', searchTable);
    document.addEventListener("DOMContentLoaded", function() {
        const close_collector = document.getElementById("personal-details-popup-form-close");
        const collector_view = document.getElementById("personal-details-popup-box");

        close_collector.addEventListener("click", function() {
            collector_view.style.display = "none"
        });

    });
        
    </script>

        <?php require APPROOT . '/views/inc/footer.php'; ?>