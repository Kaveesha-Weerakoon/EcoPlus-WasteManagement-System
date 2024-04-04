<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_History_Top">
        <div class="Customer_Transfer_History">
            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">
                    <?php require APPROOT . '/views/customers/customer_historytop/customer_historytop.php'; ?>

                    <?php if(!empty($data['transaction_history'])) : ?>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-container">
                            <div class="main-right-bottom-container-top">
                                <div class="circle"></div>
                                <h4>Transfer History</h4>
                            </div>
                            <div class="main-right-bottom-container-bottom">
                                <div class="main-right-bottom-top">
                                    <table class="table">
                                        <tr class="table-header">
                                            <th>Transfer ID</th>
                                            <th>Date & Time</th>
                                            <th>Status</th>
                                            <th>Transaction Account</th>
                                            <th>Transaction Person</th>
                                            <th>Amount</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="main-right-bottom-down">
                                    <table class="table">

                                        <?php foreach ($data['transaction_history'] as $transaction): ?>
                                        <tr class="table-row">
                                            <td>T <?php echo $transaction->id ?></td>
                                            <td><?php echo $transaction->date . ' ' . $transaction->time; ?></td>
                                            <td>
                                                <?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                                <i class='bx bxs-send'></i>
                                                <p>Sent</p>
                                                <?php else: ?>
                                                <i class='bx bxs-chevrons-down'></i>
                                                <p>Received</p>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                                C <?php echo $transaction->receiver_id; ?>
                                                <?php else: ?>
                                                C <?php echo $transaction->sender_id; ?>
                                                <?php endif; ?>

                                            </td>
                                            <td>
                                                <?php if ($transaction->sender_id == $_SESSION['user_id']): ?>
                                                <img class="td-pro_pic"
                                                    src="<?php echo (empty($transaction->receiver_img) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/' . $transaction->receiver_img) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->receiver_img; ?>"
                                                    alt="">
                                                <?php else: ?>
                                                <img class="td-pro_pic"
                                                    src="<?php echo (empty($transaction->sender_img) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/'. $transaction->sender_img) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->sender_img; ?>"
                                                    alt="">
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $transaction->transfer_amount; ?></td>
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
                            <h1>No credit Transfers Yet</h1>
                            <a href="<?php echo URLROOT?>/customers/transfer"><button>Transfer
                                    Now</button></a>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <script>
    function searchComplaints() {
        var input = document.getElementById('complaintSearch').value.toLowerCase();
        var rows = document.querySelectorAll('.table-row');

        rows.forEach(function(row) {
            var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
            var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            var subject = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
            var complaint = row.querySelector('td:nth-child(4)').innerText.toLowerCase();

            if (id.includes(input) || date.includes(input) || subject.includes(input) || complaint
                .includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });
    }

    document.getElementById('complaintSearch').addEventListener('input', searchComplaints);
    document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/customers/view_notification/transfer_history";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    </script>
    <script src="<?php echo JSROOT?>/Customer.js"> </script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>