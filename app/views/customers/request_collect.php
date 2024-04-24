<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
        async defer>
    </script>
    <div class="Customer_Request_collect">

        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>
                    <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>

                </div>

                <form id="myForm" class="main-bottom" action="<?php echo URLROOT;?>/customers/request_collect"
                    method="post">

                    <div class="main-bottom-component">
                        <div class="Topic">
                            <h2>Request a Collect</h2>
                            <div class="line"></div>
                        </div>
                        <div class="Content">
                            <div class="Content-Content">
                                <h2>Name</h2>
                                <input value="<?php echo $data['name']?>" name="name" type="text" placeholder="Name">
                                <div class="err"><?php echo $data['name_err']?></div>
                            </div>
                            <div class="Content-Content">
                                <h2>Contact Number</h2>
                                <input value="<?php echo $data['contact_no']?>" name="contact_no" type="text"
                                    placeholder="Contact Number">
                                <div class="err"><?php echo $data['contact_no_err']?></div>
                            </div>
                        </div>
                        <div class="Content">
                            <div class="Content-Content">
                                <input type="hidden" value="<?php echo $data['region_success']?>" name="region_success">
                                <div class="main-bottom-component-right-component">
                                    <h2>Date</h2>
                                    <input value="<?php echo $data['date']?>" name="date" type="date">
                                    <div class="err"><?php echo $data['date_err']?></div>
                                </div>
                            </div>
                            <div class="Content-Content">
                                <h2>Time Slot</h2>
                                <select class="Time" name="time">
                                    <option value="Select a slot"
                                        <?php echo ($data['time'] === 'Select a slot') ? 'selected' : ''; ?>>Choose a
                                        Time Slot</option>
                                    <option value="8 am - 10 am"
                                        <?php echo ($data['time'] === '8 am - 10 am') ? 'selected' : ''; ?>>8 am - 10 am
                                    </option>
                                    <option value="10 am - 12 noon"
                                        <?php echo ($data['time'] === '10 am - 12 noon') ? 'selected' : ''; ?>>10 am -
                                        12 noon</option>
                                    <option value="12 noon - 2 pm"
                                        <?php echo ($data['time'] === '12 noon - 2 pm') ? 'selected' : ''; ?>>12 noon -
                                        2 pm</option>
                                    <option value="2 pm - 4 pm"
                                        <?php echo ($data['time'] === '2 pm - 4 pm') ? 'selected' : ''; ?>>2 pm - 4 pm
                                    </option>
                                </select>

                                <div class="err"><?php echo $data['time_err']?></div>
                            </div>
                        </div>
                        <div class="Content">
                            <div class="Content-Content">
                                <h2>Your Region</h2>
                                <input value="<?php echo $data['region']?>" type="text" readonly>
                            </div>
                            <div class="Content-Content">
                                <h2>Pick Up Instructions/Details</h2>
                                <input value="<?php echo $data['instructions']?>" name="instructions" type="Text"
                                    placeholder="Ex : about 2kg of metals">
                                <div class="err"><?php echo $data['instructions_err']?></div>
                            </div>
                        </div>
                        <div class="Content X">
                            <h2>Location</h2>
                            <input type="hidden" id="location_success" value="<?php echo $data['location_success']?>"
                                name="location_success">
                            <?php if ($data['region_success'] == 'True')  ?>
                            <div class="main-bottom-maps" onclick="initMap()">
                                <h4>Maps</h4>
                                <i class="fa-solid fa-location-dot"></i>
                            </div>

                            <?php if ($data['location_success'] == 'Success') : ?>
                            <div class="main-bottom-map-success">
                                <img src="<?php echo IMGROOT; ?>/check.png" alt="">
                                <p>Location fetched successfully</p>

                            </div>
                            <?php endif; ?>
                            <?php if ($data['location_err'] == 'Location error') : ?>
                            <div class="main-bottom-map-success">
                                <img src="<?php echo IMGROOT; ?>/warning.png" alt="">
                                <p>Pick up location required</p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="Waste_Amounts">

                            <?php foreach($data['garbage_types'] as $type) : ?>
                            <div class="Cont">
                                <h3><?php echo $type->name; ?></h3>
                                <i class="<?php echo $type->icon; ?>"></i>
                                <p><?php echo $type->approximate_amount; ?> Kg</p>
                            </div>
                            <?php endforeach; ?>


                        </div>
                        <div class="Warning_Message">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            Please have at least one of the above unit
                            of waste for the collection.otherwise,<br>
                            your request
                            will be
                            cancelled with a <?php echo $data['fine']?> Eco fine
                        </div>
                        <div class="Submit-botton">
                            <Button type="submit">Request Now</Button>
                        </div>

                    </div>



                    <div class="map_pop" id="mapPopup">
                        <div class="map-cont">
                            <div class="top-cont">
                                <i class="fa-solid fa-location-dot"></i>
                                <h3>Drag the marker to set the pick up location</h3>
                            </div>
                            <div id="map"></div>
                            <p>*Green Radius : Indicates the operational area of your default center</p>
                            <div class="buttons-container" id="submitForm">
                                <button type="button" id="markLocationBtn" onclick="submitForm()">Mark
                                    Location</button>
                                <button type="button" id="cancelBtn">Cancel</button>
                                <input type="hidden" id="latitudeInput" value="<?php echo $data['lattitude']?>"
                                    name="latitude">
                                <input type="hidden" id="longitudeInput" value="<?php echo $data['longitude']?>"
                                    name="longitude">
                            </div>
                        </div>

                    </div>
                    <?php if($data['confirm_collect_pop']=='True') : ?>
                    <div class="confirm_collect_pop">
                        <div class="popup" id="popup">
                            <img src="<?php echo IMGROOT?>/Collector_Dashboard3.jpg" alt="">
                            <h2>Confirm Your Request!</h2>
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
                    <?php if($data['radius_err']=='True') : ?>

                    <div class="radius_error_pop">
                        <div class="popup" id="popup1">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <h2>Apologies, Not Serving Your Location!</h2>
                            <p>Check our centers section for coverage details.</p>
                            <a href="<?php echo URLROOT?>/customers/request_collect"><button
                                    type="button">OK</button></a>

                        </div>
                    </div>
                    <?php endif; ?>

                </form>
            </div>
            <div class="overlay" id="overlay">

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

        var centerLatLng = {
            lat: <?= !empty($data['center_lat']) ? $data['center_lat'] : 6 ?>,
            lng: <?= !empty($data['center_long']) ? $data['center_long'] : 81.00 ?>
        };


        var map = new google.maps.Map(document.getElementById('map'), {
            center: defaultLatLng,
            zoom: 9
        });

        marker = new google.maps.Marker({
            position: defaultLatLng,
            map: map,
            draggable: true
        });

        var defaultRadius = parseFloat(<?php echo $data['radius']; ?>);
        console.log(defaultRadius);
        var circle = new google.maps.Circle({
            map: map,
            center: centerLatLng,
            radius: defaultRadius,
            fillColor: '#008000',
            fillOpacity: 0.3,
            strokeColor: '#008000',
            strokeOpacity: 0.8,
            strokeWeight: 2
        });

        google.maps.event.addListener(marker, 'dragend', function(event) {
            var newLatLng = {
                lat: event.latLng.lat(),
                lng: event.latLng.lng()
            };
            console.log('New Location:', newLatLng);
        });

    }


    function submitForm() {
        var form = document.getElementById('myForm');
        form.action = "<?php echo URLROOT;?>/customers/request_mark_map";
        form.method = 'post';

        var currentLatLng = {
            lat: marker.getPosition().lat(),
            lng: marker.getPosition().lng()
        };

        document.getElementById('latitudeInput').value = currentLatLng.lat;
        document.getElementById('longitudeInput').value = currentLatLng.lng; //
        document.body.appendChild(form);

        form.submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var mainBottomMaps = document.querySelector('.main-bottom-maps');
        var mapPopup = document.getElementById('mapPopup');

        mainBottomMaps.addEventListener('click', function() {
            document.getElementById("mapPopup").classList.add('active');
            document.getElementById('overlay').style.display = "flex";
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var cancelBtn = document.getElementById('cancelBtn');
        var mapPopup = document.getElementById('mapPopup');
        var map = document.getElementById('markLocationBtn');
        cancelBtn.addEventListener('click', function() {
            document.getElementById("mapPopup").classList.remove('active');
            document.getElementById('overlay').style.display = "none";
        });
        map.addEventListener('click', function() {
            document.getElementById("mapPopup").classList.remove('active');
            document.getElementById('overlay').style.display = "none";
        });
    });

    /* Notification View */
    document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/customers/view_notification/request_collect";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */
    /*animation*/
    document.addEventListener("DOMContentLoaded", function() {
        var mainRightBottomContent = document.querySelector('.main-bottom-component');

        function checkSlide() {
            var elementTop = mainRightBottomContent.getBoundingClientRect().top;
            var isHalfShown = elementTop < window.innerHeight;
            var isNotScrolledPast = window.scrollY < elementTop + mainRightBottomContent.clientHeight;

            if (isHalfShown && isNotScrolledPast) {
                mainRightBottomContent.classList.add('slide-in');
            } else {
                mainRightBottomContent.classList.remove('slide-in');
            }
        }

        window.addEventListener('scroll', checkSlide);
        checkSlide(); // Trigger once on page load
    });
    /* ----------------- */
    </script>
    <script src="<?php echo JSROOT?>/Customer.js"> </script>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>