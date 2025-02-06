<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel = "stylesheet" href = "/css1/parentss.css">
    <link rel = "stylesheet" href = "/css1/MovieManagement.css">
    <link rel = "stylesheet" href = "/css1/createmovie.css">
    <link rel = "stylesheet" href = "/css1/showmovie.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">



    <title>@Yield('title')</title>
</head>
<body>
    <nav>
        <div class = "logo-name">
            <div class="logo-image">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ60p7T44uwQN0ZlnMrXtMEDoLMhbd4EVBjZg&s" alt="">
            </div>

            <span class="logo_name">moimoi</span>
        </div>

        <div class="menu-items">
            <div class="nav-links">
                <div class = "nav-link">
                        <li> <a href="{{route('Dashboard.index')}}">
                            <i class = "bi bi-house"></i>
                            <span class = "link-name">trang chủ</span>
                            </a></li>
                </div>
                
                <div class = "nav-link">
                    <li> <a href="#" onclick = "return false">
                    <i class="bi bi-film"></i>
                    <span class = "link-name">phim</span>
                    </a></li>
                    <i class="bi bi-chevron-down menu-down"></i>
                </div>
                <div class="menu-bars">
                <ul >
                    <li class="create-movie">
                            <a href="{{route('Movies.index')}}">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <span class = "link-name">danh sách phim</span>
                            </a></li>
                        <li class="create-movie">
                            <a href="{{route('Movies.create')}}">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <span class = "link-name">tạo phim</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class = "nav-link">
                    <li> <a href="#" onclick = "return false">
                    <i class="bi bi-tropical-storm"></i>
                    <span class = "link-name">diễn viên</span>
                    </a></li>
                    <i class="bi bi-chevron-down menu-down2"></i>
                </div>
                <div class="menu-bars2" >
                <ul>
                    <li class="create-movie">
                            <a href="{{route("Actor.index")}}">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <span class = "link-name">thông tin diễn viên</span>
                            </a></li>
                        <li class="create-movie">
                            <a href="">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <span class = "link-name">thêm diễn viên</span>
                            </a>
                        </li>
                    </ul>
                </div>
                   

   
                    <li> <a href="">
                    <i class="bi bi-tree-fill"></i>
                    <span class = "link-name">đạo diễn</span>
                    </a></li>

                    <li> <a href="">
                    <i class="bi bi-people-fill"></i>
                    <span class = "link-name">người dùng</span>
                    </a></li>     
            </div>

            <div class = "logout-mode">

            <li> <a href="">
                    <i class = "bi bi-box-arrow-left"></i>
                    <span class = "link-name">đăng xuất</span>
                    </a></li>

            <li class = "mode"> 
                        <a href="">
                            <i class = "bi bi-moon-fill moon"></i>
                         <span class = "link-name">chế đội tối</span>
                    </a>
                        <div class="mode-toggle">
                            <span class="switch"></span>
                        </div>
                    </li> 
            </div>
        </div>
       
    </nav>       
   <section class = "dashboard">
        <div class = "top">
             <i class="bi bi-list siderbar-toggle"></i>

             <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="search" placeholder="tìm kiếm">
             </div>

                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ60p7T44uwQN0ZlnMrXtMEDoLMhbd4EVBjZg&s" alt="">
        </div>
        @yield("main")
    </section> 
    <script src="/js1/parentss.js"></script>

</body>
</html>