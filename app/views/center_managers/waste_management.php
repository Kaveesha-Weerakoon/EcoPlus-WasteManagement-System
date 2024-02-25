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
                        <?php require APPROOT . '/views/center_managers/centermanager_notifications/centermanager_notifications.php'; ?>
                        <!-- <div class="main-right-top-notification" id="notification">
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
                        </div> -->
                    </div>
                    <div class="main-right-top-two">
                        <h1>Center Waste Management</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/centermanagers/garbage_types">
                            <div class="main-right-top-three-content">
                                <p>Garbage Types</p>
                                <div class="line"></div>
                            </div>
                        </a>
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
                        <a href="<?php echo URLROOT?>/centermanagers/stock_release_details">
                            <div class="main-right-top-three-content">
                                <p>Stock Releases</p>
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
                                <th>Center Manager Note</th>
                                <th>Collection details</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['confirmed_requests'] as $request) : ?>
                            <tr class="table-row">
                                <td> <?php echo $request->req_id?></td>
                                <td><?php echo $request->collector_id?></td>
                                <td> <?php echo $request->note?></td>
                                <td>
                                <i class='bx bx-info-circle' style="font-size: 29px"
                                    onclick="view_collect_details(<?php echo htmlspecialchars(json_encode($request), ENT_QUOTES, 'UTF-8') ?>)"
                                    ></i>
                                </td>
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

            <div class="overlay" id="overlay"></div>

            <div class="collect-details-pop" id="collect-details-popup-box">
                <div class="collect-details-pop-form">
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="collect-details-pop-form-close"
                        id="collect-details-pop-form-close">
                    <div class="collect-details-pop-form-top">
                        <div class="collect-details-topic">Collection Details<div id="req_id3"></div>
                        </div>
                    </div>

                    <div class="collect-details-pop-form-content">
                        <div class="collect-details-pop-form-content-labels">
                            <h3>Polythene Quantity</h3>
                            <h3>Plastic Quantity</h3>
                            <h3>Glass Quantity </h3>
                            <h3>Paper Waste Quantity</h3>
                            <h3>Electronic Waste Quantity </h3>
                            <h3>Metals Quantity</h3>
                           
                        </div>
                        <div class="collect-details-pop-form-content-right-values">
                            <div class="collect-details-pop-form-content-right-values-cont">
                                <h3 id="Polythene_Quantity"></h3>
                                <h3>&nbsp Kg</h3>
                            </div>
                            <div class="collect-details-pop-form-content-right-values-cont">
                                <h3 id="Plastic_Quantity"></h3>
                                <h3>&nbsp Kg</h3>
                            </div>
                            <div class="collect-details-pop-form-content-right-values-cont">
                                <h3 id="Glass_Quantity"></h3>
                                <h3>&nbsp Kg</h3>
                            </div>
                            <div class="collect-details-pop-form-content-right-values-cont">
                                <h3 id="Paper_Waste_Quantity"></h3>
                                <h3>&nbsp Kg</h3>
                            </div>
                            <div class="collect-details-pop-form-content-right-values-cont">
                                <h3 id="Electronic_Waste_Quantity"></h3>
                                <h3>&nbsp Kg</h3>
                            </div>
                            <div class="collect-details-pop-form-content-right-values-cont">
                                <h3 id="Metals_Quantity"></h3>
                                <h3>&nbsp Kg</h3>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
function view_collect_details(request) {
    var locationPop = document.getElementById('collect-details-popup-box');
    locationPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    document.getElementById('Polythene_Quantity').innerText = request.polythene;
    document.getElementById('Plastic_Quantity').innerText = request.plastic;
    document.getElementById('Glass_Quantity').innerText = request.glass;
    document.getElementById('Paper_Waste_Quantity').innerText = request.paper_waste;
    document.getElementById('Electronic_Waste_Quantity').innerText = request.electronic_waste;
    document.getElementById('Metals_Quantity').innerText = request.metals;
    
}

document.addEventListener("DOMContentLoaded", function() {
    
    const collector_view = document.getElementById("personal-details-popup-box");
    const close_view = document.getElementById("collect-details-pop-form-close");
    
    close_view.addEventListener("click", function() {
        var locationPop = document.getElementById('collect-details-popup-box');
        locationPop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";

    });

});

 /* Notification View */
 document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/waste_management";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */

</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>