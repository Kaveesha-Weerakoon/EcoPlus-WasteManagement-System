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
                        <?php foreach($data['collector_assistants'] as $collector_assistant) : ?>
                                       <tr class="table-row">
                                           <td><?php echo $collector_assistant->name?></td>
                                           <td><?php echo $collector_assistant->nic?></td>
                                           <td><?php echo $collector_assistant->address?></td>
                                           <td> <?php echo $collector_assistant->contact_no?></td>
                                           <td> <?php echo $collector_assistant->dob?></td>
                                           <td class="cancel-open"><a href="<?php echo URLROOT?>/Collectors/collector_assistants_update/<?php echo $collector_assistant->id ?>"><img src="<?php echo IMGROOT?>/update.png" alt=""></td>
                                           <td class="cancel-open"><a href="<?php echo URLROOT?>/Collectors/collector_assistants_delete_confirm/<?php echo $collector_assistant->id ?>"><img src="<?php echo IMGROOT?>/delete.png" alt=""></a></td>
                                    </tr>
                             <?php endforeach; ?>

                    </div>
                </div>
            </div>     
      </div>
      <?php if($data['confirm_delete']=='True') : ?>
      <div class="delete_confirm">
              <div class="popup" id="popup">
                 <img src="<?php echo IMGROOT?>/trash.png" alt="">
                 <h2>Delete this assistant?</h2>
                 <p>This action will permanently delete this record</p>
                 <div class="btns">
                     <a href="<?php echo URLROOT?>/Collectors/collector_assistants_delete/<?php echo $data['collector_assistant_id'] ?>"><button type="button" class="deletebtn" >Delete</button></a>
                     <a href="<?php echo URLROOT?>/Collectors/collector_assistants?>"><button type="button" class="cancelbtn" onClick="closePopup()">Cancel</button></a>
                  </div>
               </div>
       </div>
       <?php endif; ?>
    </div>               
</div>





<?php require APPROOT . '/views/inc/footer.php'; ?>
