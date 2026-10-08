<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - EcoLearn</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            width: 400px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        .login-container p {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 7px;
            background: #2e7d32;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #256628;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #2e7d32;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <h1>EcoLearn</h1>
        <p>Silakan login untuk melanjutkan</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

        <div class="register-link">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
        </div>

    </div>

</body>
</html>