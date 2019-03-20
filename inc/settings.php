<?php

$config = array(
    'HOST' => '6530b',
    'USER' => 'root',
    'PASS' => 'mysql',
    'DB'   => 'realm',
    'CORE' => ''
);


// General Settings
define('EXPANSION', 2); // 1 = Vanilla / 2 = TBC / 3 = WOTLK
define('REALMLIST', 'set realmlist login.afkplayer.com');

// Google ReCaptcha Settings
define('CAPTCHA_SECRET', '');
define('CAPTCHA_CLIENT_ID', '');

// Message Settings
define('SUCCESS_MESSAGE', '注册成功!');

?>
