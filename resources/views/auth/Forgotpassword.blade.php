@extends("layout.auth")
@section("authmain")

	<body>
		<div class="sign section--bg" data-bg="https://hotflix.volkovdesign.com/main/img/bg/section__bg.jpg">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="sign__content">
							<!-- authorization form -->
							<form action="{{ route("password.request") }}" class="sign__form" method="POST">
								@csrf
								@if(session("status"))
									<div class="alert alert-warning">{{ session("status") }}</div>
								@endif
								@if($errors->any())
									@foreach ($errors->all() as $error)
										<div class = "alert alert-warning">{{ $error }}</div>
									@endforeach
								@endif
								<a href="index.html" class="sign__logo">
									<img src="" alt="">
									<h1 style="color:#F9AB00">Quên mật khẩu</h1>
								</a>

								<div class="sign__group">
									<input name="email" type="text" class="sign__input " placeholder="Email">
									@error('email')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<button class="sign__btn" type="submit">Gửi</button>
								<!-- <span class="sign__text">chưa có tài khoản? <a href="{{route('register')}}">Đăng ký
										!</a></span> -->

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



@endsection