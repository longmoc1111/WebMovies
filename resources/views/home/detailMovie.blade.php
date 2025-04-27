@extends("layout.home")
@section("home")
	<!-- details -->
	<section class="section section--details">
		<!-- details content -->
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<h1 class="section__title section__title--head">{{$movieID->MovieName}}</h1>
				</div>
				<!-- end title -->

				<!-- content -->
				<div class="col-12 col-xl-6">
					<div class="item item--details">
						<div class="row">
							<!-- card cover -->
							<div class="col-12 col-sm-5 col-md-5 col-lg-4 col-xl-6 col-xxl-5">
								<div class="item__cover">
									<img src="/assets/BackgroundMovie/{{$movieID->MovieImage}}" alt="">
									<span class="item__rate item__rate--green">8.4</span>
									<button class="item__favorite item__favorite--static" type="button"><i
											class="bi bi-bookmark"></i></button>
								</div>
							</div>
							<!-- end card cover -->

							<!-- card content -->
							<div class="col-12 col-md-7 col-lg-8 col-xl-6 col-xxl-7">
								<div class="item__content">
									<ul class="item__meta">
										<li><span>Tác giả:</span> <a href="#">
												@if($movieID && $movieID->Directors && $movieID->Directors->isNotEmpty())
													{{ $movieID->Directors->pluck('DirectorName')->join(', ') }}
												@endif
											</a></li>
										<li><span>Diễn viên:</span> <a href="#">
											@if($movieID && $movieID->Actors && $movieID->Actors->isNotEmpty())
												{{$movieID->Actors->pluck('ActorName')->join(',')}}
											@endif
										</a>
										<li><span>thể loại:</span> <a href="#">
										@if($movieID && $movieID->Types && $movieID->Types->isNotEmpty())
											{{$movieID->Types->pluck('TypeName')->join(',')}}
										@endif
										</a>
										<li><span>loại phim:</span> <a href="#">
											{{$movieID->Genres->GenreName}}
										</a>
										<li><span>năm phát hành:</span>{{$movieID->MovieYear}}</li>
										<li><span>quốc gia:</span> <a href="#">
										@if($movieID && $movieID->Countries && $movieID->Countries->isNotEmpty())
											{{$movieID->Countries->pluck('CountryName')->join(',')}}
										@endif
										</a></li>
									</ul>
									<div class="item__description">
										<p>{{$movieID->MovieDescription}}</p>
									</div>
								</div>
							</div>
							<!-- end card content -->
						</div>
					</div>
				</div>
				<!-- end content -->

				<!-- player -->
				<div class="col-12 col-xl-6">
				<iframe src="{{ $movieID->MovieLink }}" width="640" height="360" allowfullscreen></iframe>

						<!-- Fallback for browsers that don't support the <video> element -->
				</div>
				<!-- end player -->
			</div>
		</div>
		<!-- end details content -->
	</section>
	<!-- end details -->

	<!-- content -->
	<section class="content">
		<div class="content__head content__head--mt">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content title -->
						<h2 class="content__title">Discover</h2>
						<!-- end content title -->

						<!-- content tabs nav -->
						<ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<button id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1"
									type="button" role="tab" aria-controls="tab-1"
									aria-selected="true">Bình luận</button>
							</li>

							<li class="nav-item" role="presentation">
								<button id="3-tab" data-bs-toggle="tab" data-bs-target="#tab-3" type="button" role="tab"
									aria-controls="tab-3" aria-selected="false">Ảnh</button>
							</li>
						</ul>
						<!-- end content tabs nav -->
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-8">
					<!-- content tabs -->
					<div class="tab-content">
						<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab"
							tabindex="0">
							<div class="row">
								<!-- comments -->
								<div class="col-12">
									<div class="comments">
										<ul class="comments__list">
											<li class="comments__item">
												<div class="comments__autor">
													<img class="comments__avatar" src="img/user.svg" alt="">
													<span class="comments__name">John Doe</span>
													<span class="comments__time">30.08.2018, 17:53</span>
												</div>
												<p class="comments__text">There are many variations of passages of Lorem
													Ipsum available, but the majority have suffered alteration in some
													form, by injected humour, or randomised words which don't look even
													slightly believable. If you are going to use a passage of Lorem
													Ipsum, you need to be sure there isn't anything embarrassing hidden
													in the middle of text.</p>
												<div class="comments__actions">
													<div class="comments__rate">
														<button type="button"><i class="bi bi-hand-thumbs-up"></i>12</button>

														<button type="button">7<i class="bi bi-hand-thumbs-down"></i></button>
													</div>

													<button type="button"><i
															class="bi bi-arrow-return-right"></i>trả lời</button>
													
												</div>
											</li>

											<li class="comments__item comments__item--answer">
												<div class="comments__autor">
													<img class="comments__avatar" src="img/user.svg" alt="">
													<span class="comments__name">John Doe</span>
													<span class="comments__time">24.08.2018, 16:41</span>
												</div>
												<p class="comments__text">Lorem Ipsum is simply dummy text of the
													printing and typesetting industry. Lorem Ipsum has been the
													industry's standard dummy text ever since the 1500s, when an unknown
													printer took a galley of type and scrambled it to make a type
													specimen book.</p>
												<div class="comments__actions">
													<div class="comments__rate">
														<button type="button"><i class="bi bi-thumb-up"></i>8</button>

														<button type="button">3<i class="bi bi-thumb-down"></i></button>
													</div>

													<button type="button"><i
															class="ti ti-arrow-forward-up"></i>trả lời</button>
													
												</div>
											</li>

											<li class="comments__item comments__item--quote">
												<div class="comments__autor">
													<img class="comments__avatar" src="img/user.svg" alt="">
													<span class="comments__name">John Doe</span>
													<span class="comments__time">11.08.2018, 11:11</span>
												</div>
												<p class="comments__text"><span>There are many variations of passages of
														Lorem Ipsum available, but the majority have suffered alteration
														in some form, by injected humour, or randomised words which
														don't look even slightly believable.</span>It has survived not
													only five centuries, but also the leap into electronic typesetting,
													remaining essentially unchanged. It was popularised in the 1960s
													with the release of Letraset sheets containing Lorem Ipsum passages,
													and more recently with desktop publishing software like Aldus
													PageMaker including versions of Lorem Ipsum.</p>
												<div class="comments__actions">
													<div class="comments__rate">
														<button type="button"><i class="ti ti-thumb-up"></i>11</button>

														<button type="button">1<i class="ti ti-thumb-down"></i></button>
													</div>

													<button type="button"><i
															class="ti ti-arrow-forward-up"></i>trả lời</button>
													
												</div>
											</li>

											<li class="comments__item">
												<div class="comments__autor">
													<img class="comments__avatar" src="img/user.svg" alt="">
													<span class="comments__name">John Doe</span>
													<span class="comments__time">07.08.2018, 14:33</span>
												</div>
												<p class="comments__text">There are many variations of passages of Lorem
													Ipsum available, but the majority have suffered alteration in some
													form, by injected humour, or randomised words which don't look even
													slightly believable. If you are going to use a passage of Lorem
													Ipsum, you need to be sure there isn't anything embarrassing hidden
													in the middle of text.</p>
												<div class="comments__actions">
													<div class="comments__rate">
														<button type="button"><i class="ti ti-thumb-up"></i>99</button>

														<button type="button">35<i
																class="ti ti-thumb-down"></i></button>
													</div>

													<button type="button"><i
															class="ti ti-arrow-forward-up"></i>trả lời</button>
													
												</div>
											</li>

											<li class="comments__item">
												<div class="comments__autor">
													<img class="comments__avatar" src="img/user.svg" alt="">
													<span class="comments__name">John Doe</span>
													<span class="comments__time">02.08.2018, 15:24</span>
												</div>
												<p class="comments__text">Many desktop publishing packages and web page
													editors now use Lorem Ipsum as their default model text, and a
													search for 'lorem ipsum' will uncover many web sites still in their
													infancy. Various versions have evolved over the years, sometimes by
													accident, sometimes on purpose (injected humour and the like).</p>
												<div class="comments__actions">
													<div class="comments__rate">
														<button type="button"><i class="ti ti-thumb-up"></i>74</button>

														<button type="button">13<i
																class="ti ti-thumb-down"></i></button>
													</div>

													<button type="button"><i
															class="ti ti-arrow-forward-up"></i>trả lời</button>
													
												</div>
											</li>
										</ul>

										<!-- paginator mobile -->
										<div class="paginator-mob paginator-mob--comments">
											<span class="paginator-mob__pages">5 of 628</span>

											<ul class="paginator-mob__nav">
												<li>
													<a href="#">
														<i class="ti ti-chevron-left"></i>
														<span>Prev</span>
													</a>
												</li>
												<li>
													<a href="#">
														<span>Next</span>
														<i class="ti ti-chevron-right"></i>
													</a>
												</li>
											</ul>
										</div>
										<!-- end paginator mobile -->

										<!-- paginator desktop -->
										<ul class="paginator paginator--comments">
											<li class="paginator__item paginator__item--prev">
												<a href="#"><i class="ti ti-chevron-left"></i></a>
											</li>
											<li class="paginator__item"><a href="#">1</a></li>
											<li class="paginator__item paginator__item--active"><a href="#">2</a></li>
											<li class="paginator__item"><a href="#">3</a></li>
											<li class="paginator__item"><a href="#">4</a></li>
											<li class="paginator__item"><span>...</span></li>
											<li class="paginator__item"><a href="#">36</a></li>
											<li class="paginator__item paginator__item--next">
												<a href="#"><i class="ti ti-chevron-right"></i></a>
											</li>
										</ul>
										<!-- end paginator desktop -->

										<form action="#" class="sign__form sign__form--comments">
											<div class="sign__group">
												<textarea id="text" name="text" class="sign__textarea"
													placeholder="Bình luận"></textarea>
											</div>

											<button type="button" class="sign__btn sign__btn--small">gửi</button>
										</form>
									</div>
								</div>
								<!-- end comments -->
							</div>
						</div>

						<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab" tabindex="0">
							
						</div>

						<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="3-tab" tabindex="0">

						</div>
						
					</div>
					<!-- end content tabs -->
				</div>

				<!-- sidebar -->
				<div class="col-12 col-lg-4">
					<div class="row">
						<!-- section title -->
						<div class="col-12">
							<h2 class="section__title section__title--sidebar">các tựa phim khác</h2>
						</div>
						<!-- end section title -->

						<!-- item -->
						@php
						 $count = 0;
						 @endphp
	
						 @foreach ($movies as $movie)
							@if($movie->GenreID == $movieID->GenreID)
								<div class="col-6 col-sm-4 col-lg-6">
									<div class="item">
										<div class="item__cover">
											<img src="/assets/BackgroundMovie/{{$movie->MovieImage}}" alt="">
											<!-- sua lai route -->
											<a href="{{ route("Home.detail",$movie->MovieID) }}" class="item__play">
												<i class="bi bi-play"></i>
											</a>
											<span class="item__rate item__rate--green">{{$movie->MovieEvaluate}}</span>
											<button class="item__favorite" type="button"><i class="bi bi-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="#">{{$movie->MovieName}}</a></h3>
											<span class="item__category">
												<a href="#">{{ $movie->Genres->pluck("GenreName")->take(2)->join(", ") }}</a>
													<!-- <a href="#">Triler</a> -->
												</span>
										</div>
									</div>
								</div>
								@php
								$count++;
									if($count == 4)
										break;
								@endphp
							@endif
						@endforeach
						<!-- end item -->
					</div>
				</div>
				<!-- end sidebar -->
			</div>
		</div>
	</section>
	<!-- end content -->
@endsection