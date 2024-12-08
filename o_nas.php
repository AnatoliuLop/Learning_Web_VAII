<?php
global $pdo;
require 'php/db_connect.php'; // Подключение к базе данных
require 'header.php'; // Подключение хедера
?>

<main class="main-content">
    <a href="add_entity.php?type=instructor" class="btn btn-primary" style="float: right; margin: 10px;">Pridať inštruktora</a>

        <h2 class="stranka-title">O nás</h2>

        <p>Sme moderná autoškola, ktorá kladie dôraz na individuálny prístup ku každému študentovi.</p>

    <section class="about-team">
        <div class="team-header">
            <h3>Náš tím</h3>
            <!-- Кнопка для добавления инструктора -->
        </div>
        <div class="team-photos">
            <?php
            $stmt = $pdo->query("SELECT * FROM instructors");
            $instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($instructors as $instructor): ?>
                <div class="team-member">
                    <img src="<?php echo htmlspecialchars($instructor['photo_path']); ?>"
                         alt="<?php echo htmlspecialchars($instructor['name']); ?>"
                         class="team-photo">
                    <h4><?php echo htmlspecialchars($instructor['name']); ?></h4>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($instructor['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($instructor['phone']); ?></p>
                    <p><strong>Specialisation:</strong> <?php echo htmlspecialchars($instructor['specialization']); ?></p>
                    <!-- Кнопки удаления и редактирования -->
                    <a href="edit_item.php?type=instructor&id=<?php echo $instructor['id']; ?>" class="btn btn-warning">Upraviť</a>
                    <a href="delete_item.php?type=instructor&id=<?php echo $instructor['id']; ?>" class="btn btn-danger">Vymazať</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php
require 'footer.php'; // Подключение футера
?>
