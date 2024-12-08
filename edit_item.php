<?php
global $pdo;
require 'php/db_connect.php'; // Подключение к базе данных

$type = isset($_GET['type']) ? $_GET['type'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$type || !$id) {
    header('Location: index.php'); // Если параметров нет, перенаправляем
    exit();
}

// Получаем данные для редактирования
switch ($type) {
    case 'course':
        $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
        break;
    case 'car':
        $stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
        break;
    case 'instructor':
        $stmt = $pdo->prepare("SELECT * FROM instructors WHERE id = ?");
        break;
    default:
        header('Location: index.php');
        exit();
}
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    header('Location: index.php');
    exit();
}

// Обработка формы редактирования
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($type) {
        case 'course':
            $stmt = $pdo->prepare("UPDATE courses SET title = ?, description = ?, duration = ?, price = ?, photo_path = ? WHERE id = ?");
            $photoPath = $item['photo_path']; // Сохраняем текущий путь, если фото не загружено
            if (!empty($_FILES['photo']['tmp_name'])) {
                $photoPath = 'uploads/courses/' . basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
            }
            $stmt->execute([
                $_POST['title'], $_POST['description'], $_POST['duration'], $_POST['price'], $photoPath, $id
            ]);
            header("Location: kurzy.php"); // Редирект на страницу с курсами
            exit();

        case 'car':
            $stmt = $pdo->prepare("UPDATE cars SET brand = ?, model = ?, year = ?, fuel_type = ?, license_plate = ?, photo_path = ? WHERE id = ?");
            $photoPath = $item['photo_path'];
            if (!empty($_FILES['photo']['tmp_name'])) {
                $photoPath = 'uploads/cars/' . basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
            }
            $stmt->execute([
                $_POST['brand'], $_POST['model'], $_POST['year'], $_POST['fuel_type'], $_POST['license_plate'], $photoPath, $id
            ]);
            header("Location: auta.php"); // Редирект на страницу с автомобилями
            exit();

        case 'instructor':
            $stmt = $pdo->prepare("UPDATE instructors SET name = ?, email = ?, phone = ?, specialization = ?, photo_path = ? WHERE id = ?");
            $photoPath = $item['photo_path'];
            if (!empty($_FILES['photo']['tmp_name'])) {
                $photoPath = 'uploads/instructors/' . basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
            }
            $stmt->execute([
                $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['specialization'], $photoPath, $id
            ]);
            header("Location: o_nas.php"); // Редирект на страницу с инструкторами
            exit();

    }
    header("Location: {$type}.php");
    exit();
}
require 'header.php'; // Подключаем хедер
?>
<main class="edit-content">
    <h2>Upraviť <?php echo ucfirst($type); ?></h2>
    <form action="" method="POST" enctype="multipart/form-data" class="styled-form">
        <?php if ($type === 'course'): ?>
            <label for="title">Názov kurzu:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($item['title']); ?>" required>

            <label for="description">Popis:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($item['description']); ?></textarea>

            <label for="duration">Dĺžka (hodiny):</label>
            <input type="number" id="duration" name="duration" value="<?php echo htmlspecialchars($item['duration']); ?>" required>

            <label for="price">Cena (€):</label>
            <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($item['price']); ?>" required>

            <label for="photo">Fotka kurzu:</label>
            <input type="file" id="photo" name="photo">
        <?php elseif ($type === 'car'): ?>
            <label for="brand">Značka:</label>
            <input type="text" id="brand" name="brand" value="<?php echo htmlspecialchars($item['brand']); ?>" required>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" value="<?php echo htmlspecialchars($item['model']); ?>" required>

            <label for="year">Rok:</label>
            <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($item['year']); ?>" required>

            <label for="fuel_type">Palivo:</label>
            <input type="text" id="fuel_type" name="fuel_type" value="<?php echo htmlspecialchars($item['fuel_type']); ?>" required>

            <label for="license_plate">Evidenčné číslo:</label>
            <input type="text" id="license_plate" name="license_plate" value="<?php echo htmlspecialchars($item['license_plate']); ?>" required>

            <label for="photo">Fotka auta:</label>
            <input type="file" id="photo" name="photo">
        <?php elseif ($type === 'instructor'): ?>
            <label for="name">Meno:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($item['email']); ?>" required>

            <label for="phone">Telefón:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($item['phone']); ?>" required>

            <label for="specialization">Špecializácia:</label>
            <textarea id="specialization" name="specialization" required><?php echo htmlspecialchars($item['specialization']); ?></textarea>

            <label for="photo">Fotka inštruktora:</label>
            <input type="file" id="photo" name="photo">
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Uložiť zmeny</button>
    </form>
</main>
<?php require 'footer.php'; ?>
