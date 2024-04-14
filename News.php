<?php
session_start();
$mysql = mysqli_connect("localhost", "root", "", "test");
if (!$mysql)
    die("Error connect to database!");
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Новости</title>
    <style>
        BODY {
            background: url(background.jpg) no-repeat 0px 0px; /* Параметры фона */
            background-size: 100%;
        }
        #iframe_login1{
            position: fixed;
            top: 25%;
            left: 25%;
            width: 500px;
            height: 300px;
            z-index: 9998;
            border-color: #A65546;
            border-radius: 20px;
        }
        .news{
            border-radius: 10px;
            margin-left: 400px;
            opacity: 90%;/* Прозрачность */
            background: #FFB6C1;
            color: #800000;
        }
        .stock{
            border-radius: 10px;
            margin-right: 400px;
            opacity: 90%;/* Прозрачность */
            background: #FFB6C1;
            color: #800000;
        }
        .add-news-form, .add-stock-form {
            margin: 10px;
        }
    </style>
</head>
<?php include 'Head.php'; ?>
<body>
<div class="news">
    <h2 style="margin-left: 10px">Новости</h2>
    <article>
        <div>
			<img src="news1.gif"  style="float: left; margin-left: 10px; margin-right: 10px; max-width: 300px; max-height: 300px;">
			<div style="overflow: hidden;">
			<p style="font-size: 25px;">Мы рады объявить, что наше агентство недвижимости в скором времени выпустит своё собственное мобильное приложение!<p>
			<p style="font-size: 15px;">Это значительный шаг в развитии нашей компании, который позволит нам быть ближе к нашим клиентам и предоставлять им удобный доступ к нашим услугам прямо с их мобильных устройств.</p>
			<p style="font-size: 15px;">Через наше мобильное приложение, Вы сможете легко просматривать доступные объекты недвижимости, записываться на просмотры, получать уведомления о новых предложениях и обновлениях, а также связываться с нашими специалистами для получения дополнительной информации.</p>
			</div>
			<div style="clear: both;"></div>
		</div>
		<br>
    </article>

</div>

<div class="stock">
    <h2 style="margin-left: 10px">Статистика</h2>
    <article>
        <div>
			<img src="stat.gif"  style="float: right; margin-left: 10px; margin-right: 10px; max-width: 300px; max-height: 300px;">
			<div style="overflow: hidden;">
			<p style="font-size: 20px; margin-left: 10px">В 2023 году наше агентство недвижимости продемонстрировало впечатляющие результаты и установило новые рекорды в своей деятельности.</p>
			<p style="font-size: 17px; margin-left: 10px">-> Общий объем продаж вырос на 30% по сравнению с предыдущим годом.</p>
			<p style="font-size: 17px; margin-left: 10px">-> Количество успешно заключенных сделок увеличилось на 25% по сравнению с 2022 годом.</p>
			<p style="font-size: 17px; margin-left: 10px">-> За год мы привлекли значительное количество новых клиентов благодаря разнообразным предложениям и индивидуальному подходу к каждому клиенту.</p>
			</div>
			<div style="clear: both;"></div>
		</div>
		<br>
    </article>
</div>
<footer>
<?php include 'Foot.php'; ?>
</footer>
</body>
</html>
