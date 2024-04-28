<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Discount_Agent">
        <div class="Admin_Discount_Agent_View">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>
                            <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>
                        </div>
                        <div class="main-right-top-two">
                            <h1>Credit Discount Agent</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/admin/discount_agents">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">View</b></p>
                                    <div class="line" style="background-color: #1ca557;"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/admin/discount_agent_add">
                                <div class="main-right-top-three-content">
                                    <p>Register</p>
                                    <div class="line"></div>
                                </div>
                            </a>
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
                                    <th>Action</th>
                                </tr>
                            </table>
                        </div>

                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['discount_agents'] as $discount_agent) : ?>
                                <tr class="table-row">
                                    <td>CM <?php echo $discount_agent->user_id?></td>
                                    <td onclick="locate('<?php echo $discount_agent->user_id?>')"><img
                                            src="<?php echo IMGROOT?>/img_upload/credit_discount_agent/<?php echo $discount_agent->image?>"
                                            alt="" class="manager_img"></td>
                                    <td><?php echo $discount_agent->name?></td>
                                    <td><?php echo $discount_agent->email?></td>
                                    <td>
                                        <?php if ($discount_agent->disable) : ?>
                                        <i class="fa-solid fa-unlock" style="font-size: 20px;"
                                            onclick="un_block_user('<?php echo $discount_agent->user_id; ?>')"></i>
                                        <?php else : ?>
                                        <i class="fa-solid fa-user-lock" style="font-size: 20px;"
                                            onclick="block_user('<?php echo $discount_agent->user_id; ?>')"></i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="delete_confirm2" id="cancel_confirm">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                <h2>Block the User?</h2>
                <p>This action will Block the user </p>
                <div class="btns">
                    <a id="cancelLink"><button type="button" class="deletebtn">Block</button></a>
                    <a id="close_cancel"><button type="button" class="cancelbtn">Cancel</button></a>
                </div>
            </div>
        </div>
        <div class="delete_confirm2" id="cancel_confirm2">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                <h2>Unblock the User?</h2>
                <p>This action will Unblock the user </p>
                <div class="btns">
                    <a id="unblockLink"><button type="button" class="deletebtn">Unblock</button></a>
                    <a id="close_unblock"><button type="button" class="cancelbtn">Cancel</button></a>
                </div>
            </div>
        </div>
        <div class="overlay" id="overlay">

        </div>
        >
    </div>
    <script>
    console.log('hello');

    function locate(url) {
        console.log(url)
        window.location.href = "<?php echo URLROOT?>/admin/discount_agent_view/" + url;
    }



    function searchTable() {
        var input = document.getElementById('searchInput').value.toLowerCase();
        var rows = document.querySelectorAll('.table-row');
        rows.forEach(function(row) {
            var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
            var status = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
            var status1 = row.querySelector('td:nth-child(4)').innerText.toLowerCase();

            if (id.includes(input) || status.includes(input) || status1.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });

    }

    document.getElementById('searchInput').addEventListener('input', searchTable);

    function block_user(id) {
        var userId = id;
        var newURL = "<?php echo URLROOT?>/admin/discount_agent_block/" + userId;
        document.getElementById('cancelLink').href = newURL;
        document.getElementById('overlay').style.display = "flex";
        document.getElementById('cancel_confirm').classList.add('active');
    }

    function un_block_user(id) {

        var userId = id;
        var newURL = "<?php echo URLROOT?>/admin/discount_agent_unblockuser/" + userId;
        document.getElementById('unblockLink').href = newURL;
        document.getElementById('overlay').style.display = "flex";
        document.getElementById('cancel_confirm2').classList.add('active');
    }

    document.addEventListener("DOMContentLoaded", function() {

        const close_cancel = document.getElementById("close_cancel");
        const close_unblock = document.getElementById("close_unblock");

        close_cancel.addEventListener("click", function() {
            document.getElementById('cancel_confirm').classList.remove('active');
            document.getElementById('overlay').style.display = "none";
        });


        close_unblock.addEventListener("click", function() {
            document.getElementById('cancel_confirm2').classList.remove('active');
            document.getElementById('overlay').style.display = "none";
        });

    });
    </script>
    <?php require APPROOT . '/views/inc/footer.php'; ?>