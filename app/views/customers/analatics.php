<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Analatics">


        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search" style="visibility:hidden">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" placeholder="Search">
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
                            <form class="mark_as_read" method="post"
                                action="<?php echo URLROOT;?>/customers/view_notification/analatics">
                                <i class="fa-solid fa-check"> </i>
                                <button type="submit">Mark all as read</button>
                            </form>

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
                    <div class="main-right-top-two">

                        <form class="top-bar" method="post" action="<?php echo URLROOT;?>/customers/analatics">
                            <div class="top-bar-left">
                                <h2>Analatics</h2>
                                <p>Here is your overall Anatics</p>
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


                            <button>Filter</button>
                        </form>
                    </div>

                </div>




                <div class="main-right-bottom">
                    <div class="credit-section">
                        <div class="cont A">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <div class="cont-cont">
                                <p>Credit Balance</p>
                                <h1>Eco
                                    <?php echo !empty($data['credit_balance']) ? $data['credit_balance'] : '0.00'; ?>
                                </h1>
                            </div>
                        </div>
                        <div class="cont B">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <div class="cont-cont">
                                <p>Fined </p>
                                <h1>Eco
                                    <?php echo !empty($data['fine_balance']) ? -$data['fine_balance'] : '0.00'; ?>
                                </h1>
                            </div>
                        </div>
                        <div class="cont C">
                            <i class="fas fa-exchange-alt"></i>
                            <div class="cont-cont">
                                <p>Transactions</p>
                                <h1>Eco
                                    <?php echo !empty($data['transaction_balance']) ? $data['transaction_balance'] : '0.00'; ?>
                                </h1>
                            </div>
                        </div>
                        <div class="cont D">
                            <i class="fas fa-check-circle"></i>
                            <div class="cont-cont">
                                <p>Redeemed</p>
                                <h1>Eco
                                    <?php echo !empty($data['redeemed_balance']) ? $data['redeemed_balance'] : '0.00'; ?>
                                </h1>
                            </div>
                        </div>
                    </div>


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
                                    <h3>Credits Earned</h3>
                                    <h1><?php
                                        $credits = isset($data['credits']) ? $data['credits'] : '00.00';
                                    ?>
                                        <?php echo $credits; ?></h1>
                                    </h1>
                                </div>
                                <div class="bottom">
                                    <canvas id="myChart" width="600" height="350"></canvas>
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
var notification = document.getElementById("notification");
var notification_pop = document.getElementById("notification_popup");
notification_pop.style.height = "0px";

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

const ctx = document.getElementById('myChart').getContext('2d');
const myChart1 = new Chart(ctx, config);

/*animations*/
document.addEventListener("DOMContentLoaded", function() {
    var contElements = document.querySelectorAll('.credit-section .cont');

    function checkSlide() {
        contElements.forEach(function(element) {
            var slideInAt = window.scrollY + window.innerHeight - element.clientHeight / 2;
            var elementTop = element.getBoundingClientRect().top;
            var isHalfShown = elementTop < window.innerHeight;
            var isNotScrolledPast = window.scrollY < elementTop + element.clientHeight;

            if (isHalfShown && isNotScrolledPast) {
                element.classList.add('fade-in');
            } else {
                element.classList.remove('fade-in');
            }
        });
    }

    window.addEventListener('scroll', checkSlide);
    checkSlide(); // Trigger once on page load
});

document.addEventListener("DOMContentLoaded", function() {
    var leftContElements = document.querySelectorAll('.left-cont');

    function checkSlide() {
        leftContElements.forEach(function(element) {
            var slideInAt = window.scrollY + window.innerHeight - element.clientHeight / 2;
            var elementTop = element.getBoundingClientRect().top;
            var isHalfShown = elementTop < window.innerHeight;
            var isNotScrolledPast = window.scrollY < elementTop + element.clientHeight;

            if (isHalfShown && isNotScrolledPast) {
                element.classList.add('fade-in');
            } else {
                element.classList.remove('fade-in');
            }
        });
    }

    window.addEventListener('scroll', checkSlide);
    checkSlide(); // Trigger once on page load
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>