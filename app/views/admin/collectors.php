<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Collector">
<div class="main">
        <div class="main-top">
            <a href="<?php echo URLROOT ?>/admin/">
                <img class="back-button" src="<?php echo IMGROOT ?>/Back.png" alt="">
            </a>
            <div class="main-top-component">
                <p>Admin</p>
                <img src="<?php echo IMGROOT ?>/Requests Profile.png" alt="">
            </div>
        </div>
        <div class="main-bottom">
            <div class="main-bottom-top">
                <div class="main-right-top-two">
                    <h1>Collectors</h1>
                </div>
            </div>
            <div class="main-bottom-down">
                <div class="main-right-bottom-top">
                    <table class="table">
                        <tr class="table-header">
                            <th>Collector_Id</th>
                            <th>Center</th>
                            <th>Name</th>
                            <th>NIC</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Address</th>                      
                            <th>Vehicle Details</th>
                            <th>Delete</th>
                        </tr>
                    </table>
                </div>
                <div class="main-right-bottom-down">
                <table class="table">
                             <?php foreach($data['collectors'] as $collector) : ?>
                                       <tr class="table-row">
                                           <td>C <?php echo $collector->user_id?></td>
                                           <td><?php echo $collector->center_name?></td>
                                           <td><?php echo $collector->name?></td>
                                           <td> <?php echo $collector->nic?></td>
                                           <td> <?php echo $collector->email?></td>
                                           <td> <?php echo $collector->contact_no?></td>
                                           <td> <?php echo $collector->address?></td>
                                           <td><img class="location" src="<?php echo IMGROOT?>/car.png" alt=""></td>
                                           <td><img class="location" src="<?php echo IMGROOT?>/delete.png" alt=""></td>
                             <?php endforeach; ?>
                     </table>
                   
                  
                </div>
            </div>
        </div>
    </div>



</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>