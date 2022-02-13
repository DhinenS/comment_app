
<div class="wrapper fadeInDown">
    <?php if($this->session->flashdata('signup')){?>
            <div class="alert alert-success">      
                <?php echo $this->session->flashdata('signup')?>
            </div>
    <?php } ?>
    <div id="formContent">
        <div class="login-logo">
                <b>Sign In</b><br /><br />
                <span>Don't have an account?<span>&nbsp;<a href="<?php echo base_url('signup');?>">Sign Up</a>
        </div>
        <br />
      <div class="fadeIn first">
        
      </div>

      <!-- Login Form -->
      <form action="<?php echo base_url('signin'); ?>" method="post">
        <input type="email" id="signin_email" class="fadeIn second" name="signin_email" placeholder="email">
        <input type="password" id="signin_password" class="fadeIn third" name="signin_password" placeholder="password">
        <input type="submit" class="fadeIn fourth" value="Sign In">
         <?php 
            $signup_password_error = form_error('signin_password');
            $signup_email_error = form_error('signin_email');
            if( !empty($signup_email_error) || (!empty($signup_password_error)) ) {
                if(empty($signup_email_error)) {
                  echo "<div style='color:red;'>$signup_password_error</div>";
                } else {
                   echo "<div style='color:red;'>$signup_email_error</div>";
                }
            }
            if( !empty( $message) ) {
                echo "<div style='color:red;'>$message</div>";
            }
        ?>
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="<?php echo base_url('forgot');?>">Forgot Password?</a>
      </div>

    </div>
  </div>