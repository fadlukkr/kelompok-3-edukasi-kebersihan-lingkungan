<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EcoLearn</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7f6;
            min-height: 100vh;
        }

        .navbar {
            background: #2e7d32;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 20px;
        }

        .navbar form button {
            background: white;
            color: #2e7d32;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .navbar form button:hover {
            background: #e8f5e9;
        }

        .container {
            max-width: 800px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h1 {
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .card p {
            color: #666;
            font-size: 16px;
        }

        .user-info {
            margin-top: 25px;
            background: #f1f8e9;
            border-radius: 8px;
            padding: 20px;
            text-align: left;
        }

        .user-info p {
            color: #333;
            margin-bottom: 8px;
        }

        .user-info span {
            font-weight: bold;
            color: #2e7d32;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>🌿 EcoLearn</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="card">
            <h1>Selamat Datang!</h1>
            <p>Kamu berhasil login ke EcoLearn 🎉</p>

            <div class="user-info">
                <p>Nama: <span>{{ Auth::user()->nama_lengkap }}</span></p>
                <p>Email: <span>{{ Auth::user()->email }}</span></p>
                <p>Status: <span>{{ Auth::user()->status }}</span></p>
            </div>
        </div>
    </div>

</body>
</html>
