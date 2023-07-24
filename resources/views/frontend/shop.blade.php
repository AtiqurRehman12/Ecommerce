@extends('frontend.layouts.main')
@section('title')
    {{ $categoryName }}
@endsection
@section('main-section')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <div class="col-12 p-0 pb-1">
                    <label for="" class="font-weight-bold text-dark">Filter By Any Property</label>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-0" placeholder="e.g Product Name" name=""
                                id="property-search">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent text-primary">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <div class="lato font-20 mb-2">Filter by price</div>
                    <div>
                        <input type="radio" name="price" id="all-prices">
                        <label for="all-prices">All</label>
                    </div>
                    <div>
                        <input type="radio" name="price" id="low-price">
                        <label for="low-price" class="lato">Less than $100</label>
                    </div>
                    <div>
                        <input type="radio" name="price" id="mid-price">
                        <label for="mid-price" class="lato">$100 to $250</label>
                    </div>
                    <div>
                        <input type="radio" name="price" id="high-price">
                        <label for="high-price" class="lato">More than $250</label>
                    </div>
                </div>


            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3" id="product-container">

                    @forelse ($products as $product)
                        <div class="col-lg-4 col-sm-6 pb-1 main-box" data-price="{{ $product->price }}">
                            <div class="card product-item border-0 mb-4"">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" style="max-height: 250px; min-height:250px;"
                                        src="{{ $product->image }}" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>${{ $product->price }}.00</h6>
                                    </div>
                                </div>
                                @if ($product->quantity >0)
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{ route('frontend.product', $product->id) }}"
                                        class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                        Detail</a>
                                    <a href="" class="btn btn-sm text-dark p-0 cart" data-id="{{ $product->id }}"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                </div>
                                    
                                @else
                                    <div class="card-footer text-danger text-center bg-light border">
                                        <span class="text-danger" >Out of stock !</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="row justify-content-center pagination-wrapper mt-2">
                    {!! $products->links('pagination::bootstrap-4') !!}
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection
@section('after-scripts')
    <script>
        $(document).ready(function() {
            var productContainer = $('#product-container');
            var allProducts = $('.main-box');
            $("#all-prices").click(function() {
                productContainer.empty();
                productContainer.append(allProducts);
            })
            $("#low-price").click(function() {
                productContainer.empty().append(allProducts);
                var products = $(".main-box").filter(function() {
                    return $(this).data("price") < 100;
                });
                productContainer.empty().append(products);
            })
            $("#mid-price").click(function() {
                productContainer.empty().append(allProducts);
                var products = $(".main-box").filter(function() {
                    return $(this).data("price") > 100 && $(this).data("price") < 250;
                })
                productContainer.empty().append(products);

            })
            $("#high-price").click(function() {
                productContainer.empty().append(allProducts);
                var products = $(".main-box").filter(function() {
                    return $(this).data("price") > 250;
                })
                productContainer.empty().append(products);
            })
            $("#property-search").keyup(function() {
                var value = $(this).val().toLowerCase();
                $(".main-box").each(function() {
                    $(this).filter(function() {
                        $(this).toggle($(this).first().text().toLowerCase().indexOf(value) >
                            -1)
                    });
                })
            })
        })
    </script>
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
