<?php
$mysql = mysqli_connect("localhost", "root", "", "test");
if (!$mysql)die("Error connect to database!");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Сделки</title>
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
    <?php
    if ($_GET["fSelect"] == "ID")
        $res = mysqli_query($mysql, "SELECT * FROM `запросы` ORDER BY `запросы`.`ID` ASC ");
      
    else
        $res = mysqli_query($mysql, "SELECT * FROM `запросы`");
    ?>
	<br>
	<h2 style="text-align: center">Запросы на сделки</h2>
	<table border=4 align="center">
        <tr>
            <th>Код запроса</th>
            <th>Сумма (рубли)</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Тип</th>
            <th>ID-клиента</th>
			<th>ID-сотрудника</th>
			<th>ID-квартиры</th>
            <th>Действия</th>
        </tr>
        <?php while ($Clients = mysqli_fetch_array($res)) { ?>
            <tr>
                <form method="POST">
                    <input type="hidden" name="edit_id" value="<?= $Clients['ID'] ?>">
                    <td><?= $Clients['ID'] ?></td>
                    <td><input type="int" name="edit_gk" placeholder="Введите сумму(рубли)" required></td>
                    <td><input type="varchar" name="edit_addr" placeholder="Введите Дату" required></td>
                    <td><input type="varchar" name="edit_plo" placeholder="Введите Статус" required></td>
                    <td><input type="varchar" name="edit_kom" placeholder="Введите Тип" required></td>
					<?php $client_id = $Clients['ID_клиента'];
					$query = "SELECT клиенты.ФИО FROM клиенты WHERE клиенты.`ID-клиента` = $client_id";
					$result = mysqli_query($mysql, $query);
					$row = mysqli_fetch_assoc($result);
					$fio = $row['ФИО'];
					?>
					<input type="hidden" name="edit_et" value="<?= $fio ?>" readonly>
					<td><?= $fio ?></td>
                    <!--<td><input type="int" name="edit_et" value='SELECT клиенты.ФИО FROM сделки WHERE клиенты.`ID-клиента` = сделки.`ID-клиента`'></td>-->
					<td><select name="edit_sotr" required>
					<?php
					// Запрос для получения списка сотрудников
					$query = "SELECT `ID-сотрудника`, ФИО FROM сотрудники";
					$result = mysqli_query($mysql, $query);
			
					// Вывод списка сотрудников в виде опций выпадающего списка
					while ($row = mysqli_fetch_assoc($result)) {
						$employeeID = $row['ID-сотрудника'];
						$employeeName = $row['ФИО'];
						echo "<option value='$employeeID'>$employeeName</option>";
					}
					?>
				</select></td>
					<?php $client_id = $Clients['ID_квартиры'];
					$query = "SELECT квартиры.Адрес FROM квартиры WHERE квартиры.`ID-квартиры` = $client_id";
					$result = mysqli_query($mysql, $query);
					$row = mysqli_fetch_assoc($result);
					$adr = $row['Адрес'];
					?>
					<input type="hidden" name="edit_et" value="<?= $adr ?>" readonly>
					<td><?= $adr ?></td>
                    <td>
                        <button type="submit" name="Add" value="<?= $Clients['ID'] ?>">Выбрать</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
	</table>
	<br>
	<h2 style="text-align: center">Список сделок</h2>
  <form method="GET" id="f1">
        <select name="fSelect">
            <option value="ID" <?php if ($_GET['fSelect'] == "ID") echo "selected" ?>>По ID</option>
            <option value="SUM" <?php if ($_GET['fSelect'] == "SUM") echo "selected" ?>>По Сумме</option>
        </select>
        <input type="submit" id="fSubmit1">
    </form>
    <?php
    if ($_GET["fSelect"] == "ID")
        $res = mysqli_query($mysql, "SELECT * FROM `сделки` ORDER BY `сделки`.`Код сделки` ASC ");
    else if ($_GET["fSelect"] == "SUM")
        $res = mysqli_query($mysql, "SELECT * FROM `сделки` ORDER BY `сделки`.`Сумма` ASC ");
    else
        $res = mysqli_query($mysql, "SELECT * FROM `сделки`");
    ?>
	
  <table border=4 align="center">
        <tr>
            <th>Код сделки</th>
            <th>Сумма (рубли)</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Тип</th>
            <th>ID-клиента</th>
			<th>ID-сотрудника</th>
			<th>ID-квартиры</th>
            <th>Действия</th>
        </tr>
		
        <?php while ($Clients = mysqli_fetch_array($res)) { ?>
            <tr>
                <form method="POST">
                    <input type="hidden" name="edit_id" value="<?= $Clients['Код сделки'] ?>">
                    <td><?= $Clients['Код сделки'] ?></td>
					<input type="hidden" name="edit_gk" value="<?= $Clients['Сумма'] ?>">
					<td><?= $Clients['Сумма']  ?></td>
					<input type="hidden" name="edit_addr" value="<?= $Clients['Дата'] ?>">
					<td><?= $Clients['Дата'] ?></td>
					<input type="hidden" name="edit_plo" value="<?= $Clients['Статус'] ?>">
					<td><?= $Clients['Статус'] ?></td>
					<input type="hidden" name="edit_kom" value="<?= $Clients['Тип'] ?>">
					<td><?= $Clients['Тип'] ?></td>
					<?php $client_id = $Clients['ID-клиента'];
					$query = "SELECT клиенты.ФИО FROM клиенты WHERE клиенты.`ID-клиента` = $client_id";
					$result = mysqli_query($mysql, $query);
					$row = mysqli_fetch_assoc($result);
					$fio = $row['ФИО'];
					?>
					<input type="hidden" name="edit_et" value="<?= $fio ?>">
					<td><?= $fio ?></td>
                    <!--<td><input type="int" name="edit_et" value='SELECT клиенты.ФИО FROM сделки WHERE клиенты.`ID-клиента` = сделки.`ID-клиента`'></td>-->
					<?php $client_id = $Clients['ID-сотрудника'];
					$query = "SELECT сотрудники.ФИО FROM сотрудники WHERE сотрудники.`ID-сотрудника` = $client_id";
					$result = mysqli_query($mysql, $query);
					$row = mysqli_fetch_assoc($result);
					$fios = $row['ФИО'];
					?>
					<input type="hidden" name="edit_sotr" value="<?= $fios ?>">
					<td><?= $fios ?></td>
					<?php $client_id = $Clients['ID-квартиры'];
					$query = "SELECT квартиры.`Адрес` FROM квартиры WHERE квартиры.`ID-квартиры` = $client_id";
					$result = mysqli_query($mysql, $query);
					$row = mysqli_fetch_assoc($result);
					$adr = $row['Адрес'];
					?>
					<input type="hidden" name="edit_kv" value="<?= $adr ?>">
					<td><?= $adr ?></td>
                    <td>
                        <button type="submit" name="Edit" value="<?= $Clients['Код сделки'] ?>">Редактировать</button>
                        <button type="submit" name="Del" value="<?= $Clients['Код сделки'] ?>">Удалить</button>
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
							 ?>
							<input type="hidden" name="edit_id" value="<?= $_POST["Edit"] ?>">
							<td><?= $_POST["Edit"] ?></td>
							<td><input type="varchar" name="edit_gk" value="<?= $_POST["edit_gk"] ?>"></td>
							<td><input type="varchar" name="edit_addr" value="<?= $_POST["edit_addr"] ?>"></td>
							<td><input type="varchar" name="edit_plo" value="<?= $_POST["edit_plo"] ?>"></td>
							<td><input type="varchar" name="edit_kom" value="<?= $_POST["edit_kom"] ?>"></td>
							<input type="hidden" name="edit_et" value="<?= $_POST["edit_et"] ?>" >
							<td><?= $_POST["edit_et"] ?></td>
							<input type="hidden" name="edit_et" value="<?= $_POST["edit_sotr"] ?>" >
							<td><?= $_POST["edit_sotr"] ?></td>
							<input type="hidden" name="edit_et" value="<?= $_POST["edit_kv"] ?>" >
							<td><?= $_POST["edit_kv"] ?></td>
						<td>
                        <button type="submit" name="Obnov" value="<?=  $_POST["Edit"] ?>">Обновить</button>
                        <button type="submit" name="Non" value="<?=  $_POST["Edit"] ?>">Отмена</button>
                    </td>
					<?php } ?>
		</form>
    </table>
  </body>
  </html>
  <?php

    if (isset($_POST["Add"])) {
		$selectedValue = $_POST["Add"];
		echo $selectedValue;
		$client = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT запросы.`ID_клиента` FROM запросы WHERE запросы.`ID` = $selectedValue"))['ID_клиента'];
		$kvart = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT запросы.`ID_квартиры` FROM запросы WHERE запросы.`ID` = $selectedValue"))['ID_квартиры'];
		$employeeID = $_POST["edit_sotr"];
		echo $client;
		echo $kvart;
        mysqli_query($mysql, "INSERT INTO `сделки`(`Сумма`, Дата, Статус, `Тип`, `ID-клиента`, `ID-сотрудника`, `ID-квартиры`) VALUES ('$_POST[edit_gk]', '$_POST[edit_addr]', '$_POST[edit_plo]', '$_POST[edit_kom]', '$client', '$employeeID', '$kvart')");
		mysqli_query( $mysql , "DELETE FROM `запросы` WHERE `запросы`.`ID` = '$selectedValue'" );
		header("Refresh:0");
    } elseif (isset($_POST["Obnov"])) {
		$selectedValue = $_POST["Obnov"];
		//echo $selectedValue ;
        $nameGK = $_POST["edit_gk"];
		//echo $nameGK;
        $Адрес = $_POST["edit_addr"];
        $Площадь = $_POST["edit_plo"];
        $kolKomnat = $_POST["edit_kom"];
        mysqli_query($mysql, "UPDATE сделки SET `Сумма`='$nameGK', `Дата`='$Адрес', `Статус`='$Площадь', `Тип`='$kolKomnat' WHERE `Код сделки`='$selectedValue'");
    }elseif(isset($_POST["Del"])){
		$selectedValue = $_POST["Del"];
		mysqli_query( $mysql , "DELETE FROM `сделки` WHERE `сделки`.`Код сделки` = '$selectedValue'" );
		//header("Refresh:0");
	}elseif(isset($_POST["Non"])){
		//header('Location: Clients.php');
	}
	
?>