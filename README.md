*  for properly running this project on console mode configure these params in .env file
```dotenv
    # DB CONFIGURATIONS
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=admin
```  

* Migration & Composer
```info
    composer update
    php artisan migrate:refresh --seed
```

* Website Urls
```info
    your-domain/
    your-domain/login
    your-domain/register
    your-domain/admin
```

* Admin Credentials
```info
    login: admin
    password: 123
```
