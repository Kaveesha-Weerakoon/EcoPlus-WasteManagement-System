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
                        <a href="Collectors.html">
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
                             <?php foreach($data['center_managers'] as $post) : ?>
                                       <tr class="table-row">
                                           <td>CM <?php echo $post->user_id?></td>
                                           <td><?php echo $post->name?></td>
                                           <td><?php echo $post->email?></td>
                                           <td> <?php echo $post->assinged?></td>
                                           <td> <?php echo $post->assined_center_id?></td>
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/view.png" alt=""></td>
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/delete.png" alt=""></td>
                                    </tr>
                             <?php endforeach; ?>
                           </table>
                
 
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
