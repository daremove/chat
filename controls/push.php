<?php
//Проверям есть ли переменные на добавление
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Если к нам идёт Ajax запрос, то ловим его
    echo 'Это ajax запрос!';
    exit;
}
//Если это не ajax запрос
echo 'Это не ajax запрос!';
?>