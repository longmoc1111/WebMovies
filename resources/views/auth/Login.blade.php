<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css1/Login.css">
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
</html> -->

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
	<link rel="stylesheet" href="/css/iziToast.min.css">


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
						<form action="{{route("login.post")}}" class="sign__form" method="POST">
							@csrf
							<a href="index.html" class="sign__logo">
								<img src="" alt="">
								<h1 style = "color:#F9AB00">Đăng nhập</h1>
							</a>

							<div class="sign__group">
								<input name="email" type="text" class="sign__input" placeholder="Email">
							</div>

							<div class="sign__group">
								<input name="password" type="password" class="sign__input" placeholder="Password">
							</div>

							<!-- <div class="sign__group sign__group--checkbox">
								<input id="remember" name="remember" type="checkbox" checked="checked">
								<label for="remember">Remember Me</label>
							</div> -->

							<button class="sign__btn" type="submit">Đăng nhập</button>

							<!-- <span class="sign__delimiter">or</span>

							<div class="sign__social">
								<a class="fb" href="#">Sign in with<i class="ti ti-brand-facebook"></i></a>
								<a class="tw" href="#">Sign in with<i class="ti ti-brand-x"></i></a>
								<a class="gl" href="#">Sign in with<i class="ti ti-brand-google"></i></a>
							</div> -->

							<span class="sign__text">chưa có tài khoản?<a href="{{route('register')}}">Đăng ký
									!</a></span>

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
	<script src="/js/iziToast.min.js"></script>
	

</body>

@if(session("errorLogin"))
	<script>
		iziToast.warning({
			message: "{{ session("errorLogin") }}",
			position: "topCenter"
		});
	</script>
@endif

@if(session("successRegister"))
	<script>
		iziToast.success({
			message: "{{ session("successRegister") }}",
			position: "topCenter"
		});
	</script>
@endif

 

</html>