<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
            border: 2px solid #007bff;
            /* Add border */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 25px;
        }

        form div {
            text-align: left;
            margin-bottom: 18px;
        }

        label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
            display: inline-block;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease-in-out;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        }

        input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        button:hover {
            background: linear-gradient(135deg, #0056b3, #003f7f);
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        #error-message {
            margin-top: 15px;
            font-size: 14px;
            color: #e74c3c;
            background: #fdecea;
            padding: 10px;
            border-radius: 6px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <div id="error-message">Invalid username or password.</div>
        <!-- Add CSRF token for security -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf <!-- Add this directive -->
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        @if ($errors->has('login'))
            <p style="color: red;">{{ $errors->first('login') }}</p>
        @endif
    </div>
</body>

</html>