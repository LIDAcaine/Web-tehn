<style> 
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
 <nav>
            <div>
                <a class="a_nav" href="index.php">Главная страница</a>
				<a class="a_nav" href="News.php">Новости</a>
				<a class="a_nav" href="Сontacts.php">Контакты</a>
				<a class="a_nav" href="Sotrud.php">Сотрудники</a>
				<a class="a_nav" href="Products.php">Недвижимость</a>
                <?php
                if ($_SESSION['user']):
                    ?>
                    <a class="a_nav" href="lk.php">Личный кабинет</a>
					<a class="a_nav" href="Exit.php">Выйти</a>
					<a class="a_nav" href="out.php">Заказ</a>
                <?php else: ?>
                    <a class="a_nav" href="Aut.php">Войти</a>
                <?php endif;?>
            </div>

  </nav>