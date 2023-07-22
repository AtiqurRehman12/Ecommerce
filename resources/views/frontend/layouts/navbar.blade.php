@php
    $categories = DB::table('category')->get();
    $slides = DB::table('slides')->get();
    $active = true;
@endphp
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    @forelse ($categories as $category)
                    <a href="{{route('frontend.shop', $category->id)}}" class="nav-item nav-link">{{$category->name}}</a>
                    @empty
                        
                    @endforelse
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('frontend.index')}}" class="nav-item nav-link active">Home</a>
                    </div>
                    @if (auth()->check())
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">Logout</button>
                        </form>
                    @else
                        
                    <div class="navbar-nav ml-auto py-0">
                        <a href="{{route('login')}}" class="nav-item nav-link">Login</a>
                        <a href="{{route('register')}}" class="nav-item nav-link">Register</a>
                    </div>
                    @endif
                </div>
            </nav>
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @forelse ($slides as $index => $slide)
                    <div class="carousel-item {{ $active ? 'active' : '' }}" style="height: 410px;">
                        <img class="img-fluid" style="max-height: 100%;" src="{{ $slide->name }}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="text-white font-weight-semi-bold mb-4">{{ $slide->slide_text }}</h1>
                                <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    
                    @php
                    $active = false; 
                    @endphp
                    
                    @empty
                    
                    @endforelse
                  
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>