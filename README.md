## Установка приложения

#### Установка зависимостей:
```sh
composer install
npm install
```

#### Копирование переменных окружения:
```sh
cp .env.example .env
```
После копирования, настройте параметры подключения к БД
(DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD)

#### Генерация ключа приложения:
```sh
php artisan key:generate
```

#### Выполните миграции:
```sh
php artisan migrate --seed
```

#### Соберите фронтенд:
```sh
npm run build
```
#### Запустите сервер:
```sh
php artisan serve
```
##### После исполнения всех команд, сервер должен запуститься по [адресу](http:/127.0.0.1:8000)