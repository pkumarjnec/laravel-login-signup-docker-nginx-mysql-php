<header class="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg  navbar-light">
            <div class="row no-gutters navbar-container">
                <!-- Menu item -->
                <div class="navbar-body">
                    <div class="navbar-body_container">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                @guest
                                <li class="nav-item">
                                    <a href="{{route('login')}}" class="btn btn-linebutton">Login</a>
                                </li>
                                @endguest
                            </ul>
                        </div>
                        <div class="d-flex align-items-center main-action">
                            @auth
                                <a class="btn btn-filedbutton ml-5" href="{{route('dashboard')}}">Dashboard</a>
                            @endauth
                            @guest
                                <a href="{{route('register')}}" class="btn btn-filedbutton">Register Me</a>
                            @endguest
                        </div>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </div>
</header>