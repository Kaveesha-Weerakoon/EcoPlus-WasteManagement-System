<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Center_Top">
    <div class="Admin_Center_View">
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
                        <h1>Centers</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="Collectors.html">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">View</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/admin/center_add">
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
                                <th>Center ID</th>
                                <th>Region</th>
                                <th>Address</th>
                                <th>Center Manger ID</th>
                                <th>Center Manager Name</th>
                                <th>View Details</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <tr class="table-row">
                                <td>CE 1212</td>
                                <td>Nugegoda</td>
                                <td>Colombo</td>
                                <td>CM 1212</td>
                                <td>Samantha</td>
                                <td><img src="<?php echo IMGROOT?>/View.png" alt=""></td>
                                <td><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                <td class="delete"> <img src="<?php echo IMGROOT?>/delete.png" alt=""></td>

                            </tr>
                            <tr class="table-row">
                                <td>CE 1212</td>
                                <td>Nugegoda</td>
                                <td>Colombo</td>
                                <td>CM 1212</td>
                                <td>Samantha</td>
                                <td><img src="<?php echo IMGROOT?>/View.png" alt=""></td>
                                <td><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                <td class="delete"> <img src="<?php echo IMGROOT?>/delete.png" alt=""></td>

                            </tr>
                            <tr class="table-row">
                                <td>CE 1212</td>
                                <td>Nugegoda</td>
                                <td>Colombo</td>
                                <td>CM 1212</td>
                                <td>Samantha</td>
                                <td><img src="<?php echo IMGROOT?>/View.png" alt=""></td>
                                <td><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                <td class="delete"> <img src="<?php echo IMGROOT?>/delete.png" alt=""></td>

                            </tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
