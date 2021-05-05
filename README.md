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

**Step 3 - Create View Contact Form**
**_resouces/views/send_email.blade.php_**
```
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Shihanur Rahman Chowdhury">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <title>Send Email using Laravel 8</title>
        <style type="text/css">
            .box {
                width: 600px;
                margin: 0 auto;
                border: 1px solid #ddd;
            }

            .has-error {
                border-color: #cc0000;
                background-color: #ffff99;
            }
        </style>
    </head>

    <body>

        <h1 class="text-center py-3">Bismillahir Rahmanir Rahim</h1>

        <div class="container box">
            <h3 class="text-center pt-3">How to Send an Email in Laravel v8</h3><br />
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form method="post" action="{{url('sendemail/send')}}">
                {{ csrf_field() }}
                <div class="form-group py-2">
                    <label>Enter Your Name</label>
                    <input type="text" name="name" class="form-control" value="" placeholder='Enter your name' Required />
                </div>
                <div class="form-group py-2">
                    <label>Enter Your Email</label>
                    <input type="email" name="email" class="form-control" value="" placeholder='example@gmail.com' Required />
                </div>
                <div class="form-group py-2">
                    <label>Enter Your Message </label>
                    <textarea name="message" class="form-control" rows="4" placeholder='Type your message...' Required></textarea>
                </div>
                <div class="form-group py-3">
                    <input type="submit" name="send" class="btn btn-info" value="Send Message" />
                </div>
            </form>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>
    </body>

    </html>

```

**Step 4 - Set Route**
**_routes/web.php_**
```
    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\SendEmailController;


    Route::get('/sendemail', [SendEmailController::class, 'index']);
    Route::post('/sendemail/send', [SendEmailController::class, 'send']);

```

**Step 5 - Edit .env File**
```
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=your@gmail.com
    MAIL_PASSWORD=your gmail password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=your@gmail.com
    MAIL_FROM_NAME="${APP_NAME}"
```

**Step 6 - Edit Gamil Account Setting**
- [ ] manage your google account > Security > `Less Secure app Access: On`

**Step 7 - Create Mailable Class**
    `php artisan make:mail SendMail`
    
**_App\Mail\SendMail.php_**    
 ```
    <?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class SendMail extends Mailable
    {
        use Queueable, SerializesModels;
        public $data;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($data)
        {
            $this->data = $data;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
        {
            return $this
            ->from('example@gmail.com')
            ->subject('New Message - XXXX')
            ->view('dynamic_email_template')
            ->with('data', $this->data);
        }
    }

 ```
 **Step 8 - Make View file for Email Body**
 **_resources/views/dynamic_email_template.blade.php_**
 ```
     <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mail From SWMC-Client</title>
    </head>

    <body>

        <h3><b>Email: {{ $data['email'] }}</b></h3>
        <p>Name: {{ $data['name'] }}</p>
        <p>Message: {{ $data['message'] }}</p><br>
        <p>It would be appriciative, if you gone through this feedback.</p>

    </body>

    </html>
 ```
 
 **Step 9 - Make Send() under `SendEmailController` Controller**
 ```
     <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\SendMail;

    class SendEmailController extends Controller
    {
        function index() {
            return view('send_email');
        }
        function send(Request $request) {

            $this->validate($request, [
                'name'     =>  'required',
                'email'  =>  'required|email',
                'message' =>  'required'
            ]);

            $data = array(
                'name'      =>  $request->name,
                'email'      =>  $request->email,
                'message'   =>   $request->message
            );

            Mail::to('block.blaster.wrong@gmail.com')->send(new SendMail($data));
            return back()->with('success', 'Thanks for contacting us!');

        }
    }

 ```
 **Step 10 - Change config/mail.php**
 ```
     'from' => [
            'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
            'name' => env('MAIL_FROM_NAME', 'New Message'),
        ],
 ```
 **Setp 11 - Finally Run**
    `php artisan serve --port=3303`
    
#Thanks.
