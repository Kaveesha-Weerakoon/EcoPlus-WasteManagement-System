<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">

    <div class="CenterManager_Dashboard">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <!-- <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bxl-sketch'></i> <input type="text" placeholder="Welcome Back !" id="searchInput"
                            readonly oninput="highlightMatchingText()">
                    </div>
                    <div class="main-right-top-notification" id="notification">
                        <i class='bx bx-bell'></i>
                        <?php if (!empty($data['notification'])) : ?>
                        <div class="dot"></div>
                        <?php endif; ?>
                    </div>
                    <div id="notification_popup" class="notification_popup">
                        <h1>Notifications</h1>
                        <div class="notification_cont">
                            <?php foreach($data['notification'] as $notification) : ?>

                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                <?php echo $notification->notification?>
                            </div>
                            <?php endforeach; ?>

                        </div>
                        <form class="mark_as_read" method="post" action="<?php echo URLROOT;?>/customers/">
                            <i class='bx bx-signal-4'></i>
                            <button type="submit">Mark all as read</button>
                        </form>

                    </div>
                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['user_name']?></h3>
                            <p>ID : C <?php echo $_SESSION['user_id']?></p>
                        </div>
                    </div>
                </div> -->
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
                        <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
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

                            <canvas id="myChart" width="700" height="300"></canvas>
                        </div>
                    </div>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-cont A" id="credit_per_waste_quantity">
                            <div class="icon_container">
                                <i class='bx bx-user'></i>
                            </div>
                            <h3>Collectors</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h3>Center Workers</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A">
                            <div class="icon_container">
                                <i class='bx bxs-bank'></i>
                            </div>
                            <h3>Discount Agents</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_complains()">
                            <div class="icon_container">
                                <i class='bx bx-comment-edit'></i>
                            </div>
                            <h3>Complaints</h3>
                        </div>

                    </div>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-left">
                            <!-- <h1>Recent Transactions</h1>

                            <?php
                                 $transaction_history = $data['transaction_history'];
                                 $limited_transactions = array_slice($transaction_history, 0, 3);

                                 foreach ($limited_transactions as $transaction):
                            ?>
                            <div class="main-right-bottom-three-left-cont">
                                <?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                <img class="td-pro_pic"
                                    src="<?php echo (empty($transaction->receiver_image) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/' . $transaction->receiver_image) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->receiver_image; ?>"
                                    alt="">
                                <?php else: ?>
                                <img class="td-pro_pic"
                                    src="<?php echo (empty($transaction->sender_image) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/'. $transaction->sender_image) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->sender_image; ?>"
                                    alt="">
                                <?php endif; ?>
                                <h3><?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                    C <?php echo $transaction->receiver_id; ?>
                                    <?php else: ?>
                                    C <?php echo $transaction->sender_id; ?>
                                    <?php endif; ?>
                                </h3>
                                <h2
                                    style="color: <?php echo ($transaction->sender_id == $_SESSION['user_id']) ? '#F13E3E' : '#1ca557'; ?>;">
                                    <?php
                                          echo ($transaction->sender_id == $_SESSION['user_id']) ? "-Eco " : "+Eco ";
                                          echo $transaction->transfer_amount;
                                    ?>
                                </h2>
                            </div>
                            <?php endforeach; ?> -->
                            
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
                                <button onclick="redirect_requests()">
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
            
            <!-- <div class="main-right">
                <div class="main-right-left">
                    <div class="main-right-left-one">
                        <div class="main-right-left-one-text">
                            <div class="change">Welcome back</div> Eco plus
                        </div>
                        <div class="main-right-left-one-right">
                            <img src="<?php echo IMGROOT?>/Search.png" alt="">
                            <input type="text" placeholder="Search Anything">
                            <img src="<?php echo IMGROOT?>/notifications.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-left-two">
                        <a href="<?php echo URLROOT?>/centermanagers/collectors" class="main-right-left-two-a">
                            <div class="main-right-left-two-component" style="background-image: url('<?php echo IMGROOT?>/Dashboard1.png');">
                                <h1>Collectors</h1>
                                <img src="<?php echo IMGROOT?>/Collector.png" alt="">
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers" class="main-right-left-two-a">
                            <div class="main-right-left-two-component" style="background-image: url('<?php echo IMGROOT?>/Dashboard2.png');">
                                <h1>Center Workers</h1>
                                <img src="<?php echo IMGROOT?>/Center_Workers.png" alt="">
                            </div>
                        </a>
                    </div> 
                    <div class="main-right-left-three">
                        <div class="main-right-left-three-content">
                            <div class="main-right-left-three-content-left">
                                <img src="<?php echo IMGROOT?>/Center_Img.png" alt="">
                                <h1><?php echo $data['center_name']?></h1>
                                <h4>Center ID: CEN <?php echo $data['center_id']?></h3>
                            </div>
                            <div class="main-right-left-three-content-right">
                                <button>Incoming Requests</button>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="main-right-right">
                    <div class="main-right-right-top">
                        <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
                        <h2><?php echo $_SESSION['center_manager_name']?></h2>
                        <p>Center Manager ID: CM <?php echo $_SESSION['center_manager_id']?></p>
                        <button>Profile</button>
                    </div>
                    <div class="main-right-right-bottom">
                        <img src="<?php echo IMGROOT?>/Dashboard-Man.jpg" alt="">
                    </div>
                </div>
            </div> -->
        </div>
    </div>
 </div>
<script>
var color = "#47b076";
var textColor = "#414143"

var credit_per_waste_quantity = document.getElementById("credit_per_waste_quantity");

var notification = document.getElementById("notification");
var notification_pop = document.getElementById("notification_popup");
notification_pop.style.height = "0px";
let circularProgress = document.querySelector(".circular-progress");
let progressValue = document.querySelector(".progress-value");
let progressStartValue = -1;
let progressEndValue = <?php echo intval($data['percentage']); ?>;
let speed = 30;
console.log(progressEndValue);

function redirect_incoming_requests() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/request_incomming";
    window.location.href = linkUrl;
}

function redirect_complains() {
    var linkUrl = "<?php echo URLROOT?>/customers/complains";
    window.location.href = linkUrl;
}

function redirect_requests() {
    var linkUrl = "<?php echo URLROOT?>/customers/request_collect";
    window.location.href = linkUrl;
}

notification.addEventListener("click", function() {
    var isNotificationEmpty = <?php echo json_encode(empty($data['notification'])); ?>;

    if (!isNotificationEmpty) {
        var notificationArraySize = <?php echo json_encode(count($data['notification'])); ?>;
        if (notification_pop.style.height === "0px") {
            if (notificationArraySize >= 3) {
                notification_pop.style.height = "28%";
            }
            if (notificationArraySize == 2) {
                notification_pop.style.height = "21%";
            }
            if (notificationArraySize == 1) {
                notification_pop.style.height = "15%";
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

document.getElementById("credit_per_waste_quantity").addEventListener("click", function() {
    document.getElementById("eco_credit_per_quantiy_pop").classList.add('active');
    document.getElementById('overlay').style.display = "flex";
});

document.getElementById("close_eco_credit_per_quantiy_pop").addEventListener("click", function() {
    document.getElementById("eco_credit_per_quantiy_pop").classList.remove('active');
    document.getElementById('overlay').style.display = "none";
});


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


let progress = setInterval(() => {
    if (progressStartValue == progressEndValue) {
        clearInterval(progress);
    }
    progressStartValue++;
    progressValue.textContent = `${progressStartValue}%`;

    circularProgress.style.background =
        `conic-gradient(${color}, ${progressStartValue * 3.6}deg, #ededed 0deg)`;

    if (progressStartValue == progressEndValue) {
        clearInterval(progress);
    }
}, speed);

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
    var Total_Garbage = <?php echo $data['total_garbage']?>;
    const ctx = document.getElementById('myChart').getContext('2d');

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Plastic', 'Polythene', 'Metal', 'Glass', 'Paper', 'Electronic'],
            datasets: [{
                label: 'Kilograms',
                data: [Total_Garbage.total_Plastic,
                    Total_Garbage.total_Polythene,
                    Total_Garbage.total_Metals,
                    Total_Garbage.total_Glass,
                    Total_Garbage.total_Paper_Waste,
                    Total_Garbage.total_Electronic_Waste
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
                    suggestedMax: Math.max.apply(null, [Total_Garbage.total_Plastic,
                        Total_Garbage.total_Polythene,
                        Total_Garbage.total_Metals,
                        Total_Garbage.total_Glass,
                        Total_Garbage.total_Paper_Waste,
                        Total_Garbage.total_Electronic_Waste
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
                    text: 'Overall Collection Total',
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
