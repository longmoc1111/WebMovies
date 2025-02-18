@extends("layout.home")
@section("home")
<!-- home -->
<section class="home">
	<div class="container">
		<div class="row">
			<!-- home title -->
			<div class="col-12">
				<h1 class="home__title"><b>Phim mới</b> trong tháng</h1>
			</div>
			<!-- end home title -->

			<!-- home carousel -->
			<div class="col-12">
				<div class="home__carousel splide splide--home">
					<div class="splide__arrows">
						<button class="splide__arrow splide__arrow--prev" type="button">
							<i class="bi bi-chevron-left"></i>
						</button>
						<button class="splide__arrow splide__arrow--next" type="button">
							<i class="bi bi-chevron-right"></i>
						</button>
					</div>

					<div class="splide__track">
						<ul class="splide__list">
							@foreach($movies->take(7) as $movie)
								@if($movie->MovieStatus != "sắp ra mắt")
									<li class="splide__slide">
										<div class="item item--hero">
											<div class="item__cover">
												<img src="{{$movie->MovieImage}}" alt="">
												<!--thay doi route  -->
												<a href="{{route("Home.detail", $movie->MovieID)}}" class="item__play">
													<i class="bi bi-play"></i>
												</a>
												<span class="item__rate item__rate--green">{{$movie->MovieEvaluate}}</span>
												<button class="item__favorite" type="button"><i
														class="bi bi-bookmark"></i></button>
											</div>
											<div class="item__content">
												<h3 class="item__title"><a href="details.html">{{$movie->MovieName}}</a></h3>
												<span class="item__category">
												<a href="#">{{ $movie->Genres->pluck("GenreName")->take(2)->join(", ") }}</a>
													<!-- <a href="#">Triler</a> -->
												</span>
											</div>
										</div>
									</li>
								@endif
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<!-- end home carousel -->
		</div>
	</div>
</section>
<!-- end home -->

<!-- content -->
<section class="content">
	<div class="content__head">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- content title -->
					<h2 class="content__title">Cập nhật mới</h2>
					<!-- end content title -->

					
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<!-- content tabs -->
		<div class="tab-content">
			<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab" tabindex="0">
				<div class="row">
					<!-- item -->
					@foreach($movies as $movie)
						@if($movie->MovieStatus != "sắp ra mắt")
							<div class="col-6 col-sm-4 col-lg-3 col-xl-2">
								<div class="item">
									<div class="item__cover">
										<img src="{{$movie->MovieImage}}" alt="">
										<a href="{{route("Home.detail", $movie->MovieID)}}" class="item__play">
											<i class="bi bi-play"></i>
										</a>
										<span class="item__rate item__rate--green">{{$movie->MovieEvaluate}}</span>
										<button class="item__favorite" type="button"><i class="bi bi-bookmark"></i></button>
									</div>
									<div class="item__content">
										<h3 class="item__title"><a href="details.html">{{$movie->MovieName}}</a></h3>
										<span class="item__category">
										<a href="#">{{ $movie->Genres->pluck("GenreName")->take(2)->join(", ") }}</a>
											<!-- <a href="#">Triler</a> -->
										</span>
									</div>
								</div>
							</div>
						@endif
					@endforeach
					<!-- end item -->

				</div>
			</div>
		</div>
		<!-- end content tabs -->

		<div class="row">
			<!-- more -->
			<div class="col-12">
				<a class="section__more" href="{{route("Home.viewAll")}}">xem thêm</a>
			</div>
			<!-- end more -->
		</div>
	</div>
</section>
<!-- end content -->

<!-- section -->
<section class="section section--border">
	<div class="container">
		<div class="row">
			<!-- section title -->
			<div class="col-12">
				<div class="section__title-wrap">
					<h2 class="section__title">Sắp ra mắt</h2>
					<a href="#" class="section__view section__view--carousel">View All</a>
				</div>
			</div>
			<!-- end section title -->

			<!-- carousel -->
			<div class="col-12">
				<div class="section__carousel splide splide--content">
					<div class="splide__arrows">
						<button class="splide__arrow splide__arrow--prev" type="button">
							<i class="bi bi-chevron-left"></i>
						</button>
						<button class="splide__arrow splide__arrow--next" type="button">
							<i class="bi bi-chevron-right"></i>
						</button>
					</div>

					<div class="splide__track">
						<ul class="splide__list">
							@foreach($movies as $movie)
								@if($movie->MovieStatus == "sắp ra mắt")
									<li class="splide__slide">
										<div class="item item--carousel">
											<div class="item__cover">
												<img src="{{$movie->MovieImage}}" alt="">
												<a href="{{route("Home.detail", $movie->MovieID)}}" class="item__play">
													<i class="bi bi-play"></i>
												</a>
												<span class="item__rate item__rate--green">{{$movie->MovieEvaluate}}</span>
												<button class="item__favorite" type="button"><i
														class="bi bi-bookmark"></i></button>
											</div>
											<div class="item__content">
												<h3 class="item__title"><a href="details.html">{{$movie->MovieName}}</a></h3>
												<span class="item__category">
													<a href="#">{{ $movie->Genres->pluck("GenreName")->take(2)->join(", ") }}</a>
												</span>
											</div>
										</div>
									</li>
								@endif
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<!-- end carousel -->
		</div>
	</div>
</section>
<!-- end section -->
@endsection

@section("footerHome")

@if(session("successLogin"))
	<script>
		iziToast.success({
			message: "{{ session("successLogin") }}",
			position: "topRight"
		});
	</script>
@endif


@endsection