<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_View_Customer_Complaints">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
                        </div>
                        <?php require APPROOT . '/views/center_managers/centermanager_notifications/centermanager_notifications.php'; ?>
                     
                    </div>
                    <div class="main-right-top-two">
                        <h1>Complaints</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/centermanagers/view_customer_complaints">
                            <div class="main-right-top-three-content">
                                <p><b style="color: var(--green-color-one);">Customers</b></p>
                                <div class="line" style="background-color: var(--green-color-one);"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/collectors_complains">
                            <div class="main-right-top-three-content">
                                <p>Collectors</p>
                                <div class="line" ></div>
                            </div>
                        </a>
                        

                    </div>
                </div>

                
                <?php if(!empty($data['customer_complaints'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Complaint ID</th>
                                <th>Customer ID</th>
                                <th>Date & Time</th>
                                <th>Subject</th>
                                <th>Details</th>
                                
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['customer_complaints'] as $complaint) : ?>
                            <tr class="table-row">
                                <td><?php echo $complaint->id?></td>
                                <td><?php echo $complaint->customer_id?></td>
                                <td><?php echo $complaint->date?></td>
                                <td><?php echo $complaint->subject?></td>
                                <td><i class='bx bx-info-circle' style="font-size: 29px"
                                    onclick="view_complaint_details(<?php echo htmlspecialchars(json_encode($complaint), ENT_QUOTES, 'UTF-8') ?>)"></i>
                                </td>
                                
                                
                            </tr>
                            <?php endforeach; ?>

                        </table>
                    </div>
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                        <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                        <h1>There are no customer complaints at the moment</h1>
                        <p>Hope you will continue customer satisfaction</p>
                        

                    </div>
                </div>
                <?php endif; ?>

                
        
            </div>

        </div>

        <div class="overlay" id="overlay"></div>

        <div class="personal-details-popup-box" id="personal-details-popup-box">
            <div class="personal-details-popup-form">
                <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="personal-details-popup-form-close"
                    id="personal-details-popup-form-close">
                <center>
                    <div class="personal-details-topic">Complaint Details</div>
                </center>

                <div class="personal-details-popup">
                    <div class="personal-details-left">
                        <img src="" id="user_profile_pic" alt="">
                        <p>Customer ID: <span id="user_id">C</span></p>
                    </div>
                    <div class="personal-details-right">
                        <div class="personal-details-right-labels">
                            <span>Complaint ID</span><br>
                            <span>Customer Name</span><br>
                            <span>Contact No</span><br>
                            

                        </div>
                        <div class="personal-details-right-values">
                            <span id="complain_id"></span><br>
                            <span id="user_name"></span><br>
                            <span id="user_contactno"></span><br>
                           


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
                                    <h2>Complaint</h2><br>
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

    </div>
</div>
<script>
    /* Notification View */
    document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/view_customer_complaints";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };

    function view_complaint_details(complaint) {
        var personalPop = document.getElementById('personal-details-popup-box');
        personalPop.classList.add('active');
        document.getElementById('overlay').style.display = "flex";

        document.getElementById('user_id').textContent = complaint.customer_id;
        document.getElementById('complain_id').textContent = complaint.id;
        document.getElementById('user_profile_pic').src = "<?php echo IMGROOT?>/img_upload/customer/" + complaint.image;
        document.getElementById('user_name').textContent = complaint.name;
        document.getElementById('user_contactno').textContent = complaint.contact_no;
        document.getElementById('subject').textContent = complaint.subject;
        document.getElementById('complain').textContent = complaint.complaint;


    }

    document.addEventListener('DOMContentLoaded', function() {
        var close_personal_details = document.getElementById('personal-details-popup-form-close');
        close_personal_details.addEventListener('click', function() {
            const personal_details = document.getElementById("personal-details-popup-box");
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