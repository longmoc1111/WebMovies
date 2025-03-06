@extends("layout.auth")
@section("authmain")

	<body>
		<div class="sign section--bg" data-bg="https://hotflix.volkovdesign.com/main/img/bg/section__bg.jpg">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="sign__content">
							<!-- authorization form -->

							<form action="{{ route("password.update") }}" class="sign__form" method="post">
								@csrf
								@if ($errors->any())
									@foreach ($errors->all() as $error)
										<p class="text-danger">{{ $error }}</p>
									@endforeach
								@endif
								<input type="hidden" name="token" value={{ $token }}>
								<a href="index.html" class="sign__logo">
									<img src="" alt="">
									<h1 style="color:#F9AB00">Lấy lại mật khẩu</h1>
								</a>

								<div class="sign__group">
									<input name="email" type="text" class="sign__input" placeholder="Email">
								</div>

								<div class="sign__group">
									<input name="password" type="password" class="sign__input" placeholder="Password">
								</div>
								<div class="sign__group">
									<input name="password_confirmation" type="password" class="sign__input"
										placeholder="Password">
								</div>
								<button class="sign__btn" type="submit">Gửi</button>

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