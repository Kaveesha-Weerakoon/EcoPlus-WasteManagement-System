<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_History_Top ">
        <div class="Customer_Main_History">
            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">
                    <?php require APPROOT . '/views/customers/customer_historytop/customer_historytop.php'; ?>


                    <?php if(!empty($data['discount'])) : ?>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-container">
                            <div class="main-right-bottom-container-top">
                                <div class="circle"></div>
                                <h4>Discounts</h4>
                            </div>
                            <div class="main-right-bottom-container-container">
                                <div class="main-right-bottom-top">
                                    <table class="table">
                                        <tr class="table-header">
                                            <th>Discount Agent</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Credit Amount</th>
                                            <th>Branch</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="main-right-bottom-down">
                                    <table class="table">
                                        <?php foreach($data['discount'] as $post) : ?>
                                        <tr class="table-row">
                                            <td><?php echo $post->name?></td>
                                            <?php
                                                $date = date('Y-m-d', strtotime($post->created_at));
                                                $time = date('H:i:s', strtotime($post->created_at));
                                                ?>
                                            <td><?php echo $date ?></td>
                                            <td><?php echo $time ?></td>
                                            <td><?php echo $post->discount_amount?></td>
                                            <td><?php echo $post->center?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-content">
                            <i class='bx bx-data' style="font-size: 150px"></i>
                            <h1>You Have No Credit Redemptions</h1>
                            <p></p>

                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <script>
    /* Notification View */
    document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/customers/view_notification/history";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };

    function searchComplaints() {
        var input = document.getElementById('complaintSearch').value.toLowerCase();
        var rows = document.querySelectorAll('.table-row');

        rows.forEach(function(row) {
            var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
            var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            var subject = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
            var complaint = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
            var branch = row.querySelector('td:nth-child(5)').innerText.toLowerCase();

            if (id.includes(input) || date.includes(input) || subject.includes(input) || complaint
                .includes(input) || branch.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });
    }

    document.getElementById('complaintSearch').addEventListener('input', searchComplaints);
    /* ----------------- */
    </script>
    <script src="<?php echo JSROOT?>/Customer.js"> </script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>