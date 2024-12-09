<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoškola PRO</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/validation.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.add-form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    let isValid = true; // Флаг для проверки формы
                    const errorMessages = []; // Массив для сообщений об ошибках


                    if (form.querySelector('#duration')) {
                        const duration = parseInt(form.querySelector('#duration').value);
                        if (isNaN(duration) || duration <= 1) {
                            isValid = false;
                            errorMessages.push('Dĺžka kurzu musí byť väčšia ako 1 hodina.');
                            form.querySelector('#duration').classList.add('input-error');
                        } else {
                            form.querySelector('#duration').classList.remove('input-error');
                        }
                    }

                    if (form.querySelector('#price')) {
                        const price = parseFloat(form.querySelector('#price').value);
                        if (isNaN(price) || price <= 10) {
                            isValid = false;
                            errorMessages.push('Cena kurzu musí byť vyššia ako 10 eur.');
                            form.querySelector('#price').classList.add('input-error');
                        } else {
                            form.querySelector('#price').classList.remove('input-error');
                        }
                    }


                    if (form.querySelector('#year')) {
                        const year = parseInt(form.querySelector('#year').value);
                        const currentYear = new Date().getFullYear();
                        if (isNaN(year) || year > currentYear || year < 1950) {
                            isValid = false;
                            errorMessages.push('Rok výroby nemôže byť väčší ako aktuálny rok.');
                            form.querySelector('#year').classList.add('input-error');
                        } else {
                            form.querySelector('#year').classList.remove('input-error');
                        }
                    }


                    if (form.querySelector('#phone')) {
                        const phone = form.querySelector('#phone').value;
                        const slovakPhoneRegex = /^(?:\+421|0)(?:\d{9})$/;
                        if (!slovakPhoneRegex.test(phone)) {
                            isValid = false;
                            errorMessages.push('ERROR: Nie slovak number. Must be +421123456789 or 0901234567');
                            form.querySelector('#phone').classList.add('input-error');
                        } else {
                            form.querySelector('#phone').classList.remove('input-error');
                        }
                    }

                    // Если форма некорректна, отменяем отправку и выводим ошибки
                    if (!isValid) {
                        e.preventDefault();

                        // Выводим сообщения об ошибках в alert или на странице
                        alert(errorMessages.join('\n'));
                    }
                });
            }
        });


    </script>
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo">
            <img src="images/Logo.png" alt="Logo">
        </div>
        <h1>Naše kurzy</h1>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">Hlavná</a></li>
                <li><a href="o_nas.php">O nás</a></li>
                <li><a href="kurzy.php">Kurzy</a></li>
                <li><a href="auta.php">Naše autá</a></li>
                <li><a href="skusky.php">Skúšky</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
            </ul>
        </nav>
    </div>
</header>
