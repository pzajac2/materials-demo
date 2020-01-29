# Materials Demo App

## Uruchomienie aplikacji (Docker)

Wymagania:
 
 * Docker
 * Docker Compose
 
Aby uruchomić aplikację, wystarczy wywołać docker-compose:
```
$ docker-compose up -d
```

Skrypt stworzy kontener z bazą danych MariaDb, serwerem proxy nginx oraz PHP 7.3 (w trybie FPM).

Podczas uruchamiania kontenera uruchamiany jest `composer`, który instaluje w kontenerze zależności, oraz wykonywane są migracje bazy danych.

Po wystartowaniu wszystkich kontenerów, aplikacja dostępna jest pod adresem: `http://localhost:10000/`

## Uruchomienie aplikacji (PHP)

1) Klonujemy projekt

2) Tworzymy na serwerze bazodanowym nową bazę danych.

3) W katalogu `config/autoload/` zmieniamy nazwę pliku `doctrine.local.php.dist` na `doctrine.local.php` i ustawiamy w nim parametry połączenia do bazy danych MySQL/MariaDB.

4) Wywołujemy `composer install`, aby zainstalować zależności

5) Wywołujemy polecenie CLI: `php public/index.php migrations:migrate`, aby wykonać migrację bazy danych.

6) Uruchamiamy aplikację:
```
bash
$ cd path/to/install
$ php -S 0.0.0.0:10000 -t public
```

Po wystartowaniu aplikacja dostępna jest pod adresem: `http://localhost:10000/`

## Uruchomienie aplikacji (Apache)

1) Klonujemy projekt

2) Tworzymy na serwerze bazodanowym nową bazę danych.

3) W katalogu `config/autoload/` zmieniamy nazwę pliku `doctrine.local.php.dist` na `doctrine.local.php` i ustawiamy w nim parametry połączenia do bazy danych MySQL/MariaDB.

4) Wywołujemy `composer install`, aby zainstalować zależności

5) Wywołujemy polecenie CLI: `php public/index.php migrations:migrate`, aby wykonać migrację bazy danych.

6) Konfigurujemy serwer Apache zgodnie z instrukcją ZendFramework:
https://framework.zend.com/manual/2.4/en/user-guide/skeleton-application.html#using-the-apache-web-server