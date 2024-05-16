<?php
$mysql = mysqli_connect("localhost", "root", "", "test");
if (!$mysql)die("Error connect to database!");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Сотрудники</title>
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
            <option value="FIL" <?php if ($_GET['fSelect'] == "FIL") echo "selected" ?>>По Филиалу</option>
        </select>
        <input type="submit" id="fSubmit1">
    </form>
    <?php
    if ($_GET["fSelect"] == "ID")
        $res = mysqli_query($mysql, "SELECT * FROM `сотрудники` ORDER BY `сотрудники`.`ID-сотрудника` ASC ");
    else if ($_GET["fSelect"] == "FIL")
        $res = mysqli_query($mysql, "SELECT * FROM `сотрудники` ORDER BY `сотрудники`.`ID-филиала` ASC ");
    else
        $res = mysqli_query($mysql, "SELECT * FROM `сотрудники`");
    ?>
  <table border=4 align="center">
        <tr>
            <th>ID-сотрудника</th>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>Должность</th>
            <th>Филиал</th>
            <th>Действия</th>
        </tr>
        <?php while ($Clients = mysqli_fetch_array($res)) { ?>
            <tr>
                <form method="POST">
                    <input type="hidden" name="edit_id" value="<?= $Clients['ID-сотрудника'] ?>">
                    <td><?= $Clients['ID-сотрудника'] ?></td>
					<input type="hidden" name="edit_gk" value="<?= $Clients['ФИО'] ?>">
					<td><?= $Clients['ФИО']  ?></td>
					<input type="hidden" name="edit_addr" value="<?= $Clients['Телефон'] ?>">
					<td><?= $Clients['Телефон'] ?></td>
					<input type="hidden" name="edit_plo" value="<?= $Clients['Должность'] ?>">
					<td><?= $Clients['Должность'] ?></td>
                    <?php $client_id = $Clients['ID-филиала'];
					$query = "SELECT филиалы.Адрес FROM филиалы WHERE филиалы.`ID-филиала` = $client_id";
					$result = mysqli_query($mysql, $query);
					$row = mysqli_fetch_assoc($result);
					$adr = $row['Адрес'];
					?>
					<input type="hidden" name="edit_fil" value="<?= $adr ?>" readonly>
					<td><?= $adr ?></td>
           
					<td>
                        <button type="submit" name="Edit" value="<?= $Clients['ID-сотрудника'] ?>">Редактировать</button>
                        <button type="submit" name="Del" value="<?= $Clients['ID-сотрудника'] ?>">Удалить</button>
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
							$Филиал=$_POST["edit_fil"]?>
							<input type="hidden" name="edit_id" value="<?= $_POST["Edit"] ?>">
							<td><?= $_POST["Edit"] ?></td>
							<td><input type="varchar" name="edit_gk" value="<?= $_POST["edit_gk"] ?>"></td>
							<td><input type="varchar" name="edit_addr" value="<?= $_POST["edit_addr"] ?>"></td>
							<td><input type="varchar" name="edit_plo" value="<?= $_POST["edit_plo"] ?>"></td>							
							<input type="hidden" name="edit_fil" value="<?= $_POST["edit_fil"] ?>" >
							<td><?= $_POST["edit_fil"] ?></td>
							
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
                <td><input type="varchar" name="Plo" placeholder="Введите Должность" required></td>
                <td><select name="edit_fil" required>
					<?php
					// Запрос для получения списка сотрудников
					$query = "SELECT `ID-филиала`, Адрес FROM филиалы";
					$result = mysqli_query($mysql, $query);
			
					// Вывод списка сотрудников в виде опций выпадающего списка
					while ($row = mysqli_fetch_assoc($result)) {
						$employeeID = $row['ID-филиала'];
						$employeeName = $row['Адрес'];
						echo "<option value='$employeeID'>$employeeName</option>";
					}
					?>
				</select></td>
                <td><button type="submit" name="Add">Добавить</button></td>
            </form>
			
        </tr>
    </table>
  </body>
  </html>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Add"])) {
		$employeeID = $_POST["edit_fil"];
		//echo $employeeID;
		//echo $_POST[GK];
		//echo $_POST[Adr];
		//echo $_POST[Plo];
        mysqli_query($mysql, "INSERT INTO `сотрудники`(ФИО, Телефон, Должность, `ID-филиала`) VALUES ('$_POST[GK]', '$_POST[Adr]', '$_POST[Plo]', '$employeeID')");
    } elseif (isset($_POST["Obnov"])) {
        $selectedValue = $_POST["Obnov"];
		//echo $selectedValue;
        $nameGK = $_POST["edit_gk"];
        $Адрес = $_POST["edit_addr"];
        $Площадь = $_POST["edit_plo"];
        mysqli_query($mysql, "UPDATE сотрудники SET `ФИО`='$nameGK', Телефон='$Адрес', `Должность`='$Площадь' WHERE `ID-сотрудника`='$selectedValue'");
    }elseif(isset($_POST["Del"])){
		$selectedValue = $_POST["Del"];
		mysqli_query( $mysql , "DELETE FROM `сотрудники` WHERE `сотрудники`.`ID-сотрудника` = '$selectedValue'" );
	}elseif(isset($_POST["Non"])){
		//header('Location: Sotrudniki.php');
	}
  }
?>