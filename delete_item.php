<?php
global $pdo;
require 'php/db_connect.php'; // Подключение к базе данных

$type = isset($_GET['type']) ? $_GET['type'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$type || !$id) {
    header('Location: index.php'); // Если параметры отсутствуют, перенаправляем на главную
    exit();
}

// Определяем таблицу для удаления
switch ($type) {
    case 'course':
        $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
        $redirect = 'kurzy.php';
        break;
    case 'car':
        $stmt = $pdo->prepare("DELETE FROM cars WHERE id = ?");
        $redirect = 'auta.php';
        break;
    case 'instructor':
        $stmt = $pdo->prepare("DELETE FROM instructors WHERE id = ?");
        $redirect = 'o_nas.php';
        break;
    default:
        header('Location: index.php'); // Если тип не распознан, перенаправляем на главную
        exit();
}

// Выполняем запрос на удаление
$stmt->execute([$id]);

// Перенаправляем пользователя на соответствующую страницу
header("Location: $redirect");
exit();
?>
