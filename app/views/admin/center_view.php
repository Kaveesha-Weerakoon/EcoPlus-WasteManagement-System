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
                            <div class="main-right-top-notification" id="notification">
                                <i class='bx bx-bell'></i>
                                <div class="dot"></div>
                            </div>
                            <div id="notification_popup" class="notification_popup">
                                <h1>Notifications</h1>
                                <div class="notification">
                                    <div class="notification-green-dot">

                                    </div>
                                    Request 1232 Has been Cancelled
                                </div>
                                <div class="notification">
                                    <div class="notification-green-dot">

                                    </div>
                                    Request 1232 Has been Assigned
                                </div>
                                <div class="notification">
                                    <div class="notification-green-dot">

                                    </div>
                                    Request 1232 Has been Cancelled
                                </div>
                            </div>
                            <div class="main-right-top-profile">
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <div class="main-right-top-profile-cont">
                                    <h3>Admin</h3>
                                </div>
                            </div>
                        </div>
                        <div class="main-right-top-two">
                            <h1>Centers</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/Admin/Center">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">View</b></p>
                                    <div class="line"  style="background-color: #1ca557;"></div>
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
                                    <th>Location</th>
                                    <th>Center Manger ID</th>
                                    <th>Center Manager Name</th>
                                    <th>View Center</th>
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
                                    <td class="delete"> <a
                                            href="<?php echo URLROOT?>/admin/center_delete/<?php echo $centers->id?>"><img
                                                src="<?php echo IMGROOT?>/delete.png" alt=""></a></td>
                                </tr>
                                <?php endforeach; ?>

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