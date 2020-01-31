@ECHO OFF
Title Limax FlowControl Setup
mode con cols=64 lines=35 & color 0B
REM You can change the variable PeriodTime as you needs here is set to (120 seconds = 2 minutes) as example
Set "PeriodTime=2"
echo(
cls
:::
:::  _      _                         _____      _
::: | |    (_)                       / ____|    | |
::: | |     _ _ __ ___   __ ___  __ | (___   ___| |_ _   _ _ __
::: | |    | | '_ ` _ \ / _` \ \/ /  \___ \ / _ | __| | | | '_ \
::: | |____| | | | | | | (_| |>  <   ____) |  __| |_| |_| | |_) |
::: |______|_|_| |_| |_|\__,_/_/\_\ |_____/ \___|\__|\__,_| .__/
:::                                                       | |
:::                                                       |_|
:::
:::              _ _,---._
:::           ,-','       `-.___
:::          /-;'               `._
:::         /\/          ._   _,'o \
:::        ( /\       _,--'\,','"`. )
:::         |\      ,'o     \'    //\
:::         |      \        /   ,--'""`-.
:::         :       \_    _/ ,-'         `-._
:::          \        `--'  /                )
:::           `.  \`._    ,'     ________,','
:::             .--`     ,'  ,--` __\___,;'
:::              \`.,-- ,' ,`_)--'  /`.,'
:::               \( ;  | | )      (`-/
:::                 `--'| |)       |-/
:::                   | | |        | |
:::                   | | |,.,-.   | |_
:::                   | `./ /   )---`  )
:::                  _|  /    ,',   ,-'
:::                 ,'|_(    /-<._,' |--,
:::                 |    `--'---.     \/ \
:::                 |          / \    /\  \
:::               ,-^---._     |  \  /  \  \
:::            ,-'        \----'   \/    \--`.
:::           /            \              \   \
:::

for /f "delims=: tokens=*" %%A in ('findstr /b ::: "%~f0"') do @echo(%%A

>NUL TIMEOUT /T %PeriodTime% /NOBREAK

REM
REM DEMO - how to launch several processes in parallel, and wait until all of them finish.
REM

@ECHO OFF
start "!ComposerInstall!" call composer install
:waittofinishComposerInstall
echo Composer Install is still running...
timeout /T 2 /nobreak >nul
tasklist.exe /fi "WINDOWTITLE eq !ComposerInstall!" | find ":" >nul
if errorlevel 1 goto waittofinishComposerInstall
start "!KeyGenerate!" call php artisan key:generate

:waittofinishKeyGenerate
echo Key Generate is still running...
timeout /T 2 /nobreak >nul
tasklist.exe /fi "WINDOWTITLE eq !KeyGenerate!" | find ":" >nul
if errorlevel 1 goto waittofinishKeyGenerate
start "!StorageLink!" call php artisan storage:link

:waittofinishStorageLink
echo Storage Link is still running...
timeout /T 2 /nobreak >nul
tasklist.exe /fi "WINDOWTITLE eq !StorageLink!" | find ":" >nul
if errorlevel 1 goto waittofinishStorageLink
start "!NpmInstall!" call npm install

:waittofinishRunDev
echo Npm Install is still running...
timeout /T 2 /nobreak >nul
tasklist.exe /fi "WINDOWTITLE eq !NpmInstall!" | find ":" >nul
if errorlevel 1 goto waittofinishRunDev
start "!RunDev!" call npm run dev

:waittofinishMigrateFreshSeed
echo Run Dev is still running...
timeout /T 2 /nobreak >nul
tasklist.exe /fi "WINDOWTITLE eq !RunDev!" | find ":" >nul
if errorlevel 1 goto waittofinishMigrateFreshSeed
start "!MigrateFreshSeed!" call php artisan migrate:fresh --seed

:waittofinishPassportInstall
echo Migrate Fresh Seed is still running...
timeout /T 2 /nobreak >nul
tasklist.exe /fi "WINDOWTITLE eq !MigrateFreshSeed!" | find ":" >nul
if errorlevel 1 goto waittofinishPassportInstall
start "!PassportInstall!" call php artisan passport:install

:waittofinishDumpAutoload
echo PassportInstall is still running...
timeout /T 2 /nobreak >nul
tasklist.exe /fi "WINDOWTITLE eq !PassportInstall!" | find ":" >nul
if errorlevel 1 goto waittofinishDumpAutoload
start "!DumpAutoload!" call composer dump-autoload

PAUSE

