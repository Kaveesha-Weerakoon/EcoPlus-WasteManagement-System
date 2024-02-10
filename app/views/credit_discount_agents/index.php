<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Agent_Main">
    <div class="Agent_Dashboard">


        <div class="main">
            <?php require APPROOT . '/views/credit_discount_agents/agent_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search" style="visibility: hidden;">
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
                    <div class="main-right-bottom-top">
                        <div class="left">
                            <div class="left-cont">
                                <h2>Customers</h2>
                                <h1>123</h1>
                            </div>
                            <div class="right-cont">
                                <i class="fa-solid fa-people-group"></i>
                            </div>
                        </div>
                        <div class="right">
                            <div class="left-cont">
                                <h2>Total Discounts</h2>
                                <h1>123</h1>
                            </div>
                            <div class="right-cont">
                                <i class="fa-solid fa-chart-simple"></i>
                            </div>
                        </div>
                    </div>
                    <div class="main-right-bottom-bottom">
                        <div class="left">
                            <div class="left"></div>
                            <div class="right">
                                <h1>Complaints</h1>
                                <i class='bx bx-message-error'></i>
                                <!-- <p>If there's any issue regarding center, make a complaint from here</p> -->
                                <p>If you encounter any issues, submit a complaint here</p>
                                <button type="button" onclick="redirect_complaints()">Complaint</button>
                                <span onclick="redirect_complaints_history()">View History >></span>
                            </div>
                        </div>
                        <div class="right">
                            <div class="top">
                                <h2>Recent Discounts</h2>
                            </div>
                            <div class="down">
                                <div class="downtop">
                                    <table class="table">
                                        <tr class="table-header">
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Discount</th>
                                            <th>Branch</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="down-down">
                                    <table class="table">
                                        <?php $count = 0; ?>
                                        <?php foreach($data['discounts'] as $discounts) : ?>
                                        <?php if ($count >= 5) break; ?>
                                        <tr class="table-row">
                                            <td><?php echo (new DateTime($discounts->created_at))->format('Y-m-d')?>
                                            </td>
                                            <td><?php echo (new DateTime($discounts->created_at))->format('H:i:s')?>
                                            </td>
                                            <td><?php echo $discounts->discount_amount?></td>
                                            <td><?php echo $discounts->center?></td>
                                        </tr>
                                        <?php $count++; ?>
                                        <?php endforeach; ?>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>