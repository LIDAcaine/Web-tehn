<?php
$mysql = mysqli_connect("localhost", "root", "", "test");
if (!$mysql)die("Error connect to database!");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Аутификация</title>
    <style>
        BODY {
            background: url(background.jpg) no-repeat 0px 0px; /* Параметры фона */
            background-size: 100%;
        }
        .content{
            margin-top: 30px;
            margin-left: 25%;
            width: 50%;
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .reg{
            padding: 0 20px 20px 20px;
            background: #FFB6C1; /* Цвет фона */
            opacity: 90%;   /* Прозрачность */
            border-radius: 20px;
            text-align: center;
            color: #800000;
        }
        .auth{
            padding: 0 20px 20px 20px;
            background: #FFB6C1; /* Цвет фона */
            opacity: 90%;   /* Прозрачность */
            border-radius: 20px;
            text-align: center;
            color: #800000;
        }
    </style>
</head>
<body>
    
    <div class="content">
        <div class="auth">
            <h1>Авторизация администратора:</h1>
            <form method="post">
                <label for="login">Логин:</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Введите данные" required><br><br>

                <label for="pass">Пароль:</label>
                <input type="password" id="pass" name="pass" placeholder="Введите данные" required><br><br>
				<input type="submit" id="submitBtn" name="goto" value="Войти" >
            </form>
        </div>
    </div>
<footer>

<?php
    if(isset($_POST['goto']))
    {
	$login = mysqli_real_escape_string($mysql, $_POST['login']);
	$pass = mysqli_real_escape_string($mysql, $_POST['pass']);
	if ($login == 'admin' && $pass=='1111') {
		header('Location: admin_lk.php');
	
    }
	else{
		echo "Неверный логин или пароль";
	}
	}
?>
</footer>
</body>
</html>