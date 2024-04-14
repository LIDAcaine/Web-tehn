<?php 
$mysql = mysqli_connect("localhost", "root", "", "test"); 
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Контакты</title>
    <style>
        BODY {
            background: url(background.jpg) no-repeat 0px 0px; /* Параметры фона */
            background-size: 100%;
        }
        .inf{
            border-radius: 10px;
            width: 40%;

            opacity: 90%;/* Прозрачность */
            background: #FFB6C1;
            color: #800000;
        }
    </style>
</head>

<body>

    <?php 
	session_start();
	include 'Head.php'; ?>
    <div align="center">
    <div class="inf" >
        <h1>Уважаемый клиент</h1>
        <p> Наши офисы находятся на таких адресах:</p>
        <p> г.Санкт-Петербург, Лиговский проспект, 27</p>
        <p> г.Санкт-Петербург, Красного курсанта, 21</p>
        <p> г.Санкт-Петербург, Черкасова, 25</p>
		 <p> Время работы: ежедневно 9:00-19:00</p>
		<p> Если Вы хотите с нами связаться, то заполните форму обратной связи:</p>
        <td class="cont_form">
            <div style="display: table-cell">
                <form method="POST">
                    <div class="input-container">
						<label for="fName1" class="placeholder">Введите Ваше имя:</label>
                        <input class="input" placeholder=" " type="text" name="fName" id="fName1" required>
                    </div>
                    <div class="input-container">
					<label for="fEmail1" class="placeholder">Введите Ваш e-mail:</label>
                        <input class="input" placeholder=" " type="email" name="fEmail" id="fEmail1" required>
                    </div>
                    <div class="input-container">
                        <p for="fMessage1" class="placeholder" align= "left">Ваше сообщение:</p>
						<textarea class="input" placeholder=" " name="fMessage" id="fMessage1" cols="40" rows="6" required></textarea>
                    </div>
                    <div class="form_radio_btn" style="margin: 0 auto;">
                        <input type="submit" name="reset" id="fSubmit1">
                        <input type="reset" id="fReset1">
                    </div>
                </form>
				
            </div>
        </td>
    </div>
	</div>
<footer>
<?php include 'Foot.php'; ?>
</footer>
</body>
</html>
<?php 
if(isset($_POST['reset']))
{
	$fName = ($_POST['fName']);
	$fEmail = ($_POST['fEmail']);
	$fMessage = ($_POST['fMessage']);
	mysqli_query($mysql,"INSERT INTO `mail` (`ID-mail`, `Name`, `E-mail`, `Message`) VALUES (NULL, '$fName', '$fEmail', '$fMessage')"); 
}
?>