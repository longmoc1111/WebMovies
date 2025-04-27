@extends("layout.home")

@section("home")

	<!-- page title -->
	<section class="section section--first">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h1 class="section__title section__title--head">{{ $title }}</h1>
						<!-- end section title -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- filter -->
	<div class="filter">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<form action="{{ route("Home.filter") }}">
						<div class="filter__content">
							<!-- menu btn -->
							<button class="filter__menu" type="button"><i class="bi bi-filter"></i>Lọc</button>
							<!-- end menu btn -->

							<!-- filter desk -->

							<div class="filter__items">
								<select name="Danhmuc" class="filter__select" name="genre" id="filter__genre">
									<option value="">Danh mục</option>
									@foreach($Genres as $genre)
										<option value="{{ $genre->GenreName }}" {{ request("Danhmuc") == $genre->GenreName ? "selected" : "" }}>{{ $genre->GenreName }}</option>
									@endforeach	
								</select>


								<select name="Quocgia" class="filter__select" name="quality" id="filter__country">
									<option value="">Quốc gia</option>
									@foreach($Countries as $country)
										<option value="{{ $country->CountryName}}" {{ request("Quocgia") == $country->CountryName ? "selected" : "" }}>{{ $country->CountryName }}</option>
									@endforeach
								</select>

								<select name="Theloai" class="filter__select" name="sort" id="filter__Type">
									<option value="">Thể loại</option>
									@foreach ($Types as $type)
										<option value="{{ $type->TypeName }}" {{ request("Theloai") == $type->TypeName ? "selected" : "" }}>{{ $type->TypeName}}</option>
									@endforeach
								</select>
							</div>
							<!-- end filter desk -->

							<!-- filter btn -->
							<button class="filter__btn" type="submit">Tìm kiếm</button>
							<!-- end filter btn -->


						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end filter -->

	<!-- catalog -->
	<div class="section section--catalog">
		<div class="container">
			<div class="row">
				<!-- item -->
				@foreach($Movies as $movie)
					<div class="col-6 col-sm-4 col-lg-3 col-xl-2">
						<div class="item">
							<div class="item__cover">
								<img src="/assets/BackgroundMovie/{{$movie->MovieImage}}" alt="">
								<a href="{{ route("Home.detail", $movie->MovieID) }}" class="item__play">
									<i class="bi bi-play"></i>
								</a>
								<span class="item__rate item__rate--green">{{ $movie->MovieEvaluate }}</span>
								<button class="item__favorite" type="button"><i class="bi bi-bookmark"></i></button>
							</div>
							<div class="item__content">
								<h3 class="item__title"><a href="details.html">{{ $movie->MovieName }}</a></h3>
								<span class="item__category">
									<a href="#">
										{{ $movie->Types->pluck("TypeName")->take(2)->join(", ") }}
									</a>
								</span>
							</div>
						</div>
					</div>
				@endforeach
				<!-- end item -->
			</div>

			<div class="row">
				<!-- paginator -->
				<div class="col-12">
					<!-- paginator mobile -->
					<div class="paginator-mob">
						<span class="paginator-mob__pages">{{ $Movies->currentPage()}} of {{$Movies->lastPage() }}</span>

						<ul class="paginator-mob__nav">
							@if($Movies->onFirstPage())
								<li>
									<a href="#">
										<i class="bi bi-chevron-left"></i>
										<span>trước</span>
									</a>
								</li>
							@else
								<li>
									<a href="{{ $Movies->previousPageUrl() }}">
										<i class="bi bi-chevron-left"></i>
										<span>trước</span>
									</a>
								</li>
							@endif

							@if($Movies->hasMorePages())
								<li>
									<a href="{{ $Movies->nextPageUrl() }}">
										<span>tiếp</span>
										<i class="bi bi-chevron-right"></i>
									</a>
								</li>
							@else
								<li>
									<a href="#">
										<span>tiếp</span>
										<i class="bi bi-chevron-right"></i>
									</a>
								</li>
							@endif
						</ul>
					</div>
					<!-- end paginator mobile -->

					<!-- paginator desktop -->
					<ul class="paginator">
						@if($Movies->onFirstPage())
							<li class="paginator__item paginator__item--prev">
								<a href="#"><i class="bi bi-chevron-left"></i></a>
							</li>
						@else
							<li class="paginator__item paginator__item--prev">
								<a href="{{ $Movies->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a>
							</li>
						@endif

						@for($i = 1; $i <= $Movies->lastPage(); $i++)
							@if($i == $Movies->currentPage())
								<li class="paginator__item paginator__item--active"><a href="#">{{ $i }}</a></li>
							@else
								<li class="paginator__item"><a href="{{ $Movies->url($i) }}">{{ $i }}</a></li>
							@endif
						@endfor

						@if($Movies->hasMorePages())
							<li class="paginator__item paginator__item--next">
								<a href="{{ $Movies->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a>
							</li>
						@else
							<li class="paginator__item paginator__item--next">
								<a href="#"><i class="bi bi-chevron-right"></i></a>
							</li>
						@endif
					</ul>
					<!-- end paginator desktop -->
				</div>
				<!-- end paginator -->
			</div>
		</div>
	</div>
	<!-- end catalog -->


	<!-- mobile filter -->
	<div class="mfilter">
		<div class="mfilter__head">
			<h6 class="mfilter__title">Lọc</h6>

			<button class="mfilter__close" type="button"><i class="bi bi-x"></i></button>
		</div>
		<form action="{{ route("Home.filter") }}" class="mfilter__select-wrap">
			<div class="sign__group">
				<select name = "Danhmuc" class="filter__select" id="mfilter__genre">
					<option value="">Danh mục</option>
					@foreach($Genres as $genre)
						<option value="{{ $genre->GenreName }}" {{ request("Danhmuc") == $genre->GenreName ? "selected" : "" }}>
							{{ $genre->GenreName }}
						</option>
					@endforeach	
				</select>
			</div>

			<div class="sign__group">
				<select name = "Quocgia" class="filter__select" id="mfilter__country">
					<option value="">Quốc gia</option>
					@foreach($Countries as $country)
						<option value="{{ $country->CountryName}}" {{ request("Quocgia") == $country->CountryName ? "selected" : "" }}>{{ $country->CountryName }}</option>
					@endforeach
				</select>
			</div>

			<div class="sign__group">
				<select name = "Theloai" class="filter__select" name="mrate" id="mfilter__type">
					<option value="">Thể loại</option>
					@foreach ($Types as $type)
						<option value="{{ $type->TypeName }}" {{ request("Theloai") == $type->TypeName ? "selected" : "" }}>
							{{ $type->TypeName}}
						</option>
					@endforeach
				</select>
			</div>
			<button class="mfilter__apply" type="submit">Tìm kiếm</button>
		</form>
	</div>
	<!-- end mobile filter -->

	<!-- JS -->
@endsection

@section("footerHome")

@endsection