<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_GarbageTypes">
        <div class="main">
            <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        
                        <?php require APPROOT . '/views/collectors/collector_notification/collector_notification.php'; ?>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Garbage Types</h1>
                    </div>
                    
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-container-container">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Type</th>
                                    <th>Approximate Value Shown to the User</th>
                                    <th>Minimum Quantity We Are Collecting</th>
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
                                    <td><?php echo $garbage_type->minimum_amount?></td>

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

</div>

<script>
                    /* Notification View */
                document.getElementById('submit-notification').onclick = function() {
                    var form = document.getElementById('mark_as_read');
                    var dynamicUrl = "<?php echo URLROOT;?>/collectors/view_notification/garbage_types";
                    form.action = dynamicUrl; // Set the action URL
                    form.submit(); // Submit the form

                };
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>