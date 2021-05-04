



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
