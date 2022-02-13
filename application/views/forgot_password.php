<?php
if( !empty($user_id) ) {
    $hide_pass = 'display:""';
    $email = $email;
    $readonly = "pointer-events:none";
} else {
    $hide_pass = 'display:none';
    $email = '';
    $readonly = '';
}
?>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="login-logo">
                <b>Forgot Password</b><br /><br />
                
        </div>
        <br />
      <div class="fadeIn first">
        
      </div>

      <form action="<?php echo base_url('forgot')?>" method="post">
        <input type="email" id="forgot_email" class="fadeIn second" name="forgot_email" value="<?php echo $email ?>" placeholder="email" style="<?php echo $readonly ?>">
        <input type="password" id="forgot_password" class="fadeIn second" name="forgot_password" style="<?php echo $hide_pass;?>" placeholder="New password">
        <?php if( !empty($user_id) ) {?>
            <input type="type" value="<?php echo $user_id[0]['id']?>" name="user_id" style="display: none;"/>
        <?php } ?>
        <input type="submit" name="forgot_signin" class="fadeIn fourth" value="Sign In">
          <?php 
            $forgot_email_error = form_error('forgot_email');
            $forgot_password_error = form_error('forgot_password');
            if(!empty($forgot_email_error)) {
                echo "<div style='color:red;'>$forgot_email_error</div>";
            }
            if( !empty($forgot_password_error) && !empty($user_id)) {
                echo"<div style='color:red;'>$forgot_password_error</div>";
            }
            if( !empty( $message) ) {
                echo "<div style='color:red;'>$message</div>";
            }
        ?>
      </form>

    </div>
  </div>