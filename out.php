<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Корзина</title>
    <style>
        BODY {
            background: url(background.jpg) no-repeat 0px 0px;
            background-size: 100%;
        }
        .t {
            border-radius: 10px;
            opacity: 90%;
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

// Проверяем, существует ли массив сравнения в сессии и не пуст ли он
if (isset($_SESSION['comparison']) && !empty($_SESSION['comparison'])) {
    $apartmentIds = implode(',', $_SESSION['comparison']); // Преобразуем массив в строку для использования в SQL запросе

    // Подключение к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Запрос к базе данных для получения данных о выбранных квартирах
    $sql = "SELECT * FROM квартиры WHERE `ID-квартиры` IN ($apartmentIds)";
    $result = $conn->query($sql);

    // Вывод данных в таблицу
    if ($result->num_rows > 0) {
        echo "<form method='post'>";
        echo "<table>";
        echo "<tr><th>Удалить</th><th>ID квартиры</th><th>Название ЖК</th><th>Адрес</th><th>Площадь</th><th>Количество комнат</th><th>Этаж</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='delete[]' value='" . $row["ID-квартиры"] . "'></td>";
            echo "<td>" . $row["ID-квартиры"]. "</td>";
            echo "<td>" . $row["Название ЖК"]. "</td>";
            echo "<td>" . $row["Адрес"]. "</td>";
            echo "<td>" . $row["Площадь"]. "</td>";
            echo "<td>" . $row["Количество комнат"]. "</td>";
            echo "<td>" . $row["Этаж"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br><input type='submit' name='clear' value='Полностью очистить список для сравнения'>";
        echo " <input type='submit' name='deleteSelected' value='Удалить выбранные'>";
        echo "<input type='submit' name='process' value='Отправить в обработку все квартиры из списка'>";

        echo "</form>";
    } else {
        echo "Выбранные квартиры отсутствуют.";
    }

    // Закрытие соединения с базой данных
    $conn->close();
} else {
	
    echo "Выбранные квартиры отсутствуют.";
}

// Если нажата кнопка "Полностью очистить список для сравнения"
if (isset($_POST['clear'])) {
    unset($_SESSION['comparison']); // Удаляем массив сравнения из сессии
    echo "<p>Список для сравнения успешно очищен.</p>";
}

// Если нажата кнопка "Удалить выбранные"
if (isset($_POST['deleteSelected'])) {
    // Проверяем, были ли выбраны квартиры для удаления
    if (isset($_POST['delete']) && is_array($_POST['delete']) && !empty($_POST['delete'])) {
        // Перебираем выбранные квартиры и удаляем их из массива сравнения
        foreach ($_POST['delete'] as $deleteId) {
            // Ищем индекс выбранной квартиры в массиве сравнения
            $key = array_search($deleteId, $_SESSION['comparison']);
            // Если квартира найдена в массиве сравнения, удаляем её
            if ($key !== false) {
                unset($_SESSION['comparison'][$key]);
            }
        }
        header('Location: out.php');
        echo "<p>Выбранные квартиры успешно удалены из списка для сравнения.</p>";
    } else {
        echo "<p>Выберите квартиры для удаления.</p>";
    }
}



// Если нажата кнопка "Отправить в обработку"
if (isset($_POST['process'])) {
    // Проверяем, выбраны ли квартиры
    if (isset($_SESSION['comparison']) && !empty($_SESSION['comparison'])) {
        $status = 'В обработке';
        $currentTime = date("Y-m-d H:i:s");

        // Подключение к базе данных
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Проверка подключения
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Получаем ID клиента
        $clientId = $_SESSION['user']['ID-клиента'];

        // Создаем пустой массив для хранения строк запроса
        $values = array();

        // Удаляем дубликаты квартир из списка
        $uniqueApartmentIds = array_unique($_SESSION['comparison']);

        // Перебираем все выбранные квартиры
        foreach ($uniqueApartmentIds as $apartmentId) {
            // Добавляем строку запроса для каждой квартиры
            $values[] = "('$clientId', '$currentTime', '$apartmentId', '$status')";
        }

        // Преобразуем массив строк запроса в одну строку для запроса INSERT
        $valuesString = implode(', ', $values);

        // Запрос к базе данных для вставки данных в таблицу "Запросы"
        $sql = "INSERT INTO Запросы (ID_клиента, Время_запроса, ID_квартиры, Статус) VALUES $valuesString";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Квартиры успешно отправлены в обработку.</p>";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }

        // Закрытие соединения с базой данных
        $conn->close();
    } else {
        echo "<p>Ошибка: выберите квартиры для отправки в обработку.</p>";
    }
}




?>
<footer>
<?php include 'Foot.php'; ?>
</footer>
</body>

</html>
