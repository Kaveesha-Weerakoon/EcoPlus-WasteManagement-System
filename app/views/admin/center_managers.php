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
                                <p>Register</p>
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
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Assigned</th>
                                <th>Assigned Center ID</th>
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
                                           <td class="cm-profile-img"><img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $center_manager->image?>" alt=""></td>
                                           <td><?php echo $center_manager->name?></td>
                                           <td><?php echo $center_manager->email?></td>
                                           <td> <?php echo $center_manager->assinged?></td>
                                           <td> <?php echo $center_manager->assigned_center_id?></td>
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/view.png" alt=""></td>
                                           <td class="cancel-open"><a href="<?php echo URLROOT?>/admin/center_managers_update/<?php echo $center_manager->user_id ?>"><img src="<?php echo IMGROOT?>/update.png" alt=""></a></td>
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

        <?php if($data['click_update']=='True') : ?>
                <div class="update_click">
                    <div class="popup-form" id="popup">
                        <a href="<?php echo URLROOT?>/admin/center_managers"><img src="<?php echo IMGROOT?>/close_popup.png"  class="update-popup-img" alt=""></a>
                        <h2>Update Details</h2>
                        <center><div class="update-topic-line"></div></center>
                        <form class="updatePopupform" method="post" action="<?php echo URLROOT;?>/admin/center_managers_update/<?php echo $data['id'];?>" >
                            <div class="updateData A">
                                <label>Name</label><br>
                                <input type="text" name="name" placeholder="Enter name" value="<?php echo $data['name']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['name_err']?>
                                </div>
                            </div>
                            <div class="updateData">
                                <label>NIC</label><br>
                                <input type="text" name="nic" placeholder="Enter NIC" value="<?php echo $data['nic']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['nic_err']?>
                                </div>
                            </div>
                            <div class="updateData">
                                <label>Address</label><br>
                                <input type="text" name="address" placeholder="Enter Address" value="<?php echo $data['address']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['address_err']?>
                                </div>
                            </div>
                            <div class="updateData">
                                <label>Contact No</label><br>
                                <input type="text" name="contact_no" placeholder="Enter Contact No" value="<?php echo $data['contact_no']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['contact_no_err']?>
                                </div>
                            </div>
                            <div class="updateData B">
                                <label>DOB</label><br>
                                <input type="date" name="dob" placeholder="Enter DOB" value="<?php echo $data['dob']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['dob_err']?>
                                </div>
                            </div>

                            <div class="btns1">
                            <button type="submit" class="updatebtn" >Update</button>
                            <a href="<?php echo URLROOT?>/admin/center_managers"><button type="button" class="cancelbtn1" >Cancel</button></a>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>

            <?php endif; ?> 

            <?php if($data['update_success']=='True') : ?>
            <div class="center_manager_update_success">
                <div class="popup1" id="popup1">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Center Manager details updated successfully</p>
                    <a href="<?php echo URLROOT?>/admin/center_managers"><button type="button" >OK</button></a>

                </div>
            </div>
            <?php endif; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
