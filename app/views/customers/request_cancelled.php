<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer></script>

    <div class="Customer_Request_Main">
        <div class="Customer_Request_Cancelled">
        <div class="main">
            <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT ?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                     <a href="<?php echo URLROOT?>/customers">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT ?>/Customer_DashBoard_Icon.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT ?>/Customer_Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    <a href="<?php echo URLROOT?>/customers/history">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT ?>/Customer_tracking _Icon.png" alt="">
                            <h2>History</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/customers/editprofile">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT ?>/Customer_Edit_Pro_Icon.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>
                </div>
                <div class="main-left-bottom">
   
                <a href="<?php echo URLROOT?>/customers/logout">
  
                        <div class="main-left-bottom-content">
                            <img src="<?php echo IMGROOT ?>/Logout.png" alt="">
                            <p>Log out</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                       <div class="main-right-top-one-input">
                           <img src="<?php echo IMGROOT?>/Search.png" alt="">
                           <input type="text" placeholder="Search" id="searchInput">
                        </div>
                        <div class="main-right-top-one-content">
                            <p><?php echo $_SESSION['user_name']?></p>
                            <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Requests</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/customers/request_main">
                            <div class="main-right-top-three-content">
                                <p>Current</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/customers/request_completed">
                            <div class="main-right-top-three-content">
                                <p>Completed</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                      
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Cancelled</b></p>
                                <div class="line"></div>
                            </div>
                        
                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Req ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Center</th>
                                <th>Location</th> 
                                <th>Collector</th>
                                <th>Cancelled By</th>
                                <th>Reason</th>
                            </tr>
                        </table>
                    </div>

                    <div class="main-right-bottom-down">
                        <table class="table">
                           <?php foreach($data['cancelled_request'] as $request) : ?>
                               <tr class="table-row">
                                 <td>R<?php echo $request->req_id?></td>
                                 <td><?php echo $request->date?></td>
                                 <td><?php echo $request->time?></td>
                                 <td><?php echo $request->region?></td>
                                 <td><img src="<?php echo IMGROOT?>/location.png" onclick="viewLocation(<?php echo $request->lat; ?>, <?php echo $request->longi; ?>)"></td>
                                 <td><img src="<?php echo IMGROOT?>/view.png" alt=""></td>
                                 <td><?php echo $request->cancelled_by?></td>
                                 <td><?php echo ($request->reason ? $request->reason : 'None'); ?></td>                             </tr>
                            <?php endforeach; ?>
                        </table>

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
        </div>
    </div>  
</div>
<script>

    function searchTable() {
                   var input = document.getElementById('searchInput').value.toLowerCase();
                   var rows = document.querySelectorAll('.table-row');

                   rows.forEach(function(row) {
                   var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                   var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                   var time = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
                   var center = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
                   var cancelled_By = row.querySelector('td:nth-child(7)').innerText.toLowerCase();
                   var reason = row.querySelector('td:nth-child(8)').innerText.toLowerCase();

                   if (center.includes(input) || id.includes(input) || status.includes(input) || date.includes(input) ||  time.includes(input)|| cancelled_By.includes(input)|| reason.includes(input)) {
                        row.style.display = '';  
                   } else {
                     row.style.display = 'none';  // Hide the row
                    }
                  });
            
    }

    function initMap(latitude, longitude) {
      var mapCenter = { lat: 7.4, lng: 81.00000000 };

      var map = new google.maps.Map(document.querySelector('.location_pop_map'), {
         center: mapCenter,
         zoom: 7.4
      });

      var marker = new google.maps.Marker({
        position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
        map: map,
        title: 'Marked Location'
      });
    }

    function viewLocation($lattitude,$longitude){
        initMap($lattitude,$longitude);
        document.querySelector('.location_pop').style.display = 'flex';
    }   
    function closemap(){
        document.querySelector('.location_pop').style.display = 'none';

    }
    document.getElementById('searchInput').addEventListener('input', searchTable);

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
