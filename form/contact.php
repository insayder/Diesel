<?php

$post = (!empty($_POST)) ? true : false;

if($post)
{
$email = trim($_POST['email']);
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);
$tel = htmlspecialchars($_POST["tel"]);
$error = '';

if(!$name)
{
$error .= 'Пожалуйста введите ваше имя.<br />';
}

// Проверка телефона
function ValidateTel($valueTel)
{
$regexTel = "/^[0-9]{7,12}$/";
if($valueTel == "") {
return false;
} else {
$string = preg_replace($regexTel, "", $valueTel);
}
return empty($string) ? true : false;
}
if(!$tel)
{
$error .= "Пожалуйста введите телефон.<br />";
}
if($tel && !ValidateTel($tel))
{
$error .= "Введите корректный телефон.<br />";
}
if(!$error)

// Проверка сообщения (length)
if(!$message || strlen($message) < 1)
{
$error .= "Введите ваше сообщение.<br />";// В этой строчке ставиться минимальное ограничение на написание букв.
}
if(!$error)
{


$name_tema = "=?utf-8?b?". base64_encode($name) ."?=";

$subject ="Заявка с сайта vpluce.ru";
/*
$message ="\n\nСообщение: ".$message."\n\nИмя: " .$name."\n\nТелефон: ".$tel."\n\n";
*/
$message ="\n\nИмя: ".$name."\n\nНомер телефона: " .$tel."\n\nСообщение: ".$message."\n\n";
$mail = mail("dm7rin@gmail.com", $subject, $message,

"From: ".$name_tema." <".$tel."> "."Reply-To: ".$email." "." X-Mailer: PHP/" . phpversion());


if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}
?>