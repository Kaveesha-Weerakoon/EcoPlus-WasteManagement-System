<?php require APPROOT . '/views/inc/header.php'; ?>



<div class="Customer_Main">
    <div class="Customer_History_Top">
        <div class="Customer_Complain_History">

            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">

                    <div class="main-right-top">

                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input id="complaintSearch" type="text" placeholder="Search">
                            </div>
                            <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>

                        </div>
                        <div class="main-right-top-two">
                            <h1>History</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/customers/history">
                                <div class="main-right-top-three-content">
                                    <p>Discounts</p>
                                    <div class="line1"></div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/customers/history_complains">
                                <div class="main-right-top-three-content">
                                    <p><b style="color: #1ca557;">Complaints</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/customers/transfer_history">
                                <div class="main-right-top-three-content">
                                    <p>Transfer</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php if(!empty($data['complains'])) : ?>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-container">
                            <div class="main-right-bottom-container-top">
                                <div class="circle"></div>
                                <h4>Complaints</h4>
                            </div>
                            <div class="main-right-bottom-container-container">
                                <div class="main-right-bottom-top">
                                    <table class="table">
                                        <tr class="table-header">
                                            <th>Complaint ID</th>
                                            <th>Date & Time</th>
                                            <th>Subject</th>
                                            <th>Complain</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="main-right-bottom-down">
                                    <table class="table">
                                        <?php foreach($data['complains'] as $post) : ?>
                                        <tr class="table-row">
                                            <td>Com <?php echo $post->id?></td>
                                            <td><?php echo $post->date?></td>
                                            <td><?php echo $post->subject?></td>
                                            <td><?php echo $post->complaint?></td>
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
                            <h1>You Have No Active Complains</h1>
                            <p></p>

                        </div>
                    </div>
                    <?php endif; ?>

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
                </script>
            </div>
        </div>

    </div>
    <script>
    /* Notification View */
    document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/customers/view_notification/history_complains";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */
    </script>
    <script src="<?php echo JSROOT?>/Customer.js"> </script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>