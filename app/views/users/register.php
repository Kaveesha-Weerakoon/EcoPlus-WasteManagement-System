<?php require APPROOT . '/views/inc/header.php'; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
    async defer>
</script>
<div class="Register-main">

    <!-- <div class="main">
        <div class="main-container">
            <form class="main-container-right" action="<?php echo URLROOT;?>/users/register" method="post"
                enctype="multipart/form-data">
                <div class="main-container-right-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Join With Us</h1>
                </div>
                <div class="main-container-right-profile">
                    <div class="main-container-right-profile-left">
                        <div class="form-drag-area">
                            <div class="icon">
                                <img src="<?php echo IMGROOT?>/placeholder.png" alt="PLACEHOLDER" width="90px"
                                    heigh="90px" id="profile_image_placeholder">
                            </div>
                            <div class="right-content">
                                <div class="description">
                                    Drap & Drop to Upload File
                                </div>
                                <div class="form-upload">
                                    <input type="file" name="profile_image" id="profile_image"
                                        placeholder="select a profile image">
                                    <div class="err"><?php echo $data['profile_err']?></div>
                                </div>
                                <div class="form-validation">
                                    <div class="profile-image-validation">
                                        <img src="" alt="green_tik" width="20px" height="20px">
                                        <p style="color: #e74c3c;"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Name</h2>
                            <input type="text" placeholder="Enter Name" name="name"
                                value="<?php echo $data['name']; ?>">
                            <div class="err"><?php echo $data['name_err']?></div>
                        </div>
                    </div>
                </div>
                <div class="main-container-right-profile">
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Email</h2>
                            <input type="text" placeholder="Enter Email" name="email"
                                value="<?php echo $data['email']; ?>">
                            <div class="err"><?php echo $data['email_err']?></div>
                        </div>
                    </div>
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Address</h2>
                            <input type="text" placeholder="Enter Address" name="address"
                                value="<?php echo $data['address']; ?>">
                            <div class="err"><?php echo $data['address_err']?></div>
                        </div>
                    </div>
                </div>
                <div class="main-container-right-profile">
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Contact No</h2>
                            <input type="text" placeholder="Enter Contact No" name="contact_no"
                                value="<?php echo $data['contact_no']; ?>">
                            <div class="err"><?php echo $data['contact_no_err']?></div>
                        </div>
                    </div>
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>City</h2>
                            <input type="text" placeholder="Enter City" name="city"
                                value="<?php echo $data['city']; ?>">
                            <div class="err"><?php echo $data['city_err']?></div>
                        </div>
                    </div>
                </div>
                <div class="main-container-right-profile">
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Password</h2>
                            <input type="password" placeholder="Enter Name" name="password"
                                value="<?php echo $data['password']; ?>">
                            <div class="err"><?php echo $data['password_err']?></div>
                        </div>
                    </div>
                    <div class="main-container-right-profile-right">
                        <div class="form-fields">
                            <h2>Re-enter Password</h2>
                            <input type="password" placeholder="Enter Password Again" name="confirm_password"
                                value="<?php echo $data['confirm_password']; ?>">
                            <div class="err"><?php echo $data['confirm_password_err']?></div>
                        </div>
                    </div>
                </div>
                <div class="register-button">
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>
    </div> -->


    <div class="main">
        <div class="main-left">
            <h1>Our Regional Centers</h1>
            <div class="map" id="map">

            </div>
        </div>
        <form class="main-right" action="<?php echo URLROOT;?>/users/register" method="post"
            enctype="multipart/form-data">
            <div class="top"> <img src="<?php echo IMGROOT?>./Logo.png" alt="">
                <h1>Sign Up</h1>
            </div>

            <div class="porfile-cont">
                <input type="file" name="profile_image" class="profile_image" id="profile_image"
                    placeholder="select a profile image">
                <img src="<?php echo IMGROOT?>./anonymous.png" alt="" class="profile_image_trigger"
                    id="profile_image_trigger">
                <p>Add a Profile Picture</p>
                <div class="err"><?php echo $data['profile_err']?></div>
            </div>
            <div class="cont-main">
                <div class="cont">
                    <p>Name</p>
                    <input type="text" placeholder="Enter your name" value="<?php echo $data['name']; ?>" name="name"
                        id="name">
                    <div class="err"><?php echo $data['name_err']?></div>
                </div>
                <div class="cont">
                    <p>Email</p>
                    <input type="text" placeholder="Enter your email" value="<?php echo $data['email']; ?>" name="email"
                        id="email">
                    <div class="err"><?php echo $data['email_err']?></div>

                </div>
            </div>
            <div class="cont-main">
                <div class="cont">
                    <p>Contact No</p>
                    <input type="text" placeholder="Enter your contact number"
                        value="<?php echo $data['contact_no']; ?>" name="contact_no" id="contact_no">
                    <div class="err"><?php echo $data['contact_no_err']?></div>
                </div>
                <div class="cont">
                    <p>Address</p>
                    <input type="text" placeholder="Enter your address" value="<?php echo $data['address']; ?>"
                        name="address" id="address">
                    <div class="err"><?php echo $data['address_err']?></div>
                </div>
            </div>
            <div class="cont-region">
                <p>Region</p>
                <select id="city" name="city" class="city">
                    <?php
                       $centers = $data['centers2'];
                       $regionFound = false;

                       if (!empty($centers)) {
                        foreach ($centers as $center) {
                            echo "<option value=\"$center->region\" >$center->region</option>";
                 }} else {
                    echo "<option value=\"default\">No Centers Available</option>";
                }
                ?>
                </select>
            </div>



            <div class="cont-main">
                <div class="cont">
                    <p>Password</p>
                    <input type="password" id="password" name="password" placeholder="Enter your password" id="password"
                        value="<?php echo $data['password']; ?>">
                    <div class="err"><?php echo $data['password_err']?></div>
                </div>
                <div class="cont">
                    <p>Confirm Password</p>
                    <input type="password" id="confirmPassword" name="confirm_password" id="confirm_password"
                        placeholder="Confirm your password" value="<?php echo $data['confirm_password']; ?>">
                    <div class="err"><?php echo $data['confirm_password_err']?></div>

                </div>
            </div>
            <button type="submit">Register</button>

            <h2>Back to Login</h2>

        </form>
    </div>
    <script src="<?php echo JSROOT?>/Users_Register.js"> </script>

</div>

<script>
function initMap() {
    var center = {
        lat: 7.7,
        lng: 80.7718
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        center: center,
        zoom: 7.3,
        styles: [{
                featureType: 'all',
                elementType: 'labels.text',
                stylers: [{
                        visibility: 'on'
                    },
                    {
                        fontSize: '10px'
                    }
                ]
            },
            {
                featureType: 'poi',
                elementType: 'labels.icon',
                stylers: [{
                        visibility: 'off'
                    } // Hide the icons for points of interest
                ]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text',
                stylers: [{
                        visibility: 'off'
                    } // Hide text labels for points of interest
                ]
            },
            {
                featureType: 'transit',
                elementType: 'labels.icon',
                stylers: [{
                        visibility: 'off'
                    } // Hide the icons for transit stations
                ]
            },
            {
                featureType: 'transit',
                elementType: 'labels.text',
                stylers: [{
                        visibility: 'off'
                    } // Hide text labels for transit stations
                ]
            },
            {
                featureType: 'all',
                elementType: 'all',
                stylers: [{
                        saturation: -35
                    } // Adjust the saturation to make the map darker
                ]
            }
        ]
    });
    var customColoredMarkerIcon = {
        url: 'https://maps.google.com/mapfiles/ms/micons/green-dot.png',
        size: new google.maps.Size(31, 31),
        scaledSize: new google.maps.Size(35, 35)
    };

    var activeMarker = null;
    var activeCircle = null;
    var points = <?php echo $data['centers']; ?>;
    points.forEach((point) => {
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat(point.lat),
                lng: parseFloat(point.longi),

            },
            map: map,
            title: point.region,
            icon: customColoredMarkerIcon
        });
        var defaultRadius = parseFloat(point.radius);

        marker.addListener('click', function() {
            if (activeMarker) {
                activeMarker.setIcon(customColoredMarkerIcon);
            }

            if (activeCircle) {
                activeCircle.setMap(null);
            }

            activeMarker = marker;

            marker.setIcon({
                url: 'https://maps.google.com/mapfiles/ms/micons/green-dot.png',
                size: new google.maps.Size(31, 31),
                scaledSize: new google.maps.Size(35, 34)
            });

            activeCircle = new google.maps.Circle({
                map: map,
                center: marker.getPosition(),
                radius: defaultRadius,
                fillColor: '#008000',
                fillOpacity: 0.3,
                strokeColor: '#008000',
                strokeOpacity: 0.8,
                strokeWeight: 2
            });

            var infowindow = new google.maps.InfoWindow({
                content: point.region
            });
            infowindow.open(map, marker);
        });
    });
}
document.getElementById("profile_image_trigger").addEventListener("click", function() {
    document.getElementById("profile_image").click();
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>




<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Login-main">
   <main class="main">
            <div class="main-left">
            </div>
            <img class="login-image" src="<?php echo IMGROOT;?>/Login.png" alt="">
            <div class="main-right">
                <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="login-component">
                    <div class="image" style="background-image: url('<?php echo IMGROOT;?>/Logo.png');"></div>
                    <div class="login">Login</div>
                    <div class="slogan"> Sign into your account</div>
                    <div class="line"></div>
                    <div class="field">
                        <input type="text" name="email" placeholder="Email" id="" class="<?php echo (!empty($data['email_err'])) ? 'alert_empty' : ''; ?>" value="<?php echo $data['email']; ?>">          
                    </div> 
                    <div class="field-two">
                        <p><?php echo $data['email_err']?></p>
                    </div>
                                   
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" id="" class="<?php echo (!empty($data['password_err'])) ? 'alert_empty' : ''; ?>" value="<?php echo $data['password']; ?>">
                    </div> 
                    <div class="field-two">
                        <p><?php echo $data['password_err']?></p>
                    </div>
                                
                    <div class="forgot"><a href="<?php echo URLROOT?>/users/resetpassword">Forgot your password?</a></div>
                    <button class="login-button">Login</button>
                    <p>Don't have an account? <a href="<?php echo URLROOT?>/users/register"><b>Register</b></a></a></p>
                </div>
                </form>
            </div>

        </main>
</div>






public function login(){
      if(isset($_SESSION['user_id']) ||isset($_SESSION['collector_id'])|| isset($_SESSION['center_manager_id'])  || isset($_SESSION['admin_id']) || isset($_SESSION['agent_id']) ){
        if(isset($_SESSION['user_id'])){
          redirect('customers');
        }
        if(isset($_SESSION['collector_id'])){
          redirect('collectors');
        }
        if(isset($_SESSION['center_manager_id'])){
          redirect('centermanagers');
        }

        if(isset($_SESSION['admin_id'])||$_SESSION['super_admin_id']){
          redirect('admin');
        }

        if(isset($_SESSION['agent_id'])){
          redirect('CreditDiscountsAgent');
        }
      }
      else{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          // Init data
          $data =[
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',      
          ];
  
          // Validate Email
          if(empty($data['email'])){
            $data['email_err'] = 'Please enter email';
          }
          else {
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
              $data['email_err'] = 'Invalid email format';
           }
           else{
            if($this->userModel->findUserByEmail($data['email'])){
              // User found
            } else {
              // User not found
              $data['email_err'] = 'User not found';
            }
          }
          }
         
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Please enter the password';
          }

         
          // Make sure errors are empty
          if(empty($data['email_err']) && empty($data['password_err'])){
            // Validated
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);
            if($loggedInUser){
              if($loggedInUser->role=="customer"){
                $customer=$this->customerModel->get_customer($loggedInUser->id);
                if($customer->blocked==TRUE){
                      $data['email_err'] = 'Your Account has been Blocked Contact Our Team';
                      $this->view('users/login', $data);
                }
                else{
                  if($customer->image==''){
                    $_SESSION['customer_profile'] = "Profile.png";
                  }
                  else{
                    $_SESSION['customer_profile'] = $customer->image;
                  }
                  $this->createUserSession($loggedInUser); 
                
                } 
              }
              
              else if($loggedInUser->role=="collector"){
                $collector = $this->collectorModel->getCollectorById($loggedInUser->id);
                $_SESSION['center_id'] = $collector->center_id;
                $_SESSION['center'] = $collector->center_name;
                $_SESSION['collector_profile'] = $collector->image;
                $this->createCollectorSession($loggedInUser);
              }
              else if($loggedInUser->role=="centermanager"){
                $center_manager = $this->center_managerModel->getCenterManagerByID($loggedInUser->id);
                if($center_manager->assinged=='No'){
                  $data['email_err'] = 'You are not assigned';
                  $this->view('users/login', $data);
                }
                else{
                  $_SESSION['center_id'] = $center_manager->assigned_center_id;
                  $_SESSION['cm_profile'] = $center_manager->image;
                  $this->createCenterManagerSession($loggedInUser);
                }
                
              }
              else if($loggedInUser->role=="admin" || $loggedInUser->role=="superadmin"){
                $admin = $this->Admin_Model->getAdminByID($loggedInUser->id);
                $_SESSION['admin_profile'] = $admin->image;

                $this->createAdminSession($loggedInUser);
                
              }

             else if($loggedInUser->role=="discountagent"){
                $agent_by_id = $this->discount_agentModel->getDiscountAgentByID($loggedInUser->id);

                $this->createDiscountAgentSession($loggedInUser);
                $_SESSION['agent_profile'] = $agent_by_id->image;
              }
              
            } else {
              $data['password_err'] = 'Password incorrect';
  
              $this->view('users/login', $data);
            }
          } else {
            // Load view with errors
            $this->view('users/login', $data);
          }
        } else {
          // Init data
          $data =[    
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',        
          ];
          $this->view('users/login', $data);
        }
      }
     
    }
