<?php

include('inc/db.php');
include('inc/functions.php');

session_start();

?>
<html>
<head>
	<title>帐号注册</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- CSS Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/foundation.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/content.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/fonts.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/colors.css" media="screen" />
</head>
<body>

<div class="row">
	<div class="content">
		<div class="content-logo">
			时光<span class="orange">之穴</span>
		</div>

		<div class="content-box">
			<div class="content-box-content">
				<form method="POST">
					<label class="orange">用户名</label>
					<input type="text" name="username" />

					<label class="orange">邮箱</label>
					<input type="text" name="email" />

					<label class="orange">密码</label>
					<input type="password" name="password" />

					<label class="orange">确认密码</label>
					<input type="password" name="re-password" />
					
                    <label class="orange">验证码</label>
					<input type="text" name="captcha" placeholder="请输入图片中的验证码"/>
					
					<center>
						<!--<div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_CLIENT_ID; ?>"></div>
						<br>-->
						<img src="getCaptcha.php"  onclick="this.src='getCaptcha.php?'+new Date().getTime();" width="200" height="200"><br/>
						<br>
						<input type="submit" name="register" class="small button" value="注册" />
					</center>
				</form>
			</div>
		</div>

		<div class="response">
			<?php Register(); ?>
		</div>
	</div>
</div>

<!-- Javascript Files -->
<script type="text/javascript" src="js/vendor/jquery.js"></script>
<script type="text/javascript" src="js/vendor/what-input.js"></script>
<script type="text/javascript" src="js/vendor/foundation.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<!-- <script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script> -->
</body>
</html>
