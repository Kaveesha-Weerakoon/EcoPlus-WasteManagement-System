<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="ResetPassword-main">

  <div class="container">
    <img src="<?php echo IMGROOT;?>/undraw_secure_files_re_6vdh.svg" class="image" alt="">

      <div class="forms-container">
          <div class="signin-signup">
              <form action="<?php echo URLROOT; ?>/ResetPassword/sendEmail" class="sign-in-form" method="POST">

                  <div class="top"> <img src="<?php echo IMGROOT;?>/Logo.png" alt="">
                      <h2>Forgot Your Password ?</h2>
                  </div>
                  <div class="slogan">Reset Your Password</div>
                  <div class="line"></div>

                  <div class="input-field-container">
                  <p>Email : </p>
                      <div class="input-fieldlog">
                      <i class="fas fa-envelope icon"></i>
                          <input id="email" name="email" placeholder="Email address" class="form-control" type="email" value="<?php echo $data['email']; ?>">
                      </div>
                      <div class="errlog" style="color:red">
                        <?php echo $data['email_err']?>
                      </div>
                  </div>
                  <!-- <input name="recover-submit" class="btn solid" value="Reset Password" type="submit"> -->
                  <button type="submit" name="get_email_button" class="btn solid">Recieve Email</button>

              </form>

            

          </div>
      </div>
  </div>
</div>

<!--<div class="ResetPassword-main">
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


</div>-->


<?php require APPROOT . '/views/inc/footer.php'; ?>