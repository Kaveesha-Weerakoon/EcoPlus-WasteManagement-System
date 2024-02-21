<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_GarbageTypes">
        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" placeholder="Search">
                        </div>
                        <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>

                    </div>
                    <div class="main-right-top-two">
                        <h1>Garbage Types</h1>
                    </div>
                    <div class="main-right-top-three">
                        <h4>Meet minimum amounts(Per Kg) in a request to avoid fines</h4>
                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-container-container">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Type</th>
                                    <th>Minimum Quantity (in kg) We Are Collecting</th>
                                    <th>Credits per 1 Kilogram</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['garbage_types'] as $garbage_type) : ?>
                                <tr class="table-row">
                                    <td style="text-align: left;"><?php echo $garbage_type->name?></td>
                                    <td><?php echo $garbage_type->approximate_amount?></td>
                                    <td><?php echo $garbage_type->credits_per_waste_quantity?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
    /* Notification View */
    document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/customers/view_notification/garbage_types";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */
    </script>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>