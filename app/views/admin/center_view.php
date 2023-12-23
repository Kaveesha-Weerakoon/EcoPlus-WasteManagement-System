<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
        </script>

        <div class="Admin_Center_View">
            <div class="main">

                <div class="main-left">
                    <div class="main-left-top">
                        <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                        <h1>Eco Plus</h1>
                    </div>
                    <div class="main-left-middle">
                        <a href="./Collector_DashBoard.html">
                            <div class="main-left-middle-content current">
                                <div class="main-left-middle-content-line"></div>
                                <img src="<?php echo IMGROOT?>/Home.png" alt="">
                                <h2>Dashboard</h2>
                            </div>
                        </a>
                        <a href="./Collector_Requests/Collector_Requests.html">
                            <div class="main-left-middle-content">
                                <div class="main-left-middle-content-line1"></div>
                                <img src="<?php echo IMGROOT?>/Reports.png" alt="">
                                <h2>Reports</h2>
                            </div>
                        </a>
                        <a href="./Complains/Complains_customer.html">
                            <div class="main-left-middle-content Collector">
                                <div class="main-left-middle-content-line1"></div>
                                <img src="<?php echo IMGROOT?>/Complains.png" alt="">
                                <h2>Complains</h2>
                            </div>
                        </a>
                        <a href="./Collector_Edit_Profile/Collector_EditProfile.html">
                            <div class="main-left-middle-content">
                                <div class="main-left-middle-content-line1"></div>
                                <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                                <h2>Edit Profile</h2>
                            </div>
                        </a>

                    </div>
                    <div class="main-left-bottom">
                        <div class="main-left-bottom-content">
                            <img src="<?php echo IMGROOT?>/logout.png" alt="">
                            <p>Log out</p>
                        </div>
                    </div>
                </div>

                <div class="main-right">
                    <div class="main-top">
                        <a href="<?php echo URLROOT?>/admin">
                            <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                        </a>

                        <div class="main-top-component">
                            <p>Admin</p>
                            <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                        </div>
                    </div>
                    <div class="main-bottom">
                        <div class="main-bottom-top">
                            <div class="main-right-top-two">
                                <h1>Centers</h1>
                            </div>
                            <div class="main-right-top-three">
                                <a href="">
                                    <div class="main-right-top-three-content">
                                        <p><b style="color: #1B6652;">View</b></p>
                                        <div class="line"></div>
                                    </div>
                                </a>
                                <a href="<?php echo URLROOT?>/admin/center_add">
                                    <div class="main-right-top-three-content">
                                        <p>Add</p>
                                        <div class="line1"></div>
                                    </div>
                                </a>

                            </div>
                        </div>
                        <div class="main-bottom-down">
                            <div class="main-right-bottom-top ">
                                <table class="table">
                                    <tr class="table-header">
                                        <th>Center ID</th>
                                        <th>Region</th>
                                        <th>Location</th>
                                        <th>Center Manger ID</th>
                                        <th>Center Manager Name</th>
                                        <th>View Center</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">
                                <table class="table">
                                    <?php foreach($data['centers'] as $centers) : ?>
                                    <tr class="table-row">
                                        <td>C<?php echo $centers->id?></td>
                                        <td><?php echo $centers->region?></td>
                                        <td><img onclick="viewLocation(<?php echo $centers->lat; ?>, <?php echo $centers->longi; ?>)"
                                                src="<?php echo IMGROOT?>/location.png" alt=""></td>
                                        <td><?php echo $centers->center_manager_id?></td>
                                        <td><?php echo $centers->center_manager_name?></td>
                                        <td><a
                                                href="<?php echo URLROOT?>/admin/center_main/<?php echo $centers->id?>/<?php echo $centers->region?>"><img
                                                    src="<?php echo IMGROOT?>/Admin_Center.png" alt=""></a></td>
                                        <td><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                        <td class="delete"> <a
                                                href="<?php echo URLROOT?>/admin/center_delete/<?php echo $centers->id?>"><img
                                                    src="<?php echo IMGROOT?>/delete.png" alt=""></a></td>
                                    </tr>
                                    <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="location_pop">
                    <div class="location_pop_content">
                        <div class="location_pop_map">

                        </div>
                        <div class="location_close">
                            <button onclick="closemap()">Close</button>
                        </div>
                    </div>
                </div>
                <?php if($data['delete_center']=='True') : ?>
                <div class="center_delete">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/trash.png" alt="">
                        <h2>Delete this Center?</h2>
                        <p>This action will permanently delete this Center</p>
                        <div class="btns">
                            <a href="<?php echo URLROOT?>/admin/center_delete_confirm/<?php echo $data['center_id']?>"><button
                                    type="button" class="deletebtn">Delete</button></a>
                            <a href="<?php echo URLROOT?>/admin/center"><button type="button"
                                    class="cancelbtn">Cancel</button></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<script>
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
    document.querySelector('.location_pop').style.display = 'flex';
}

function closemap() {
    document.querySelector('.location_pop').style.display = 'none';
}
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>