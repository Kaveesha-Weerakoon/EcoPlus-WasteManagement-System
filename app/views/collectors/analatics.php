<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_Analatics">


        <div class="main">
            <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">

                    <?php require APPROOT . '/views/collectors/collector_notification/collector_notification.php'; ?>


                </div>

                <div class="main-right-bottom">

                    <form class="top-bar" method="post" action="<?php echo URLROOT;?>/collectors/analatics">
                        <div class="top-bar-left">
                            <h2>Analytics</h2>
                            <p>Here is overall Analytics</p>
                        </div>

                        <div class="top-bar-details">
                            <div class="cont" onclick="scrollToElement('Requests')">Requests</div>
                            <div class="cont" onclick="scrollToElement('Collected')">Collected</div>
                            <div class="cont" onclick="scrollToElement('Handovered')">Handovered</div>

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

                        <!--<div class="center-box">
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
                        </div>-->

                        <button>Filter</button>
                    </form>
                    <div class="request-section">
                        <div class="left">
                            <div class="left-cont">
                                <i class="fa-solid fa-chart-simple"></i>
                                <p>Total Requests</p>
                                <h1><?php echo $data['totalRequests']?></h1>

                            </div>
                            <div class="left-cont">
                                <i class="fa-regular fa-square-check"></i>
                                <p>Completed Requests</p>
                                <h1><?php echo $data['completedRequests']?></h1>

                            </div>
                            <div class="left-cont">
                                <i class="fa-regular fa-rectangle-xmark"></i>
                                <p>Cancelled Requests</p>
                                <h1><?php echo $data['cancelledRequests']?></h1>

                            </div>
                            <div class="left-cont">
                                <i class="fa-solid fa-spinner"></i>
                                <p>Assigned Request</p>
                                <h1><?php echo $data['assignRequests']?></h1>

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
                                    <canvas id="myLineChart" width="688" height="550"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="waste-section" id="Collected">
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
                                        <td>Plastic</td>
                                        <td><?php echo $data['collectedWasteByMonth']->plastic ?></td>
                                    </tr>
                                    <tr>
                                        <td>Polythene</td>
                                        <td><?php echo $data['collectedWasteByMonth']->polythene?></td>

                                    </tr>
                                    <tr>
                                        <td>Paper</td>
                                        <td><?php echo $data['collectedWasteByMonth']->paperwaste?></td>

                                    </tr>
                                    <tr>
                                        <td>Electronic</td>
                                        <td><?php echo $data['collectedWasteByMonth']->electronicwaste?></td>

                                    </tr>
                                    <tr>
                                        <td>Metals</td>
                                        <td><?php echo $data['collectedWasteByMonth']->metals?></td>

                                    </tr>
                                    <tr>
                                        <td>Glass</td>
                                        <td><?php echo $data['collectedWasteByMonth']->glass?></td>

                                    </tr>
                                </table>
                            </div>
                            <div class="right">
                                <canvas id="myPieChart" width="100" height="100"></canvas>

                            </div>
                        </div>
                    </div>
                    <div class="waste-section" id="Handovered">
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




                </div>
            </div>
        </div>
    </div>
</div>





<script>
function scrollToElement(elementId) {
    var element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({
            behavior: "smooth",
            block: "start",
            inline: "nearest"
        });
    }
}
const currentDate = new Date();
const currentMonth = currentDate.getMonth() + 1;
// Add 1 to represent January as index 1
const currentYear = currentDate.getFullYear();
const completedRequests = <?php echo json_encode($data['creditsByMonth1']); ?>;

function getMonthName(monthIndex) {
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
    ];

    return monthNames[monthIndex - 1]; // Subtract 1 to correctly index monthNames array
}
const labels = [];
for (let i = 0; i < 5; i++) {
    const month = (currentMonth - i + 11) % 12; // No need to subtract 1
    const year = currentYear - (i === 0 && currentMonth === 1 ? 1 : 0); // Adjust the condition to check for January
    labels.unshift(getMonthName(month + 1) + ' ' + year);
}

const completedRequestCounts = completedRequests.map(request => {
    const date = new Date(request.date);
    return {
        month: date.getMonth() + 1, // Add 1 to represent January as index 1
        year: date.getFullYear(),
        creditAmount: request.credit_amount,
        req_id: request.req_id
    };
});

function countRequests(requests) {
    const sums = Array(12).fill(0); // Initialize an array to hold sums for each month

    // Calculate sums for each month
    requests.forEach(request => {
        const monthIndex = request.month;
        const creditAmount = parseFloat(request.creditAmount); // Parse creditAmount to float
        // Check if creditAmount is NaN
        if (!isNaN(creditAmount)) {
            sums[monthIndex - 1] += creditAmount;
            // No need to subtract 0
        } else {
            console.log("Invalid creditAmount for request with req_id:", request.req_id);
            // Handle invalid creditAmount here if needed
        }
    });

    return sums;
}

function printLastSixMonths(arr, startIndex) {
    const length = arr.length;
    const result = [];
    // Calculate the start index for slicing the array
    const startIdx = (startIndex - 1 + length) % length;

    for (let i = 0; i <= 4; i++) {
        // Calculate the index, ensuring it stays within bounds and handles negative indices
        const j = (startIdx - i + length) % length;
        // Add the element to the result array
        result.push(arr[j]);
    }

    return result.reverse();
}

const completedData = printLastSixMonths(countRequests(completedRequestCounts), currentDate.getMonth() + 1);

const data = {
    labels: labels,
    datasets: [{
        label: 'Credits',
        data: completedData,
        borderColor: '#64d798',
        backgroundColor: '#64d798',
    }]
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
                text: 'Credits Given Chart'
            }
        }
    },
};

const ctx = document.getElementById('myLineChart').getContext('2d');
const myLineChart = new Chart(ctx, config);
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
                text: 'Waste handovered Pie Chart'
            }
        }
    }
};



const ctx2 = document.getElementById('myPieChart2').getContext('2d');
const myPieChart2 = new Chart(ctx2, config2);
/*Bottom CHART Two*/
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>