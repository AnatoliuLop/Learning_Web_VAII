document.getElementById('add-course-form').addEventListener('submit', function (e) {
    const duration = document.getElementById('duration').value;
    const price = document.getElementById('price').value;

    // Проверка на минимальные значения
    if (duration < 1) {
        alert("ERROR : Must be > 1 hour.");
        e.preventDefault(); // Останавливаем отправку формы
    }

    if (price < 10) {
        alert("ERROR : Must be > 10 Eur.");
        e.preventDefault();
    }
});
