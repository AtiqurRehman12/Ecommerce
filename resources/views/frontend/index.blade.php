@extends('frontend.layouts.main')
@section('title')
    Home
@endsection
@section('icon')
https://w7.pngwing.com/pngs/992/534/png-transparent-white-2-storey-house-illustration-housing-house-home-icon-house-angle-building-houses-thumbnail.png
@endsection
@section('main-section')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            @forelse ($categories as $category)
                @php
                    $count = DB::table('products')
                        ->where('category_id', $category->id)
                        ->count();
                @endphp
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right">{{ $count }} Products</p>
                        <a href="{{ route('frontend.shop', $category->id) }}"
                            class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" style="max-height:200px; min-height:200px; min-width:100%"
                                src="{{ $category->image }}" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0">{{ $category->name }}</h5>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    {{-- <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                    <p>Subscribe to our newsletter to receive the latest updates and exclusive offers.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @forelse ($latestProducts as $latestProduct)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" style="min-height: 300px; max-height:300px;"
                                src="{{ $latestProduct->image }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $latestProduct->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>${{ $latestProduct->price }}</h6>
                                </h6>
                            </div>
                        </div>
                        @if ($latestProduct->quantity>0)
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('frontend.product', $latestProduct->id) }}"
                                class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <button data-id="{{ $latestProduct->id }}" class="btn btn-sm text-dark p-0 cart"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                        </div>
                            
                        @else
                            <div class="h4 text-center card-footer bg-light border text-danger"><span class="text-danger" >Out of stock !</span></div>
                        @endif
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
@endsection
@section('after-scripts')
    <script>
        $(document).ready(function() {
            $('.cart').click(function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('frontend.cart.ajax') }}",
                    type: 'GET',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        var count = response.count;
                        $('.cart-badge').empty().prepend(count);
                    }
                })
            })
        })
    </script>
@endsection
