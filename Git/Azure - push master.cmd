@echo off
set PATH=%PATH%;"%SYSTEMDRIVE%\Program Files (x86)\Git\bin\"

git push -f azure master:master

echo.
echo.
pause