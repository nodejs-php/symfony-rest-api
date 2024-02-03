# Цель проекта

Разработать REST API для работы с покемонами. Там же должен быть ``docker``. Тестироваться будет ``Unit Test``

## Пример работы с командами Symfony из докер-контейнера
- ``docker compose exec php  composer require --dev symfony/test-pack``
- `` docker compose exec php  php bin/phpunit``

Установлена система логгирования на ``xdebug`` в файл ``xdebug.log`` на случай несли упадет или нужно будет включать 
другие режимы отладки в ```PHPSTORM```

## Загрузка фикстур
- ``docker compose exec php  php bin/console  doctrine:fixtures:load``