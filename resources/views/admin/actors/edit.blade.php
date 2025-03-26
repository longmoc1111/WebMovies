@extends("layout.admin")
@section("admin")
<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Sửa thông tin diễn viên</h2>
                </div>
            </div>
            <!-- end main title -->
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab" tabindex="0">
                    <div class="col-12 mx-auto">
                        <div class="row">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- details form -->
                            <div class="col-12">
                                <form action="{{route("admin.actor.update", $Actor)}}" method="POST"
                                    class="sign__form sign__form--profile" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sign__group">
                                                <label class="sign__label" for="username">Họ tên</label>
                                                <input id="username" type="text" name="ActorName" class="sign__input"
                                                    value="{{$Actor->ActorName}}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sign__group">
                                                <label class="sign__label" for="username">Quốc tịch</label>
                                                <select name="ActorNationality" class="sign__selectjs"
                                                    id="sign__country">
                                                    <option value="" selected></option>
                                                    @foreach($Countries as $country)
                                                        <option value="{{$country->CountryName}}"
                                                            {{$Actor->ActorDirectorNationality == $country->ConuntryName ? "selected" : ""}}>{{$country->CountryName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sign__group">
                                                <label class="sign__label" for="fname">ngày sinh</label>
                                                <input id="fname" type="date" name="ActorDate" class="sign__input"
                                                    value="{{$Actor->ActorDate}}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                                <div class="sign__group">
                                                    <label class="sign__label" for="fname">link ảnh đại diện</label>
                                                    <div class="collapse show multi-collapse">
                                                        <div class="sign__video position-relative">
                                                            <label id="movie1" for="sign__video-upload"
                                                                class="position-relative d-inline-flex align-items-center justify-content-between w-100"
                                                                style="height: 46px; padding-right: 30px;">
                                                                Ảnh nền phim
                                                                <i class="bi bi-image" style="font-size: 20px;"></i>
                                                            </label>
                                                            <input data-name="#movie1" id="sign__video-upload"
                                                                name="ActorAvatar" class="sign__video-upload" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input hidden type="text" value="{{ $Actor->ActorAvatar }}" name = "oldActorAvatar">

                                        <div class="col-12">
                                            <button class="sign__btn sign__btn--small"
                                                type="submit"><span>Save</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end details form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end content tabs -->
        </div>
    </div>
</main>
<!-- end main content -->
@endsection
@section("footeradmin")
@if($errors->any())
@foreach($errors->all() as $error)
        <script>
            iziToast.warning({
                message:"{{$error}}",
                position:"topRight"
            })
        </script>
    @endforeach
@endif
@endsection