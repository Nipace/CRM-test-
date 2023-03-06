### Environment

- **[Laravel v10](https://laravel.com/docs/10.x)**
- **[Composer 2.5.4](https://getcomposer.org/)**
- **[Mysql v8](https://www.mysql.com/)**
- **[Node v 16](https://nodejs.org/en/)**

### Installation Steps

- **Copy .env.example as .env**
- **Configure database**
- **Install composer dependencies** ```composer install``` 
- **Generate Key** ```php artisan key:generate```
- **Run migration** ```php artisan migrate``` 
- **Run seeder** ```php artisan seed``` 
- **Install Npm** ```npm install```
- **Server the Project** ```php artisan serve```
- **Generate Assets and vite server** ```npm run dev```


***Warning : Do not change anything in the modules which you have not created. This may break other system*** 

### Testing
- **Run Test** ```php artisan test```

***Warning : Test contains refresh database so, configure phpunit.xml with sqlite and memmory. If you wanna use Mysql please donot use your own db you will lose all the data rather use testdb***   
