<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Stock_Releases">
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
                                <p>Waste Handover</p>
                                <div class="line"></div>
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
                                <p><b style="color:#1ca557;">Stock Releases</b></p>
                                <div class="line"  style="background-color: #1ca557;"></div>
                            </div>
                        </a>

                    </div>
                </div>

                
                <?php if(!empty($data['release_details'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Date & Time</th>
                                <th>Released Person</th>
                                <th>Release Note</th>
                                <th>Income</th>
                                <th>Release Details</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['release_details'] as $release) : ?>
                            <tr class="table-row">
                                <td> <?php echo $release->released_date_time?></td>
                                <td><?php echo $release->released_person?></td>
                                <td> <?php echo $release->release_note?></td>
                                <td> <?php echo $release->income?></td>
                                <td class="cancel-open">
                                    <img onclick="view_release_details(<?php echo htmlspecialchars(json_encode($release), ENT_QUOTES, 'UTF-8') ?>)"
                                            src="<?php echo IMGROOT?>/info.png" alt="">
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
                        <h1>There are no released stocks yet</h1>
                        <p>Stocks that released by the center manager will appear here</p>
                        
                    </div>
                </div>
                <?php endif; ?>   
        
            </div>

            <div class="release_garbage_details_popup" id="release_garbage_details_popup">
                <img src="<?php echo IMGROOT?>/close_popup.png" alt="" id="close_release_garbage_details_popup">
                <h1>Released Garbage Details</h1>
                <div class="Eco_Credit_Per_Cont">
                    <div class="Cont">
                        <h3>Plastic</h3>
                        <i class="icon fas fa-box"></i>
                        <p id="plastic"></p>
                    </div>
                    <div class="Cont">
                        <h3>Polythene</h3>
                        <i class="icon fas fa-trash"></i>
                        <p id="polythene"></p>
                    </div>
                    <div class="Cont">
                        <h3>Metal</h3>
                        <i class="icon fas fa-box"></i>
                        <p id="metals"></p>
                    </div>
                    <div class="Cont">
                        <h3> Glass</h3>
                        <i class="icon fas fa-glass-whiskey"></i>
                        <p id="glass"></p>
                    </div>

                    <div class="Cont">
                        <h3>Paper</h3>
                        <i class="icon fas fa-file-alt"></i>
                        <p id="paper_waste"></p>
                    </div>
                    <div class="Cont">
                        <h3>Electronic</h3>
                        <i class="icon fas fa-laptop"></i>
                        <p id="electronic_waste"></p>
                    </div>
                </div>
                <h2>* Weights are in kilograms</h2>

            </div>
            
            <div class="overlay" id="overlay">
        </div>

      
    </div>
</div>

<script>

    function view_release_details(release) {
        var releasePop = document.getElementById('release_garbage_details_popup');
        releasePop.classList.add('active');
        document.getElementById('overlay').style.display = "flex";

        document.getElementById('polythene').innerText = release.polythene;
        document.getElementById('plastic').innerText = release.plastic;
        document.getElementById('glass').innerText = release.glass;
        document.getElementById('paper_waste').innerText = release.paper_waste;
        document.getElementById('electronic_waste').innerText = release.electronic_waste;
        document.getElementById('metals').innerText = release.metals;
       
    }

    document.addEventListener("DOMContentLoaded", function() {
   
    const close_release = document.getElementById("close_release_garbage_details_popup")

    close_release.addEventListener("click", function() {
        var releasePop = document.getElementById('release_garbage_details_popup');
        releasePop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";

    });

    });

     /* Notification View */
     document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/stock_release_details";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */



</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>