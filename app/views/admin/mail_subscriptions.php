<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Mail_Subscriptions">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
                        <i class='bx bx-bell'></i>
                        <div class="dot"></div>
                    </div>
                    <div id="notification_popup" class="notification_popup">
                        <h1>Notifications</h1>
                        <div class="notification">
                            <div class="notification-green-dot">

                            </div>
                            Request 1232 Has been Cancelled
                        </div>
                        <div class="notification">
                            <div class="notification-green-dot">

                            </div>
                            Request 1232 Has been Assigned
                        </div>
                        <div class="notification">
                            <div class="notification-green-dot">

                            </div>
                            Request 1232 Has been Cancelled
                        </div>


                    </div>
                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                        <div class="main-right-top-profile-cont">
                            <h3>Admin</h3>
                        </div>
                    </div>


                </div>

                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Mail Subscriptions</h1>
                    </div>
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Subscription Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date & Time</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">

                        <table class="table">
                            <?php foreach($data['subscriptions'] as $subscription) : ?>
                            <tr class="table-row">
                                <td>S<?php echo $subscription->id?></td>
                                <td><?php echo $subscription->name?></td>
                                <td><?php echo $subscription->email?></td>
                                <td><?php echo $subscription->date_time?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>

                    </div>
                </div>

            </div>
        </div>
            

    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>