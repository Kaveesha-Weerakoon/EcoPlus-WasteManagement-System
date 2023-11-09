<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Customer">
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
                    <h1>Customers</h1>
                </div>
            </div>
            <div class="main-bottom-down">
                <div class="main-right-bottom-top">
                    <table class="table">
                        <tr class="table-header">
                            <th>Customer ID</th>
                            <th>Name</th>
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
                                           <td><?php echo $post->email?></td>
                                           <td> <?php echo $post->mobile_number?></td>
                                           <td> <?php echo $post->address?></td>
                                           <td> <?php echo $post->city?></td>
                                           <td> 0</td>
                                           <td><img class="location" src="<?php echo IMGROOT?>/View.png" alt=""></td>
                                           <td><img class="location" src="<?php echo IMGROOT?>/delete.png" alt=""></td>
                             <?php endforeach; ?>
                     </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
