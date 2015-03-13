# laravel-query-log

This is a service provider fully logging all mysql queries.

### Installation 

```bash
composer require addapp/laravel-query-log "~0.1"
```

Add the service provider to a **NON-PRODUCTION** config file:

```php
// config/local/app.php

return [

    'providers' => append_config([
        'Addapp\QueryLog\QueryLogServiceProvider'

    ]),

]
```

### Result

Run `php artisan tail` and watch:

![image 2015-03-13 at 15 40 07](https://cloud.githubusercontent.com/assets/1785686/6640405/647d90f0-c997-11e4-920b-821d2a34f7c3.jpg)

The queries logged are valid mysql queries!

### Credits

Credits go to the people answering this [stackoverflow question](http://stackoverflow.com/questions/19131731/laravel-4-logging-sql-queries).
