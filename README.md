# Петпроект все в одном образе.

В учебных целях собрал свой докер образ на ubuntu (нужно будет потом переделать) и туда доустановил все компоненты для работы. Nginx+Apache+php+mysql
В другом проекте (Pet_project в репозиториях) сделал все правильно на трех разных контейнерах через docker-compose.

Тут цель была билдить образ и отправлять на DockerHub

Билдится:
  docker build -t pet_proj:latest .

Запуск:
  docker run --name pet_web -p 80:80 -d pet_proj

База и пользователь уже инициализированы.

P.S. Для работы с БД можно использовать docker volume create mysql_data
    и запустить контейнер docker run --name pet_web -v mysql_data:/var/lib/mysql -p 80:80 -d pet_proj

Дальше использовать докер вольюм для копирования дампов БД и восстановления из дампов.
на хосте путь:
/var/lib/docker/volumes/mysql_data/_data

команды внутри контейнера:
mysqldump -u root todo_app > /var/lib/mysql/test_dump.sql
mysql -u root todo_app < /var/lib/mysql/simple_app.sql

Выглядит не красиво но работает :)
