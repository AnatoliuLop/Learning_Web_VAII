<?php
global $pdo;
require 'php/db_connect.php'; // Подключение к базе данных
require 'header.php'; // Хедер
?>

<main class="kurzy-content">
    <div class="auta-header">
        <h2 class="stranka-title">Naše kurzy</h2>
        <!-- Кнопка перенаправления на формуляр -->
        <a href="add_entity.php?type=course" class="btn btn-primary" style="float: right; margin: 10px;">Pridať kurz</a>
        <!-- Кнопка для добавления автомобиля -->
    </div>

    <div class="">

    </div>


    <div class="courses-container">
        <?php
        $stmt = $pdo->query("SELECT * FROM courses");
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($courses as $course): ?>
            <div class="course-card">
                <img src="<?php echo htmlspecialchars($course['photo_path']); ?>" alt="Фото курса" class="course-photo">
                <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                <p><strong>Popis:</strong> <?php echo htmlspecialchars($course['description']); ?></p>
                <p><strong>Dĺžka:</strong> <?php echo htmlspecialchars($course['duration']); ?> hodín</p>
                <p><strong>Cena:</strong> €<?php echo htmlspecialchars($course['price']); ?></p>

                <!-- Кнопки снизу -->
                <div class="action-buttons">
                    <a href="edit_item.php?type=course&id=<?php echo $course['id']; ?>" class="btn btn-warning">Upraviť</a>
                    <a href="delete_item.php?type=course&id=<?php echo $course['id']; ?>" class="btn btn-danger">Vymazať</a>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</main>

<?php
require 'footer.php'; // Футер
?>
