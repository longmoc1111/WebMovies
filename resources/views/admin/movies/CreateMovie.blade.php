@extends("layout.admin")
@section("admin")

    <!-- main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>THÊM PHIM MỚI</h2>
                        </h2>
                    </div>
                </div>
                <!-- end main title -->

                <!-- form -->
                <div class="col-12">
                    <form action="{{route("admin.movies.store")}}" method="POST" class="sign__form sign__form--add"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-xl-7">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="sign__group">
                                            <input name="MovieName" type="text" class="sign__input" required
                                                placeholder="Tên phim">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="sign__group">
                                            <textarea name="MovieDescription" id="text" name="text" class="sign__textarea"
                                                placeholder="Mô tả"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="collapse show multi-collapse">
                                            <div class="sign__video position-relative">
                                                <label id="movie1" for="sign__video-upload"
                                                    class="position-relative d-inline-flex align-items-center justify-content-between w-100"
                                                    style="height: 46px; padding-right: 30px;">
                                                    Ảnh nền phim
                                                    <i class="bi bi-image" style="font-size: 20px;"></i>
                                                </label>
                                                <input data-name="#movie1" id="sign__video-upload" name="MovieImage"
                                                    class="sign__video-upload" type="file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="sign__group">
                                            <input name="MovieYear" type="date" class="sign__input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-5">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="sign__group">
                                            <select name="MovieStatus" class="sign__selectjs" id="sign__quality">
                                                <option value="Full HD">Full HD</option>
                                                <option value="Bản cam">Bản cam</option>
                                                <option value="Trailer">Trailer</option>
                                                <option value="Sắp ra mắt">Sắp ra mắt</option>
                                                <option value="Đã hoàn thành">Đã hoàn thành</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="sign__group">
                                            <input name="MovieEvaluate" class="sign__input" required type="number" min="1.0"
                                                max="10.0" step="0.1" placeholder="đánh giá">
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="sign__group">
                                            <select name="GenreID" class="sign__selectjs" id="sign__genre">
                                                @foreach($Genres as $genre)
                                                    <option value="{{$genre->GenreID}}">{{$genre->GenreName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @php
                                        foreach ($Types as $type)
                                            $allTypes[$type->TypeID] = $type->TypeName;
                                    @endphp


                                    <div class="col-12">
                                        <div class="sign__group">
                                            <select name="TypeID[]" class="sign__selectjs" id="sign__type" multiple>
                                                @foreach ($allTypes as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @php 
                                                                                                                                                foreach ($Countries as $country)
                                        $allCountries[$country->CountryID] = $country->CountryName;
                                    @endphp
                                    <div class="col-12">
                                        <div class="sign__group">
                                            <select name="CountryID[]" class="sign__selectjs" id="sign__country" multiple>
                                                @foreach($allCountries as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-xl-4">
                                @php
                                    foreach ($Directors as $director)
                                        $allDirectors[$director->DirectorID] = $director->DirectorName;
                                @endphp
                                <div class="sign__group">
                                    <select name="DirectorID[]" class="sign__selectjs" id="sign__director" multiple>
                                        @foreach ($allDirectors as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @php
                                foreach ($Actors as $actor)
                                    $allActors[$actor->ActorID] = $actor->ActorName
                            @endphp
                            <div class="col-12 col-md-6 col-xl-8">
                                <div class="sign__group">
                                    <select name="ActorID[]" class="sign__selectjs" id="sign__actors" multiple>
                                        @foreach($allActors as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="collapse show multi-collapse">
                                    <input name="MovieLink" type="url" class="sign__input" required placeholder="Link phim">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="sign__btn sign__btn--small"><span>thêm</span></span></button>
                        </div>
                </div>
                </form>
            </div>
            <!-- end form -->
        </div>
        </div>
    </main>
    <!-- end main content -->
@endsection


@section("footeradmin")
    @if($errors->any)
        @foreach($errors->all() as $error)
            <script>
                iziToast.warning({
                    message: "{{$error}}",
                    position: "topRight"
                })
            </script>
        @endforeach
    @endif
@endsection