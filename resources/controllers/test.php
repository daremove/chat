<?php
$link = mysqli_connect('127.0.0.1', "root", '', 'users');
if ( !$link ) die("Error");

$query ="SELECT * FROM phones";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
{
    echo "Выполнение запроса прошло успешно";
}
$query1 = "INSERT INTO gamers (login, password) VALUE ('allah', 'akbar')";

if(mysqli_query($link, $query1))
    echo " xyN";
else
    echo " sd";
mysqli_close($link);
?>