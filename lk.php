<?php
session_start();
if (!$_SESSION['user']){
	header('Location: Aut.php');
}
$mysql = mysqli_connect("localhost", "root", "", "test");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
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

        .prof{
            width: 350px;
            background: #FFB6C1; /* Цвет фона */
            opacity: 90%;   /* Прозрачность */
            border-radius: 20px;
            text-align: center;
            color: #800000;
        }
        .orders{
            margin-top: 15px;
            border-radius: 20px;
			padding-bottom: 10px;
			opacity: 90%;
            background: #FFB6C11;
            color: #8000000;
            <!--margin-left: 25%;-->
            width: 100%;

        }
		th {
            background-color: #ffcccc; /* Розовый цвет для заголовков */
        }
        /* Стили для каждой четной строки таблицы */
        tr:nth-child(even) {
            background-color: #FAEBD7; /* Светло-серый цвет для четных строк */
        }
		 tr:nth-child(odd) {
            background-color: #F5F5F5; 
        }
    </style>
</head>
<body>

    <?php include 'Head.php';?>
	
    <div class="content">
        <div align="center">
         <div class="prof">
			<form method="POST">
                <p> Ваши личные данные:</p>
                <P> ФИО: <input type="text" name="newFIO" value="<?php echo $_SESSION['user']['ФИО']; ?>" style="width: 250px"></P>
				<P> Дата рождения: <input type="text" name="newBD" value="<?php echo $_SESSION['user']['Дата рождения']; ?>" style="width: 100px"></P>
				<P> Номер телефона: +7<input type="text" name="newTel" value="<?php echo $_SESSION['user']['Телефон']; ?>" style="width: 100px"></P>
				<P> Паспортные данные: <input type="text" name="newPas" value="<?php echo $_SESSION['user']['Паспортные данные']; ?>" style="width: 100px"></P>
				<input type="submit" name="Edit" value="Обновить">
				<input type="submit" name="mine" value="Мои сделки">
			</form>
         </div>
		</div>
	</div>
    
<footer>

<?php include 'Foot.php'; ?>

</footer>
</body>
</html>
<?php
if(isset($_POST['Edit']))
{
	$id = ($_SESSION['user']['ID-клиента']);
	$newFIO = ($_POST['newFIO']);
	$newBD = ($_POST['newBD']);
	$newTel = ($_POST['newTel']);
	$newPas = ($_POST['newPas']);
	mysqli_query($mysql, "UPDATE клиенты SET ФИО='$newFIO', Телефон='$newTel', `Дата рождения`='$newBD', `Паспортные данные`='$newPas' WHERE `ID-клиента`='$id'");
	$resul = mysqli_query($mysql, "SELECT * FROM `клиенты` WHERE `клиенты`.`ID-клиента`='$id'");
 if ($user = mysqli_fetch_assoc($resul)) {	
		header('Location: lk.php');
      $_SESSION['user'] = [
		"ID-клиента"=>$user['ID-клиента'],
        "ФИО" => $user['ФИО'],
        "Телефон" => $user['Телефон'],
        "Дата рождения" => $user['Дата рождения'],
        "Паспортные данные" => $user['Паспортные данные'] ];
 }
}
if (isset($_POST['mine'])) {
        echo '<div class="orders" align="center">
                <h2>Ваши сделки:</h2>
                <table border="1">
                    <tr>
                        <th>Номер сделки</th>
                        <th>Сумма, рубли</th>
                        <th>Дата</th>
                        <th>Статус</th>
                        <th>Тип</th>
                        <th>Квартира</th>
                        <th>Сотрудник</th>
                    </tr>';

        // Получаем ID-клиента из ЛК
        $id_client = $_SESSION['user']['ID-клиента'];

        // Запрос на получение сделок данного клиента с дополнительными данными
        $query = "SELECT сделки.*, квартиры.*, сотрудники.`ФИО` AS `ФИО_сотрудника`
                    FROM сделки
                    INNER JOIN квартиры ON сделки.`ID-квартиры` = квартиры.`ID-квартиры`
                    INNER JOIN сотрудники ON сделки.`ID-сотрудника` = сотрудники.`ID-сотрудника`
                    WHERE сделки.`ID-клиента` = $id_client";
        $result = mysqli_query($mysql, $query);

        // Выводим данные в таблицу
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Код сделки'] . "</td>";
            echo "<td>" . $row['Сумма'] ."</td>";
            echo "<td>" . $row['Дата'] . "</td>";
            echo "<td>" . $row['Статус'] . "</td>";
            echo "<td>" . $row['Тип'] . "</td>";
            echo "<td>" . $row['Название ЖК'] . " - " . $row['Адрес'] . "</td>";
            echo "<td>" . $row['ФИО_сотрудника'] . "</td>";
            echo "</tr>";
        }

        echo '</table></div>';
    }
?>