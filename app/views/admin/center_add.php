<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <div class="Admin_Center_Add">
            <script
                src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
                async defer>
            </script>
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search" style="visibility: hidden;">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>
                            <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
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
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <div class="main-right-top-profile-cont">
                                    <h3>Admin</h3>
                                </div>
                            </div>
                        </div>
                        <div class="main-right-top-two">
                            <h1>Centers</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/Admin/Center">
                                <div class="main-right-top-three-content">
                                    <p>View</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/admin/center_add">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">Add</b></p>
                                    <div class="line" style="background-color: #1ca557;"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="main-bottom-down">
                        <form class="main-bottom-down-downn" action="<?php echo URLROOT;?>/admin/center_add"
                            method="post">

                            <div class="main-bottom-down-top">
                                <img src="<?php echo IMGROOT?>/Admin_Center.png" alt="">
                                <p>Add a Center</p>
                            </div>
                            <div class="main-bottom-down-down">
                                <div class="main-bottom-down-down-content">
                                    <p>Region</p>
                                    <div class="main-bottom-down-down-content-field">
                                        <input
                                            class="<?php echo isset($data['region_err']) && !empty($data['region_err']) ? 'error-class' : ''; ?>"
                                            type="text" name="region" value="<?php echo $data['region']?>">
                                        <p><?php echo $data['region_err']?></p>
                                    </div>
                                </div>
                                <div class="main-bottom-down-down-content">
                                    <p>District</p>
                                    <div class="main-bottom-down-down-content-field">
                                        <input
                                            class="<?php echo isset($data['district_err']) && !empty($data['district_err']) ? 'error-class' : ''; ?>"
                                            type="text" name="district" value="<?php echo $data['district']?>">
                                        <p><?php echo $data['district_err']?></p>
                                    </div>
                                </div>
                                <div class="main-bottom-down-down-content">
                                    <p>Location</p>
                                    <div class="main-bottom-down-down-content-maps">
                                        <div class="main-bottom-maps" onclick="initMap()">
                                            <h4>Maps</h4>
                                            <img src="<?php echo IMGROOT?>/location2.png" alt="">
                                        </div>
                                        <div class="main-bottom-down-down-content-field">
                                            <?php if ($data['location_success']=='Success') : ?>
                                            <div class="main-bottom-map-success">
                                                <img src="<?php echo IMGROOT; ?>/check.png" alt="">
                                                <p style="width:205px; ">Location Fetched Successfully</p>
                                            </div>
                                            <?php endif; ?>
                                            <?php if ($data['location_err']=='Location Error') : ?>
                                            <div class="main-bottom-map-success">
                                                <img src="<?php echo IMGROOT; ?>/warning.png" alt="">
                                                <p>Pick up location Required</p>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-bottom-down-down-content">
                                    <label for="centerManager">Center Manager</label>
                                    <select name="centerManager" id="centerManager">
                                        <?php
                                                    $centerManagers = $data['center_managers'];
                                                    if (!empty($centerManagers)) {
                                                        foreach ($centerManagers as $manager) {
                                                            echo "<option value=\"$manager->id\">CM $manager->id</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=\"default\">No Center Managers Available</option>";
                                                        }
                                                        ?>
                                    </select>
                                    <p><?php echo $data['center_manager_err']?></p>
                                </div>

                                <button class="Create_Center_Button" type="submit">
                                    Create Center
                                </button>
                            </div>
                            <div class="map_pop" id="mapPopup">
                                <div id="map">

                                </div>
                                <div class="buttons-container" id="submitForm">
                                    <button type="submit" formaction="<?php echo URLROOT; ?>/admin/center_add_confirm"
                                        method="post" id="markLocationBtn" onclick="getLocation()">Mark
                                        Location</button>
                                    <button type="button" id="cancelBtn">Cancel</button>

                                </div>
                                <input type="hidden" id="latittude" value=" <?php echo $data['lattitude']?>"
                                    name="latittude">
                                <input type="hidden" id="longitude" value=" <?php echo $data['longitude']?>"
                                    name="longitude"> <input type="hidden" id="longitude">
                                <input type="hidden" id="radius" value=" <?php echo $data['radius']?>" name="radius">

                            </div>
                        </form>

                    </div>


                </div>


                <?php if($data['center_add_success']=='True') : ?>
                <div class="center_add_success">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Center has been created successfully </p>
                        <a href="<?php echo URLROOT?>/admin/center"><button type="button">OK</button></a>
                    </div>
                </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>
<script>
var map;
var circle;

function initMap() {
    var defaultLatLng = {
        lat: <?= !empty($data['lattitude']) ? $data['lattitude'] : 8.00 ?>,
        lng: <?= !empty($data['longitude']) ? $data['longitude'] : 81.00 ?>
    };

    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultLatLng,
        zoom: 7
    });

    // Draw a circle around the marker
    circle = new google.maps.Circle({
        map: map,
        center: defaultLatLng,
        radius: 40000, // Set the initial radius in meters
        fillColor: '#47b076',
        fillOpacity: 0.3,
        strokeColor: '#47b076',
        strokeOpacity: 1,
        strokeWeight: 2,
        editable: true, // Make the circle editable
        draggable: true // Make the circle draggable
    });

    // Event listener for radius change
    google.maps.event.addListener(circle, 'radius_changed', function() {
        console.log("Radius changed: " + circle.getCenter().lat());
    });
}

function getLocation() {
    var currentLatLng = {
        lat: circle.getCenter().lat(),
        lng: circle.getCenter().lng()
    };
    console.log('Selected Location:', currentLatLng);

    document.getElementById('latittude').value = currentLatLng.lat;
    document.getElementById('longitude').value = currentLatLng.lng;
    document.getElementById('radius').value = circle.getRadius(); // Log radius information
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
        mapPopup.style.display = 'none';
    });
    map.addEventListener('click', function() {
        mapPopup.style.display = 'none';
    });
});
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>