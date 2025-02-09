@extends("layout.admin")
@section("admin")
<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Users</h2>

                    <span class="main__title-stat">3,702 Total</span>

                    <div class="main__title-wrap">
                        <a href="{{route("admin.actor.create")}}" type="button"
                            class="main__title-link main__title-link--wrap">Thêm mới</a>

                        <select class="filter__select" name="sort" id="filter__sort">
                            <option value="0">Date created</option>
                            <option value="1">Pricing plan</option>
                            <option value="2">Status</option>
                        </select>

                        <!-- search -->
                        <form action="#" class="main__title-form">
                            <input type="text" placeholder="Find user..">
                            <button type="button">
                                <i class="ti ti-search"></i>
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
                            @foreach($Directors as $director)
                                <tr>
                                    <td>
                                        <div class="catalog__text">{{$count++}}</div>
                                    </td>
                                    <td>
                                        <div class="catalog__text">{{$director->DirectorName}}</div>
                                    </td>
                                    <td>
                                        <div class="catalog__user">
                                            <div class="catalog__avatar">
                                                <img src="{{$director->DirectorAvatar}}" alt="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="catalog__text">{{$director->DirectorNationality}}</div>
                                    </td>
                                    
                                    <td>
                                        <div class="catalog__text">{{$director->DirectorDate}}</div>
                                    </td>
                                    <td>
                                        <div class="catalog__btns">
                                            <button type="button" data-bs-toggle="modal"
                                                class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
                                                <i class="bi bi-lock"></i>
                                            </button>
                                            <a href=""
                                                class="catalog__btn catalog__btn--edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button type="button" data-bs-toggle="modal"
                                                class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
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
                    <span class="main__paginator-pages">{{$Directors->currentPage()}} of {{$Directors->lastPage()}}</span>
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
                        @if($Directors->onFirstPage())
                            <li class="paginator__item paginator__item--prev">
                                <a href="#"><i class="bi bi-chevron-left"></i></a>
                            </li>
                        @else
                            <li class="paginator__item paginator__item--prev">
                                <a href="{{$Directors->previousPageUrl()}}"><i class="bi bi-chevron-left"></i></a>
                            </li>
                        @endif
                        @for($i = 1; $i <= $Directors->lastPage(); $i++)
                                                    @if($i == $Directors->currentPage())
                                                        <li class="paginator__item paginator__item--active"><a href="#">{{$i}}</a></li>
                                                    @else
                                                                                <li class="paginator__item"><a href="{{$Directors->url($i)}}">{{$i}}</a></
                                                         li>
                                                    @endif
                        @endfor

                            @if($Directors->hasMorePages())
                                <li class="paginator__item paginator__item--next">
                                    <a href="{{$Directors->nextPageUrl()}}"><i class="bi bi-chevron-right"></i></a>
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

<!-- user modal -->
<div class="modal fade" id="modal-user" tabindex="-1" aria-labelledby="modal-user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal__content">
                <form action="#" class="modal__form">
                    <h4 class="modal__title">Thêm mới</h4>

                    <div class="row">
                        <div class="col-12">
                            <div class="sign__group">
                                <label class="sign__label" for="email0">Email</label>
                                <input id="email0" type="text" name="email0" class="sign__input">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="sign__group">
                                <label class="sign__label" for="pass0">Password</label>
                                <input id="pass0" type="password" name="pass0" class="sign__input">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="sign__group">
                                <label class="sign__label" for="subscription">Subscription</label>
                                <select class="sign__select" id="subscription">
                                    <option value="Basic">Basic</option>
                                    <option value="Premium">Premium</option>
                                    <option value="Cinematic">Cinematic</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="sign__group">
                                <label class="sign__label" for="rights">Rights</label>
                                <select class="sign__select" id="rights">
                                    <option value="User">User</option>
                                    <option value="Moderator">Moderator</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 offset-lg-3">
                            <button type="button" class="sign__btn sign__btn--modal">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end user modal -->

<!-- status modal -->
<div class="modal fade" id="modal-status" tabindex="-1" aria-labelledby="modal-status" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal__content">
                <form action="#" class="modal__form">
                    <h4 class="modal__title">Status change</h4>

                    <p class="modal__text">Are you sure about immediately change status?</p>

                    <div class="modal__btns">
                        <button class="modal__btn modal__btn--apply" type="button"><span>Apply</span></button>
                        <button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal"
                            aria-label="Close"><span>Dismiss</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end status modal -->

<!-- delete modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal__content">
                <form action="#" class="modal__form">
                    <h4 class="modal__title">User delete</h4>

                    <p class="modal__text">Are you sure to permanently delete this user?</p>

                    <div class="modal__btns">
                        <button class="modal__btn modal__btn--apply" type="button"><span>Delete</span></button>
                        <button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal"
                            aria-label="Close"><span>Dismiss</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end delete modal -->

@endsection