@extends('frontend.layouts.secondary')
@section('title')
    My Orders
@endsection
@push('after-styles')

@endpush
@section('main-section')
<div class="col-12 col-lg-10 mx-auto demo">
    <div class="col-12" >
        <div class="display-4 text-center mb-3">Your Orders</div>
        @php
            $count = 1;
        @endphp
        <ul style="list-style: none" class="row">
            @foreach ($orderedProducts as $orderedProduct)
                <li class="main-li mb-3 col-10 shadow- col-lg-5 mx-auto p-4 rounded" style="background:lightblue">
                    <strong class="py-1 px-3 mb-3 badge badge-dark rounded" >Order #: {{ $count }}</strong>
                    <ul>
                        @php
                            $orders = DB::table('ordered_products')->where('order_id', $orderedProduct->id)->get();
                        @endphp
                        @foreach ($orders as $order)
                            <li>
                               <span class="badge badge-warning p-2 rounded">Product:</span> <span class="badge rounded badge-info"> {{ $order->product_name }} </span>
                                <ul class="my-3">
                                    <li class="badge badge-secondary rounded" >
                                        Quantity: {{ $order->quantity }}
                                    </li>
                                    <li class="badge badge-secondary rounded" >
                                        Unit Price: {{ $order->unit_price }}
                                    </li>
                                    <li class="badge badge-secondary rounded" >
                                        Total Price: ${{ $order->total_price }}
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                    
                    <span class="font-weight-bold" >Status:</span> <span class=" text-uppercase badge rounded {{ $orderedProduct->status === 'pending' ? 'bg-warning' : ($orderedProduct->status === 'completed' ? 'bg-primary' : ($orderedProduct->status === 'rejected' ? 'bg-danger' : 'bg-secondary')) }}">{{ $orderedProduct->status }}</span>
                </span>

                </li>
                @php
                    $count++;
                @endphp
            @endforeach
        </ul>
        
</div>


</div>
@endsection