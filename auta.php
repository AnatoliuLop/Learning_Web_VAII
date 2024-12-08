<?php
global $pdo;
require 'php/db_connect.php'; // Подключение к базе данных
require 'header.php'; // Подключение хедера
?>

<main class="auta-content">
    <div class="auta-header">
        <a href="add_entity.php?type=car" class="btn btn-primary" style="float: right; margin: 10px;">Pridať auto</a>

        <h2 class="stranka-title">Naše Auta</h2>
        <!-- Кнопка для добавления автомобиля -->
    </div>

    <div class="auta-container">
        <?php
        $stmt = $pdo->query("SELECT * FROM cars");
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cars as $car): ?>
            <div class="car-card">
                <img src="<?php echo htmlspecialchars($car['photo_path']); ?>" alt="Fotka auta" class="car-photo">
                <h3><?php echo htmlspecialchars($car['brand']); ?> <?php echo htmlspecialchars($car['model']); ?></h3>
                <p><strong>Palivo:</strong> <?php echo htmlspecialchars($car['fuel_type']); ?></p>
                <p><strong>Rok:</strong> <?php echo htmlspecialchars($car['year']); ?></p>
                <p><strong>Evidenčné číslo:</strong> <?php echo htmlspecialchars($car['license_plate']); ?></p>
                <!-- Кнопки удаления и редактирования -->
                <a href="edit_item.php?type=car&id=<?php echo $car['id']; ?>" class="btn btn-warning">Upraviť</a>
                <a href="delete_item.php?type=car&id=<?php echo $car['id']; ?>" class="btn btn-danger">Vymazať</a>

            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php
require 'footer.php'; // Подключение футера
?>
