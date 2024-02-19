<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_EditProfile">

        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <?php 
if(isset($_SESSION['admin_id'])){
    echo "Admin"; // added semicolon at the end of the statement
} else if(isset($_SESSION['superadmin_id'])){
    echo "superadmin"; // corrected syntax for else if
}
?>
            </div>

        </div>
    </div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>