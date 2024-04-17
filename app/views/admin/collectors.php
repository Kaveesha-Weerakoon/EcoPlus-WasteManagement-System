<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Collector">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search" id="searchInput">
                    </div>


                    <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>



                </div>

                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Collectors</h1>
                    </div>
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Collector_Id</th>
                                <th>Profile</th>
                                <th>Center</th>
                                <th>Name</th>
                                <th>Vehicle Details</th>
                                <th>Delete</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['collectors'] as $collector) : ?>
                            <tr class="table-row">
                                <td>C <?php echo $collector->user_id?></td>
                                <td><img onclick="openpersonaldetails((<?php echo htmlspecialchars(json_encode($collector), ENT_QUOTES, 'UTF-8') ?>))"
                                        class="collector_img"
                                        src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $collector->image?>"
                                        alt=""></td>
                                <td><?php echo $collector->center_name?></td>
                                <td><?php echo $collector->name?></td>

                                <td><a
                                        href="<?php echo URLROOT?>/admin/vehicle_details_view/<?php echo $collector->user_id ?>"><i
                                            class='bx bxs-truck' style="font-size: 29px;"></i></a></td>
                                <td><a
                                        href="<?php echo URLROOT?>/admin/collectorsdelete_confirm/<?php echo $collector->user_id ?>"><i
                                            class='bx bxs-trash' style="font-size: 29px;"></i></a></td>
                                <?php endforeach; ?>
                        </table>


                    </div>
                </div>

            </div>

            <div class="overlay" id="overlay"></div>

            <div class="personal-details-popup-box" id="personal-details-popup-box">
                <div class="personal-details-popup-form">
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="personal-details-popup-form-close"
                        id="personal-details-popup-form-close">
                    <center>
                        <div class="personal-details-topic">Personal Details</div>
                    </center>

                    <div class="personal-details-popup">
                        <div class="personal-details-left">
                            <!-- <img src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $data['image']?>" class="profile-pic"
                                alt=""> -->
                            <img src="" id="collector_profile_pic" alt="">
                            <p>Collector ID: <span id="collector_id">C</span></p>
                        </div>
                        <div class="personal-details-right">
                            <div class="personal-details-right-labels">
                                <span>Name</span><br>
                                <span>Email</span><br>
                                <span>NIC</span><br>
                                <span>Address</span><br>
                                <span>Contact No</span><br>
                                <span>DOB</span><br>
                            </div>
                            <div class="personal-details-right-values">
                                <span id="collector_name"></span><br>
                                <span id="collector_email"></span><br>
                                <span id="collector_nic"></span><br>
                                <span id="collector_address"></span><br>
                                <span id="collector_contact_no"></span><br>
                                <span id="collector_dob"></span><br>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <?php if($data['vehicle_details_click']=='True') : ?>
        <div class="vehicle-details-popup-box">
            <div class="vehicle-details-popup-form" id="popup">
                <a href="<?php echo URLROOT?>/admin/collectors"><img src="<?php echo IMGROOT?>/close_popup.png" alt=""
                        class="vehicle-details-popup-form-close"></a>
                <center>
                    <div class="vehicle-details-topic">Vehicle Details</div>
                </center>

                <div class="vehicle-details-popup">
                    <div class="vehicle-details-labels">
                        <span>Collector ID</span><br>
                        <span>Name</span><br>
                        <span>Vehicle Plate No</span><br>
                        <span>Vehicle Type</span><br>
                    </div>
                    <div class="vehicle-details-values">
                        <span>C<?php echo $data['id']?></span><br>
                        <span><?php echo $data['name']?></span><br>
                        <span><?php echo $data['vehicle_no']?></span><br>
                        <span><?php echo $data['vehicle_type']?></span><br>
                    </div>
                </div>
            </div>
        </div>

        <?php endif; ?>
        <?php if($data['delete_confirm']=='True') : ?>
        <div class="delete_confirm">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/trash.png" alt="">
                <?php
                        echo "<h2>Delete this Customer?</h2>";
                        echo "<p>This action will permanently delete this center manager</p>";          
                    ?>
                <div class="btns">

                    <a href="<?php echo URLROOT?>/Admin/collectordelete/<?php echo $data['id']?>"><button type="button"
                            class="deletebtn">Delete</button></a>

                    <a href="<?php echo URLROOT?>/Admin/collectors"><button type="button"
                            class="cancelbtn">Cancel</button></a>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>
<script>
function openpersonaldetails(collector) {
    var personalPop = document.getElementById('personal-details-popup-box');
    personalPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";

    document.getElementById('collector_id').textContent = collector.user_id;
    document.getElementById('collector_profile_pic').src = "<?php echo IMGROOT?>/img_upload/collector/" + collector
        .image;
    document.getElementById('collector_name').textContent = collector.name;
    document.getElementById('collector_email').textContent = collector.email;
    document.getElementById('collector_nic').textContent = collector.nic;
    document.getElementById('collector_address').textContent = collector.address;
    document.getElementById('collector_contact_no').textContent = collector.contact_no;
    document.getElementById('collector_dob').textContent = collector.dob;


}

document.addEventListener('DOMContentLoaded', function() {
    var close_personal_details = document.getElementById('personal-details-popup-form-close');
    close_personal_details.addEventListener('click', function() {
        const personal_details = document.getElementById("personal-details-popup-box");
        personal_details.classList.remove('active');
        document.getElementById('overlay').style.display = "none";

    });
});

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
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>