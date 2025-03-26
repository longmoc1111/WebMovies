@extends("layout.admin")
@section("admin")
    <!-- main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>diễn viên</h2>

                        <div class="main__title-wrap">
                            <a href="{{route("admin.actor.create")}}" type="button"
                                class="main__title-link main__title-link--wrap ">Thêm mới</a>
                            <form action="{{route("admin.actor.sort")}}" class="filter__select">
                                <select name="sort" class="filter__select" name="sort" id="filter__sort"
                                    onchange="this.form.submit()">
                                    <option value="Tên" {{request("sort") == "Tên" ? "selected" : "" }}>Tên tác giả</option>
                                    <option value="Ngày sinh" {{request("sort") == "Ngày sinh" ? "selected" : "" }}>Ngày sinh
                                    </option>
                                    <option value="Quốc tịch" {{request("sort") == "Quốc tịch" ? "selected" : ""}}>Quốc tịch
                                    </option>
                                </select>
                            </form>


                            <!-- search -->
                            <form action="{{route("admin.actor.search")}}" class="main__title-form">
                                <input name="search" type="text" placeholder="Tìm kiếm....">
                                <button type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                            <!-- end search -->
                        </div>
                    </div>
                </div>
                <!-- end main title -->

                <!-- users -->
                <div class="col-12">
                    <div class="catalog catalog--1">
                        <table class="catalog__table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>HỌ VÀ TÊN</th>
                                    <th>ẢNH ĐẠI DIỆN</th>
                                    <th>QUỐC TỊCH</th>
                                    <th>NGÀY SINH</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach($Actors as $actor)
                                    <tr>
                                        <td>
                                            <div class="catalog__text">{{$count++}}</div>
                                        </td>
                                        <td>
                                            <div class="catalog__text">{{$actor->ActorName}}</div>
                                        </td>
                                        <td>
                                            <div class="catalog__user">
                                                <div class="catalog__avatar">
                                                    <img src="/assets/actorAvatar/{{$actor->ActorAvatar}}" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="catalog__text">{{$actor->ActorNationality}}</div>
                                        </td>

                                        <td>
                                            <div class="catalog__text">{{$actor->ActorDate}}</div>
                                        </td>
                                        <td>
                                            <div class="catalog__btns">
                                                <a href="{{route("admin.actor.edit", $actor->ActorID)}}"
                                                    class="catalog__btn catalog__btn--edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button type="button" data-bs-toggle="modal"
                                                    class="catalog__btn catalog__btn--delete addCart"
                                                    data-bs-target="#{{$actor->ActorID}}">
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
                <!-- end users -->

                <!-- paginator -->
                <div class="col-12">
                    <div class="main__paginator">
                        <!-- amount -->
                        <span class="main__paginator-pages">{{$Actors->currentPage()}} of {{$Actors->lastPage()}}</span>
                        <!-- end amount -->

                        <ul class="main__paginator-list">
                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-left"></i>
                                    <span>Prev</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>Next</span>
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        </ul>

                        <ul class="paginator">
                            @if($Actors->onFirstPage())
                                <li class="paginator__item paginator__item--prev">
                                    <a href="#"><i class="bi bi-chevron-left"></i></a>
                                </li>
                            @else
                                <li class="paginator__item paginator__item--prev">
                                    <a href="{{$Actors->previousPageUrl()}}"><i class="bi bi-chevron-left"></i></a>
                                </li>
                            @endif
                            @for($i = 1; $i <= $Actors->lastPage(); $i++)
                                                        @if($i == $Actors->currentPage())
                                                            <li class="paginator__item paginator__item--active"><a href="#">{{$i}}</a></li>
                                                        @else
                                                                                    <li class="paginator__item"><a href="{{$Actors->url($i)}}">{{$i}}</a></
                                                             li>
                                                        @endif
                            @endfor

                                @if($Actors->hasMorePages())
                                    <li class="paginator__item paginator__item--next">
                                        <a href="{{$Actors->nextPageUrl()}}"><i class="bi bi-chevron-right"></i></a>
                                    </li>
                                @else
                                    <li class="paginator__item paginator__item--next">
                                        <a href="#"><i class="bi bi-chevron-right"></i></a>
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
    @foreach($Actors as $actor)
        <div class="modal fade" id="{{$actor->ActorID}}" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal__content">
                        <form action="{{route("admin.actor.destroy", $actor->ActorID)}}" method="POST" class="modal__form">
                            @csrf
                            @method("DELETE")
                            <h4 class="modal__title">xóa diễn viên</h4>

                            <p class="modal__text mx-auto">bạn có chắc muốn xóa ?</p>

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
    <!-- end delete modal -->
@endsection

@section("footeradmin")
    @if (session("addActor"))
        <script>
            iziToast.success({
                message: "{{session("addActor")}}",
                position: "topRight"
            });
        </script>
    @endif

    @if(session("editActor"))
        <script>
            iziToast.success({
                message: "{{session("editActor")}}",
                position: "topRight"
            });
        </script>
    @endif

    @if (session("deleteActor"))
        <script>
            iziToast.success({
                message: "{{session("deleteActor")}}",
                position: "topRight"
            });
        </script>
    @endif

@endsection