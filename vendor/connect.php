<?php
    $connect = new PDO('mysql:host=localhost;dbname=my_base;charset=utf8', 'root', 'root');

    if(!$connect) {
        exit('Не получилось подключиться к MySQL');
    }