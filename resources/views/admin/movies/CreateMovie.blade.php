@extends("layout.admin")
@section("admin")

    <!-- main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>THÊM PHIM MỚI</h2></h2>
                    </div>
                </div>
                <!-- end main title -->

                <!-- form -->
                <div class="col-12">
                    <form action="{{route("Movies.store")}}" method="POST" class="sign__form sign__form--add">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-xl-7">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="sign__group">
                                            <input name="MovieName" type="text" class="sign__input"
                                                placeholder="Tên phim">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="sign__group">
                                            <textarea name="MovieDescription" id="text" name="text"
                                                class="sign__textarea" placeholder="Mô tả"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="sign__group">
                                            <input name = "MovieImage" type="url" class="sign__input" placeholder="Link ảnh nền">
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
                                            <input name="MovieEvaluate" class="sign__input" type="number" min = "1.0" max = "10.0" step = "0.1">
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
                                            <select name = "CountryID[]" class="sign__selectjs" id="sign__country" multiple>
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
                                    <select name = "DirectorID[]" class="sign__selectjs" id="sign__director" multiple>
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
                                    <select name = "ActorID[]" class="sign__selectjs" id="sign__actors" multiple>
                                        @foreach($allActors as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- <div class="col-12">
                                <div class="sign__group">
                                    <label class="sign__label">Item type:</label>
                                    <ul class="sign__radio">
                                        <li>
                                            <input id="type1" type="radio" name="type" data-bs-toggle="collapse"
                                                data-bs-target=".multi-collapse" checked="">
                                            <label for="type1">Movie</label>
                                        </li>
                                        <li>
                                            <input id="type2" type="radio" name="type" data-bs-toggle="collapse"
                                                data-bs-target=".multi-collapse">
                                            <label for="type2">TV Series</label>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <div class="collapse show multi-collapse">
                                        <input name = "MovieLink" type="url" class="sign__input" placeholder="Link phim">
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