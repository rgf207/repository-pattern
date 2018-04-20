# OneThirtyOne/Repository-Pattern
Simple Artisan command to create repository pattern modules for Laravel app

##Installation
Install using composer
```$xslt
composer require onethirtyone/repository-pattern
```

For laravel 5.5+ there is nothing more you need to do.  For laravel 5.4 and below add the service provider to your `config/app.php`

```php
$providers => [
...
onethirtyone\Repository\RepositoryProvider::class,
...
];
```

Run the Artisan command to create a repository and the, optional, associated model
```$xslt
php artisan onethirtyone:make-repository Test -m
```

This will create a `TestRepository.php` file under `app\Repositories`. if using the `-m` options, the associated Eloquent model will be created under `app/`