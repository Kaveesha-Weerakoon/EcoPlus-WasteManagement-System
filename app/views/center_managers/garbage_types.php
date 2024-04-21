<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Garbage_Types">
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
                                <p><b style="color:#1ca557;">Garbage Types</b></p>
                                <div class="line" style="background-color: #1ca557;"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/waste_management">
                            <div class="main-right-top-three-content">
                                <p>Waste Handover</p>
                                <div class="line" ></div>
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

                
                <?php if(!empty($data['garbage_types'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Garbage ID</th>
                                <th>Garbage Type</th>
                                <th>Credits per waste quantity</th>
                                <th>Approximate Amount</th>
                                <th>Minimum Amount</th>
                                <th>Selling Price</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['garbage_types'] as $type) : ?>
                            <tr class="table-row">
                                <td>G<?php echo $type->ID?></td>
                                <td><?php echo $type->name?></td>
                                <td><?php echo $type->credits_per_waste_quantity?></td>
                                <td><?php echo $type->approximate_amount?></td>
                                <td><?php echo $type->minimum_amount?></td>
                                <td><?php echo $type->selling_price?></td>
                            </tr>
                            <?php endforeach; ?>

                        </table>
                    </div>
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                        <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                        <h1>There are no garbage types at the moment</h1>
                        <p>All the garbage types will be appear here</p>
                        

                    </div>
                </div>
                <?php endif; ?>

                
        
            </div>

        </div>

    </div>
</div>
<script>
    /* Notification View */
    document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/garbage_types";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>