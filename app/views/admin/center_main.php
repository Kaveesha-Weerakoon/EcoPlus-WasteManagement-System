<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
  <div class="Admin_Center_Main">
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
            <a href="<?php echo URLROOT?>/admin/center">
              <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="" />
            </a>
            <div class="main-top-component">
              <p>Admin</p>
              <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="" />
            </div>
          </div>
          <div class="main-bottom">
            <div class="header-title-wrapper">
              <div class="header-title">
                <h1>Analytics</h1>
                <p>
                  Display analytics about center
                </p>
              </div>
              <div class="center-details-card">
                <img src="<?php echo IMGROOT?>/facility.png" alt="" />
                <div class="center-details-card-content">
                  <h2><?php echo $data['center']->region?></h2>
                  <p>Center ID: CEN<?php echo $data['center']->id?></p>
                </div>
              </div>
            </div>
    
            <div class="analytics-boxes">
              <h3 class="section-head">Overview</h3>
              <div class="analytics">
                <a href="<?php echo URLROOT?>/Admin/center_main_collectors/<?php echo $data['center']->id?>">
                  <div class="analytic">
                    <div class="analytic-icon">
                      <img src="<?php echo IMGROOT?>/blue_collector.png" class="icon-image" alt="" />
                    </div>
                    <div class="analytic-info">
                      <h4>Garbage Collectors</h4>
                      <h1><?php echo $data['no_of_collectors']?></h1>
                    </div>
                  </div>
                </a>
                
    
                <div class="analytic">
                  <div class="analytic-icon">
                    <img src="<?php echo IMGROOT?>/red_worker.png" class="icon-image" alt="" />
                  </div>
                  <div class="analytic-info">
                    <h4>Center workers</h4>
                    <h1>20</h1>
                  </div>
                </div>
    
                <div class="analytic">
                  <div class="analytic-icon">
                    <img src="<?php echo IMGROOT?>/green_requests.png" class="icon-image" alt="" />
                  </div>
                  <div class="analytic-info">
                    <h4>Total Requests</h4>
                    <h1>50</h1>
                  </div>
                </div>
    
                <div class="analytic">
                  <div class="analytic-icon">
                    <img src="<?php echo IMGROOT?>/brown_bin.png" class="icon-image" alt="" />
                  </div>
                  <div class="analytic-info">
                    <h4>Garbage Stock</h4>
                    <h1>20.7 <small>kg</small></h1>
                  </div>
                </div>
              </div>
            </div>
    
            <div class="details-cards">
              <div class="details-cards-right">
                <div class="center-manager-card">
                  <h3 class="section-subhead">Center Manager</h3>
                  <div class="center-manager-content">
                    <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="" />
                    <div class="center-manager-info">
                      <h3><?php echo $data['center']->center_manager_name?></h3>
                      <h1>Manager ID: CM<?php echo $data['center']->center_manager_id?></h1>
                    </div>
                    <div class="center-manager-change">
                      <a href="<?php echo URLROOT?>/admin/center_main_change_cm/<?php echo $data['center']->id?>">
                        <button>Change</button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details-cards-left">
                <div class="graph-card">
                  <h3 class="section-subhead">Requests Statistics</h3>
                  <div class="graph-container">
                    <div class="donut-chart-block">
                      <div class="donut-chart">
                        <div id="part1" class="portion-block">
                          <div class="circle"></div>
                        </div>
                        <div id="part2" class="portion-block">
                          <div class="circle"></div>
                        </div>
                        <div id="part3" class="portion-block">
                          <div class="circle"></div>
                        </div>
                        <div id="part4" class="portion-block">
                          <div class="circle"></div>
                        </div>
                        <p class="donut-chart-center"></p>
                      </div>
                    </div>
                    <div class="donut-chart-details">
                      <ul class="donut-chart-details-list">
                        <li class="incoming">
                          <hr />
                          incoming
                        </li>
                        <li class="assigned">
                          <hr />
                          assigned
                        </li>
                        <li class="completed">
                          <hr />
                          completed
                        </li>
                        <li class="cancelled">
                          <hr />
                          cancelled
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="location-map-card">
                  <h3 class="section-subhead">Center Location</h3>
                  <div class="center-map-container">
                    <img src="<?php echo IMGROOT?>/center-location.png" alt="">
                  </div>
                
                </div>
    
              </div>
              
            </div>
          </div>

      </div>

        <!-- <div class="main-top">
            <div class="main-top-top">
                <a href="<?php echo URLROOT?>/admin/center">
                    <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                </a>

                <div class="main-top-top-component">
                    <p>Admin</p>
                    <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                </div>
            </div>
            <div class="main-top-bottom">
                <div class="main-bottom-left">
                    <img src="<?php echo IMGROOT?>/Admin_Center.png" alt="">
                    <div class="main-bottom-left-component">
                        <p>CEN<?php echo $data['center']->id?></p>
                        <h4><?php echo $data['center']->region?></h4>
                    </div>            
                </div>
                <div class="main-bottom-right">
                    <img src="<?php echo IMGROOT?>/center_manager.png" alt="">
                    <div class="main-bottom-right-component">
                        <p>CM <?php echo $data['center']->center_manager_id?></p>
                        <h4><?php echo $data['center']->center_manager_name?></h4>
                    </div>
                    <a href="<?php echo URLROOT?>/admin/center_main_change_cm/<?php echo $data['center']->id?> ">
                    <button class="main-bottom-right_button">
                        Change
                    </button>
                    </a>    
                </div>
            </div>
        </div> -->
   </div>
   <?php if($data['change_cm']=='True') : ?>
   <div class="change_center_manager_pop">
    <div class="change_center_manager">
        <form action="<?php echo URLROOT;?>/admin/center_main_change_cm/<?php echo $data['center']->id?>" method="post">
            <label for="centerManager">Selelct Center Manager</label>
            <select name="centerManager" id="centerManager">
                <?php
                $centerManagers = $data['not_assigned_cm'];
                if (!empty($centerManagers)) {
                    foreach ($centerManagers as $manager) {
                        echo "<option value=\"$manager->id\">CM $manager->id</option>";
                    }
                } else {
                    echo "<option value=\"default\">No Center Managers Available</option>";
                }
                ?>
            </select>
            <button type="submit">Change Center Manager</button>
            <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>"><button type="button" class="cancel">Cancel</button></a>
        </form>
    </div>
   </div>
   <?php endif; ?>
  </div>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
