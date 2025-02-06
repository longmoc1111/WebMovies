@extends('layout.parentss')

@section('title', 'update movie')

@section('main')
<div class="new-movie">


    <form action="{{route("Movies.update", $Movie)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            @if ($errors->any())
            <div class = "alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            
        
            @endif
        </div>
        <div class="form-create">
            <div class="left-form">
                <div>
                    <label class="form-label" for="">Tên phim</label>
                    <input required class="form-control  input" type="text" name="MovieName" id="name"
                        value="{{$Movie->MovieName}}">
                    {{-- @error('name')--}}
                    {{-- <div class='alert alert-warning'>The name only includes characters from a-z, A-Z</div>--}}
                    {{-- @enderror--}}
                </div>

                <div>
                    <label for="" class="form-label ">loại phim</label>
                    <select name="GenreID" id="" class="form-select input">
                        @foreach ($Genres as $Genre)
                            <option value="{{$Genre->GenreID}}" {{$Movie->GenreID == $Genre->GenreID ? 'selected' : ' '}}>
                                {{$Genre->GenreName}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>

                    @php
                        foreach ($Types as $Type)
                            $AllTypes[$Type->TypeID] = $Type->TypeName;

                        foreach ($Movie->Types as $Types)
                            $MovieTypes[$Types->TypeID] = $Types->TypeName;
                    @endphp
                    
                    @if (isset($MovieTypes))
                       <label for="" class="form-label ">Thể loại</label>
                        <select name="TypeID[]" id="Types" multiple>
                            @foreach ($AllTypes as $id => $name)
                                <option value="{{$id}}" {{array_key_exists($id, $MovieTypes) ? 'selected' : ''}}>
                                    {{$name}}
                                </option>
                            @endforeach
                        </select>

                    @else
                    <label for="" class="form-label ">Thể loại</label>
                        <select name="TypeID[]" id="Types" multiple>
                            @foreach ($AllTypes as $id => $name)
                                <option value="{{$id}}">
                                    {{$name}}
                                </option>
                            @endforeach
                        </select>
                    @endif
                     
                </div>

                <div>
                    <label for="" class="form-lable">Năm phát hành</label>
                    <select name="MovieYear" id="" class="form-select mb-3 input">
                        @for ($i = 1995; $i <= now()->year; $i++)
                            <option value="{{$i}}">
                                {{$i}}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    @php
                        foreach ($Directors as $Director)
                            $AllDirectors[$Director->DirectorID] = $Director->DirectorName;

                        foreach ($Movie->Directors as $Director)
                            $MovieDirectors[$Director->DirectorID] = $Director->DirectorName;
                    @endphp

                    @if (isset($MovieDirectors))
                        <label for="" class="form-label ">tên tác giả</label>
                        <select name="DirectorID[]" id="Directors" class="" multiple class="">
                            @foreach ($AllDirectors as $id => $name)
                                <option value="{{$id}}" {{array_key_exists($id, $MovieDirectors) ? 'selected' : ''}}>{{$name}}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <label for="" class="form-label ">tên tác giả</label>
                        <select name="DirectorID[]" id="Directors" class="" multiple class="">
                            @foreach ($AllDirectors as $id => $name)
                                <option value="{{$id}}">{{$name}}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <div>
                    @php
                        foreach ($Actors as $Actor)
                            $AllActors[$Actor->ActorID] = $Actor->ActorName;

                        foreach ($Movie->Actors as $Actor)
                            $MovieActors[$Actor->ActorID] = $Actor->ActorName;
                    @endphp

                    @if (isset($MovieActors))
                        <label for="" class="form-label ">diễn viên</label>
                        <select name="ActorID[]" id="Actors" multiple class="">
                            @foreach ($AllActors as $id => $name)
                                <option value="{{$id}}" {{array_key_exists($id, $MovieActors) ? 'selected' : ''}}>{{$name}}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <label for="" class="form-label ">diễn viên</label>
                        <select name="ActorID[]" id="Actors" multiple class="">
                            @foreach ($AllActors as $id => $name)
                                <option value="{{$id}}">{{$name}}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <div>
                    @php
                        foreach ($Countries as $Country)
                            $AllCountries[$Country->CountryID] = $Country->CountryName;

                        foreach ($Movie->Countries as $Country)
                            $MovieCountries[$Country->CountryID] = $Country->CountryName;
                    @endphp

                    @if (isset($MovieCountries))
                        <label for="" class="form-label ">quốc gia</label>
                        <select name="CountryID[]" id="Countries" multiple class="">
                            @foreach ($AllCountries as $id => $name)
                                <option value="{{$id}}" {{array_key_exists($id, $MovieCountries) ? 'selected' : ''}}>{{$name}}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <label for="" class="form-label ">quốc gia</label>
                        <select name="CountryID[]" id="Countries" multiple class="">
                            @foreach ($AllCountries as $id => $name)
                                <option value="{{$id}}">{{$name}}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>

            </div>

            <div class="right-form">
                <div>
                    <label for="" class="form-label ">Trạng thái</label>
                    <select name="MovieStatus" id="" class="form-select input">
                        <option value="full hd" {{$Movie->MovieStatus == 'full hd' ? 'selected' : ''}}>full hd</option>
                        <option value="bản cam" {{$Movie->MovieStatus == 'bản cam' ? 'selected' : ''}}>bản cam</option>
                        <option value="hoạt động" {{$Movie->MovieStatus == 'hoạt động' ? 'selected' : ''}}>hoạt động
                        </option>
                    </select>
                </div>
                <div>
                    <label for="" class="form-label ">Mô tả</label>
                    <textarea class="form-control input" name="MovieDescription"
                        id="">{{$Movie->MovieDescription}}</textarea>
                </div>

                <div>
                    <label class="form-label  ">đánh giá</label>
                    <input class="form-control input" type="number" step='0.1' min='0' max='10' name="MovieEvaluate"
                        value="{{$Movie->MovieEvaluate}}">
                </div>


                <div>
                    <label class="form-label  " for="">ảnh phim</label>
                    <input hidden type="text" name="MovieImage" id="" value = "{{$Movie->MovieImage}}">
                    <input class="form-control input" type="file" name="currentMovieImage" id="name">
                </div>
                <div>
                    <img class="image-movie" src="/images/{{$Movie->MovieImage}}" alt="">
                </div>

                <div>
                    <label class="form-label  " for="">link phim</label>
                    <input required class="form-control input" type="url" name='MovieLink' id="name"
                        value="{{$Movie->MovieLink}}">
                </div>




            </div>
        </div>

        <div class="btn-submit  mt-5">
            <a href="javascript:void(0);" onclick="window.history.back();" type="button"
                class="btn btn-primary btn-option">Quay
                lại</a>
            <button class="btn btn-success" type="submit">xác nhận</button>
        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('Types')
        new MultiSelectTag('Directors')
        new MultiSelectTag('Actors')
        new MultiSelectTag('Countries')
    </script>
</div>
@endsection