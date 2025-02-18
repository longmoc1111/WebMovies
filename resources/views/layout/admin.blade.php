
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/slimselect.css">
	<link rel="stylesheet" href="/css/admin.css">
	<link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="/css/iziToast.min.css">

	<!-- Icon font -->
	<link rel="stylesheet" href="/webfont/tabler-icons.min.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">

	<meta name="description" content="Online Movies, TV Shows & Cinema HTML Template">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>HotFlix – Online Movies</title>
</head>

<body>
	<!-- header -->
	<header class="header">
		<div class="header__content">
			<!-- header logo -->
			<a href="index.html" class="header__logo">
				<img src="img/logo.svg" alt="">
			</a>
			<!-- end header logo -->

			<!-- header menu btn -->
			<button class="header__btn" type="button">
				<span></span>
				<span></span>
				<span></span>
			</button>
			<!-- end header menu btn -->
		</div>
	</header>
	<!-- end header -->

	<!-- sidebar -->
	<div class="sidebar">
		<!-- sidebar logo -->
		<a href="index.html" class="sidebar__logo">
			<img src="img/logo.svg" alt="">
		</a>
		<!-- end sidebar logo -->
		
		<!-- sidebar user -->
		<div class="sidebar__user">
			<div class="sidebar__user-img">
				<img src="/img/user.svg" alt="">
			</div>

			<div class="sidebar__user-title">
				<span>Admin</span>
				<p>{{Auth()->user()->name}}</p>
			</div>
			<form class="sidebar__user-btn" action="{{ route("logout.post") }}" method = "POST">
			@csrf
			<button class="sidebar__user-btn" type="submit">
				<i class="bi bi-box-arrow-right"></i>
			</button>
			</form>
		</div>
		<!-- end sidebar user -->

		<!-- sidebar nav -->
		<div class="sidebar__nav-wrap">
			<ul class="sidebar__nav">
				<li class="sidebar__nav-item">
					<a href="{{route("Dashboard.index")}}" class="sidebar__nav-link"><i class="bi bi-grid"></i> <span>Dashboard</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="{{route("Movies.index")}}" class="sidebar__nav-link "><i class="bi bi-film"></i> <span>phim</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="{{route("admin.director.index")}}" class="sidebar__nav-link"><i class="bi bi-chat"></i> <span>Đạo diễn</span></a>
				</li>

                <li class="sidebar__nav-item">
					<a href="{{route("admin.actor.index")}}" class="sidebar__nav-link"><i class="bi bi-chat"></i> <span>diễn viên</span></a>
				</li>
				<li class="sidebar__nav-item">
					<a href="" class="sidebar__nav-link"><i class="bi bi-person"></i> <span>Người dùng</span></a>
				</li>
				<!-- dropdown -->
				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-files"></i> <span>Trang</span> <i class="bi bi-chevron-down"></i></a>

					<ul class="dropdown-menu sidebar__dropdown-menu">
						<li><a href="{{route("Movies.create")}}">Thêm Mới phim</a></li>
						<li><a href="{{route("login")}}">Đăng nhập</a></li>
						<li><a href="{{route("login")}}">Đăng ký</a></li>
						<li><a href="{{route("Unauthorized")}}">404 Page</a></li>
					</ul>
				</li>
				<!-- end dropdown -->

				<li class="sidebar__nav-item">
					<a href="{{route("Home.index")}}" class="sidebar__nav-link"><i class="bi bi-arrow-left"></i> <span>Back to HotFlix</span></a>
				</li>
			</ul>
		</div>
		<!-- end sidebar nav -->
	
	</div>
	<!-- end sidebar -->
@yield("admin")
</body>

<footer>

	<script src="/js/slimselect.min.js"></script>
	<script src="/js/smooth-scrollbar.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="/js/admin.js"></script>
	<script src="/js/bootstrap.bundle.min.js"></script>>
	<script src="/js/iziToast.min.js"></script>
	@yield("footeradmin")
</footer>
</html>