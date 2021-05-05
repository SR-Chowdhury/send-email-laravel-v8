<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
# How to send an Email in Laravel 8

- [ ] Use this project 
> run in terminal `composer update` & `copy .env.example .evn ` & `php artisan key:generate`

# Simple Way to Sending an Email in Laravel

**Step 1 - Install Laravel Application **
    `composer create-project laravel/laravel send-email-laravel`

**Step 2 - Create Controller**
    `php artisan make:controller SendEmailController`
    
**_app/Http/Controllers/SendEmailController.php_**
```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    function index()
    {
     return view('send_email');
    }
}
```
    
