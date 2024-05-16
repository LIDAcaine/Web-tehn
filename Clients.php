<?php
$mysql = mysqli_connect("localhost", "root", "", "test");
if (!$mysql)die("Error connect to database!");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Клиенты</title>
    <style>
        BODY {
            background: url(background.jpg) no-repeat 0px 0px; /* Параметры фона */
            background-size: 100%;
        }

        div{
			
        }

        .we{
            border-radius: 10px;
            width: 45%;
            opacity: 90%;/* Прозрачность */
            background: #FFB6C1;
            color: #800000;
        }
        .prod{
            border-radius: 10px;
			
            opacity: 90%;/* Прозрачность */
            background: #FFB6C1;
            color: #800000;
            width: 45%;

        }
        .photo_gost{
            white-space: nowrap;
			margin-left: 10px;
        }
        .gost{
            border-radius: 10px;
            margin-left: 5%;
            width: 90%;
            opacity: 90%;/* Прозрачность */
            background: #FFB6C1;
            color: #800000;
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
		nav{
            display: block;
			border-radius: 10px;
			padding-top: 10px; /* Поля */
            padding-bottom: 10px; /* Поля */
            background: #FFB6C1; /* Цвет фона */
			margin-left: -10px;
            margin-right: -10px;
            text-align: center;
            opacity: 90%;   /* Прозрачность */
			width: 50%;
			margin-left: auto;
            margin-right: auto;
        }
        .a_nav{
            margin: 7px;
            color: #800000;
            text-decoration: none
        }
    </style>
</head>
<body>
<nav>
            <div>
                <a class="a_nav" href="Sdelk.php">Сделки</a>
				<a class="a_nav" href="Kvart.php">Квартиры</a>
				<a class="a_nav" href="Clients.php">Клиенты</a>
				<a class="a_nav" href="Sotrudniki.php">Сотрудники</a>
                <a class="a_nav" href="admin.php">Выйти</a>
            </div>

  </nav>
    <br>
	<?php
    if ($_GET['fSelect'] == "ID")
        $res = mysqli_query($mysql, "SELECT * FROM `клиенты` ORDER BY `клиенты`.`ID-клиента` ASC ");
    else
        $res = mysqli_query($mysql, "SELECT * FROM `клиенты`");
    ?>
  <table border=4 align="center">
        <tr>
            <th>ID-клиента</th>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>Дата рождения</th>
            <th>Паспортные данные</th>
			<th>Пароль</th>
            <th>Действия</th>
        </tr>
        <?php while ($Clients = mysqli_fetch_array($res)) { ?>
            <tr>
                <form method="POST">
                    <input type="hidden" name="edit_id" value="<?= $Clients['ID-клиента'] ?>">
                    <td><?= $Clients['ID-клиента'] ?></td>
					<input type="hidden" name="edit_gk" value="<?= $Clients['ФИО'] ?>">
					<td><?= $Clients['ФИО']  ?></td>
					<input type="hidden" name="edit_addr" value="<?= $Clients['Телефон'] ?>">
					<td><?= $Clients['Телефон'] ?></td>
					<input type="hidden" name="edit_plo" value="<?= $Clients['Дата рождения'] ?>">
					<td><?= $Clients['Дата рождения'] ?></td>
					<input type="hidden" name="edit_kom" value="<?= $Clients['Паспортные данные'] ?>">
					<td><?= $Clients['Паспортные данные'] ?></td>
					<input type="hidden" name="edit_et" value="<?= $Clients['Пароль'] ?>">
					<td><?= $Clients['Пароль'] ?></td>
           
					<td>
                        <button type="submit" name="Edit" value="<?= $Clients['ID-клиента'] ?>">Редактировать</button>
                        <button type="submit" name="Del" value="<?= $Clients['ID-клиента'] ?>">Удалить</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
		 <form method="POST">
		<?php if (isset($_POST["Edit"])) 
						{ 
							$selectedValue = $_POST["Edit"];
							$nameGK = $_POST["edit_gk"];
							$Адрес = $_POST["edit_addr"];
							$Площадь = $_POST["edit_plo"];
							$kolKomnat = $_POST["edit_kom"];
							$Этаж = $_POST["edit_et"]; ?>
							<input type="hidden" name="edit_id" value="<?= $_POST["Edit"] ?>">
							<td><?= $_POST["Edit"] ?></td>
							<td><input type="varchar" name="edit_gk" value="<?= $_POST["edit_gk"] ?>"></td>
							<td><input type="varchar" name="edit_addr" value="<?= $_POST["edit_addr"] ?>"></td>
							<td><input type="varchar" name="edit_plo" value="<?= $_POST["edit_plo"] ?>"></td>
							<td><input type="varchar" name="edit_kom" value="<?= $_POST["edit_kom"] ?>"></td>
							<td><input type="varchar" name="edit_et" value="<?= $_POST["edit_et"] ?>"></td> 
						<td>
                        <button type="submit" name="Obnov" value="<?=  $_POST["Edit"] ?>">Обновить</button>
                        <button type="submit" name="Non" value="<?=  $_POST["Edit"] ?>">Отмена</button>
                    </td>
					<?php } ?>
					</form>
        <tr>
            <form method="POST">
                <td>№</td>
                <td><input type="varchar" name="GK" placeholder="Введите ФИО" required></td>
                <td><input type="varchar" name="Adr" placeholder="Введите Телефон" required></td>
                <td><input type="varchar" name="Plo" placeholder="Введите Дату рождения" required></td>
                <td><input type="varchar" name="Kom" placeholder="Введите Паспортные данные" required></td>
				<td><input type="varchar" name="Et" placeholder="Введите Пароль" required></td>
                <td><button type="submit" name="Add" >Добавить</button></td>
            </form>
        </tr>
    </table>
  </body>
  </html>
  <?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Add"])) {
        mysqli_query($mysql, "INSERT INTO `клиенты`(ФИО, Телефон, `Дата рождения`, `Паспортные данные`, Пароль) VALUES ('$_POST[GK]', '$_POST[Adr]', '$_POST[Plo]', '$_POST[Kom]', '$_POST[Et]')");
   } elseif (isset($_POST["Obnov"])) { 
		$selectedValue = $_POST["Obnov"];
		echo $selectedValue;
		$nameGK = $_POST["edit_gk"];
		echo $nameGK;
		$Адрес = $_POST["edit_addr"];
		$Площадь = $_POST["edit_plo"];
		$kolKomnat = $_POST["edit_kom"];
		$Этаж = $_POST["edit_et"]; 
        mysqli_query($mysql, "UPDATE клиенты SET `ФИО`='$nameGK', Телефон='$Адрес', `Дата рождения`='$Площадь', `Паспортные данные`='$kolKomnat', Пароль='$Этаж' WHERE `ID-клиента`='$selectedValue'");
	}elseif(isset($_POST["Del"])){
		$selectedValue = $_POST["Del"];
		mysqli_query( $mysql , "DELETE FROM `клиенты` WHERE `клиенты`.`ID-клиента` = '$selectedValue'" );

	}elseif(isset($_POST["Non"])){
		//header('Location: Clients.php');
	}
	
}
?>