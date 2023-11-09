<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
   <div class="Collector_assistants-main">
      <div class="main">
            <div class="main-left" style="background: #8CF889">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="<?php echo URLROOT?>/collectors">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Home.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-left-middle-content Collector current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/CollectorAssis.png" alt="">
                            <h2>Collector Assistants</h2>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>

                </div>
                <div class="main-left-bottom">  
                  <a href="<?php echo URLROOT?>/collectors/logout" class="logout_anchor">
                    <div class="main-left-bottom-content">             
                         <img src="<?php echo IMGROOT?>/logout.png" alt="">
                         <p>Log out</p>                 
                    </div>
                   </a>
                </div>
            </div>
            <div class="main-right" style="background: white;">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <img src="<?php echo IMGROOT?>/Search.png" alt="">
                        <input type="text" placeholder="Search">
                        <div class="main-right-top-one-content">
                           <p><?php echo $_SESSION['collector_name']?></p>
                           <img src="<?php echo IMGROOT?>/Profile2.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Collector Assistants</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">View</b></p>
                                <div class="line"></div>
                            </div>
                       </a>
                        <a href="<?php echo URLROOT?>/collectors/collector_assistants_add">
                            <div class="main-right-top-three-content">
                                <p>Add</p>
                                <div class="line1"></div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top " style="background: white;">
                        <table class="table" style="background: white;">
                            <tr class="table-header" style="background-color: #B9FFB7">
                                <th>Name</th>
                                <th>NIC</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>DOB</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                        <?php foreach($data['collector_assistants'] as $post) : ?>
                                       <tr class="table-row">
                                           <td>CM <?php echo $post->name?></td>
                                           <td><?php echo $post->nic?></td>
                                           <td><?php echo $post->address?></td>
                                           <td> <?php echo $post->contact_no?></td>
                                           <td> <?php echo $post->dob?></td>
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                           <td class="cancel-open"><img src="<?php echo IMGROOT?>/delete.png" alt=""></td>
                                    </tr>
                             <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <!-- <div class="cancel-confirm" id="cancel-confirm">
                <div class="cancel-confirm-content">
                    <h1>Delete Collector Assistant?</h1>
                    <div class="confim-cancell-content-box">
                        <button id="cancel-pop" style="background-color: tomato;">OK</button>
                        <button id="okay">CANCEL </button>
                    </div>
                </div>
            </div> -->
            <!-- <script src="./Collector_CollectorAssistants.js"></script> -->
        </div>
   </div>               
</div>





<?php require APPROOT . '/views/inc/footer.php'; ?>
