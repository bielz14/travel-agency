# Travel Agency - Laravel 12 Project

**Дипломный проект:** Сайт туристического агентства с полной функциональностью на Laravel 12.

---

## 📌 Описание проекта

Проект представляет собой веб-приложение для туристического агентства, включающее:

- Каталог туров с поиском по стране, городу, цене и дате
- Просмотр подробного описания тура, включая город и отель
- Возможность бронирования тура через форму
- Оставление отзывов на туры
- Админка (CRUD) для всех сущностей через Filament
- Полная структура БД уровня диплома
- Docker-окружение для быстрого запуска на любой машине

Технологии:

- PHP 8.2, Laravel 12
- MySQL 8
- Nginx
- Docker / Docker Compose
- Blade templates
- Filament Admin Panel

---

## 🗂 Структура проекта

```text
travel-agency/
├── app/
│   ├── Models/
│   └── Http/Controllers/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
├── routes/web.php
├── Dockerfile
├── docker-compose.yml
└── nginx/default.conf
```

## 🚀 Быстрый запуск проекта на ПК, на котором он еще не запускался ранее

Выполните следующие команды в терминале **из корня проекта**:

```bash
# 1. Сборка Docker-образов
docker-compose build

# 2. Запуск контейнеров в фоне
docker-compose up -d

# 3. Генерация ключа приложения Laravel
docker-compose exec app php artisan key:generate

# 4. Зайти в контейнер приложения
docker-compose exec app bash

# 5. Установить зависимости Composer
composer install

# 6. Вийти с контейнера приложения
exit

# 7. Применение миграций для базы данных
docker-compose exec app php artisan migrate

# 8. Заполнение тестовыми данными (seed)
docker-compose exec app php artisan db:seed

# 9. Запуск фронтенд сервера 
docker exec -it travel-app npm run dev

```

## 🚀 Быстрый запуск проекта, если он уже запускался ранее на текущем ПК

Выполните следующие команды в терминале **из корня проекта**:

```bash

# 1. Запуск контейнеров в фоне
docker-compose up -d

# 2. Запуск фронтенд сервера 
docker exec -it travel-app npm run dev
```
