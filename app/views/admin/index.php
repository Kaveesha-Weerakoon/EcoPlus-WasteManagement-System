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
                    <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-one">
                        <div class="main-right-bottom-one-left">
                            <div class="left">
                                <h1>Garbage Types</h1>
                                <h3>6</h3>
                                <p>View Details</p>
                                <button onclick="redirect_garbage_types()">View</button>
                            </div>
                            <div class="right">
                                <h1><span class="main-credit"> <?php echo $data['creditsGiven']?></span> </h1>
                                <h3>Month's Total Credits</h3>
                            </div>
                        </div>

                        <div class="main-right-bottom-one-right">
                            <div class="main-right-bottom-three-right-left">
                                <h1>Set Fines</h1>
                                <i class="fa-solid fa-file-invoice-dollar" style="font-size: 45px;"></i>
                                <p>Set fine for each offence by customer</p>
                                <button class="fine_button" onclick="open_fine_set()">Set fine</button>
                            </div>
                            <div class="main-right-bottom-three-right-right">
                                <h1>Regional Centers</h1>
                                <div class="map" id="map"></div>

                            </div>
                        </div>
                    </div>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-cont A" onclick="redirect_customers()">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <div class="content_container">
                                <h3>Customers</h3>
                                <h2 id="customer_count" style="font-weight:bold"></h2>
                            </div>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_collectors()">
                            <div class=" icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <div class="content_container">
                                <h3>Collectors</h3>
                                <h2 id="collector_count" style="font-weight:bold"></h2>
                            </div>

                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_discountAgents()">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <div class="content_container">
                                <h3>Discount Agents</h3>
                                <h2 style="font-weight:bold">12</h2>
                            </div>

                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_centermanagers()">
                            <div class=" icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <div class="content_container">
                                <h3>Center Managers</h3>
                                <h2 style="font-weight:bold" id="cm_count"></h2>
                            </div>

                        </div>

                    </div>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-left">
                            <canvas id="myChart" width="600" height="250"></canvas>
                        </div>
                        <div class="main-right-bottom-three-right">
                            <canvas id="myChart1" width="680" height="300"></canvas>

                        </div>

                    </div>
                </div>
            </div>

            <div class="fine_set_popup" id="fine_popup">
                <form action="<?php echo URLROOT;?>/admin/set_fine" method="post" id="fine_pop">
                    <div class="fine_popup_form">
                        <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="fine_popup_form_close"
                            id="fine_popup_form_close">
                        <div class="fine_popup_form_top">
                            <div class="set_fine_topic">Set Fine</div>
                        </div>

                        <div class="fine-pop-form-content-container">
                            <div class="fine-pop-form-content">
                                <span>Minimum Collect</span>
                                <div class="input-box">
                                    <input type="text" name="minimum_collect" id="min_collect"
                                        value="<?php echo $data['minimum_collect']?>">
                                    <span class="error-div" style="color:red">
                                        <?php echo $data['minimum_collect_err']?>
                                    </span>
                                </div>
                            </div>
                            <div class="fine-pop-form-content">
                                <span>No Response</span>
                                <div class="input-box">
                                    <input type="text" name="no_response" id="no_response"
                                        value="<?php echo $data['no_response']?>">
                                    <span class="error-div" style="color:red">
                                        <?php echo $data['no_response_err']?>
                                    </span>
                                </div>
                            </div>
                            <div class="fine-pop-form-content">
                                <span>Cancelling assigned</span>
                                <div class="input-box">
                                    <input type="text" name="cancelling_assigned" id="cancel_assigned"
                                        value="<?php echo $data['cancelling_assigned']?>">
                                    <span class="error-div" style="color:red">
                                        <?php echo $data['cancelling_assigned_err']?>
                                    </span>
                                </div>
                            </div>
                            <button type="button" onclick="validateAndSubmit()" class="set_fine_button">Set</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="overlay" id="overlay">
            </div>
        </div>
    </div>
</div>


<script>
var color = "#47b076";
var textColor = "#414143";

function validateAndSubmit() {
    var initialMinCollect = document.getElementById('min_collect').value;
    var initialNoResponse = document.getElementById('no_response').value;
    var initialCancelAssigned = document.getElementById('cancel_assigned').value;

    var minCollect = initialMinCollect.trim();
    var noResponse = initialNoResponse.trim();
    var cancelAssigned = initialCancelAssigned.trim();

    var numberPattern = /^\d+(\.\d{1,2})?$/;

    if (!numberPattern.test(minCollect) || !numberPattern.test(noResponse) || !numberPattern.test(cancelAssigned)) {
        alert('Please enter valid numeric values with up to two decimal places.');
        document.getElementById('min_collect').value = <?php echo $data['minimum_collect']?>;
        document.getElementById('no_response').value = <?php echo $data['no_response']?>;
        document.getElementById('cancel_assigned').value = <?php echo $data['cancelling_assigned']?>;

        return;
    }

    document.getElementById('fine_pop').submit();
}

function redirect_customers() {
    var linkUrl = "<?php echo URLROOT?>/admin/customers";
    window.location.href = linkUrl;
}

function redirect_collectors() {
    var linkUrl = "<?php echo URLROOT?>/admin/collectors";
    window.location.href = linkUrl;
}

function redirect_centermanagers() {
    var linkUrl = "<?php echo URLROOT?>/admin/center_managers";
    window.location.href = linkUrl;
}

function redirect_discountAgents() {
    var linkUrl = "<?php echo URLROOT?>/admin/discount_agents";
    window.location.href = linkUrl;
}

function open_fine_set() {
    var finePop = document.getElementById('fine_popup');
    finePop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function redirect_garbage_types() {
    var linkUrl = "<?php echo URLROOT?>/admin/garbage_types";
    window.location.href = linkUrl;
}

function submit() {
    var minCollect = document.getElementById('min_collect').value;
    var noResponse = document.getElementById('no_response').value;
    var cancelAssigned = document.getElementById('cancel_assigned').value;

    if (minCollect.trim() === '' || noResponse.trim() === '' || cancelAssigned.trim() === '') {
        alert('Please fill in all fields.');
        return; // Prevent form submission if validation fails
    }

    document.getElementById('fine_pop').submit();
}

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
        zoom: 5.3,
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

    // Default radius in meters
    var customColoredMarkerIcon = {
        url: 'https://maps.google.com/mapfiles/ms/micons/green-dot.png',
        size: new google.maps.Size(31, 31),
        scaledSize: new google.maps.Size(19, 18)
    };

    var points = <?php echo $data['centers']; ?>;
    var activeMarker = null;
    var activeCircle = null;

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

    // Call the function to create or update the chart
});

function createOrUpdateChart(color, textColor) {
    // Define the static data for the chart
    const staticData = {
        current_plastic: 100,
        current_polythene: 80,
        current_metal: 120,
        current_glass: 90,
        current_paper: 110,
        current_electronic: 70
    };

    const ctx = document.getElementById('myChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Plastic', 'Polythene', 'Metal', 'Glass', 'Paper', 'Electronic'],
            datasets: [{
                label: 'Kilograms',
                data: [staticData.current_plastic, staticData.current_polythene, staticData
                    .current_metal, staticData.current_glass, staticData.current_paper, staticData
                    .current_electronic
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
                            size: 14
                        }
                    },
                    barPercentage: 0.5,
                    categoryPercentage: 0.3
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: Math.max(...Object.values(staticData)) + 1,
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
                    text: 'Total Waste Collected',
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
                    borderRadius: 10
                }
            },
            animation: {
                duration: 700,
                easing: 'easeIn'
            }
        }
    });
}

createOrUpdateChart(color, textColor);

document.addEventListener("DOMContentLoaded", function() {
    const close_request_details = document.getElementById("fine_popup_form_close");

    close_request_details.addEventListener("click", function() {
        const request_details = document.getElementById("fine_popup");
        request_details.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

});

const completedRequests = <?php echo json_encode($data['completedRequests']); ?>;
const totalRequests = <?php echo json_encode($data['totalRequests']); ?>;

// Get the current month and year
const currentDate = new Date();
const currentMonth = currentDate.getMonth();
const currentYear = currentDate.getFullYear();

// Function to get the name of the month for a given month index
function getMonthName(monthIndex) {
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
    ];
    return monthNames[monthIndex];
}

// Generate labels for the last six months
const labels = [];
for (let i = 0; i < 6; i++) {
    const month = (currentMonth - i + 12) % 12; // Ensure the month is within 0-11 range
    const year = currentYear - (i === 0 && currentMonth === 0 ? 1 : 0); // Adjust the year if current month is January
    labels.unshift(getMonthName(month) + ' ' + year); // Push to the front of the array
}

const completedRequestCounts = completedRequests.map(request => {
    const date = new Date(request.date);
    return {
        month: date.getMonth(),
        year: date.getFullYear(),
    };
});

const totalRequestCounts = totalRequests.map(request => {
    const date = new Date(request.date);
    return {
        month: date.getMonth(),
        year: date.getFullYear(),
    };
});

function countRequests(requests) {
    const counts = Array(6).fill(0);
    requests.forEach(request => {
        const date = new Date(request.year, request.month);
        let monthDiff = currentMonth - date.getMonth();
        if (monthDiff < 0) {
            monthDiff += 12; // Adjust for negative differences
        }
        const index = (5 - monthDiff + 6) % 6; // Calculate the index in reverse order
        counts[index]++;
    });
    return counts;
}




const completedData = countRequests(completedRequestCounts); // Reverse the array
const totalData = countRequests(totalRequestCounts); // Reverse the array

const data = {
    labels: labels,
    datasets: [{
            label: 'Completed Requests',
            data: completedData,
            borderColor: 'red',
            backgroundColor: 'rgba(255, 0, 0, 0.3)', // Light red background color
            borderWidth: 2, // Set border width
            pointStyle: 'circle', // Set point style to circle
            pointBackgroundColor: 'red', // Set point background color
            pointBorderColor: 'red', // Set point border color
            pointRadius: 5, // Set point radius
        },
        {
            label: 'Total Requests',
            data: totalData,
            borderColor: '#64d798',
            backgroundColor: 'rgba(100, 215, 152, 0.3)',
            borderWidth: 2, // Set border width
            pointStyle: 'circle', // Set point style to circle
            pointBackgroundColor: '#64d798', // Set point background color
            pointBorderColor: '#64d798', // Set point border color
            pointRadius: 5, // Set point radius
        }
    ]
};


const config = {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: '6-Month Request Trends',
                font: {
                    size: 18,
                    family: 'Arial',
                    weight: 'bold',
                    color: '#333',
                },
                padding: 1,
                align: 'center',
            }
        }
    },
};


const ctx = document.getElementById('myChart1').getContext('2d');
new Chart(ctx, config);
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>