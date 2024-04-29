<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Collector_Assistants">
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
                        <h1>Collectors</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p>View</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href=" <?php echo URLROOT?>/centermanagers/collectors_add">
                            <div class="main-right-top-three-content">
                                <p>Register</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/collector_assistants">
                            <div class="main-right-top-three-content">
                                <p><b style="color: var(--green-color-one);">Assistants</b></p>
                                <div class="line" style="background-color: var(--green-color-one);"></div>
                            </div>
                        </a>

                    </div>
                </div>

                <?php if(!empty($data['collector_assistants'])) : ?>
                <div class=" main-right-bottom">
                    <div class="main-right-bottom-top ">
                        <table class="table">
                            <tr class="table-header">
                                <th>Collector ID</th>
                                <th>Assist Name</th>
                                <th>NIC</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>DOB</th>

                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['collector_assistants'] as $collector) : ?>
                            <tr class="table-row">
                                <td><?php echo $collector->collector_id ?></td>
                                <td><?php echo $collector->name ?></td>
                                <td><?php echo $collector->nic ?></td>
                                <td><?php echo $collector->address ?></td>
                                <td><?php echo $collector->contact_no  ?></td>
                                <td><?php echo $collector->dob ?></td>





                            </tr>
                            <?php endforeach; ?>

                    </div>
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                        <img src="<?php echo IMGROOT?>/undraw_questions_re_1fy7.svg" alt="">
                        <h1>There are no collector assistants</h1>


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
    var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/collectors";
    form.action = dynamicUrl; // Set the action URL
    form.submit(); // Submit the form

};

function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');

    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var name = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
        var email = row.querySelector('td:nth-child(4)').innerText.toLowerCase();

        if (id.includes(input) || name.includes(input) || email.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });
}

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>