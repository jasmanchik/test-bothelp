## Тестовое задание на работу с очередями

1) Запуск проекта `make init`
2) Установить зависимости проекта `make composer`
3) Запустить миграции и заполнить фейковыми данными `make laravel-migrate-fresh-seed` (сразу может не заработать, секунд 30 идет запуск mysql процесса)
4) Остановить приложение `make down`

Попробовал реализовать фейковые запросы, но в рамках масштаба задачи, кроме написания теста ничего умнее не придумал (php artisan test). Кол-во запросов можно регулировать в свойстве $requestsCount (/tests/Unit/UserTest.php)

Воркеры никакие запускать не надо, само все поднимется через supervisor. Кол-во процессов, отвечающие за воркер, можно регулировать в кфг супервизора (/docker/supervisor/supervisord.conf).

Задачи работают на базе mysql. Сохраняются в таблицу "jobs", результатом успешной выполненной задачи будет запись в таблицу "user_events"
В зависимости от масштаба проекта можно сделать очередь на redis допустим
