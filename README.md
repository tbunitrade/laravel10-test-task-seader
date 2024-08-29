<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel
Что было сделано:
Определение маршрутов: Добавлен маршрут для получения списка позиций в routes/api.php.
Проверка контроллера: Убедились, что PositionController настроен правильно и использует модель Position для получения всех записей из таблицы.
Тестирование API: Используя curl, убедились, что API возвращает ожидаемый результат.
Что дальше?
Теперь у нас есть работающая API для получения позиций. Давайте продолжим с оставшимися задачами из технического задания (ТЗ):

Работа с изображениями:

Загрузить и обрезать изображение до 70x70 пикселей.
Оптимизировать изображение, используя API (например, TinyPNG).
Работа с токенами:

Продемонстрировать использование токенов авторизации при выполнении POST-запроса.
Создание frontend:

Отобразить список пользователей с кнопкой "Показать больше", выводя по 6 пользователей на странице.
Создать форму для добавления нового пользователя с валидацией на стороне сервера.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
