<?php
define('CONFIG_DOMAIN_NAME','localhost');
$configurations = array(
    'db' => array(#mentioned DB username and password
        'username' => 'dhinesh',
        'password' => 'dhinesh@123'
    ),
);
define('SFND_CONFIGURATIONS',serialize($configurations));
define('ERROR_LOG_PATH','/home/dhinesh/public_html/comment_app/error_log_data/');
define('CI_APP_LOGS_PATH',ERROR_LOG_PATH.'comment_app_logs');

//Google Recaptcha keys (public key)
  define('RECAPTCHA_SECRET_KEY_PUBLIC','aaa');
  //Google Recaptcha private keys
  define('RECAPTCHA_SECRET_KEY_PRIVATE','aaa');
?>