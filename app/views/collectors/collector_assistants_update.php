<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="Collector_Main">
    <div class="Collector_assistants-add">
    <div class="main">
    <div class="main-left" style="background:  #8CF889">
        <div class="main-left-top">
            <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
            <h1>Eco Plus</h1>
        </div>
        <div class="main-left-middle">
            <a href="<?php echo URLROOT?>/Collectors">
                <div class="main-left-middle-content">
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
            <a href="<?php echo URLROOT?>/Collectors/logout">
               <div class="main-left-bottom-content">
                   <img src="<?php echo IMGROOT?>/logout.png" alt="">
                   <p>Log out</p>
                </div>
            </a>
        </div>
    </div>
    <div class="main-right">
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
                <a href="<?php echo URLROOT?>/collectors/collector_assistants">
                    <div class="main-right-top-three-content">
                        <p>View</p>
                        <div class="line1"></div>
                    </div>
                </a>
                <a href="">
                    <div class="main-right-top-three-content">
                        <p><b style="color: #1B6652;">Add</b></p>
                        <div class="line"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="main-right-bottom">
            <hr width="100%">
            <h1>UPDATE Collector Assistants</h1>
            
            <form class="main-right-bottom-content" action="<?php echo URLROOT;?>/collectors/collector_assistants_update/<?php echo $data['assistant_id'] ?>" method="post">
                <div class="main-right-bottom-content-content">
                    <h2>Name</h2>
                    <input type="text" name="name" value="<?php echo $data['name'];?>">
                    <div class="error-div">
                            <?php echo $data['name_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>NIC</h2>
                    <input type="text" name="nic" value=<?php echo $data['nic'];?>> 
                    <div class="error-div">
                            <?php echo $data['nic_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>Address</h2>
                    <input type="text" name="address" value="<?php echo $data['address']?>">
                    <div class="error-div">
                            <?php echo $data['address_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>Contact No</h2>
                    <input type="text" name="contact_no" value="<?php echo $data['contact_no']?>">
                    <div class="error-div">
                            <?php echo $data['contact_no_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>DOB</h2>
                    <input type="date" value="<?php echo $data['dob']?>" name="dob">
                    <div class="error-div">
                            <?php echo $data['dob_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content a">
                    <button type="submit">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
    <?php if($data['completed']=='True') : ?>
               <div class="complain-success">
                   <div class="complain-success-box">
                     <h1>Collector Assistant Updated Successful</h1>
                      <a href="<?php echo URLROOT?>/collectors/collector_assistants_update"><button>Okay</button></a>
                    </div>
               </div>
            <?php endif; ?>
</div>
</div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>