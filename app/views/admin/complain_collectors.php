<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Complain_main">
        <div class="Admin_Collectors_Complains ">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">

                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>

                            <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                        </div>
                        <div class="main-right-top-two">
                            <h1>Complaints</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/Admin/complain_customers">
                                <div class="main-right-top-three-content">
                                    <p>Customers</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/complain_collectors">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">Collectors</b></p>
                                    <div class="line" style="background-color: #1ca557;"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/complaint_centers">
                                <div class="main-right-top-three-content">
                                    <p>Centers</p>
                                    <div class="line"></div>
                                </div>
                            </a>


                        </div>
                    </div>

                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Complaint ID</th>
                                    <th>Collector ID</th>
                                    <th>Center</th>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Details</th>

                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['complains'] as $complaint) : ?>
                                <tr class="table-row">
                                    <td>Com<?php echo $complaint->id?></td>
                                    <td>CO<?php echo $complaint->collector_id?></td>
                                    <td><?php echo $complaint->region?></td>
                                    <td><?php echo date('Y-m-d', strtotime($complaint->date)); ?></td>
                                    <td><?php echo $complaint->subject?></td>
                                    <td><i onclick="openpersonaldetails((<?php echo htmlspecialchars(json_encode( $complaint), ENT_QUOTES, 'UTF-8') ?>))"
                                            class='bx bxs-file' style="font-size: 29px;"></i></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="personal-details-popup-box" id="personal-details-popup-box">
                <div class="personal-details-popup-form">
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="personal-details-popup-form-close"
                        id="personal-details-popup-form-close">
                    <center>
                        <div class="personal-details-topic">Complain Details</div>
                    </center>

                    <div class="personal-details-popup">
                        <div class="personal-details-left">
                            <img src="" id="user_profile_pic" alt="">
                            <p>Customer ID <span id="user_id">C</span></p>
                        </div>
                        <div class="personal-details-right">
                            <div class="personal-details-right-labels">
                                <span>Complain Id</span><br>
                                <span>Customer Name</span><br>
                                <span>Contact No</span><br>
                                <span>Customer Region</span><br>

                            </div>
                            <div class="personal-details-right-values">
                                <span id="complain_id"></span><br>
                                <span id="user_name"></span><br>
                                <span id="user_contactno"></span><br>
                                <span id="user_region"></span><br>


                            </div>
                        </div>
                        <div class="personal-details-bottom">
                            <div class="personal-details-bottom-one">
                                <h2>Subject</h2><br>
                                <div>

                                    <div class="subject-complain-box">
                                        <div class="subject-complain">
                                            <span id="subject"></span><br>
                                        </div>

                                    </div>
                                    <div class="personal-details-bottom-two">
                                        <h2>Complain</h2><br>
                                        <div>

                                            <div class="subject-complain-box">
                                                <div class="subject-complain">
                                                    <span id="complain"></span><br>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay" id="overlay"></div>



            <script>
            function openpersonaldetails(user) {
                var personalPop = document.getElementById('personal-details-popup-box');
                personalPop.classList.add('active');
                document.getElementById('overlay').style.display = "flex";

                document.getElementById('user_id').textContent = user.customer_id;
                document.getElementById('complain_id').textContent = user.id;
                document.getElementById('user_profile_pic').src =
                    "<?php echo IMGROOT?>/img_upload/customer/" +
                    user.image;
                document.getElementById('user_name').textContent = user.name;
                document.getElementById('user_contactno').textContent = user.contact_no;
                document.getElementById('user_region').textContent = user.region;
                document.getElementById('subject').textContent = user.subject;
                document.getElementById('complain').textContent = user.complaint;


            }

            document.addEventListener('DOMContentLoaded', function() {
                var close_personal_details = document.getElementById(
                    'personal-details-popup-form-close');
                close_personal_details.addEventListener('click', function() {
                    const personal_details = document.getElementById(
                        "personal-details-popup-box");
                    personal_details.classList.remove('active');
                    document.getElementById('overlay').style.display = "none";

                });
            });

            function searchTable() {
                var input = document.getElementById('searchInput').value.toLowerCase();
                var rows = document.querySelectorAll('.table-row');
                rows.forEach(function(row) {
                    var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                    var status = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                    var date = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
                    var time = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
                    var center = row.querySelector('td:nth-child(5)').innerText.toLowerCase();

                    if (center.includes(input) || id.includes(input) || status.includes(input) || date
                        .includes(
                            input) || time.includes(input)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                });

            }

            document.getElementById('searchInput').addEventListener('input', searchTable);
            </script>

            <?php require APPROOT . '/views/inc/footer.php'; ?>