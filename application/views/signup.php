<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="login-logo">
                <b>Sign Up</b><br /><br />
                <span>Already have an account?<span>&nbsp;<a href="<?php echo base_url('signin');?>">Sign In</a>
        </div>
        <br />
      <div class="fadeIn first">
        
      </div>

      <!-- Login Form -->
      <form action="<?php echo base_url('signup'); ?>" method="post">
        <input type="email" id="login" class="fadeIn second" name="signup_email" placeholder="email">
        <input type="password" id="password" class="fadeIn third" name="signup_password" placeholder="password">
        <input type="text" id="secord_code" class="fadeIn fourth" name="signup_code"  placeholder="secert_code">
        <input type="submit" class="fadeIn fifth" value="Sign Up">
         <?php $signup_code_error = form_error('signup_code');
            $signup_password_error = form_error('signup_password');
            $signup_email_error = form_error('signup_email');
            if( !empty($signup_email_error) || (!empty($signup_password_error)) ) {
                if(empty($signup_email_error)) {
                  echo "<div style='color:red;'>$signup_password_error</div>";
                } else {
                   echo "<div style='color:red;'>$signup_email_error</div>";
                }
            } else {
                  echo "<div style='color:red;'>$signup_code_error</div>";
            }
            if( !empty( $message) ) {
                echo "<div style='color:red;'>$message</div>";
            }
        ?>
        
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="<?php echo base_url('signin/forgot_password');?>">Forgot Password?</a>
      </div>

    </div>
  </div>