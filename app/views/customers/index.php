<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">

    <div class="Customer_Dashboard">

        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

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
                        <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3>Kaveesha</h3>
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
                                <button onclick="redirect_transfercredit()">Transfer Credit</button>

                            </div>

                            <div class="right">
                                <h1>Eco<span class="main-credit"> <?php echo $data['credit_balance']?>.00</span> </h1>
                                <h3>WALLET AMOUNT</h3>
                            </div>
                        </div>
                        <div class="main-right-bottom-one-right">

                            <canvas id="myChart" width="688" height="300"></canvas>
                        </div>
                    </div>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-cont A" id="credit_per_waste_quantity">
                            <div class="icon_container">
                                <i class='bx bx-dollar-circle'></i>
                            </div>
                            <h3>Credits per Waste Quantity</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A">
                            <div class="icon_container">
                                <i class='bx bx-money-withdraw'></i>
                            </div>
                            <h3>Eco Credit Value</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A">
                            <div class="icon_container">
                                <i class='bx bxs-bank'></i>
                            </div>
                            <h3>Discount Agents</h3>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_complains()">
                            <div class="icon_container">
                                <i class='bx bx-donate-heart'></i>
                            </div>
                            <h3>Complaints</h3>
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
            <div class="eco_credit_per_quantity" id="eco_credit_per_quantiy_pop">
                <img src="<?php echo IMGROOT?>/close_popup.png" alt="" id="close_eco_credit_per_quantiy_pop">
                <h1>Eco Credits per Waste Qunatity</h1>
                <div class="Eco_Credit_Per_Cont">
                    <div class="Cont">
                        <h3>Plastic</h3>
                        <i class='bx bx-purchase-tag'></i>
                        <p><?php echo $data['eco_credit_per']->plastic?></p>
                    </div>
                    <div class="Cont">
                        <h3>Polythene</h3>
                        <i class='bx bx-purchase-tag'></i>
                        <p><?php echo $data['eco_credit_per']->polythene?></p>
                    </div>
                    <div class="Cont">
                        <h3>Metal</h3>
                        <i class='bx bx-purchase-tag'></i>
                        <p><?php echo $data['eco_credit_per']->metal?></p>
                    </div>
                    <div class="Cont">
                        <h3> Glass</h3>
                        <i class='bx bx-purchase-tag'></i>
                        <p><?php echo $data['eco_credit_per']->glass?></p>
                    </div>

                    <div class="Cont">
                        <h3>Paper</h3>
                        <i class='bx bx-purchase-tag'></i>
                        <p><?php echo $data['eco_credit_per']->paper?></p>
                    </div>
                    <div class="Cont">
                        <h3>Electronic</h3>
                        <i class='bx bx-purchase-tag'></i>
                        <p><?php echo $data['eco_credit_per']->electronic?></p>
                    </div>
                </div>
                <h2>Per Kg</h2>

            </div>
            <div class="overlay" id="overlay">

            </div>
            <script src="CustomerDashboard.js"></script>
            <?php if($data['pop']=='True') : ?>
            <div class="Pop" id="Popup">
                <div id="Profile_Pop" class="Profile">
                    <div class="profile-top">
                        <div class="profile-top-left"></div>
                        <a href="<?php echo URLROOT?>/customers">
                            <img src="<?php echo IMGROOT?>/close_popup.png" id="Profile_close">
                        </a>
                    </div>
                    <div class="profile-down">
                        <div class="profile-down-top-content">
                            <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                                alt="">
                            <h1 style="font-size: 29px;"><?php echo $_SESSION['user_name']?></h1>
                        </div>

                        <div class="profile-down-content">
                            <p>Name</p>
                            <input type="text" value="<?php echo $data['name']?>" readonly>
                        </div>
                        <div class="profile-down-content">
                            <p>User ID</p>
                            <input type="text" value="C<?php echo $data['userid']?>" readonly>
                        </div>

                        <div class="profile-down-content">
                            <p>Email</p>
                            <input type="text" value="<?php echo $data['email']?>" readonly>
                        </div>
                        <div class="profile-down-content">
                            <p>Contact No</p>
                            <input type="text" value="<?php echo $data['contactno']?>" readonly>
                        </div>
                        <div class="profile-down-content">
                            <p>Address</p>
                            <input type="text" value="<?php echo $data['address']?>" readonly>
                        </div>
                        <div class="profile-down-content">
                            <p>City</p>
                            <input type="text" value="<?php echo $data['city']?>" readonly>
                        </div>


                    </div>
                </div>
            </div>
            <?php endif; ?>
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
let progressStartValue = 0;
let progressEndValue = 75;
let speed = 30;

function redirect_transfercredit() {
    var linkUrl = "<?php echo URLROOT?>/customers/transfer";
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
    if (notification_pop.style.height === "0px") {
        notification_pop.style.height = "28%";
        notification_pop.style.visibility = "visible";
        notification_pop.style.opacity = "1";
        notification_pop.style.padding = "7px";
    } else {
        notification_pop.style.height = "0px";
        notification_pop.style.visibility = "hidden";
        notification_pop.style.opacity = "0";
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
        scaledSize: new google.maps.Size(21, 21)
    };

    var points = [{
            lat: 7.1,
            lng: 80.7718
        },
        {
            lat: 7.2,
            lng: 79.8394
        },
        {
            lat: 6.9934,
            lng: 81.0550
        },
        {
            lat: 8.7542,
            lng: 80.4982
        },
        {
            lat: 7.2912,
            lng: 81.6724
        },
        {
            lat: 7.8734,
            lng: 80.7720
        },
        {
            lat: 6.9271,
            lng: 79.8612
        },
        {
            lat: 6.1429,
            lng: 81.1212
        },
        {
            lat: 5.9496,
            lng: 80.5469
        },
        {
            lat: 6.0329,
            lng: 80.2168
        },
        {
            lat: 6.1429,
            lng: 81.1212
        },
        {
            lat: 8.0408,
            lng: 79.8394
        }
    ];

    points.forEach((point, index) => {
        var marker = new google.maps.Marker({
            position: point,
            map: map,
            title: 'Marker ' + (index + 1),
            icon: customColoredMarkerIcon
        });
    });
}


let progress = setInterval(() => {
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
    console.log(color);
    const ctx = document.getElementById('myChart').getContext('2d');

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Plastic', 'Polythene', 'Metal', 'Glass', 'Paper', 'Electronic'],
            datasets: [{
                label: 'Kilograms',
                data: [12, 19, 3, 5, 2, 3],
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