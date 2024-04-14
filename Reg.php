<?php
session_start();
if ($_SESSION['user']){
	header('Location: Aut.php');
}
$mysql = mysqli_connect("localhost", "root", "", "test");
if (!$mysql)
	die("Error connect to database!");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
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
    </style>
</head>
<body>

    <?php include 'Head.php'; ?>

    <div class="content">
        <div class="reg">
            <h1>Регистрация</h1>
            <form method="POST" action="check.php">
                <label for="login">Паспортные данные:</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Введите паспортные данные" required><br><br>
                <label for="pass">Пароль:</label>
                <input type="password" id="pass" name="pass" placeholder="Введите пароль" required><br><br>
                <label for="name">ФИО:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Введите ваше имя" required><br><br>
				<label for="birhd">Дата рождения:</label>
                <input type="text" class="form-control" id="birhd" name="birhd" placeholder="Введите дату рождения" required><br><br>
                <label for="phone">Номер телефона:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Введите номер телефона" required><br><br>
                <button type="submit">Зарегистрироваться</button>
				<?php
				if ($_SESSION['message']) {
					echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
				}
				unset($_SESSION['message']);
				?>
            </form>
        </div>
    </div>
<footer>
<?php include 'Foot.php'; ?>
</footer>
</body>
</html>