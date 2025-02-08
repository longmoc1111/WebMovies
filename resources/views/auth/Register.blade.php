<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css1/Login.css">
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

 -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->

    <link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/splide.min.css">
	<link rel="stylesheet" href="/css/slimselect.css">
	<link rel="stylesheet" href="/css/plyr.css">
	<link rel="stylesheet" href="/css/photoswipe.css">
	<link rel="stylesheet" href="/css/default-skin.css">
	<link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.min.css">

	<!-- Icon font -->
	<link rel="stylesheet" href="webfont/tabler-icons.min.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">

	<meta name="description" content="Online Movies, TV Shows & Cinema HTML Template">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>Moive</title>
</head>

<body>
	<div class="sign section--bg" data-bg="https://hotflix.volkovdesign.com/main/img/bg/section__bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content">
						<!-- authorization form -->
						<form action="{{route("register.post")}}" class="sign__form" method = "POST">
                            @csrf
							<a href="index.html" class="sign__logo">
								<img src="img/logo.svg" alt="">
							</a>

                            <div class="sign__group">
								<input name = "username" type="text" class="sign__input" placeholder="UserName">
							</div>

							<div class="sign__group">
								<input name = "email" type="text" class="sign__input" placeholder="Email">
							</div>

							<div class="sign__group">
								<input name = "password" type="password" class="sign__input" placeholder="Password">
							</div>

							<!-- <div class="sign__group sign__group--checkbox">
								<input id="remember" name="remember" type="checkbox" checked="checked">
								<label for="remember">Remember Me</label>
							</div> -->

							<button class="sign__btn" type="submit">Đăng ký</button>

							<!-- <span class="sign__delimiter">or</span>

							<div class="sign__social">
								<a class="fb" href="#">Sign in with<i class="ti ti-brand-facebook"></i></a>
								<a class="tw" href="#">Sign in with<i class="ti ti-brand-x"></i></a>
								<a class="gl" href="#">Sign in with<i class="ti ti-brand-google"></i></a>
							</div> -->

							<span class="sign__text">Đã có tài khoản? <a href="{{route('login')}}">Đăng nhập !</a></span>

							<!-- <span class="sign__text"><a href="forgot.html">Forgot password?</a></span> -->
						</form>
						<!-- end authorization form -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS -->
    <script src="/js/bootstrap.bundle.min.js"></script>
	<script src="/js/splide.min.js"></script>
	<script src="/js/slimselect.min.js"></script>
	<script src="/js/smooth-scrollbar.js"></script>
	<script src="/js/plyr.min.js"></script>
	<script src="/js/photoswipe.min.js"></script>
	<script src="/js/photoswipe-ui-default.min.js"></script>
	<script src="/js/main.js"></script>
</body>
</html>