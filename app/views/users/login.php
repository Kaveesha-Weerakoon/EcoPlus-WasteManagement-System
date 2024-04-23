<?php require APPROOT . '/views/inc/header.php'; ?>


<div class="Login-main">
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="<?php echo URLROOT; ?>/users/login" class="sign-in-form" method="POST">

                    <div class="top"> <img src="<?php echo IMGROOT;?>/Logo.png" alt="">
                        <h1>Sign In</h1>
                    </div>
                    <div class="slogan"> Sign into your account</div>

                    <div class="input-field-container">
                        <div class="input-fieldlog">
                            <i class="fas fa-user"></i>
                            <input type="text" class="text" placeholder="Email" name="email" class="text"
                                value="<?php echo $data['email']; ?>">
                        </div>
                        <div class="errlog"><?php echo $data['email_err']?></div>
                    </div>

                    <div class="input-field-container">
                        <div class="input-fieldlog">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="text" placeholder="Password" name="password" class="text"
                                value="<?php echo $data['password']; ?>">

                        </div>
                        <div class="errlog"><?php echo $data['password_err']?></div>
                    </div>
                    <div class="forgot"><a href="<?php echo URLROOT?>/users/resetpassword">Forgot your password?</a>
                    </div>

                    <input type="submit" value="Login" class="login-btn">


                </form>

            <form action="<?php echo URLROOT;?>/users/register" class="sign-up-form" method="POST"
                enctype="multipart/form-data">
                <div class="top1"> <img src="<?php echo IMGROOT?>/Logo.png" alt="">
                    <h1>Sign Up</h1>
                </div>


                    <div class="edit-profile-content-profile">
                        <div class="edit-profile-content-profile-container">
                            <img class="edit-profile-main-image" id="profile_image_placeholder"
                                src="<?php echo IMGROOT?>./preview2.png" alt="">
                            <img class="edit-profile-second-image" src="<?php echo IMGROOT?>/edit-icon.png" alt="">
                            <input name='profile_image' type="file" id="profile_image">
                            <p>Add a Profile Picture</p>
                            <div class="err"><?php echo $data['profile_err']?></div>
                        </div>
                    </div>

                    <div class="cont-main">
                        <div class="cont">
                            <p>Name</p>
                            <div class="input-field">
                                <input type="text" class="text" placeholder="name" value="<?php echo $data['name']; ?>"
                                    name="name" id="name">

                            </div>
                            <div class="err"><?php echo $data['name_err']?></div>
                        </div>
                        <div class="cont">
                            <p>Email</p>
                            <div class="input-field2">
                                <input type="text" class="text" placeholder="Email"
                                    value="<?php echo $data['email_reg']; ?>" name="email_reg" id="email_reg">

                            </div>
                            <div class="err"><?php echo $data['email_reg_err']?></div>
                        </div>

                    </div>

                    <div class="cont-main">
                        <div class="cont">
                            <p>Contact No</p>
                            <div class="input-field">
                                <input type="text" class="text" placeholder="contact no"
                                    value="<?php echo $data['contact_no']; ?>" name="contact_no" id="contact_no">

                            </div>
                            <div class="err"><?php echo $data['contact_no_err']?></div>
                        </div>

                        <div class="cont">
                            <p>Address</p>
                            <div class="input-field2">
                                <input type="text" class="text" placeholder="address"
                                    value="<?php echo $data['address']; ?>" name="address" id="address">

                            </div>
                            <div class="err"><?php echo $data['address_err']?></div>
                        </div>
                    </div>

                    <div class="cont-region">
                        <div class="cont">
                            <p>Region <i id="mapIcon" class="fas fa-map-marker-alt" onclick="viewLocation()"></i></p>

                            <select id="city" name="city" class="city" onclick="animateMapIcon()">
                                <?php
                       $centers = $data['centers2'];
                       $regionFound = false;

                       if (!empty($centers)) {
                        foreach ($centers as $center) {
                            echo "<option value=\"$center->region\" >$center->region</option>";
                 }} else {
                    echo "<option value=\"default\">No Centers Available</option>";
                }
                ?>
                            </select>
                        </div>
                    </div>

                    <div class="cont-main">
                        <div class="cont">
                            <p>Password</p>
                            <div class="input-field">
                                <input type="password" class="text" placeholder="Password" id="password_reg"
                                    name="password_reg" value="<?php echo $data['password_reg']; ?>">

                            </div>
                            <div class="err"><?php echo $data['password_reg_err']?></div>
                        </div>

                        <div class="cont">
                            <p>Confirm Password</p>
                            <div class="input-field2">
                                <input type="password" class="text" placeholder="confirm Password" id="confirm_password"
                                    name="confirm_password" value=" <?php echo $data['confirm_password']; ?>">

                            </div>
                            <div class="err"><?php echo $data['confirm_password_err']?></div>
                        </div>

                    </div>




                <input type="submit" value="sign Up" class="btn1 solid">


                    <input type="submit" value="sign Up" class="btn solid">



                </form>

            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>"Welcome back! Log in now to access your account and start earning rewards for your eco-friendly
                        efforts. Join us in making a positive impact on the environment!"</p>
                    <button class="btn transparent" id="sign-up-btn">Sign Up</button>
                </div>
                <img src="<?php echo IMGROOT;?>/undraw_the_world_is_mine_re_j5cr.svg" class="image" alt="">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>One of Us ?</h3>
                    <p>"Be part of the change! Join us today to transform waste into rewards. Together, let's make a
                        difference."</p>
                    <button class="btn transparent" id="sign-in-btn">Sign In</button>
                </div>
                <img src="<?php echo IMGROOT;?>/undraw_dev_focus_re_6iwt.svg" class="image" alt="">
            </div>

        </div>
        <div class="overlay" id="overlay"></div>

        <!-- Popup for location map -->
        <div id="location_pop" class="location_pop">
            <div class="location_pop_content">
                <div id="map" class="location_pop_map"></div>
                <div class="location_close">
                    <button id="closeMapPopup" onclick="closemap()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo JSROOT?>/Customer_Edit_Profile.js"> </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHC8CdWrCw593DZUii78rtRV-whzvwKwE&callback=initMap"
        async defer></script>


    <script>
    function viewLocation() {
        console.log("Function called")
        initMap();
        var locationPop = document.querySelector('.location_pop');
        document.getElementById('overlay').style.display = "flex";
        locationPop.classList.add('active');
    }

    function closemap() {
        var locationPop = document.querySelector('.location_pop');
        locationPop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    }
    // Event listener for map icon click
    document.getElementById('mapIcon').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent click propagation to parent elements
        viewLocation();
    });

    // Event listener for overlay click to close the map popup
    document.getElementById('overlay').addEventListener('click', function() {
        closemap();
    });

    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");
    if (<?php echo json_encode($data['reg'] === "True"); ?>) {
        container.classList.add("sign-up-mode");
    } else {
        container.classList.remove("sign-up-mode");
    }

    sign_up_btn.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default anchor behavior
        container.classList.add("sign-up-mode");
        setTimeout(() => {}, 1); // Adjust timing to match your animation duration
    });

    sign_in_btn.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default anchor behavior
        container.classList.remove("sign-up-mode");
        setTimeout(() => {}, 3);
    });

    function animateMapIcon() {
        var mapIcon = document.getElementById('mapIcon');
        mapIcon.classList.add('bounce'); // Add the 'bounce' class to trigger the animation
    }

    function initMap() {
        var center = {
            lat: 7.7,
            lng: 80.7718
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 7.3,
            styles: [{
                    featureType: 'all',
                    elementType: 'labels.text',
                    stylers: [{
                            visibility: 'on'
                        },
                        {
                            fontSize: '10px'
                        }
                    ]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.icon',
                    stylers: [{
                            visibility: 'off'
                        } // Hide the icons for points of interest
                    ]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.text',
                    stylers: [{
                            visibility: 'off'
                        } // Hide text labels for points of interest
                    ]
                },
                {
                    featureType: 'transit',
                    elementType: 'labels.icon',
                    stylers: [{
                            visibility: 'off'
                        } // Hide the icons for transit stations
                    ]
                },
                {
                    featureType: 'transit',
                    elementType: 'labels.text',
                    stylers: [{
                            visibility: 'off'
                        } // Hide text labels for transit stations
                    ]
                },
                {
                    featureType: 'all',
                    elementType: 'all',
                    stylers: [{
                            saturation: -35
                        } // Adjust the saturation to make the map darker
                    ]
                }
            ]
        });
        var customColoredMarkerIcon = {
            url: 'https://maps.google.com/mapfiles/ms/micons/green-dot.png',
            size: new google.maps.Size(31, 31),
            scaledSize: new google.maps.Size(35, 35)
        };

        var activeMarker = null;
        var activeCircle = null;
        var points = <?php echo $data['centers']; ?>;
        points.forEach((point) => {
            var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(point.lat),
                    lng: parseFloat(point.longi),

                },
                map: map,
                title: point.region,
                icon: customColoredMarkerIcon
            });
            var defaultRadius = parseFloat(point.radius);

            marker.addListener('click', function() {
                if (activeMarker) {
                    activeMarker.setIcon(customColoredMarkerIcon);
                }

                if (activeCircle) {
                    activeCircle.setMap(null);
                }

                activeMarker = marker;

                marker.setIcon({
                    url: 'https://maps.google.com/mapfiles/ms/micons/green-dot.png',
                    size: new google.maps.Size(31, 31),
                    scaledSize: new google.maps.Size(35, 34)
                });

                activeCircle = new google.maps.Circle({
                    map: map,
                    center: marker.getPosition(),
                    radius: defaultRadius,
                    fillColor: '#008000',
                    fillOpacity: 0.3,
                    strokeColor: '#008000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2
                });

                var infowindow = new google.maps.InfoWindow({
                    content: point.region
                });
                infowindow.open(map, marker);
            });
        });
    }
    document.getElementById("edit-profile-main-image").addEventListener("click", function() {
        document.getElementById("profile_image").click();
    });
    </script>



    <?php require APPROOT . '/views/inc/footer.php'; ?>