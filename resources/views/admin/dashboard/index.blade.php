@extends('layout.parentss')

@section('title','admin')

@section('main')
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="bi bi-speedometer2"></i>  
                    <span class="text">bảng điều khiển</span>
                </div>
                <div class = "boxes">
                    <div class="box box1">
                    <i class="bi bi-hand-thumbs-up"></i>
                        <span class = "text">Tổng lượt like</span>
                        <span class = "number">50.000</span>
                    </div>

                    <div class="box box2">
                    <i class="bi bi-chat-dots"></i>
                        <span class = "text">bình luận</span>
                        <span class = "number">22.142</span>
                    </div>

                    <div class="box box3">
                    <i class="bi bi-share"></i>
                        <span class = "text">chia sẽ</span>
                        <span class = "number">12.123</span>
                    </div>
                </div>

            <div class="activity">
                <div class="title">
                    <i class="bi bi-speedometer2"></i>
                    <span class="text">hoạt động gần đây</span>
                </div>
 
                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Tên</span>
                        <span class="data-list">moi moi</span>
                        <span class="data-list">moi moi</span>
                        <span class="data-list">moi moi</span>
                        <span class="data-list">moi moi</span>
                    </div>

                    <div class="data email">
                        <span class="data-title">Email</span>
                        <span class="data-list">momoi@gmail.com</span>
                        <span class="data-list">momoi@gmail.com</span>
                        <span class="data-list">momoi@gmail.com</span>
                        <span class="data-list">momoi@gmail.com</span>

                    </div>

                    <div class="data joined">
                        <span class="data-title">ngày tham gia</span>
                        <span class="data-list">10-2-2022</span>
                        <span class="data-list">10-2-2022</span>
                        <span class="data-list">10-2-2022</span>
                        <span class="data-list">10-2-2022</span>

                    </div>

                    <div class="data status">
                        <span class="data-title">trạng thái</span>
                        <span class="data-list">đã thích</span>
                        <span class="data-list">đã thích</span>
                        <span class="data-list">đã thích</span>
                        <span class="data-list">đã thích</span>

                    </div>

                </div>
            </div>
        </div>

    <!-- </section> -->
   
@endsection()