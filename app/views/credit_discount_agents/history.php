<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Agent_Main">
    <div class="Discount_Agent_History">
        <div class="main">
            <?php require APPROOT . '/views/credit_discount_agents/agent_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
                        <i class='bx bx-bell'></i>
                        <div class="dot"></div>
                    </div>

                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/img_upload/credit_discount_agent/<?php echo $_SESSION['agent_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['agent_name']?></h3>
                            <p>ID : D <?php echo $_SESSION['agent_id']?></p>
                        </div>
                    </div>
                </div>
                <div class="main-right-bottom">
                    <div class="main-bottom-top">
                        <h2>Discounts History</h2>
                        <div class="main-bottom-top-bottom">
                            <div class="date-cont">
                                <input type="date">
                                <p>From</p>
                            </div>
                            <div class="date-cont">
                                <input type="date">
                                <p>To</p>
                            </div>
                            <div class="button-cont">
                                <Button>
                                    Filter
                                </Button>
                            </div>
                            <h3>Credits Given Eco 123.1221</h3>
                        </div>
                    </div>
                    <div class="main-right-bottom-bottom">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Discount ID</th>
                                    <th>Date & Time </th>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Branch</th>
                                    <th>Amount</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['discounts'] as $discount) : ?>
                                <tr class="table-row">
                                    <td><?php echo $discount->discount_id?></td>
                                    <td><?php echo $discount->created_at?></td>
                                    <td><?php echo $discount->customer_name?></td>
                                    <td><?php echo $discount->customer_id?></td>
                                    <td><?php echo $discount->discount_amount?></td>
                                    <td><?php echo $discount->center?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?>