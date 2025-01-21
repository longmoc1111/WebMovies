@extends("layout.parentss")

@section('title', 'movie Management')

@section('main')

<div class="movie-management">
    <div class="movies-table">

        @if(session('addmovie'))
            <div class="alert alert-success">
                {{session('addmovie')}}
            </div>
        @endif

        @if (session('delete'))
            <div class = "alert alert-success">
                {{session('delete')}}
            </div>
        @endif

        @if(session('editmovie'))
            <div class = "alert alert-success">
                {{session('editmovie')}}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="data-title"> Tên phim</th>
                    <th scope="col" class="data-title">loại phim</th>
                    <th scope="col" class="data-title">Năm phát hành</th>
                    <th scope="col" class="data-title">thể loại</th>
                    <th scope="col" class="data-title">quốc gia</th>
                    <th scope="col" class="data-title">đánh giá phim</th>
                    <th scope="col" class="data-title">trạng thái</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        
                        <td class="data-name"><a href="{{route("Movies.show",$movie->MovieID)}}">{{$movie->MovieName}}</a></td>
                        <td class="data-name">{{$movie->Genres->GenreName}}</td>
                        <td class="data-name">{{$movie->MovieYear}}</td>

                        @if($movie->Types->isnotempty())
                            <td class="data-name">
                                @foreach ($movie->Types as $type)
                                    {{$type->TypeName}}{{!$loop->last ? ', ' : ''}}
                                @endforeach
                            </td>
                        @else
                            <td class="data-name"></td>
                        @endif


                        @if($movie->Countries->isnotempty())
                            <td class="data-name">
                                @foreach ($movie->Countries as $country)
                                    {{$country->CountryName}}{{!$loop->last ? ', ' : ''}}
                                @endforeach
                            </td>
                        @else
                            <td class="data-name"></td>
                        @endif

                        <td class="data-name">{{$movie->MovieEvaluate}}</td>
                        <td class="data-name">{{$movie->MovieStatus}}</td>
                    </tr>
                @endforeach

            </tbody>


        </table>

    </div>
</div>



<!-- <div class = "movie-management">

    <div class = "movie-table">
        <div class = "table-header">
            <div class="data">
                <span class="data-title">Tên Phim</span>         
                <span class="data-title">Loại phim</span>
                <span class="data-title">thể loại</span>         
                <span class="data-title">Năm phát hành</span>
                <span class="data-title">trạng thái</span>
    
            </div>
        </div>

        @foreach ($movies as $movie)
      
            <div class="table-data">
                <div class="data">
                    <span class="data-name">{{$movie->MovieName}}</span>
                    @foreach ($movie->Types as $type)
                    <span class="data-name">{{$type->TypeName}}</span>
                    @endforeach

                    @foreach ($movie->countries as $Country)
                    <span class="data-name">{{$Country->CountryName}}</span>
                    @endforeach
                    <span class="data-name">{{$movie->MovieYear}}</span> 
                    <span class="data-name">vv</span>
                    <span class="data-name"></span> 
                </div>        
                   
            </div>
            @endforeach
     
        </div>
</div>

   -->
@endsection