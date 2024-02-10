<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="ResetPassword-main">
<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="ResetPassword-main">
  <div class="form-gap"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <h3><i class="fas fa-lock"></i></h3>
              <h5 class="text-center">Forgot Password?</h5>
              <p>You can reset your password here.</p>
              <div class="panel-body">
                 <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                    <div class="form-group input-container">
                      <i class="fas fa-envelope icon"></i>
                      <div class="input-group">
                        <input id="email" name="email" placeholder="Email address" class="form-control" type="email" value="<?php echo $data['email']; ?>">
                      </div>
                    </div>

                    <div class="error-div" style="color:red">
                      <?php echo $data['email_err']?>
                    </div>

                    <div class="form-group">
                      <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                    </div>

                    <input type="hidden" class="hide" name="token" id="token" value="">
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>