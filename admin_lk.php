<?php
$mysql = mysqli_connect("localhost", "root", "", "test");
if (!$mysql)die("Error connect to database!");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>PN78</title>
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
		.content{
            margin-top: 30px;
            margin-left: 25%;
            width: 50%;
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;
            flex-wrap: wrap;
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
<nav>
            <div>
                <a class="a_nav" href="Sdelk.php">Сделки</a>
				<a class="a_nav" href="Kvart.php">Квартиры</a>
				<a class="a_nav" href="Clients.php">Клиенты</a>
				<a class="a_nav" href="Sotrudniki.php">Сотрудники</a>
                <a class="a_nav" href="admin.php">Выйти</a>
            </div>

  </nav>
  <div class="content">
        <div class="auth">
            <h1>Предупреждение!</h1>
            <p style="line-height: 0.2em; margin-left: 10px; font-size: 20px;">Доступны такие действия как:</p>
			<p style="line-height: 0.2em; margin-left: 10px; font-size: 20px;">• Обновловление</p>
			<p style="line-height: 0.2em; margin-left: 10px; font-size: 20px;">• Удаление</p>
			<p style="line-height: 0.2em; margin-left: 10px; font-size: 20px;">• Добавление</p>
			<p style="line-height: 0.2em; margin-left: 10px; font-size: 20px;">Каждое из этих действий будет иметь последствие.</p>
        </div>
    </div>
  </body>
  </html>