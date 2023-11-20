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
                                           <td><a href="<?php echo URLROOT?>/admin/vehicle_details_view/<?php echo $collector->user_id ?>"><img class="location" src="<?php echo IMGROOT?>/car.png" alt=""></a></td>
                                           <td><img class="location" src="<?php echo IMGROOT?>/delete.png" alt=""></td>
                             <?php endforeach; ?>
                </table>
                   
                  
                </div>
            </div>
        </div>
    </div>
    <?php if($data['vehicle_details_click']=='True') : ?>
        <div class="vehicle-details-popup-box">
            <div class="vehicle-details-popup-form" id="popup">
                <a href="<?php echo URLROOT?>/admin/collectors"><img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="vehicle-details-popup-form-close"></a>
                <center><div class="vehicle-details-topic">Vehicle Details</div></center>
                
                <div class="vehicle-details-popup" >
                    <div class="vehicle-details-labels">
                        <span>Collector ID</span><br>
                        <span>Name</span><br>
                        <span>Vehicle Plate No</span><br>
                        <span>Vehicle Type</span><br>
                    </div>
                    <div class="vehicle-details-values">
                        <span>C<?php echo $data['id']?></span><br>
                        <span><?php echo $data['name']?></span><br>
                        <span><?php echo $data['vehicle_no']?></span><br>
                        <span><?php echo $data['vehicle_type']?></span><br>
                    </div>
                </div>
            </div>
        </div>
    
    <?php endif; ?>


</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>