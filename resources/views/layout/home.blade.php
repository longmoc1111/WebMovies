
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
	<link rel="stylesheet" href="/webfont/tabler-icons.min.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="../icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="../icon/favicon-32x32.png">

	<meta name="description" content="Online Movies, TV Shows & Cinema HTML Template">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>HotFlix – Online Movies, TV Shows & Cinema HTML Template</title>
</head>

<body>
	<!-- header -->
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="header__content">
						<!-- header logo -->
						<a href="index.html" class="header__logo">
							<img src="img/logo.svg" alt="">
						</a>
						<!-- end header logo -->

						<!-- header nav -->
						<ul class="header__nav">
							<!-- dropdown -->
							<li class="header__nav-item">
								<a class="header__nav-link" href="{{route("Home.index")}}" role="button"	 aria-expanded="false">Trang chủ</a>

							</li>
							<!-- end dropdown -->

							<!-- dropdown -->
							<!-- <li class="header__nav-item">
								<a class="header__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Thể loại<i class="bi bi-chevron-down"></i></a>
								<ul class="dropdown-menu header__dropdown-menu">
									<li><a href="catalog.html">Catalog style 1</a></li>
									<li><a href="catalog2.html">Catalog style 2</a></li>
									<li><a href="details.html">Details Movie</a></li>
									<li><a href="details2.html">Details TV Series</a></li>
								</ul>
								
							</li> -->
							<li class="header__nav-item">
								<a class="header__nav-link" href="{{ route("Home.theaterMovie") }}" role="button"  aria-expanded="false">Phim chiếu rạp</a>
							</li>
							<li class="header__nav-item">
								<a class="header__nav-link" href="{{ route("Home.singleMovie") }}" role="button"  aria-expanded="false">Phim lẻ</a>

							</li>
							<!-- end dropdown -->


							<!-- dropdown -->
							@if(Auth::check() && Auth::user()->name == "admin")
							<li class="header__nav-item">
								<a class="header__nav-link" href="{{route("Dashboard.index")}}" role="button"  aria-expanded="false">Trang Admin</a>
									<!-- <li><a href="../admin/index.html" target="_blank">Admin pages</a></li> -->
								</ul>
							</li>
							@endif
							<!-- end dropdown -->
						</ul>
						<!-- end header nav -->

						<!-- header auth -->
						<div class="header__auth">
							<form action="{{route("Home.search")}}" class="header__search">
								<input name = "search" class="header__search-input" type="text" placeholder="Tìm kiếm...">
								<button class="header__search-button" type="submit">
									<i class="bi bi-search"></i>
								</button>
								<button class="header__search-close" type="button">
									<i class="bi bi-x"></i>
								</button>
							</form>

							<button class="header__search-btn" type="button">
								<i class="bi bi-search"></i>
							</button>

						
							<!-- dropdown -->
							 @if(Auth::check())
							<div class="header__profile">
								<a class="header__sign-in header__sign-in--user" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="bi bi-person"></i>
									<span>{{Auth::user()->name}}</span>
								</a>
								<ul class="dropdown-menu dropdown-menu-end header__dropdown-menu header__dropdown-menu--user">
									<li><a href="profile.html"><i class="bi bi-person"></i>cá nhân</a></li>
									<li><a href="profile.html"><i class="bi bi-bookmark"></i>yêu thích</a></li>
									<li>
									<form action="{{route("logout.post")}}" method = "POST">
									@csrf
										<button class = "btn-logout" type = "submit"><i style = "margin-right: 8px;" class="bi bi-box-arrow-left"></i> Đăng xuất</button>
									</li>
									</form>
									</ul>
							</div>
							@else
							<a href="{{route("login")}}" class="header__sign-in">
								<i class="ti ti-login"></i>
								<span>Đăng nhập</span>
							</a>
                        	@endif
							<!-- end dropdown -->
						</div>
						<!-- end header auth -->

						<!-- header menu btn -->
						<button class="header__btn" type="button">
							<span></span>
							<span></span>
							<span></span>
						</button>
						<!-- end header menu btn -->
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- end header -->
@yield("home");
<!-- footer -->
<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="footer__content">
						<a href="index.html" class="footer__logo">
							<img src="img/logo.svg" alt="">
						</a>

						<span class="footer__copyright">© MOIMOI</span>

						<nav class="footer__nav">
							<a href="about.html">About Us</a>
							<a href="contacts.html">Contacts</a>
							<a href="privacy.html">Privacy policy</a>
						</nav>

						<button class="footer__back" type="button">
							<i class="bi bi-arrow-up"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- end footer -->

	<!-- plan modal -->
	<div class="modal fade" id="plan-modal" tabindex="-1" aria-labelledby="plan-modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>

					<form action="#" class="modal__form">
						<h4 class="modal__title">Select plan</h4>

						<div class="sign__group">
							<label for="fullname" class="sign__label">Name</label>
							<input id="fullname" type="text" name="name" class="sign__input" placeholder="Full name">
						</div>

						<div class="sign__group">
							<label for="email" class="sign__label">Email</label>
							<input id="email" type="text" name="email" class="sign__input" placeholder="example@domain.com">
						</div>

						<div class="sign__group">
							<label class="sign__label" for="value">Choose plan:</label>
							<select class="sign__select" name="value" id="value">
								<option value="35">Premium - $34.99</option>
								<option value="50">Cinematic - $49.99</option>
							</select>

							<span class="sign__text">You can spend money from your account on the renewal of the connected packages, or to order cars on our website.</span>
						</div>

						<div class="sign__group">
							<label class="sign__label">Payment method:</label>

							<ul class="sign__radio">
								<li>
									<input id="type1" type="radio" name="type" checked="">
									<label for="type1">Visa</label>
								</li>
								<li>
									<input id="type2" type="radio" name="type">
									<label for="type2">Mastercard</label>
								</li>
								<li>
									<input id="type3" type="radio" name="type">
									<label for="type3">Paypal</label>
								</li>
							</ul>
						</div>

						<button type="button" class="sign__btn sign__btn--modal">
							<span>Proceed</span>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end plan modal -->

	<!-- JS -->

</body>
<footer>
	@section("footerHome")
<script src="/js/bootstrap.bundle.min.js"></script>
	<script src="/js/splide.min.js"></script>
	<script src="/js/slimselect.min.js"></script>
	<script src="/js/smooth-scrollbar.js"></script>
	<script src="/js/plyr.min.js"></script>
	<script src="/js/photoswipe.min.js"></script>
	<script src="/js/photoswipe-ui-default.min.js"></script>
	<script src="/js/main.js"></script>
</footer>
</html>


    
