<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Complaints_History">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput"  placeholder="Search">
                    </div>
                    <?php require APPROOT . '/views/center_managers/centermanager_notifications/centermanager_notifications.php'; ?>
                 

                    
                </div>
               
                <?php if(!empty($data['complaints_history'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Complaints History</h1>
                    </div>
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Complaint Id</th>
                                <th>Subject</th>
                                <th>Complaint</th>
                                <th>Date & Time</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                    <table class="table">
                                <?php foreach($data['complaints_history'] as $complaint) : ?>
                                        <tr class="table-row">
                                            <td><?php echo $complaint->complaint_id?></td>
                                            <td><?php echo $complaint->subject?></td>
                                            <td><?php echo $complaint->complaint?></td>
                                            <td><?php echo $complaint->date_time?></td>
                                           
                                <?php endforeach; ?>
                    </table>
                    
                    
                    </div>
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                        <img src="<?php echo IMGROOT?>/undraw_questions_re_1fy7.svg" alt="">
                        <h1>There are no complaints yet</h1>    
                        
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
        var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/complaints_history";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    
    function searchTable() {
        var input = document.getElementById('searchInput').value.toLowerCase();
        var rows = document.querySelectorAll('.table-row');

        rows.forEach(function(row) {
            var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
            var subject = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            var complaint = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
            var date_time = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
        

            if (id.includes(input) || subject.includes(input) || complaint.includes(input) || date_time.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });

    }

    document.getElementById('searchInput').addEventListener('input', searchTable);
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>