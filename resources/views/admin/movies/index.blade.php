@extends("layout.admin")
@section("admin")
<!-- main content -->
<main class="main">
	<div class="container-fluid">
		<div class="row">
			<!-- main title -->
			<div class="col-12">
				<div class="main__title">
					<h2>phim</h2>
					<div class="main__title-wrap">
						<a href="{{route("Movies.create")}}" class="main__title-link main__title-link--wrap">Thêm
							mới</a>

						<form action="{{route("Movies.sort")}}" class="filter__select" id="filterForm">
						 
							<select name="option" class="filter__select" id="filter__sort" onchange = "this.form.submit()">
								<option value="Tên phim" {{request("option") == "Tên phim" ? "selected" : ""}}>Tên phim
								</option>
								<option value="Năm ra mắt" {{request("option") == "Năm ra mắt" ? "selected" : ""}}>Năm ra
									mắt</option>
								<option value="Đánh giá" {{request("option") == "Đánh giá" ? "selected" : ""}}>
									Đánh giá</option>
							</select>
						</form>
						
						<!-- search -->
						<form action="{{route("Movies.search")}}" class="main__title-form">
							<input name = "search" type="text" placeholder="Tìm kiếm....">
							<button type="submit">
								<i class="bi bi-search"></i>
							</button>
						</form>
						<!-- end search -->
					</div>
				</div>
			</div>
			<!-- end main title -->

			<!-- items -->
			<div class="col-12">
				<div class="catalog catalog--1">
					<table class="catalog__table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tên Phim</th>
								<th>RATING</th>
								<th>THỂ LOẠI</th>
								<th>QUỐC GIA</th>
								<th>NĂM RA MẮT</th>
								<th>TRẠNG THÁI</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							@php
								$count = 1;
							@endphp
							@foreach($movies as $movie)
								<tr>
									<td>
										<div class="catalog__text">{{$count++}}</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">{{$movie->MovieName}}</a></div>
									</td>
									<td>
										<div class="catalog__text"><i class="bi bi-star"
												style="margin-right: 5px; color:#f9ab00"></i>{{$movie->MovieEvaluate}}</div>
									</td>
									<td>
										<div class="catalog__text">
											{{$movie->Types->pluck("TypeName")->first()}}
										</div>
									</td>
									<td>
										<div class="catalog__text">
											{{$movie->Countries->pluck("CountryName")->join(",")}}
										</div>
									</td>
									<td>
										<div class="catalog__text">{{$movie->MovieYear}}</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green">{{$movie->MovieStatus}}</div>
									</td>
									<td>
										<div class="catalog__btns">
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="bi bi-eye"></i>
											</a>
											<a href="{{route("Movies.edit", $movie->MovieID)}}"
												class="catalog__btn catalog__btn--edit">
												<i class="bi bi-pencil-square"></i>
											</a>
											<button type="button" data-bs-toggle="modal"
												class="catalog__btn catalog__btn--delete"
												data-bs-target="#{{$movie->MovieID}}">
												<i class="bi bi-trash"></i>
											</button>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- end items -->

			<!-- paginator -->
			<div class="col-12">
				<div class="main__paginator">
					<!-- amount -->
					<span class="main__paginator-pages">
						{{$movies->CurrentPage()}} of {{$movies->lastPage()}}
					</span>
					<!-- end amount -->

					<ul class="main__paginator-list">
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

					<ul class="paginator">
						@if($movies->onFirstPage())
							<li class="paginator__item paginator__item--prev disabled">
								<i class="bi bi-chevron-left"></i>
							</li>
						@else
							<li class="paginator__item paginator__item--prev">
								<a href="{{$movies->previousPageUrl()}}"><i class="bi bi-chevron-left"></i></a>
							</li>
						@endif

						@for($i = 1; $i <= $movies->lastPage(); $i++)
							@if($i == $movies->currentPage())
								<li class="paginator__item paginator__item--active"><a href="#">{{$i}}</a></li>
							@else
								<li class="paginator__item"><a href="{{$movies->url($i)}}">{{$i}}</a></li>
							@endif
						@endfor

						@if($movies->hasMorePages())
							<li class="paginator__item paginator__item--next">
								<a href="{{$movies->nextPageUrl()}}"><i class="bi bi-chevron-right"></i></a>
							</li>
						@else
							<li class="paginator__item paginator__item--next disabled">
								<i class="bi bi-chevron-right"></i>
							</li>
						@endif

					</ul>
				</div>
			</div>
			<!-- end paginator -->
		</div>
	</div>
</main>
<!-- end main content -->

<!-- delete modal -->
@foreach ($movies as $movie)
	<div class="modal fade" id="{{$movie->MovieID}}" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form class="modal__form" action="{{route("Movies.destroy", $movie->MovieID)}}" method="POST">
						@csrf
						@method("DELETE")
						<h4 class="modal__title">Xóa bộ phim này ?</h4>
						<p class="modal__text mx-auto">bạn có chắc chắn muốn xóa ?
						</p>
						<div class="modal__btns">
							<button class="modal__btn modal__btn--apply" type="submit"><span>xóa</span></button>
							<button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal"
								aria-label="Close"><span>quay lại</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endforeach
@endsection

@section("footeradmin")
@if(session("addMovie"))
	<script>
		iziToast.success({
			message: '{{session("addMovie")}}',
			position: "topRight"
		});
	</script>
@endif

@if(session("editMovie"))
	<script>
		iziToast.success({
			message: "{{session("editMovie")}}",
			position: "topRight"
		})
	</script>
@endif

@if(session("deleteMovie"))
	<script>
		iziToast.success({
			message: "{{session('deleteMovie')}}",
			position: "topRight"
		})
	</script>
@endif


@endsection


<!-- end delete modal -->