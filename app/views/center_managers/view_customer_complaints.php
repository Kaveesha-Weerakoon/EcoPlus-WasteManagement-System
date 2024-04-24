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
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Contact No</th>
                                <th>Request ID</th>
                                <th>Complaint</th>
                                <th>Date</th>
                                
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['customer_complaints'] as $complaint) : ?>
                            <tr class="table-row">
                                <td><?php echo $complaint->customer_id?></td>
                                <td><?php echo $complaint->name?></td>
                                <td><?php echo $complaint->contact_no?></td>
                                <td><?php echo $complaint->subject?></td>
                                <td><?php echo $complaint->complaint?></td>
                                <td><?php echo $complaint->date?></td>
                                
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
        var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/garbage_types";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>