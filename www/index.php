<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Pet - proj</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap">
</head>
<body>
    <div class="header">
    <h1>Простенький Пет</h1>
    </div>
    <h3>Сохранить значения</h3>
    <div class="container">
        <form action="" method="post">
            <input type="text" name="key" id="key" placeholder="Ключ" required>
            <input type="text" name="value" id="value" placeholder="Значение" required>
            <button type="submit" name="saveToDatabase">Сохранить в Базу</button>
        </form>
    </div>

    <h3>Отправить запрос</h3>
    <h5> поиск по ключу или значению </h5>
        <div class="container">
       <form id="searchForm" onsubmit="searchRecords(); return false;">
        <input type="text" name="searchKey" id="searchKey" placeholder="Ключ">
        <input type="text" name="searchValue" id="searchValue" placeholder="Значение">
        <button type="submit">Запросить из Базы</button>
	</form>

	</div>

        <div id="searchResults">
        <!-- Здесь будут отображаться результаты поиска -->
        </div>


        <script>
        function searchRecords() {
            var searchKey = document.getElementById('searchKey').value;
            var searchValue = document.getElementById('searchValue').value;

            // Проверка наличия хотя бы одного значения
            if (!searchKey && !searchValue) {
                alert('Введите хотя бы одно значение для поиска.');
                return;
            }

            // Создание объекта XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Настройка запроса
            xhr.open('POST', 'search.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Определение функции, которая будет вызвана при изменении состояния запроса
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Обновление содержимого блока с результатами
                    document.getElementById('searchResults').innerHTML = xhr.responseText;
                }
            };

            // Формирование данных для отправки
            var data = 'searchKey=' + encodeURIComponent(searchKey) + '&searchValue=' + encodeURIComponent(searchValue);

            // Отправка запроса
            xhr.send(data);
        }
        </script>
        
    

    <ul>
        <!-- Display tasks from the database here -->
        <?php
            include 'process.php';
        ?>
    </ul>
</body>
</html>
