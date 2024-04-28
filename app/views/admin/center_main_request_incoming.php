<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Top">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer>
        </script>

        <div class="Admin_Center_Main_Request_Incoming">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <a
                                href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                                <div class="main-right-top-back-button">
                                    <i class='bx bxs-chevrons-left'></i>
                                </div>
                            </a>
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>

                            <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                        </div>
                        <div class="main-right-top-two">
                            <h1>Requests</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/Admin/incoming_requests/<?php echo $data['center_region']?>"
                                id="incoming">

                                <div class="main-right-top-three-content" id="current">
                                    <p>Incoming</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/assigned_requests/<?php echo $data['center_region']?>"
                                id="assigned">
                                <div class="main-right-top-three-content">
                                    <p>Assigned</p>
                                    <div class="line"></div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/Admin/completed_requests/<?php echo $data['center_region']?>"
                                id="completed">
                                <div class="main-right-top-three-content">
                                    <p>Completed</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/Admin/cancelled_requests/<?php echo $data['center_region']?>"
                                id="cancelled">
                                <div class="main-right-top-three-content">
                                    <p>Cancelled</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Req ID</th>
                                    <th>C ID</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Location</th>
                                    <th>Contact No</th>
                                    <th>Instructions</th>

                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['incoming_requests'] as $incoming_requests) : ?>
                                <tr class="table-row">
                                    <td>R<?php echo $incoming_requests->req_id?></td>
                                    <td>C<?php echo $incoming_requests->customer_id?></td>
                                    <td><?php echo $incoming_requests->name?></td>
                                    <td><?php echo $incoming_requests->date?></td>
                                    <td><?php echo $incoming_requests->time?></td>
                                    <td><i onclick="viewLocation(<?php echo $incoming_requests->lat; ?>, <?php echo $incoming_requests->longi; ?>)"
                                            class='bx bx-map' style="font-size: 29px;"></i></td>
                                    <!-- <td><img onclick="viewLocation(<?php echo $incoming_requests->lat; ?>, <?php echo $incoming_requests->longi; ?>)" src="<?php echo IMGROOT?>/location.png" alt=""></td> -->
                                    <td><?php echo $incoming_requests->contact_no?></td>
                                    <td><?php echo $incoming_requests->instructions?></td>
                                </tr>
                                <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="overlay" id="overlay"></div>

                    <div class="location_pop" id="location_pop">
                        <div class="location_pop_content">
                            <div class="location_pop_map">

                            </div>
                            <div class="location_close">
                                <button onclick="closemap()">Close</button>
                            </div>
                        </div>
                    </div>

                </div>
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
        zoom: 15
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

// function viewLocation($lattitude,$longitude){
//     initMap($lattitude,$longitude);
//     document.querySelector('.location_pop').style.display = 'flex';
// }  

// function closemap(){
//     document.querySelector('.location_pop').style.display = 'none';
// }

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
        var date = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
        var time = row.querySelector('td:nth-child(4').innerText.toLowerCase();
        var center = row.querySelector('td:nth-child(5)').innerText.toLowerCase();
        var center1 = row.querySelector('td:nth-child(7)').innerText.toLowerCase();
        var center2 = row.querySelector('td:nth-child(8)').innerText.toLowerCase();


        if (center.includes(input) || id.includes(input) || status.includes(input) || date
            .includes(
                input) || time.includes(input) || center1.includes(input) || center2.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });

}

document.getElementById('searchInput').addEventListener('input', searchTable);
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>