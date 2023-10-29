<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin-Center-Manager">
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
                            <tr class="table-row">
                                <td>Samantha</t<?php echo IMGROOT?>d>
                                <td>1212121212</td>
                                <td>Colombo</td>
                                <td>Yes</td>
                                <td>Kottawa</td>
                                <td><img src="/View.png" alt=""></td>
                                <td><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                <td class="delete"> <img src="<?php echo IMGROOT?>/delete.png" alt=""></td>

                            </tr>
                            <tr class="table-row">
                                <td>Samantha</td>
                                <td>1212121212</td>
                                <td>Colombo</td>
                                <td>No</td>
                                <td>None</td>
                                <td><img src="<?php echo IMGROOT?>/View.png" alt=""></td>
                                <td><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                <td class="delete"> <img src="<?php echo IMGROOT?>/delete.png" alt=""></td>

                            </tr>
                            <tr class="table-row">
                                <td>Samantha</td>
                                <td>1212121212</td>
                                <td>1212121212</td>
                                <td>Yes</td>
                                <td>Nugegoda</td>
                                <td><img src="<?php echo IMGROOT?>/View.png" alt=""></td>
                                <td><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                <td class="delete"> <img src="<?php echo IMGROOT?>/delete.png" alt=""></td>

                            </tr>

                    </div>
                </div>
            </div>
        </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
