<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
        async defer>
    </script>
    <div class="Admin_Dashboard ">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
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
                <div class="main-right-bottom">
                    <div class="main-right-bottom-one">
                        <div class="main-right-bottom-one-left">
                            <div class="left">
                                <h1>Rupee Value</h1>
                                <h3>per </h3>
                                <p>Eco credit</p>
                                <button>Change Value</button>
                            </div>
                            <div class="right">
                                <h1>Rs <span class="main-credit"> 2.62</span> </h1>
                                <h3>1 ECO CREDIT</h3>
                            </div>
                        </div>
                        <div class="main-right-bottom-one-right">

                            <!-- <canvas id="myChart" width="688" height="300"></canvas> -->
                        </div>
                    </div>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-cont A" onclick="redirect_customers()">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h4 id="customer_count" style="font-weight:bold"></h4>
                            <h3>Customers</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_collectors()">
                            <div class=" icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h4 id="collector_count" style="font-weight:bold"></h4>

                            <h3>Collectors</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_discountAgents()">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h4 style="font-weight:bold">12</h4>

                            <h3>Discount Agents</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_centermanagers()">
                            <div class=" icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h4 style="font-weight:bold" id="cm_count"></h4>

                            <h3>Center Managers</h3>
                        </div>

                    </div>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-left">
                            <h1>Recent Transactions</h1>
                            <div class="main-right-bottom-three-left-cont">
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <h3>Dayana</h3>
                                <h2>+$ 12.21</h2>
                            </div>
                            <div class="main-right-bottom-three-left-cont">
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <h3>James</h3>
                                <h2>+$ 12.21</h2>
                            </div>
                            <div class="main-right-bottom-three-left-cont">
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <h3>Samantha</h3>
                                <h2 style="color: #F13E3E;">-$ 12.21</h2>
                            </div>
                            <!-- <div class="map" id="map"></div> -->
                        </div>
                        <div class="main-right-bottom-three-right">
                            <div class="main-right-bottom-three-right-left">
                                <h1>Credits per Waste Qunatity</h1>
                                <i class='bx bx-dollar-circle'></i> <button onclick="redirect_credits_per()">
                                    Change
                                </button>
                            </div>
                            <div class="main-right-bottom-three-right-right">
                                <h1>Centers</h1>
                                <div class="map" id="map"></div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="pop-eco_credits" id="pop-eco_credits">
                <form class="Eco_Credits-main" method="post" action="<?php echo URLROOT;?>/admin/pop_eco_credit">
                    <div class="Eco_Credits-main-top">
                        <h1> Eco Credits Per Kilogram</h1>
                        <img class="View-content-img" src="<?php echo IMGROOT?>/close_popup.png" id="close-eco_credits">
                    </div>
                    <div class="View-content-content">
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Polythene</h6>
                            <input type="text" name="polythene" value="<?php echo $data['polythene_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Plastic</h6>
                            <input type="text" name="plastic" value="<?php echo $data['plastic_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Glass</h6>
                            <input type="text" name="glass" value="<?php echo $data['glass_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Paper Waste</h6>
                            <input type="text" name="paper" value="<?php echo $data['paper_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Electronic Waste</h6>
                            <input type="text" name="electronic" value="<?php echo $data['electronic_credit']; ?>">
                        </div>
                        <div class="View-content-content-content">
                            <i class='bx bx-purchase-tag'></i>
                            <h6>Metals</h6>
                            <input type="text" name="metal" value="<?php echo $data['metal_credit']; ?>">
                        </div>

                    </div>

                    <button type="submit">Update</button>
                </form>
            </div>
            <div class="pop-rupee_value" id="pop-rupee_value">
                <div class="rupee-main">
                    <div class="rupee-main-top">
                        <h1>Rupee Value per Eco Credit </h1>
                        <img class="View-content-img" src="<?php echo IMGROOT?>/cancel.png" id="close-rupee">
                    </div>
                    <div class="rupee-main-down">
                        <h4>1 Eco Credit =</h4>
                        <input type="text" value="100">
                    </div>
                    <button>Update</button>
                </div>

            </div>
            <div class="overlay" id="overlay">

            </div>
        </div>
        <!-- <script src="Admin_Dashboard.js"></script> -->
    </div>
</div>


<script>
function redirect_customers() {
    var linkUrl = "<?php echo URLROOT?>/admin/customers"; // Replace with your desired URL
    window.location.href = linkUrl;
}

function redirect_collectors() {
    var linkUrl = "<?php echo URLROOT?>/admin/collectors"; // Replace with your desired URL
    window.location.href = linkUrl;
}

function redirect_centermanagers() {
    var linkUrl = "<?php echo URLROOT?>/admin/center_managers"; // Replace with your desired URL
    window.location.href = linkUrl;
}

function redirect_discountAgents() {
    var linkUrl = "<?php echo URLROOT?>/admin/discount_agents"; // Replace with your desired URL
    window.location.href = linkUrl1
}

function redirect_credits_per() {
    var locationPop = document.querySelector('.pop-eco_credits');
    locationPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

var close_pop_ecocredits = document.getElementById('close-eco_credits');
close_pop_ecocredits.addEventListener('click', function() {
    var locationPop = document.querySelector('.pop-eco_credits');
    locationPop.classList.remove('active');
    document.getElementById('overlay').style.display = "none";

});


const customer_count = <?php echo $data['customer_count']?>;
const cm_count = <?php echo $data['cm_count']?>;
const collector_count = <?php echo $data['collector_count']?>;

const customerCountElement = document.getElementById('customer_count');
const collectorCountElement = document.getElementById('collector_count');
const cmCountElement = document.getElementById('cm_count');

function updateCount(currentValue) {
    customerCountElement.textContent = currentValue;
}

function updateCount2(currentValue) {
    collectorCountElement.textContent = currentValue;
}

function updateCount3(currentValue) {
    cmCountElement.textContent = currentValue;
}

for (let i = 0; i <= customer_count; i++) {
    setTimeout(() => {
        updateCount(i);
    }, i * 80); // Change 1000 to control the speed of counting (milliseconds)
}
for (let i = 0; i <= collector_count; i++) {
    setTimeout(() => {
        updateCount2(i);
    }, i * 80); // Change 1000 to control the speed of counting (milliseconds)
}
for (let i = 0; i <= cm_count; i++) {
    setTimeout(() => {
        updateCount3(i);
    }, i * 80); // Change 1000 to control the speed of counting (milliseconds)
}

function initMap() {
    var center = {
        lat: 7.7,
        lng: 80.7718
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        center: center,
        zoom: 5.8,
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
        scaledSize: new google.maps.Size(19, 18)
    };

    var points = <?php echo $data['centers']; ?>;
    points.forEach((point) => {
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat(point.lat),
                lng: parseFloat(point.longi)
            },
            map: map,
            title: point.region,
            icon: customColoredMarkerIcon
        });

        marker.addListener('click', function() {
            var infowindow = new google.maps.InfoWindow({
                content: point.region
            });
            infowindow.open(map, marker);
        });
    });
}
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>