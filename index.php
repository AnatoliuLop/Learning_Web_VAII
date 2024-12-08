<?php
global $pdo;
require 'php/db_connect.php'; // Подключение к базе данных
require 'header.php'; // Хедер

// Определяем текущую страницу
$page = $_GET['page'] ?? 'home'; // Если параметр отсутствует, по умолчанию загружается главная

// Подключаем содержимое страницы
switch ($page) {
    case 'kurzy':
        require 'kurzy.php';
        break;
    case 'auta':
        require 'auta.php';
        break;
    case 'o_nas':
        require 'o_nas.php';
        break;
    case 'kontakt':
        require 'kontakt.php';
        break;
    case 'skusky':
        require 'skusky.php';
        break;
    default:
        require 'home.php'; // Главная страница
        break;
}

require 'footer.php'; // Футер
