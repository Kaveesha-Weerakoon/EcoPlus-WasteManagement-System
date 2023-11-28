<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API ?>&callback=initMap" async defer></script>
    <div class="CenterManager_Request_Main">  
      <div class="CenterManager_Request_Assinged">
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
                            <input id="searchInput" type="text" placeholder="Search">
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
                        <a href="<?php echo URLROOT?>/centermanagers/request_incomming">
                            <div class="main-right-top-three-content">
                                <p>Incoming</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/request_assigned">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Assigned</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p>Completed</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/request_cancelled">
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
                            <button onclick="loadLocations()">Filter</button>               
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
                <?php if(!empty($data['assined_requests'])) : ?>

                <div class="main-right-bottom" id="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Req ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Customer ID</th>
                                <th>Collector ID</th>
                                <th>Collector</th> 
                                <th>Request Details</th>
                                <th>Cancel</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['assined_requests'] as $request) : ?> 

                              <tr class="table-row">
                                  <td>R <?php echo $request->req_id?></td>
                                  <td><?php echo $request->date?></td>
                                  <td><?php echo $request->time?></td>                                
                                  <td><?php echo $request->customer_id?></td>
                                                     
                                  <td><?php echo $request->collector_id?></td>
                                  <td>
                                     <img onclick="" class="collector_img" src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $request->image?>" alt="">
                                  </td>
                                  <td>
                                     <img onclick="" class="cancel" src="<?php echo IMGROOT?>/info.png" alt="">
                                  </td> 
                                  <td>
                                    <img onclick="cancel(<?php echo $request->req_id ?>)" class="cancel" src="<?php echo IMGROOT?>/cancel.png" alt="">
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
                <?php else: ?>
                     <div class="main-right-bottom-three">
                            <div class="main-right-bottom-three-content">
                                   <img src="<?php echo IMGROOT?>/Center_Manager_Request_Assign_Empty.jpg" alt="">
                                   <h1>You have No Assinged Requests</h1>
                                  
                            </div>
                     </div>
                 <?php endif; ?>
        </div>
        <div class="cancel-confirm" id="cancel-confirm">
              <form class="cancel-confirm-content" id="cancel-form" method="post" action="<?php echo URLROOT?>/centermanagers/assinged_request_cancell">
                   <div class="cancel-confirm-top-close">
                      <img class="View-content-img" src="<?php echo IMGROOT?>/close_popup.png" id="cancel-pop">
                   </div>
                   <h1>Cancel the Request?</h1>
                   <img class="cancel-confirm-content-warning" src="<?php echo IMGROOT?>/warning.png" alt=""> 
                   <input name="reason" type="text" placeholder="Input the Reason">
                   <input name="id" type="text" >
                   <button onclick="validateCancelForm()" id="cancel-pop" style="background-color: tomato;">OK</button>
              </form>

            </div>
   </div>
</div>
</div>
<script>
   function cancel($id) {
        var inputElement = document.querySelector('input[name="id"]');
        inputElement.style.display = 'none';
        inputElement.value = $id;
        document.getElementById("cancel-confirm").style.display="flex"
    }
    function searchTable() {
                   var input = document.getElementById('searchInput').value.toLowerCase();
                   var rows = document.querySelectorAll('.table-row');

                   rows.forEach(function(row) {
                   var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                   var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                   var time = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
                   var customer = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
                   var cid = row.querySelector('td:nth-child(5)').innerText.toLowerCase();

                   if (time.includes(input) || id.includes(input) || date.includes(input) || customer.includes(input) ||  cid.includes(input)) {
                        row.style.display = '';  
                   } else {
                     row.style.display = 'none';  // Hide the row
                    }
                  });
            
    } 

    function validateCancelForm(){
        var reasonInput = document.getElementsByName("reason")[0].value;

        if (reasonInput.trim() === "" || reasonInput.split(/\s+/).length > 200) {
           alert("Please enter a reason");
        } else {
        document.getElementById("cancel-form").submit();
      }
    }

   function initMap() {
       var map = new google.maps.Map(document.getElementById('map-loaction'), {
          center: { lat: 7.8731, lng: 80.7718 },
         zoom: 7.2
       });
      
       var incomingRequests = <?php echo $data['jsonData']; ?>;
       incomingRequests.forEach(function (coordinate) {
            var marker = new google.maps.Marker({
                position: { lat: parseFloat(coordinate.lat), lng: parseFloat(coordinate.longi) },
                map: map,
                title: 'Marker'
            });
            marker.addListener('click', function () {
                handleMarkerClick(marker,coordinate);
            });
        });
     }

     document.addEventListener("DOMContentLoaded", function () {
       
       const closeButton = document.getElementById("cancel-pop");
       const popup = document.getElementById("cancel-confirm");
      
       const closeassign = document.getElementById("cancel-assing");
       const assign = document.getElementById("View");

       const maps = document.getElementById("maps");
       const table = document.getElementById("tables");
       const main_right_bottom= document.getElementById("main-right-bottom");
       const main_right_bottom_two = document.getElementById("main-right-bottom-two");
     
      
       maps.addEventListener("click", function () {
           if (main_right_bottom !== null) {
               main_right_bottom.style.display = "none";
           }
           if (main_right_bottom_two !== null) {
               main_right_bottom_two.style.display = "flex";
           }
           maps.style.backgroundColor = "#ecf0f1";
           table.style.backgroundColor = "";
       }); 

       table.addEventListener("click", function () {
           if (main_right_bottom !== null) {
               main_right_bottom.style.display = "flex";
           }
           if (main_right_bottom_two !== null) {
               main_right_bottom_two.style.display = "none"; 
           }
           table.style.backgroundColor = "#ecf0f1";
           maps.style.backgroundColor = "";
           
       });

   
        closeButton.addEventListener("click", function () {
            popup.style.display = "none";
        });

      //    closeassign.addEventListener("click", function () {
       //        assign.style.display = "none";
      //    });
     });
   document.getElementById('searchInput').addEventListener('input', searchTable);

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
