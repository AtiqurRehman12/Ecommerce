@extends('frontend.layouts.secondary')
@section('icon')
    {{asset('img/cart.webp')}}
@endsection
@section('title')
    Cart
@endsection
@section('main-section')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($products as $product)
                            @php
                            if(auth()->check()){
                                $count = $product->quantity;
                            }else{
                                $count = $productIdCounts[$product->id] ?? 0;
                            }
                            @endphp
                            <tr class="parent-tr">
                                <td class="float-left"><img src="{{ $product->image }}" alt="" style="width: 50px;">
                                    {{ $product->name }}</td>
                                <td class="align-middle">{{ $product->price }}</td>
                                <td class="align-middle btn-parent">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus"
                                                data-price="{{ $product->price }}" data-id="{{ $product->id }}"
                                                data-count="{{ $count }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control count-input form-control-sm bg-secondary text-center"
                                            value="{{ $count }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus"
                                                data-price="{{ $product->price }}" data-id="{{ $product->id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle total">@php
                                    echo $count * $product->price;
                                @endphp</td>
                                <td class="align-middle"><button class="btn btn-sm btn-primary cancel-cart"
                                        data-id="{{ $product->id }}"><i class="fa fa-times"></i></button></td>
                            </tr>

                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    {{-- <div class="card-body">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Subtotal</h6>
                                <h6 class="font-weight-medium">$150</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">$10</h6>
                            </div>
                        </div> --}}
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold total-bill"></h5>
                        </div>
                        <a href="{{route('frontend.checkout')}}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after-scripts')
    <script>
        $(document).ready(function() {

            var totalPrice = 0;
            $('.total').each(function() {
                var price = parseFloat($(this).text());
                totalPrice += price;
            });

            $('.total-bill').empty().prepend("$" + totalPrice);


            $('.btn-plus').click(function() {
                var totalPrice = 0;
                var price = parseFloat($(this).data('price'));
                var count = parseInt($(this).closest('.btn-parent').find('.count-input').val());
                var total = price * count;
                $(this).closest('tr').find('.total').text(total);

                var productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('frontend.cart.ajax') }}",
                    type: 'GET',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        var count = response.count;
                        var productCount = response.productCount;
                        console.log(productCount);
                        $('.cart-badge').empty().prepend(count);

                    }
                })
                $('.total').each(function() {
                    var price = parseFloat($(this).text());
                    totalPrice += price;
                });
                $('.total-bill').empty().prepend("$" + totalPrice);

            });
            $('.btn-minus').click(function() {
                var totalPrice = 0;
                var price = parseFloat($(this).data('price'));
                var count = parseInt($(this).closest('.btn-parent').find('.count-input').val());
                var liveCount = $(this).data('count');
                var $btnParent = $(this).closest('.btn-parent');


                var total = price * count;
                $(this).closest('tr').find('.total').text(total);

                var productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('frontend.cart.ajax.minus') }}",
                    type: 'GET',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        var count = response.count;
                        var productCount = response.productCount;
                        if (productCount == 0) {
                            $btnParent.closest('tr').remove();
                        }
                        $('.cart-badge').empty().prepend(count);
                        $(this).closest('.btn-parent').find('.count-input').val(productCount);
                    }
                })
                $('.total').each(function() {
                    var price = parseFloat($(this).text());
                    totalPrice += price;
                });
                $('.total-bill').empty().prepend("$" + totalPrice);
            });
            $('.cancel-cart').click(function() {
                var totalPrice = 0;
                var productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('frontend.cart.ajax.cancel') }}",
                    type: 'GET',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        var count = response.count;
                        $('.cart-badge').empty().prepend(count);
                    }
                })
                $(this).closest('.parent-tr').remove();
                $('.total').each(function() {
                    var price = parseFloat($(this).text());
                    totalPrice += price;
                });
                $('.total-bill').empty().prepend("$" + totalPrice);
            })

        });
    </script>
@endsection
