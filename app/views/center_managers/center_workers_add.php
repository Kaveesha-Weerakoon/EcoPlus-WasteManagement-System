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
            <div class="main-right-bottom-content">
                <div class="main-right-bottom-content-content">
                    <h2>Name</h2>
                    <input type="text">
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>NIC</h2>
                    <input type="text">
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>Address</h2>
                    <input type="text">
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>Contact No</h2>
                    <input type="text">
                </div>
                <div class="main-right-bottom-content-content">
                    <h2>DOB</h2>
                    <input type="date">
                </div>
                <div class="main-right-bottom-content-content a">
                    <button>ADD</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
