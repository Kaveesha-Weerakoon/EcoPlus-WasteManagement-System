<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Collector_Complains">
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
                        <h1>Collectors</h1>
                    </div>
                    <div class="main-right-top-three">
                       <a href="<?php echo URLROOT?>/centermanagers/collectors">
                            <div class="main-right-top-three-content">
                                <p>View</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/collectors_add">
                            <div class="main-right-top-three-content">
                                <p>Register</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Complaints</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php if(!empty($data['collectors_complains'])) : ?>
                <div class="main-bottom-down">
                    <div class="main-right-bottom-container">
                       
                        <div class="main-right-bottom-container-container">
                            <div class="main-right-bottom-top">
                                <table class="table">
                                    <tr class="table-header">
                                        <th>Complaint ID</th>
                                        <th>Collector ID</th>
                                        <th>Date & Time</th>
                                        <th>Subject</th>
                                        <th>Complain</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">
                                <table class="table">
                                
                                   <?php foreach($data['collectors_complains'] as $post) : ?>
                                       <tr class="table-row">
                                           <td>CoC <?php echo $post->id?></td>
                                           <td>Co <?php echo $post->collector_id?></td>
                                           <td><?php echo $post->date?></td>                                     
                                           <td><?php echo $post->subject?></td>
                                           <td><?php echo $post->complaint?></td>                                   
                                        </tr>
                                  <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                            <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                            <h1>There are no complaints yet</h1>
                            <p>Hope you will continue customer satisfaction</p>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>