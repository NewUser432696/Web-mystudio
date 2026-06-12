<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
        }

        .login-box {
            width: 380px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 10px;
            color: #333;
            font-size: 28px;
        }

        .login-box p {
            color: gray;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            color: #444;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #2193b0;
            box-shadow: 0 0 5px rgba(33, 147, 176, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2193b0;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background: #176d84;
        }

        .links {
            margin-top: 20px;
        }

        .links a {
            text-decoration: none;
            color: #2193b0;
            font-size: 14px;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Admin Login</h2>
        <p>Silakan masukkan akun pengelola</p>

        <form action="proses_login_admin.php" method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" name="login">Login</button>
        </form>


</body>
</html>
