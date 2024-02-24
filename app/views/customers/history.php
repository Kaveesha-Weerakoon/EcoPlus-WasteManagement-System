<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_History_Top ">
        <div class="Customer_Main_History">
            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" placeholder="Search">
                            </div>
                            <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>

                        </div>
                        <div class="main-right-top-two">
                            <h1>History</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/customers/history">
                                <div class="main-right-top-three-content">
                                    <p><b style="color: #1ca557;">Discounts</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/customers/history_complains">
                                <div class="main-right-top-three-content">
                                    <p>Complaints</p>
                                    <div class="line1"></div>
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
                                            <th>Discount ID</th>
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
                            <h1>You Have No Active Complains</h1>
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
    /* ----------------- */
    </script>
    <script src="<?php echo JSROOT?>/Customer.js"> </script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>