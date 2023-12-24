<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">

    <div class="Customer_Request_collect">

        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" id="notification">
                        <i class='bx bx-bell'></i>
                        <div class="dot"></div>
                    </div>
                    <div id="notification_popup" class="notification_popup">
                        <h1>Notifications</h1>
                        <div class="notification">
                            <div class="notification-green-dot">

                            </div>
                            Request 1232 Has been Cancelled
                        </div>
                        <div class="notification">
                            <div class="notification-green-dot">

                            </div>
                            Request 1232 Has been Assigned
                        </div>
                        <div class="notification">
                            <div class="notification-green-dot">

                            </div>
                            Request 1232 Has been Cancelled
                        </div>


                    </div>
                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3>Kaveesha</h3>
                            <p>ID : C <?php echo $_SESSION['user_id']?></p>
                        </div>
                    </div>
                </div>

                <form id="myForm" class="main-bottom" action="<?php echo URLROOT;?>/customers/request_collect"
                    method="post">

                    <div class="main-bottom-component">
                        <div class="main-bottom-component-left">
                            <img src="<?php echo IMGROOT?>/RequestCollect.jpg" alt="">
                        </div>
                        <div class="main-bottom-component-right">
                            <div class="main-bottom-component-right-component-topic">
                                <h2>Request a Collect</h2>
                                <div class="line"></div>
                            </div>
                            <div class="main-bottom-component-right-component-main">
                                <div class="main-bottom-component-right-component">
                                    <h2>Name</h2>
                                    <input value="<?php echo $data['name']?>" name="name" type="text"
                                        placeholder="Name">
                                    <div class="err"><?php echo $data['name_err']?></div>
                                </div>
                                <div class="main-bottom-component-right-component">
                                    <h2>Contact Number</h2>
                                    <input value="<?php echo $data['contact_no']?>" name="contact_no" type="text"
                                        placeholder="Contact Number">
                                    <div class="err"><?php echo $data['contact_no_err']?></div>
                                </div>
                            </div>
                            <div class="main-bottom-component-right-component-main">
                                <input type="hidden" value="<?php echo $data['region_success']?>" name="region_success">
                                <div class="main-bottom-component-right-component">
                                    <h2>Date</h2>
                                    <input value="<?php echo $data['date']?>" name="date" type="date">
                                    <div class="err"><?php echo $data['date_err']?></div>
                                </div>
                                <div class="main-bottom-component-right-component ">
                                    <h2>Time Slot</h2>
                                    <select class="Time" name="time">
                                        <option value="8 am - 10 am"
                                            <?php echo ($data['time'] === '8 am -10 am') ? 'selected' : ''; ?>>8 am -10
                                            am
                                        </option>
                                        <option value="10 am - 12 noon"
                                            <?php echo ($data['time'] === '10 am - 12 noon') ? 'selected' : ''; ?>>10 am
                                            -
                                            12
                                            noon
                                        </option>
                                        <option value="12 noon -2 pm"
                                            <?php echo ($data['time'] === '12 noon -2 pm') ? 'selected' : '12 noon -2 pm'; ?>>
                                            12
                                            noon - 2 pm

                                        </option>
                                        <option value="2 pm - 4 pm"
                                            <?php echo ($data['time'] === '2 pm - 4 pm') ? 'selected' : ''; ?>>2 pm - 4
                                            pm

                                        </option>
                                    </select>
                                    <div class="err"><?php echo $data['time_err']?></div>
                                </div>

                            </div>
                            <div class="main-bottom-component-right-component">
                                <h2>Your Region</h2>
                                <div class="center_dropdown">
                                    <select name="center" id="centerDropdown">
                                        <?php
                                            $centers = $data['centers'];
                                            $selectedRegion = $data['region'];

                                                if (!empty($centers)) {
                                                    foreach ($centers as $center) {
                                                    $selected = ($center->region == $selectedRegion) ? 'selected' : '';
                                                    echo "<option value=\"$center->region\" $selected>$center->region</option>";
                                                }
                                                } else {
                                                    echo "<option value=\"default\">No Centers Available</option>";
                                                }
                                        ?>
                                    </select>
                                    <button onclick="getRegion()">Set Region</button>
                                </div>
                            </div>
                            <div class="main-bottom-component-right-component">
                                <h2>Pick Up Instructions</h2>
                                <input value="<?php echo $data['instructions']?>" name="instructions" type="Text"
                                    placeholder="Pick Up Instructions">
                                <div class="err"><?php echo $data['instructions_err']?></div>
                            </div>
                            <div class="main-bottom-component-right-component Z">
                                <h2>Location</h2>
                                <input type="hidden" id="location_success"
                                    value="<?php echo $data['location_success']?>" name="location_success">
                                <?php if ($data['region_success'] == 'True') { ?>
                                <div class="main-bottom-maps" onclick="initMap()">
                                    <h4>Maps</h4>
                                    <img src="<?php echo IMGROOT; ?>/location2.png" alt="">
                                </div>

                                <?php if ($data['location_success'] == 'Success') : ?>
                                <div class="main-bottom-map-success">
                                    <img src="<?php echo IMGROOT; ?>/check.png" alt="">
                                    <p>Location Fetched Successfully</p>

                                </div>
                                <?php endif; ?>

                                <?php if ($data['location_err'] == 'Location Error') : ?>
                                <div class="main-bottom-map-success">
                                    <img src="<?php echo IMGROOT; ?>/warning.png" alt="">
                                    <p>Pick up location Required</p>
                                </div>
                                <?php endif; ?>

                                <?php } else { ?>
                                <!-- Add code for the else block here -->
                                <div class="main-bottom-maps2">
                                    <h4>Maps</h4>
                                    <img src=" <?php echo IMGROOT; ?>/location2.png" alt="">
                                </div>
                                <div class="main-bottom-map-success">
                                    <img src="<?php echo IMGROOT; ?>/warning.png" alt="">
                                    <p>Select a region</p>
                                </div>
                                <?php } ?>

                            </div>
                            <div class="main-bottom-component-right-component-button">
                                <Button type="submit">Request Now</Button>
                            </div>

                        </div>
                    </div>

                    <div class="map_pop" id="mapPopup">
                        <div id="map"></div>
                        <div class="buttons-container" id="submitForm">
                            <button type="button" id="markLocationBtn" onclick="submitForm()">Mark Location</button>
                            <button type="button" id="cancelBtn">Cancel</button>
                            <input type="hidden" id="latitudeInput" value="<?php echo $data['lattitude']?>"
                                name="latitude">
                            <input type="hidden" id="longitudeInput" value="<?php echo $data['longitude']?>"
                                name="longitude">
                        </div>
                    </div>
                    <?php if($data['confirm_collect_pop']=='True') : ?>
                    <div class="confirm_collect_pop">
                        <div class="popup" id="popup">
                            <img src="<?php echo IMGROOT?>/Collector_Dashboard3.jpg" alt="">
                            <h2>Request Confirm!</h2>
                            <p> Request will forwarded to our <b><?php echo $data['region']?></b> center</p>
                            <div class="btns">
                                <a href="">
                                    <button type="submit" class="deletebtn"
                                        onclick="document.getElementById('myForm').action='<?php echo URLROOT; ?>/Customers/request_confirm'; document.getElementById('myForm').submit();">Confirm</button>
                                </a>
                                <a href="<?php echo URLROOT; ?>/Customers/request_collect">
                                    <button type="button" class="cancelbtn">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($data['success']=='True') : ?>
                    <div class="request_success">
                        <div class="popup" id="popup">
                            <img src="<?php echo IMGROOT?>/check.png" alt="">
                            <h2>Success!!</h2>
                            <p>Request received! Our team is on it.</p>
                            <a href="<?php echo URLROOT?>/customers/request_main"><button type="button">OK</button></a>
                        </div>
                    </div>
                    <?php endif; ?>
                </form>
            </div>


            <script>
            $(document).ready(function() {
                $('#centerDropdown').select2();
            });
            </script>

        </div>
    </div>


    <script>
    var map;
    var marker;

    function initMap() {

        var defaultLatLng = {
            lat: <?= !empty($data['lattitude']) ? $data['lattitude'] : 6 ?>,
            lng: <?= !empty($data['longitude']) ? $data['longitude'] : 81.00 ?>
        };

        map = new google.maps.Map(document.getElementById('map'), {
            center: defaultLatLng,
            zoom: 14.5
        });

        marker = new google.maps.Marker({
            position: defaultLatLng,
            map: map,
            draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function(event) {
            var newLatLng = {
                lat: event.latLng.lat(),
                lng: event.latLng.lng()
            };
            console.log('New Location:', newLatLng);
        });
    }

    function getRegion() {
        var form = document.getElementById('myForm');
        form.action = "<?php echo URLROOT;?>/customers/get_region";
        form.method = 'post';
    }

    function submitForm() {
        var form = document.getElementById('myForm');
        form.action = "<?php echo URLROOT;?>/customers/request_mark_map";
        form.method = 'post';

        var currentLatLng = {
            lat: marker.getPosition().lat(),
            lng: marker.getPosition().lng()
        };
        console.log('Selected Location:', currentLatLng);
        document.getElementById('latitudeInput').value = currentLatLng.lat;
        document.getElementById('longitudeInput').value = currentLatLng.lng; //
        document.body.appendChild(form);
        form.submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var mainBottomMaps = document.querySelector('.main-bottom-maps');
        var mapPopup = document.getElementById('mapPopup');

        mainBottomMaps.addEventListener('click', function() {
            mapPopup.style.display = (mapPopup.style.display === 'flex') ? 'none' : 'flex';
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var cancelBtn = document.getElementById('cancelBtn');
        var mapPopup = document.getElementById('mapPopup');
        var map = document.getElementById('markLocationBtn');
        cancelBtn.addEventListener('click', function() {
            // Set display property of mapPopup to 'none'
            mapPopup.style.display = 'none';
        });
        map.addEventListener('click', function() {
            // Set display property of mapPopup to 'none'
            mapPopup.style.display = 'none';
        });
    });
    </script>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>