<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">

    <div class="CenterManager_Dashboard">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

            <div class="main-right">

                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
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
                        <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['center_manager_name']?></h3>
                            <p>ID : CM <?php echo $_SESSION['center_manager_id']?></p>
                        </div>
                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-one">
                        <div class="main-right-bottom-one-left">
                            <div class="left">
                                <h1>Incoming Requests</h1>
                                <h3>10</h3>
                                <p>Last Update</p>
                                <button onclick="redirect_incoming_requests()">View</button>

                            </div>

                            <div class="right">
                                <i class='bx bx-building-house'></i>
                                <h1><?php echo $data['center_name']?><span class="main-credit"></span> </h1>
                                <h3>Center ID: CEN <?php echo $data['center_id']?></h3>
                            </div>
                        </div>
                        <div class="main-right-bottom-one-right">
                            <div class="left">
                                <!-- <h1>Incoming Requests</h1> -->
                                <h3>Available Hours: 8am to 5pm</h3>
                                <p>Except Holidays</p>
                                <!-- <button onclick="redirect_incoming_requests()">View</button> -->

                            </div>

                            <div class="right">

                            </div>


                        </div>
                    </div>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-cont A" onclick="redirect_collectors()">
                            <div class="icon_container">
                                <i class='bx bx-user'></i>
                            </div>
                            <h3>Collectors</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_center_workers()">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h3>Center Workers</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_completed_requests()">
                            <div class="icon_container">
                                <i class='bx bx-message-alt-check'></i>
                            </div>
                            <h3>Fulfilled Requests</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_complaints()">
                            <div class="icon_container">
                                <i class='bx bx-donate-heart'></i>
                            </div>
                            <h3>Complaints</h3>
                        </div>

                    </div>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-left">
                            <canvas id="myChart" width="600" height="250"></canvas>

                        </div>

                        <div class="main-right-bottom-three-right">
                            <div class="main-right-bottom-three-right-left">
                                <h1>Requests Satisfied</h1>
                                <div class="main-right-bottom-three-right-cont">
                                    <div class="circular-progress">
                                        <span class="progress-value">
                                            0 %
                                        </span>
                                    </div>
                                </div>
                                <button>
                                    Request Now
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


        </div>
    </div>
</div>
<script>
var color = "#47b076";
var textColor = "#414143";

var notification = document.getElementById("notification");
var notification_pop = document.getElementById("notification_popup");
notification_pop.style.height = "0px";

function redirect_incoming_requests() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/request_incomming";
    window.location.href = linkUrl;
}

function redirect_collectors() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/collectors";
    window.location.href = linkUrl;
}

function redirect_center_workers() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/center_workers";
    window.location.href = linkUrl;
}

function redirect_complaints() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/complaints";
    window.location.href = linkUrl;
}

function redirect_completed_requests() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/request_completed";
    window.location.href = linkUrl;
}

notification.addEventListener("click", function() {
    var isNotificationEmpty = <?php echo json_encode(empty($data['notification'])); ?>;

    if (!isNotificationEmpty) {
        var notificationArraySize = <?php echo json_encode(count($data['notification'])); ?>;
        if (notification_pop.style.height === "0px") {
            if (notificationArraySize >= 3) {
                notification_pop.style.height = "205px";
            }
            if (notificationArraySize == 2) {
                notification_pop.style.height = "150px";
            }
            if (notificationArraySize == 1) {
                notification_pop.style.height = "105px";
            }
            notification_pop.style.visibility = "visible";
            notification_pop.style.opacity = "1";
            notification_pop.style.padding = "7px";
        } else {
            notification_pop.style.height = "0px";
            notification_pop.style.visibility = "hidden";
            notification_pop.style.opacity = "0";
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, config);

    const chartContainer = document.getElementById('chart');
    actions.forEach(action => {
        const button = document.createElement('button');
        button.textContent = action.name;
        button.addEventListener('click', () => action.handler(myChart));
        chartContainer.appendChild(button);
    });
});


function createOrUpdateChart(color, textColor) {
    var Current_Garbage = <?php echo $data['current_garbage']?>;
    const ctx = document.getElementById('myChart').getContext('2d');

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Plastic', 'Polythene', 'Metal', 'Glass', 'Paper', 'Electronic'],
            datasets: [{
                label: 'Kilograms',
                data: [Current_Garbage.current_plastic,
                    Current_Garbage.current_polythene,
                    Current_Garbage.current_metal,
                    Current_Garbage.current_glass,
                    Current_Garbage.current_paper,
                    Current_Garbage.current_electronic
                ],
                backgroundColor: color,
            }]
        },
        options: {
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 14,
                        }
                    },
                    barPercentage: 0.5, // Adjust to decrease the width of the bars
                    categoryPercentage: 0.3 // Adjust to control the space between bars
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: Math.max.apply(null, [Current_Garbage.current_plastic,
                        Current_Garbage.current_polythene,
                        Current_Garbage.current_metal,
                        Current_Garbage.current_glass,
                        Current_Garbage.current_paper,
                        Current_Garbage.current_electronic
                    ]) + 1, // Add some padding to the maximum value
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Current Garbage Stock',
                    color: textColor,
                    font: {
                        size: 18
                    },
                    padding: {
                        bottom: 25
                    }
                }
            },
            elements: {
                bar: {
                    borderRadius: 10,
                }
            },
            animation: {
                duration: 700, // Set the duration of the animation in milliseconds
                easing: 'easeIn' // Set the easing function for the animation
            }
        }
    });
}

createOrUpdateChart(color, textColor);
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>