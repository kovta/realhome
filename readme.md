# Realhome - Laravel project

### Telepítés

Minimum requirements:
- PHP
- imagick
- Node+npm
- Mysql
- Lásd. composer.json

- A storage/wkhtmltox/bin/ könyvtárban levő fájlok futtathatóak kell hogy legyenek, különben a pdf/img generálás nem fog menni.

##### Telepítés fejlesztői "dev" környezetbe:
1. .env változó létrehozása és átírása

2. dependenciák letöltése, telepítése
    ```
    composer install
    npm install
    php artisan storage:link
    ```
    Cpanel esetén:
    ```
    /usr/local/bin/ea-php80 -d allow_url_fopen=on /opt/cpanel/composer/bin/composer install
    npm install
    npm run production --section=backoffice && npm run production --section=frontoffice
    /usr/local/bin/ea-php80 artisan storage:link
    ```
    Ha telepítve van Telescope, akkor ahhoz külön:
    ```
    php artisan telescope:publish
    ```
3. asset-ek legenerálása:
    - Lásd alább a megfelelő bekezdésnél.

##### Fejlesztői "dev" környezetben fontos! 
A **chmod()** permission dennied hibára fut és a fájlfeltöltés nem fog működni,
ezért (a .gitignore-ban is szereplő) érintett fájlban a chmod()-ot tartalmazó függvény adott részét ki kell
kommentezni és a kimenet értékét simán true-ra átállítan.

##### Telepítés éles "production" környezetbe:
1. .env file létrehozása és átírása a sablon fájl alapján
    - Itt szabályozható a Telescope elérése is (pl: administartors role)

2. dependenciák letöltése, telepítése
    ```
    composer install --no-dev
    npm run production --section=backoffice
    npm run production --section=frontoffice
    php artisan storage:link
    ```
    Cpanel esetén:
    ```
    /usr/local/bin/ea-php80 -d allow_url_fopen=on /opt/cpanel/composer/bin/composer install
    npm install
    npm run production --section=backoffice && npm run production --section=frontoffice
    /usr/local/bin/ea-php80 artisan storage:link
    ```
   Ha itt "ERR_OSSL_EVP_UNSUPPORTED" hibára fut az npm, akkor kiadni a parancsot, a nodejs régebbi openssl-t használjon:
   ```
   export NODE_OPTIONS=--openssl-legacy-provider
   ```
    Ha telepítve van Telescope, akkor ahhoz külön:
    ```
    php artisan telescope:publish
    ```
    *TODO: ezt a szakaszt kiegészíteni a composer egyéb flag-ekkel.*
 
4. asset-ek legenerálása:
    - Lásd alább a megfelelő bekezdésnél.

---
### Medialibrary - Fájlok és Képek kezelése

#### Thumbnail generálás
**Dev környezet:**
1. command line-ból futtatni a queue-t (ez folyamatosan fog futni, ctrl+c kiadásáig) (add hozzá a phpstorm laradock futtatáshoz):
    ``` 
    php artisan queue:work --queue=medialibrary
    ```
2. a hiányzó thumbnail-ek legenerálása:

    ```
    php artisan media-library:regenerate --only-missing
    ```
   
**Production környezet:**
1. cronjob-ba felvenni a commandot, ami a laravel queue-kat futtatja:
    
   cronjob: percenként, megfelelő felhasználóval nem fognak egymásra ráfutni, mert ez az app/Console/Kernel.php-ban kezelve van.
   CPANEL cronjob beállítás: https://a01-hosting.gbl.hu:2083/cpsess3489874957/frontend/paper_lantern/cron/index.html

   ``` 
   cd /home/devgbl/public_html/realhome.hu && /usr/local/bin/ea-php80 -d memory-limit=1024 /home/devgbl/public_html/realhome.hu/artisan queuelisten:run >/dev/null 2>&1 
   ```
   ez csak a medialib a thumbnail generáláshoz, ha több queue van, akkor --queue=medialibrary,masikqueue,harmadikqueue,esatobbi

   Ha frissítjük a cron file tartalmát, akkor ki kell lőni a korábbi cron processüt mivel ebben ay esetben kettő fog futni.
   ```
   pkill -f "/opt/cpanel/ea-php80/root/usr/bin/php artisan queue:work --once --name=default --queue=medialibrary,resetpassword,generatedPassword --backoff=0 --memory=128 --sleep=3 --tries=1"
   ```
   
   Ellenőrizni a futást pedig a következő paranccsal lehet:
   ```
   clear && ps aux -ww | egrep '[q]ueue:work'
   ```
2. a hiányzó thumbnail-ek legenerálása:

    ```
    php artisan medialibrary:regenerate --only-missing
    ```
3. Új képméret vagy más medialib kódot értintő módosítás esetén:
    - bevezetésekor a QUEUE újraindítása szükséges!
    ```
    php artisan queue:restart
    ```
    - sikertelen képgenerálás (failed job) újra futtatása:
    ```
    php artisan queue:retry all
    ```
   
   
#### A képek helye, elérése:
- **storage/app/public/{id}/képnév.kiterjesztés**: a feltöltött kép
- **storage/app/public/{id}/conversions/képnév.kiterjesztés**: a feltöltött kép átalakított verziói

#### ÚJ képméretek generálása:
- Az **\App\Models\RealEstate::registerMediaConversions** metódusban van erre mód.

Fontos, hogy ilyen módosításnál, a queue újraindítása és a failed job-ok újra futtatása szükséges (lásd feljebb)

#### Fájlok helye, elérése:
A feltöltött fájlok privát jellegük miatt, publikus http könyvtárban és kéréssel nem elérhetőek.
Ezek az alábbi, külön helyre kerülnek: 
- **storage/app/private/{id}/fájlnév.kiterjesztés**: a feltöltött fájl

#### Dokumentáció:
https://docs.spatie.be/laravel-medialibrary/v7/introduction/

---
### Cache űrítése
Alap:
```
php artisan cache:clear && php artisan config:cache && php artisan view:clear
```

Prod és DEV CPANEL esetén:
```
/usr/local/bin/ea-php74 artisan cache:clear && /usr/local/bin/ea-php74 artisan config:cache && /usr/local/bin/ea-php74 artisan view:clear
```

Telepített Lighthouse esetén.
```
php artisan lighthouse:clear-cache
```

---

### Asset-ek legenerálása:

A css, js fájlok összeállítása, legenerálása és a /public könyvtárba másolása az alábbi módon történik: 

Frontoffice asset-ek:
```
npm --section=frontoffice run dev
```

Backoffice asset-ek:
```
npm --section=backoffice run dev
```

Ha telepítve van Telescope, akkor ahhoz külön:
```
php artisan vendor:publish --tag=telescope-assets --force
```

---

### PDF generálás
A pdf generálásához 0.12.4-es wkhtmltopdf programot használunk. Ez a program egy webkit alapú pdf renderelő program, 
ami elméletileg még a javascriptet is képes futtatni a megjelenítendő oldalon. Ennek segítségével teljes értékű 
bootstrappal összerakott html-ben szerkesztett PDF doksik készíthetők.Ez a verzió jelenleg nem a legfrissebb, de ez a 
legkésőbbi, amihez elérhető a precompiled binary, azaz nem kell a kiszolgálón telepíteni.A nyomtatni kívánt blade 
fájlokat ki kell renderelni, és úgy átadni a download stream számára.A renderelt html oldalban minden asset (css, image)
 legyen HTTP protokolon elérhető szabadon, mert a renderelés folyamán ezek letöltésre kerülnek.
#####Ez a verzió már nem képes letölteni a HTTPS tarmat
```
$html = view('pdf.hello')->render();
return response()->streamDownload(function() use($html){
    echo app('snappy.pdf')->getOutputFromHtml($html);
}, 'download.pdf');
```

### Hibakezelés
A PDF generálása közben nem tudja a program feloldani a HTTPS-t, ha localon fejlesztjük ezért nem működik.
Permission denied esetén /realhome.hu/storage/wkhtmltox/bin mappában találhato két wkhtml fájl jogosultságát futtathatóvá
kell tenni a chmod +x filename paranccsal

(..projectre vonatkozó, jellemző hibákra megoldások ide..)

### Laradock:
Project folder:
data:
(ide kerul majd a mysql data ha van local)
projeckt:
(ez a realhome project konyvtar)
laradock:
1:
touch .env

            cp .env.example .env
            
            1/A:
                Allitsd be a szukseges confokat:
                1: 17. sorba allitsd be a laradock konyvtarral megegyazo szinten talalhato data konyvtar eleresi utvonalat.
                    (Ha belepsz a konyvtarba es kiadod a pwd parancsot visszaadja a path amit egy az egyben kell ide!)
                    DATA_PATH_HOST=/home/developer2/Projects/realhome/data
                2: 36. sorban allitsd be ezt igy konnyebb eligazodni a konterek kozott.
                    COMPOSE_PROJECT_NAME=realhome
                3: 42,sor allitsd be a megfelelo php verziot
                    PHP_VERSION=8.0
                4: 62. sorban ezt is nevezd at
                    PHP_IDE_CONFIG=serverName=realhome
        2:
            cd nginx/sites

            touch realhome.conf

            cp laravel.conf.example realhome.conf

            
            2/A:
                Allitsd be a szukseges confokat:
                1: 18.sorban allitsd be ezt (ami a local hosts fileba is be kell keruljon!)
                    server_name realhome.docker;
    
                2: 19. sorba allitsd be a laradock konyvtarszintjevel megegyezo projeck konyvtar nevet a {project folder name} helyere 
                    root /var/www/{project folder name}/public;

                3: 47.sorban allitsd be az error log file nevet!
                    error_log /var/log/nginx/realhome_error.log;

                4: 48.sorban allitsd be az error log file nevet!
                    access_log /var/log/nginx/realhome_access.log;

        3:
            (Ha nem kell local database akkor ez kimaradhat, es allitsd be DEV elerest .env-ben!)
            cd mysql/docker-entrypoint-initdb.d

            touch createdb.sql

            cp createdb.sql.example createdb.sql

            3/A:
                Allitsd be a szukseges confokat:
                1: 
                Kommentezd ki ezekbol a sorokbol 1 part, majd csereld ki a dev_db_1 erteket az adatbazis nevere amit localban letre akarsz hozni(realhome) 
                    #CREATE DATABASE IF NOT EXISTS `realhome` COLLATE 'utf8_general_ci' ;
                    #GRANT ALL ON `realhome`.* TO 'default'@'%' ;

Ha a fenti fajlok ballitasa megvan es fut a docker a gepeden akkor docker-compose up -d (mysql) nginx php-fpm workspace
.env fajlban csinlad meg a DB beallitast illetve
1: ha nincs key, akkor futtasd a workspacen belul (docker-compose exec workspace bash majd pedig cd realhome, vagy ami a projeckt neve) a php artisan key:generate parancsot
