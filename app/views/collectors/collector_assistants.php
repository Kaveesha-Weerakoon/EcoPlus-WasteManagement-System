<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
    <div class="Collector_assistants-main">
        <div class="main">
            <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
                        </div>
                        <?php require APPROOT . '/views/collectors/collector_notification/collector_notification.php'; ?>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Collector Assistants</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color:#1ca557;">View</b></p>
                                <div class="line" style="background-color: #1ca557;"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/collectors/collector_assistants_add">
                            <div class="main-right-top-three-content">
                                <p>Register</p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
                </div>
                <?php if(!empty($data['collector_assistants'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top ">
                        <table class="table">
                            <tr class="table-header">
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
                                <td class="cancel-open" id="update"><a
                                        href="<?php echo URLROOT?>/Collectors/collector_assistants_update/<?php echo $collector_assistant->id ?>">
                                        <i class='bx bx-refresh' style="font-size:30px; "></i> </td>
                                <td class="cancel-open"><a
                                        href="<?php echo URLROOT?>/Collectors/collector_assistants_delete_confirm/<?php echo $collector_assistant->id ?>">
                                        <i class='bx bxs-trash' style="font-size:29px"></i></a></td>
                            </tr>
                            <?php endforeach; ?>

                    </div>
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                    <img src="<?php echo IMGROOT?>/undraw_questions_re_1fy7.svg" alt="">
                        <h1>There are no collector assistants available</h1>
                        <p>Register a collector assistant now!</p>
                        <a href="<?php echo URLROOT?>/collectors/collector_assistants_add"><button>Register</button></a>

                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="overlay" id="overlay">

        </div>
        <?php if($data['confirm_delete']=='True') : ?>
        <div class="delete_confirm" id="delete_confirm">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/trash.png" alt="">
                <h2>Delete this collector assistant?</h2>
                <p>This action will permanently delete this collector assistant</p>
                <div class="btns">
                    <a
                        href="<?php echo URLROOT?>/Collectors/collector_assistants_delete/<?php echo $data['collector_assistant_id'] ?>"><button
                            type="button" class="deletebtn">Delete</button></a>
                    <a href="<?php echo URLROOT?>/Collectors/collector_assistants?>"><button type="button"
                            class="cancelbtn">Cancel</button></a>
                </div>
            </div>
        </div>
        <?php endif; ?>


        <?php if($data['confirm_update']=='True') : ?>
        <div class="update_click" id="update_click">
            <div class="popup-form" id="popup">
                <a href="<?php echo URLROOT?>/Collectors/collector_assistants/"><img
                        src="<?php echo IMGROOT?>/close_popup.png" class="update-popup-img" alt=""></a>
                <h2>Update Details</h2>
                <center>
                    <div class="update-topic-line"></div>
                </center>
                <form class="updatePopupform" method="post"
                    action="<?php echo URLROOT;?>/Collectors/collector_assistants_update/<?php echo $data['id'];?>">
                
                        <div class="updateData A">
                            <label>Name</label><br>
                            <input type="text" name="name" placeholder="Enter name"
                                value="<?php echo $data['name']; ?>"><br>
                            <div class="error-div" style="color:red">
                                <?php echo $data['name_err']?>
                            </div>
                        </div>
                        <div class="updateData">
                            <label>NIC</label><br>
                            <input type="text" name="nic" placeholder="Enter NIC"
                                value="<?php echo $data['nic']; ?>"><br>
                            <div class="error-div" style="color:red">
                                <?php echo $data['nic_err']?>
                            </div>
                        </div>
                        <div class="updateData">
                            <label>Address</label><br>
                            <input type="text" name="address" placeholder="Enter Address"
                                value="<?php echo $data['address']; ?>"><br>
                            <div class="error-div" style="color:red">
                                <?php echo $data['address_err']?>
                            </div>
                        </div>
                        <div class="updateData">
                            <label>Contact No</label><br>
                            <input type="text" name="contact_no" placeholder="Enter Contact No"
                                value="<?php echo $data['contact_no']; ?>"><br>
                            <div class="error-div" style="color:red">
                                <?php echo $data['contact_no_err']?>
                            </div>
                        </div>
                        <div class="updateData B">
                            <label>DOB</label><br>
                            <input type="date" name="dob" placeholder="Enter DOB"
                                value="<?php echo $data['dob']; ?>"><br>
                            <div class="error-div" style="color:red">
                                <?php echo $data['dob_err']?>
                            </div>
                        </div>

                        <div class="btns1">
                            <a href=""><button type="submit" class="updatebtn">Update</button></a>
                            <a href="<?php echo URLROOT?>/collectors/collector_assistants"><button type="button"
                                    class="cancelbtn1">Cancel</button></a>
                        </div>

                        <div>

                </form>

            </div>

        </div>

        <?php endif; ?>

        <?php if($data['update_success']=='True') : ?>
        <div class="collector_ass_update_success">
            <div class="popup1" id="popup1">
                <img src="<?php echo IMGROOT?>/check.png" alt="">
                <h2>Success!!</h2>
                <p>Collector Assistant details has been updated successfully</p>
                <a href="<?php echo URLROOT?>/collectors/collector_assistants"><button type="button">OK</button></a>

            </div>
        </div>
        <?php endif; ?>

        <?php if($data['delete_success']=='True') : ?>
        <div class="collector_ass_update_success">
            <div class="popup1" id="popup1">
                <img src="<?php echo IMGROOT?>/check.png" alt="">
                <h2>Success!!</h2>
                <p>Collector Assistant has been deleted successfully</p>
                <a href="<?php echo URLROOT?>/collectors/collector_assistants"><button type="button">OK</button></a>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<script>

    /* Notification View */
document.getElementById('submit-notification').onclick = function() {
    var form = document.getElementById('mark_as_read');
    var dynamicUrl = "<?php echo URLROOT;?>/collector/view_notification/collector_assistants";
    form.action = dynamicUrl; // Set the action URL
    form.submit(); // Submit the form

};

document.addEventListener('DOMContentLoaded', function() {
    const element = document.getElementById('update_click');
    const overlay = document.getElementById('overlay');
    const delete_confirm = document.getElementById('delete_confirm');

    if (element) {
        element.classList.add('active');
        overlay.style.display = "flex";

    }

    if (delete_confirm) {
        delete_confirm.classList.add('active');
        overlay.style.display = "flex";
    }
});
</script>




<?php require APPROOT . '/views/inc/footer.php'; ?>