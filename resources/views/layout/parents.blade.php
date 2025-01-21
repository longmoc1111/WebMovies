<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel = "stylesheet" href = "/css/parents.css">
    <title>@Yield('title')</title>
</head>
<body>
    <div class="container d-flex">
    <div>
        <nav class="sidebar close open">
            <header>
                <div class="image-text">
                    <span class="image">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ60p7T44uwQN0ZlnMrXtMEDoLMhbd4EVBjZg&s" alt="">          
                    </span>
                    
                    <div class="text header-text">
                        <span class="name">oidoioi</span>
                    </div>
                <i class="bi bi-list toggle"></i> 
            </header>

            <div class="menu-bar">
                <div class="menu ">
                    <ul class="menu-links">
                        <li class="nav-link">
                            <a href="#">
                                <i  class="bi bi-house icon toggle-item"></i>
                                <span class="text nav-text">bảng điều khiển</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="{{route("Movies.create")}}">
                                <i  class="bi bi-house icon toggle-item"></i>
                                <span class="text nav-text">bảng điều khiển</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="#">
                                <i  class="bi bi-house icon toggle-item"></i>
                                <span class="text nav-text">bảng điều khiển</span>
                            </a>
                        </li>  

                        <li class="nav-link">
                            <a href="#">
                                <i  class="bi bi-box-arrow-left icon toggle-item"></i>
                                <span class="text nav-text">đăng xuất</span>
                            </a>
                        </li>  
                    </ul>  
                </div>
            </div>
        </nav>  
    </div>

        <div class = "main">
                @yield('main')
        </div>
    </div>
  

    <script src="/js/parents.js"></script>

</body>
</html>