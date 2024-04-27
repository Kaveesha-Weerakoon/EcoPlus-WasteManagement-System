<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Agent_Main">
    <div class="Agent_Dashboard">


        <div class="main">
            <?php require APPROOT . '/views/credit_discount_agents/agent_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">


                    <?php require APPROOT . '/views/credit_discount_agents/agent_profile/agent_profile.php'; ?>

                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <div class="left">
                            <div class="left-cont">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <div class="right-cont">
                                <h2>Credits Remaining</h2>
                                <h1>Eco<span> <?php echo $data['balance']?></span> </h1>
                            </div>
                        </div>
                        <div class="right">
                            <div class="left-cont">
                                <i class="fa-regular fa-circle-check"></i>
                                <button id="validate">Validate</button>
                            </div>
                            <div class="right-cont">
                                <i class="fa-regular fa-credit-card"></i>
                                <button id="discount"> Offer Discount</button>
                            </div>
                        </div>
                    </div>
                    <div class="main-right-bottom-bottom">
                        <div class="left">
                            <p>6 Months Discount Trends</p>
                            <canvas id="lineChart"></canvas>


                        </div>
                        <div class="right">
                            <div class="top">
                                <h2>Recent Discounts</h2>
                            </div>
                            <div class="down">
                                <div class="downtop">
                                    <table class="table">
                                        <tr class="table-header">
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Discount</th>
                                            <th>Branch</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="down-down">
                                    <table class="table">
                                        <?php $count = 0; ?>
                                        <?php foreach($data['discounts'] as $discounts) : ?>
                                        <?php if ($count >= 5) break; ?>
                                        <tr class="table-row">
                                            <td><?php echo (new DateTime($discounts->created_at))->format('Y-m-d')?>
                                            </td>
                                            <td><?php echo (new DateTime($discounts->created_at))->format('H:i:s')?>
                                            </td>
                                            <td><?php echo $discounts->discount_amount?></td>
                                            <td><?php echo $discounts->center?></td>
                                        </tr>
                                        <?php $count++; ?>
                                        <?php endforeach; ?>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
      

    </div>
</div>



<script>
document.getElementById("validate").addEventListener("click", function() {
    // Navigate to the validation page
    window.location.href = "<?php echo URLROOT?>/CreditDiscountsAgent/validateUser";
});

// Function to navigate on clicking the "Offer Discount" button
document.getElementById("discount").addEventListener("click", function() {
    // Navigate to the offer discount page
    window.location.href = "<?php echo URLROOT?>/CreditDiscountsAgent/balance_validation";
});
const alldiscounts = <?php echo json_encode($data['discounts']); ?>;

const currentDate = new Date();
const currentMonth = currentDate.getMonth();
const currentYear = currentDate.getFullYear();

// Function to get the name of the month for a given month index
function getMonthName(monthIndex) {
    const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    return monthNames[monthIndex];
}

// Generate labels for the last six months
const labels = [];
for (let i = 0; i < 6; i++) {
    const month = (currentMonth - i + 12) % 12; // Ensure the month is within 0-11 range
    const year = currentYear - (i === 0 && currentMonth === 0 ? 1 :
        0); // Adjust the year if the current month is January
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
    }],
    topic: "Hello"
};

const config = {
    type: 'line',
    data: data,
};

document.addEventListener('DOMContentLoaded', (event) => {
    const myChart = new Chart(
        document.getElementById('lineChart'),
        config
    );
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>