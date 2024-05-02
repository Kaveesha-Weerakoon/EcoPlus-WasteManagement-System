<?php require APPROOT . '/views/inc/header.php'; ?>



<div class="Customer_Main">
    <div class="Customer_History_Top">
        <div class="Customer_Complain_History">

            <div class="main">
                <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

                <div class="main-right">
                    <?php require APPROOT . '/views/customers/customer_historytop/customer_historytop.php'; ?>

                    <?php if(!empty($data['complains'])) : ?>
                    <div class="main-right-bottom">
                        <div class="main-right-bottom-container">
                            <div class="main-right-bottom-container-top">
                                <div class="circle"></div>
                                <h4>Complaints</h4>
                            </div>
                            <div class="main-right-bottom-container-container">
                                <div class="main-right-bottom-top">
                                    <table class="table">
                                        <tr class="table-header">
                                            <th>Complaint ID</th>
                                            <th>Date & Time</th>
                                            <th>Subject</th>
                                            <th>Complain</th>
                                            <th>Complain Title</th>
                                            <th>Complain Body</th>
                                            <th>Update</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="main-right-bottom-down">
                                    <table class="table">
                                        <?php foreach($data['complains'] as $post) : ?>
                                        <tr class="table-row">
                                            <td><?php echo $post->id?></td>
                                            <td><?php echo $post->date?></td>
                                            <td><?php echo $post->subject?></td>
                                            <td><?php echo $post->complaint?></td>
                                            <td><?php echo $post->complain_title?></td>
                                            <td><?php echo $post->complain_body?></td>

                                            <td> <a
                                                    href="<?php echo URLROOT?>/customers/update_compalin/<?php echo $post->id?>">
                                                    Update
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class=" main-right-bottom-two">
                        <div class="main-right-bottom-two-content">
                            <i class='bx bx-data' style="font-size: 150px"></i>
                            <h1>You Have No Active Complains</h1>
                            <p></p>

                        </div>
                    </div>
                    <?php endif; ?>


                </div>
                <?php if($data['update']=="True") :?>
                <div class="update_click">

                    <form class="popup-form"
                        action="<?php echo URLROOT;?>/customers/update_compalin/<?php echo $data['id']?>" method="post">
                        <div class=" content">
                            <h1>complaint</h1>
                            <input type="text" name="complaint" value="<?php echo $data['complaint']?>">
                        </div>
                        <div class="content">
                            <h1>complain_title</h1>
                            <input type="text" name="complain_title" value="<?php echo $data['complain_title']?>">
                        </div>
                        <div class="content">
                            <h1>complain_body</h1>
                            <input type="text" name="complain_body" value="<?php echo $data['complain_body']?>">
                        </div>
                        <button>Update</button>
                    </form>
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
        var dynamicUrl = " <?php echo URLROOT;?>/customers/view_notification/history_complains";
        form.action = dynamicUrl; // Set the action URL form.submit(); // Submit the form };
        /* ----------------- */
        function viewComplains(user) {
            var
                personalPop = document.getElementById('personal-details-popup-box');
            personalPop.classList.add('active');
            document.getElementById('overlay').style.display = "flex";
            document.getElementById('user_name').textContent = user.subject;
            document.getElementById('user_contactno').textContent = user.complaint;
            document.getElementById('user_region').textContent = user.complain_title;
            document.getElementById('subject').textContent = user.complain_body;
            document.getElementById('complain').textContent = user.complaint;
        }
        document.addEventListener('DOMContentLoaded', function() {
            var
                close_personal_details = document.getElementById('personal-details-popup-form-close');
            close_personal_details.addEventListener('click', function() {
                const
                    personal_details = document.getElementById("personal-details-popup-box");
                personal_details.classList.remove('active');
                document.getElementById('overlay').style.display = "none";
            });
        });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>