<?php 
    if(empty($_GET['selector']) || empty($_GET['validator'])){
        echo 'Could not validate your request!';
    }else{
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];
        
        if(ctype_xdigit($selector) && ctype_xdigit($validator)) { ?>

<?php require APPROOT . '/views/inc/header.php'; ?>
    <h1 class="header">Enter New Password</h1>

    

    <form method="post" action="<?php echo URLROOT; ?>/ResetPassword/resetPassword">
        
        <input type="hidden" name="selector" value="<?php echo $selector ?>" />
        <input type="hidden" name="validator" value="<?php echo $validator ?>" />
        <div class="otp_err" name="otp_err" style="color: red;"></div>
        <input type="password" name="pwd" 
        placeholder="Enter a new password...">
        <div class="err" value="<?php echo $data['pwd_err']; ?>"></div>
        <input type="password" name="pwd_repeat" 
        placeholder="Repeat new password...">
        <div class="err" value="<?php echo $data['pwd_repeat_err']; ?>"></div>
        <button type="submit" name="submit">Submit</button>
    </form>

<?php require APPROOT . '/views/inc/footer.php'; ?>
            
<?php 
    }else{
        echo 'Could not validate your request!';
    }
}
?>
    