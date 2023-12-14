<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
error_log("Debug message: Something happened", 3, "/tmp/phpdebug.log");
include 'db_connection.php';

function saveToDatabase($key, $value) {
	global $conn;

	// Защита от SQL-инъекций
    $key = mysqli_real_escape_string($conn, $key);
    $value = mysqli_real_escape_string($conn, $value);

    // Вставка данных в таблицу
    $sql = "INSERT INTO key_values (key_column, value_column) VALUES ('$key', '$value')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Данные успешно сохранены в базе данных";
    } else {
	    echo "Ошибка: " . $conn->error;

	    error_log("Database Error: " . $conn->error, 3, "/tmp/phpdebug.log");
    }
}

// Обработка формы для сохранения в базу данных
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["saveToDatabase"])) {
    $key = $_POST["key"];
    $value = $_POST["value"];
	

    	echo "Received key: $key<br>";
    	echo "Received value: $value<br>";

	saveToDatabase($key, $value);

	// Перенаправление на другую страницу через 1 сек
    	echo '<script>
            setTimeout(function() {
                window.location.href = "index.php";
            }, 1000);
          </script>';
    	exit();
}

$conn->close();
?>
