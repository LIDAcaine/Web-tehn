<?php
$mysql = mysqli_connect("localhost", "root", "", "test");
if (!$mysql)die("Error connect to database!");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Квартиры</title>
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
  <form method="GET" id="f1">
        <select name="fSelect">
            <option value="ID" <?php if ($_GET['fSelect'] == "ID") echo "selected" ?>>По ID</option>
            <option value="GK" <?php if ($_GET['fSelect'] == "GK") echo "selected" ?>>По Названию ЖК</option>
        </select>
        <input type="submit" id="fSubmit1">
    </form>
    <?php
    if ($_GET["fSelect"] == "ID")
        $res = mysqli_query($mysql, "SELECT * FROM `квартиры` ORDER BY `квартиры`.`ID-квартиры` ASC ");
    else if ($_GET["fSelect"] == "GK")
        $res = mysqli_query($mysql, "SELECT * FROM `квартиры` ORDER BY `квартиры`.`Название ЖК` ASC ");
    else
        $res = mysqli_query($mysql, "SELECT * FROM `квартиры`");
    ?>
  <table border=4 align="center">
        <tr>
            <th>ID-квартиры</th>
            <th>Название ЖК</th>
            <th>Адрес</th>
            <th>Площадь</th>
            <th>Количество комнат</th>
            <th>Этаж</th>
            <th>Действия</th>
        </tr>
        <?php while ($Clients = mysqli_fetch_array($res)) { ?>
            <tr>
                <form method="POST">
                    <input type="hidden" name="edit_id" value="<?= $Clients['ID-квартиры'] ?>">
                    <td><?= $Clients['ID-квартиры'] ?></td>
					<input type="hidden" name="edit_gk" value="<?= $Clients['Название ЖК'] ?>">
					<td><?= $Clients['Название ЖК']  ?></td>
					<input type="hidden" name="edit_addr" value="<?= $Clients['Адрес'] ?>">
					<td><?= $Clients['Адрес'] ?></td>
					<input type="hidden" name="edit_plo" value="<?= $Clients['Площадь'] ?>">
					<td><?= $Clients['Площадь'] ?></td>
					<input type="hidden" name="edit_kom" value="<?= $Clients['Количество комнат'] ?>">
					<td><?= $Clients['Количество комнат'] ?></td>
					<input type="hidden" name="edit_et" value="<?= $Clients['Этаж'] ?>">
					<td><?= $Clients['Этаж'] ?></td>
                    <td>
                        <button type="submit" name="Edit" value="<?= $Clients['ID-квартиры'] ?>">Редактировать</button>
                        <button type="submit" name="Del" value="<?= $Clients['ID-квартиры'] ?>">Удалить</button>
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
                <td><input type="varchar" name="GK" placeholder="Введите название ЖК" required></td>
                <td><input type="varchar" name="Adr" placeholder="Введите Адрес" required></td>
                <td><input type="int" name="Plo" placeholder="Введите Площадь" required></td>
                <td><input type="int" name="Kom" placeholder="Введите Количество комнат" required></td>
                <td><input type="int" name="Et" placeholder="Введите Этаж" required></td>
                <td><button type="submit" name="Add" value="<?= $Clients['ID-квартиры'] ?>">Добавить</button></td>
            </form>
        </tr>
    </table>
  </body>
  </html>
  <?php

    if (isset($_POST["Add"])) {
		$selectedValue = $_POST["Add"];
        mysqli_query($mysql, "INSERT INTO `квартиры`(`Название ЖК`, Адрес, Площадь, `Количество комнат`, Этаж) VALUES ('$_POST[GK]', '$_POST[Adr]', '$_POST[Plo]', '$_POST[Kom]', '$_POST[Et]')");
		header("Location: ".$_SERVER['PHP_SELF']);
    } elseif (isset($_POST["Obnov"])) {
		$selectedValue = $_POST["Obnov"];
        $nameGK = $_POST["edit_gk"];
        $Адрес = $_POST["edit_addr"];
        $Площадь = $_POST["edit_plo"];
        $kolKomnat = $_POST["edit_kom"];
        $Этаж = $_POST["edit_et"];
        mysqli_query($mysql, "UPDATE квартиры SET `Название ЖК`='$nameGK', Адрес='$Адрес', Площадь='$Площадь', `Количество комнат`='$kolKomnat', Этаж='$Этаж' WHERE `ID-квартиры`='$selectedValue'");
	}elseif(isset($_POST["Del"])){
		$selectedValue = $_POST["Del"];
		mysqli_query( $mysql , "DELETE FROM `квартиры` WHERE `квартиры`.`ID-квартиры` = '$selectedValue'" );
		//header("Location: Kvart.php");
	}elseif(isset($_POST["Non"])){
		//header('Location: Clients.php');
	}
	
?>