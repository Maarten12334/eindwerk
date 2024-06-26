# Holiday Hero

![Projectafbeelding](public/images/logo.png)

## Inhoudsopgave

-   [Beschrijving](#beschrijving)
-   [Installatie](#installatie)
-   [Features](#features)
-   [Toekomstige features](#toekomstige-features)

## Beschrijving

Deze applicatie is gemaakt om snel en eenvoudig een reisschema samen te stellen. Gebruikers kunnen een account aanmaken via laravel/breeze. Hierna kunnen ze een reisschema maken en per dag hotels en activiteiten toevoegen.

## Installatie

Stap voor stap instructies

```bash
git clone https://github.com/Maarten12334/eindwerk
cd eindwerk
composer install
npm install
npm run build
cp .env.example .env
```

.env amdeusapi en google places api keys toevoegen
.env database instellen

```bash
php artisan key:generate
php artisan migrate
php artisan serve
```

## Features

-   Maak een account aan
-   Maak een reisschema
-   Zoek hotels via de google places api
-   Voeg hotels toe aan een reisschema
-   Zoek vluchten via de amadeus api
-   Download een reisschema als pdf
-   Via een qr code op de pdf-file online het reisschema bekijken

## Toekomstige-features

-   Vluchten koppelen aan een reisschema
-   Hotels zoeken met de bookings API
-   Hotels filteren op basis van prijs, faciliteiten,...
