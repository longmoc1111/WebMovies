@extends("layout.admin")
@section("admin")
<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm mới đạo diễn</h2>
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
                                <form action="{{route("admin.director.store")}}" method="POST"
                                    class="sign__form sign__form--profile">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sign__group">
                                                <label class="sign__label" for="username">Họ tên</label>
                                                <input id="username" type="text" name="DirectorName" class="sign__input">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                        <div class="sign__group">
                                        <label class="sign__label" for="username">Quốc tịch</label>
                                            <select name = "DirectorNationality" class="sign__selectjs" id="sign__country">
                                                <option value="" selected></option> 
                                                @foreach($Countries as $country)
                                                    <option value="{{$country->CountryName}}">{{$country->CountryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sign__group">
                                                <label class="sign__label" for="fname">ngày sinh</label>
                                                <input id="fname" type="date" name="DirectorDate" class="sign__input">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sign__group">
                                                <label class="sign__label" for="fname">link ảnh đại diện</label>
                                                <input name="DirectorAvatar" id="fname" type="url" class="sign__input">
                                            </div>
                                        </div>

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