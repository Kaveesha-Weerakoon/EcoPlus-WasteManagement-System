<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="Center_manager-centerworkers">
    <div class="main">
        <div class="main-top">
            <a href="<?php echo URLROOT?>/centermanagers">
                <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
            </a>
            <div class="main-top-component">
                <p><?php echo $_SESSION['center_manager_name']?></p>
                <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
            </div>
        </div>
        <div class="main-bottom">
            <div class="main-bottom-top">
                <div class="main-right-top-two">
                    <h1>Center Workers</h1>
                </div>
                <div class="main-right-top-three">
                    <a href="Collectors.html">
                        <div class="main-right-top-three-content">
                            <p><b style="color: #1B6652;">View</b></p>
                            <div class="line"></div>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/centermanagers/center_workers_add">
                        <div class="main-right-top-three-content">
                            <p>Add</p>
                            <div class="line1"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-bottom-down">
                <div class="main-right-bottom-top">
                    <table class="table">
                        <tr class="table-header">
                            <th>Name</th>
                            <th>NIC</th>
                            <th>Address</th>
                            <th>Contact No</th>
                            <th>DOB</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </table>
                </div>
                <div class="main-right-bottom-down">
                    <table class="table">
                    <?php foreach($data['center_workers'] as $center_worker) : ?>
                                       <tr class="table-row">
                                           <td> <?php echo $center_worker->name?></td>
                                           <td><?php echo $center_worker->nic?></td>
                                           <td><?php echo $center_worker->address?></td>
                                           <td> <?php echo $center_worker->contact_no?></td>
                                           <td> <?php echo $center_worker->dob?></td>
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                           <td class="cancel-open"><a href="<?php echo URLROOT?>/CenterManagers/center_workers_delete/<?php echo $center_worker->id ?>"><img src="<?php echo IMGROOT?>/delete.png" alt=""></a></td>
                                    </tr>
                     <?php endforeach; ?>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
