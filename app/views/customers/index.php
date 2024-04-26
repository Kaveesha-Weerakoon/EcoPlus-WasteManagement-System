<?php require APPROOT . '/views/inc/header.php'; ?>


<div class="Customer_Main">

    <div class="Customer_Dashboard">
        <script
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
            async defer>
        </script>
        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-help-circle'></i>
                        <input type="text" id="userGuid" placeholder="User Guide" readonly>
                    </div>
                    <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>

                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-one">
                        <div class="main-right-bottom-one-left">
                            <div class="left">
                                <h1>Total Balance</h1>
                                <?php echo $data['latest_update']?>
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
                             ?>

                            <?php if (empty($limited_transactions)): ?>
                            <div class="empty-transaction">You Have No Transactions Yet</div>
                            <?php else: ?>
                            <div class="transaction-history">
                                <?php foreach ($limited_transactions as $transaction): ?>
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
                                    <h3>
                                        <?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                        <?php echo $transaction->receiver_id; ?>
                                        <?php else: ?>
                                        <?php echo $transaction->sender_id; ?>
                                        <?php endif; ?>
                                    </h3>
                                    <p>
                                        <?php
                                                $date = date('Y-m-d', strtotime($transaction->date));
                                                echo $date 
                                                ?>
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
                            <?php endif; ?>

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

                        <div class="main-right-bottom-two-cont A" onclick="redirect_garbageTypes()">
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
                            <div id="chartMessage" class="message">No data available.</div>
                        </div>


                    </div>
                </div>

            </div>

            <div class="overlay" id="overlay">

            </div>
            <div class="Centers_pop" id="centers">
                <div class="centers_top">
                    <h2>Regional Centers</h2>
                    <i class="fa-regular fa-circle-xmark" id="centers_close"></i>
                </div>

                <div id="map" class="centers">

                </div>
            </div>
        </div>
        <?php if ($data['tutorial'] == 'True'): ?>
        <div class="tutorial">
            <div class="cont">
                <div class="tutorial-step" id="step1">
                    <h2>Welcome to Eco Plus <?php
                          $user_name = $_SESSION['user_name'];
                          $name_parts = explode(' ', $user_name);
                          $first_name = $name_parts[0];
                          echo $first_name;
                          ?> !</h2>
                    <p>Request a garbage collect by clicking the <b>Request Now </b> button</p>
                    <img src="<?php echo IMGROOT?>/two.png" alt="">
                </div>
                <div class="tutorial-step" id="step2">
                    <h2>View Wallet Amount !</h2>
                    <p>Wallet Amount Shows Current <b>Eco Credit</b> Balance </p>
                    <img src="<?php echo IMGROOT?>/two.png" alt="">
                </div>
                <div class="tutorial-step" id="step3">
                    <h2>Overall Collection Total </h2>
                    <p>Overall Collection Total shows Overall garbage you handoverd in the collections</p>
                    <img src="<?php echo IMGROOT?>/two.png" alt="">
                </div>
                <div class="tutorial-step" id="step4">
                    <h2>Transfer your Eco Credits!</h2>
                    <p>You can view all the Transaction from history</p>
                    <img src="<?php echo IMGROOT?>/two.png" alt="">
                </div>
                <div class="tutorial-step" id="step5">
                    <h2>You Have Caught all !</h2>
                    <p>Dive into our service now !</p>
                    <a href="<?php echo URLROOT?>/customers"><button>Dashboard</button></a>
                </div>
                <div class="step-indicators">
                    <span class="step-dot active" onclick="goToStep(1)"></span>
                    <span class="step-dot" onclick="goToStep(2)"></span>
                    <span class="step-dot" onclick="goToStep(3)"></span>
                    <span class="step-dot" onclick="goToStep(4)"></span>
                    <span class="step-dot" onclick="goToStep(5)"></span>
                </div>
            </div>
        </div>
        <?php endif; ?>


    </div>


</div>

<script>
var color = "#47b076";
var textColor = "#414143"
var checkbox = document.getElementById('toggle-checkbox');

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

function redirect_garbageTypes() {
    var linkUrl = "<?php echo URLROOT?>/customers/garbage_types"; // Replace with your desired URL
    window.location.href = linkUrl;
}

/* Notification View */
document.getElementById('submit-notification').onclick = function() {
    var form = document.getElementById('mark_as_read');
    var dynamicUrl = "<?php echo URLROOT;?>/customers/view_notification/index";
    form.action = dynamicUrl; // Set the action URL
    form.submit(); // Submit the form
};
/* ----------------- */

document.getElementById("centers_close").addEventListener("click", function() {
    document.getElementById("centers").classList.remove('active');
    document.getElementById('overlay').style.display = "none";
});

const no_of_centers = <?php echo $data['no_of_centers']?>;
const completed_Request_count = <?php echo $data['completed_request_count']?>;
const discountAgentCount = <?php echo $data['discount_agent']?>;
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

        if (i <= discountAgentCount) {
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
        zoom: 6.2,
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
    var config = null;
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
    console.log(Total_Garbage.total_plastic);
    if (Total_Garbage.total_plastic == null &&
        Total_Garbage.total_polythene == null &&
        Total_Garbage.total_metals == null &&
        Total_Garbage.total_glass == null &&
        Total_Garbage.total_paper_waste == null &&
        Total_Garbage.total_electronic_waste == null) {
        document.getElementById('myChart').style.display = "none";
        document.getElementById('chartMessage').style.display = "flex";

    } else {
        if (myChart) {
            myChart.destroy();
        }
        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Plastic', 'Polythene', 'Metal', 'Glass', 'Paper', 'Electronic'],
                datasets: [{
                    label: 'Kilograms',
                    data: [Total_Garbage.total_plastic,
                        Total_Garbage.total_polythene,
                        Total_Garbage.total_metals,
                        Total_Garbage.total_glass,
                        Total_Garbage.total_paper_waste,
                        Total_Garbage.total_electronic_waste
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
                        suggestedMax: Math.max.apply(null, [Total_Garbage.total_plastic,
                            Total_Garbage.total_polythene,
                            Total_Garbage.total_metals,
                            Total_Garbage.total_glass,
                            Total_Garbage.total_paper_waste,
                            Total_Garbage.total_electronic_waste
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
}
createOrUpdateChart(color, textColor);

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


/**/
/*animation*/
window.addEventListener('DOMContentLoaded', (event) => {
    const contentContainers = document.querySelectorAll('.main-right-bottom-two-cont');
    contentContainers.forEach(container => {
        container.classList.add('slide-in');
    });
});

/* Tutotorial */
let currentStep = 1;

function nextStep() {
    const currentStepElement = document.getElementById('step' + currentStep);
    currentStepElement.style.display = 'none';
    deactivateStepIndicator(currentStep);
    currentStep++;
    const nextStepElement = document.getElementById('step' + currentStep);
    if (nextStepElement) {
        nextStepElement.style.display = 'flex';
        activateStepIndicator(currentStep);
    } else {
        currentStep--;
    }
}

function prevStep() {
    const currentStepElement = document.getElementById('step' + currentStep);
    currentStepElement.style.display = 'none';
    deactivateStepIndicator(currentStep);
    currentStep--;
    const prevStepElement = document.getElementById('step' + currentStep);
    if (prevStepElement) {
        prevStepElement.style.display = 'flex';
        activateStepIndicator(currentStep);
    } else {
        currentStep++;
    }
}

function activateStepIndicator(step) {
    const stepDot = document.querySelectorAll('.step-dot')[step - 1];
    stepDot.classList.add('active');
}

function deactivateStepIndicator(step) {
    const stepDot = document.querySelectorAll('.step-dot')[step - 1];
    stepDot.classList.remove('active');
}

function goToStep(step) {
    const currentStepElement = document.getElementById('step' + currentStep);
    currentStepElement.style.display = 'none';
    deactivateStepIndicator(currentStep);
    currentStep = step;
    const nextStepElement = document.getElementById('step' + currentStep);
    if (nextStepElement) {
        nextStepElement.style.display = 'flex';
        activateStepIndicator(currentStep);
    }
}


document.getElementById("userGuid").addEventListener("click", function() {
    console.log('hello');
    window.location.href = '<?php echo URLROOT?>/customers/True';
});
/* ---------------- */
</script>
<script src="<?php echo JSROOT?>/Customer.js"> </script>
<?php require APPROOT . '/views/inc/footer.php'; ?>