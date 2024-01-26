<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Main_Collectors">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>
           

            <div class="main-right">
                <div class="main-right-top">
                    <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                    <div class="main-right-top-back-button">
                        <i class='bx bxs-chevrons-left'></i>
                    </div>
                    </a>
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
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

                <!-- <div class="main-top">
                    <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                        <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                    </a>

                    <div class="main-top-component">
                        <p>Admin</p>
                        <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                    </div>
                </div>
               
                <div class="main-bottom-top">
                    <div class="main-right-top-two">
                        <h1>Collectors</h1>
                    </div>
                </div> -->

                <?php if(!empty($data['collectors_in_center'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Collectors</h1>
                    </div>
                    <div class="main-right-bottom-top ">
                        <table class="table">
                            <tr class="table-header">
                                <th>Collector ID</th>
                                <th>Profile Pic</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Personal details</th>
                                <th>Vehicle details</th>
                                <th>Collector Assitants</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                        <?php foreach($data['collectors_in_center'] as $collector) : ?>
                            <tr class="table-row">
                                <td>C<?php echo $collector->id?></td>
                                <td><img
                                    src="<?php echo IMGROOT ?>/img_upload/collector/<?php echo $collector->image?>" alt="" class="collector_img"></td>
                                <td><?php echo $collector->name?></td>
                                <td><?php echo $collector->email?></td>
                                <td><i onclick="openpersonaldetails((<?php echo htmlspecialchars(json_encode($collector), ENT_QUOTES, 'UTF-8') ?>))"
                                     class='bx bxs-user' style="font-size: 29px;"></i></td>
            
                                <td><i onclick="openvehicledetails((<?php echo htmlspecialchars(json_encode($collector), ENT_QUOTES, 'UTF-8') ?>))"
                                    class='bx bxs-truck' style="font-size: 29px;"></i></td>
                                
                                <td><i onclick="opencolAssistantsdetails((<?php echo htmlspecialchars(json_encode($collector), ENT_QUOTES, 'UTF-8') ?>))"
                                    class='bx bxs-group' style="font-size: 29px;"></i></td>
                            </tr>   
                            <?php endforeach; ?>  
                        </table>            
                    </div>

                </div>
                <?php else: ?>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-content">
                            <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                            <h1>There are no collectors in the center</h1>
                            <p>All the collectors will appear here</p>
                        </div>
                    </div>
                <?php endif; ?>

            

            </div>

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

            <div class="vehicle-details-popup-box" id="vehicle-details-popup-box">
                <div class="vehicle-details-popup-form">
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="vehicle-details-popup-form-close"
                        id="vehicle-details-popup-form-close">
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
                            <span id="vehicle_collector_id">C</span><br>
                            <span id="vehicle_collector_name"></span><br>
                            <span id="vehicle_collector_no"></span><br>
                            <span id="vehicle_type"></span><br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overlay" id="overlay"></div>

            <div class="collector-assis-details-popup-box" id="collector-assis-details-popup-box">
                <div class="collector-assis-details-popup-table">
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="collector-assis-details-popup-table-close">
                       
                    
                    <div class="popup-table-container">
                        <div class="popup-table-caption">
                            <h2>Collector Assistants</h2>
                        </div>
                        <div class="popup-table-container-down">
                            <div class="collector-assis-table-top">
                                <table class="popup-table">
                                    <tr class="popup-table-header">
                                        <th>Name</th>
                                        <th>NIC</th>
                                        <th>Address</th>
                                        <th>Contact No</th>
                                        <th>Date of Birth</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="collector-assis-table-down">
                                <table class="popup-table">
                                    <tr class="popup-table-row">
                                        <td>Dinithi</td>
                                        <td>200123453456</td>
                                        <td>kelaniya</td>
                                        <td>0712223344</td>
                                        <td>2001-03-26</td>
                                            
                                    </tr>  
                                </table>
                            </div>
                        </div>
                        <div class="popup-table-container-bottom">
                            <button type="button" class="collector-assis-details-popup-table-close" >Close</button>
                        </div>
                    </div>
                    
                </div>

            </div>
            
        </div>
    </div>


</div>

<script>
    function openvehicledetails(collector) {
        var vehiclePop = document.getElementById('vehicle-details-popup-box');
        vehiclePop.classList.add('active');
        document.getElementById('overlay').style.display = "flex";
       
        document.getElementById('vehicle_collector_id').textContent = collector.user_id;
        document.getElementById('vehicle_collector_name').textContent = collector.name;
        document.getElementById('vehicle_collector_no').textContent = collector.vehicle_no;
        document.getElementById('vehicle_type').textContent = collector.vehicle_type;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var close_vehicledetail = document.getElementById('vehicle-details-popup-form-close');
        close_vehicledetail.addEventListener('click', function() {
            const vehicle_details = document.getElementById("vehicle-details-popup-box");
            vehicle_details.classList.remove('active');
            document.getElementById('overlay').style.display = "none";
            
        });
    });

    function openpersonaldetails(collector){
        var personalPop = document.getElementById('personal-details-popup-box');
        personalPop.classList.add('active');
        document.getElementById('overlay').style.display = "flex";
       
        document.getElementById('collector_id').textContent =collector.user_id;
        document.getElementById('collector_profile_pic').src =  "<?php echo IMGROOT?>/img_upload/collector/" + collector.image;
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

    function opencolAssistantsdetails(){
        // document.getElementById('collector-assis-details-popup-box').style.display = "flex";
        var assistantPop = document.getElementById('collector-assis-details-popup-box');
        assistantPop.classList.add('active');
        document.getElementById('overlay').style.display = "flex";
    }


    document.addEventListener('DOMContentLoaded', function() {
    var closeButtons = document.querySelectorAll('.collector-assis-details-popup-table-close');

    closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const assisDetails = document.getElementById('collector-assis-details-popup-box');
            assisDetails.classList.remove('active');
            document.getElementById('overlay').style.display = "none";
        });
    });
});


</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>