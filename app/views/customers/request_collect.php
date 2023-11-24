<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Request_collect">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

      <script  
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
            async defer>
       </script>

    <div class="main">
      <div class="main-top">
        <a href="CustomerDashboard.html">
          <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="" />
        </a>

        <div class="main-top-component">
          <p><?php echo $_SESSION['user_name']?></p>
          <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="" />
        </div>
      </div>

      <form  class="main-bottom" action="<?php echo URLROOT;?>/customers/request_collect" method="post">
     
        <div class="main-bottom-component" >
             <div class="main-bottom-component-left">
                  <img src="<?php echo IMGROOT?>/RequestCollect.jpg" alt="">
             </div>
             <div class="main-bottom-component-right" >
                    <div class="main-bottom-component-right-component-topic">
                           <h2>Request a Collect</h2>
                           <div class="line"></div>
                    </div>
                    <div class="main-bottom-component-right-component-main">
                       <div class="main-bottom-component-right-component">
                           <h2>Name</h2>
                           <input value="<?php echo $data['name']?>" name="name" type="text" placeholder="Name">
                           <div  class="err"><?php echo $data['name_err']?></div>
                       </div>
                       <div class="main-bottom-component-right-component">
                           <h2>Contact Number</h2>
                           <input value="<?php echo $data['contact_no']?>"name="contact_no" type="text" placeholder="Contact Number">
                           <div  class="err"><?php echo $data['contact_no_err']?></div>
                       </div>
                    </div> 
                    <div class="main-bottom-component-right-component-main">

                          <div class="main-bottom-component-right-component">
                             <h2>Date</h2>
                             <input value="<?php echo $data['date']?>" name="date" type="date" >
                             <div  class="err"><?php echo $data['date_err']?></div>
                          </div>
                          <div class="main-bottom-component-right-component">
                             <h2>Time</h2>
                             <input value="<?php echo $data['time']?>" name="time" type="Time" placeholder="Name">
                             <div  class="err"><?php echo $data['time_err']?></div>
                          </div>
                    </div>
                    <div class="main-bottom-component-right-component">
                        <h2>Your Region</h2>
                        <select name="center" id="centerDropdown">
                         <?php
                              $centerManagers = $data['centers'];
                              if (!empty($centerManagers)) {
                                foreach ($centerManagers as $center) {
                                echo "<option value=\"$center->region\">$center->region</option>";
                              }
                              } else {
                                 echo "<option value=\"default\">No Centers Available</option>";
                                }
                          ?>
                        </select>
                    </div>
                    <div class="main-bottom-component-right-component">
                        <h2>Pick Up Instructions</h2>
                        <input value="<?php echo $data['instructions']?>" name="instructions" type="Text" placeholder="Pick Up Instructions">
                        <div  class="err"><?php echo $data['instructions_err']?></div>
                    </div>
                    <div class="main-bottom-component-right-component Z">
                        <h2>Location</h2>
                     
                        <div class="main-bottom-maps">
                               <h4>Maps</h4>
                               <img src="<?php echo IMGROOT?>/location2.png" alt="">
                         
                        </div>
                    
                    </div>
                    <div class="main-bottom-component-right-component-button">
                        <Button type="submit">Request Now</Button>
                    </div>
                  
              </div>
         </div>
         <div class="map_pop" id="mapPopup">
        <div id="map"></div>
            <div class="buttons-container" id="submitForm" >
                <button type="submit" formaction="<?php echo URLROOT; ?>/customers/location_fetched" method="post" id="markLocationBtn" onclick="getLocation()">Mark Location</button>
                <button type="button" id="cancelBtn">Cancel</button>
                <input type="hidden" id="latitudeInput" name="latitude">
                <input type="hidden" id="longitudeInput" name="longitude">
             </div>

         </div> 
      </form >
      <script>
           $( document).ready(function() {
                 $('#centerDropdown').select2();
           });
      </script>
    </div>


    <script src="<?php echo JSROOT?>/Request_Collect.js"> </script>   
    
</div>


    <?php require APPROOT . '/views/inc/footer.php'; ?>
