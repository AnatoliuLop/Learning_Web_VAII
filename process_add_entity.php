<?php
global $pdo;
require 'php/db_connect.php'; // Подключение к базе данных

$type = isset($_GET['type']) ? $_GET['type'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($type) {
        case 'course':
            // Обработка данных курсов
            $title = $_POST['title'];
            $description = $_POST['description'];
            $duration = $_POST['duration'];
            $price = $_POST['price'];
            $photoPath = '';
            if (!empty($_FILES['photo']['tmp_name'])) {
                if (!file_exists('uploads/courses/')) {
                    mkdir('uploads/courses/', 0777, true);
                }
                $photoPath = 'uploads/courses/' . basename($_FILES['photo']['name']);
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                    die("Error upload  photo for course.");
                }
            }

            $stmt = $pdo->prepare("INSERT INTO courses (title, description, duration, price, photo_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $duration, $price, $photoPath]);
            header("Location: kurzy.php");
            exit();

        case 'car':
            // Обработка данных автомобилей
            $brand = $_POST['brand'];
            $model = $_POST['model'];
            $year = $_POST['year'];
            $fuelType = $_POST['fuel_type'];
            $licensePlate = $_POST['license_plate'];
            $photoPath = '';
            if (!empty($_FILES['photo']['tmp_name'])) {
                if (!file_exists('uploads/cars/')) {
                    mkdir('uploads/cars/', 0777, true);
                }
                $photoPath = 'uploads/cars/' . basename($_FILES['photo']['name']);
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                    die("Error upload  photo for car.");
                }
            }

            $stmt = $pdo->prepare("INSERT INTO cars (brand, model, year, fuel_type, license_plate, photo_path) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$brand, $model, $year, $fuelType, $licensePlate, $photoPath]);
            header("Location: auta.php");
            exit();

        case 'instructor':
            // Обработка данных инструкторов
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $specialization = $_POST['specialization'];
            $photoPath = '';

            if (!empty($_FILES['photo']['tmp_name'])) {
                if (!file_exists('uploads/instructors/')) {
                    mkdir('uploads/instructors/', 0777, true);
                }
                $photoPath = 'uploads/instructors/' . basename($_FILES['photo']['name']);
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                    die("Error upload  photo for instructor.");
                }
            }

            $stmt = $pdo->prepare("INSERT INTO instructors (name, email, phone, specialization, photo_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $specialization, $photoPath]);
            header("Location: o_nas.php");
            exit();

        default:
            header('Location: index.php');
            exit();
    }

}

