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
