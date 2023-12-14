<?php
$servername = "127.0.0.1"; // Адрес сервера базы данных
$username = "todo_user";   // Имя пользователя базы данных
$password = "vpob"; // Пароль пользователя базы данных
$dbname = "todo_app";       // Имя базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Создаем таблицу, если она не существует
$sql = "CREATE TABLE IF NOT EXISTS key_values (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key_column VARCHAR(255) NOT NULL,
    value_column VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error creating table: " . $conn->error;
}
?>
