<?php require APPROOT . '/views/inc/header.php'; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
    async defer>
</script>
<div class="Register-main">

    <!-- <div class="main">
        <div class="main-container">
            <form class="main-container-right" action="<?php echo URLROOT;?>/users/register" method="post"
                enctype="multipart/form-data">
                <div class="main-container-right-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Join With Us</h1>
                </div>
                <div class="main-container-right-profile">
                    <div class="main-container-right-profile-left">
                        <div class="form-drag-area">
                            <div class="icon">
                                <img src="<?php echo IMGROOT?>/placeholder.png" alt="PLACEHOLDER" width="90px"
                                    heigh="90px" id="profile_image_placeholder">
                            </div>
                            <div class="right-content">
                                <div class="description">
                                    Drap & Drop to Upload File
                                </div>
                                <div class="form-upload">
                                    <input type="file" name="profile_image" id="profile_image"
                                        placeholder="select a profile image">
                                    <div class="err"><?php echo $data['profile_err']?></div>
                                </div>
                                <div class="form-validation">
                                    <div class="profile-image-validation">
                                        <img src="" alt="green_tik" width="20px" height="20px">
                                        <p style="color: #e74c3c;"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Name</h2>
                            <input type="text" placeholder="Enter Name" name="name"
                                value="<?php echo $data['name']; ?>">
                            <div class="err"><?php echo $data['name_err']?></div>
                        </div>
                    </div>
                </div>
                <div class="main-container-right-profile">
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Email</h2>
                            <input type="text" placeholder="Enter Email" name="email"
                                value="<?php echo $data['email']; ?>">
                            <div class="err"><?php echo $data['email_err']?></div>
                        </div>
                    </div>
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Address</h2>
                            <input type="text" placeholder="Enter Address" name="address"
                                value="<?php echo $data['address']; ?>">
                            <div class="err"><?php echo $data['address_err']?></div>
                        </div>
                    </div>
                </div>
                <div class="main-container-right-profile">
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Contact No</h2>
                            <input type="text" placeholder="Enter Contact No" name="contact_no"
                                value="<?php echo $data['contact_no']; ?>">
                            <div class="err"><?php echo $data['contact_no_err']?></div>
                        </div>
                    </div>
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>City</h2>
                            <input type="text" placeholder="Enter City" name="city"
                                value="<?php echo $data['city']; ?>">
                            <div class="err"><?php echo $data['city_err']?></div>
                        </div>
                    </div>
                </div>
                <div class="main-container-right-profile">
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Password</h2>
                            <input type="password" placeholder="Enter Name" name="password"
                                value="<?php echo $data['password']; ?>">
                            <div class="err"><?php echo $data['password_err']?></div>
                        </div>
                    </div>
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Re-enter Password</h2>
                            <input type="password" placeholder="Enter Password Again" name="confirm_password"
                                value="<?php echo $data['confirm_password']; ?>">
                            <div class="err"><?php echo $data['confirm_password_err']?></div>
                        </div>
                    </div>
                </div>
                <div class="register-button">
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>
    </div> -->


    <div class="main">
        <div class="main-left">
            <h1>Our Regional Centers</h1>
            <div class="map" id="map">

            </div>
        </div>
        <form class="main-right" action="<?php echo URLROOT;?>/users/register" method="post"
            enctype="multipart/form-data">
            <div class="top"> <img src="<?php echo IMGROOT?>./Logo.png" alt="">
                <h1>Sign Up</h1>
            </div>

            <div class="porfile-cont">
                <input type="file" name="profile_image" class="profile_image" id="profile_image"
                    placeholder="select a profile image">
                <img src="<?php echo IMGROOT?>./anonymous.png" alt="" class="profile_image_trigger"
                    id="profile_image_trigger">
                <p>Add a Profile Picture</p>
                <div class="err"><?php echo $data['profile_err']?></div>
            </div>
            <div class="cont-main">
                <div class="cont">
                    <p>Name</p>
                    <input type="text" placeholder="Enter your name" value="<?php echo $data['name']; ?>" name="name"
                        id="name">
                    <div class="err"><?php echo $data['name_err']?></div>
                </div>
                <div class="cont">
                    <p>Email</p>
                    <input type="text" placeholder="Enter your email" value="<?php echo $data['email']; ?>" name="email"
                        id="email">
                    <div class="err"><?php echo $data['email_err']?></div>

                </div>
            </div>
            <div class="cont-main">
                <div class="cont">
                    <p>Contact No</p>
                    <input type="text" placeholder="Enter your contact number"
                        value="<?php echo $data['contact_no']; ?>" name="contact_no" id="contact_no">
                    <div class="err"><?php echo $data['contact_no_err']?></div>
                </div>
                <div class="cont">
                    <p>Address</p>
                    <input type="text" placeholder="Enter your address" value="<?php echo $data['address']; ?>"
                        name="address" id="address">
                    <div class="err"><?php echo $data['address_err']?></div>
                </div>
            </div>
            <div class="cont-region">
                <p>Region</p>
                <input type="text" placeholder="Enter your region" id="city" name="city">
            </div>

            <div class="cont-main">
                <div class="cont">
                    <p>Password</p>
                    <input type="password" id="password" name="password" placeholder="Enter your password" id="password"
                        value="<?php echo $data['password']; ?>">
                    <div class="err"><?php echo $data['password_err']?></div>
                </div>
                <div class="cont">
                    <p>Confirm Password</p>
                    <input type="password" id="confirmPassword" name="confirm_password" id="confirm_password"
                        placeholder="Confirm your password" value="<?php echo $data['confirm_password']; ?>">
                    <div class="err"><?php echo $data['confirm_password_err']?></div>

                </div>
            </div>
            <button type="submit">Register</button>

            <h2>Back to Login</h2>

        </form>
    </div>
    <script src="<?php echo JSROOT?>/Users_Register.js"> </script>

</div>

<script>
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
document.getElementById("profile_image_trigger").addEventListener("click", function() {
    document.getElementById("profile_image").click();
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>