@extends("layout.parentss")

@section('title', 'Actor Management')

@section('main')

<div class="movie-management">
    <div class="movies-table">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="data-title"> Tên diễn viên</th>
                    <th scope="col" class="data-title">tuổi</th>
                    <th scope="col" class="data-title">giới tính</th>
                    <th scope="col" class="data-title">ngày/tháng/năm sinh</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($actors as $actor )
                    <tr>                     
                        <td class="data-name">{{$actor->ActorName}}</td>
                        <td class="data-name"></td>
                        <td class="data-name"></td>
                        <td class="data-name">{{$actor->ActorDate}}</td>
                    </tr>
         
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

