@extends("layout.admin")
@section("admin")

<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>SỬA ĐỔI</h2>
                    </h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{route("Movies.update", $Movie)}}" method="POST" class="sign__form sign__form--add">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sign__group">
                                        <input name="MovieName" type="text" class="sign__input"
                                            value="{{$Movie->MovieName}}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <textarea name="MovieDescription" id="text" name="text" class="sign__textarea"
                                            placeholder="Mô tả">{{$Movie->MovieDescription}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="sign__group">
                                        <input name="MovieImage" type="url" class="sign__input"
                                            value="{{$Movie->MovieImage}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="sign__group">
                                        <input name="MovieYear" type="date" class="sign__input"
                                            value="{{ isset($Movie) ? \Carbon\Carbon::parse($Movie->MovieYear)->format('Y-m-d') : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $allstatus = ["Full HD", "Bản cam", "Trailer", "Sắp ra mắt", "Đã hoàn thành"];
                        @endphp
                        <div class="col-12 col-xl-5">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="sign__group">
                                        <select name="MovieStatus" class="sign__selectjs" id="sign__quality">
                                            @foreach ($allstatus as $status)    
                                                <option value="{{$status}}" {{ $status == $Movie->MovieStatus ? "selected" : "" }}>{{$status}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="sign__group">
                                        <input name="MovieEvaluate" class="sign__input" type="number" min="1.0"
                                            max="10.0" step="0.1" value="{{$Movie->MovieEvaluate}}">
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="sign__group">
                                        <select name="GenreID" class="sign__selectjs" id="sign__genre">
                                            @foreach($Genres as $genre)
                                                <option value="{{$genre->GenreID}}" {{$Movie->GenreID == $genre->GenreID ? "selected" : ""}}>{{$genre->GenreName}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                @php
                                    foreach ($Types as $type)
                                        $allTypes[$type->TypeID] = $type->TypeName;
                                    foreach($Movie->Types as $type)
                                        $MovieType[$type->TypeID] = $type->TypeName;
                                @endphp

                                @if(isset($MovieType))
                                <div class="col-12">
                                    <div class="sign__group">
                                        <select name="TypeID[]" class="sign__selectjs" id="sign__type" multiple>
                                            @foreach ($allTypes as $id => $name)
                                                <option value="{{$id}}" {{array_key_exists($id, $MovieType) ? "selected" : ""}}>{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @else
                                <div class="col-12">
                                    <div class="sign__group">
                                        <select name="TypeID[]" class="sign__selectjs" id="sign__type" multiple>
                                            @foreach ($allTypes as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                @php
                                    foreach ($Countries as $Country)
                                        $allCountries[$Country->CountryID] = $Country->CountryName;

                                    foreach ($Movie->Countries as $Country)
                                        $MovieCountries[$Country->CountryID] = $Country->CountryName;
                                @endphp

                                @if(isset($MovieCountries))
                                    <div class="col-12">
                                        <div class="sign__group">
                                            <select name="CountryID[]" class="sign__selectjs" id="sign__country" multiple>
                                                @foreach($allCountries as $id => $name)
                                                    <option value="{{$id}}" {{array_key_exists($id, $MovieCountries) ? "selected" : ""}}>{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                <div class="col-12">
                                        <div class="sign__group">
                                            <select name="CountryID[]" class="sign__selectjs" id="sign__country" multiple>
                                                @foreach($allCountries as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                


                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-xl-4">
                            @php
                                foreach ($Directors as $director)
                                    $allDirectors[$director->DirectorID] = $director->DirectorName;
                                foreach ($Movie->Directors as $director)
                                    $MovieDirector[$director->DirectorID] = $director->DirectorName;
                            @endphp
                            @if(isset($MovieDirector))
                                <div class="sign__group">
                                    <select name="DirectorID[]" class="sign__selectjs" id="sign__director" multiple>
                                        @foreach ($allDirectors as $id => $name)
                                            <option value="{{$id}}" {{array_key_exists($id, $MovieDirector) ? "selected" : ""}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                            <div class="sign__group">
                                    <select name="DirectorID[]" class="sign__selectjs" id="sign__director" multiple>
                                        @foreach ($allDirectors as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>

                        @php
                            foreach ($Actors as $actor)
                                $allActors[$actor->ActorID] = $actor->ActorName;

                            foreach ($Movie->Actors as $actor)
                                $MovieActor[$actor->ActorID] = $actor->ActorName;
                        @endphp
                        @if(isset($MovieActor))
                            <div class="col-12 col-md-6 col-xl-8">
                                <div class="sign__group">
                                    <select name="ActorID[]" class="sign__selectjs" id="sign__actors" multiple>
                                        @foreach($allActors as $id => $name)
                                            <option value="{{$id}}" {{array_key_exists($id, $MovieActor) ? "selected" : ""}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                        <div class="col-12 col-md-6 col-xl-8">
                                <div class="sign__group">
                                    <select name="ActorID[]" class="sign__selectjs" id="sign__actors" multiple>
                                        @foreach($allActors as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                


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
                                <input name="MovieLink" type="url" class="sign__input" value="{{$Movie->MovieLink}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="sign__btn sign__btn--small"><span>Sửa đổi</span></span></button>
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