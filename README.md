* 09.03.2025 добавил реализацию sql-запроса join в Query builder. Теперь в IndexController 2 запроса вместо 3. Также добавил округление стоимости после пересчета по 
  текущему курсу. Но отдельно отмечу, что без этих изменений также ВСЕ РАБОТАЛО. Эти изменения - просто небольшие улучшения. 
* В проекте, как и было указано в ТЗ, НЕ использовались php-фреймовки. Все компоненты, не касающиеся ТЗ и не указанные в Зависимостях, реализовывались мной
* Разработка велась на PHP 8.3
  
Разворачивание проекта:

Необходимо запустить composer install

В файле .env задаются данные для подключения к БД.

Дамп базы в файле dump.sql

Входная точка проекта: папка public
-------------------------------
Код, который относится непосредственно к ТЗ:

App/Http/Controllers/IndexController.php - контроллер, который принимает запросы пользователя

App/Http/Factories/PizzaFactory.php - реализовал паттерн Абстрактной фабрики для объекта пиццы 

App/Http/Models/Pizzas - здесь хранятся все классы пицц, которые юзер может заказать

App/Http/Models/OrderModel.php - класс, описывающий сущность заказа

App/Http/Services/CurrencyRateService.php - сервис для получения текущего курса доллара США к рублю

routes/web.php - список роутов в проекте

public/asset/js/order.js - js код для взаимодействия с фронтом

resources/ - хранит twig-шаблоны 

---------------------------------
Архитектура проекта:

Архитектур "вдохновлена" фреймворком Laravel

Основные компоненты системы находятся в App/Kernel. К ним относятся:
  
  роутер. Работает с get и post запросами. В метод контроллера, который обрабатывает запрос, прокидывается объект Request $request с данными запроса 
  
  кнотейнер зависимостей,
  
  компонент взаимодействия с шаблонизатором twig,
  
  компонент взаимодействия с БД (подключение и построитель запросов)
  
 Вспомогательные классы находятся в app/Facades. К ним относятся:
 коллекции для обертки данных из бд,
 обертка для работы с GET/POST запросами
 
Шаблоны находятся в папке /resources

Зависимости:
  Twig,
  библиотека для работы с env файлами
  библиотека для работы с http-запросами

