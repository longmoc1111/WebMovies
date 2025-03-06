@extends("layout.auth")
@section("authmain")
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
							<span class="sign__text"><a href="{{ route("password.request") }}">Quên mật khẩu?</a></span>


							<span class="sign__text">chưa có tài khoản? <a href="{{route('register')}}">Đăng ký
									!</a></span>

						</form>
						<!-- end authorization form -->
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
@endsection

@section("authfooter")

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

@endsection
