<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Agent_Main">
    <div class="Discount_Agent_History">
        <div class="main">
            <?php require APPROOT . '/views/credit_discount_agents/agent_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>
                    <?php require APPROOT . '/views/credit_discount_agents/agent_profile/agent_profile.php'; ?>

                </div>
                <div class="main-right-bottom">
                    <div class="main-bottom-top">
                        <h2>Discounts History</h2>

                    </div>
                    <div class="main-right-bottom-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Discount ID</th>
                                    <th>Date & Time </th>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Branch</th>
                                    <th>Amount</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['discounts'] as $discount) : ?>
                                <tr class="table-row">
                                    <td><?php echo $discount->discount_id?></td>
                                    <td><?php echo $discount->created_at?></td>
                                    <td><?php echo $discount->customer_name?></td>
                                    <td><?php echo $discount->customer_id?></td>
                                    <td><?php echo $discount->discount_amount?></td>
                                    <td><?php echo $discount->center?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
    function searchTable() {
        var input = document.getElementById('searchInput').value.toLowerCase();
        var rows = document.querySelectorAll('.table-row');

        rows.forEach(function(row) {
            var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
            var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            var time = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
            var customer = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
            var cid = row.querySelector('td:nth-child(5)').innerText.toLowerCase();
            var conctact_no = row.querySelector('td:nth-child(6)').innerText.toLowerCase();

            if (time.includes(input) || id.includes(input) || date.includes(input) || customer.includes(
                    input) ||
                cid.includes(input) || conctact_no.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });


    }
    document.getElementById('searchInput').addEventListener('input', searchTable);
    </script>
    <?php require APPROOT . '/views/inc/footer.php'; ?>