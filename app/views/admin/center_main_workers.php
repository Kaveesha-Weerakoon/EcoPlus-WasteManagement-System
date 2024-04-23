<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Main_Workers">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <a
                        href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                        <div class="main-right-top-back-button">
                            <i class='bx bxs-chevrons-left'></i>
                        </div>
                    </a>
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search" id="searchInput">
                    </div>


                    <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>


                </div>

                <!-- <div class="main-top">
                    <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                        <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                    </a>

                    <div class="main-top-component">
                        <p>Admin</p>
                        <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                    </div>
                </div>
                
                <div class="main-bottom-top">
                    <div class="main-right-top-two">
                        <h1>Center Workers</h1>
                    </div>
                </div> -->

                <?php if(!empty($data['workers_in_center'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Center Workers</h1>
                    </div>
                    <div class="main-right-bottom-top ">
                        <table class="table">
                            <tr class="table-header">
                                <th>Name</th>
                                <th>NIC</th>
                                <th>Address</th>
                                <th>DOB</th>
                                <th>Contact No</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['workers_in_center'] as $worker) : ?>
                            <tr class="table-row">
                                <td><?php echo $worker->name?></td>
                                <td><?php echo $worker->nic?></td>
                                <td><?php echo $worker->address?></td>
                                <td><?php echo $worker->dob?></td>
                                <td><?php echo $worker->contact_no?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                        <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                        <h1>There are no center workers in the center</h1>
                        <p>All the center workers will appear here</p>
                    </div>
                </div>
                <?php endif; ?>


            </div>

        </div>
    </div>


</div>
<script>
function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');
    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var status = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
        var status1 = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
        var status2 = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
        var status3 = row.querySelector('td:nth-child(5)').innerText.toLowerCase();

        if (id.includes(input) || status.includes(input) || status1.includes(input) || status3.includes(
                input) || status2.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });

}

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>