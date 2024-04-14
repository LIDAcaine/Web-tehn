<?php
session_start();
$mysql = mysqli_connect("localhost", "root","","test");
if(!$mysql)
    die("Error connect to database!");
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
    </style>
</head>

<body>
   <?php include 'Head.php'; ?>
    <div class="content">
        <div class="we">
            <h1 style="margin-left: 10px">О нас</h1>
            <p style="margin-left: 10px">  &nbsp; &nbsp; &nbsp;Петербургская недвижимость 78 (ПН78) – это команда специалистов, которые разбираются в правовых вопросах сделок и помогут Вам снять, купить или продать жилье. Мы являемся лидерами рынка недвижимости Северо-Запада. Сегодня каждая третья квартира в Санкт-Петербурге приобретается у нас. </p>
        </div>


        <div class="prod">
            <h1 style="margin-left: 10px">Услуги</h1>
            <p style="margin-left: 10px">  &nbsp; &nbsp; &nbsp;Наше агенство недвижимости предоставляет довольно широкий спектр услуг с недвижимостью в различных сферах, в частности: </p>
            <p style="line-height: 0.2em; margin-left: 10px">• Покупка-продажа, аренда недвижимости.</p>
            <p style="line-height: 0.2em; margin-left: 10px">• Поиск продавцов и покупателей.</p>
            <p style="line-height: 0.2em; margin-left: 10px">• Юридическое сопровождение сделки.</p>
        </div>
    </div>

    <div class="gost">
        <h1 style="margin-left: 10px">Строительные компании, с которыми мы работаем</h1>
        <div>
			<img src="rsti.jpg"  style="float: left; margin-left: 10px; margin-right: 10px; max-width: 150px; max-height: 150px;">
			<div style="overflow: hidden;">
			<h3 style="margin-top: 0;">Холдинг "РСТИ" (Росстройинвест)</h3>
			<p>Холдинг "РСТИ" работает в Санкт-Петербурге с 2001 года. Фирма объединяет более 10 организаций, выполняющих различные виды работ. Есть собственный парк строительной техники и специализированного оборудования. Благодаря такой структуре большинство объектов возводится без привлечения сторонних компаний.</p>
			</div>
			<div style="clear: both;"></div>
		</div>
		<br>
		<div>
			<img src="psk.jpg"  style="float: left; margin-left: 10px; margin-right: 10px; max-width: 150px; max-height: 150px;">
			<div style="overflow: hidden;">
			<h3 style="margin-top: 0;">"Петербургская Строительная Компания" (ПСК)</h3>
			<p>"Петербургская Строительная Компания" (ПСК) была основана в 2007 году, как генеральный подрядчик в жилищном строительстве. На сегодняшний день она выступает в качестве генерального подрядчика, застройщика, проектировщика и инвестора. В портфеле компании есть 50 реализованных проектов — жилые дома, административные здания, школы, детские сады, спортивные сооружения, инженерные сети и автомобильные дороги.</p>
			</div>
			<div style="clear: both;"></div>
		</div>
		<br>
		<div>
			<img src="setl-group.jpg"  style="float: left; margin-left: 10px; margin-right: 10px; max-width: 150px; max-height: 150px;">
			<div style="overflow: hidden;">
			<h3 style="margin-top: 0;">"Петербургская Недвижимость"</h3>
			<p>Весной 1994 года в Северной столице создана строительно-финансовая компания "Петербургская Недвижимость". На базе этой организации со временем появился холдинг Setl Group – один из наибольших застройщиков России. По состоянию на 2019 год портфолио девелопера Setl City насчитывает 205 жилых домов, введённых в эксплуатацию.</p>
			</div>
			<div style="clear: both;"></div>
		</div>
		<br>
	</div>
    </div>
    <p></p>
<footer>
<?php include 'Foot.php'; ?>
</footer>
</body>
</html>