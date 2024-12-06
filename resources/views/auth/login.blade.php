<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>

<body>
    <div class="login-container">
        <div class="form-box login">
            <!-- logo  -->
            <img src="{{asset('images/logo-kominfo.png')}}" alt="Company Logo" class="logo">
            <h2>Login</h2>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" id="login-form" action="{{route('login.process')}}">
                @csrf
                <div class="input-box">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required />
                </div>
                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required />
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
