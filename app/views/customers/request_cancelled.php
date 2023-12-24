<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">


    <div class="Customer_Request_Main">
        <div class="Customer_Request_Cancelled">
            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">
                    <?php require APPROOT . '/views/customers/customer_request/customer_request_top.php'; ?>

                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Center</th>
                                    <th>Assigned</th>
                                    <th>Location</th>
                                    <th>Collector</th>
                                    <th>Cancelled By</th>
                                    <th>Reason</th>
                                </tr>
                            </table>
                        </div>

                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['cancelled_request'] as $request) : ?>
                                <tr class="table-row">
                                    <td><?php echo $request->request_id?></td>
                                    <td><?php echo $request->date?></td>
                                    <td><?php echo $request->time?></td>
                                    <td><?php echo $request->region?></td>
                                    <td><?php echo $request->assinged?></td>

                                    <td><i onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"
                                            class='bx bx-map' style="font-size: 29px"></i>
                                    </td>
                                    <td><i class='bx bx-info-circle' style="font-size: 29px"
                                            <?php if ($request->assinged === 'Yes') { ?>onclick="view_collector('<?php echo $request->image; ?>', '<?php echo $request->user_id; ?>', '<?php echo $request->name; ?>', '<?php echo $request->contact_no; ?>', '<?php echo $request->vehicle_no; ?>', '<?php echo $request->vehicle_type; ?>')"
                                            <?php } ?>> </i></td>

                                    <td><?php echo $request->cancelled_by?></td>
                                    <td><?php echo ($request->reason ? $request->reason : 'None'); ?></td>
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
                <div class="overlay" id="overlay"></div>

            </div>
        </div>
        <script>
        function view_collector(image, col_id, name, contact_no, type, vehno) {
            var locationPop = document.querySelector('.personal-details-popup-box');
            locationPop.classList.add('active');
            document.getElementById('overlay').style.display = "flex";
            document.getElementById('collector_profile_img').src = '<?php echo IMGROOT ?>/img_upload/collector/' +
                image;
            document.getElementById('collector_id').innerText = col_id;
            document.getElementById('collector_name').innerText = name;
            document.getElementById('collector_conno').innerText = contact_no;
            document.getElementById('collector_vehicle_no').innerText = vehno;
            document.getElementById('collector_vehicle_type').innerText = type;
        }

        function searchTable() {
            var input = document.getElementById('searchInput').value.toLowerCase();
            var rows = document.querySelectorAll('.table-row');

            rows.forEach(function(row) {
                var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                var time = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
                var center = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
                var cancelled_By = row.querySelector('td:nth-child(7)').innerText.toLowerCase();
                var reason = row.querySelector('td:nth-child(8)').innerText.toLowerCase();

                if (center.includes(input) || id.includes(input) || status.includes(input) || date.includes(
                        input) || time.includes(input) || cancelled_By.includes(input) || reason.includes(
                        input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });

        }

        function initMap(latitude, longitude) {
            var mapCenter = {
                lat: latitude,
                lng: longitude
            };

            var map = new google.maps.Map(document.querySelector('.location_pop_map'), {
                center: mapCenter,
                zoom: 12.5
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
            var locationPop = document.querySelector('.location_pop');
            document.getElementById('overlay').style.display = "flex";
            locationPop.classList.add('active');
        }

        function closemap() {
            var locationPop = document.querySelector('.location_pop');
            locationPop.classList.remove('active');
            document.getElementById('overlay').style.display = "none";
        }

        document.getElementById('searchInput').addEventListener('input', searchTable);
        document.addEventListener("DOMContentLoaded", function() {
            const close_collector = document.getElementById("personal-details-popup-form-close");
            const collector_view = document.getElementById("personal-details-popup-box");

            close_collector.addEventListener("click", function() {
                document.getElementById('overlay').style.display = "none";
                var locationPop = document.querySelector('.personal-details-popup-box');
                locationPop.classList.remove('active');
            });

        });
        </script>
        <?php require APPROOT . '/views/inc/footer.php'; ?>