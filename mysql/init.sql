/*CREATE DATABASE todo_app;*/

/* баловство */
/* USE todo_app;*/
/*Загружаем дамп из файла */
/*SOURCE /docker-entrypoint-initdb.d/simple_app.sql;*/

CREATE USER 'todo_user'@'localhost' IDENTIFIED BY 'vpob';
GRANT ALL PRIVILEGES ON todo_app.* TO 'todo_user'@'localhost';
FLUSH PRIVILEGES;
