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
                                    <p><?php echo date('Y-m-d', strtotime($notification->date_time)); ?></p>
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
                                <button type="button" id="setButton">Set</button>
                                <span>*This action is not reversible</span>

                            </div>

                            <div class="right">
                                <div class="wrapper">
                                    <header>
                                        <p class="current-date"></p>
                                        <div class="icons">
                                        <i id="prev" class='bx bx-chevron-left'></i>
                                        <i id="next" class='bx bx-chevron-right'></i>
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
                            <div class="content_container">
                                <h3>Regional Collectors</h3>
                                <h2><?php echo $data['collectors_count']?></h2>
                            </div>
                            
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_center_workers()">
                            <div class="icon_container">
                                <i class='bx bx-group'></i>
                            </div>
                            <div class="content_container">
                                <h3>Center Workers</h3>
                                <h2><?php echo $data['center_workers_count']?></h2>
                            </div>
                            
                        </div>
                        <div class="main-right-bottom-two-cont A" onclick="redirect_completed_requests()">
                            <div class="icon_container">
                                <i class='bx bx-message-alt-check'></i>
                            </div>
                            <div class="content_container">
                                <h3>Fulfilled Requests</h3>
                                <h2><?php echo $data['completed_request_count']?></h2>
                            </div>
                        </div>
                        <div class="main-right-bottom-two-cont A">
                            <div class="icon_container">
                                <i class='bx bx-user'></i>
                            </div>
                            <div class="content_container">
                                <h3>Region Customers</h3>
                                <h2><?php echo $data['customers_count']?></h2>
                            </div>
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
                                
                                <div class="complaints-container">
                                    <h1 >Complaints</h1>
                                    <i class='bx bx-message-error'></i>
                                    <!-- <p>If there's any issue regarding center, make a complaint from here</p> -->
                                    <p>If you encounter any issues, submit a complaint here</p>
                                    <button type="button" onclick="redirect_complaints()">Complaint</button>
                                    <span onclick="redirect_complaints_history()">View History >></span>

                                </div>
                                

                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="overlay" id="overlay"></div>

            <div class="confirm-hoildays-popup" id="confirm-hoildays-popup">
                <form class="confirm-hoildays-form" id="confirm-hoildays-form" method="post"
                    action="<?php echo URLROOT?>/centermanagers/mark_holidays">
                    <h1>Mark this date as a holiday?</h1>
                    <input type="text" class="holiday" id="holiday" name="holiday" readonly>
                    <p>This date will be marked as a off-day. Customers won't be able to request on off-days</p> 
                    <div class="cancel-confirm-button-container">
                        <button type="button" onclick="validateHolidayForm()" id="cancel-pop"
                            class="holiday-submit-button">Mark</button>
                        <button type="button" onclick="closeHolidayPopup()" id="cancel-pop"
                            class="holiday-cancel-button">Cancel</button>
                    </div>

                </form>

            </div>

            <?php if($data['holiday_success']=='True') : ?>
                <div class="holiday_success">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Holiday marked successfully</p>
                        <a href="<?php echo URLROOT?>/centermanagers"><button type="button">OK</button></a>
                    </div>
                </div>
            <?php endif; ?>


        </div>
    </div>
</div>
<script>
var color = "#47b076";
var textColor = "#414143";

var checkbox = document.getElementById('toggle-checkbox');

var notification = document.getElementById("notification");
var notification_pop = document.getElementById("notification_popup");
notification_pop.style.height = "0px";
notification_pop.style.zIndex = 2;
let circularProgress = document.querySelector(".circular-progress");
let progressValue = document.querySelector(".progress-value");
let progressStartValue = -1;
let progressEndValue = <?php echo intval($data['percentage']); ?>;
let speed = 30;

function getDarkModeSetting() {
    const storedValue = localStorage.getItem("darkMode");
    return storedValue ? JSON.parse(storedValue) : true;
}

isDarkMode = getDarkModeSetting();
if (getDarkModeSetting()) {

    color = "white"
    textColor = " white";
    circularProgress.style.background =
        `conic-gradient(${color}, ${progressStartValue * 3.6}deg, ${isDarkMode ? "#001f3f" : "#ededed"} 0deg)`;
}

let progress = setInterval(() => {
    if (progressStartValue == progressEndValue) {
        clearInterval(progress);
    }
    progressStartValue++;
    progressValue.textContent = `${progressStartValue}%`;
    if (!getDarkModeSetting()) {
        circularProgress.style.background =
            circularProgress.style.background =
            `conic-gradient(${color}, ${progressStartValue * 3.6}deg, #ededed 0deg)`;
    } else {
        circularProgress.style.background =
            `conic-gradient(${color}, ${progressStartValue * 3.6}deg, #001f3f 0deg)`;
    }


    if (progressStartValue == progressEndValue) {
        clearInterval(progress);
    }
}, speed);



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

function redirect_complaints_history() {
    var linkUrl = "<?php echo URLROOT?>/centermanagers/complaints_history";
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

var markedHolidays = <?php echo json_encode($data['marked_holidays']); ?>;

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

        let isMarked = markedHolidays.some(function(holiday) {
            return holiday.date === `${currYear}-${(currMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
        });

        liTag += `<li class="${isToday} ${isMarked ? 'marked' : ''}">${i}</li>`;
        //liTag += `<li class="${isToday}">${i}</li>`;

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

function openHolidayPopup(holiday) {
    if (holiday && !document.querySelector('.selected').classList.contains('inactive') && !document.querySelector('.selected').classList.contains('active')) {
        // Set the selected date in the popup
        document.getElementById('holiday').value = holiday;

        // Show the popup
        var cancel_popup = document.getElementById('confirm-hoildays-popup');
        cancel_popup.classList.add('active');

        document.getElementById('overlay').style.display = "flex";

        document.querySelector('.wrapper').classList.remove('invalid-selection');
    } else {
        // Display an error message because no date is selected
        document.querySelector('.wrapper').classList.add('invalid-selection');
    }
    
    // //document.getElementById('confirm-hoildays-popup').style.display = 'flex';

}

const calendarBody = document.querySelector(".days");
calendarBody.addEventListener('click', selectDate);
var selectedDate; // Variable to store the selected date
var holiday;

// Function to handle date cell click
function selectDate(event) {
    
    // Reset the selected date class
    document.querySelectorAll('.days li').forEach(function(day) {
        day.classList.remove('selected');
    });

    // Get the clicked date
    selectedDate = event.target.innerHTML;
    //console.log(selectedDate);

    if (event.target.classList.contains('inactive')) {
        // Prevent any action for inactive days
        return;
    }

    holiday = `${currYear}-${(currMonth + 1).toString().padStart(2, '0')}-${selectedDate.toString().padStart(2, '0')}`;
    console.log(holiday);

    // Highlight the selected date
    event.target.classList.add('selected');    

}

document.getElementById('setButton').addEventListener('click', function() {
        openHolidayPopup(holiday);
});

function validateHolidayForm() {
    var holidayInput = document.getElementById("holiday").value;
    
    console.log(markedHolidays);


    if (holidayInput.trim() === "") {
        alert("Something went wrong");
    }else if (!/^\d{4}-\d{2}-\d{2}$/.test(holidayInput.trim())) {
        alert("Invalid date format");
    }  else {

        // Convert the input date string to a Date object
        var selectedDate = new Date(holidayInput.trim());
        var currentDate = new Date();

        if (selectedDate < currentDate) {
            alert("You cannot mark a past date as a holiday");
        } else {
            var isDateAlreadyMarked = markedHolidays.some(function(holiday) {
                return holiday.date === holidayInput.trim();
            });

            if (isDateAlreadyMarked) {
                alert("This date is already marked as a holiday");
            } else {
                // If the date is not already marked, submit the form
                document.getElementById("confirm-hoildays-form").submit();
            }

        }

        
    }
    
    document.getElementById('overlay').style.display = "none";

}

// Function to close the popup
function closeHolidayPopup() {
    // Hide the popup
    //document.getElementById('confirm-hoildays-popup').style.display = 'none';
    var cancel_popup = document.getElementById('confirm-hoildays-popup');
    cancel_popup.classList.remove('active');

    document.getElementById('overlay').style.display = "none";
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
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>