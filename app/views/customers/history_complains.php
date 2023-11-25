<?php require APPROOT . '/views/inc/header.php'; ?>



<div class="Customer_Main">
   <div class="Customer_History_Top">
       <div class="Customer_Complain_History">

          <div class="main">
            <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
               
                    <a href="<?php echo URLROOT?>/customers">
                        <div class="main-left-middle-content ">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_DashBoard_Icon.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/customers/request_main">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    </a>
                    
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Customer_tracking _Icon.png" alt="">
                            <h2>History</h2>
                        </div>
                   
                    <a href="<?php echo URLROOT?>/customers/editprofile">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_Edit_Pro_Icon.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>
                </div>
                <div class="main-left-bottom">
                    <a href="<?php echo URLROOT?>/customers/logout">
                        <div class="main-left-bottom-content">
                            <img src="<?php echo IMGROOT?>/Logout.png" alt="">
                            <p>Log out</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-one-search">
                           <img src="<?php echo IMGROOT?>/Search.png" alt="">
                           <input id="complaintSearch" type="text" placeholder="Search">
                        </div>
                        <div class="main-right-top-one-content">
                            <p><?php echo $_SESSION['user_name']?></p>
                            <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>History</h1>
                    </div>
                    <div class="main-right-top-three">
                       <a href="<?php echo URLROOT?>/customers/history">
                        <div class="main-right-top-three-content">
                            <p>Discounts History</p>
                            <div class="line1"></div>
                        </div>
                        </a>
                        <a href="">
                          <div class="main-right-top-three-content">
                            <p><b style="color: #1B6652;">Complaints History</b></p>
                            <div class="line"></div>
                        </div>
                        
                        <a href="<?php echo URLROOT?>/customers/transfer_history">
                           <div class="main-right-top-three-content">
                              <p>Transfer History</p>
                              <div class="line1"></div>
                            </div>
                        </a>
                     </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-container">
                        <div class="main-right-bottom-container-top">
                            <div class="circle"></div>
                            <h4>Complaints</h4>
                        </div>
                        <div class="main-right-bottom-container-container">
                            <div class="main-right-bottom-top">
                                <table class="table">
                                    <tr class="table-header">
                                        <th>Complaint ID</th>
                                        <th>Date & Time</th>
                                        <th>Subject</th>
                                        <th>Complain</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="main-right-bottom-down">
                                <table class="table">
                                   <?php foreach($data['complains'] as $post) : ?>
                                       <tr class="table-row">
                                           <td>Com <?php echo $post->id?></td>
                                           <td><?php echo $post->date?></td>
                                           <td><?php echo $post->subject?></td>
                                           <td><?php echo $post->complaint?></td>
                                    </tr>
                                  <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <script>
              function searchComplaints() {
                   var input = document.getElementById('complaintSearch').value.toLowerCase();
                   var rows = document.querySelectorAll('.table-row');

                   rows.forEach(function(row) {
                   var id = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                   var date = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                   var subject = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
                   var complaint = row.querySelector('td:nth-child(4)').innerText.toLowerCase();

                   if (id.includes(input) || date.includes(input) || subject.includes(input) || complaint.includes(input)) {
                        row.style.display = '';  
                   } else {
                     row.style.display = 'none';  // Hide the row
                    }
                  });
               }

                 document.getElementById('complaintSearch').addEventListener('input', searchComplaints);
            </script>
        </div>
     </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
