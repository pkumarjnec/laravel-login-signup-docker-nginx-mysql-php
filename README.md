# Foobar

Login, Register, Currency Exchange Flow in Laravel 7 with MySql, Redis, Nginx, Docker

## Installation

```bash
chmod -R 777 .
docker-compose build app
docker-compose up -d db   
docker-compose up -d redis
docker-compose up -d app
docker-compose up -d webserver
```
   
## Usage

```
Open http://localhost in browser to access
Add AWS Credential in .env file for File Upload in AWS
```

## License
[GNU](http://opensource.org/licenses/gpl-license.php GNU Public License)
@2021 The Tech Thing







