<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Список квартир</title>
    <style>
        BODY {
            background: url(background.jpg) no-repeat 0px 0px;
            background-size: 100%;
        }
        }
        .t {
            border-radius: 10px;
            opacity: 90%;
            background: #A65546;
            color: #cba8a6;
        }
        table {
            width: 80%; /* Уменьшили ширину таблицы */
            margin: 0 auto; /* Центрирование таблицы */
            border-collapse: collapse;
        }
        th, td {
            padding: 6px; /* Уменьшили внутренние отступы ячеек */
            text-align: left;
            border-bottom: 1px solid #ddd;
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
<?php
 include 'Head.php'; 
 ?>
 <br>
<form method="get">
        <label for="sort">Сортировать по:</label>
        <select name="sort" id="sort">
        <option value="zhk">Название ЖК</option>
            <option value="area_up">Площадь (возрастание)</option>area_down
            <option value="area_down">Площадь (убыванию)</option>area_down
        </select>
        <input type="submit" value="Применить">
    </form>

<br>
<div class="t">
    <form method="post">
        <table>
            <tr>
                <th>ID-квартиры</th>
                <th>Название ЖК</th>
                <th>Адрес</th>
                <th>Площадь</th>
                <th>Количество комнат</th>
                <th>Этаж</th>
                <th>Добавить к сравнению</th>
            </tr>
            <?php
            // Подключение к базе данных
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "test";

            // Создание подключения
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Проверка подключения
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        // Инициализация переменной сортировки по умолчанию
        $sort = "Название ЖК";
        // Если задан параметр сортировки в URL
        if (isset($_GET['sort'])) {
            // Установка переменной сортировки в зависимости от значения в URL
            switch ($_GET['sort']) {
                case 'zhk':
                    $sql = "SELECT * FROM квартиры ORDER BY `квартиры`.`Название ЖК` ASC";
                    break;
                case 'area_up':
                    $sql = "SELECT * FROM квартиры ORDER BY `квартиры`.`Площадь` ASC";
                    break;
                case 'area_down':
                    $sql = "SELECT * FROM квартиры ORDER BY `квартиры`.`Площадь` DESC";
                    break;
            }

        }else{
            $sql = "SELECT * FROM квартиры ORDER BY `квартиры`.`Название ЖК` ASC";
        }
		
        // Выборка данных из таблицы квартир с учетом сортировки
        $result = $conn->query($sql);

            $result = $conn->query($sql);

            // Вывод данных в таблицу
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID-квартиры"]. "</td>";
                    echo "<td>" . $row["Название ЖК"]. "</td>";
                    echo "<td>" . $row["Адрес"]. "</td>";
                    echo "<td>" . $row["Площадь"]. "</td>";
                    echo "<td>" . $row["Количество комнат"]. "</td>";
                    echo "<td>" . $row["Этаж"]. "</td>";
                    echo "<td><input type='checkbox' name='apartment[]' value='" . $row["ID-квартиры"] . "'></td>";
                    echo "</tr>";
                }
            } else {
                echo "0 результатов";
            }
            ?>
        </table>
        <br>
        <input style="float: right; margin-left: -600px" type="submit" name="compare" value="Добавить к сравнению">
    </form>
</div>

<?php
// Если нажата кнопка "Добавить к сравнению"
if (isset($_POST['compare'])) {
    // Проверяем, были ли выбраны квартиры
    if (isset($_POST['apartment']) && !empty($_POST['apartment'])) {
        // Добавляем выбранные квартиры в массив сравнения в сессии
        if (!isset($_SESSION['comparison'])) {
            $_SESSION['comparison'] = array();
        }
        foreach ($_POST['apartment'] as $apartment) {
            $_SESSION['comparison'][] = $apartment;
        }
		if ($_SESSION['user']){
        echo "<p>Квартиры добавлены в список заказов для дальнейшего оформления.</p>";
		}
		else{
		 echo "<p>Квартиры добавлены в список заказов. Для дальнейшего оформления войдите в Личный кабинет.</p>";
		}
    } else {
        echo "<p>Выберите квартиры для сравнения.</p>";
    }
}

// Вывод выбранных квартир из сессии
/*if (isset($_SESSION['comparison']) && !empty($_SESSION['comparison'])) {
    echo "<h2>Выбранные квартиры для сравнения:</h2>";
    echo "<ul>";
    foreach ($_SESSION['comparison'] as $apartmentId) {
        echo "<li>ID квартиры: $apartmentId</li>";
    }
    echo "</ul>";
}*/
?>
<footer>
<?php include 'Foot.php'; ?>
</footer>
</body>
</html>
