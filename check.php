<?php

session_start();

$mysql = mysqli_connect("localhost", "root", "", "test");
function convert($text){
        $text = trim($text);
        $text = stripcslashes($text);
        $text = strip_tags($text);
        $text = htmlspecialchars($text);
        return $text;
    }

    function checklength($text, $min, $max){
        $check = (mb_strlen($text) >= $min && mb_strlen($text) <= $max);
        return $check;
    }
if (!$mysql)
    die("Error connect to database!");

$login = convert($_POST['login']);
$name = convert($_POST['name']);
$pass = convert($_POST['pass']);	
$birhd = $_POST['birhd'];
$phone =convert($_POST['phone']);
$CheckUser = mysqli_fetch_array(mysqli_query($mysql, "SELECT *  FROM клиенты where `Паспортные данные` = '$login'"));

//$mysql->query("INSERT INTO `клиенты` (`ФИО`, `Телефон`, `Дата рождения`, `Паспортные данные`, `Пароль`) VALUES ('$name', '$phone', '$birhd', '$login', '$pass')");

if(empty($CheckUser)){
        if(!checklength($login, 10, 10))
        {
            header("Location: Reg.php");
            $_SESSION['message'] = "Длина логина должна быть 10 символов!";
        }
        elseif (!checklength($pass, 3, 10))
        {
            header("Location: Reg.php");
            $_SESSION['message'] = "Длина логина должна быть 3 - 10 символов!";
        }
        else
        {
          $mysql->query("INSERT INTO `клиенты` (`ФИО`, `Телефон`, `Дата рождения`, `Паспортные данные`, `Пароль`) VALUES ('$name', '$phone', '$birhd', '$login', '$pass')");
          header("Location: Aut.php");
        }

    }else{
        $_SESSION['message'] = 'Аккаунт с данным логином уже существует в системе';
        header("Location: Reg.php");
    }
exit();

?>