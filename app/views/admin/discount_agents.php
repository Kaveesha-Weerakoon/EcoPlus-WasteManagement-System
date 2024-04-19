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
                                    <th>Delete</th>
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
                                    <td onclick=" opendelete(<?php echo $discount_agent->user_id?>)"
                                        class="cancel-open"><img src="<?php echo IMGROOT?>/delete.png" alt=""></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay" id="overlay">

        </div>
        <div class="delete_confirm" id="delete_confirm">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/trash.png" alt="">
                <?php
                                echo "<h2>Delete this Credit Discount Agent?</h2>";
                                echo "<p>This action will permanently delete this Discount Agent</p>";
                               
                            ?>
                <div class="btns">
                    <button type="button" class="deletebtn" id="deletebtn">Delete</button>
                    <button type="button" class="cancelbtn" id="delete-close">Cancel</button>
                </div>
            </div>
        </div>
        <?php if($data['success']=='True') : ?>
        <div class="center_manager_success">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/check.png" alt="">
                <h2>Success!!</h2>
                <p>Discount Agents has been deleted successfully</p>
                <a href="<?php echo URLROOT?>/admin/discount_agents"><button type="button">OK</button></a>
            </div>
        </div>
        <?php endif; ?>






    </div>
</div>
<script>
function locate(url) {
    console.log(url)
    window.location.href = "<?php echo URLROOT?>/admin/discount_agent_view/" + url;
}

function opendelete(id) {
    var baseURL = '<?php echo URLROOT; ?>/admin/discount_agent_delete/';

    var deleteURL = baseURL + id;

    var deletePop = document.getElementById('delete_confirm');
    deletePop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    var deleteButton = document.getElementById('deletebtn');
    deleteButton.onclick = function() {
        window.location.href = deleteURL;
    };

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

document.addEventListener('DOMContentLoaded', function() {

    var close_delete = document.getElementById('delete-close');

    close_delete.addEventListener('click', function() {
        var deletePop = document.getElementById('delete_confirm');
        deletePop.classList.remove('active');
        document.getElementById('overlay').style.display = "none";

    });
});
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>