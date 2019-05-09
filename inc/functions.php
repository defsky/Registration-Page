<?php

function Register()
{
	if(isset($_POST['register']))
	{
		if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['re-password']))
		{
			function ValidateEmail($email)
			{
				if(filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					if(strlen($email) <= 255)
					{
						return true;
					}
					else
					{
						return false;
					}
				}

				return false;
			}

			function ValidateUsername($username)
			{
				if(strlen($username) <= 32)
				{
					if(ctype_alnum($username))
					{
						return true;
					}
					else
					{
						return false;
					}
				}

				return false;
			}

			function Captcha($secret, $captcha, $lastip)
			{
				$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $lastip);
				$decode   = json_decode($response, true);

				if(intval($decode['success']) == 1)
				{
					return true;
				}
				
				return false;
			}

			global $con;

			$username   = $_POST['username'];
			$email      = $_POST['email'];
			$password   = $_POST['password'];
			$repassword = $_POST['re-password'];
			//$captcha    = $_POST['g-recaptcha-response'];
			$captcha    = $_POST['captcha'];
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$secret     = CAPTCHA_SECRET;
			$expansion  = EXPANSION;

			if(ValidateUsername($username) && ValidateEmail($email))
			{
				$data = $con->prepare('SELECT COUNT(*) FROM account WHERE username = :username');// OR email = :email');
				$data->execute(array(
					':username' => $username
					//,':email'    => $email
				));

				if($data->fetchColumn() == 0)
				{
					//if(Captcha($secret, $captcha, $ip_address))
					if(strtolower($_SESSION["captcha"]) == strtolower($captcha))
					{
                        try {
                            $con->beginTransaction();
                          
                            $data = $con->prepare('INSERT INTO account (username, sha_pass_hash, email, last_ip, expansion)
                                            VALUES(:username, :password, :email, :ip, :expansion)');
                            $data->execute(array( ':username'  => strtoupper($username),
                                                  ':password'  => sha1(strtoupper($username) . ':' . strtoupper($password)),
                                                   ':email'     => $email,
                                                    ':ip'        => $ip_address,
                                                     ':expansion' => $expansion
                                                  ));
                           
                            //$data = $con->prepare('SELECT id FROM account WHERE username = :username');
                            //$data->execute(array(':username' => strtoupper($username)));
                            //$result = $data->fetchAll(PDO::FETCH_ASSOC);
                            //$userid = $result[0]['id'];
                           
                            //$data = $con->prepare('INSERT INTO account_billing_plan (id, PlanType, PlanTIme)
                            //                        VALUES(:id, :PlanType, :PlanTime)');
                            //$data->execute(array( ':id' => $userid,
                            //                      ':PlanType' => 16,
                            //                      ':PlanTime' => 120000));
                           
                            $con->commit();
                        } catch (Exception $e) {
                               $con->rollBack();
                        }

						echo '<div class="callout success">' . SUCCESS_MESSAGE . '</div>';
						echo '<div class="callout warning">' . REALMLIST . '</div>';
					}
					else
					{
						echo '<div class="callout alert">验证码错误!</div>';
					}
				}
				else
				{
					echo '<div class="callout alert">用户名已被注册!</div>';
				}
			}
			else
			{
				echo '<div class="callout alert">用户名或邮件地址的格式无效!</div>';
			}
		}
		else
		{
			echo '<div class="callout alert">所有栏目都不能留空!</div>';
		}
	}
}

?>
