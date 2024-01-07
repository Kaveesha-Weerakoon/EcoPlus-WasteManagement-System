<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_assistants-main">
        <div class="main">
            <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
                        </div>
                        <div class="main-right-top-notification" id="notification">
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
    <?php require APPROOT . '/views/inc/footer.php'; ?>
        
