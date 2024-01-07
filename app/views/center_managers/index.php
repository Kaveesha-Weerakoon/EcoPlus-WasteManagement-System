<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">

    <div class="CenterManager_Dashboard">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

            <div class="main-right">

                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
                    </div>

                    <div class="main-right-top-notification" id="notification">
                        <i class='bx bx-bell'></i>
                        <?php if (!empty($data['notification'])) : ?>
                        <div class="dot"></div>
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
                                    <?php echo $notification->notification?>

                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                        <form class="mark_as_read" method="post" action="<?php echo URLROOT;?>/centermanagers/">
                            <i class="fa-solid fa-check"> </i>
                            <button type="submit">Mark all as read</button>
                        </form>

                    </div>

                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['center_manager_name']?></h3>
                            <p>ID : CM <?php echo $_SESSION['center_manager_id']?></p>
                        </div>
                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-one">
                        <div class="main-right-bottom-one-left">
                            <div class="left">
                                <h1>Incoming Requests</h1>
                                <h3><?php echo $data['incoming_request_count']?></h3>
                                <p>Last Update</p>
                                <button onclick="redirect_incoming_requests()">View</button>

                            </div>

                            <div class="right">
                                <i class='bx bx-building-house'></i>
                                <h1><?php echo $data['center_name']?><span class="main-credit"></span> </h1>
                                <h3>Center ID: CEN <?php echo $data['center_id']?></h3>
                            </div>
                        </div>
                        <div class="main-right-bottom-one-right">
                            <div class="left">
                                <!-- <h1>Incoming Requests</h1> -->
                                <h3>Available Hours: 8am to 5pm</h3>
                                <p>Set holidays for the center</p>
                                <button>Set</button>
                                <span>*This action is not reversible</span>

                            </div>

                            <div class="right">
                                <div class="wrapper">
                                    <header>
                                        <p class="current-date"></p>
                                        <div class="icons">
                                        <i id="prev" class='bx bx-chevron-left'></i>
                                        <i id="next" class='bx bx-chevron-right'></i>
                                        <!-- <span id="prev" class="material-symbols-rounded">chevron_left</span>
                                        <span id="next" class="material-symbols-rounded">chevron_right</span> -->
                                        </div>
                                    </header>
                                    <div class="calendar">
                                        <ul class="weeks">
                                        <li>Sun</li>
                                        <li>Mon</li>
                                        <li>Tue</li>
                                        <li>Wed</li>
                                        <li>Thu</li>
                                        <li>Fri</li>
                                        <li>Sat</li>
                                        </ul>
                                        <ul class="days"></ul>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-cont A" onclick="redirect_collectors()">
                            <div class="icon_container">
                                <i class='bx bx-user'></i>
                            </div>
                            <h3>Collectors</h3>
                            <h2>10</h2>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_center_workers()">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <h3>Center Workers</h3>
                            <h2>12</h2>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_completed_requests()">
                            <div class="icon_container">
                                <i class='bx bx-message-alt-check'></i>
                            </div>
                            <h3>Fulfilled Requests</h3>
                            <h2>14</h2>
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_complaints()">
                            <div class="icon_container">
                                <i class='bx bx-donate-heart'></i>
                            </div>
                            <h3>Complaints</h3>
                        </div>

                    </div>
                    <div class="main-right-bottom-three">
                        <div class="main-right-bottom-three-left">
                            <canvas id="myChart" width="600" height="250"></canvas>

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
                                <button>
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


        </div>
    </div>
</div>
<script>
var color = "#47b076";
var textColor = "#414143";

var notification = document.getElementById("notification");
var notification_pop = document.getElementById("notification_popup");
notification_pop.style.height = "0px";

function redirect_incoming_requests() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/request_incomming";
    window.location.href = linkUrl;
}

function redirect_collectors() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/collectors";
    window.location.href = linkUrl;
}

function redirect_center_workers() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/center_workers";
    window.location.href = linkUrl;
}

function redirect_complaints() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/complaints";
    window.location.href = linkUrl;
}

function redirect_completed_requests() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/request_completed";
    window.location.href = linkUrl;
}

notification.addEventListener("click", function() {
    var isNotificationEmpty = <?php echo json_encode(empty($data['notification'])); ?>;

    if (!isNotificationEmpty) {
        var notificationArraySize = <?php echo json_encode(count($data['notification'])); ?>;
        if (notification_pop.style.height === "0px") {
            if (notificationArraySize >= 3) {
                notification_pop.style.height = "205px";
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
    var Current_Garbage = <?php echo $data['current_garbage']?>;
    const ctx = document.getElementById('myChart').getContext('2d');

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Plastic', 'Polythene', 'Metal', 'Glass', 'Paper', 'Electronic'],
            datasets: [{
                label: 'Kilograms',
                data: [Current_Garbage.current_plastic,
                    Current_Garbage.current_polythene,
                    Current_Garbage.current_metal,
                    Current_Garbage.current_glass,
                    Current_Garbage.current_paper,
                    Current_Garbage.current_electronic
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
                    suggestedMax: Math.max.apply(null, [Current_Garbage.current_plastic,
                        Current_Garbage.current_polythene,
                        Current_Garbage.current_metal,
                        Current_Garbage.current_glass,
                        Current_Garbage.current_paper,
                        Current_Garbage.current_electronic
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
                    text: 'Current Garbage Stock',
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

/*Calendar*/ 
const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".current-date"),
prevNextIcon = document.querySelectorAll(".icons i");

// getting new date, current year and month
let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];

const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                     && currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li class="${isToday}">${i}</li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;
}
renderCalendar();

prevNextIcon.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
        } else {
            date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
    });
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>