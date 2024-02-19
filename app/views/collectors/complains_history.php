<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_Complains_History">
        <div class="main">
            <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search" style="visibility:hidden">
                        <i class='bx bxl-sketch'></i> <input type="text" placeholder="Welcome Back !" id="searchInput"
                            readonly oninput="highlightMatchingText()">
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
                        <form class="mark_as_read" method="post" action="<?php echo URLROOT;?>/collectors/">
                            <i class="fa-solid fa-check"> </i>
                            <button type="submit">Mark all as read</button>
                        </form>

                    </div>
                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $_SESSION['collector_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['collector_name']?></h3>
                            <p>ID : C <?php echo $_SESSION['collector_id']?></p>
                        </div>
                    </div>
                </div>
                <div class="main-bottom">
                    <div class="main-bottom-top">
                        <h2>Complains</h2>
                        <div class="main-bottom-top-cont">
                            <a href="<?php echo URLROOT?>/collectors/complains">
                                <div class="main-bottom-top-content">
                                    <p>Complaint</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/collectors/complains_history">
                                <div class="main-bottom-top-content">
                                    <p><b style="color:#1ca557;">History</b></p>
                                    <div class="line2"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="main-right-bottom">

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
            <!-- <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
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
                            <form class="mark_as_read" method="post" action="<?php echo URLROOT;?>/collectors/">
                                <i class="fa-solid fa-check"> </i>
                                <button type="submit">Mark all as read</button>
                            </form>

                        </div>
                        <div class="main-right-top-profile">
                            <img src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $_SESSION['collector_profile']?>"
                                alt="">
                            <div class="main-right-top-profile-cont">
                                <h3><?php echo $_SESSION['collector_name']?></h3>
                                <p>ID : Col <?php echo $_SESSION['collector_id']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Complain</h1>
                    </div>
                </div>
                <?php if(!empty($data['complains'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-container">
                        <div class="main-right-bottom-container-top">
                            <div class="circle"></div>

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

            </div> -->

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
<?php require APPROOT . '/views/inc/footer.php'; ?>