<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_DicountAgent_Main">

        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <a href="<?php echo URLROOT?>/admin/discount_agents"><i class='bx bxs-chevrons-left'></i></a>

                        <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>
                    </div>
                    <div class=" main-right-top-two">
                        <img
                            src="<?php echo IMGROOT?>/img_upload/credit_discount_agent/<?php  echo $data['agent']->image?>">
                        <h1><?php echo $data['agent']->name?></h1>
                        <div class="balance">
                            <div class="top">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                <h3>Balance</h3>
                            </div>

                            <h2>Eco <?php echo $data['agent']->credits?></h2>
                        </div>
                        <button onclick="credit()">Credit</button>
                    </div>
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-left">
                        <div class="top">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                            <h3>Discounts</h3>
                        </div>
                        <div class="bottom">
                            <div class="main-right-bottom-left-top ">
                                <table class="table">
                                    <tr class="table-header">
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Discount</th>
                                        <th>Outlet</th>

                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-left-down">
                                <table class="table">
                                    <?php foreach($data['discounts'] as $discounts) : ?>
                                    <tr class="table-row">
                                        <td><?php echo (new DateTime($discounts->created_at))->format('Y-m-d')?>
                                        </td>
                                        <td><?php echo (new DateTime($discounts->created_at))->format('H:i:s')?>
                                        </td>
                                        <td><?php echo $discounts->discount_amount?></td>
                                        <td><?php echo $discounts->center?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="main-right-bottom-right">
                        <div class="top">
                            <div class="top-top">
                                <i class="fa-solid fa-circle-down"></i>
                                <h3>Credit Ledger</h3>
                            </div>
                            <div class="top-bottom">
                                <div class="top-bottom-top ">
                                    <table class="table">
                                        <tr class="table-header">
                                            <th>Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="top-bottom-down">
                                    <table class="table">
                                        <?php foreach($data['credit_log'] as $discounts) : ?>
                                        <tr class="table-row">
                                            <td><?php echo (new DateTime($discounts->credited_date))->format('Y-m-d')?>
                                            </td>
                                            <td><?php echo $discounts->credited_amount?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="down">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="credit_pop_up" id="credit">
                <form action="<?php echo URLROOT;?>/admin/discount_agent_view/<?php echo $data['agent']->user_id?>"
                    method="post" id="credit_pop">
                    <div class="credit_pop_up_form">
                        <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="credit_pop_up_form_close"
                            id="credit_pop_up_form_close">
                        <div class="credit_pop_up_form_top">
                            <div class="set_fine_topic">Add Credits</div>
                        </div>

                        <div class="credit_pop_up_form-container">
                            <div class="credit_pop_up_form-content">
                                <span>Credit Amount</span>
                                <div class="input-box">
                                    <input type="text" name="credit_value" id="credit_value" value="">

                                </div>
                            </div>
                            <!-- <?php echo $data['minimum_collect']?> -->
                            <button type="button" onclick="validateAndSubmit()" class="set_fine_button">Set</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="overlay" id="overlay"></div>

    </div>

</div>
<script>
function credit() {
    var finePop = document.getElementById('credit');
    finePop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function validateAndSubmit() {
    var credit_value = document.getElementById('credit_value').value;
    var numberPattern =
        /^\d{1,6}(?:\.\d{1,2})?$/; // Regex for numbers less than 10 lakhs with up to two decimal places
    if (!numberPattern.test(credit_value)) {
        alert('Please enter valid numeric values with up to two decimal places.');
        return;
    }

    document.getElementById('credit_pop').submit();
}


document.addEventListener("DOMContentLoaded", function() {
    const close_request_details = document.getElementById("credit_pop_up_form_close");
    close_request_details.addEventListener("click", function() {
        const request_details = document.getElementById("credit");
        request_details.classList.remove('active');
        document.getElementById('overlay').style.display = "none";
    });

});


const alldiscounts = <?php echo json_encode($data['discounts']); ?>;

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

function countRequests(requests) {
    const counts = Array(6).fill(0);
    requests.forEach(request => {
        const date = new Date(request.created_at);
        const month = date.getMonth();
        const year = date.getFullYear();
        let monthDiff = (currentYear - year) * 12 + currentMonth - month;
        if (monthDiff >= 0 && monthDiff < 6) {
            counts[(5 - monthDiff + 6) % 6]++; // Calculate the index in reverse order
        }
    });
    return counts;
}

const completedData = countRequests(alldiscounts);

const data = {
    labels: labels,
    datasets: [{
        label: 'Discounts',
        data: completedData,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
    }]
};

const config = {
    type: 'line',
    data: data,
};

const myChart = new Chart(
    document.getElementById('lineChart'),
    config
);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>