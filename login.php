<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .login-container {
            display: flex;
            max-width: 800px; /* Ubah max-width sesuai kebutuhan */
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .left-container {
            flex: 1;
            overflow: hidden;
        }

        .left-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .right-container {
            flex: 1;
            padding: 40px; /* Menambahkan padding untuk memperbesar area formulir */
        }

        .login-form {
            max-width: 400px; /* Sesuaikan dengan kebutuhan */
            margin: 0 auto;
        }

        .login-form h2 {
            text-align: center; /* Tengahkan judul */
        }

        .login-form label {
            display: block;
            margin-bottom: 8px;
        }

        .login-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: none; /* Hapus border */
            border-bottom: 1px solid #ccc; /* Tambahkan garis bawah */
            outline: none; /* Hapus outline */
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="left-container">
            <img src="asset/images/hospital.jpg" alt="Login Image">
        </div>
        <div class="right-container">
            <div class="login-form">
                <h2>Login</h2>
                <form action="#" method="post">
                    <label for="username">Username :</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Handphone :</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Login</button>
                </form>

                <!-- <div class="register-link">
                    <p>Belum punya akun? <a href="register.html">Daftar disini</a></p>
                </div> -->
            </div>
        </div>
    </div>
</body>
</html>
