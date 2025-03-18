@echo off
set PATH=^
C:\Program Files\Docker\Docker\resources\bin\;

set DB_DATABASE=app
set DB_PASSWORD=123456
set DB_USERNAME=user

docker-compose up --build && docker-compose down
pause