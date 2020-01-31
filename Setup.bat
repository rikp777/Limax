call composer install
ECHO =========================
call php artisan key:generate
ECHO =========================
call php artisan storage:link
ECHO =========================
call npm install
ECHO =========================
call npm run dev
ECHO =========================
call php artisan migrate:fresh --seed
ECHO =========================
call php artisan passport:install
ECHO =========================
call composer dump-autoload
PAUSE
