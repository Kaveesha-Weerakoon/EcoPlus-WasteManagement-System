<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Discount_Agent">
        <div class="Customer_Discount_Agent_View">
            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>
                            <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>
                        </div>

                        <div class="main-right-top-two">
                            <h1>Credit Discount Agent</h1>
                        </div>

                        <div class="main-right-top-three">
                            <div class="main-right-top-three-content">
                                <p style="color:#000000;">Redeem your Eco credits through the listed agents.</p>
                            </div>
                        </div>

                    </div>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Agent ID</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact_No</th>
                                    <th>Address</th>
                                </tr>
                            </table>
                        </div>

                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['discount_agents'] as $discount_agent) : ?>
                                <tr class="table-row">
                                    <td>CM <?php echo $discount_agent->user_id?></td>
                                    <td><img src="<?php echo IMGROOT?>/img_upload/credit_discount_agent/<?php echo $discount_agent->image?>"
                                            alt="" class="manager_img"></td>
                                    <td><?php echo $discount_agent->name?></td>
                                    <td><?php echo $discount_agent->email?></td>
                                    <td><?php echo $discount_agent->contact_no?></td>
                                    <td><?php echo $discount_agent->address?></td>

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
        var dynamicUrl = "<?php echo URLROOT;?>/customers/view_notification/discount_agents";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */
    </script>





</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>