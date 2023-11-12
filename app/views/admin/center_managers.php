<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Center_Manager">
    <div class="Admin_Center_Manger_View">
       <div class="main">
            <div class="main-top">
                <a href="<?php echo URLROOT?>/admin">
                    <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                </a>

                <div class="main-top-component">
                    <p>Admin</p>
                    <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                </div>
            </div>
            <div class="main-bottom">
                <div class="main-bottom-top">
                    <div class="main-right-top-two">
                        <h1>Center Managers</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">View</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/admin/center_managers_add">
                            <div class="main-right-top-three-content">
                                <p>Add</p>
                                <div class="line1"></div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="main-bottom-down">
                    <div class="main-right-bottom-top ">
                        <table class="table">
                            <tr class="table-header">
                                <th>Center Manager ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Assigned</th>
                                <th>Assigned Center</th>
                                <th>Personal Details</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                             <?php foreach($data['center_managers'] as $center_manager) : ?>
                                       <tr class="table-row">
                                           <td>CM <?php echo $center_manager->user_id?></td>
                                           <td><?php echo $center_manager->name?></td>
                                           <td><?php echo $center_manager->email?></td>
                                           <td> <?php echo $center_manager->assinged?></td>
                                           <td> <?php echo $center_manager->assigned_center_id?></td>
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/view.png" alt=""></td>
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                           <td class="cancel-open"><a href="<?php echo URLROOT?>/admin/center_managers_delete_confirm/<?php echo $center_manager->user_id?>"><img src="<?php echo IMGROOT?>/delete.png" alt=""></a></td>
                                   </tr>
                             <?php endforeach; ?>
                           </table>
                
 
                    </div>
                </div>
            </div>
        </div>
       </div> 
       <?php if($data['confirm_delete']=='True') : ?>
       <div class="delete_confirm">
              <div class="popup" id="popup">
                 <img src="<?php echo IMGROOT?>/trash.png" alt="">
                 <?php
                    if ($data['assigned']=='No') {
                       echo "<h2>Delete this collector assistant?</h2>";
                       echo "<p>This action will permanently delete this center manager</p>";
                    }
                    else{
                       echo "<h2>This Action is prohibited</h2>";
                       echo "<p>Center Manager is assisgned to a center</p>";
                    }
                 ?>
                 <div class="btns">
                    <?php
                        if ($data['assigned']=='No') {
                            echo '<a href="' . URLROOT . '/Admin/center_managers_delete/' . $data['center_manager_id'] . '"><button type="button" class="deletebtn">Delete</button></a>';
                        }
                    ?>                     
                    <a href="<?php echo URLROOT?>/Admin/center_managers"><button type="button" class="cancelbtn" >Cancel</button></a>
                  </div>
               </div>
       </div>
       <?php endif; ?>
       <?php if($data['success']=='True') : ?>
           <div class="center_manager_success">
                 <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Center Manager has been deleted successfully</p>
                    <a href="<?php echo URLROOT?>/admin/center_managers"><button type="button" >OK</button></a>
                </div>
           </div>
        d<?php endif; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
