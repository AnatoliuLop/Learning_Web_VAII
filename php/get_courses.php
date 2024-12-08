<?php
require 'db_connect.php';

global $pdo;
$stmt = $pdo->query("SELECT * FROM courses");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurzy</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Подключение вашего CSS -->
</head>
<body>
<h1>Naše Kurzy</h1>
<div class="courses">
    <?php foreach ($courses as $course): ?>
        <div class="course">
            <h2><?php echo htmlspecialchars($course['title']); ?></h2>
            <p><strong>Popis:</strong> <?php echo htmlspecialchars($course['description']); ?></p>
            <p><strong>Trvanie:</strong> <?php echo htmlspecialchars($course['duration']); ?> hodín</p>
            <p><strong>Cena:</strong> €<?php echo htmlspecialchars($course['price']); ?></p>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
