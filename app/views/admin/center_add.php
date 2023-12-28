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

                <!-- <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="./Collector_DashBoard.html">
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Home.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="./Collector_Requests/Collector_Requests.html">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Reports.png" alt="">
                            <h2>Reports</h2>
                        </div>
                    </a>
                    <a href="./Complains/Complains_customer.html">
                        <div class="main-left-middle-content Collector">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Complains.png" alt="">
                            <h2>Complaints</h2>
                        </div>
                    </a>
                    <a href="./Collector_Edit_Profile/Collector_EditProfile.html">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>

                </div>
                <div class="main-left-bottom">
                    <div class="main-left-bottom-content">
                        <img src="<?php echo IMGROOT?>/logout.png" alt="">
                        <p>Log out</p>
                    </div>
                </div>
                </div> -->
                
                <div class="main-right">
                    <div class="main-top">
                        <a href="<?php echo URLROOT?>/admin">
                            <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                        </a>

                        <div class="main-top-component">
                            <p>Admin</p>
                            <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                        </div>
                    </div>
                    <div class="main-bottom">
                        <div class="main-bottom-top">
                            <div class="main-right-top-two">
                                <h1>Centers</h1>
                            </div>
                            <div class="main-right-top-three">
                                <a href="<?php echo URLROOT?>/Admin/Center">
                                    <div class="main-right-top-three-content">
                                        <p>View</p>
                                        <div class="line1"></div>
                                    </div>
                                </a>
                                <a href="<?php echo URLROOT?>/admin/center_add">
                                    <div class="main-right-top-three-content">
                                        <p><b style="color: #1B6652;">Add</b></p>
                                        <div class="line"></div>
                                    </div>
                                </a>

                            </div>
                        </div>
                        <div class="main-bottom-down">  
                                <form  class="main-bottom-down-downn" action="<?php echo URLROOT;?>/admin/center_add" method="post">                           
                                        
                                    <div class="main-bottom-down-top">
                                        <img src="<?php echo IMGROOT?>/Admin_Center.png" alt="">
                                        <p>Add a Center</p>
                                    </div>
                                    <div class="main-bottom-down-down">
                                            <div class="main-bottom-down-down-content">
                                                    <p>Region</p>
                                                    <div class="main-bottom-down-down-content-field">
                                                        <input class="<?php echo isset($data['region_err']) && !empty($data['region_err']) ? 'error-class' : ''; ?>" type="text" name="region" value="<?php echo $data['region']?>">
                                                        <p><?php echo $data['region_err']?></p>
                                                    </div>
                                            </div>                                     
                                            <div class="main-bottom-down-down-content">
                                                    <p>District</p>
                                                    <div class="main-bottom-down-down-content-field">
                                                        <input class="<?php echo isset($data['district_err']) && !empty($data['district_err']) ? 'error-class' : ''; ?>" type="text" name="district" value="<?php echo $data['district']?>">
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
                                    <div class="buttons-container" id="submitForm" >
                                        <button type="submit" formaction="<?php echo URLROOT; ?>/admin/center_add_confirm" method="post" id="markLocationBtn" onclick="getLocation()">Mark Location</button>
                                        <button type="button" id="cancelBtn">Cancel</button>
                                        
                                    </div>
                                    <input type="hidden" id="latitudeInput" value=" <?php echo $data['lattitude']?>" name="latittude">
                                    <input type="hidden" id="longitudeInput" value=" <?php echo $data['longitude']?>" name="longitude">
                                </div>                           
                                </form>
                            
                        </div>
                    </div> 

                </div>
                

                <?php if($data['center_add_success']=='True') : ?> 
                <div class="center_add_success">
                    <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                        <p>Center has been created successfully  </p>
                        <a href="<?php echo URLROOT?>/admin/center"><button type="button" >OK</button></a>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        
        </div>
    </div>
</div>
<script>
    function initMap() {
             
        var defaultLatLng = { 
            lat: <?= !empty($data['lattitude']) ? $data['lattitude'] : 8.00 ?>, 
            lng: <?= !empty($data['longitude']) ? $data['longitude'] : 81.00 ?>  };
     
            map = new google.maps.Map(document.getElementById('map'), {
            center: defaultLatLng,
            zoom: 7.6
        });

        marker = new google.maps.Marker({
            position: defaultLatLng,
            map: map,
            draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {
            var newLatLng = { lat: event.latLng.lat(), lng: event.latLng.lng() };
            console.log('New Location:', newLatLng);
        });
    }

    function getLocation() {

        var currentLatLng = { lat: marker.getPosition().lat(), lng: marker.getPosition().lng() };
        console.log('Selected Location:', currentLatLng);

        document.getElementById('latitudeInput').value = currentLatLng.lat;
        document.getElementById('longitudeInput').value = currentLatLng.lng;//
    }

    document.addEventListener('DOMContentLoaded', function () {
        var mainBottomMaps = document.querySelector('.main-bottom-maps');
        var mapPopup = document.getElementById('mapPopup');

        mainBottomMaps.addEventListener('click', function () {
            mapPopup.style.display = (mapPopup.style.display === 'flex') ? 'none' : 'flex';
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var cancelBtn = document.getElementById('cancelBtn');
        var mapPopup = document.getElementById('mapPopup');
        var map = document.getElementById('markLocationBtn');
        cancelBtn.addEventListener('click', function () {
            mapPopup.style.display = 'none';
        });
        map.addEventListener('click', function () {
            mapPopup.style.display = 'none';
        });
    }); 
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>