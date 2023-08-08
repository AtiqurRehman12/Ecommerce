@extends('frontend.layouts.secondary')
@section('title')
    Products
@endsection
@section('main-section')
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Your Searched Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @forelse ($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" style="min-height: 300px; max-height:300px;"
                            src="{{ $product->image }}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>${{ $product->price }}</h6>
                            </h6>
                        </div>
                    </div>
                    @if ($product->quantity > 0)
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{ route('frontend.product', $product->id) }}"
                            class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <button data-id="{{ $product->id }}"
                            class="btn btn-sm text-dark p-0 cart"><i
                                class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                    </div>
                        
                    @else
                       <div class="card-footer bg-light border text-danger text-center">
                        <span class="text-danger" >Out of stock !</span>
                        </div> 
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