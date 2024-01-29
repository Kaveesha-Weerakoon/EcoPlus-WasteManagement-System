<?php require APPROOT . '/views/inc/header.php'; ?>


<div class="Customer_Main">

    <div class="Customer_Dashboard">

        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bxl-sketch'></i> <input type="text" placeholder="Welcome Back !" id="searchInput"
                            readonly oninput="highlightMatchingText()">
                    </div>
                    <div class="main-right-top-notification" id="notification">
                        <i class='bx bx-bell'></i>
                        <?php if (!empty($data['notification'])) : ?>
                        <div class="dot"><?php echo count($data['notification'])?></div>
                        <?php endif; ?>
                    </div>
                    <div id="notification_popup" class="notification_popup">
                        <h1>Notifications</h1>
                        <div class="notification_cont">
                            <?php foreach($data['notification'] as $notification) : ?>

                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                <div class="notification_right">
                                    <p><?php echo date('Y-m-d', strtotime($notification->datetime)); ?></p>
                                    <?php echo $notification->notification ?>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                        <form class="mark_as_read" method="post" action="<?php echo URLROOT;?>/customers/">
                            <i class="fa-solid fa-check"> </i>
                            <button type="submit">Mark all as read</button>
                        </form>

                    </div>
                    <div class="main-right-top-profile" id="profile">
                        <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['user_name']?></h3>
                            <p>ID : C <?php echo $_SESSION['user_id']?></p>
                        </div>
                    </div>
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-one">
                        <div class="main-right-bottom-one-left">
                            <div class="left">
                                <h1>Total Balance</h1>
                                <h3>+Eco 26.23 </h3>
                                <p>Last Update</p>
                                <button onclick="redirect_transfercredit()">
                                    Transfer Credit
                                </button>

                            </div>

                            <div class="right">
                                <h1>Eco<span class="main-credit"> <?php echo $data['credit_balance']?></span> </h1>
                                <h3>WALLET AMOUNT</h3>
                            </div>
                        </div>
                        <div class="main-right-bottom-one-right">
                            <h1>Recent Transactions</h1>

                            <?php
                                 $transaction_history = $data['transaction_history'];
                                 $limited_transactions = array_slice($transaction_history, 0, 3);

                                 foreach ($limited_transactions as $transaction):
                            ?>
                            <div class="main-right-bottom-one-right-cont">
                                <?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                <img class="td-pro_pic"
                                    src="<?php echo (empty($transaction->receiver_img) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/' . $transaction->receiver_img) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->receiver_img; ?>"
                                    alt="">
                                <?php else: ?>
                                <img class="td-pro_pic"
                                    src="<?php echo (empty($transaction->sender_img) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/'. $transaction->sender_img) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->sender_img; ?>"
                                    alt="">
                                <?php endif; ?>
                                <h3><?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                    C <?php echo $transaction->receiver_id; ?>
                                    <?php else: ?>
                                    C <?php echo $transaction->sender_id; ?>
                                    <?php endif; ?>
                                </h3>
                                <p>
                                    <?php echo $transaction->date ?>
                                </p>
                                <h2
                                    style="color: <?php echo ($transaction->sender_id == $_SESSION['user_id']) ? '#F13E3E' : '#1ca557'; ?>;">
                                    <?php
                                        echo ($transaction->sender_id == $_SESSION['user_id']) ? "-Eco " : "+Eco ";
                                        echo $transaction->transfer_amount;
                                    ?>
                                </h2>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-cont A">
                            <div class="icon_container">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div class="content_container" onclick="centers()">
                                <h3>Centers</h3>
                                <h2 id="center_count">14</h2>
                            </div>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_completed()">
                            <div class="icon_container">
                                <i class='bx bx-message-alt-check'></i>
                            </div>
                            <div class="content_container">
                                <h3>Fulfilled Requests</h3>
                                <h2 id="request_count">12</h2>
                            </div>
                        </div>

                        <div class="main-right-bottom-two-cont A" onclick="redirect_discountAgents()">
                            <div class="icon_container">
                                <i class='bx bxs-bank'></i>
                            </div>
                            <div class="content_container">
                                <h3>Discount Agents</h3>
                                <h2 id="agent_count">6</h2>
                            </div>
                        </div>

                        <div class="main-right-bottom-two-cont A" id="credit_per_waste_quantity">
                            <div class="icon_container">
                                <i class='bx bx-dollar-circle'></i>
                            </div>
                            <div class="content_container">
                                <h3>Garbage Types</h3>
                                <h2 id="garbage_count">6</h2>
                            </div>
                        </div>
                    </div>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-left">
                            <div class="main-right-bottom-three-left-left">
                                <h3>Available Hours: 8am to 4pm</h3>
                                <p>Request a collect Now</p>
                                <button onclick="redirect_requests()" type="button" id="setButton">Request Now</button>
                            </div>
                            <div class="main-right-bottom-three-left-right">
                                <h1>Requests Satisfied</h1>
                                <div class="main-right-bottom-three-left-right-cont">
                                    <div class="circular-progress">
                                        <span class="progress-value">
                                            0 %
                                        </span>
                                    </div>
                                    <div class="legend-container">
                                        <div class="legend LL">
                                            <div class="uncompleted"></div>
                                            <span>Uncompleted</span>
                                        </div>
                                        <div class="legend LR">
                                            <div class="completed"></div>
                                            <span>Completed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="map" id="map"></div> -->
                        </div>

                        <div class="main-right-bottom-three-right">
                            <canvas id="myChart" width="600" height="250"></canvas>

                        </div>

                    </div>
                </div>

            </div>
            <div class="eco_credit_per_quantity" id="eco_credit_per_quantiy_pop">
                <img src="<?php echo IMGROOT?>/close_popup.png" alt="" id="close_eco_credit_per_quantiy_pop">
                <h1>Eco Credits per Waste Qunatity</h1>
                <div class="Eco_Credit_Per_Cont">
                    <div class="Cont">
                        <h3>Plastic</h3>
                        <i class="icon fas fa-box"></i>
                        <p><?php echo $data['eco_credit_per']->plastic?></p>
                    </div>
                    <div class="Cont">
                        <h3>Polythene</h3>
                        <i class="icon fas fa-trash"></i>
                        <p><?php echo $data['eco_credit_per']->polythene?></p>
                    </div>
                    <div class="Cont">
                        <h3>Metal</h3>
                        <i class="icon fas fa-box"></i>
                        <p><?php echo $data['eco_credit_per']->metal?></p>
                    </div>
                    <div class="Cont">
                        <h3> Glass</h3>
                        <i class="icon fas fa-glass-whiskey"></i>
                        <p><?php echo $data['eco_credit_per']->glass?></p>
                    </div>

                    <div class="Cont">
                        <h3>Paper</h3>
                        <i class="icon fas fa-file-alt"></i>
                        <p><?php echo $data['eco_credit_per']->paper?></p>
                    </div>
                    <div class="Cont">
                        <h3>Electronic</h3>
                        <i class="icon fas fa-laptop"></i>
                        <p><?php echo $data['eco_credit_per']->electronic?></p>
                    </div>
                </div>
                <h2>Per Kg</h2>

            </div>
            <div class="overlay" id="overlay">

            </div>
            <div class="Centers_pop" id="centers">
                <div class="centers_top">
                    <h2>Regional Centers</h2>
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="centers_close" id="centers_close">
                </div>

                <div id="map" class="centers">

                </div>
            </div>
            <script src="CustomerDashboard.js"></script>
        </div>

    </div>


</div>

<script>
var color = "#47b076";
var textColor = "#414143"

var checkbox = document.getElementById('toggle-checkbox');

var credit_per_waste_quantity = document.getElementById("credit_per_waste_quantity");

var notification = document.getElementById("notification");
var notification_pop = document.getElementById("notification_popup");
notification_pop.style.height = "0px";
let circularProgress = document.querySelector(".circular-progress");
let progressValue = document.querySelector(".progress-value");
let progressStartValue = -1;
let progressEndValue = <?php echo intval($data['percentage']); ?>;
let speed = 30;

function getDarkModeSetting() {
    const storedValue = localStorage.getItem("darkMode");
    return storedValue ? JSON.parse(storedValue) : true;
}

isDarkMode = getDarkModeSetting();
if (getDarkModeSetting()) {

    color = "white"
    textColor = " white";
    circularProgress.style.background =
        `conic-gradient(${color}, ${progressStartValue * 3.6}deg, ${isDarkMode ? "#001f3f" : "#ededed"} 0deg)`;
}

function centers() {
    document.getElementById("centers").classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function redirect_transfercredit() {
    var linkUrl = "<?php echo URLROOT?>/customers/transfer";
    window.location.href = linkUrl;
}

function redirect_completed() {
    var linkUrl = "<?php echo URLROOT?>/customers/request_completed";
    window.location.href = linkUrl;
}

function redirect_requests() {
    var linkUrl = "<?php echo URLROOT?>/customers/request_collect";
    window.location.href = linkUrl;
}

function redirect_discountAgents() {
    var linkUrl = "<?php echo URLROOT?>/customers/discount_agents"; // Replace with your desired URL

    window.location.href = linkUrl;

}

notification.addEventListener("click", function() {
    var isNotificationEmpty = <?php echo json_encode(empty($data['notification'])); ?>;

    if (!isNotificationEmpty) {
        var notificationArraySize = <?php echo json_encode(count($data['notification'])); ?>;
        if (notification_pop.style.height === "0px") {
            if (notificationArraySize >= 3) {
                notification_pop.style.height = "210px";
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

document.getElementById("credit_per_waste_quantity").addEventListener("click", function() {
    document.getElementById("eco_credit_per_quantiy_pop").classList.add('active');
    document.getElementById('overlay').style.display = "flex";
});

document.getElementById("close_eco_credit_per_quantiy_pop").addEventListener("click", function() {
    document.getElementById("eco_credit_per_quantiy_pop").classList.remove('active');
    document.getElementById('overlay').style.display = "none";
});
document.getElementById("centers_close").addEventListener("click", function() {
    document.getElementById("centers").classList.remove('active');
    document.getElementById('overlay').style.display = "none";
});
const no_of_centers = <?php echo $data['no_of_centers']?>;
const completed_Request_count = <?php echo $data['completed_request_count']?>;
const garbage_types = 6;

const centerCountElement = document.getElementById('center_count');
const requestsCountElement = document.getElementById('request_count');
const discountAgents = document.getElementById('agent_count');
const garbage = document.getElementById('garbage_count');

function updateCount(currentValue) {
    centerCountElement.textContent = currentValue;
}

function updateCount2(currentValue) {
    requestsCountElement.textContent = currentValue;
}

function updateCount3(currentValue) {
    discountAgents.textContent = currentValue;
}

function updateCount4(currentValue) {
    garbage.textContent = currentValue;
}

const maxCount = Math.max(no_of_centers, completed_Request_count, 8, 6);

for (let i = 0; i <= maxCount; i++) {
    setTimeout(() => {
        if (i <= no_of_centers) {
            updateCount(i);
        }

        if (i <= completed_Request_count) {
            updateCount2(i);
        }

        if (i <= 8) {
            updateCount3(i);
        }

        if (i <= 6) {
            updateCount4(i);
        }
    }, i * 25);
}

function initMap() {
    var center = {
        lat: 7.7,
        lng: 80.7718
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        center: center,
        zoom: 6.5,
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



    var points = <?php echo $data['centers']; ?>;
    points.forEach((point) => {
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat(point.lat),
                lng: parseFloat(point.longi)
            },
            map: map,
            title: point.region,

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
    if (!getDarkModeSetting()) {
        circularProgress.style.background =
            circularProgress.style.background =
            `conic-gradient(${color}, ${progressStartValue * 3.6}deg, #ededed 0deg)`;
    } else {
        circularProgress.style.background =
            `conic-gradient(${color}, ${progressStartValue * 3.6}deg, #001f3f 0deg)`;
    }


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

checkbox.addEventListener("change", function() {

    if (getDarkModeSetting()) {
        color = "white";
        textColor = "white";
        circularProgress.style.background =
            `conic-gradient(${color}, ${progressStartValue * 3.6}deg, ${isDarkMode ? "#001f3f" : "#001f3f"} 0deg)`;
    } else {
        color = "#47b076";
        textColor = "#414143";
        circularProgress.style.background =
            `conic-gradient(${color}, ${progressStartValue * 3.6}deg, #ededed 0deg)`;
    }
    if (myChart) {
        myChart.destroy();
    }
    createOrUpdateChart(color, textColor);
});

createOrUpdateChart(color, textColor);
</script>
<script src="<?php echo JSROOT?>/Customer.js"> </script>
<?php require APPROOT . '/views/inc/footer.php'; ?>