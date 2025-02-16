# Laravel Avito Merch Shop

Этот проект представляет собой сервис для магазина мерча, где сотрудники могут обмениваться монетами и покупать товары. Проект реализован на Laravel с использованием JWT для аутентификации.

## Оглавление

- [Требования](#требования)
- [Установка](#установка)
- [Настройка](#настройка)
- [Запуск](#запуск)
- [API Endpoints](#api-endpoints)
- [Тестирование](#тестирование)

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
php artisan test
Примеры тестов находятся в папке tests/Feature.

### Сложности и особенности во время проектирования)
Во-первых, хочу отметить что задание на первый взгляд казалось таким же как все остальные тестовые задания в другие компании, обычный api вроде планировщика заданий, ну подумаешь, еще авторизация через jwt токен есть, тоже такое делали, чтобы из docker запускалось, да тоже вроде ничего особенного. Но то ли я распереживался, то ли фаза луны такая, но у меня ушло почти 30 часов на это все) проект я отправил практически ровно в 00, когда заканчивался дедлайн, честно, не горжусь этим. 

Так с чем же возникли сложности?
1) Ну, во-первых docker образ который вы дали как пример, естественно просто скопировать не получилось) получилась несостыковка версий php и laravel (framework) и я решил что мне проще будет переписать dockerfile для php(ну а вдруг вы заметите и это будет плюсом -_-), что собственно и сделал. Единственное, я не поставил никакой архиватор, а без него все архивы ставятся за счет php расширений, что иногда может подпортить установку чего-либо. 
2) Контроллеры и всю логику я написал быстро, там особо ничего сложного, все привычно. Проблемная ситуация была с моим любимым swagger'ом, ну, поставил я как обычно l5-darkonline, решил что хочу красиво, создал отдельный файл, накидал туда конфигурацию (ее я часто генерю через ai, как и в этот раз, но проблема точно не в этом была), настроил в общем конфигурацию, думаю, ну все, пора проверять. Но, тщетно. Спустя несколько часов обнаружил, что swagger поставился криво, причина - отсутствие в контейнере какого либо архиватора (ну да, зато dockerfile сам написал). Вообще в планах было еще графический интерфейс хоть какой-то прикрутить, но, честно, поздно спохватился. 
