<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Customer">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
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
                            <h1>Customers</h1>
                        </div>
                    </div>
                    <div class="main-bottom-down">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Pro Pic</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Total Credits</th>
                                    <th>Discount Details</th>
                                    <th>Delete</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                        
                            <table class="table">
                                    <?php foreach($data['customers'] as $post) : ?>
                                            <tr class="table-row">
                                                <td>C <?php echo $post->user_id?></td>
                                                <td><?php echo $post->name?></td>
                                                <td><img class="propic" src="<?php echo IMGROOT ?>/img_upload/customer/<?php echo ($post->image == '') ? 'Profile.png' : $post->image; ?>" alt=""></td>
                                                <td><?php echo $post->email?></td>
                                                <td> <?php echo $post->mobile_number?></td>
                                                <td> <?php echo $post->address?></td>
                                                <td> <?php echo $post->city?></td>
                                                <td> 0</td>
                                                <td><img class="location" src="<?php echo IMGROOT?>/View.png" alt=""></td>
                                                <td><a href="<?php echo URLROOT?>/Admin/customerdelete_confirm/<?php echo $post->user_id?>"><img class="location" src="<?php echo IMGROOT?>/delete.png" alt=""></a></td>
                                    <?php endforeach; ?>
                            </table>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($data['delete_confirm']=='True') : ?>
        <div class="delete_confirm">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/trash.png" alt="">
                    <?php
                        echo "<h2>Delete this Collector?</h2>";
                        echo "<p>This action will permanently delete this center manager</p>";          
                    ?>
                    <div class="btns">
                        
                        <a href="<?php echo URLROOT?>/Admin/customerdelete/<?php echo $data['id']?>"><button type="button" class="deletebtn">Delete</button></a>
                                        
                        <a href="<?php echo URLROOT?>/Admin/customers"><button type="button" class="cancelbtn" >Cancel</button></a>
                    </div>
                </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
