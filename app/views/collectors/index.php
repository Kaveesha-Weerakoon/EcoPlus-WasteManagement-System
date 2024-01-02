<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="Collector_Main">

    <div class="Collector_Dashboard">

        <div class="main">
            <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bxl-sketch'></i> <input type="text" placeholder="Welcome Back !" id="searchInput"
                            readonly oninput="highlightMatchingText()">
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
                        <img src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $_SESSION['collector_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['collector_name']?></h3>
                            <p>ID : C <?php echo $_SESSION['collector_id']?></p>
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
                                <button onclick="redirectToAssignedRequests()">Assigned Requests</button>

                            </div>

                            <!--<div class="right">
                                <h1>Eco<span class="main-credit"> <?php echo $data['credit_balance']?></span> </h1>
                                <h3>WALLET AMOUNT</h3>
                            </div>-->
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

                                 foreach ($limited_completed_history as $completion):
                            ?>
                            <div class="main-right-bottom-three-left-cont">
                                <img class="td-pro_pic"
                                    src="<?php echo  $completion->customer_image; ?>"
                                    alt="">
                                <h3>
                                    C <?php echo $completion->customer_id; ?>
                                </h3>
                                <h2>
                                    <?php echo $completion->credit_amount;?>
                                </h2>
                            </div>
                            <?php endforeach; ?>
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


                </div>

                <!-- <script>
                var color = "#47b076";
                var textColor = "#414143"

                // var credit_per_waste_quantity = document.getElementById("credit_per_waste_quantity");

                // var notification = document.getElementById("notification");
                // var notification_pop = document.getElementById("notification_popup");
                // notification_pop.style.height = "0px";
                // let circularProgress = document.querySelector(".circular-progress");
                // let progressValue = document.querySelector(".progress-value");
                // let progressStartValue = -1;
                // let progressEndValue = <?php echo intval($data['percentage']); ?>;
                // let speed = 30;
                // console.log(progressEndValue);

                function redirectToAssignedRequests() {
                    console.log('as');
                    var linkUrl = "<?php echo URLROOT ?>/collectors/request_assigned";
                    window.location.href = linkUrl;
                }

                function redirect_complains() {
                    var linkUrl = "<?php echo URLROOT?>/collectors/complains";
                    window.location.href = linkUrl;
                }

                // notification.addEventListener("click", function() {
                //     if (notification_pop.style.height === "0px") {
                //         notification_pop.style.height = "28%";
                //         notification_pop.style.visibility = "visible";
                //         notification_pop.style.opacity = "1";
                //         notification_pop.style.padding = "7px";
                //     } else {
                //         notification_pop.style.height = "0px";
                //         notification_pop.style.visibility = "hidden";
                //         notification_pop.style.opacity = "0";
                //     }
                // });

                // document.getElementById("credit_per_waste_quantity").addEventListener("click", function() {
                //     document.getElementById("eco_credit_per_quantiy_pop").classList.add('active');
                //     document.getElementById('overlay').style.display = "flex";
                // });

                // document.getElementById("close_eco_credit_per_quantiy_pop").addEventListener("click", function() {
                //     document.getElementById("eco_credit_per_quantiy_pop").classList.remove('active');
                //     document.getElementById('overlay').style.display = "none";
                // });


                // function initMap() {
                //     var center = {
                //         lat: 7.7,
                //         lng: 80.7718
                //     };
                //     var map = new google.maps.Map(document.getElementById('map'), {
                //         center: center,
                //         zoom: 5.8,
                //         styles: [{
                //                 featureType: 'all',
                //                 elementType: 'labels.text',
                //                 stylers: [{
                //                         visibility: 'on'
                //                     },
                //                     {
                //                         fontSize: '10px'
                //                     }
                //                 ]
                //             },
                //             {
                //                 featureType: 'poi',
                //                 elementType: 'labels.icon',
                //                 stylers: [{
                //                         visibility: 'off'
                //                     } // Hide the icons for points of interest
                //                 ]
                //             },
                //             {
                //                 featureType: 'poi',
                //                 elementType: 'labels.text',
                //                 stylers: [{
                //                         visibility: 'off'
                //                     } // Hide text labels for points of interest
                //                 ]
                //             },
                //             {
                //                 featureType: 'transit',
                //                 elementType: 'labels.icon',
                //                 stylers: [{
                //                         visibility: 'off'
                //                     } // Hide the icons for transit stations
                //                 ]
                //             },
                //             {
                //                 featureType: 'transit',
                //                 elementType: 'labels.text',
                //                 stylers: [{
                //                         visibility: 'off'
                //                     } // Hide text labels for transit stations
                //                 ]
                //             },
                //             {
                //                 featureType: 'all',
                //                 elementType: 'all',
                //                 stylers: [{
                //                         saturation: -35
                //                     } // Adjust the saturation to make the map darker
                //                 ]
                //             }
                //         ]
                //     });

                //     var customColoredMarkerIcon = {
                //         url: 'https://maps.google.com/mapfiles/ms/micons/green-dot.png',
                //         size: new google.maps.Size(31, 31),
                //         scaledSize: new google.maps.Size(19, 18)
                //     };

                //     var points = <?php echo $data['centers']; ?>;
                //     points.forEach((point) => {
                //         var marker = new google.maps.Marker({
                //             position: {
                //                 lat: parseFloat(point.lat),
                //                 lng: parseFloat(point.longi)
                //             },
                //             map: map,
                //             title: point.region,
                //             icon: customColoredMarkerIcon
                //         });

                //         marker.addListener('click', function() {
                //             var infowindow = new google.maps.InfoWindow({
                //                 content: point.region
                //             });
                //             infowindow.open(map, marker);
                //         });
                //     });
                // }


                // let progress = setInterval(() => {
                //     if (progressStartValue == progressEndValue) {
                //         clearInterval(progress);
                //     }
                //     progressStartValue++;
                //     progressValue.textContent = `${progressStartValue}%`;

                //     circularProgress.style.background =
                //         `conic-gradient(${color}, ${progressStartValue * 3.6}deg, #ededed 0deg)`;

                //     if (progressStartValue == progressEndValue) {
                //         clearInterval(progress);
                //     }
                // }, speed);

                document.addEventListener('DOMContentLoaded', function() {
                    // const ctx = document.getElementById('myChart').getContext('2d');
                    // const myChart = new Chart(ctx, config);

                    // const chartContainer = document.getElementById('chart');
                    // actions.forEach(action => {
                    //     const button = document.createElement('button');
                    //     button.textContent = action.name;
                    //     button.addEventListener('click', () => action.handler(myChart));
                    //     chartContainer.appendChild(button);
                    // });
                });


                // function createOrUpdateChart(color, textColor) {
                //     console.log(color);
                //     const ctx = document.getElementById('myChart').getContext('2d');

                //     myChart = new Chart(ctx, {
                //         type: 'bar',
                //         data: {
                //             labels: ['Plastic', 'Polythene', 'Metal', 'Glass', 'Paper', 'Electronic'],
                //             datasets: [{
                //                 label: 'Kilograms',
                //                 data: [12, 19, 3, 5, 2, 3],
                //                 backgroundColor: color,
                //             }]
                //         },
                //         options: {
                //             scales: {
                //                 x: {
                //                     grid: {
                //                         display: false
                //                     },
                //                     ticks: {
                //                         font: {
                //                             size: 14,
                //                         }
                //                     },
                //                     barPercentage: 0.5, // Adjust to decrease the width of the bars
                //                     categoryPercentage: 0.3 // Adjust to control the space between bars
                //                 },
                //                 y: {
                //                     beginAtZero: true,
                //                     grid: {
                //                         display: false
                //                     }
                //                 }
                //             },
                //             plugins: {
                //                 legend: {
                //                     display: false
                //                 },
                //                 title: {
                //                     display: true,
                //                     text: 'Overall Collection Total',
                //                     color: textColor,
                //                     font: {
                //                         size: 18
                //                     },
                //                     padding: {
                //                         bottom: 25
                //                     }
                //                 }
                //             },
                //             elements: {
                //                 bar: {
                //                     borderRadius: 10,
                //                 }
                //             },
                //             animation: {
                //                 duration: 700, // Set the duration of the animation in milliseconds
                //                 easing: 'easeIn' // Set the easing function for the animation
                //             }
                //         }
                //     });
                // }
                // createOrUpdateChart(color, textColor);
                console.log('as');
                </script> -->
                <script>

                var color = "#47b076";
                var textColor = "#414143"

                var credit_per_waste_quantity = document.getElementById("credit_per_waste_quantity");

                document.getElementById("credit_per_waste_quantity").addEventListener("click", function() {
                     document.getElementById("eco_credit_per_quantiy_pop").classList.add('active');
                     document.getElementById('overlay').style.display = "flex";
                 });

                 document.getElementById("close_eco_credit_per_quantiy_pop").addEventListener("click", function() {
                     document.getElementById("eco_credit_per_quantiy_pop").classList.remove('active');
                     document.getElementById('overlay').style.display = "none";
                 });
                function redirectToAssignedRequests() {
                    console.log('as');
                    var linkUrl = "<?php echo URLROOT?>/collectors/request_assinged"; // Replace with your desired URL
                    window.location.href = linkUrl;
                }

                function redirect_complains() {
                    var linkUrl = "<?php echo URLROOT?>/collectors/complains";
                    window.location.href = linkUrl;
                }
                </script>

                <?php require APPROOT . '/views/inc/footer.php'; ?>