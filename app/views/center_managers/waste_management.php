<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Waste_Management">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
                        </div>
                        <div class="main-right-top-notification" id="notification">
                            <i class='bx bx-bell'></i>
                            <div class="dot"></div>
                        </div>
                        <div id="notification_popup" class="notification_popup">
                            <h1>Notifications</h1>
                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                Request 1232 Has been Cancelled
                            </div>
                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                Request 1232 Has been Assigned
                            </div>
                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                Request 1232 Has been Cancelled
                            </div>
                        </div>
                        <div class="main-right-top-profile">
                            <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>"
                                alt="">
                            <div class="main-right-top-profile-cont">
                                <h3><?php echo $_SESSION['center_manager_name']?></h3>
                                <p>ID : Col <?php echo $_SESSION['center_manager_id']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Center Waste Management</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/centermanagers/waste_management">
                            <div class="main-right-top-three-content">
                                <p><b style="color:#1ca557;">Waste Handover</b></p>
                                <div class="line" style="background-color: #1ca557;"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_garbage_stock">
                            <div class="main-right-top-three-content">
                                <p>Garbage Stock</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers_add">
                            <div class="main-right-top-three-content">
                                <p>Stock Relaeses</p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
                </div>

                
                <?php if(!empty($data['confirmed_requests'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Req id</th>
                                <th>Collector id</th>
                                <th>Plastic</th>
                                <th>Polythene</th>
                                <th>Metals</th>
                                <th>Glass</th>
                                <th>Paper waste</th>
                                <th>Electronic waste</th>
                                <th>Center Manager Note</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['confirmed_requests'] as $request) : ?>
                            <tr class="table-row">
                                <td> <?php echo $request->req_id?></td>
                                <td><?php echo $request->collector_id?></td>
                                <td><?php echo $request->plastic?></td>
                                <td> <?php echo $request->polythene?></td>
                                <td> <?php echo $request->metals?></td>
                                <td> <?php echo $request->glass?></td>
                                <td> <?php echo $request->paper_waste?></td>
                                <td> <?php echo $request->electronic_waste?></td>
                                <td> <?php echo $request->note?></td>
                                
                            </tr>
                            <?php endforeach; ?>

                        </table>
                    </div>
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                        <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                        <h1>There are no confirmed requests</h1>
                        <p>All the requests confirmed bu the center manager will appear here</p>
                        

                    </div>
                </div>
                <?php endif; ?>

                
        
            </div>
        </div>

    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>