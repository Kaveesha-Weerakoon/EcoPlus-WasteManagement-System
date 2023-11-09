<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Request_collect">
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

      <div class="main-bottom">
        <div class="main-bottom-content-bottom-component-img">
          <img src="<?php echo IMGROOT?>/Home_Middle-Image.png" alt="" />
        </div>
        <div class="main-bottom-wrap">
          <div class="main-bottom-content">
            <h1>Request Garbage Collection Service</h1>
            <div class="line-container">
              <div class="line"></div>
            </div>

            <div class="main-bottom-content-top">
              <label>
                <input type="radio" name="language" value="java" />
                Collection Service
              </label>
              <label>
                <input type="radio" name="language" value="java" />
                Cleanup Event
              </label>
            </div>
            <div class="main-bottom-content-bottom">
              <div class="main-bottom-content-bottom-component">
                <p>Name</p>
                <input type="text" />
              </div>
              <div class="main-bottom-content-bottom-component">
                <p>Date</p>
                <input type="date" />
              </div>
              <div class="main-bottom-content-bottom-component">
                <p>Region</p>
                <input type="text" id="searchInput" placeholder="Search...">
                <ul id="searchResults"></ul>

              </div>
              <div class="main-bottom-content-bottom-component">
                <p>Contact Number</p>
                <input type="text" />
              </div>

              <div class="main-bottom-content-bottom-component">
                <p>Time</p>
                <input type="time" />
              </div>
              <div class="main-bottom-content-bottom-component">
                <p>Pick up Location</p>
                <input type="text" />
              </div>
              <div class="main-bottom-content-bottom-component B">
                <p>Description</p>
                <input class="a" type="text" />
              </div>
              <div class="main-bottom-content-bottom-component">
                <button>Request</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
</div>


    <?php require APPROOT . '/views/inc/footer.php'; ?>
