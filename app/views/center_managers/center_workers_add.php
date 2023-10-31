<?php require APPROOT . '/views/inc/header.php'; ?>


<div class="Center_manager-addcenterworkers">
<div class="main">
    <div class="main-top">
        <a href="<?php echo URLROOT?>/centermanagers">
            <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
        </a>

        <div class="main-top-component">
            <p>Ananda Perera</p>
            <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
        </div>
    </div>
    <div class="main-bottom">
        <div class="main-bottom-top">
            <div class="main-right-top-two">
                <h1>Center Workers</h1>
            </div>
            <div class="main-right-top-three">
            <a href="<?php echo URLROOT?>/centermanagers/center_workers">
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
        <div class="main-bottom-down">
            <hr width="100%">
            <h1>Add Center Workers</h1>
            
            <form action="<?php echo URLROOT;?>/centermanagers/center_workers_add" class="main-right-bottom-content" method="post">
                <div class="main-right-bottom-content-content">
                    <h2>Name</h2>
                    <input name="name" type="text" value="<?php echo $data['name'];?>">
                    <div class="error-div">
                            <?php echo $data['name_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>NIC</h2>
                    <input name="nic" type="text" value=<?php echo $data['nic'];?>>
                    <div class="error-div">
                            <?php echo $data['nic_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>Address</h2>
                    <input name="address" type="text" value="<?php echo $data['address']?>">
                    <div class="error-div">
                            <?php echo $data['address_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>Contact No</h2>
                    <input name="contact_no" type="text" value="<?php echo $data['contact_no']?>">
                    <div class="error-div">
                            <?php echo $data['contact_no_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>DOB</h2>
                    <input name="dob" type="text" value="<?php echo $data['dob']?>">
                    <div class="error-div">
                            <?php echo $data['dob_err']?>
                    </div>
                </div>
                <div class="main-right-bottom-content-content a">
                    <button type="submit">ADD</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
