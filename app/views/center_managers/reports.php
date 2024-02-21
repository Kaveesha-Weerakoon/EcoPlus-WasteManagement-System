<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Reports">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

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
                        <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['center_manager_name']?></h3>
                            <p>ID : Col <?php echo $_SESSION['center_manager_id']?></p>
                        </div>
                    </div>
                </div>


                <div class="main-right-bottom">

                    <form class="top-bar" method="post" action="<?php echo URLROOT;?>/centermanagers/reports">
                        <div class="top-bar-left">
                            <h2>Analytics</h2>
                            <p>Here is overall Analytics</p>
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
                            <select id="collector-dropdown" name="collector-dropdown">
                                <?php
                                     $collectors = $data['collectors'];
                                     $selectedCollector = $data['collector'];
                                     $collectorFound = false;

                                     // Add the "All" option
                                     echo "<option value=\"none\"" . ($selectedCollector == "none" ? " selected" : "") . ">All</option>";

                                     if (!empty($collectors)) {
                                        foreach ($collectors as $collector) {
                                            $selected = ($collector->userId == $selectedCollector) ? 'selected' : '';
                                            if ($selected) {
                                                $collectorFound = true;
                                            }
                                            echo "<option value=\"$collector->userId\" $selected>C$collector->userId $collector->name </option>";
                                        }
          
                                    } 
                                    ?>
                            </select>
                            <p id="selected-option">Collector</p>
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
                                    <!-- <canvas id="myChart" width="688" height="550"></canvas> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="waste-section">
                        <div class="waste-section-cont">
                            <h2>Total Waste Collected</h2>
                            <p>Here's an overview of total waste collected from customers</p>
                        </div>
                        <div class="waste-section-bottom">
                            <div class="left">
                                <table>
                                    <tr>
                                        <th>Type</th>
                                        <th>Weight(Kg)</th>
                                    </tr>
                                    <tr>
                                        <td>Glass</td>
                                        <td><?php echo $data['collectedWasteByMonth']->glass?></td>

                                    </tr>
                                    <tr>
                                        <td>Metals</td>
                                        <td><?php echo $data['collectedWasteByMonth']->metals?></td>

                                    </tr>
                                    <tr>
                                        <td>Electronic</td>
                                        <td><?php echo $data['collectedWasteByMonth']->electronicwaste?></td>

                                    </tr>
                                    <tr>
                                        <td>Paper</td>
                                        <td><?php echo $data['collectedWasteByMonth']->paperwaste?></td>


                                    </tr>
                                    <tr>
                                        <td>Plastic</td>
                                        <td><?php echo $data['collectedWasteByMonth']->plastic ?></td>

                                    </tr>
                                    <tr>
                                        <td>Polytheneq</td>
                                        <td><?php echo $data['collectedWasteByMonth']->polythene?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="right">
                                <canvas id="myPieChart" width="100" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="waste-section">
                        <div class="waste-section-cont">
                            <h2>Total Waste Handovered</h2>
                            <p>Here's an overview of total waste received at the centers</p>
                        </div>
                        <div class="waste-section-bottom">
                            <div class="left">
                                <table>
                                    <tr>
                                        <th>Type</th>
                                        <th>Weight(Kg)</th>
                                    </tr>
                                    <tr>
                                        <td>Plastic</td>
                                        <td><?php echo $data['handoveredWasteByMonth']->plastic ?></td>
                                    </tr>
                                    <tr>
                                        <td>Polythene</td>
                                        <td><?php echo $data['handoveredWasteByMonth']->polythene?></td>
                                    </tr>
                                    <tr>
                                        <td>Paper</td>
                                        <td><?php echo $data['handoveredWasteByMonth']->paperwaste?></td>

                                    </tr>
                                    <tr>
                                        <td>Electronic</td>
                                        <td><?php echo $data['handoveredWasteByMonth']->electronicwaste?></td>

                                    </tr>
                                    <tr>
                                        <td>Metals</td>
                                        <td><?php echo $data['handoveredWasteByMonth']->metals?></td>

                                    </tr>
                                    <tr>
                                        <td>Glass</td>
                                        <td><?php echo $data['handoveredWasteByMonth']->glass?></td>

                                    </tr>
                                </table>
                            </div>
                            <div class="right">
                                <canvas id="myPieChart2" width="100" height="100"></canvas>

                            </div>
                        </div>
                    </div>

                    <div class="waste-section">
                        <div class="waste-section-cont-2">
                            <div class="waste-section-cont-left">
                                <h2>Total Waste Selled</h2>
                                <p>Here is overall Analatics about total waste selled by Center</p>
                            </div>
                            <div class="waste-section-cont-right">
                                <h2>Rs <?php echo $data['selledWasteByMonth']->income ?></h2>
                                <p>Total Earnings</p>
                            </div>
                        </div>
                        <div class="waste-section-bottom">
                            <div class="left">
                                <table>
                                    <tr>
                                        <th>Type</th>
                                        <th>Weight(Kg)</th>
                                    </tr>
                                    <tr>
                                        <td>Plastic</td>
                                        <td><?php echo $data['selledWasteByMonth']->plastic ?></td>
                                    </tr>
                                    <tr>
                                        <td>Polythene</td>
                                        <td><?php echo $data['selledWasteByMonth']->polythene?></td>

                                    </tr>
                                    <tr>
                                        <td>Paper</td>
                                        <td><?php echo $data['selledWasteByMonth']->paperwaste?></td>

                                    </tr>
                                    <tr>
                                        <td>Electronic</td>
                                        <td><?php echo $data['selledWasteByMonth']->electronicwaste?></td>

                                    </tr>
                                    <tr>
                                        <td>Metals</td>
                                        <td><?php echo $data['selledWasteByMonth']->metals?></td>

                                    </tr>
                                    <tr>
                                        <td>Glass</td>
                                        <td><?php echo $data['selledWasteByMonth']->glass?></td>

                                    </tr>
                                </table>
                            </div>
                            <div class="right">
                                <canvas id="myPieChart3" width="100" height="100"></canvas>

                            </div>
                        </div>
                    </div>



                </div>
            </div>


        </div>
    </div>

</div>
<script>
/*Bottom CHART One*/

const data1 = {
    labels: ['Plastic', 'Polythene', 'Paper', 'Electronic', 'Metals', 'Glass'],
    datasets: [{
        data: [<?php echo $data['collectedWasteByMonth']->plastic ?>,
            <?php echo $data['collectedWasteByMonth']->polythene ?>,
            <?php echo $data['collectedWasteByMonth']->paperwaste ?>,
            <?php echo $data['collectedWasteByMonth']->electronicwaste ?>,
            <?php echo $data['collectedWasteByMonth']->metals ?>,
            <?php echo $data['collectedWasteByMonth']->glass ?>
        ], // Sample values for each waste type
        backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff',
            '#ff9900'
        ], // Sample colors
        borderWidth: 2, // Set the border width to reduce the width of the colored segments
    }]
};



const config1 = {
    type: 'pie',
    data: data1,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Waste Collected Pie Chart'
            }
        }
    }
};



const ctx1 = document.getElementById('myPieChart').getContext('2d');
const myPieChart = new Chart(ctx1, config1);
/*Bottom CHART One*/

/*Bottom CHART Two*/

const data2 = {
    labels: ['Plastic', 'Polythene', 'Paper', 'Electronic', 'Metals', 'Glass'],
    datasets: [{
        data: [<?php echo $data['handoveredWasteByMonth']->plastic ?>,
            <?php echo $data['handoveredWasteByMonth']->polythene ?>,
            <?php echo $data['handoveredWasteByMonth']->paperwaste ?>,
            <?php echo $data['handoveredWasteByMonth']->electronicwaste ?>,
            <?php echo $data['handoveredWasteByMonth']->metals ?>,
            <?php echo $data['handoveredWasteByMonth']->glass ?>
        ], // Sample values for each waste type
        backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff',
            '#ff9900'
        ], // Sample colors
        borderWidth: 2, // Set the border width to reduce the width of the colored segments
    }]
};


const config2 = {
    type: 'pie',
    data: data2,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Waste Collected Pie Chart'
            }
        }
    }
};



const ctx2 = document.getElementById('myPieChart2').getContext('2d');
const myPieChart2 = new Chart(ctx2, config2);
/*Bottom CHART Two*/


/*Bottom CHART Three*/

const data3 = {
    labels: ['Plastic', 'Polythene', 'Paper', 'Electronic', 'Metals', 'Glass'],
    datasets: [{
        data: [<?php echo $data['selledWasteByMonth']->plastic ?>,
            <?php echo $data['selledWasteByMonth']->polythene ?>,
            <?php echo $data['selledWasteByMonth']->paperwaste ?>,
            <?php echo $data['selledWasteByMonth']->electronicwaste ?>,
            <?php echo $data['selledWasteByMonth']->metals ?>,
            <?php echo $data['selledWasteByMonth']->glass ?>
        ], // Sample values for each waste type
        backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff',
            '#ff9900'
        ], // Sample colors
        borderWidth: 2, // Set the border width to reduce the width of the colored segments
    }]
};


const config3 = {
    type: 'pie',
    data: data3,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Waste Collected Pie Chart'
            }
        }
    }
};



const ctx3 = document.getElementById('myPieChart3').getContext('2d');
const myPieChart3 = new Chart(ctx3, config3);
/*Bottom CHART Three*/
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>