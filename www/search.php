<?php
include 'db_connection.php';

// Получение параметров поиска из POST-запроса
$searchKey = $_POST['searchKey'] ?? '';
$searchValue = $_POST['searchValue'] ?? '';

// Защита от SQL-инъекций
$searchKey = mysqli_real_escape_string($conn, $searchKey);
$searchValue = mysqli_real_escape_string($conn, $searchValue);

// Формирование запроса к базе данных в зависимости от наличия параметров
$sql = "SELECT * FROM key_values WHERE ";
if ($searchKey) {
    $sql .= "key_column LIKE '%$searchKey%'";
}
if ($searchValue) {
    $sql .= ($searchKey ? " AND " : "") . "value_column LIKE '%$searchValue%'";
}

// Выполнение запроса
$result = $conn->query($sql);

// Формирование HTML-кода с результатами
$html = '<ul>';
while ($row = $result->fetch_assoc()) {
    $html .= '<li>' . $row['key_column'] . ': ' . $row['value_column'] . '</li>';
}
$html .= '</ul>';

// Возвращение HTML-кода
echo $html;

// Закрытие соединения с базой данных
$conn->close();
?>
