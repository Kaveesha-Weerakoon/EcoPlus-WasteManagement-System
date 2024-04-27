<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
        </script>

        <div class="Admin_Center_View">
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
                            <h1>Centers</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/Admin/Center">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">View</b></p>
                                    <div class="line" style="background-color: #1ca557;"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/admin/center_add">
                                <div class="main-right-top-three-content">
                                    <p>Add</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Center ID</th>
                                    <th>Region</th>
                                    <!-- <th>Location</th> -->
                                    <th>Center Manger ID</th>
                                    <th>Center Manager Name</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['centers'] as $centers) : ?>
                                <tr class="table-row">

                                    <td><?php echo $centers->id?></td>
                                    <td><?php echo $centers->region?></td>

                                    <td><?php echo $centers->center_manager_id?></td>
                                    <td><?php echo $centers->center_manager_name?></td>
                                    <td><i class="fa-solid fa-eye" style="font-size: 20px;"
                                            onclick="locate('<?php echo $centers->id?>/<?php echo $centers->region?>')"></i>
                                    </td>
                                    <td>
                                        <?php if ($centers->disable) : ?>
                                        <i class="fa-solid fa-unlock" style="font-size: 20px;"></i>
                                        <?php else : ?>
                                        <i class="fa-solid fa-user-lock" style="font-size: 20px;"
                                            onclick="block_user('<?php echo $centers->id; ?>')"></i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                        </div>
                    </div>

                </div>
                <div class="location_pop" id="location_pop">
                    <div class="location_pop_content">
                        <div class="location_pop_map">

                        </div>
                        <div class="location_close">
                            <button onclick="closemap()">Close</button>
                        </div>
                    </div>
                </div>

                <div class="overlay" id="overlay"></div>

                <div class="delete_confirm2" id="cancel_confirm">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                        <h2>Disable the Center?</h2>
                        <p>This action disable the Center </p>
                        <div class="btns">
                            <a id="cancelLink"><button type="button" class="deletebtn">Block</button></a>
                            <a id="close_cancel"><button type="button" class="cancelbtn">Cancel</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($data['Success']=='True') : ?>
            <div class="complain_success" style="">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Center has been Disabled Successfully</p>
                    <a href="<?php echo URLROOT?>/admin/center"><button type="button">OK</button></a>


                </div>
            </div>
            <?php endif; ?>
            <?php if($data['Success']=='False') : ?>
            <div class="delete_confirm">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/trash.png" alt="">


                    <h2>This Action is prohibited</h2>
                    <p>Center has ongoing requests,Center garbage stock is assisgned to a center</p>

                    <div class="btns">
                        <a href="<?php echo URLROOT?>/admin/center"><button type="button"
                                class="cancelbtn">Cancel</button></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

    </div>
</div>
<script>
function locate(url) {
    window.location.href = "<?php echo URLROOT?>/admin/center_main/" + url;
}

function initMap(latitude, longitude) {
    var mapCenter = {
        lat: latitude,
        lng: longitude
    };

    var map = new google.maps.Map(document.querySelector('.location_pop_map'), {
        center: mapCenter,
        zoom: 8
    });

    var marker = new google.maps.Marker({
        position: {
            lat: parseFloat(latitude),
            lng: parseFloat(longitude)
        },
        map: map,
        title: 'Marked Location'
    });
}


function viewLocation($lattitude, $longitude) {
    initMap($lattitude, $longitude);
    var locationPop = document.getElementById('location_pop');
    locationPop.classList.add('active');
    document.getElementById('overlay').style.display = "flex";
}

function closemap() {
    var locationPop = document.getElementById('location_pop');
    locationPop.classList.remove('active');
    document.getElementById('overlay').style.display = "none";
}

function searchTable() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.table-row');
    rows.forEach(function(row) {
        var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
        var status = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
        var date = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
        var time = row.querySelector('td:nth-child(5)').innerText.toLowerCase();

        if (id.includes(input) || status.includes(input) || date
            .includes(
                input) || time.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });

}

function block_user(id) {
    var userId = id;
    var newURL = "<?php echo URLROOT?>/admin/center_block/" + userId;
    document.getElementById('cancelLink').href = newURL;
    document.getElementById('overlay').style.display = "flex";
    document.getElementById('cancel_confirm').classList.add('active');
}
const close_cancel = document.getElementById("close_cancel");

close_cancel.addEventListener("click", function() {
    document.getElementById('cancel_confirm').classList.remove('active');
    document.getElementById('overlay').style.display = "none";
});

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>