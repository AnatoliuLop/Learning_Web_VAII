<?php
require 'header.php'; // Подключаем хедер

// Получаем параметр 'type' из URL
$type = isset($_GET['type']) ? $_GET['type'] : null;

// Определяем заголовок страницы и структуру формы
$formTitle = '';
$formContent = '';

// Проверяем тип
switch ($type) {
    case 'course':
        $formTitle = 'Pridať nový kurz';
        $formContent = '
            <fieldset>
                <legend>Informácie o kurze</legend>
                <label for="title">Názov kurzu:</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Popis:</label>
                <textarea id="description" name="description" required></textarea>
            </fieldset>
            <fieldset>
                <legend>Detaily kurzu</legend>
                <label for="duration">Dĺžka (v hodinách):</label>
                <input type="number" id="duration" name="duration" required>

                <label for="price">Cena (€):</label>
                <input type="number" step="0.01" id="price" name="price" required>
            </fieldset>
            <fieldset>
                <legend>Fotka kurzu</legend>
                <label for="photo">Fotka kurzu:</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </fieldset>
        ';
        break;

    case 'car':
        $formTitle = 'Pridať nové auto';
        $formContent = '
            <fieldset>
                <legend>Informácie o aute</legend>
                <label for="brand">Značka:</label>
                <input type="text" id="brand" name="brand" required>

                <label for="model">Model:</label>
                <input type="text" id="model" name="model" required>
            </fieldset>
            <fieldset>
                <legend>Detaily auta</legend>
                <label for="year">Rok výroby:</label>
                <input type="number" id="year" name="year" required>

                <label for="fuel_type">Typ paliva:</label>
                <input type="text" id="fuel_type" name="fuel_type" required>

                <label for="license_plate">Evidenčné číslo:</label>
                <input type="text" id="license_plate" name="license_plate" required>
            </fieldset>
            <fieldset>
                <legend>Fotka auta</legend>
                <label for="photo">Fotka auta:</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </fieldset>
        ';
        break;

    case 'instructor':
        $formTitle = 'Pridať nového inštruktora';
        $formContent = '
            <fieldset>
                <legend>Informácie o inštruktorovi</legend>
                <label for="name">Meno:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Telefón:</label>
                <input type="text" id="phone" name="phone" required>

                <label for="specialization">Špecializácia:</label>
                <input type="text" id="specialization" name="specialization" required>
            </fieldset>
            <fieldset>
                <legend>Fotka inštruktora</legend>
                <label for="photo">Fotka inštruktora:</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </fieldset>
        ';
        break;

    default:
        // Перенаправление, если параметр некорректен
        header('Location: index.php');
        exit();
}

?>

<main class="add-entity-content">
    <h2><?php echo $formTitle; ?></h2>
    <form action="process_add_entity.php?type=<?php echo $type; ?>" method="POST" enctype="multipart/form-data" class="styled-form">
        <?php echo $formContent; ?>
        <button type="submit" class="submit-button">Pridať</button>
    </form>
</main>

<?php
require 'footer.php'; // Подключаем футер
?>
