# Ads Catalog

Katalog ogłoszeń. Aplikacja, której zadaniem jest zarządzanie ogłoszeniami z listami zakupów. Dzięki połączeniu z API geolokalizacji pozwala na przeszukiwanie zgłoszeń na zadanym obszarze. 

### Instalacja na środowisku deweloperskim

Instalacja zależności comoposer:

```
composer install
```

Konfiguracja pliku .env
```
 cp .env.example .env
```

**_W pliku .env należy ustawić odpowiednie dane dostępu do bazy danych itp._**

Uruchomienie kontenerów docker'owych
```
docker-compose up -d
```

Uruchomienie migracji bazodanowych
```
docker container exec ads-catalog-fpm php artisan migrate
```

Wygenerowanie klientów OAuth
```
docker container exec idp-php-fpm php artisan passport:install
```

### Po skonfigurowaniu aplikacja powinna być dostępna na:

```
localhost:20004
```

### Aplikacja jest publicznie dostępna na:
http://api.grocelivery.eu/ads
