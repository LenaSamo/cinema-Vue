<!DOCTYPE html>
<html>
<head>
	<title>Регистрация</title>
	<meta charset = 'utf-8'>
	<link rel="stylesheet" type="text/css" href="css/formCss.css">
	<link rel='stylesheet'  href='./css/main.css'>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
<?php
        include("php/connection.php");
        include("header.php");
    ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
    <script src="script/jquery.maskedinput.min.js" type="text/javascript"></script> 
    <script> 
        $(function($){ 
            $.fn.setCursorPosition = function(pos) { 
            if ($(this).get(0).setSelectionRange) { 
                $(this).get(0).setSelectionRange(pos, pos); 
            } else if ($(this).get(0).createTextRange) { 
                var range = $(this).get(0).createTextRange(); 
                range.collapse(true); 
                range.moveEnd('character', pos); 
                range.moveStart('character', pos); 
                range.select(); 
            } 
            }; 
            $("#phone").click(function(){ 
                $(this).setCursorPosition(3); 
            }).mask("+7(999)999-99-99"); 
        }); 
    </script>
	<?php
		require_once('php/connection.php');
		session_start();
	?>

		<form  method="post" class="toComeIn_Register" name="RegisterForm">	
			<div class="Register" >
				<h2>Регистрация</h2>	
				<label for="login1">Логин:</label><br>
				<input  type="text" name="login1" id="login1" placeholder="Логин" required
				onclick="unblockreferences(RegisterForm)"
				value="<?php if (!empty($_POST['login1'])) echo $_POST['login1'];?>"
				><br>
				<div id="error_login"></div><br>

				<label for="email">Email:</label><br>
				<input type="email" name="email" id="email" placeholder="Email" required 
				onclick="unblockreferences(RegisterForm)"
				value="<?php if (!empty($_POST['email'])) echo $_POST['email'];?>">
				<div id="error_email"></div><br>

				<label for="phone">Телефон:</label><br>
				<input type="tel" name="phone" id="phone"  placeholder="Телефон" required 
				onclick="unblockreferences(RegisterForm)"
				value="<?php if (!empty($_POST['phone'])) echo $_POST['phone'];?>"><br>
				<div id="error_phone"></div><br>

				<label for="password1">Пароль:</label><br>
				<input type="password" name="password1" id="password1" placeholder="Пароль" required minlength="6" maxlength="15" 
				onclick="unblockreferences(RegisterForm)"
				value="<?php if (!empty($_POST['password1'])) echo $_POST['password1'];?>"><br>
				<div id="error_password1"></div><br>

				<label for="password2">Повторите пароль:</label><br>
				<input type="password" name="password2" id="password2" placeholder="Повторите пароль" required 
				onclick="unblockreferences(RegisterForm)"
				value="<?php if (!empty($_POST['password2'])) echo $_POST['password2'];?>"><br>
				<div id="error_password2"></div><br>

				<input type="checkbox" name="approval" id="approval" onclick="unblockreferences(RegisterForm)">
				<a href = "approval.php">Я даю согласие на обработку персональных данных</a><br>


				<div class="error" id="error_avt"></div><br>

				
				<input class="button" type="submit" id="Register_Person" name="Register_Person" value="Зарегистрироваться"  disabled><br>
				<a href = "autorization.php">Войти</a><br>

				<div class="uLogin" id="uLogin" data-ulogin="display=panel;theme=classic;fields=first_name,
				last_name;providers=vkontakte,odnoklassniki,mailru;hidden=other;
				redirect_uri=http%3A%2F%2F;mobilebuttons=0;">
					
				</div>	

	          	

			</div>  
			<?php	
			if(!empty($_POST['Register_Person']))
			{
				

				
				if(preg_match('/^[A-z][A-z0-9]{3,}$/', $_POST['login1']) 
				/*&& preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $_POST['phone'])*/
				&& preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])(?!.*\s).{6,}$/', $_POST['password1'])
				&& preg_match('/^([A-z0-9]+([\-\_.]?[A-z0-9]+)*)@([A-z]+\.[A-z]+)$/u', $_POST['email']))
				{

					date_default_timezone_set('Asia/Yekaterinburg');

					$login = mysqli_real_escape_string($mysqli, $_POST['login1']);
					$email = mysqli_real_escape_string($mysqli, $_POST['email']);
					$phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
					$password2 = password_hash($_POST['password1'], PASSWORD_DEFAULT);
					$date = date("y.m.d");
					$idRole = 1;
					$token = bin2hex(random_bytes(10));


					$sql_SELECT = "SELECT * FROM users WHERE `login` = ? OR email = ? OR phone = ?";
					$stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
					mysqli_stmt_bind_param($stmt_SELECT, 'sss', $login, $email, $phone);
					mysqli_stmt_execute($stmt_SELECT);

					$result = mysqli_stmt_get_result($stmt_SELECT);

					$user = $result->fetch_assoc();

					
					
					
					if(mysqli_num_rows($result))
					{
						?>
						<script type='text/javascript'>
							error_avt.innerHTML = 'Данный пользователь уже существует';
						</script>
						<?php
					}
					else{
						$sql_INSERT = "INSERT INTO `users` (`login`, `email`, `phone`, `password`, `dateOfReg`, `autToken`, `idRole`) VALUES (?, ?, ?, ?, ?, ?, ?)";
						$stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
						mysqli_stmt_bind_param($stmt_INSERT, 'ssssssi', $login, $email, $phone, $password2, $date, $token,  $idRole);
						mysqli_stmt_execute($stmt_INSERT);
						
						header ('Location: autorization.php');

						
					}
				
				}
				else {
					
					
					echo "<script>error_avt.innerHTML = 'Введите верно информацию.';</script>";
				}
			}
			?>
			

			
			

		</form>

	

        
<script src="//ulogin.ru/js/ulogin.js"></script>

		

	
		
	
	<script src="js/validation_of_registration.js"></script>
</body>
</html>
