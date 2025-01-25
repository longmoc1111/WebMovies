<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/Login.css">
    <title>Register</title>
</head>
<body>
    <div class="login-wrapper">
        <form action="{{route("register.post")}}" method = "POST">
            @csrf
            <h2>Đăng ký</h2>
            <div class = "input-field">
                <input type="text" required name = "name">
                <label>nhập username</label>
            </div>
            <div class = "input-field">
                <input type="text" required name = "email">
                <label>nhập Email</label>
            </div>   
            <div class = "input-field">
                <input type="text" required name = "password">
                <label>nhập mật khẩu của bạn</label>
            </div>     
            <button class = "mt-3" type = "submit">đăng ký</button>
        </form>
    </div>
</body>
</html>