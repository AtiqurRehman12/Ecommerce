@php
    $store = DB::table('store')->first();
@endphp
<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                {{-- <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a> --}}
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                @if (!is_null($store->facebook))
                    <a class="text-dark px-2" target="_blank" href="{{ $store->facebook }}">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                @endif
                @if (!is_null($store->twitter))
                    <a class="text-dark px-2" target="_blank" href="{{ $store->twitter }}">
                        <i class="fab fa-twitter"></i>
                    </a>
                @endif
                @if (!is_null($store->linkedin))
                    <a class="text-dark px-2" target="_blank" href="{{ $store->linkedin }}">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                @endif
                @if (!is_null($store->instagram))
                    <a class="text-dark px-2" target="_blank" href="{{ $store->instagram }}">
                        <i class="fab fa-instagram"></i>
                    </a>
                @endif
                @if (!is_null($store->youtube))
                    <a class="text-dark pl-2" target="_blank" href="{{ $store->youtube }}">
                        <i class="fab fa-youtube"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="{{route('frontend.search.products')}}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for products">
                    <button class="input-group-append btn btn-secondary">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">0</span>
            </a>
            <a href="{{ route('frontend.cart') }}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge cart-badge">
                    @php
                        if (auth()->check()) {
                            $user_id = auth()->user()->id;
                        
                            $user_cart = \DB::table('user_cart')
                                ->where('user_id', $user_id)
                                ->sum('quantity');
                            echo $user_cart;
                        } elseif (session('user.cart')) {
                            echo count(session('user.cart'));
                        } else {
                            echo 0;
                        }
                    @endphp
                </span>
            </a>
        </div>
    </div>
</div>
