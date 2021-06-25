# Laravel File Errors [![Build Status](https://github.com/mpyw/laravel-file-errors/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/mpyw/laravel-file-errors/actions) [![Coverage Status](https://coveralls.io/repos/github/mpyw/laravel-file-errors/badge.svg?branch=master)](https://coveralls.io/github/mpyw/laravel-file-errors?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mpyw/laravel-file-errors/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mpyw/laravel-file-errors/?branch=master)

A tiny extension that reports validation error details about uploaded files

## Requirements

- PHP: `^7.1`
- Laravel: `^5.6 || ^6.0 || ^7.0 || ^8.0`

## Installing

### 1. Install package

```bash
composer require mpyw/laravel-file-errors
```

### 2. Customize translation

Edit `resources/lang/{en,ja,...}/validation.php` in your project.    
Feel free to copy from [resources/lang](https://github.com/mpyw/laravel-file-errors/tree/master/resources/lang).

```php
<?php

use Mpyw\LaravelFileErrors\UploadError as Err;

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    /* ... */

    // 'uploaded' => 'The :attribute failed to upload.',
    'uploaded' => [
        Err::TITLE_INI_SIZE => 'The :attribute exceeds the maximum filesize defined in the server.',
        Err::TITLE_FORM_SIZE => 'The :attribute exceeds the maximum filesize defined in the form.',
        Err::TITLE_PARTIAL => 'The :attribute was only partially uploaded.',
        Err::TITLE_NO_FILE => 'The :attribute was not uploaded.',
        Err::TITLE_CANT_WRITE => 'The :attribute could not be written on disk.',
        Err::TITLE_NO_TMP_DIR => 'The :attribute could not be uploaded; missing temporary directory.',
        Err::TITLE_EXTENSION => 'The :attribute upload was stopped by a PHP extension.',
        Err::TITLE_UNKNOWN => 'The :attribute could not be uploaded due to an unknown error.',
    ],

    /* ... */
];
```

## Basic Usage

The default implementation is provided by `ValidationServiceProvider`, however, **package discovery is not available**.
Be careful that you MUST register it in **`config/app.php`** by yourself.

```php
<?php

return [

    /* ... */

    'providers' => [
        /* ... */

        Mpyw\LaravelFileErrors\ValidationServiceProvider::class,

        /* ... */
    ],

];
```

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:20',
                'avatar' => 'required|image',
            ]
        );

        // This may contain...
        //   ['avatar' => ['The avatar exceeds the maximum filesize defined in the server.']]
        dump($validator->errors()->toArray());
    }
}
```

## Advanced Usage

You can extend `Validator` with `IncludesFileErrorDetails` trait by yourself.

```php
<?php

namespace App\Providers;

use App\Services\Validation\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator as Validation;

class ValidationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Validation::resolver(function (...$parameters) {
            return new Validator(...$parameters);
        });
    }
}
```

```php
<?php

namespace App\Services\Validation;

use Illuminate\Validation\Validator as BaseValidator;
use Mpyw\LaravelFileErrors\IncludesFileErrorDetails;

class Validator extends BaseValidator
{
    use IncludesFileErrorDetails;

    /* ... */
}
```
