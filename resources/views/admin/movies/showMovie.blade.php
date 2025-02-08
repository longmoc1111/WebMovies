@extends('layout.parentss')
@section('title', 'show movie')

@section("main")

<div class="new-movie">
    <div class="form-create">
        <div class="left-form">
            <div>
                <label class="form-label" for="">Tên phim</label>
                <input required class="form-control mb-3 input" type="text" name="MovieName" id="name"
                    placeholder="{{$movie->MovieName}}" readonly>
            </div>

            <div>
                <label class="form-label" for="">loại phim</label>
                <input required class="form-control mb-3 input" type="text" name="MovieName" id="name"
                    placeholder=" {{$movie->Genres->GenreName}}" readonly>
            </div>

            <div>
                @php
                    foreach ($movie->Types as $Types)
                        $MovieTyes[$Types->TypeID] = $Types->TypeName;
                @endphp

                @if (isset($MovieTyes))
                    <label for="" class="form-label">Thể loại</label>
                    <select id="Types" class="form-select mb-3 input" multiple="multiple" disabled>
                        @foreach ($MovieTyes as $id => $name)
                            <option value="{{$id}}" selected>{{$name}}</option>
                        @endforeach
                    </select>
                @else
                    <label for="" class="form-label">Thể loại</label>
                    <select id="Types" class="form-select mb-3 input" multiple="multiple" disabled>
                        <option value=""></option>
                    </select>
                @endif
            </div>


            <div>
                <label class="form-label" for="">năm phát hành</label>
                <input required class="form-control mb-3 input" type="text" name="MovieName" id="name"
                    placeholder=" {{$movie->MovieYear}}" readonly>
            </div>

            <div>
                @php
                    foreach ($movie->Directors as $Directors)
                        $MovieDirectors[$Directors->DirectorID] = $Directors->DirectorName
                @endphp

                @if (isset($MovieDirectors))
                    <label for="" class="form-label">Thể loại</label>
                    <select id="Directors" class="form-select mb-3 input" multiple="multiple" disabled>
                        @foreach ($MovieDirectors as $id => $name)
                            <option value="{{$id}}" selected>{{$name}}</option>
                        @endforeach
                    </select>

                @else
                    <label for="" class="form-label">Thể loại</label>
                    <select id="Directors" class="form-select mb-3 input" multiple="multiple" disabled>
                        <option value=""></option>
                    </select>
                @endif

            </div>
            <div>
                @php
                    foreach ($movie->Actors as $Actors)
                        $MovieActors[$Actors->ActorID] = $Actors->ActorName;
                @endphp
                @if (isset($MovieActors))
                    <label for="" class="form-label">Diễn viên</label>
                    <select id="Actors" class="form-select mb-3 input" multiple="multiple" disabled>
                        @foreach ($MovieActors as $id => $name)
                            <option value="{{$id}}" selected>{{$name}}</option>
                        @endforeach
                    </select>

                @else
                    <label for="" class="form-label">Diễn viên</label>
                    <select id="Actors" class="form-select mb-3 input" multiple="multiple" disabled>
                        <option value=""></option>
                    </select>
                @endif

            </div>


            <div>
                @php
                    foreach ($movie->Countries as $Countries)
                        $MovieCountries[$Countries->CountryID] = $Countries->CountryName;
                @endphp

                @if (isset($MovieCountries))
                    <label for="" class="form-label">Quốc gia</label>
                    <select id="Countries" class="form-select mb-3 input" multiple="multiple" disabled>
                        @foreach ($MovieCountries as $id => $name)
                            <option value="{{$id}}" selected>{{$name}}</option>
                        @endforeach
                    </select>

                @else
                    <label for="" class="form-label">Quốc gia</label>
                    <select id="Countries" class="form-select mb-3 input" multiple="multiple" disabled>
                        <option value=""></option>
                    </select>
                @endif


            </div>

        </div>
        <div class="right-form">
            <div>
                <label class="form-label" for="">Trạng thái</label>
                <input required class="form-control mb-3 input" type="text" name="" id="name"
                    placeholder=" {{$movie->MovieStatus}}" readonly>
            </div>


            <div>
                <label class="form-label" for="">Mô tả</label>
                <textarea class="form-control mb-3  input" name="" readonly
                    id="">{{$movie->MovieDescription}}</textarea>
            </div>

            <div>
                <label class="form-label" for="">Đánh giá</label>
                <input type="number" class="form-control input mb-3" step="0.1" min="0" max="10"
                    value={{$movie->MovieEvaluate}}>
            </div>

            <div>
                <div>
                    <label class="form-label" for="">ảnh phim</label>
                </div>
                <div>
                    <iframe width="100%" height="315"
                        src="https://www.youtube.com/embed/5KvMLgeh3jA?si=c4K2PtP9azc8hHDb" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>

            </div>


        </div>
    </div>

    <div class="delete-update mt-5">

        <a href="javascript:void(0);" onclick="window.history.back();" type="button"
            class="btn btn-primary btn-option">Quay
            lại</a>


        <button type="button" class="btn btn-danger btn-option" data-bs-toggle="modal"
            data-bs-target="#{{$movie->MovieID}}">
            xóa
        </button>

        <a href="{{route("Movies.edit", $movie->MovieID)}}" type="button" class="btn btn-info  btn-option">sửa đổi</a>
        <!-- Modal -->
    </div>

    <div class="modal fade" id="{{$movie->MovieID}}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">xóa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    bạn có muốn xóa bộ phim này!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">thoát</button>
                    <form action="{{route('Movies.destroy', $movie->MovieID)}}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-primary">đồng ý</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('Types')
        new MultiSelectTag('Directors')
        new MultiSelectTag('Actors')
        new MultiSelectTag('Countries')
    </script>

</div>

@endsection