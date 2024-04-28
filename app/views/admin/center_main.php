<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Main">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMaps" async
            defer></script>
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <a href="<?php echo URLROOT?>/admin/center">
                        <div class="main-right-top-back-button">
                            <i class='bx bxs-chevrons-left'></i>
                        </div>
                    </a>
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
                        <i class='bx bx-bell'></i>
                        <div class="dot"></div>
                    </div>

                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                        <div class="main-right-top-profile-cont">
                            <h3>Admin</h3>
                        </div>
                    </div>


                </div>

                <div class="main-bottom">
                    <div class="header-title-wrapper">
                        <div class="header-title">
                            <h1>Analytics</h1>
                            <p>
                                Display analytics about center
                            </p>
                        </div>
                        <div class="center-details-card">
                            <img src="<?php echo IMGROOT?>/facility.png" alt="" />
                            <div class="center-details-card-content">
                                <h2><?php echo $data['center']->region?></h2>
                                <p>Center ID: CEN<?php echo $data['center']->id?></p>
                            </div>
                        </div>
                    </div>

                    <div class="analytics-boxes">
                        <h3 class="section-head">Overview</h3>
                        <div class="analytics">
                            <a
                                href="<?php echo URLROOT?>/Admin/center_main_collectors/<?php echo $data['center']->id?>">
                                <div class="analytic first-analytic">
                                    <div class="analytic-icon">
                                        <!-- <img src="<?php echo IMGROOT?>/blue_collector.png" class="icon-image" alt="" /> -->
                                        <i class='bx bx-group'></i>
                                    </div>
                                    <div class="analytic-info">
                                        <h3>Garbage Collectors</h3>
                                        <h1><?php echo $data['no_of_collectors']?></h1>
                                    </div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/Admin/center_main_workers/<?php echo $data['center']->id?>">
                                <div class="analytic second-analytic">
                                    <div class="analytic-icon">
                                        <!-- <img src="<?php echo IMGROOT?>/red_worker.png" class="icon-image" alt="" /> -->
                                        <i class='bx bx-group'></i>
                                    </div>
                                    <div class="analytic-info">
                                        <h3>Center workers</h3>
                                        <h1><?php echo $data['no_of_workers']?></h1>
                                    </div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/Admin/incoming_requests/<?php echo $data['center']->region?>">
                                <div class="analytic third-analytic">
                                    <div class="analytic-icon">
                                        <!-- <img src="<?php echo IMGROOT?>/green_requests.png" class="icon-image" alt="" /> -->
                                        <i class='bx bx-send'></i>
                                    </div>
                                    <div class="analytic-info">
                                        <h3>Total Requests</h3>
                                        <h1><?php echo $data['total_requests']?></h1>
                                    </div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/Admin/waste_handover/<?php echo $data['center']->region?>">
                                <div class="analytic fourth-analytic">
                                    <div class="analytic-icon">
                                        <!-- <img src="<?php echo IMGROOT?>/brown_bin.png" class="icon-image" alt="" /> -->
                                        <i class='bx bx-trash-alt'></i>
                                    </div>
                                    <div class="analytic-info">
                                        <h3>Garbage Stock</h3>
                                        <h1><?php echo $data['total_garbage']; ?><small> kg</small></h1>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="details-cards">
                        <div class="details-cards-right">
                            <div class="center-manager-card">
                                <h3 class="section-subhead">Center Manager</h3>
                                <div class="center-manager-content">
                                    <?php if (isset($data['center_manager']->image) && !empty($data['center_manager']->image)) : ?>
                                    <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $data['center_manager']->image?>"
                                        alt="Center Manager Image">
                                    <?php else : ?>
                                    <!-- Placeholder image or message if no image is available -->
                                    <img src="<?php echo IMGROOT?>/img_upload/center_manager/Profile.png"
                                        alt="Center Manager Image"> <?php endif; ?>

                                    <div class="center-manager-info">
                                        <?php if (!empty($data['center']->center_manager_name)) : ?>

                                        <div class="height"></div>
                                        <?php else : ?>
                                        <h3>Center Disabled </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($data['center']->center_manager_id)) : ?>
                                        <h1>Manager ID: <?php echo $data['center']->center_manager_id?></h1>
                                        <?php else : ?>
                                        <h1>Change the CM to enable</h1>
                                        <?php endif; ?>

                                    </div>
                                    <div class="center-manager-change">
                                        <a
                                            href="<?php echo URLROOT?>/admin/center_main_change_cm/<?php echo $data['center']->id?>">
                                            <button>Change</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="details-cards-left">
                            <div class="graph-card">
                                <h3 class="section-subhead">Off Days Calendar</h3>
                                <div class="calander-container">
                                    <div class="wrapper">
                                        <header>
                                            <p class="current-date"></p>
                                            <div class="icons">
                                                <i id="prev" class='bx bx-chevron-left'></i>
                                                <i id="next" class='bx bx-chevron-right'></i>
                                            </div>
                                        </header>
                                        <div class="calendar">
                                            <ul class="weeks">
                                                <li>Sun</li>
                                                <li>Mon</li>
                                                <li>Tue</li>
                                                <li>Wed</li>
                                                <li>Thu</li>
                                                <li>Fri</li>
                                                <li>Sat</li>
                                            </ul>
                                            <ul class="days"></ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="location-map-card">
                                <h3 class="section-subhead">Center Location</h3>
                                <div class="center-map-container">
                                    <div class="center-location-map-container">
                                    </div>
                                    <div class="change-location">
                                        <button onclick="changeCenterLocation()">Change Location</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <?php if($data['change_cm']=='True') : ?>
        <div class="change_center_manager_pop">
            <div class="change_center_manager">
                <form action="<?php echo URLROOT;?>/admin/center_main_change_cm/<?php echo $data['center']->id?>"
                    method="post">
                    <label for="centerManager">Selelct Center Manager</label>
                    <select name="centerManager" id="centerManager">
                        <?php
                $centerManagers = $data['not_assigned_cm'];
                if (!empty($centerManagers)) {
                    foreach ($centerManagers as $manager) {
                        echo "<option value=\"$manager->id\">CM $manager->id</option>";
                    }
                } else {
                    echo "<option value=\"default\">No Center Managers Available</option>";
                }
                ?>
                    </select>
                    <button type="submit">Change Center Manager</button>
                    <a
                        href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>"><button
                            type="button" class="cancel">Cancel</button></a>
                </form>
            </div>
        </div>
        <?php endif; ?>
        <div class="overlay" id="overlay">

        </div>

        <form class="change_center_locationpop" id="change_location"
            action="<?php echo URLROOT; ?>/admin/center_main/<?php echo $data['center_id']?>/<?php echo $data['region']?>"
            method="post">
            <div class="content">
                <h4>Change Center Location</h4>
                <div class="content-map" id="center-location-change">

                </div>
                <div class="button-container">
                    <button type="button" class="change" onclick="getLocation()">Change</button>
                    <button type="button" class="cancel" onclick="closeCenterLocation()">Cancel</button>
                </div>
                <input type="hidden" id="latittude" value=" <?php echo $data['lattitude']?>" name="latittude">
                <input type="hidden" id="longitude" value=" <?php echo $data['longitude']?>" name="longitude"> <input
                    type="hidden" id="longitude">
                <input type="hidden" id="radius" value=" <?php echo $data['radius']?>" name="radius">
        </form>
    </div>
</div>

</div>
<script>
var map;
var circle;

function initMaps(latitude = <?php echo $data['center']->lat; ?>, longitude = <?php echo $data['center']->longi?>) {
    var mapCenter = {
        lat: <?php echo $data['center']->lat; ?>,
        lng: <?php echo $data['center']->longi?>
    };

    // Initialize the first map
    var map = new google.maps.Map(document.querySelector('.center-location-map-container'), {
        center: mapCenter,
        zoom: 8
    });

    // Add a marker to the first map
    var marker = new google.maps.Marker({
        position: mapCenter,
        map: map,
        title: 'Marked Location'
    });

    // Set the default latitude and longitude
    var defaultLatLng = {
        lat: latitude,
        lng: longitude
    };

    // Add a circle to the first map
    var circle2 = new google.maps.Circle({
        map: map,
        center: defaultLatLng,
        radius: <?php echo $data['center']->radius?>,
        fillColor: '#47b076',
        fillOpacity: 0.3,
        strokeColor: '#47b076',
        strokeOpacity: 1,
        strokeWeight: 2
    });

    // Initialize the second map
    var map2 = new google.maps.Map(document.getElementById('center-location-change'), {
        center: defaultLatLng,
        zoom: 9
    });

    // Add a circle to the second map
    circle = new google.maps.Circle({
        map: map2,
        center: defaultLatLng,
        radius: <?php echo $data['center']->radius?>,
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


function changeCenterLocation() {
    var change_location = document.getElementById('change_location');
    change_location.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function closeCenterLocation() {
    var change_location = document.getElementById('change_location');
    change_location.classList.remove('active');
    document.getElementById('overlay').style.display = "none";
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

    // Submit the form
    document.getElementById('change_location').submit();
}

/*Calendar*/
const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".current-date"),
prevNextIcon = document.querySelectorAll(".icons i");

// getting new date, current year and month
let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

var markedHolidays = <?php echo json_encode($data['marked_holidays']); ?>;

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];

const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                     && currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li class="${isToday}">${i}</li>`;

       
    }

    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;
}
renderCalendar();

prevNextIcon.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
        } else {
            date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
    });
});



</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>