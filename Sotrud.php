<?php
session_start();
$mysql = mysqli_connect("localhost", "root", "", "test");
if (!$mysql)
    die("Error connect to database!");
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
            margin-left: 200px;
			margin-right: 200px;
            opacity: 90%;/* Прозрачность */
            background: #FFB6C1;
            color: #800000;
        }
        .stock{
            border-radius: 10px;
            margin-left: 200px;
			margin-right: 200px;
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
    <h2 style="margin-left: 10px">Главный риелтор</h2>
    <article>
        <div>
			<img src="Bunin.jpeg"  style="float: left; margin-left: 10px; margin-right: 10px; max-width: 300px; max-height: 300px;">
			<div style="overflow: hidden;">
			<p style="font-size: 25px;">Бунин Иван Алексеевич<p>
			<p style="font-size: 15px;">Специализируюсь по вопросам аренды, купли-продажи, проведения межрегиональных сделок, помогаю с вопросами ипотечного одобрения и страхования.</p>
			<p style="font-size: 15px;">Моя миссия: дарить на своем пути добрые эмоции и счастье обретения своего жилья. Со многими клиентами мы выстраиваем добрые и позитивные взаимоотношения, которые, я надеюсь, мы сохраним на долгие годы. Также для некоторых своих клиентов мне удалось стать по-настоящему семейным риелтором и поработать с разными поколениями одной семьи.</p>
			</div>
			<div style="clear: both;"></div>
		</div>
		<br>
    </article>

</div>

<div class="stock">
    <h2 style="margin-left: 10px">Юрист</h2>
    <article>
        <div>
			<img src="Gumil.jpg"  style="float: left; margin-left: 10px; margin-right: 10px; max-width: 300px; max-height: 250px;">
			<div style="overflow: hidden;">
			<p style="font-size: 25px;">Гумилёв Николай Степанович<p>
			<p style="font-size: 15px;">Полное сопровождение сделок — любые договора (купля-продажа, дарение, мена, переуступка аренды) — сбор необходимых документов, составление договоров в простой письменной форме, регистрация в УФРС.</p>
			<p style="font-size: 15px;">Покупка и продажа квартир (комнат), новостройки Санкт-Петербурга и Ленинградской области, юридическое сопровождение сделок с недвижимостью, ипотека -помощь в одобрение.</p>
			<p style="font-size: 15px;">Консультации по вопросам недвижимости.</p>
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