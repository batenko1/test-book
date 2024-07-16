Тестовое задание.

1. Клонирование репозитория

```txt
git clone https://github.com/batenko1/test-book.git
cd test-book
```

2. Настройка переменных окружения

Создайте файл .env в корне проекта и скопируйте содержимое из .env.example. Для простоты можно оставить настройки по умолчанию.

3. Запуск контейнера

```txt
docker-compose up -d --build
```

4. Установка зависимостей
```
docker-compose exec app composer install
```

5. Генерация ключа приложения
```
docker-compose exec app php artisan key:generate
```

6. Запуск миграция
```
docker-compose exec app php artisan migrate
```

7. Доступ к приложению
```
http://localhost:8888
```

8. API BOOKS
```javascript
http://localhost:8888/api/books
```

9. Запуск Swagger
```
docker exec -it app php artisan l5-swagger:generate
```

10. Запуск тестов
```
docker exec -it app php artisan test
```
