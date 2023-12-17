<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Main_Collectors">
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
                        <h2>Complaints</h2>
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
                            <h1>Collectors</h1>
                        </div>
                    </div>
                    <div class="main-bottom-down">
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
                                    <td class="collector_image"><img
                                        src="<?php echo IMGROOT ?>/img_upload/collector/<?php echo $collector->image?>" alt=""></td>
                                    <td><?php echo $collector->name?></td>
                                    <td><?php echo $collector->email?></td>
                                    <td><img onclick="openpersonaldetails((<?php echo htmlspecialchars(json_encode($collector), ENT_QUOTES, 'UTF-8') ?>))"
                                     src="<?php echo IMGROOT?>/personal_details_icon.png" alt=""></td>
                                    <td><img onclick="openvehicledetails((<?php echo htmlspecialchars(json_encode($collector), ENT_QUOTES, 'UTF-8') ?>))"
                                     src="<?php echo IMGROOT?>/car.png" alt=""></td>
                                    <td><img onclick="opencolAssistantsdetails((<?php echo htmlspecialchars(json_encode($collector), ENT_QUOTES, 'UTF-8') ?>))"
                                     src="<?php echo IMGROOT?>/collector_assistants.png" alt=""></td>
                                </tr>   
                                <?php endforeach; ?>  
                            </table>            
                        </div>

                    </div>
                </div>

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

            <div class="collector-assis-details-popup-box" id="collector-assis-details-popup-box">
                <div class="collector-assis-details-popup-table">
                    <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="collector-assis-details-popup-table-close"
                        id="collector-assis-details-popup-table-close">
                    
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
                            <button type="button" id="collector-assis-details-popup-table-close1">Close</button>
                        </div>
                    </div>
                    
                </div>

            </div>
            
        </div>
    </div>


</div>

<script>
    function openvehicledetails(collector) {
        document.getElementById('vehicle-details-popup-box').style.display = "flex";
        document.getElementById('vehicle_collector_id').textContent = collector.user_id;
        document.getElementById('vehicle_collector_name').textContent = collector.name;
        document.getElementById('vehicle_collector_no').textContent = collector.vehicle_no;
        document.getElementById('vehicle_type').textContent = collector.vehicle_type;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var close_vehicledetail = document.getElementById('vehicle-details-popup-form-close');
        close_vehicledetail.addEventListener('click', function() {
            document.getElementById('vehicle-details-popup-box').style.display = "none";
        });
    });

    function openpersonaldetails(collector){
        document.getElementById('personal-details-popup-box').style.display = "flex";
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
            document.getElementById('personal-details-popup-box').style.display = "none";
            
        });
    });

    function opencolAssistantsdetails(){
        document.getElementById('collector-assis-details-popup-box').style.display = "flex";
    }


    document.addEventListener('DOMContentLoaded', function() {
        console.log("clicked");
        var close_colAssis_details = document.getElementById('collector-assis-details-popup-table-close');
        close_colAssis_details.addEventListener('click', function() {
            document.getElementById('collector-assis-details-popup-box').style.display = "none";
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        console.log("clicked");
        var close_colAssis_details = document.getElementById('collector-assis-details-popup-table-close1');
        close_colAssis_details.addEventListener('click', function() {
            document.getElementById('collector-assis-details-popup-box').style.display = "none";
        });
    });

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>