@extends("layout.auth")
@section("authmain")

	<body>
		<div class="sign section--bg" data-bg="https://hotflix.volkovdesign.com/main/img/bg/section__bg.jpg">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="sign__content">
							<!-- authorization form -->

							<form action="{{route("register.post")}}" class="sign__form" method="POST">
								@csrf
								<a href="index.html" class="sign__logo">
									<img src="" alt="">
									<h1 style="color:#F9AB00">Đăng ký</h1>
								</a>

								<div class="sign__group">
									<input name="name" type="text" class="sign__input" placeholder="UserName">
								</div>

								<div class="sign__group">
									<input name="email" type="text" class="sign__input" placeholder="Email">
								</div>

								<div class="sign__group">
									<input name="password" type="password" class="sign__input" placeholder="Password">
								</div>
								<button class="sign__btn" type="submit">Đăng ký</button>
								<span class="sign__text">Đã có tài khoản? <a href="{{route('login')}}">Đăng nhập
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
	@if($errors->has("email"))
		<script>
			iziToast.warning({
				message: "{{ $errors->first("email") }}",
				position: "topCenter"
			});
		</script>
	@endif
@endsection