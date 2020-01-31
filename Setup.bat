@ECHO OFF
ECHO =========================
ECHO . "_  ._"
ECHO . "| |(_)                                     _"
ECHO . "| | _  ____    ____  _   _     ___   ____ | |_   _   _  ____"
ECHO . "| || ||    \  / _  |( \ / )   /___) / _  )|  _) | | | ||  _ \"
ECHO . "| || || | | |( ( | | ) X (   |___ |( (/ / | |__ | |_| || | | |"
ECHO . "|_||_||_|_|_| \_||_|(_/ \_)  (___/  \____) \___) \____|| ||_/"
ECHO . "                                                       |_|"


ECHO =========================
ECHO ======setup Composer========
ECHO =========================
call composer install


ECHO =========================
ECHO ========key:generate=========
ECHO =========================
call php artisan key:generate


ECHO =========================
ECHO ========storage:link=========
ECHO =========================
call php artisan storage:link


ECHO =========================
ECHO ========npm install=========
ECHO =========================
call npm install


ECHO =========================
ECHO ========npm run dev========
ECHO =========================
call npm run dev


ECHO =========================
ECHO =====migrate:fresh --seed======
ECHO =========================
call php artisan migrate:fresh --seed


ECHO =========================
ECHO ======passport:install=========
ECHO =========================
call php artisan passport:install


ECHO =========================
ECHO ======dump-autoload=========
ECHO =========================
call composer dump-autoload
PAUSE
