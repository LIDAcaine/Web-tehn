<?php
session_start();

if ($_SESSION['user']){
	header('Location: lk.php');
}
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

    <?php include 'Head.php'; ?>

    
    <div class="content">
        <div class="auth">
            <h1>Авторизация</h1>
            <form method="post">
                <label for="login">Паспортные данные:</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Введите данные" required><br><br>

                <label for="pass">Пароль:</label>
                <input type="password" id="pass" name="pass" placeholder="Введите данные" required><br><br>
            
                <input type="submit" name="goto" value="Войти">
				<a class="a_nav" style="color: #000080" href="Reg.php"><u>Зарегистрироваться</u></a>
            </form>
        </div>
    </div>
<footer>
<?php include 'Foot.php'; ?>
</footer>
</body>
</html>	
    <?php
    if(isset($_POST['goto']))
    {
    $login = mysqli_real_escape_string($mysql, $_POST['login']);
    $pass = mysqli_real_escape_string($mysql, $_POST['pass']);

    $result = mysqli_query($mysql, "SELECT * FROM `клиенты` WHERE `клиенты`.`Паспортные данные` = '$login' AND `клиенты`.`Пароль` ='$pass'");
    if ($user = mysqli_fetch_assoc($result)) {
       
      $_SESSION['user'] = [
		"ID-клиента"=>$user['ID-клиента'],
        "ФИО" => $user['ФИО'],
        "Телефон" => $user['Телефон'],
        "Дата рождения" => $user['Дата рождения'],
        "Паспортные данные" => $user['Паспортные данные'] ];
       header('Location: lk.php');
    }
    else
    {
      $_SESSION['error'] = 'Неверный Логин или Пароль';
    }
    }
?>

