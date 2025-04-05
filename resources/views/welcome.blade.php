<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">


</head>

<body>
    <div class="container"
        style="border: 1px solid #ccc; padding: 20px; border-radius: 5px; max-width: 400px; margin: 50px auto;">
        <h1>Login</h1>
        <form id="loginForm">
            <div>
                <label for="username">Tài khoản:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database.js"></script>

    <script>
        // Firebase configuration
        const firebaseConfig =
            console.log("ok");

        // Initialize Firebase
        const app = firebase.initializeApp(firebaseConfig);
        const database = firebase.database();

        // Handle login form submission
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            console.log(username);

            try {
                const snapshot = await firebase.database().ref('users').orderByChild('admin').equalTo(username).once('value');
                console.log('snapshot:', snapshot.val());
                alert('Login successful!');

                if (snapshot.exists()) {
                    const userData = Object.values(snapshot.val())[0];
                    if (userData.password === password) {
                        alert('Login successful!');
                        // Redirect or perform further actions
                    } else {
                        document.getElementById('error-message').style.display = 'block';
                    }
                } else {
                    document.getElementById('error-message').style.display = 'block';
                }
            } catch (error) {
                console.error('Error during login:', error);
            }
        });
    </script>
</body>

</html>