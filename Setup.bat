<# : Batch portion
@echo off & setlocal enabledelayedexpansion

set "menu[0]=Install Setup"
set "menu[1]=composer install"
set "menu[2]=php artisan key:generate"
set "menu[3]=php artisan storage:link"
set "menu[4]=npm install"
set "menu[5]=npm run dev"
set "menu[6]=php artisan migrate:fresh --seed && php artisan passport:install"
set "menu[7]=composer dump-autoload"
set "menu[8]=npm run test:unit"
set "menu[9]=Start Server (Vue/Laravel/Tests)"
set "menu[99]=CLOSE"

set "default=0"

powershell -noprofile "iex (gc \"%~f0\" | out-string)"

IF !ERRORLEVEL! == 0 cmd /c Call composer install && Call php artisan key:generate && Call php artisan storage:link && Call npm install --global cross-env && Call npm run dev && Call php artisan migrate:fresh --seed && Call php artisan passport:install && Call composer dump-autoload && Start Call php artisan serve && TIMEOUT 1 && Start Call npm run hot && Start Call npm run test:unit && start Setup.bat && exit
IF !ERRORLEVEL! == 1 cmd /c Call composer install && start Setup.bat && exit
IF !ERRORLEVEL! == 2 cmd /c Call php artisan key:generate && start Setup.bat && exit
IF !ERRORLEVEL! == 3 cmd /c Call php artisan storage:link && start Setup.bat && exit
IF !ERRORLEVEL! == 4 cmd /c Call npm install && Call npm install --global cross-env && start Setup.bat && exit
IF !ERRORLEVEL! == 5 cmd /c Call npm run dev && start Setup.bat && exit
IF !ERRORLEVEL! == 6 cmd /c Call php artisan migrate:fresh --seed && Call php artisan passport:install && start Setup.bat && exit
IF !ERRORLEVEL! == 7 cmd /c Call composer dump-autoload && start Setup.bat && exit
IF !ERRORLEVEL! == 8 cmd /c Call npm run test:unit && start Setup.bat && exit
IF !ERRORLEVEL! == 9 Start Call php artisan serve && TIMEOUT 1 && Start Call npm run hot && TIMEOUT 1 && start Setup.bat && exit
IF !ERRORLEVEL! == 99 goto :EOF
: echo You chose !menu[%ERRORLEVEL%]!.

goto :EOF
: end batch / begin PowerShell hybrid chimera #>

$menutitle = "=== MENU ==="
$menuprompt = "Use the arrow keys.  Hit Enter to select."

$maxlen = $menuprompt.length + 6
$menu = gci env: | ?{ $_.Name -match "^menu\[\d+\]$" } | %{
    $_.Value.trim()
    $len = $_.Value.trim().Length + 6
    if ($len -gt $maxlen) { $maxlen = $len }
}
[int]$selection = $env:default
$h = $Host.UI.RawUI.WindowSize.Height
$w = $Host.UI.RawUI.WindowSize.Width
$xpos = [math]::floor(($w - ($maxlen + 5)) / 2)
$ypos = [math]::floor(($h - ($menu.Length + 4)) / 3)

$offY = [console]::WindowTop;
$rect = New-Object Management.Automation.Host.Rectangle `
    0,$offY,($w - 1),($offY+$ypos+$menu.length+4)
$buffer = $Host.UI.RawUI.GetBufferContents($rect)

function destroy {
    $coords = New-Object Management.Automation.Host.Coordinates 0,$offY
    $Host.UI.RawUI.SetBufferContents($coords,$buffer)
}

function getKey {
    while (-not ((37..40 + 13 + 48..(47 + $menu.length)) -contains $x)) {
        $x = $Host.UI.RawUI.ReadKey('NoEcho,IncludeKeyDown').VirtualKeyCode
    }
    $x
}

# http://goo.gl/IAmdR6
function WriteTo-Pos ([string]$str, [int]$x = 0, [int]$y = 0,
    [string]$bgc = [console]::BackgroundColor, [string]$fgc = [Console]::ForegroundColor) {
    if($x -ge 0 -and $y -ge 0 -and $x -le [Console]::WindowWidth -and
        $y -le [Console]::WindowHeight) {
        $saveY = [console]::CursorTop
        $offY = [console]::WindowTop
        [console]::setcursorposition($x,$offY+$y)
        Write-Host $str -b $bgc -f $fgc -nonewline
        [console]::setcursorposition(0,$saveY)
    }
}

function center([string]$what) {
    $what = "    $what  "
    $lpad = " " * [math]::max([math]::floor(($maxlen - $what.length) / 2), 0)
    $rpad = " " * [math]::max(($maxlen - $what.length - $lpad.length), 0)
    WriteTo-Pos "$lpad   $what   $rpad" $xpos $line blue yellow
}

function menu {
    $line = $ypos
    center $menutitle
    $line++
    center " "
    $line++

    for ($i=0; $item = $menu[$i]; $i++) {
        # write-host $xpad -nonewline
        $rtpad = " " * ($maxlen - $item.length)
        if ($i -eq $selection) {
            WriteTo-Pos "  > $item <$rtpad" $xpos ($line++) yellow blue
        } else {
            WriteTo-Pos " $i`: $item  $rtpad" $xpos ($line++) blue yellow
        }
    }
    center " "
    $line++
    center $menuprompt
    1
}

while (menu) {

    [int]$key = getKey

    switch ($key) {

        37 {}   # left or up
        38 { if ($selection) { $selection-- }; break }

        39 {}   # right or down
        40 { if ($selection -lt ($menu.length - 1)) { $selection++ }; break }

        # number or enter
        default { if ($key -gt 13) {$selection = $key - 48}; destroy; exit($selection) }
    }
}
