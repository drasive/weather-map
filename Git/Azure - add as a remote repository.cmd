@echo off
set PATH=%PATH%;"%SYSTEMDRIVE%\Program Files (x86)\Git\bin\"

git remote add azure https://Dimitri-Vranken@weather-map-vranken.scm.azurewebsites.net:443/weather-map-vranken.git

echo.
echo.
pause