<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="Collector_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&callback=initMap" async defer>
    </script>

    <div class="Collector_Dashboard">

        <div class="main">
            <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bxl-sketch'></i> <input type="text" placeholder="Welcome Back !" id="searchInput"
                            readonly oninput="highlightMatchingText()">
                    </div>
                    <?php require APPROOT . '/views/collectors/collector_notification/collector_notification.php'; ?>
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-one">
                        <div class="main-right-bottom-one-left">
                            <div class="left">
                                <h1>Assigned Requests</h1>
                                <h3 style="font-weight:bold" id="assign_count"></h3>
                                <p>Requests</p>
                                <button onclick="redirectToAssignedRequests()">View </button>

                            </div>

                            <div class="right">

                                <i class='bx bx-building-house'></i>

                                <h1><?php echo $data['collector']->center_name?></h1>
                                <h5>Center ID: CEN <?php echo $data['collector']->center_id?> </h5>
                            </div>
                        </div>
                        <div class="main-right-bottom-one-right">
                                <h1>Recently Completed Request</h1>

                                <?php
                                        $req_completed_history = $data['req_completed_history'];

                                        // Sort the completed history by completion date (assuming completion_datetime property)
                                        usort($req_completed_history, function ($a, $b) {
                                            $dateA = strtotime($a->completed_datetime);
                                            $dateB = strtotime($b->completed_datetime);

                                            return $dateB - $dateA; // Sort in descending order (most recent first)
                                        });

                                        // Extract the first three elements after sorting
                                        $limited_completed_history = array_slice($req_completed_history, 0, 3);

                                    ?>    
                                <?php if (empty($limited_transactions)): ?>
                                    <div class="empty-transaction">You Have No Transactions Yet</div>
                                <?php else: ?>
                                <?php foreach ($limited_completed_history as $completion):
                                                ?>
                                
                                <div class="main-right-bottom-one-right-cont">
                                    <img class="td-pro_pic"
                                        src="<?php echo (empty($completion->customer_image) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/'. $completion->customer_image) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $completion->customer_image; ?>"
                                        alt="">
                                    <h3>
                                        C <?php echo $completion->customer_id; ?>
                                    </h3>
                                    <h3>
                                        R <?php echo $completion->req_id; ?>
                                    </h3>
                                    <h2>
                                        Eco <?php echo $completion->credit_amount;?>
                                    </h2>
                                </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="main-right-bottom-two">

                        <div class="main-right-bottom-two-cont A" onclick="redirect_history()">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <div class="content_container">
                                <h3> Assistants</h3>
                                <h2 id="garbage_count"><?php echo $data['assistant_count']?></h2>
                            </div>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_complains()">
                            <div class="icon_container">
                                <i class='bx bx-error-circle'></i>
                            </div>
                            <div class="content_container">
                                <h3>Complaints</h3>
                                <h2>12</h2>
                            </div>
                        </div>

                        <div class="main-right-bottom-two-cont A" onclick="redirect_completed()">
                            <div class="icon_container">
                                <i class='bx bx-message-alt-check'></i>
                            </div>
                            <div class="content_container">
                                <h3>Fulfilled Requests</h3>
                                <h2 id="request_count"><?php echo $data['completed_request_count']?></h2>
                            </div>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_garbagetypes()">
                            <div class=" icon_container">
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
                        <canvas id="myChart" width="600" height="250"></canvas>
                        <div id="chartMessage" class="message">No data available.</div>
                    </div>
                        <div class="main-right-bottom-three-right">
                            <div class="main-right-bottom-three-right-left">
                                <h1>Requests Completed</h1>
                                <div class="main-right-bottom-three-right-cont">
                                    <div class="circular-progress">
                                        <span class="progress-value">0%</span>
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
                            <div class="main-right-bottom-three-right-right">
                                <h1>Assigned Requests</h1>
                                <div class="map" id="map">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="overlay" id="overlay"></div>
        </div>

        <script>
        var color = "#47b076";
        var textColor = "#414143"
        var checkbox = document.getElementById('toggle-checkbox');

        let circularProgress = document.querySelector(".circular-progress");
        let progressValue = document.querySelector(".progress-value");
        let progressStartValue = 0;
        let progressEndValue = <?php echo intval($data['percentage']); ?>;
        let speed = 30;

        function redirectToAssignedRequests() {
            var linkUrl = "<?php echo URLROOT?>/collectors/request_assinged"; // Replace with your desired URL
            window.location.href = linkUrl;
        }

        function redirect_completed() {
            var linkUrl = "<?php echo URLROOT?>/collectors/request_completed";
            window.location.href = linkUrl;
        }

        function redirect_complains() {
            var linkUrl = "<?php echo URLROOT?>/collectors/complains";
            window.location.href = linkUrl;
        }

        function redirect_history() {
            var linkUrl = "<?php echo URLROOT?>/collectors/collector_assistants"; // Replace with your desired URL
            window.location.href = linkUrl;
        }

        function redirect_garbagetypes() {
            var linkUrl = "<?php echo URLROOT?>/collectors/garbage_types"; // Replace with your desired URL
            window.location.href = linkUrl;
        }

        function redirect_complains_history() {
            var linkUrl = "<?php echo URLROOT?>/collectors/complains_history";
            window.location.href = linkUrl;
        }

        const assign_count = <?php echo $data['assinged_Requests_count']?>;
        const assignCountElement = document.getElementById('assign_count');

        function updateCount(currentValue) {
            assignCountElement.textContent = currentValue;
        }

        for (let i = 0; i <= assign_count; i++) {
            setTimeout(() => {
                updateCount(i);
            }, i * 50); // Change 1000 to control the speed of counting (milliseconds)
        }

        function createOrUpdateChart(color, textColor) {
            var Total_Garbage = <?php echo $data['total_garbage']?>;
            const ctx = document.getElementById('myChart').getContext('2d');
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

        function initMap() {
            var defaultLatLng = {
                lat: <?= !empty($data['lattitude']) ? $data['lattitude'] : 6 ?>,
                lng: <?= !empty($data['longitude']) ? $data['longitude'] : 81.00 ?>
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLatLng,
                zoom: 9,


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

            var points = <?php echo $data['assigned_requests']; ?>;;
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
                `conic-gradient(#47b076, ${progressStartValue * 3.6}deg, #ededed 0deg)`;


            if (progressStartValue == progressEndValue) {
                clearInterval(progress);
            }
        }, speed);

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, config);
            var config = null;


            const chartContainer = document.getElementById('chart');
            actions.forEach(action => {
                const button = document.createElement('button');
                button.textContent = action.name;
                button.addEventListener('click', () => action.handler(myChart));
                chartContainer.appendChild(button);
            });
        });

        function getDarkModeSetting() {
            const storedValue = localStorage.getItem("darkMode");
            console.log("as");

            return storedValue ? JSON.parse(storedValue) : true;
        }

        isDarkMode = getDarkModeSetting();
        if (getDarkModeSetting()) {

            color = "white"
            textColor = " white";
            circularProgress.style.background =
                `conic-gradient(${color}, ${progressStartValue * 3.6}deg, ${isDarkMode ? "#001f3f" : "#ededed"} 0deg)`;
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

        <?php require APPROOT . '/views/inc/footer.php'; ?>