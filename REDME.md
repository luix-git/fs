#Использование curl

Поиск мануалов:
https://www.opennet.ru/man.shtml

1. Первый запрос:
curl http://fs

2. Используем режим "silent" для отключения вывода информации о загрузке.
curl --silent http://fs
curl -s http://fs

3. Включаем режим "include" для отображения заголовков:
curl -s -i http://fs

4. Проверяем ответ с использованием разных методов:
curl -X GET -si http://fs
curl -X POST -si http://fs

5. Проверяем метод api до мёрджа, для проверки 404-го кода ответа.
curl -X GET -si http://fs/api

5. Проверяем метод api до мёрджа, для проверки 404-го кода ответа.
curl -X GET -si http://fs/api

6. Используем запрос для получения времени.
curl -X GET -si http://fs/api/time.php

7. Получаем 405 код ответа для для метода api получения времени.
curl -X POST -si http://fs/api/time.php

8. Пробуем использовать метод требующий авторизацию
curl -X GET -si http://fs/api/user.php

9. Используем заголовок "Authorization" и получаем информацию о пользователе.
curl -X GET -si http://fs/api/user.php -H "Authorization: Basic dXNlcjoxMjM0NQ=="

10. Добавляем заголовок "Content-Type: application/json" и отправляем новые данные о пользователе.
curl -X POST -si http://fs/api/user.php -H "Authorization: Basic dXNlcjoxMjM0NQ==" -H "Content-Type: application/json" -d '{"description":"just a user"}'

11. Проверяем изменение значений из п.9