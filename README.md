# PMS
Property Management System PHP Custom MVC

# Database
Sql file is placed in schema folder

# Flow
- If database is empty Guzzle api called
- data is stored to database 
- data is shown on homepage using client side datatables

# Acheivements
- Custom MVC Created from scratch
- Composer Based libraries integrated
- Symfony Routing library used for routing and route based security
- .htaccess used for folder based security
- PDO library used for database security
- OOP based architecture created
- Guzzle Library used for api calling


# Improvements (if more time given)
- Illuminate database library used initially but creating problems so I moved to PDO library
- OOP based architecture could be improved
- Server Side Datatables could be implemented to reduce page load Time
- phpdotenv could be implemented instead of config.php


# Usage
- clone repo
- import database
- update database credentials in config/config.php
- run command `composer install`
- open project in browser