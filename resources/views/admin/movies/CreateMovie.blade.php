@extends('layout.parentss')

@section('title', 'Create new Movie')

@section('main')

<div class="new-movie">
    <form class="my-3" action="{{route('Movies.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form-create">
            <div class="left-form">
                <div>
                    <label class="form-label" for="">Tên phim</label>
                    <input required class="form-control mb-3 input" type="text" name="MovieName" id="name">
                    {{-- @error('name')--}}
                    {{-- <div class='alert alert-warning'>The name only includes characters from a-z, A-Z</div>--}}
                    {{-- @enderror--}}
                </div>

                <div>


                    <label for="" class="form-label">Loại phim</label>
                    <select name="GenreID" id="" class="form-select mb-3  input">
                        @foreach ($Genres as $Genre)
                            <option value="{{$Genre->GenreID}}">{{$Genre->GenreName}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    @php
                        foreach ($Types as $Type)
                            $AllTypes[$Type->TypeID] = $Type->TypeName;

                    @endphp
                    <label for="" class="form-label">Thể loại</label>
                    <select name="TypeID[]" id="Types" class="form-select mb-3 input" multiple="multiple">
                        @foreach ($AllTypes as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
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
                    @endphp

                    <label for="" class="form-label">tác giả</label>
                    <select name="DirectorID[]" id="Directors" class="form-select input mb-3" multiple="multiple">
                        @foreach ($AllDirectors as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    @php
                        foreach ($Actors as $Actor)
                            $AllActors[$Actor->ActorID] = $Actor->ActorName;
                    @endphp

                    <label for="" class="form-label">diễn viên</label>
                    <select name="ActorID[]" id="Actors" class="form-select input mb-3" multiple="multiple">
                        @foreach ($AllActors as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    @php
                        foreach ($Countries as $Country)
                            $AllCountries[$Country->CountryID] = $Country->CountryName;
                    @endphp

                    <label for="" class="form-label">Quốc gia</label>
                    <select name="ActorID[]" id="Countries" class="form-select input mb-3" multiple="multiple">
                        @foreach ($AllCountries as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="" class="form-label">Quốc gia</label>
                    <select name="CountryID[]" id="" class="form-select input mb-3" multiple="multiple">
                        @foreach ($Countries as $Country)
                            <option value="{{$Country->CountryID}}">
                                {{$Country->CountryName}}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>


            <div class="right-form">


                <div>
                    <label for="" class="form-label">trạng thái</label>
                    <select name="MovieStatus" id="" class="form-select mb-3  input">
                        <option value="full hd">full hd</option>
                        <option value="bản cam">bản cam</option>
                        <option value="đã hoàn thành">đã hoàn thành</option>
                    </select>
                </div>

                <div>
                    <label class="form-label" for="">Mô tả</label>
                    <textarea class="form-control mb-3  input" name="MovieDescription" id=""></textarea>
                </div>
                <div>
                    <label class="form-label">đánh giá</label>
                    <input class="form-control mb-3  input" type="number" step='0.1' min='0' max='10'
                        name="MovieEvaluate">
                </div>

                <div>
                    <label class="form-label" for="">ảnh phim</label>
                    <input required class="form-control mb-3 input" type="file" name="MovieImage" id="name">
                </div>

                <div>
                    <label class="form-label" for="">link phim</label>
                    <input required class="form-control mb-3 input" type="url" name='MovieLink' id="name">
                </div>

            </div>
        </div>

        <div class="backOrCreate btn-submit mt-3">
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