# REST API

REST API для интернет-магазина. Реализация на Laravel 12 с архитектурой сервисов, репозиториев, кастомной аутентификацией и стандартизированными API Resource-ответами.

---

## Быстрый старт

1. **Установите зависимости:**
   ```bash
   composer install
   ```
2. **Создайте .env:**
   ```bash
   cp .env.example .env
   ```
   В `.env`:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```
3. **Создайте файл базы:**
   ```bash
   touch database/database.sqlite
   ```
4. **Выполните миграции и сидеры:**
   ```bash
   php artisan migrate --seed
   ```
5. **Запустите сервер:**
   ```bash
   php artisan serve
   ```

---

## Тестирование

```bash
php artisan test
```

---

## Документация API

- **Postman collection:** [`docs/postman_collection.json`](docs/postman_collection.json)


### Основные эндпоинты

| Метод | URL                  | Описание                       | Авторизация         |
|-------|----------------------|--------------------------------|---------------------|
| POST  | /api/register        | Регистрация пользователя       | Нет                |
| POST  | /api/login           | Логин, выдаёт Basic-токен      | Нет                |
| GET   | /api/products        | Список товаров                 | Нет                |
| POST  | /api/orders          | Создать заказ                  | Basic Auth          |
| GET   | /api/orders?user_id=1| История заказов пользователя   | Basic Auth          |

**Пример Basic Auth:**
- Логин: телефон
- Пароль: пароль
- Заголовок: `Authorization: Basic base64(phone:password)`

---

## Архитектура и лучшие практики
- SOLID: бизнес-логика в сервисах и репозиториях (`app/Services`, `app/Repositories`)
- Абстрактный репозиторий для CRUD-операций
- Вся валидация через FormRequest-классы
- Ответы через Laravel API Resource для единообразия
- Кастомный middleware Basic Auth для заказов
- Конфигурируемый статус заказа через `config/orders.php`
- Стандартизированная обработка ошибок (422 — JSON)

---

## Seeders и тестовые данные
- Сидеры продуктов: `php artisan db:seed`
- Пользователь создаётся через регистрацию

---


## Тесты
- Покрытие: регистрация, логин, создание заказа, история заказов
- Запуск: `php artisan test`

---
