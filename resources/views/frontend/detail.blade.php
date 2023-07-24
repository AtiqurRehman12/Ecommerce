@extends('frontend.layouts.secondary')
@section('title')
    {{ $product->name }}
@endsection
@section('icon')
    {{ $product->image }}
@endsection
@section('main-section')
    @php
        $imageUrls = $product->more_images;
        
        $imageArray = explode(',', $imageUrls);
        
    @endphp
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        @forelse ($imageArray as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"">
                                <img class="w-100 h-100" src="{{ $image }}" alt="Image">
                            </div>

                        @empty
                        @endforelse
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>

                <h3 class="font-weight-semi-bold mb-4">${{ $product->price }}.00</h3>
                <p class="mb-4">{{ $product->short_desc }}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" data-quantity="{{ $product->quantity }}" readonly class="count form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary cart px-3" data-id="{{ $product->id }}"><i
                            class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </div>
                <p class="text-warning message">No more Items in the stock</p>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>{!! $product->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after-scripts')
    <script>
        $(document).ready(function() {
            $('.message').hide();
            $('.cart').click(function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                var count = $('.count').val();
                console.log(productId);
                $.ajax({
                    url: "{{ route('frontend.detail.cart.ajax') }}",
                    type: 'GET',
                    data: {
                        productId: productId,
                        count: count
                    },
                    success: function(response) {
                        var count = response.count;
                        $('.cart-badge').empty().prepend(count);
                    }
                })
            })
            $('.btn-plus').click(function() {
                var count = $('.count').val();
                var quantity = $('.count').data('quantity')
                if(count >= quantity){
                    $(this).hide();
                    $('.message').show();
                }
            })
            $('.btn-minus').click(function() {
                var count = $('.count').val();
                var quantity = $('.count').data('quantity')
                if(count < quantity){
                    $('.btn-plus').show();
                    $('.message').hide()

                }
            })
        })
    </script>
@endsection
