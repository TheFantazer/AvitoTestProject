# Laravel Avito Merch Shop

Этот проект представляет собой сервис для магазина мерча, где сотрудники могут обмениваться монетами и покупать товары. Проект реализован на Laravel с использованием JWT для аутентификации.

## Оглавление

- [Требования](#требования)
- [Установка](#установка)
- [Настройка](#настройка)
- [Запуск](#запуск)
- [API Endpoints](#api-endpoints)
- [Тестирование](#тестирование)
- [Лицензия](#лицензия)

---

## Требования

- PHP 8.2
- Composer
- PostgreSQL
- Docker (опционально)

---

## Установка

1. Клонируй репозиторий:

   ```bash
   git clone https://github.com/TheFantazer/AvitoTestProject.git
   cd ваш-репозиторий
в bash (предварительно запустив сам docker): 
docker-compose up -d


Сервер будет доступен по адресу http://localhost:8080.


К сожалению чуть чуть не успевал по срокам и не успел прикрутить swagger документацию(возникли небольшие шоколадки)


API Endpoints
### Регистрация

- **Метод:** `POST`
- **URL:** `/api/register`
- **Тело запроса (JSON):**

  ```json
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password"
  }
Ответ:

  ```json 
{
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2023-10-10T12:00:00.000000Z",
    "updated_at": "2023-10-10T12:00:00.000000Z"
  },
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```
### Аутентификация
**Метод: POST**

URL: /api/auth

Тело запроса (JSON):

```json
{
  "email": "john@example.com",
  "password": "password"
}
```
Ответ:

```json
Copy
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```
### Получение информации о пользователе
**Метод: GET**

URL: /api/info

Заголовки:

Authorization: Bearer <ваш_токен>

Ответ:

```json

{
  "coins": 1000,
  "inventory": [],
  "coinHistory": {
    "received": [],
    "sent": []
  }
}
```
### Отправка монет
**Метод: POST**

URL: /api/sendCoin

Заголовки:

Authorization: Bearer <ваш_токен>

Тело запроса (JSON):

```json
{
  "toUser": 2,
  "amount": 100
}
```
Ответ:

```json
{
  "message": "Coins sent successfully"
}
```
### Покупка товара
**Метод: GET**

URL: /api/buy/{item}

Заголовки:

Authorization: Bearer <ваш_токен>

Ответ:

```json
{
  "message": "Product purchased successfully"
}
```
### Тестирование
Запусти тесты:

bash
Copy
php artisan test
Примеры тестов находятся в папке tests/Feature.
