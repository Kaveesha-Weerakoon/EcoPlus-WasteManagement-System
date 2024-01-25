<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_History_Top">
        <div class="Customer_Transfer_History">
            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" placeholder="Search" id="complaintSearch">
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
                                    action="<?php echo URLROOT;?>/customers/view_notification/transfer_history">
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
                                    <p>Complaints</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href="">
                                <div class="main-right-top-three-content">
                                    <p><b style="color: #1ca557;">Transfer</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>
                        </div>
                    </div>
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
                                                    src="<?php echo (empty($transaction->receiver_image) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/' . $transaction->receiver_image) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->receiver_image; ?>"
                                                    alt="">
                                                <?php else: ?>
                                                <img class="td-pro_pic"
                                                    src="<?php echo (empty($transaction->sender_image) || !file_exists('C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/'. $transaction->sender_image) ) ? IMGROOT . '/img_upload/customer/Profile.png': IMGROOT . '/img_upload/customer/' . $transaction->sender_image; ?>"
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
                            <h1>Your credit transfer is currently unavailable</h1>
                            <p>Transfer Credits Now!</p>
                            <a href="<?php echo URLROOT?>/customers/transfer"><button>Transfer
                                    Credits</button></a>
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
    var notification = document.getElementById("notification");
    var notification_pop = document.getElementById("notification_popup");
    notification_pop.style.height = "0px";

    notification.addEventListener("click", function() {
        var isNotificationEmpty = <?php echo json_encode(empty($data['notification'])); ?>;

        if (!isNotificationEmpty) {
            var notificationArraySize = <?php echo json_encode(count($data['notification'])); ?>;
            if (notification_pop.style.height === "0px") {
                if (notificationArraySize >= 3) {
                    notification_pop.style.height = "198px";
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
    </script>
    <script src="<?php echo JSROOT?>/Customer.js"> </script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>