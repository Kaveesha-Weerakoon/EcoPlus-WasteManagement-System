<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Reports">
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

                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                        <div class="main-right-top-profile-cont">
                            <h3>Admin</h3>
                        </div>
                    </div>
                </div>


                <div class="main-right-bottom">





                    <form class="top-bar" method="post" action="<?php echo URLROOT;?>/admin/reports">
                        <div class="top-bar-left">
                            <h2>Analatics</h2>
                            <p>Here is overall Anatics</p>
                        </div>
                        <div class="date-box">
                            <div class="date-box-cont">
                                <input value="<?php echo $data['from']?>" name="fromDate" type="Date">
                                <p>From</p>
                            </div>
                            <div class="date-box-cont">
                                <input value="<?php echo $data['to']?>" name="toDate" type="Date">
                                <p>To</p>
                            </div>
                        </div>

                        <div class="center-box">
                            <select id="center-dropdown" name="center-dropdown">
                                <?php
                                     $centers = $data['centers'];
                                     $selectedRegion = $data['center'];
                                     $regionFound = false;

                                     // Add the "All" option
                                     echo "<option value=\"none\"" . ($selectedRegion == "none" ? " selected" : "") . ">All</option>";

                                     if (!empty($centers)) {
                                        foreach ($centers as $center) {
                                            $selected = ($center->region == $selectedRegion) ? 'selected' : '';
                                            if ($selected) {
                                                $regionFound = true;
                                            }
                                            echo "<option value=\"$center->region\" $selected>$center->region</option>";
                                        }
          
                                    } 
                                    ?>
                            </select>
                            <p id="selected-option">Center</p>
                        </div>

                        <button>Filter</button>
                    </form>
                    <div class="request-section">
                        <div class="left">
                            <div class="left-cont">
                                <i class="fa-solid fa-chart-simple"></i>
                                <p>Total Requests</p>
                                <h1><?php echo $data['totalRequests']?></h1>
                                <div class="cont" style="color:#1ca557">
                                    <i class="fa-solid fa-arrow-trend-up"></i>
                                    <p style="font-weight:bold">1212 From prev month</p>
                                </div>
                            </div>
                            <div class="left-cont">
                                <i class="fa-regular fa-square-check"></i>
                                <p>Completed Requests</p>
                                <h1><?php echo $data['completedRequests']?></h1>
                                <div class="cont" style="color:#1ca557">
                                    <i class="fa-solid fa-arrow-trend-up"></i>
                                    <p style="font-weight:bold">1212 From prev month</p>
                                </div>
                            </div>
                            <div class="left-cont">
                                <i class="fa-regular fa-rectangle-xmark"></i>
                                <p>Cancelled Requests</p>
                                <h1><?php echo $data['cancelledRequests']?></h1>
                                <div class="cont" style="color:#1ca557">
                                    <i class="fa-solid fa-arrow-trend-up"></i>
                                    <p style="font-weight:bold">1212 From prev month</p>
                                </div>
                            </div>
                            <div class="left-cont">
                                <i class="fa-solid fa-spinner"></i>
                                <p>On going</p>
                                <h1><?php echo $data['ongoingRequests']?></h1>
                                <div class="cont" style="color:#1ca557">
                                    <i class="fa-solid fa-arrow-trend-up"></i>
                                    <p style="font-weight:bold">1212 From prev month</p>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="right-cont">
                                <div class="top">
                                    <h3>Credits Given</h3>
                                    <h1><?php
                                        $credits = isset($data['credits']) ? $data['credits'] : '00.00';
                                    ?>
                                        <h1>Eco <?php echo $credits; ?></h1>
                                    </h1>
                                </div>
                                <div class="bottom">
                                    <canvas id="myChart" width="688" height="550"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>






                </div>
            </div>
        </div>
    </div>
</div>








<script>
// Your Chart.js configuration
const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
const NUMBER_OF_DATA_POINTS = 7; // Number of data points in the dataset

// Generate random numbers for the dataset
function generateRandomData(count, min, max) {
    const data = [];
    for (let i = 0; i < count; i++) {
        data.push(Math.floor(Math.random() * (max - min + 1)) + min);
    }
    return data;
}

const data = {
    labels: labels,
    datasets: [{
            label: 'Credits',
            data: generateRandomData(NUMBER_OF_DATA_POINTS, -100, 100),
            borderColor: '#64d798',
            backgroundColor: '#64d798',
        },

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
                labels: {
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            title: {
                display: true,
                text: 'Credits Given Chart',
                font: {
                    size: 18,
                    weight: 'bold'
                },
                padding: 10
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Months',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                },
                ticks: {
                    font: {
                        size: 12
                    }
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Credits',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                },
                ticks: {
                    font: {
                        size: 12
                    }
                }
            }
        }
    }
};


// Instantiate a new Chart object
const ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, config);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>