<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Request_Main">
      <div class="CenterManager_Request_Incomming">
      <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&callback=initMap" async defer></script>

        <div class="main">

            <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="<?php echo URLROOT?>/centermanagers">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Home.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-left-middle-content Collector ">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Center.png" alt="">
                            <h2>Center Waste Management</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/centermanagers/editprofile">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>

                </div>
                <a href="<?php echo URLROOT?>/centermanagers/logout">
                <div class="main-left-bottom">
                    <div class="main-left-bottom-content">
                        <img src="<?php echo IMGROOT?>/logout.png" alt="">
                        <p>Log out</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-one-search">
                            <img src="<?php echo IMGROOT?>/Search.png" alt="">
                            <input type="text" placeholder="Search">
                        </div>

                        <div class="main-right-top-one-content">
                            <p><?php echo $_SESSION['center_manager_name']?></p>
                            <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Requests</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="./CenterManager_Requests.html">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Incoming</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="./CenterManager_Assigned.html">
                            <div class="main-right-top-three-content">
                                <p>Assigned</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="./CenterManager_Requests_Completed.html">
                            <div class="main-right-top-three-content">
                                <p>Completed</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="./CenterManager_Canclled.html">
                            <div class="main-right-top-three-content">
                                <p>Cancelled</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                    </div>
                    <div class="main-right-top-four">
                        <div class="main-right-top-four-left">
                            <p>Date</p>
                            <input type="date" id="selected-date">
                            <button onclick="loadLocations()">Load Locations</button>
                            
                        </div>
                        <div class="main-right-top-four-right">

                            <div class="main-right-top-four-component" style="background-color: #ecf0f1" id="maps">
                                <img src="<?php echo IMGROOT?>/map.png" alt="">
                                <p>Maps</p>
                            </div>      

                            <div class="main-right-top-four-component" id="tables">
                            <img src="<?php echo IMGROOT?>/cells.png" alt="">
                                <p>Tables</p>
                               </div>
                        </div>
                    </div>
                </div>

                <div class="main-right-bottom" id="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Req ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Customer</th>
                                <th>C ID</th>
                                <th>Contact No</th>
                                <th>Instructions</th>
                                <th>Assign</th>
                                <th>Cancel</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                        <?php foreach($data['incoming_requests'] as $request) : ?>
                           <tr class="table-row">
                                <td>R<?php echo $request->req_id?></td>
                                <td><?php  echo $request->date?></td>
                                <td><?php  echo $request->time?></td>
                                <td><?php  echo $request->name?></td>
                                <td><?php  echo $request->customer_id?></td>
                                <td><?php  echo $request->contact_no?></td>
                                <td><?php  echo $request->instructions?></td>
                                <td><img class="add" src="<?php echo IMGROOT?>/assign.png" alt=""></td>
                                <td>
                                    <img class="cancel" src="<?php echo IMGROOT?>/cancel.png" alt="">
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </table>
                    </div>
                </div>
                <div class="main-right-bottom-two" id="main-right-bottom-two">
                    <div class="map-locations" id="map-loaction">

                    </div>
                </div>



            </div>
            
         
            <div class="cancel-confirm" id="cancel-confirm">
                <div class="cancel-confirm-content">
                    <img class="View-content-img" src="<?php echo IMGROOT?>/close_popup.png" id="cancel-detail">
                    <h1>Cancel the Request?</h1>
                    <img class="cancel-confirm-content-warning" src="<?php echo IMGROOT?>/warning.png" alt=""> 
                    <input type="text" placeholder="Input the Reason">
                  
                    <button id="cancel-pop" style="background-color: tomato;">OK</button>
                    
                </div>
            </div>
            <div class="View" id="View">
                <div class="View-content">
                    <img class="View-content-img" src="<?php echo IMGROOT?>/close_popup.png" id="cancel-detail">
                    <h2>Assign a Collector</h2>

                    <img class="view_assing" src="<?php echo IMGROOT?>/selection.png" alt="">
                    <h3>Req ID <b>R 1231</b></h3>

                    <select id="dropdown" name="fruit">
                        <option value="saman">Saman</option>
                        <option value="kumara">Kumara</option>
                        <option value="janaka">Janaka</option>

                    </select>
                    <Button>Assign</Button>
                </div>
            </div>

        </div>





<script>
  

    function initMap() {
       var map = new google.maps.Map(document.getElementById('map-loaction'), {
         center: { lat: 7.8731, lng: 80.7718 },
         zoom: 7.2
       });
       ;
       var incomingRequests = <?php echo $data['jsonData']; ?>;

       incomingRequests.forEach(function (coordinate) {
            var marker = new google.maps.Marker({
                position: { lat: parseFloat(coordinate.lat), lng: parseFloat(coordinate.longi) },
                map: map,
                title: 'Marker'
            });

            marker.addListener('click', function () {
                handleMarkerClick(marker);
            });
        });
     }

     function handleMarkerClick(marker) {
        const adddetails = document.getElementById("View");
        adddetails.style.display = "flex";
    }
     
    function loadLocations() {
    var selectedDate = document.getElementById('selected-date').value;
      if (selectedDate.trim() !== "") {
            updateMapForDate(selectedDate);
      
            var rows = document.querySelectorAll('.table-row');
            rows.forEach(function(row) {
                   console.log('d');
                   var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                   if (date .includes(selectedDate) ) {
                        row.style.display = '';  
                   } else {
                     row.style.display = 'none'; 
                    }
                  });         
      }
}

    function updateMapForDate(selectedDate) {
        var map = new google.maps.Map(document.getElementById('map-loaction'), {
         center: { lat: 7.8731, lng: 80.7718 },
         zoom: 7.2
       });
     
      var incomingRequestsForDate = <?php echo $data['jsonData']; ?>;
      var filteredRequests = incomingRequestsForDate.filter(function (coordinate) {
        return coordinate.date === selectedDate;
    });

    filteredRequests.forEach(function (coordinate) {
        var marker = new google.maps.Marker({
            position: { lat: parseFloat(coordinate.lat), lng: parseFloat(coordinate.longi) },
            map: map,
            title: 'Marker'
        });

        marker.addListener('click', function () {
            handleMarkerClick(marker);
        });
    });
    }

    
    document.addEventListener("DOMContentLoaded", function () {
       
        const closeButton = document.getElementById("cancel-pop");
        const popup = document.getElementById("cancel-confirm");
        const popupadd = document.getElementById("Add-Details");
        const closeDetails = document.getElementById("cancel-detail");
        const adddetails = document.getElementById("View");
        const maps = document.getElementById("maps");
        const table = document.getElementById("tables");
        const main_right_bottom= document.getElementById("main-right-bottom");
        const main_right_bottom_two = document.getElementById("main-right-bottom-two");
      
        closeDetails.addEventListener("click", function () {
 
              popup.style.display = "none";
        });

        maps.addEventListener("click", function () {
            main_right_bottom.style.display = "none";
            maps.style.backgroundColor = "#ecf0f1";
            table.style.backgroundColor = "";
            main_right_bottom_two.style.display = "flex";
        }); 

        table.addEventListener("click", function () {
            table.style.backgroundColor = "#ecf0f1";
            maps.style.backgroundColor = "";
            main_right_bottom_two.style.display = "none";
            main_right_bottom.style.display = "flex";
        });

       

        closeButton.addEventListener("click", function () {
            popup.style.display = "none";
        });

        const showDivButtons = document.querySelectorAll(".cancel");
        const showAddButtons = document.querySelectorAll(".add");
        const showLocationButtons = document.querySelectorAll(".location");

        showDivButtons.forEach(button => {
            button.addEventListener("click", function () {

            popup.style.display = "flex";
        });
       });
      
        showAddButtons.forEach(button => {
          button.addEventListener("click", function () {

            adddetails.style.display = "flex";
         });
        });
 
     
    });

 

</script> 

    </div>
</div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>



