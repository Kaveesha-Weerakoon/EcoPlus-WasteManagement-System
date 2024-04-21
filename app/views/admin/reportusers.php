<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_ReportMain">
        <div class="Admin_UserReport">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-left">
                            <button id="requestbtn">Requests & Sales</button>
                            <button id="users">Users</button>

                        </div>
                        <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                    </div>


                    <div class="main-right-bottom">

                        <form class="top-bar" method="post" action="<?php echo URLROOT;?>/admin/reportusers">
                            <div class="top-bar-left">
                                <h2>Analatics</h2>
                                <p>Users</p>
                            </div>
                            <!-- <div class="top-bar-details">
                                <div class="cont" onclick="scrollToElement('Requests')">Requests</div>
                                <div class="cont" onclick="scrollToElement('Collected')">Collected</div>
                                <div class="cont" onclick="scrollToElement('Handoverd')">Handovered</div>
                                <div class="cont" onclick="scrollToElement('Selled')">Selled</div>

                            </div> -->
                            <div class="date-box">

                                <div class="date-box-cont">
                                    <input value="<?php echo $data['from']?>" name="fromDate" type="Date">
                                    <p>Joined from</p>
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
                        <div class="slide">

                            <div class="request-section" id="Requests">
                                <div class="left">
                                    <div class="left-cont">
                                        <i class='bx bx-group'></i>
                                        <p>Collectors</p>
                                        <h1><?php echo $data['collectors']?></h1>
                                    </div>
                                    <div class="left-cont">
                                        <i class='bx bx-group'></i>
                                        <p>Customers</p>
                                        <h1><?php echo $data['customers']?></h1>
                                    </div>
                                    <div class="left-cont">
                                        <i class='bx bx-group'></i>
                                        <p>Collector Assistants</p>
                                        <h1><?php echo $data['collectorassistants']?></h1>

                                    </div>
                                    <div class="left-cont">
                                        <i class='bx bx-group'></i>
                                        <p>Center Workers</p>
                                        <h1><?php echo $data['centerworkers']?></h1>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="right-cont">
                                        <div class="top">
                                            <h3>Last Month's New Users</h3>
                                            <h1 id="prevmonth_customercount">

                                            </h1>
                                        </div>
                                        <div class="bottom">
                                            <canvas id="lineChart" width="688" height="550"></canvas>
                                        </div>
                                    </div>
                                </div>
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
document.getElementById("requestbtn").addEventListener("click", function() {
    window.location.href =
        "<?php echo URLROOT?>/admin/reports"; // Replace "your_page_url_here" with the URL of the page you want to navigate to
});

const customers = <?php echo json_encode($data['allcustomers']); ?>;

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

function getPrevMonthUserCount(requests) {
    const prevMonth = (currentMonth - 1 + 12) % 12; // Calculate the index of the previous month
    const prevMonthYear = (prevMonth === 11) ? currentYear - 1 :
        currentYear; // Adjust the year if the previous month is December
    let prevMonthCount = 0;
    requests.forEach(request => {
        const date = new Date(request.year, request.month);
        if (date.getMonth() === prevMonth && date.getFullYear() === prevMonthYear) {
            prevMonthCount++;
        }
    });
    return prevMonthCount;
}

// Generate labels for the last six months
const labels = [];
for (let i = 0; i < 6; i++) {
    const month = (currentMonth - i + 12) % 12; // Ensure the month is within 0-11 range
    const year = currentYear - (i === 0 && currentMonth === 0 ? 1 : 0); // Adjust the year if current month is January
    labels.unshift(getMonthName(month) + ' ' + year); // Push to the front of the array
}

const customersCounts = customers.map(request => {
    const date = new Date(request.joined_date);
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




const completedData = countRequests(customersCounts); // Reverse the array
const prevMonthUserCount = getPrevMonthUserCount(customersCounts);

const h1Element = document.getElementById('prevmonth_customercount');
h1Element.textContent = prevMonthUserCount.toString();
const data = {
    labels: labels,
    datasets: [{
        label: 'No of Users',
        data: completedData, // Dummy data values
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {
        plugins: {
            title: {
                display: true,
                text: '6-Month User Join Trend'
            }
        }
    }
};


const myChart = new Chart(
    document.getElementById('lineChart'),
    config
);
</script>