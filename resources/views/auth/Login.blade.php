<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/Login.css">
    <title>Login</title>
</head>
<body>
    <div class="login-wrapper">
        <form action="{{route("login.post")}}" method = "POST">
        @csrf
            <h2>Đăng nhập</h2>
            <div class = "input-field">
                <input  name = "email" type="text" required>
                <label>nhập email của bạn</label>
            </div>      
            <div class = "input-field">
                <input  name = "password" type="password" required>
                <label>nhập mật khẩu của bạn</label>
            </div>     

            <div class = "password-options">
                <label for="remember">
                    <input type="checkbox" id = "remember">
                    <p>lưu lại lần sau</p>
                </label>

            <a href="#">quên mật khẩu</a>
            </div>

            <button type = "submit">đăng nhập</button>
            <div class = "account-options">
                <p>bạn chưa có tài khoản? <a href="">Đăng ký</a></p>
            </div>
        </form>
    </div>
</body>
</html>